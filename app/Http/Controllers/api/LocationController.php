<?php

namespace App\Http\Controllers\api;

use App\Location;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Location as LocationResource;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\Config;

class LocationController extends Controller
{
    /**
     * List Locations
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List locations
        LocationResource::WithoutWrapping();
        return LocationResource::collection(Location::all());
    }

    /**
     * Add Location
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new location from the payload
        $location = new Location;
        $location->uuid = (string) Str::uuid();
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->name = $request['name'];
        $location->created_by = Config::get('apiuser')->id();
        $location->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Show  Location
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $id)
    {
        // Individual location details
        $location = Location::find($id);
        // Check if location is not in the DB
        if ($location === NULL) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'location',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific location
        LocationResource::WithoutWrapping();
        return new LocationResource(Location::find($id));
        }
    }

    /**
     * Update Location
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $location)
    {
        // Update the resource with the addressed location
        $location = Location::find($location);
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->name = $request['name'];
        $location->update(['updated_by' => Config::get('apiuser')]);
        $location->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location',
            'user' => Config::get('apiuser')
        ], 200);

    }

    /**
     * Delete Location
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $d)
    {
        // Delete a specific location by locationID (Soft-Deletes)
        $location = Location::findOrFail($d);
        $location->update(['deleted_by' => Config::get('apiuser')]);
        $location->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location',
            'user' => Config::get('apiuser')
        ], 200);
        // return $location;
    }
}
