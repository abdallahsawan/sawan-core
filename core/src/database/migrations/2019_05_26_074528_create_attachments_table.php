<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('entity_type', 255);
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('last_modifier')->nullable();
            $table->foreign('creator')->references('id')->on('users');
            $table->foreign('last_modifier')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('extension', 10);
            $table->string('mime_type', 50);
            $table->double('size', 8, 2);
            $table->string('path', 1000);
            $table->string('tag', 255);
            $table->string('owner_type', 255)->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
