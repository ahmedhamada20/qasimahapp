<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsReviewsTable extends Migration {

	public function up()
	{
		Schema::create('coupons_reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->enum('status', array('good', 'bad'))->nullable();
		});
	}

	public function down()
	{
		Schema::drop('coupons_reviews');
	}
}