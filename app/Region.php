<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
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
     * Get the districts for the region.
     */
    public function districts()
    {
        return $this->hasMany('App\District');
    }

    /**
     * Get all of the wards for the region.
     */
    public function wards()
    {
        return $this->hasManyThrough('App\Ward', 'App\District');
    }
}
