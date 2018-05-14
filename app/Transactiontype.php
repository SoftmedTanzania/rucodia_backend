<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactiontype extends Model
{
    /**
     * Get the type to which the transaction belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function transactions()
    {
        return $this
            ->hasMany('App\Transactions');
    }
}
