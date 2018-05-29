<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDriversOnObjects extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('drivers_on_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_driver', false, true);
            $table->integer('id_object', false, true);
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
        Schema::dropIfExists('drivers_on_objects');
        }

    }
