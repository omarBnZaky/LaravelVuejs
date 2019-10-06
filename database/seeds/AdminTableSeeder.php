<?php

use Illuminate\Database\Seeder;
use App\Backend\Helper\Functions;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = "profile.png";

        $admin = \App\Admin::create([
            'hash_id' => Functions::generateUniqueHashForModel(new \App\Admin(), 20),
            'name' => "admin",
            'email' => "admin@laravelVue.com",
            'profile' => $profile,
            'password' => Hash::make('12345678'),
        ]);
    }
}
