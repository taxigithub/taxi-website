<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversLocationsTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('drivers_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_driver', false, true);
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('drivers_locations');
        }

    }
