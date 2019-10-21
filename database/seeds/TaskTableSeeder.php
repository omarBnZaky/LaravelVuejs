<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Backend\Helper\Functions;
use \App\Backend\Helper\Constant;
class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = \App\User::all();

        $status = [
            Constant::FINISHED,
            Constant::DOING,
            Constant::DOING,
        ];

        foreach ($users as $user){
            foreach (range(1, 3) as $index) {
                    $tasks = \App\Task::create([
                        'hash_id' => Functions::generateUniqueHashForModel(new \App\Task(), 20),
                        'title'=> $faker->title,
                        'description' => $faker->paragraph,
                        'status'=>$faker->randomElement($status),
                        'user_id'=>$user->id
                    ]);
            }
        }
    }

}
