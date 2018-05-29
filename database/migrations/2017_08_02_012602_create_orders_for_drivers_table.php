<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersForDriversTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('orders_for_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_driver', false, true);
            $table->integer('id_order', false, true);
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
        Schema::dropIfExists('orders_for_drivers');
        }

    }
