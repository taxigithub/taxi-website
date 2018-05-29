<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDriverMaxSumAtObjectsTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('objects', function (Blueprint $table) {
            $table->string('driver_max_sum');
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('driver_max_sum');
        });
        }

    }
