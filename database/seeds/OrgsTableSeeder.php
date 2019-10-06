<?php

use Illuminate\Database\Seeder;
use \App\Backend\Helper\Constant;
use Faker\Factory as Faker;
use \App\Backend\Helper\Functions;
class OrgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            Constant::VERIFIED,
            Constant::BLOCKED,
            Constant::PENDING,
        ];

        $profile = "profile.png";
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $organization = \App\Organization::create([
                'hash_id' =>Functions::generateUniqueHashForModel(new \App\Organization(), 20),
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'status' => $faker->randomElement($status),
                'profile' => $profile,
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
