<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Categorys in a collection
        CategoryResource::WithoutWrapping();
        return CategoryResource::collection(Category::with('subcategories')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new category from the payload
        $category = new Category;
        $category->uuid = (string) Str::uuid();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->created_by = Config::get('apiuser');
        $category->save();
        return response()->json([
            'acton' => 'create',
            'status' => 'OK',
            'entity' => $category->uuid,
            'type' => 'category',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        // Check if category is not in the DB
        if ($category === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'category',
                'user' => Config::get('apiuser')
            ], 404);
        }
        else {
        // List the details of a specific category
        CategoryResource::WithoutWrapping();
        return new CategoryResource(Category::with('subcategories')->find($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed category
        $category = Category::find($id)->first();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->updated_by = Config::get('apiuser');
        $category->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $category->uuid,
            'type' => 'category',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Delete a specific category by categoryID (Soft-Deletes)
        $category = Category::find($category)->first();
        $category->update(['deleted_by' => Config::get('apiuser')]);
        $category->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $category->uuid,
            'type' => 'category',
            'user' => Config::get('apiuser')
        ], 200);
    }
}
