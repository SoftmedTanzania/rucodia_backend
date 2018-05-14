<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use App\Product;
use App\Status;
use App\Transactiontype;
use Illuminate\Http\Request;
use App\Http\Resources\Transaction as TransactionResource;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class TransactionController extends Controller
{
    /**
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all the details for User creation
        // $transactiontype = Transactiontype::where('id', $request['transactiontype_id'])->first();
        // $user = User::where('id', $request['user_id'])->first();
        // $product = Product::where('id', $request['product_id'])->first();
        // $status = Status::where('id', $request['status_id'])->first();
        $transaction = new Transaction;
        $transaction->uuid = (string) Str::uuid();
        $transaction->amount = $request['amount'];
        $transaction->price = $request['price'];
        $transaction->user_id = $request['user_id'];
        $transaction->transactiontype_id = $request['transactiontype_id'];
        $transaction->product_id = $request['product_id'];
        $transaction->status_id = $request['status_id'];
        $transaction->created_by = Config::get('apiuser');
        $transaction->save();
        // $transaction->transactiontype()
        //     ->attach($transactiontype->id, array(
        //         'transactiontype_id' => $transactiontype->id,
        //         'transaction_id' => $transaction->id,
        //         'uuid' => (string) Str::uuid()
        //     )
        // );
        // $transaction->user()
        //     ->attach($user->id, array(
        //         'user_id' => $user->id,
        //         'transaction_id' => $transaction->id,
        //         'uuid' => (string) Str::uuid()
        //     )
        // );
        // $transaction->product()
        //     ->attach($product->id, array(
        //         'product_id' => $product->id,
        //         'transaction_id' => $transaction->id,
        //         'uuid' => (string) Str::uuid()
        //     )
        // );
        // $transaction->status()
        //     ->attach($status->id, array(
        //         'status_id' => $status->id,
        //         'transaction_id' => $transaction->id,
        //         'uuid' => (string) Str::uuid()
        //     )
        // );
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 201);

        // return $transaction;
    }

    /**
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
