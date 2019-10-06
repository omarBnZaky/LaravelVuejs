<?php


namespace App\Backend\Admin;


interface AnalyticsContract
{
    public function daily();
    public function weekly();
    public function monthly();
    public function yearly();

}
