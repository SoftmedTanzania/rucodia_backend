<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms';
    
    
    /**
     * Fields that can be mass assignable
     * 
     * @return mixed
     */
    protected $fillable = [
        'uuid', 'urn', 'text',
    ];
}
