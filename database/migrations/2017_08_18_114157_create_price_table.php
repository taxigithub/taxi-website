<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
        {
        Schema::create('price', function (Blueprint $table) {
            $table->increments('id');
            $table->double('primary_price', 8, 3);
            $table->double('secondrary_price', 8, 3);
           
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
        Schema::dropIfExists('price');
        }
}
