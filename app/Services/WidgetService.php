<?php

namespace App\Services;

use App\Models\stravaactivity;
use Carbon\Carbon;

class WidgetService
{
    public function todayRide($userId,$type='Ride')
    {
        $userActiviyObj = stravaactivity::where('user_id', $userId)
        ->whereDate('start_date_local', Carbon::today())->where('type',$type)->first();
        $today_ride =  isset($userActiviyObj->distance)?$userActiviyObj->distance:0;
        // Your business logic here
        return $today_ride;
    }
}
