<?php

use App\Backend\Helper\Constant;
use App\Backend\Helper\Functions;
use App\Role;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           Role::create([
               'hash_id' => Functions::generateUniqueHashForModel(new Role(), 20),
               'name' => "front End developer",
            ]);

           Role::create([
               'hash_id' => Functions::generateUniqueHashForModel(new Role(), 20),
               'name' => "Back end developer",
            ]);

            Role::create([
                'hash_id' => Functions::generateUniqueHashForModel(new Role(), 20),
                'name' => "Team leader",
            ]);

    }
}
