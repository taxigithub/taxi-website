<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSosSignalToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
        {
        Schema::create('sos_signal_to_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order', false, true);
            $table->integer('id_sos_status', false, true);
            $table->timestamps();
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::dropIfExists('sos_signal_to_order');
        }
}
