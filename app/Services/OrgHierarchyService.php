<?php

// app/Services/OrgHierarchyService.php
namespace App\Services;

use App\Models\Dirg;
use App\Models\User;
use App\Models\UpazilaManagerAssignment;
use App\Models\Wing;
use App\Models\Zone;
use Illuminate\Support\Collection;

class OrgHierarchyService
{
    private const MAX_CLIMB = 6;

    /**
     * Resolve Wing / Region / Territory for a list of upazila IDs.
     *
     * - Territory (Zone) -> Regional Managers carry `zone_id` directly on the
     *                       `users` table. We build a `user_id => Zone` map from
     *                       that column and walk each assignee's manager chain
     *                       (self, manager, grand-manager, ...) until a match
     *                       is found.
     * - Region (Dirg)    -> Preferably derived from the resolved Zone's
     *                       `dirg_id`. If no Zone was resolved (e.g. zone_id
     *                       missing or tm_zone not seeded for that row), we
     *                       fall back to matching the chain directly against
     *                       `tm_dirg.aemp_id`, so Region can still resolve
     *                       independently of Territory.
     * - Wing              -> No direct column on `users`, resolved by climbing
     *                       the chain until a manager's id matches
     *                       `tm_wing.aemp_id`.
     *
     * @param  int[]  $upazilaIds
     * @return array<int, array{wing: ?string, region: ?string, territory: ?string}>
     */
    public function resolveForUpazilas(array $upazilaIds): array
    {
        $upazilaIds = array_values(array_unique(array_filter($upazilaIds)));
        if (empty($upazilaIds)) {
            return [];
        }

        // upazila_id => currently assigned manager's user_id
        $assignedUsers = UpazilaManagerAssignment::whereIn('upazila_id', $upazilaIds)
            ->whereNotNull('user_id')
            ->pluck('user_id', 'upazila_id');

        if ($assignedUsers->isEmpty()) {
            return [];
        }

        $rootUserIds = $assignedUsers->unique()->values()->all();
        $chains = $this->buildManagerChains($rootUserIds);

        // Every user id appearing anywhere in any chain (self + all ancestors)
        $allChainUserIds = collect($chains)->flatten()->unique()->values()->all();

        // Load those users so we can read their own zone_id
        $usersById = User::whereIn('id', $allChainUserIds)->get()->keyBy('id');

        // Territory: resolve actual Zone rows for every zone_id found above
        $zoneIds = $usersById->pluck('zone_id')->filter()->unique()->values()->all();
        $zonesById = Zone::whereIn('id', $zoneIds)->get()->keyBy('id');

        // user_id => Zone, sourced from users.zone_id (NOT tm_zone.aemp_id)
        $zonesByUser = $usersById
            ->filter(fn(User $user) => $user->zone_id && $zonesById->has($user->zone_id))
            ->map(fn(User $user) => $zonesById->get($user->zone_id));

        // Region: dirgs referenced by resolved zones, PLUS dirgs matched by aemp_id
        // (needed for the independent fallback below)
        $dirgIdsFromZones = $zonesById->pluck('dirg_id')->filter()->unique()->values()->all();
        $dirgsById = Dirg::whereIn('id', $dirgIdsFromZones)->get()->keyBy('id');
        $dirgsByAemp = Dirg::whereNotNull('aemp_id')->get()->keyBy('aemp_id');

        // Wing: still matched via tm_wing.aemp_id along the chain
        $wingsByAemp = Wing::whereNotNull('aemp_id')->get()->keyBy('aemp_id');

        $resolvedByUser = [];
        $result = [];

        foreach ($assignedUsers as $upazilaId => $userId) {
            if (!isset($resolvedByUser[$userId])) {
                $chain = $chains[$userId] ?? [$userId];

                $zone = $this->firstIn($chain, $zonesByUser);

                // Prefer Region derived from the resolved Zone; otherwise fall
                // back to matching the chain directly against tm_dirg.aemp_id.
                $region = $zone
                    ? $dirgsById->get($zone->dirg_id)
                    : $this->firstIn($chain, $dirgsByAemp);

                $wing = $this->firstIn($chain, $wingsByAemp);

                $resolvedByUser[$userId] = [
                    'wing' => $wing?->wing_name,
                    'region' => $region?->dirg_name,
                    'territory' => $zone?->zone_name,
                ];
            }

            $result[$upazilaId] = $resolvedByUser[$userId];
        }

        return $result;
    }

    /**
     * Return upazila IDs whose resolved manager chain belongs to the wing.
     */
    public function upazilaIdsForWing(int $wingId): array
    {
        $wing = Wing::find($wingId);
        if (!$wing) {
            return [];
        }

        $upazilaIds = UpazilaManagerAssignment::whereNotNull('user_id')
            ->pluck('upazila_id')
            ->unique()
            ->values()
            ->all();

        return collect($this->resolveForUpazilas($upazilaIds))
            ->filter(fn(array $hierarchy) => $hierarchy['wing'] === $wing->wing_name)
            ->keys()
            ->map(fn($id) => (int) $id)
            ->all();
    }

    /**
     * Return upazila IDs whose resolved hierarchy belongs to the region.
     */
    public function upazilaIdsForRegion(int $regionId): array
    {
        $region = Dirg::find($regionId);
        if (!$region) {
            return [];
        }

        $upazilaIds = UpazilaManagerAssignment::whereNotNull('user_id')
            ->pluck('upazila_id')
            ->unique()
            ->values()
            ->all();

        return collect($this->resolveForUpazilas($upazilaIds))
            ->filter(fn(array $hierarchy) => $hierarchy['region'] === $region->dirg_name)
            ->keys()
            ->map(fn($id) => (int) $id)
            ->all();
    }

    private function firstIn(array $chain, Collection $byId)
    {
        foreach ($chain as $id) {
            if ($byId->has($id)) {
                return $byId->get($id);
            }
        }
        return null;
    }

    /** @return array<int, int[]> user_id => [self, manager, grand-manager, ...] */
    private function buildManagerChains(array $rootIds): array
    {
        $chains = [];
        foreach ($rootIds as $id) {
            $chains[$id] = [$id];
        }

        for ($depth = 0; $depth < self::MAX_CLIMB; $depth++) {
            $tails = [];
            foreach ($chains as $root => $chain) {
                $tails[$root] = end($chain);
            }

            $managers = User::whereIn('id', array_unique(array_values($tails)))
                ->pluck('aemp_mngr', 'id');

            $progressed = false;
            foreach ($tails as $root => $tail) {
                $mgr = $managers->get($tail);
                if ($mgr && !in_array($mgr, $chains[$root], true)) {
                    $chains[$root][] = $mgr;
                    $progressed = true;
                }
            }

            if (!$progressed)
                break;
        }

        return $chains;
    }
}
