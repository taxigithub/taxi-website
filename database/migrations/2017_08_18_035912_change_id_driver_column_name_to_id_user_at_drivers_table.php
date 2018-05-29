<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdDriverColumnNameToIdUserAtDriversTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('drivers', function (Blueprint $table) {
            $table->renameColumn('id_driver', 'id_user');
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('drivers', function (Blueprint $table) {
            $table->renameColumn('id_user', 'id_driver');
        });
        }

    }
