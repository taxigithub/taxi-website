<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SosSignalToOrder extends Model
    {

    protected $table = "sos_signal_to_order";
    protected $fillable = [
        'id_order', 'id_sos_status'
    ];
    
      public function Order()
        {

        return $this->hasOne('App\Order', 'id', 'id_order');
        }


    }
