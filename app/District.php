<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
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
