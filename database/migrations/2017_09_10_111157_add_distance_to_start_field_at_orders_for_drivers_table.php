<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistanceToStartFieldAtOrdersForDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('orders_for_drivers', function (Blueprint $table) {
            $table->decimal('distance_to_start', 8, 3)->nullable('true');
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('orders_for_drivers', function (Blueprint $table) {
            $table->dropColumn('distance_to_start');
        });
        }
}
