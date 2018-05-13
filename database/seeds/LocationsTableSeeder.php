<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.573916,
            'longitude' => 30.096946,
            'name' => 'Kasulu Agrovets',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Second sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.518000,
            'longitude' => 30.045000,
            'name' => 'Nyuki Traders',
            'created_at' => date('Y-m-d H:i:s'),
            ]);
        
        // Third sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -3.583117,
            'longitude' => 30.724251,
            'name' => 'Kasuku Store',
            'created_at' => date('Y-m-d H:i:s'),
            ]);

        // Fourth sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.825949,
            'longitude' => 29.657873,
            'name' => 'Mkulima Shop',
            'created_at' => date('Y-m-d H:i:s'),
            ]);

        // Fifth sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.825467,
            'longitude' => 29.651003,
            'name' => 'Mkulima Shop',
            'created_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
