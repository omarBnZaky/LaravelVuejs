<?php


namespace App\Backend\Admin\UsersAnalytics;


use App\User;
use Carbon\Carbon;

trait Yearly
{
    public function yearlyOverTime(){

        $year = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
        for ($i = 1; $i <= count($year); $i++) {
            $yearlyUserOverTime[$year[$i - 1]] = User::WhereYear('created_at', date('Y'))
                ->whereMonth('created_at', sprintf("%02d", $i))
                ->count();
        }
        return $yearlyUserOverTime;
    }

    public function yearlyCounter()
    {
//        $startOfYear = Carbon::now()->startOfYear()->toDateString();
//        $endOfYear = Carbon::now()->endOfYear()->toDateString();

        $countYearlyUsers = User::whereYear('created_at', date('Y'))->count();

        return $countYearlyUsers;
    }

}
