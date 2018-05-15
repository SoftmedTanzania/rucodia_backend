<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    /**
     * Fields that can be mass assignable
     * 
     * @return mixed
     */
    protected $fillable = [
        'uuid', 'buying_price', 'selling_price', 'count', 'user_id', 'transaction_id', 'product_id',
    ];

}
