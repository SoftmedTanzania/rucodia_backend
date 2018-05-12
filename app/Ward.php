<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    /**
     * Get the users for the ward.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    /**
     * Get the district that owns the ward.
     */
    public function district()
    {
        return $this->belongsTo('App\District')
            ->withTimestamps()
            ->withPivot('uuid');
    }
}
