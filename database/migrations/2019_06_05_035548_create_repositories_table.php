<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('name');
            $table->string('owner');
            $table->string('avatar')->nullable();
            $table->string('url');
            $table->integer('stars')->unsigned();
            $table->integer('forks')->unsigned();
            $table->integer('language_id');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}
