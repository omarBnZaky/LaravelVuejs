<?php

namespace App\Http\Controllers\API\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Backend\Organization\User;
use Exception;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
//        $this->middleware(['api','auth:]);

    }

    public function index()
    {
        $users = $this->user->paginateOrgUsers(10);
        return response($users);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|max:13',
            'status' => 'required',
            'roles' => 'required',
            'profile' => 'required'
        ]);

        try {
            $user = $this->user->createUser();
        } catch (Exception $exception) {
            return response($exception->getMessage());
        }
    }

    public function update($id)
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'string|min:8|max:13',
            'status' => 'required',
            'roles' => 'required',
        ]);

        try {
            $user = $this->user->find($id);
            return $this->user->updateUser($user);
        } catch (Exception $exception) {
            return response($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->user->find($id);
            $this->user->delete($user);
        } catch (Exception $exception) {
            return response($exception->getMessage());
        }

    }

}
