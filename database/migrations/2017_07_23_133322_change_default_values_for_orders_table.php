<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValuesForOrdersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('id_driver', false, true)->nullable(true)->change();
            $table->integer('price', false, true)->nullable(true)->change();
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('id_driver', false, true)->nullable(false)->change();
            $table->integer('price', false, true)->nullable(false)->change();
        });
        }

    }
