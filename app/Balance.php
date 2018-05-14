<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'uuid', 'user_id', 'product_id','buying_price', 'selling_price', 'count',
    ];

}
