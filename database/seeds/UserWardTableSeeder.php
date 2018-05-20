<?php

use Illuminate\Database\Seeder;

class UserWardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed this table from an SQL file
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // DB::disableQueryLog();
        // $path = public_path('sql/user_ward.sql');
        // DB::unprepared(file_get_contents($path));
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        // $this->command->info('User_ward table seeded!');

        // Seed using model factories
        $users = factory(App\User_Ward::class, 30)->create();
    }
}