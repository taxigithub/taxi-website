<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSosEmailFieldAtUsersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sos_email');
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
            $table->dropColumn('sos_email');
        });
        }

    }
