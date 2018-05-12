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
        return $this->belongsTo('App\User');
    }
}
