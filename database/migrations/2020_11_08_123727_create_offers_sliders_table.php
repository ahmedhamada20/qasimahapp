<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersSlidersTable extends Migration {

	public function up()
	{
		Schema::create('offers_sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('discount_code', 191)->nullable();
			$table->string('image', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('offers_sliders');
	}
}