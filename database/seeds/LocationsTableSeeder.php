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
        // Seed using model factories
        // $users = factory(App\Location::class, 30)->create();
        // $this->command->info('Location table seeded!');

        // First sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.859657,
            'longitude' => 29.625055,
            'name' => 'Sebastian Agrovets',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Second sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.592884,
            'longitude' => 30.180055,
            'name' => 'Kigondo Traders',
            'created_at' => date('Y-m-d H:i:s'),
            ]);
        
        // Third sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.887088,
            'longitude' => 29.620836,
            'name' => 'Bangwe Store',
            'created_at' => date('Y-m-d H:i:s'),
            ]);

        // Fourth sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.858592,
            'longitude' => 29.639505,
            'name' => 'Gungu Shop',
            'created_at' => date('Y-m-d H:i:s'),
            ]);

        // Fifth sample location
        DB::table('locations')->insert([
            'uuid' => (string) Str::uuid(),
            'latitude' => -4.861908,
            'longitude' => 29.646421,
            'name' => 'Gungu Annex Shop',
            'created_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
