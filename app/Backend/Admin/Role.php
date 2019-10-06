<?php


namespace App\Backend\Admin;


use App\Backend\Helper\Constant;
use App\Backend\Helper\Functions;
use App\Backend\Repositories\RoleRepository;
use Illuminate\Support\Facades\Hash;
use Exception;
class Role
{
    private $roleRepo;
    private $roleModel;

    public function __construct(
        RoleRepository $roleRepo,
        \App\Role $roleModel
    )
    {
        $this->roleModel = $roleModel;
        $this->roleRepo = $roleRepo;
    }

    public function find($role_id = null)
    {
        $role = $this->roleRepo
            ->getUserById(request('id') ?? $role_id)
            ->getUserByHashId(request('hash_id') ?? $role_id)
            ->getUserByEmail(request('email') ?? $role_id)
            ->firstUser();

        if (empty($role)) {
            throw new Exception();
        }

        return $role;
    }

    public function createRole()
    {
        $role = $this->roleModel->create([
            'hash_id' => Functions::generateUniqueHashForModel(new \App\User()),
            'name' => request('name'),
        ]);

        return $role;
    }

    public function getRoles()
    {
        return $this->roleRepo->getRole();
    }
    public function updateRole(\App\Role $role)
    {
        try {

            $role->update([
                'name' => request('name'),
            ]);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $role;
    }
}
