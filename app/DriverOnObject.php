<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverOnObject extends Model
    {

    protected $table = "drivers_on_objects";
    protected $fillable = [
        'id', 'id_object', 'id_driver',
    ];

    public function Driver()
        {

        return $this->belongsTo('App\Driver', 'id_driver', 'id_user' );
        }

    public  function Object()
        {

        return $this->hasOne('App\Object', 'id', 'id_object');
        }

    }
