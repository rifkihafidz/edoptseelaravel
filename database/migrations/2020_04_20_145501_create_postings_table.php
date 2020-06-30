<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->string('owner');
            $table->string('img');
            $table->string('name');
            $table->string('age');
            $table->string('category');
            $table->string('size');
            $table->string('sex');
            $table->string('background');
            $table->string('description');
            $table->string('status');
            $table->string('medical')->nullable();
            $table->boolean('vaccinated')->nullable();
            $table->boolean('neutered')->nullable();
            $table->boolean('friendly')->nullable();
            $table->date('date');
            $table->string('location');
            $table->rememberToken();
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
        Schema::dropIfExists('postings');
    }
}
