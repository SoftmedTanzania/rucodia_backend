<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'price', 'amount', 'user_id', 'transactiontype_id', 'product_id', 'status_id',
    ];
    
    /**
     * Get the type to which the transaction belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function transactiontype()
    {
        return $this
            ->belongsTo('App\Transactiontype');
    }

    /**
     * Get the user where the transaction belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return $this
            ->belongsTo('App\User');
    }

    /**
     * Get the product where the transaction belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        return $this
            ->belongsTo('App\Product');
    }

    /**
     * Get the status where the transaction belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
        return $this
            ->belongsTo('App\Status');
    }
}
