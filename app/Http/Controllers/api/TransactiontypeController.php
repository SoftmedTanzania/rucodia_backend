<?php

namespace App\Http\Controllers\api;

use App\Transactiontype;
use Illuminate\Http\Request;
use App\Http\Resources\Transactiontype as TransactiontypeResource;

class TransactiontypeController extends Controller
{
    /**
     * Show Transaction Types
     * 
     * Display a listing of the types of transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the users in a collection
        TransactiontypeResource::WithoutWrapping();
        return TransactiontypeResource::collection(Transactiontype::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
