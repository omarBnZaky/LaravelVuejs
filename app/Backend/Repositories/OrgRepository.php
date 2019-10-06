<?php


namespace App\Backend\Repositories;

use App\Backend\Helper\Constant;
use App\Organization;

class OrgRepository
{
    private $orgsModel;

    /**
     * UserRepository constructor.
     */
    public function __construct(Organization $userModel)
    {
        $this->orgsModel = $userModel->newQuery();
    }

    public function newQuery()
    {
        $this->orgsModel = $this->orgsModel->newModelInstance();

        return $this;
    }

    public function getOrgById($id)
    {
        $this->orgsModel = $this->orgsModel->where('id', $id);

        return $this;
    }

    public function getOrgByHashId($hash_id)
    {
        $this->orgsModel = $this->orgsModel->orWhere('hash_id', $hash_id);

        return $this;
    }

    public function getOrgByEmail($email)
    {
        $this->orgsModel = $this->orgsModel->orWhere('email', $email);

        return $this;
    }

    public function count()
    {
        return $this->orgsModel->count();
    }

    public function firstOrg()
    {
        return $this->orgsModel->first();
    }

    public function getOrg()
    {
        return $this->orgsModel->with('users')->get();
    }

    public function latestOrgs()
    {
        return $this->orgsModel->with('users')->latest();
    }

    public function paginateOrg($pagination){

        return $this->orgsModel->with('users')->paginate($pagination);
    }
}
