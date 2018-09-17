<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Location;
use App\Ward;
use App\Transaction;
use App\Sms;
use App\District;
use App\Product;
use App\Subcategory;
use App\Balance;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UserController extends Controller
{
    // /**
    //  * A Construct setting up User and Response
    //  * 
    //  * @return NULL
    //  */
    public function __construct(Request $request, User $user) {
        $this->request = $request;
        $this->user = $user;
    }

    
    /**
     * List Users
     * 
     * JSON List of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List all the users in a collection
        UserResource::WithoutWrapping();
        return UserResource::collection(User::with('levels')->with('locations')->with('wards')->get());
    }

    /**
     * Add User
     * 
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all the details for User creation
        $level = Level::where('name', $request['level'])->first();
        $location = Location::where('name', $request['location'])->first();
        $location = Ward::where('name', $request['ward'])->first();
        $user = new User;
        $user->uuid = (string) Str::uuid();
        $user->firstname = $request['firstname'];
        $user->middlename = $request['middlename'];
        $user->surname = $request['surname'];
        $user->phone = $request['phone'];
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->created_by = Config::get('apiuser');
        $user->save();
        $user->levels()->attach($level->id, array('level_id' => $level->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        $user->locations()->attach($location->id, array('location_id' => $location->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        $user->wards()->attach($ward->id, array('ward_id' => $ward->id, 'user_id' => $user->id, 'uuid' => (string) Str::uuid()));
        return response()->json([
            'action' => 'create',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 201);
    }

    /**
     * Update User
     * 
     * Edit an existing User details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // Check if user is not in the DB
        if ($user === null) {
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
        UserResource::WithoutWrapping();
        return new UserResource(User::with('levels')->with('locations')->with('wards')->find($id));
        }
    }

    /**
     * Update User
     * 
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update the resource with the addressed ID
        $level = Level::where('name', $request['level'])->first();
        $level_uuid = DB::table('level_user')->where('user_id', $id)->value('uuid');
        $level_id = DB::table('level_user')->where('user_id', $id)->value('id');
        $location = Location::where('name', $request['location'])->first();
        $location_uuid = DB::table('location_user')->where('user_id', $id)->value('uuid');
        $location_id = DB::table('location_user')->where('user_id', $id)->value('id');
        $ward = Ward::where('name', $request['ward'])->first();
        $ward_uuid = DB::table('user_ward')->where('user_id', $id)->value('uuid');
        $ward_id = DB::table('user_ward')->where('user_id', $id)->value('id');

        $user = User::find($id);
        $user->firstname = $request['firstname'];
        $user->middlename = $request['middlename'];
        $user->surname = $request['surname'];
        $user->phone = $request['phone'];
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->updated_by = Config::get('apiuser');
        $user->levels()->sync($level->id);
        $user->levels()->updateExistingPivot($level->id, array('uuid' => $level_uuid, 'id' => $level_id));
        $user->locations()->sync($location->id);
        $user->locations()->updateExistingPivot($location->id, array('uuid' => $location_uuid, 'id' => $location_id));
        $user->wards()->sync($ward->id);
        $user->wards()->updateExistingPivot($ward->id, array('uuid' => $ward_uuid, 'id' => $ward_id));
        $user->save();
        return response()->json([
            'action' => 'update',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Delete User
     * 
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific User by ID (Soft-Deletes)
        $user = User::find($id);
        $user->update(['deleted_by' => Config::get('apiuser')]);
        $user->delete();
        return response()->json([
            'action' => 'delete',
            'status' => 'OK',
            'entity' => $user->uuid,
            'type' => 'user',
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**Show Auth Details
     * 
     * Get the auth page then send back user details
     * 
     * @return \Ilumminate\Http\Response
     */
    public function auth()
    {
        $user = User::where('id', Config::get('apiuser'))->with('levels')->with('locations')->with('wards')->get();
        return response()->json($user);
    }

    /**
     * Show Product Balances
     * 
     * Specific user product details such as Totals, Cash, Balances and Profit.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userBalance($user_id, $product_id)
    {
        $user = User::find($user_id);
        $totalBought = Transaction::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('transactiontype_id', 1)
            ->sum('amount');
        $totalSold = Transaction::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('transactiontype_id', 2)
            ->sum('amount');
        $expenditure = DB::table('transactions')
            ->selectRaw('SUM(price * amount) AS price')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('transactiontype_id', 1)
            ->value('price');
        $revenues = DB::table('transactions')
            ->selectRaw('SUM(price * amount) AS price')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('transactiontype_id', 2)
            ->value('price');
        $profit = $revenues - $expenditure;
        $balance = $totalBought - $totalSold;
            return response()->json([
                'action' => 'balance',
                'status' => 'OK',
                'entity' => $user->uuid,
                'type' => 'user',
                'product' => (int)$product_id,
                'bought' => (int)$totalBought,
                'sold' => (int)$totalSold,
                'balance' => $balance,
                'expenditure' => (int)$expenditure,
                'revenues' => (int)$revenues,
                'profit' => $profit,
                'user' => Config::get('apiuser')
            ], 200);
    }

    /**
     * Show Product Balances
     * 
     * Specific user product details such as Totals, Cash, Balances and Profit.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userBalances($user)
    {
        $user = User::find($user);
        $products = Transaction::where('user_id', $user->id)
            ->addSelect(
                DB::raw('
                    product_id,
                    CAST(SUM(CASE transactiontype_id WHEN 1 THEN amount ELSE 0 END) as signed) AS product_bought,
                    CAST(SUM(CASE transactiontype_id WHEN 2 THEN amount ELSE 0 END) as signed) AS product_sold,
                    CAST(SUM(CASE transactiontype_id WHEN 1 THEN amount WHEN 2 THEN -amount ELSE 0 END) AS SIGNED) AS product_balance,
                    COUNT(CASE transactiontype_id WHEN 1 THEN id END) AS product_purchases,
                    COUNT(CASE transactiontype_id WHEN 2 THEN id END) AS product_sales,
                    CAST(SUM(CASE transactiontype_id WHEN 1 THEN amount * price ELSE 0 END) as signed) AS product_expenditure,
                    CAST(SUM(CASE transactiontype_id WHEN 2 THEN amount * price ELSE 0 END) as signed) AS product_revenue,
                    CAST(SUM(CASE transactiontype_id WHEN 1 THEN amount * -price WHEN 2 THEN amount * price ELSE 0 END) as signed) AS product_profit                   
                    '))
            ->orderBy('created_at', 'DESC')
            ->groupBy('product_id')
            ->get();
        
        $prices = Transaction::where('user_id', $user->id)
                ->addSelect(DB::raw('
                    product_id, MAX(id) AS id,
                    CASE transactiontype_id WHEN 1 THEN price ELSE 0 END AS buying_price,
                    CASE transactiontype_id WHEN 2 THEN price ELSE 0 END AS selling_price
                '))
                ->orderBy('id', 'DESC')
                ->groupBy('transactiontype_id', 'product_id')
                ->get();

            return response()->json([
                'action' => 'user_products',
                'status' => 'OK',
                'entity' => $user->uuid,
                'type' => 'user',
                'products' => $products,
                'prices' => $prices,
                'user' => Config::get('apiuser')
            ], 200);
    }

    /**
     * Add User
     * 
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sms(Request $request)
    {

        $data = $request->input('input.urn');
        $sms = new Sms;
        $sms->uuid = (string) Str::uuid();
        $sms->urn = $request->input('input.urn');
        $sms->text = strtolower($request->input('input.text'));
        $sms->save();
        $text_array = explode(' ', $sms->text);
        if (str_word_count($sms->text) == 3) {
            $district = $text_array[2];
            $district = District::where('name', $district)->first();
            $product = $text_array[1];
            $product = Subcategory::where('name', $product)->first();
            $agrodealers = DB::select(DB::raw ("
                select distinct users.firstname as name, MAX(transactions.price) as price from transactions 
                inner join users on users.id = transactions.user_id 
                inner join products on products.id = transactions.product_id 
                inner join transactiontypes on transactiontypes.id = 1 
                inner join product_subcategory on product_subcategory.product_id = products.id
                inner join subcategories on product_subcategory.subcategory_id = subcategories.id
                inner join user_ward on user_ward.user_id = users.id 
                inner join wards on wards.id = user_ward.ward_id
                inner join districts on wards.district_id = districts.id
                where districts.id = ".$district->id."
                AND subcategories.id = ".$product->id."
                group by users.firstname;
            "));

            $agrodealers = json_decode(json_encode($agrodealers), true);
            $result = array();
            foreach($agrodealers as $key=> $val)
            {
            $result[] = $val['name'].':'.$val['price'];
            }

            $uri = "https://api.textit.in/api/v2/broadcasts.json";
            $urn = $sms->urn;
            $text = $product->name." > ". implode(', ', $result);            
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->request(
                'POST',
                'https://api.textit.in/api/v2/broadcasts.json',
                [
                'headers' => [
                    'Authorization' => 'Token ff3c9c1b920aa755f9dbcb6f83bab52c1fa27689',
                    'Accept'     => 'application/json',
                    ],

                'json' => [
                    'urns' => [$urn],
                    'text' => $text
                    ]
                ]);
            return response()->json([
                'agrodealers' => $agrodealers,
                'district' => $district,
                'product' => $product,
                'sender' => $urn,
                'text' => $text,
                'user' => Config::get('apiuser')
                ], 200);
            
        }
        else {
            return response()->json([
                'error' => 'kuna error mahali'
            ], 500);
        }
        
    }

    /**
     * Show User Balances for a specific product
     * 
     * Specific product balance details for each user.
     * 
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function productUsers($product)
    {
        $product = Product::find($product);
        $balances = Balance::where('product_id', $product->id)
            ->get(['user_id', 'count']);
        $buying_prices = Transaction::where('product_id', $product->id)
            ->where('transactiontype_id', 1)
            ->groupBy('user_id')
            ->get(['user_id', 'price']);
        $selling_prices = Transaction::where('product_id', $product->id)
            ->where('transactiontype_id', 2)
            ->groupBy('user_id')
            ->get(['user_id', 'price']);     
        return response()->json([
            'action' => 'product_users',
            'status' => 'OK',
            'entity' => $product->uuid,
            'type' => 'product',
            'balances' => $balances,
            'buying_prices' => $buying_prices,
            'selling_prices' => $selling_prices,
            'user' => Config::get('apiuser')
        ], 200);
    }

    /**
     * Gets the messages(SMSs) sent by SMSsync as a POST request.
     *
     */
    function get_message()
    {
        $error = NULL;
        // Set success to false as the default success status
        $success = false;
        /**
         *  Get the phone number that sent the SMS.
         */
        if (isset($_POST['from']))
        {
            $from = $_POST['from'];
        }
        else
        {
            $error = 'The from variable was not set';
        }
        /**
         * Get the SMS aka the message sent.
         */
        if (isset($_POST['message']))
        {
            $message = $_POST['message'];
        }
        else
        {
            $error = 'The message variable was not set';
        }
        /**
         * Get the secret key set on SMSsync side
         * for matching on the server side.
         */
        if (isset($_POST['secret']))
        {
            $secret = $_POST['secret'];
        }
        /**
         * Get the timestamp of the SMS
         */
        if(isset($_POST['sent_timestamp']))
        {
            $sent_timestamp = $_POST['sent_timestamp'];
        }
        /**
         * Get the phone number of the device SMSsync is
         * installed on.
         */
        if (isset($_POST['sent_to']))
        {
            $sent_to = $_POST['sent_to'];
        }
        /**
         * Get the unique message id
         */
        if (isset($_POST['message_id']))
        {
            $message_id = $_POST['message_id'];
        }
        /**
         * Get device ID
         */
        if (isset($_POST['device_id']))
        {
            $device_id = $_POST['device_id'];
        }
        /**
         * Now we have retrieved the data sent over by SMSsync
         * via HTTP. Next thing to do is to do something with
         * the data. Either echo it or write it to a file or even
         * store it in a database. This is entirely up to you.
         * After, return a JSON string back to SMSsync to know
         * if the web service received the message successfully or not.
         *
         * In this demo, we are just going to save the data
         * received into a text file.
         *
         */
        if ((strlen($from) > 0) AND (strlen($message) > 0) AND
            (strlen($sent_timestamp) > 0 )
            AND (strlen($message_id) > 0))
        {
            /* The screte key set here is 123456. Make sure you enter
            * that on SMSsync.
            */
            if ( ( $secret == '123456'))
            {
                $success = true;
            } else
            {
                $error = "The secret value sent from the device does not match the one on the server";
            }
            // now let's write the info sent by SMSsync
            //to a file called test.txt
            $string = "From: ".$from."\n";
            $string .= "Message: ".$message."\n";
            $string .= "Timestamp: ".$sent_timestamp."\n";
            $string .= "Messages Id:" .$message_id."\n";
            $string .= "Sent to: ".$sent_to."\n";
            $string .= "Device ID: ".$device_id."\n\n\n";
            write_message_to_file($string);
        }
        /**
         * Comment the code below out if you want to send an instant
         * reply as SMS to the user.
         *
         * This feature requires the "Get reply from server" checked on SMSsync.
         */
        send_instant_message($from);
        /**
         * Now send a JSON formatted string to SMSsync to
        * acknowledge that the web service received the message
        */
        $response = json_encode([
            "payload"=> [
                "success"=>$success,
                    "error" => $error
                ]
            ]);
        //send_response($response);
    }
    
    /**
     * Writes the received responses to a file. This acts as a database.
     */
    function write_message_to_file($message)
    {
        Storage::put('sms.txt', $message);
        // $myFile = "test.txt";
        // $fh = fopen($myFile, 'a') or die("can't open file");
        // @fwrite($fh, $message);
        // @fclose($fh);
    }
    
}
