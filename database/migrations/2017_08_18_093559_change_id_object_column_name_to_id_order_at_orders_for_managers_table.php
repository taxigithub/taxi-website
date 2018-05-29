<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdObjectColumnNameToIdOrderAtOrdersForManagersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('orders_for_managers', function (Blueprint $table) {
            $table->renameColumn('id_object', 'id_order');
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('orders_for_managers', function (Blueprint $table) {
            $table->renameColumn('id_order', 'id_object');
        });
        }

    }
