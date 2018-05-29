<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartAddressAndEndAddressFieldsAtOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
        {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('start_address')->nullable('true');
            $table->string('end_address')->nullable('true');
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
            $table->dropColumn('start_address');
            $table->dropColumn('end_address');
        });
        }
}
