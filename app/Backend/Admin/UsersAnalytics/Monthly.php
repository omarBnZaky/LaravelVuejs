<?php


namespace App\Backend\Admin\UsersAnalytics;

use App\Backend\Helper\Date;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait Monthly
{
    public function monthlyOverTime()
    {
        $monthStart = Carbon::now()->startOfMonth()->day;
        $monthEnd = Carbon::now()->endOfMonth()->day;
        $interval = (int)(($monthEnd - $monthStart) / 5);
        $days = [];
        $days[0] = $monthStart;

        for ($i = 1; $i <= $interval; $i++) {
            $days[$i] = $days[$i - 1] + $interval;
            if($days[$i] >=$monthEnd){
                break;
            }
        }
        $days[] = $monthEnd;

        for ($i = 0; $i < count($days) - 1; $i++) {
            $monthlyUsers[$days[$i]] = User::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->whereDay('created_at', '>=', $days[$i])
                ->whereDay('created_at', '<', $days[$i + 1])
                ->count();
        }

        return $monthlyUsers ;
    }

    public function monthlyCounter(){
        $monthStart = Carbon::now()->startOfMonth()->day;
        $monthEnd = Carbon::now()->endOfMonth()->day;

        $countMonthlyUsers = User::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        return $countMonthlyUsers;
    }
}
