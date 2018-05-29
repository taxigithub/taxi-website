<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user', false, true);
            $table->integer('id_driver', false, true);
            $table->integer('autochoose', false, true);
            $table->double('distance', 8, 8);
            $table->double('price', 8, 8);
            $table->string('start_latitude');
            $table->string('start_longitude');
            $table->string('end_latitude');
            $table->string('end_longitude');
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
        Schema::dropIfExists('orders');
        }

    }
