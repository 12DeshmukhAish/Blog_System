<?php
namespace App\Services;

use App\Models\UserActivity;

class ActivityLogger
{
    public function log(array $data)
    {
        return UserActivity::create($data);
    }

    public function getUserActivities($userId, $limit = 10)
    {
        return UserActivity::where('user_id', $userId)
            ->latest()
            ->take($limit)
            ->get();
    }
}