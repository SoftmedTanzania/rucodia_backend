<?php

namespace App\Http\Controllers\api;

use App\Transaction;
use App\Product;
use App\Balance;
use Illuminate\Http\Request;
use App\Http\Resources\Transaction as TransactionResource;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class TransactionController extends Controller
{
    /**
     * List Transactions
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the users in a collection
        TransactionResource::WithoutWrapping();
        return TransactionResource::collection(Transaction::with('transactiontype')->with('user')->with('product')->with('status')->get());
    }


    /**
     * Add Transaction
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $productPrice = Product::where('id', $request['product_id'])->first()->price;
        // $stockPrice = $productPrice * $request['amount'];
        // $sellingPrice = $request['price'] * $request['amount'];
        $transaction = new Transaction;
        // $balance = new Balance;
        $transaction->uuid = (string) Str::uuid();
        $transaction->amount = $request['amount'];
        $transaction->price = $request['price'];
        // if($request['transactiontype_id']===2) {
        //     $balance->price = $sellingPrice;
        //     $balance->transactiontype_id = $request['transactiontype_id'];
        // }
        // else {
        //     $balance->price = $stockPrice;
        //     $balance->transactiontype_id = $request['transactiontype_id'];
        // }
        $transaction->transactiontype_id = $request['transactiontype_id'];
        $transaction->user_id = $request['user_id'];
        $transaction->product_id = $request['product_id'];
        $transaction->status_id = $request['status_id'];
        $transaction->created_by = Config::get('apiuser');
        $transaction->save();
        // $balance = Balance::find($transaction->user_id);
        // $balance->uuid = (string) Str::uuid();
        // $balance->count = $transaction->amount;
        // $balance->price = $transaction->price;
        // $balance->transactiontype_id = $transaction->transactiontype_id;
        // $balance->user_id = $transaction->user_id;
        // $balance->product_id = $transaction->product_id;
        // $balance->transaction_id = $transaction->id;
        // $balance->created_by = Config::get('apiuser');
        // $balance->save();
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 201);
        // return $transaction->price;
    }

    /**
     * Show Transaction
     * 
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update Transaction
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        $transaction->status_id = $request['status_id'];
        $transaction->updated_by = Config::get('apiuser');
        $transaction->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Delete Transaction
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $id)
    {
        // Delete a specific Transaction by ID (Soft-Deletes)
        $transaction = Transaction::find($id);
        $transaction->update(['deleted_by' => Config::get('apiuser')]);
        $transaction->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 200);
    }
}
