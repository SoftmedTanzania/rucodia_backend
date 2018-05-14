<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the user for specific order.
     */
    public function users()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }

    /**
     * Get the product for specific order.
     */
    public function products()
    {
        return $this->belongsTo('App\Product')->withTimestamps();
    }
}
