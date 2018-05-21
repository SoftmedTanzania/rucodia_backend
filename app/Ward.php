<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;

class Ward extends Model
{
    /**
     * Fields that can be mass assignable
     * 
     * @return mixed
     */
    protected $fillable = [
        'uuid', 'name', 'deleted_by',
    ];
    
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
        return $this->belongsTo('App\District');
    }
}
