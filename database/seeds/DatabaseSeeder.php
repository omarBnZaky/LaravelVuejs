<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(OrgsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TaskTableSeeder::class);
    }
}
