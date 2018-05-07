<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesTable extends Migration
{
    public function up()
    {

        Schema::create('factions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('faction_name');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name');
            $table->integer('starting_faction');
            $table->boolean('mystic')->default(0);
            $table->boolean('corrupt')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('roles');
        Schema::drop('factions');
    }
}
