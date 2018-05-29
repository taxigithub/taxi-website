<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderForDriver extends Model
    {

    protected $table = "orders_for_drivers";
    protected $fillable = [
        'id_order', 'id_driver', 'distance_to_start',
    ];

    public function Driver()
        {

        return $this->hasOne('App\Driver', 'id_user', 'id_driver');
        }

    public function Orders()
        {

        return $this->hasOne('App\Order', 'id', 'id_order');
        }

    }
