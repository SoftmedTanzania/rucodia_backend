<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use App\Http\Resources\Level as LevelResource;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\Config;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Levels in a collection
        LevelResource::WithoutWrapping();
        return LevelResource::collection(Level::all());
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
        // Insert a new level from the payload
        $level = new Level;
        $level->uuid = (string) Str::uuid();
        $level->name = $request['name'];
        $level->description = $request['description'];
        $level->created_by = Config::get('apiuser');
        $level->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $level->uuid,
            'type' => 'level',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::find($id);
        // Check if level is not in the DB
        if ($level === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'level',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific level
        LevelResource::WithoutWrapping();
        return new LevelResource(Level::find($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed level
        $level = Level::find($id)->first();
        $level->name = $request['name'];
        $level->description = $request['description'];
        $level->updated_by = Config::get('apiuser');
        $level->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $level->uuid,
            'type' => 'level',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific level by levelID (Soft-Deletes)
        $level = Level::find($id);
        $level->update(['deleted_by' => Config::get('apiuser')]);
        $level->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $level->uuid,
            'type' => 'level',
            'user' => Config::get('apiuser')
        ], 200);
    }
}
