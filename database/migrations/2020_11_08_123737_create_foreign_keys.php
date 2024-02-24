<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brands')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('favourite_items', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('favourite_items', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('used_coupons', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('used_coupons', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('coupons_reviews', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('coupons_reviews', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_brand_id_foreign');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_category_id_foreign');
		});
		Schema::table('favourite_items', function(Blueprint $table) {
			$table->dropForeign('favourite_items_user_id_foreign');
		});
		Schema::table('favourite_items', function(Blueprint $table) {
			$table->dropForeign('favourite_items_item_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_user_id_foreign');
		});
		Schema::table('used_coupons', function(Blueprint $table) {
			$table->dropForeign('used_coupons_user_id_foreign');
		});
		Schema::table('used_coupons', function(Blueprint $table) {
			$table->dropForeign('used_coupons_item_id_foreign');
		});
		Schema::table('coupons_reviews', function(Blueprint $table) {
			$table->dropForeign('coupons_reviews_user_id_foreign');
		});
		Schema::table('coupons_reviews', function(Blueprint $table) {
			$table->dropForeign('coupons_reviews_item_id_foreign');
		});
	}
}