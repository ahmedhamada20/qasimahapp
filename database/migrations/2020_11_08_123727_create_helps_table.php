<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHelpsTable extends Migration {

	public function up()
	{
		Schema::create('helps', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('address', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->text('message')->nullable();
			$table->string('brand', 191)->nullable();
			$table->string('coupon', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('helps');
	}
}