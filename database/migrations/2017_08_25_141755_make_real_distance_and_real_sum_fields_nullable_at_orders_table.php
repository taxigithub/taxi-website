<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRealDistanceAndRealSumFieldsNullableAtOrdersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('real_sum')->nullable(true)->change();
            $table->string('real_distance')->nullable(true)->change();
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
            $table->string('real_sum')->nullable(false)->change();
            $table->string('real_distance')->nullable(false)->change();
        });
        }

    }
