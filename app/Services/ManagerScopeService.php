<?php
// app/Services/ManagerScopeService.php

namespace App\Services;

use App\Models\User;
use App\Models\UpazilaManagerAssignment;

class ManagerScopeService
{
    public function visibleUpazilaIds(User $user): array
    {
        if ($user->isRegionalManager()) {
            return UpazilaManagerAssignment::where('user_id', $user->id)
                ->pluck('upazila_id')
                ->unique()
                ->values()
                ->all();
        }

        if ($user->isWingManager()) {
            $regionalManagerIds = User::where('aemp_mngr', $user->id)
                ->where('user_type_id', 4) // Regional Manager
                ->pluck('id');

            return UpazilaManagerAssignment::whereIn('user_id', $regionalManagerIds)
                ->pluck('upazila_id')
                ->unique()
                ->values()
                ->all();
        }

        return [];
    }
}
