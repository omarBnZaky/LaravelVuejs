<?php


namespace App\Backend\Admin\UsersAnalytics;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait Weekly
{
    public function weeklyOverTime(){
        $weekDays = array('MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN');
        $counter = 0;
        for ($i = Carbon::now()->startOfWeek()->day; $i <= Carbon::now()->endOfWeek()->day; $i++) {
            $weeklyUsers[$weekDays[$counter]] =User::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->whereDay('created_at', sprintf("%02d", $i))
                ->count();
            $counter++;
        }
        return $weeklyUsers;
    }

    public function weeklyCounter(){

        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        $countWeeklyUsers = User::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->whereBetween('created_at',[$startOfWeek,$endOfWeek])
            ->count();

        return $countWeeklyUsers;
    }

}
