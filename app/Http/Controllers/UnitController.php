<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Resources\Unit as UnitResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Response;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Units in a collection
        UnitResource::WithoutWrapping();
        return UnitResource::collection(Unit::all());
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
        // Insert a new unit from the payload
        $unit = new Unit;
        $unit->uuid = (string) Str::uuid()->string;
        $unit->name = $request['name'];
        $unit->description = $request['description'];
        $unit->created_by = Config::get('apiuser');
        $unit->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $unit->uuid,
            'type' => 'unit'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        $unit = Unit::find($unit);
        // Check if unit is not in the DB
        if ($unit === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'unit'
            ], 404);
        }
        else {
        // List the details of a specific unit
        UnitResource::WithoutWrapping();
        return new UnitResource(Unit::find($unit));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        // Update the resource with the addressed unit
        $unit = Unit::find($unit)->first();
        $unit->name = $request['name'];
        $unit->description = $request['description'];
        $unit->updated_by = Config::get('apiuser');
        $unit->updated_at = date('Y-m-d H:i:s');
        $unit->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $unit->uuid,
            'type' => 'unit'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        // Delete a specific unit by unitID (Soft-Deletes)
        $unit = Unit::find($unit)->first();
        $unit->deleted_by = Config::get('apiuser');
        $unit->save();
        $unit->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $unit->uuid,
            'type' => 'unit'
        ], 200);
    }
}
