<?php

namespace App\Http\Controllers\api;

use App\Region;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\Region as RegionResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class RegionController extends Controller
{
    /**
     * List Regions
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Regions in a collection
        RegionResource::WithoutWrapping();
        return RegionResource::collection(Region::get());
    }

    /**
     * Add Region
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new region from the payload
        $region = new Region;
        $region->uuid = (string) Str::uuid();
        $region->name = $request['name'];
        $region->created_by = Config::get('apiuser');
        $region->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $region->uuid,
            'type' => 'region',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Show Region
     * 
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);
        // Check if region is not in the DB
        if ($region === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'region',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific region
        RegionResource::WithoutWrapping();
        return new RegionResource(Region::find($id));
        }
    }

    /**
     * Update Region
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed region
        $region = Region::find($id)->first();
        $region->name = $request['name'];
        $region->updated_by = Config::get('apiuser');
        $region->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $region->uuid,
            'type' => 'region',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Delete Region
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific region by regionID (Soft-Deletes)
        $region = Region::find($id)->first();
        $region->update(['deleted_by' => Config::get('apiuser')]);
        $region->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $region->uuid,
            'type' => 'region',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Show Region Districts
     * 
     * Display the districts of the region.
     *
     * @return \Illuminate\Http\Response
     */
    public function regionDistricts($id)
    {
        $region = Region::find($id);
        // Check if region is not in the DB
        if ($region === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'region',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific region
        RegionResource::WithoutWrapping();
        return new RegionResource(Region::with('districts')->find($id));
        }
    }

    /**
     * Show Region Wards
     * Display wards of a region listed by districts.
     *
     * @return \Illuminate\Http\Response
     */
    public function regionDistrictsWards($id)
    {
        $region = Region::find($id);
        // Check if region is not in the DB
        if ($region === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'region',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific region
        RegionResource::WithoutWrapping();
        return new RegionResource(Region::with('districts.wards')->find($id));
        }
    }
}
