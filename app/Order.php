<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the dealer for specific order.
     */
    public function dealer()
    {
        return $this->belongsTo('App\User', 'dealer_id', 'id');
    }

    /**
     * Get the supplier for specific order.
     */
    public function supplier()
    {
        return $this->belongsTo('App\User', 'supplier_id', 'id');
    }

    /**
     * Get the product for specific order.
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
