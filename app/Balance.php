<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'uuid', 'buying_price', 'selling_price', 'count', 'user_id', 'transaction_id', 'product_id',
    ];

}
