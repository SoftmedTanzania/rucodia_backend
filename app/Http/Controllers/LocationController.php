<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Resources\Location as LocationResource;
use Illuminate\Support\Str;
use Response;

class LocationController extends Controller
{
    /**
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new location from the payload
        $location = new Location;
        $location->uuid = (string) Str::uuid()->string;
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->name = $request['name'];
        $location->created_by = 'SystemAPI';
        $location->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        // Individual location details
        $location = Location::find($location);
        // Check if location is not in the DB
        if ($location === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'location'
            ], 404);
        }
        else {
        // List the details of a specific location
        LocationResource::WithoutWrapping();
        return new LocationResource(Location::find($location));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        // Update the resource with the addressed location
        $location = Location::find($location)->first();
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->name = $request['name'];
        $location->updated_by = 'SystemAPI';
        $location->updated_at = date('Y-m-d H:i:s');
        $location->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        // Delete a specific location by locationID (Soft-Deletes)
        $location = Location::find($location);
        $location->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $location->uuid,
            'type' => 'location'
        ], 200);
    }
}
