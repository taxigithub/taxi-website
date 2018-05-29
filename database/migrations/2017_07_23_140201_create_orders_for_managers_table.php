<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersForManagersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('orders_for_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_manager', false, true);
            $table->integer('id_object', false, true);
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::dropIfExists('orders_for_managers');
        }

    }
