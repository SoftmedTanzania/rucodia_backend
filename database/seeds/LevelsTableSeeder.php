<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Admin',
            'description' => 'Seeded system administrator level',
            // 'created_by' =>0
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Second sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Supplier',
            'description' => 'Seeded supplier level',
            // 'created_by' =>0
            'created_at' => date('Y-m-d H:i:s'),
            ]);
        
        // Third sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Agrodealer',
            'description' => 'Seeded agrodealer level',
            // 'created_by' =>0
            'created_at' => date('Y-m-d H:i:s'),
            ]);

        // Fourth sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Farmer',
            'description' => 'Seeded farmer level',
            // 'created_by' =>0
            'created_at' => date('Y-m-d H:i:s'),
            ]);

    }
}
