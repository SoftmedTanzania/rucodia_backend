<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * Get the wards for the district.
     */
    public function wards()
    {
        return $this->hasMany('App\Ward');
    }

    /**
     * Get the region that owns the district.
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }
}
