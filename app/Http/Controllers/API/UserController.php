<?php

namespace App\Http\Controllers\API;

use App\Backend\Admin\User;
use App\Backend\Admin\UsersAnalytics\UserAnalytics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class UserController extends Controller
{
    private $user;
    private $analytics;

    public function __construct
    (
        User $user,
    UserAnalytics $analytics
    )
    {
        $this->user = $user;
        $this->analytics =$analytics;
//        $this->middleware('auth:admin');

    }

    public function index()
    {
        $users = $this->user->paginateUsers(10);
        return response($users);
    }

    public function store()
    {
        request()->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password' =>'required|string|min:8|max:13',
            'status' => 'required',
            'roles'=> 'required',
            'profile'=>'required',
            'org_id'=>'required'
        ]);

        try{
            $user = $this->user->createUser();
            return ['message'=>'User Created Successfully'];
        }catch (Exception $exception){
            return response($exception->getMessage());
        }
    }

    public function update($id)
    {
        request()->validate([
            'name'=>'required|string',
            'email'=>'required|string|email',
            'password' =>'string|min:8|max:13',
            'status' => 'required',
            'roles'=> 'required',
            'org_id' => 'required'
        ]);

        try{
            $user = $this->user->find($id);
            $this->user->updateUser($user);
            return ['message'=>'user Updated Successfully'];
        }catch (Exception $exception){
            return response($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $user =$this->user->find($id);
            $this->user->delete($user);
        }catch (Exception $exception)
        {
            return response($exception->getMessage());
        }
    }

    public function dailyUsers()
    {
        $daily = $this->analytics->daily();
        return response($daily);
    }

    public function weeklyUsers()
    {
        $weekly = $this->analytics->weekly();
        return response($weekly);
    }

    public function monthlyUsers()
    {
        $monthly = $this->analytics->monthly();
        return response($monthly);
    }

    public function YearlyUsers()
    {
        $yearly = $this->analytics->yearly();
        return response($yearly);
    }
}
