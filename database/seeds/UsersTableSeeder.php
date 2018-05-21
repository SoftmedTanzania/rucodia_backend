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
        
        $admin_level = Level::where('name', 'admin')->first();
	    $supplier_level  = Level::where('name', 'supplier')->first();
        $agrodealer_level = Level::where('name', 'agrodealer')->first();
        $farmer_level = Level::where('name', 'farmer')->first();
        
        $kasulu_location = Location::where('id', 1)->first();
	    $kasuluRural_location  = Location::where('id', 1)->first();
        $kibondo_location = Location::where('id', 2)->first();
        $kigomaRural_location = Location::where('id', 3)->first();
        
        
        
        // Create the first sample user named admin
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'System';
        $user->middlename = 'Initial';
        $user->surname = 'Admin';
        $user->email = str_random(10).'@gmail.com';
        $user->username = 'admin';
        $user->password = bcrypt('admin');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($admin_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($kigomaRural_location, array('uuid' => (string) Str::uuid()));
        
        // Create the second sample user named kizito
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Kizito';
        $user->middlename = 'Stanslaus';
        $user->surname = 'Mrema';
        $user->email = 'kizomanizo@gmail.com';
        $user->username = 'kizito';
        $user->password = bcrypt('kizito');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($admin_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($kigomaRural_location, array('uuid' => (string) Str::uuid()));
        
        // Create the first sample user named supplier
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Supplier';
        $user->middlename = 'Initial';
        $user->surname = 'User';
        $user->email = str_random(10).'@gmail.com';
        $user->username = 'supplier';
        $user->password = bcrypt('supplier');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($supplier_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($kasulu_location, array('uuid' => (string) Str::uuid()));
        
        // Create the first sample user named agrodealer
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Dealer';
        $user->middlename = 'Initial';
        $user->surname = 'Dealer';
        $user->email = str_random(10).'@gmail.com';
        $user->username = 'dealer';
        $user->password = bcrypt('dealer');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($agrodealer_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($kibondo_location, array('uuid' => (string) Str::uuid()));
        
        
        // Create the first sample user named farmer
        $user = new User();
        $user->uuid = (string) Str::uuid();
        $user->firstname = 'Farmer';
        $user->middlename = 'Initial';
        $user->surname = 'Farmer';
        $user->email = str_random(10).'@gmail.com';
        $user->username = 'farmer';
        $user->password = bcrypt('farmer');
        $user->created_by = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        $user->levels()->attach($farmer_level, array('uuid' => (string) Str::uuid()));
        $user->locations()->attach($kasuluRural_location, array('uuid' => (string) Str::uuid()));

        // $users = factory(App\User::class, 30)->create();
        // $this->command->info('User table seeded!');
    }
}
