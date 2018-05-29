<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSosEmailFieldNullableAtUsersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sos_email')->nullable(true)->change();
        });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sos_email')->nullable(false)->change();
        });
        }

    }
