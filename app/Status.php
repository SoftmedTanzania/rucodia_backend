<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name',
    ];
    
    /**
     * Get the order where the status belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function statuses()
    {
        return $this
            ->hasMany('App\Order');
    }

    /**
     * Get the transaction where the status belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function transactions()
    {
        return $this
            ->hasMany('App\Transaction');
    }
}
