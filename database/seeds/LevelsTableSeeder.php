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
            'name' => 'Administrator',
            'description' => 'Seeded system administrator level',
            'buys_from' => '0, 0, 0, 0, 0',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        // Second sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Manufacturer',
            'description' => 'Producing company.',
            'buys_from' => '0, 0, 0, 0, 0',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Third sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Hub-Agrodealer',
            'description' => 'An agrodealer with more than 10 agrodealer clients.',
            'buys_from' => '0, 2, 3, 0, 0',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        // Fourth sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Agrodealer',
            'description' => 'An agrodealer who buys from hub-agrodealer and other agrodealers. Sells to resellers.',
            'buys_from' => '0, 2, 3, 4, 0',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Fifth sample level
        DB::table('levels')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Reseller',
            'description' => 'A reseller buys from agrodealers in the hub and outta hub.',
            'buys_from' => '0, 0, 3, 4, 5',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
