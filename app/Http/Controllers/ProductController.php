<?php

namespace App\Http\Controllers;

use App\Product;
use App\Subcategory;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the Products in a collection
        ProductResource::WithoutWrapping();
        return ProductResource::collection(Product::with('units')->with('subcategories')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // Get all the details for Product creation
                $subcategory = Subcategory::where('name', $request['subcategory'])->first();
                $unit = Unit::where('name', $request['unit'])->first();
                $product = new Product;
                $product->uuid = (string) Str::uuid()->string;
                $product->name = $request['firstname'];
                $product->price = $request['price'];
                $product->description = $request['description'];
                $product->created_by = Config::get('apiuser');
                $product->save();
                $product->subcategories()->attach($subcategory->id, array('subcategory_id' => $subcategory->id, 'product_id' => $product->id, 'uuid' => (string) Str::uuid()));
                $product->units()->attach($unit->id, array('unit_id' => $unit->id, 'product_id' => $product->id, 'uuid' => (string) Str::uuid()));
                return response()->json([
                    'action' => 'create',
                    'status' => 'OK',
                    'entity' => $product->uuid,
                    'type' => 'product'
                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        // Check if product is not in the DB
        if ($product === null) {
            return response()->json([
                'action' => 'show',
                'status' => 'FAIL',
                'entity' => NULL,
                'type' => 'product'
            ], 404);
        }
        else {
        // List the details of a specific product
        ProductResource::WithoutWrapping();
        return new ProductResource(Product::with('units')->with('subcategories')->find($id));
        }
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
        $subcategory = Subcategory::where('name', $request['subcategory'])->first();
        $subcategory_uuid = DB::table('product_subcategory')->where('product_id', $id)->value('uuid');
        $subcategory_id = DB::table('product_subcategory')->where('product_id', $id)->value('id');
        $unit = Unit::where('name', $request['unit'])->first();
        $unit_uuid = DB::table('product_unit')->where('product_id', $id)->value('uuid');
        $unit_id = DB::table('product_unit')->where('product_id', $id)->value('id');

        $product = Product::find($id);
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->updated_by = Config::get('apiuser');
        $product->subcategories()->sync($subcategory->id);
        $product->subcategories()->updateExistingPivot($subcategory->id, array('uuid' => $subcategory_uuid, 'id' => $subcategory_id));
        $product->units()->sync($unit->id);
        $product->units()->updateExistingPivot($unit->id, array('uuid' => $unit_uuid, 'id' => $unit_id));
        $product->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $product->uuid,
            'type' => 'product'
        ], 200);
        // return $uid;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific Product by ID (Soft-Deletes)
        $product = Product::find($id);
        $product->deleted_by = Config::get('apiuser');
        $product->save();
        $product->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $product->uuid,
            'type' => 'product'
        ], 200);
    }
}
