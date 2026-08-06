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

        $zonesByAemp = Zone::whereNotNull('aemp_id')->get()->keyBy('aemp_id');
        $dirgsById   = Dirg::get()->keyBy('id');
        $dirgsByAemp = Dirg::whereNotNull('aemp_id')->get()->keyBy('aemp_id');
        $wingsByAemp = Wing::whereNotNull('aemp_id')->get()->keyBy('aemp_id');

        $chains = $this->buildManagerChains($assignedUsers->unique()->values()->all());


        $resolvedByUser = [];
        $result = [];

        foreach ($assignedUsers as $upazilaId => $userId) {
            if (!isset($resolvedByUser[$userId])) {
                $chain = $chains[$userId] ?? [$userId];

                $zone   = $this->firstIn($chain, $zonesByAemp);
                $region = $zone ? $dirgsById->get($zone->dirg_id) : $this->firstIn($chain, $dirgsByAemp);
                $wing   = $this->firstIn($chain, $wingsByAemp);

                $resolvedByUser[$userId] = [
                    'wing'      => $wing?->wing_name,
                    'region'    => $region?->dirg_name,
                    'territory' => $zone?->zone_name,
                ];
            }

            $result[$upazilaId] = $resolvedByUser[$userId];
        }

        return $result;
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

            if (!$progressed) break;
        }

        return $chains;
    }
}

