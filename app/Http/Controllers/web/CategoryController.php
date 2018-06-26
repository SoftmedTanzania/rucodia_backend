<?php

namespace App\Http\Controllers\web;

use Response;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //All categories from the database
        $categories = Category::all();
        $page = 'Category';
        return view('categories/index')
            ->with('categories', $categories)
            ->with('page', $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load the creation page
        $page = 'Category';
        return view('categories/create')
            ->with('page', $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insert a new category from creation page
        $category = new Category;
        $category->uuid = (string) Str::uuid();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->created_by = Config::get('apiuser');
        $category->save();
        $categories = Category::all();
        $page = 'Category';
        return view('categories/index')
            ->with('categories', $categories)
            ->with('page', $page);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
        $category = Category::find($id);
        $page = 'Category';
        return view('categories/show')
            ->with('category', $category)
            ->with('page', $page);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the details for a specific category
        $page = 'User';
        $category = Category::find($id)->first();
        return view('categories/edit')
            ->with('category', $category)
            ->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed ID
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->save();
        $categories = Category::all();
        $page = 'Category';
        return view('categories/index')
            ->with('categories', $categories)
            ->with('page', $page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific User by ID (Soft-Deletes)
        $category = Category::find($id);
        $category->update(['deleted_by' => Config::get('apiuser')]);
        $category->delete();
        $categories = Category::all();
        $page = 'Category';
        return view('categories/index')
            ->with('categories', $categories)
            ->with('page', $page);
    }
}
