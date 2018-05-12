<?php

use Illuminate\Database\Seeder;

class WardsTableSeeder extends Seeder
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
        $path = public_path('sql/wards.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Wards table seeded!');
    }
}
