<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelsTableSeeder::class,
            LocationsTableSeeder::class,
            UsersTableSeeder::class,
            UnitsTableSeeder::class,
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            CategorySubcategoryTableSeeder::class,
            ProductsTableSeeder::class,
            RegionsTableSeeder::class,
            DistrictsTableSeeder::class,
            WardsTableSeeder::class,
            UserWardTableSeeder::class,
            LevelUserTableSeeder::class,
            LocationUserTableSeeder::class,
            StatusesTableSeeder::class,
            TransactiontypesTableSeeder::class,
        ]);
    }
}
