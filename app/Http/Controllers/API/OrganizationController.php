<?php

namespace App\Http\Controllers\API;

use App\Backend\Admin\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\URL;

class OrganizationController extends Controller
{
    private $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;

    }

    public function index()
    {
        $organizations = $this->organization->paginateOrg(10);
        return response($organizations);
    }

    public function store()
    {
        request()->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password' =>'required|string|min:8|max:13',
            'status' => 'required',
            'profile'=>'required'
        ]);

        try{
            $user = $this->organization->createOrg();
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
        ]);

        try{
            $user = $this->organization->find($id);
            $this->organization->updateOrg($user);
            return ['message'=>'user Updated Successfully'];
        }catch (Exception $exception){
            return response($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $user =$this->organization->find($id);
            $this->organization->delete($user);
        }catch (Exception $exception)
        {
            return response($exception->getMessage());
        }
    }

    public function all()
    {
         $organizations = $this->organization->all();
         return response($organizations);
    }
}
