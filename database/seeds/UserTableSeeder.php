<?php

use Illuminate\Database\Seeder;
use App\Backend\Helper\Functions;
use App\Backend\Helper\Constant;

use Faker\Factory as Faker;

use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = User::query();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgs = \App\Organization::all();
        $roles = Role::all()->pluck('id')->toArray();
        $profile = "profile.png";
        $faker = Faker::create();
        $status = [
            Constant::VERIFIED,
            Constant::BLOCKED,
            Constant::PENDING,
        ];
        $firstUser = $this->userModel->create([
            'hash_id' => Functions::generateUniqueHashForModel(new User(), 20),
            'name' => 'omar',
            'email' => 'omarbnzaky@gmail.com',
            'status' => $faker->randomElement($status),
            'profile' => $profile,
            'password' => Hash::make('12345678'),
            'org_id'=>$orgs[0]->id,
        ]);
        $firstUser->roles()->sync([$roles[0],$roles[1]]);


          foreach ($orgs as $org){

                foreach (range(1, 5) as $index) {
                    $user = $this->userModel->create([
                        'hash_id' => Functions::generateUniqueHashForModel(new User(), 20),
                        'name' => $faker->name,
                        'email' => $faker->unique()->email,
                        'status' => Constant::VERIFIED,
                        'profile' => $profile,
                        'password' => Hash::make('12345678'),
                        'org_id'=>$org->id,
                    ]);
                    $user->roles()->sync([$roles[0],$roles[1]]);
                }

                foreach (range(1, 5) as $index) {
                  $user = $this->userModel->create([
                      'hash_id' => Functions::generateUniqueHashForModel(new User(), 20),
                      'name' => $faker->name,
                      'email' => $faker->unique()->email,
                      'status' => Constant::VERIFIED,
                      'profile' => $profile,
                      'password' => Hash::make('12345678'),
                      'org_id'=>$org->id,
                  ]);
                  $user->roles()->sync([$roles[2]]);

              }


          }

    }
}
