<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderForManager extends Model
    {

    protected $table = "orders_for_managers";
    protected $fillable = [
        'id_order', 'id_manager'
    ];

    public function Managers()
        {

        return $this->hasOne('App\Manager', 'id_user', 'id_manager' );
        }

    public  function Orders()
        {

        return $this->belongsTo('App\Order', 'id_order', 'id');
        }

    }
