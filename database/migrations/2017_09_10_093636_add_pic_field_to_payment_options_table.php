<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPicFieldToPaymentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
        {
        Schema::table('payment_options', function (Blueprint $table) {
            $table->string('pic')->nullable('true');
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('payment_options', function (Blueprint $table) {
            $table->dropColumn('pic');
        });
        }
}
