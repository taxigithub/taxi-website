<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
    {

    protected $table = "price";
    protected $fillable = [
        'primary_price', 'secondrary_price'
    ];

    
    
    }
