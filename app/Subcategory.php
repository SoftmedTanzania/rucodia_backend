<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
    ];

    /**
     * Get the products for specific subcategory.
     */
    public function products()
    {
        return $this
            ->belongsToMany('App\Product')
            ->withTimestamps()
            ->withPivot('uuid');
    }

    public function category()
    {
        return $this
            ->belongsToMany('App\Category')
            ->withTimestamps()
            ->withPivot('uuid');
    }
}
