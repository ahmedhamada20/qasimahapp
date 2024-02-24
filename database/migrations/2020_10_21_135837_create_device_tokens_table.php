<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceTokensTable extends Migration
{

    public function up()
    {
        Schema::create('device_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('token', 191)->nullable();
            $table->enum('status', array('connected', 'disconnected'))->nullable();
            $table->enum('device_type', array('ios', 'android'))->nullable();
            $table->enum('device_language', array('ar', 'en'))->nullable();
        });
    }

    public function down()
    {
        Schema::drop('device_tokens');
    }
}
