<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
    {

    protected $fillable = [
        'id', 'id_user', 'id_driver', 'autochoose', 'distance', 'price', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude', 'status', 'start_address', 'end_address', 'real_distance', 'real_sum', 'payment_type',
    ];

    public function User()
        {

        return $this->HasOne('App\User', 'id', 'id_user');
        }

    public function Driver()
        {

        return $this->HasOne('App\User', 'id', 'id_driver');
        }

    public function toDriver()
        {

        return $this->HasOne('App\Driver', 'id_user', 'id_driver');
        }

    public function Status()
        {

        return $this->HasOne('App\Status', 'id', 'status');
        }

    }
