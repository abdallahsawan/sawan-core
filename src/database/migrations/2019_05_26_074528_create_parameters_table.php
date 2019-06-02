<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('entity_type', 255);
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('last_modifier')->nullable();
            $table->foreign('creator')->references('id')->on('users');
            $table->foreign('last_modifier')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('code', 255);
            $table->string('value', 255)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
