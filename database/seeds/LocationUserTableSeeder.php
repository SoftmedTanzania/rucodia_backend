<?php

use Illuminate\Database\Seeder;

class LocationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed using model factories
        $users = factory(App\Location_User::class, 30)->create();
        $this->command->info('Location user table seeded!');
    }
}
