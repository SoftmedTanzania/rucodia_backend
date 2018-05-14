<?php

namespace App\Http\Controllers;

use App\Ward;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\Ward as WardResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Wards in a collection
        WardResource::WithoutWrapping();
        return WardResource::collection(Ward::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new ward from the payload
        $ward = new Ward;
        $ward->uuid = (string) Str::uuid();
        $ward->name = $request['name'];
        $ward->district_id = $request['district_id'];
        $ward->created_by = Config::get('apiuser');
        $ward->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $ward->uuid,
            'type' => 'ward',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ward = Ward::find($id);
        // Check if ward is not in the DB
        if ($ward === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'ward',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific ward
        WardResource::WithoutWrapping();
        return new WardResource(Ward::find($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed ward
        $ward = Ward::find($id)->first();
        $ward->name = $request['name'];
        $ward->district_id = $request['district_id'];
        $ward->updated_by = Config::get('apiuser');
        $ward->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $ward->uuid,
            'type' => 'ward',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific ward by wardID (Soft-Deletes)
        $ward = Ward::find($id)->first();
        $ward->update(['deleted_by' => Config::get('apiuser')]);
        $ward->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $ward->uuid,
            'type' => 'ward',
            'user' => Config::get('apiuser')
        ], 200);
    }

}