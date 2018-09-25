<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Level;
use App\Location;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $administrator_level = Level::where('name', 'administrator')->first();
        // $manufacturer_level = Level::where('name', 'manufacturer')->first();
	    // $hubagrodealer_level  = Level::where('name', 'hub-agrodealer')->first();
        // $agrodealer_level = Level::where('name', 'agrodealer')->first();
        // $reseller_level = Level::where('name', 'reseller')->first();
        
        $administrator_location = Location::where('id', 1)->first();
        // $manufacturer_location = Location::where('id', 2)->first();
	    // $hubagrodealer_location  = Location::where('id', 3)->first();
        // $agrodealer_location = Location::where('id', 4)->first();
        // $reseller_location = Location::where('id', 5)->first();
        // $reseller2_location = Location::where('id', 6)->first();
        
        // Create the first sample user named admin
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Craysonde';
        $user->middlename = 'Nyilongo';
        $user->surname = 'Ngelangela';
        $user->phone = '0753983337';
        $user->username = 'administrator';
        $user->password = bcrypt('Rucodia2018.');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($administrator_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($administrator_location, array('uuid' => (string) Str::uuid()));

        // // Create the second sample user named admin
        // $user = new User();
        // $user->uuid = (string) Str::uuid();
        // $user->firstname = 'Original';
        // $user->middlename = 'Input';
        // $user->surname = 'Manufacturer';
        // $user->phone = '0755'.mt_rand(100000, 999999);
        // $user->username = 'manufacturer';
        // $user->password = bcrypt('manufacturer');
        // $user->created_by = 0;
        // $user->created_at = date('Y-m-d H:i:s');
        // $user->save();
        // $user->levels()->attach($manufacturer_level, array('uuid' => (string) Str::uuid()));
        // $user->locations()->attach($manufacturer_location, array('uuid' => (string) Str::uuid()));
        
        // // Create the third sample user named kizito
        // $user = new User();
        // $user->uuid = (string) Str::uuid();
        // $user->firstname = 'Sebastian';
        // $user->middlename = 'Petro';
        // $user->surname = 'Hamba';
        // $user->phone = '0754123456';
        // $user->username = 'hubagrodealer';
        // $user->password = bcrypt('hubagrodealer');
        // $user->created_by = 0;
        // $user->created_at = date('Y-m-d H:i:s');
        // $user->save();
        // $user->levels()->attach($hubagrodealer_level, array('uuid' => (string) Str::uuid()));
        // $user->locations()->attach($hubagrodealer_location, array('uuid' => (string) Str::uuid()));
        
        // // Create the fourth sample user named supplier
        // $user = new User();
        // $user->uuid = (string) Str::uuid();
        // $user->firstname = 'Ali';
        // $user->middlename = 'Agrodealer';
        // $user->surname = 'Zungu';
        // $user->phone = '0755'.mt_rand(100000, 999999);
        // $user->username = 'agrodealer';
        // $user->password = bcrypt('agrodealer');
        // $user->created_by = 0;
        // $user->created_at = date('Y-m-d H:i:s');
        // $user->save();
        // $user->levels()->attach($agrodealer_level, array('uuid' => (string) Str::uuid()));
        // $user->locations()->attach($agrodealer_location, array('uuid' => (string) Str::uuid()));
        
        // // Create the fifth sample user named agrodealer
        // $user = new User();
        // $user->uuid = (string) Str::uuid();
        // $user->firstname = 'Christine';
        // $user->middlename = 'Reseller';
        // $user->surname = 'Gamba';
        // $user->phone = '0755'.mt_rand(100000, 999999);
        // $user->username = 'reseller';
        // $user->password = bcrypt('reseller');
        // $user->created_by = 0;
        // $user->created_at = date('Y-m-d H:i:s');
        // $user->save();
        // $user->levels()->attach($reseller_level, array('uuid' => (string) Str::uuid()));
        // $user->locations()->attach($reseller_location, array('uuid' => (string) Str::uuid()));
        
        // // Create the sixth sample user named farmer
        // $user = new User();
        // $user->uuid = (string) Str::uuid();
        // $user->firstname = 'Dauda';
        // $user->middlename = 'Namamba';
        // $user->surname = 'Waziri';
        // $user->phone = '0755'.mt_rand(100000, 999999);
        // $user->username = 'reseller2';
        // $user->password = bcrypt('reseller2');
        // $user->created_by = 0;
        // $user->created_at = date('Y-m-d H:i:s');
        // $user->save();
        // $user->levels()->attach($reseller_level, array('uuid' => (string) Str::uuid()));
        // $user->locations()->attach($reseller2_location, array('uuid' => (string) Str::uuid()));

        // $users = factory(App\User::class, 30)->create();
        // $this->command->info('User table seeded!');
    }
}
