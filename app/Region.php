<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
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
