<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_locales', function (Blueprint $table) {
            $table->id();
            $table->string('locale_name');
            $table->string('version_name')->default('main');
            $table->string('post_id')->index();
            $table->string('post_title')->nullable();
            $table->string('post_slug')->nullable();
            $table->longText('post_teaser')->nullable();
            $table->boolean('post_custom_teaser')->nullable();
            $table->longText('post_value')->nullable();
            $table->string('post_seo_title')->nullable();
            $table->string('post_seo_description')->nullable();
            $table->string('post_seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_locales');
    }
}
