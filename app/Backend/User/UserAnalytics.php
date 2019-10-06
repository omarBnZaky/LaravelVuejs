<?php


namespace App\Backend\User;


interface UserAnalytics
{
    public function daily();
    public function weekly();
    public function monthly();
    public function yearly();

}
