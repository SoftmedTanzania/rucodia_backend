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
use App\User;

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
        return TransactionResource::collection(Transaction::with('transactiontype')
            ->with('user')
            ->with('product')
            ->with('status')
            ->get());
    }


    /**
     * Add Transaction
     * 
     * Store a newly created resource in transaction storage.
     * Update the count of the specific product for a specific user in Balances
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $balance = Balance::where('user_id', $request['user_id'])->where('product_id', $request['product_id'])->first();
        if ($request['transactiontype_id'] == 1) {
            $transaction = new Transaction;
            $transaction->uuid = (string) Str::uuid();
            $transaction->amount = $request['amount'];
            $transaction->price = $request['price'];
            $transaction->transactiontype_id = $request['transactiontype_id'];
            $transaction->user_id = $request['user_id'];
            $transaction->product_id = $request['product_id'];
            $transaction->status_id = 1;
            $transaction->created_by = Config::get('apiuser');
            $transaction->save();

            if(empty($balance)){
                $balance = new Balance;
                $balance->uuid = (string) Str::uuid();
                $balance->count = $request['amount'];
                $balance->user_id = $request['user_id'];
                $balance->product_id = $request['product_id'];
                $balance->buying_price = $request['price'];
                $balance->selling_price = $request['price'];
                $balance->created_by = Config::get('apiuser');
                $balance->save();
            }
            else{
                $balance->count = $balance->count + $request['amount'];
                $balance->buying_price =  $request['price'];
                $balance->save();
            }
        }
        elseif ($request['transactiontype_id'] == 2) {
            if(empty($balance)){
                return response()->json(['error' => 'This user does not have this product'], 400);
            }
            elseif ($request['amount'] > $balance->count) {
                return response()->json(['error' => 'This user has has less than the requested amount.', 'balance' => $balance->count], 400);
            }
            else{
                $transaction = new Transaction;
                $transaction->uuid = (string) Str::uuid();
                $transaction->amount = $request['amount'];
                $transaction->price = $request['price'];
                $transaction->transactiontype_id = $request['transactiontype_id'];
                $transaction->user_id = $request['user_id'];
                $transaction->product_id = $request['product_id'];
                $transaction->status_id = 1;
                $transaction->created_by = Config::get('apiuser');
                $transaction->save();

                $balance->count = $balance->count - $request['amount'];
                $balance->selling_price = $request['price'];
                $balance->save();
            }
        }
        else{
            return response()->json(['error' => 'Unknown transaction type'], 404);
        }

        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $transaction->uuid,
            'type' => 'transaction',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Show a single Transaction by using its ID
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

        $transaction->status_id = 1;
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
