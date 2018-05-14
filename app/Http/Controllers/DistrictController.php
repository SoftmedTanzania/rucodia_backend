<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\District as DistrictResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Districts in a collection
        DistrictResource::WithoutWrapping();
        return DistrictResource::collection(District::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new district from the payload
        $district = new District;
        $district->uuid = (string) Str::uuid();
        $district->name = $request['name'];
        $district->region_id = $request['region_id'];
        $district->created_by = Config::get('apiuser');
        $district->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $district->uuid,
            'type' => 'district',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district = District::find($id);
        // Check if district is not in the DB
        if ($district === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'district',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific district
        DistrictResource::WithoutWrapping();
        return new DistrictResource(District::find($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed district
        $district = District::find($id)->first();
        $district->name = $request['name'];
        $district->region_id = $request['region_id'];
        $district->updated_by = Config::get('apiuser');
        $district->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $district->uuid,
            'type' => 'district',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific district by regionID (Soft-Deletes)
        $district = District::find($id)->first();
        $district->update(['deleted_by' => Config::get('apiuser')]);
        $district->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $district->uuid,
            'type' => 'district',
            'user' => Config::get('apiuser')
        ], 200);
    }

    public function districtWards($id)
    {
        $district = District::find($id);
        // Check if district is not in the DB
        if ($district === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'district',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific district
        DistrictResource::WithoutWrapping();
        return new DistrictResource(District::with('wards')->find($id));
        }
    }
}