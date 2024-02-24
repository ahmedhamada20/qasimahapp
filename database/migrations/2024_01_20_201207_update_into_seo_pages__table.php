<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('seo_pages',function (Blueprint $table) {
            $table->string('banner')->nullable();
            $table->text('editor_section')->nullable();
        });

        Schema::table('settings',function (Blueprint $table) {
            $table->string('site_banner')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
