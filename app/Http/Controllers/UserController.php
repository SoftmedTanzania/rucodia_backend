<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Location;
use App\Ward;
use App\Balance;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    // /**
    //  * A Construct setting up User and Response
    //  * 
    //  * @return NULL
    //  */
    public function __construct(Request $request, User $user) {
        $this->request = $request;
        $this->user = $user;
    }

    
    /**
     * JSON listing of the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the users in a collection
        UserResource::WithoutWrapping();
        return UserResource::collection(User::with('levels')->with('locations')->with('wards')->get());
    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all the details for User creation
        $level = Level::where('name', $request['level'])->first();
        $location = Location::where('name', $request['location'])->first();
        $location = Ward::where('name', $request['ward'])->first();
        $user = new User;
        $user->uuid = (string) Str::uuid();
        $user->firstname = $request['firstname'];
        $user->middlename = $request['middlename'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->created_by = Config::get('apiuser');
        $user->save();
        $user->levels()->attach($level->id, array('level_id' => $level->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        $user->locations()->attach($location->id, array('location_id' => $location->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        $user->wards()->attach($ward->id, array('ward_id' => $ward->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * JSON output of specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // Check if user is not in the DB
        if ($user === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'user',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific user
        UserResource::WithoutWrapping();
        return new UserResource(User::with('levels')->with('locations')->with('wards')->find($id));
        }
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed ID
        $level = Level::where('name', $request['level'])->first();
        $level_uuid = DB::table('level_user')->where('user_id', $id)->value('uuid');
        $level_id = DB::table('level_user')->where('user_id', $id)->value('id');
        $location = Location::where('name', $request['location'])->first();
        $location_uuid = DB::table('location_user')->where('user_id', $id)->value('uuid');
        $location_id = DB::table('location_user')->where('user_id', $id)->value('id');
        $ward = Ward::where('name', $request['ward'])->first();
        $ward_uuid = DB::table('user_ward')->where('user_id', $id)->value('uuid');
        $ward_id = DB::table('user_ward')->where('user_id', $id)->value('id');

        $user = User::find($id);
        $user->firstname = $request['firstname'];
        $user->middlename = $request['middlename'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->updated_by = Config::get('apiuser');
        $user->levels()->sync($level->id);
        $user->levels()->updateExistingPivot($level->id, array('uuid' => $level_uuid, 'id' => $level_id));
        $user->locations()->sync($location->id);
        $user->locations()->updateExistingPivot($location->id, array('uuid' => $location_uuid, 'id' => $location_id));
        $user->wards()->sync($ward->id);
        $user->wards()->updateExistingPivot($ward->id, array('uuid' => $ward_uuid, 'id' => $ward_id));
        $user->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific User by ID (Soft-Deletes)
        $user = User::find($id);
        $user->update(['deleted_by' => Config::get('apiuser')]);
        $user->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Get the auth page then sen back user details
     * 
     * @return \Ilumminate\Http\Response
     */
    public function auth()
    {
        $user = User::find(Config::get('apiuser'));
        return response()->json($user);
    }

    public function userBalance($id)
    {
        $user = User::find($id);
        $balance = Balance::where('user_id', $id)->sum('count');
            return response()->json([
                'action' => 'delete',
                'status' => 'OK',
                'entity' => $user->uuid,
                'type' => 'user',
                'user' => Config::get('apiuser'),
                'balance' => $balance
            ], 200);
    }
}
