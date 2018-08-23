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
	    $hubagrodealer_level  = Level::where('name', 'hub-agrodealer')->first();
        $agrodealer_level = Level::where('name', 'agrodealer')->first();
        $reseller_level = Level::where('name', 'reseller')->first();
        
        $default_location = Location::where('id', 1)->first();
	    // $kasuluRural_location  = Location::where('id', 1)->first();
        // $kibondo_location = Location::where('id', 2)->first();
        // $kigomaRural_location = Location::where('id', 4)->first();
        
        // Create the first sample user named admin
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Default';
        $user->middlename = 'System';
        $user->surname = 'Administrator';
        $user->phone = '0755'.mt_rand(100000, 999999);
        $user->username = 'administrator';
        $user->password = bcrypt('administrator');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($administrator_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($default_location, array('uuid' => (string) Str::uuid()));
        
        // Create the second sample user named kizito
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Sebastian';
        $user->middlename = 'Petro';
        $user->surname = 'Hamba';
        $user->phone = '0754123456';
        $user->username = 'hubagrodealer';
        $user->password = bcrypt('hubagrodealer');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($hubagrodealer_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($default_location, array('uuid' => (string) Str::uuid()));
        
        // Create the first sample user named supplier
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Ali';
        $user->middlename = 'Agrodealer';
        $user->surname = 'Zungu';
        $user->phone = '0755'.mt_rand(100000, 999999);
        $user->username = 'agrodealer';
        $user->password = bcrypt('agrodealer');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($agrodealer_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($default_location, array('uuid' => (string) Str::uuid()));
        
        // Create the first sample user named agrodealer
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Christine';
        $user->middlename = 'Reseller';
        $user->surname = 'Gamba';
        $user->phone = '0755'.mt_rand(100000, 999999);
        $user->username = 'reseller';
        $user->password = bcrypt('reseller');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($reseller_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($default_location, array('uuid' => (string) Str::uuid()));
        
        // Create the first sample user named farmer
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Dauda';
        $user->middlename = 'Reseller';
        $user->surname = 'Waziri';
        $user->phone = '0755'.mt_rand(100000, 999999);
        $user->username = 'reseller';
        $user->password = bcrypt('reseller');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($reseller_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($default_location, array('uuid' => (string) Str::uuid()));

        // $users = factory(App\User::class, 30)->create();
        // $this->command->info('User table seeded!');
    }
}
