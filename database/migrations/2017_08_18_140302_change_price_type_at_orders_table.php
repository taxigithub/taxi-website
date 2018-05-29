<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePriceTypeAtOrdersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('price', 8, 3)->change();
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
            $table->integer('price', false, true)->nullable(false)->change();
        });
        }

    }
