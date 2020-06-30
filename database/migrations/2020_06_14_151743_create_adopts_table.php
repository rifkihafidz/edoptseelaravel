<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_owner');
            $table->integer('id_adopter');
            $table->integer('id_post');
            $table->integer('id_application');
            $table->date('adoptedat');
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
        Schema::dropIfExists('adopts');
    }
}
