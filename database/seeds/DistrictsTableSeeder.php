<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed this table from an SQL file
        DB::disableQueryLog();
        $path = public_path('sql/districts.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Districts table seeded!');
    }
}
