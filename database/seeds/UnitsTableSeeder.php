<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Kg',
            'description' => 'Kilograms',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Lt',
            'description' => 'Litres',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Can',
            'description' => 'Cans',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Bag',
            'description' => 'Bags',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Ton',
            'description' => 'Tons',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Cutling',
            'description' => 'Cutlings',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('units')->insert([
            'uuid' => (string) Str::uuid(),
            'name' => 'Piece',
            'description' => 'Pieces',
            'created_by' => 'System',
            'created_at' => date('Y-m-d H:i:s'),
        ]);



    }
}
