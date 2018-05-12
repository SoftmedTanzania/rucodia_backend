<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'price', 'description', 'created_by'
    ];

    /**
     * Get the subcategory for specific product.
     */
    public function subcategories()
    {
        return $this->belongsToMany('App\Subcategory')->withTimestamps()->withPivot('uuid');
    }
    
    /**
     * Get the unit for specific product.
     */
    public function units()
    {
        return $this->belongsToMany('App\Unit')->withTimestamps()->withPivot('uuid');
    }
}
