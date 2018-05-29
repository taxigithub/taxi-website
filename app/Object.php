<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
    {

    protected $table = "objects";
    protected $fillable = [
        'name', 'description','address', 'id_price','driver_max_sum'
    ];
    public $timestamps = false;

    public function Price()
        {

        return $this->HasOne('App\Price', 'id', 'id_price');
        }

    }
