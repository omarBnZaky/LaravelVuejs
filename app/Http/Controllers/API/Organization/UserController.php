<?php

namespace App\Http\Controllers\API\Organization;

use App\Backend\Organization\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
//        $this->middleware('auth:admin');
    }

    public function index()
    {
//        $users = $this->user->paginateUsers(10);
        return response(Auth::guard('organization')->user()->id);
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
            $user = $this->user->find($id);
            $this->user->delete($user);
        }catch (Exception $exception)
        {
            return response($exception->getMessage());
        }

    }
}
