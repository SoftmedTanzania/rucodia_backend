<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Level;
use App\Location;

/**
 * User Model
 * 
 * @category  API
 * @package   RUCODIA_API
 * @author    Kizito <kizito@gmail.com>
 * @copyright 2018 - sOFTMED
 * @license   https://opensource.org/licenses/MIT  MIT License
 * @version   Release: @0.1@
 * @link      http://softmed.co.tz/rucodia
 */
class User extends Authenticatable
{
    use Notifiable;
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
        'uuid', 'firstname', 'middlename', 'surname', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the level where the user belongs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function levels()
    {
        return $this
            ->belongsToMany('App\Level')
            ->withTimestamps()
            ->withPivot('uuid');
    }
    
    /**
     * Get the loactions that owns the ward.
     * 
     * @return \Illuminate\Http\Response
     */
    public function locations()
    {
        return $this
            ->belongsToMany('App\Location')
            ->withTimestamps()
            ->withPivot('uuid');
    }

    /**
     * Get the district that owns the ward.
     * 
     * @return \Illuminate\Http\Response
     */
    public function wards()
    {
        return $this->
            belongsToMany('App\Ward');
    }
}