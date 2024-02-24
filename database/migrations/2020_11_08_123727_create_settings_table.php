<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('mobile', 191)->nullable();
			$table->string('email', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}