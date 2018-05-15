<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Category;
use App\Subcategory;
use App\Http\Resources\Subcategory as SubcategoryResource;

class SubcategoryController extends Controller
{
    /**
     * List Subcategories
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the subcategories in a collection
        SubcategoryResource::WithoutWrapping();
        return SubcategoryResource::collection(Subcategory::with('category')->get());
    }


    /**
     * Add Subcategory
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all the details for Subcategory creation
        $subcategory = new Subcategory;
        $subcategory->uuid = (string) Str::uuid();
        $subcategory->name = $request['name'];
        $subcategory->description = $request['description'];
        $subcategory->created_by = Config::get('apiuser');
        $subcategory->save();
        $subcategory->category()
            ->attach
                ($request['category_id'], array(
                    'category_id' => $request['category_id'],
                    'subcategory_id' => $subcategory->id,
                    'uuid' => (string) Str::uuid()
                )
            );
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $subcategory->uuid,
            'type' => 'subcategory',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Show Subcategory
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Subcategory::find($id);
        // Check if user is not in the DB
        if ($subcategory === null) {
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
        SubcategoryResource::WithoutWrapping();
        return new SubcategoryResource(Subcategory::with('category')->find($id));
        }
    }

    /**
     * Update Subcategory
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // Update the resource with the addressed ID
         $category = Category::where('id', $request['category_id'])->first();
         $category_uuid = DB::table('category_subcategory')->where('subcategory_id', $id)->value('uuid');
         $category_id = DB::table('category_subcategory')->where('subcategory_id', $id)->value('id');
 
         $subcategory = Subcategory::find($id);
         $subcategory->name = $request['name'];
         $subcategory->description = $request['description'];
         $subcategory->updated_by = Config::get('apiuser');
         $subcategory->category()->sync($category->id);
         $subcategory->category()->updateExistingPivot($category->id, array('uuid' => $category_uuid, 'id' => $category_id));
         $subcategory->save();
         return response()->json([
             'action' => 'update',
             'status' => 'OK',
             'entity' => $subcategory->uuid,
             'type' => 'subcategory',
             'user' => Config::get('apiuser')
         ], 200);
    }

    /**
     * Delete Subcategory
     * 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific Subcategory by ID (Soft-Deletes)
        $subcategory = Subcategory::find($id);
        $subcategory->update(['deleted_by' => Config::get('apiuser')]);
        $subcategory->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $subcategory->uuid,
            'type' => 'subcategory',
            'user' => Config::get('apiuser')
        ], 200);
    }
}
