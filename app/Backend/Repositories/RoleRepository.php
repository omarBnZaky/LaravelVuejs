<?php


namespace App\Backend\Repositories;


use App\Role;

class RoleRepository
{
    private $roleModel;

    /**
     * UserRepository constructor.
     */
    public function __construct(Role $roleModel)
    {
        $this->roleModel = $roleModel->newQuery();
    }

    public function newQuery()
    {
        $this->roleModel = $this->roleModel->newModelInstance();

        return $this;
    }

    public function getRoleById($id)
    {
        $this->roleModel = $this->roleModel->where('id', $id);

        return $this;
    }

    public function getRoleByHashId($hash_id)
    {
        $this->roleModel = $this->roleModel->orWhere('hash_id', $hash_id);

        return $this;
    }

    public function count()
    {
        return $this->roleModel->count();
    }

    public function getRole()
    {
        return $this->roleModel->get();
    }

}
