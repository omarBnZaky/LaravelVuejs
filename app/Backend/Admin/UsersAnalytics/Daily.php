<?php


namespace App\Backend\Admin\UsersAnalytics;

use App\User;
use Carbon\Carbon;

trait Daily
{
    public function dailyOverTime()
    {
        $hours = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24];

        for ($i = 0; $i < count($hours) - 1; $i++) {
            $dailyUsers[$hours[$i]]= User::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->whereDay('created_at', '=', Carbon::now())
                ->whereTime('created_at', '>=', Carbon::parse($hours[$i] . ":00"))
                ->whereTime('created_at', '<', Carbon::parse($hours[$i + 1] . ":00"))
                ->count();
        }
        return $dailyUsers;
    }

    public function dailyCounter()
    {
        $countDailyUsers =User::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->whereDay('created_at', '=', Carbon::now())
            ->count();
        return $countDailyUsers;
    }

}
