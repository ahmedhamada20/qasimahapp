<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuggestedCouponsTable extends Migration {

	public function up()
	{
		Schema::create('suggested_coupons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('full_name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('whatsapp', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('coupon_code', 191)->nullable();
			$table->string('brand')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('suggested_coupons');
	}
}