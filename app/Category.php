<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
        'uuid', 'name', 'description',
    ];

    /**
     * Get the subcategories for specific category.
     */
    public function subcategories()
    {
        return $this->belongsToMany('App\Subcategory')->withTimestamps()->withPivot('uuid');
    }

    /**
     * Get the products for specific category.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps()->withPivot('uuid');
    }
}
