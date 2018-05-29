<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRoleFieldNullableAtUsersTable extends Migration
    {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role', false, true)->nullable(true)->change();
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
            $table->integer('role', false, true)->nullable(false)->change();
        });
        }

    }
