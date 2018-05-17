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
        $transaction = new Transaction;
        $transaction->uuid = (string) Str::uuid();
        $transaction->amount = $request['amount'];
        $transaction->price = $request['price'];
        $transaction->transactiontype_id = $request['transactiontype_id'];
        $transaction->user_id = $request['user_id'];
        $transaction->product_id = $request['product_id'];
        $transaction->status_id = $request['status_id'];
        $transaction->created_by = Config::get('apiuser');
        $transaction->save();
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 201);
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
        // List all the users in a collection
        TransactionResource::WithoutWrapping();
        // return new UserResource(User::with('levels')->with('locations')->with('wards')->find($id));
        return new TransactionResource(Transaction::with('transactiontype')->with('user')->with('product')->with('status')->find($transaction));
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

    /**
    * User's Transactions
    * 
    * JSON List of specific user's transactions.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function userTransactions($user)
    {
        // List all the transactions for a user
        TransactionResource::WithoutWrapping();
        return new TransactionResource(Transaction::where('user_id', $user)->with('transactiontype')->with('user')->with('product')->with('status')->get());
    }

}
