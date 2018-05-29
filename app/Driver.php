<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
    {
    protected $table = "drivers";
    protected $fillable = [
        'id_user', 'driver_status', 'latitude', 'longitude',
    ];

    public function DriverOnObject()
        {

        return $this->hasOne('App\DriverOnObject', 'id_driver', 'id_user');
        }

    public function User()
        {

        return $this->hasOne('App\User', 'id', 'id_user');
        }

    public function Orders()
        {

        return $this->hasMany('App\Order', 'id_driver', 'id_user');
        }

    }
