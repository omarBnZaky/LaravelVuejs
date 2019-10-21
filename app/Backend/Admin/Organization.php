<?php


namespace App\Backend\Admin;


use App\Backend\Helper\Constant;
use App\Backend\Helper\Functions;
use App\Backend\Repositories\OrgRepository;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Exception;

class Organization
{
    private $orgRepo;
    private $orgModel;

    public function __construct(
        OrgRepository $orgRepo,
        \App\Organization $orgModel
    )
    {
        $this->orgModel = $orgModel;
        $this->orgRepo = $orgRepo;
    }

    public function find($org_id = null)
    {
        $organization = $this->orgRepo
            ->getOrgById(request('id') ?? $org_id)
            ->getOrgByHashId(request('hash_id') ?? $org_id)
            ->getOrgByEmail(request('email') ?? $org_id)
            ->firstOrg();

        if (empty($organization)) {
            throw new Exception();
        }
        return $organization;
    }

    public function allOrgs()
    {
        return $this->orgRepo->getOrg();
    }

    public function createOrg()
    {

        $image = request()->get('profile');

        $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

        Image::make(request()->get('profile'))->save(public_path('img/org/').$name);

        $org = $this->orgModel->create([
            'hash_id' => Functions::generateUniqueHashForModel(new \App\Organization()),
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'status' => request('status'),
            'profile'=>$name
        ]);
        return $org;
    }

    public function updateOrg(\App\Organization $org)
    {
        try {
            $org->update([
                'name' => request('name'),
                'email' => request('email'),
                'status' => request('status'),
            ]);

            //Update password
            if(request('password')){
                $org->update(['password'=>Hash::make(request('password'))]);
            }
            // Update profile image
            if(request()->input('profile'))
            {
               if(!$org->profile== "profile.png"){
                   $oldPicPath =public_path('img/org/').$org->profile;

                   if(file_exists($oldPicPath)){
                       unlink($oldPicPath);
                   }
               }
                $image = request()->get('profile');

                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

                Image::make(request()->get('profile'))->save(public_path('img/org/').$name);

                $org->update(['profile'=>$name]);
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $org;
    }


    public function delete(\App\Organization $org)
    {
        try {
            if(!$org->profile== "profile.png") {
                $oldPicPath = public_path('img/org/') . $org->profile;
                if (file_exists($oldPicPath)) {
                    unlink($oldPicPath);
                }
            }

            $org->delete();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function latestOrg(int $pagination)
    {
        return $this->orgRepo->latestOrgs()->with('roles')->paginate($pagination);
    }

    public function paginateOrg(int $pagination)
    {
        return $this->orgRepo->paginateOrg($pagination);
    }


    public function all()
    {
        return $this->orgRepo->getOrg();
    }

}
