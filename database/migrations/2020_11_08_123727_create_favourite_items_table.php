<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavouriteItemsTable extends Migration {

	public function up()
	{
		Schema::create('favourite_items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('item_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('favourite_items');
	}
}