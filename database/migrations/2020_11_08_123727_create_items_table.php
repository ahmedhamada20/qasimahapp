<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('brand_id')->unsigned()->nullable();
			$table->integer('category_id')->unsigned()->nullable();
			$table->string('discount_code', 191)->nullable();
			$table->json('description')->nullable();
			$table->text('url')->nullable();
			$table->integer('used_count')->nullable()->default(0);
			$table->timestamp('last_used')->nullable();
			$table->enum('offer', array('true', 'false'))->nullable();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}
