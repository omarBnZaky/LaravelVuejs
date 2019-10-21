<?php


namespace App\Backend\Admin\UsersAnalytics;


use App\Backend\Admin\AnalyticsContract;

class UserAnalytics implements AnalyticsContract
{
    use Daily, Weekly, Monthly, Yearly;

    public function daily()
    {
        return [
            'Daily over Time' => $this->dailyOverTime(),
            'Daily over All' => $this->dailyCounter(),
        ];
    }

    public function weekly()
    {
        return [
            'Weekly over Time' => $this->weeklyOverTime(),
            'Weekly over All' => $this->weeklyCounter(),
        ];
    }

    public function monthly()
    {
        return [
            'Monthly over Time' => $this->monthlyOverTime(),
            'Monthly over All' => $this->monthlyCounter(),
        ];
    }

    public function yearly()
    {
        return [
            'Yearly over Time' => $this->yearlyOverTime(),
            'Yearly over All' => $this->yearlyCounter(),
        ];
    }
}
