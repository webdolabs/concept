<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('post_id')->index()->nullable();
            $table->bigInteger('post_locale_id')->nullable();
            $table->string('collection_global_name');
            $table->string('name');
            $table->longText('value');
            $table->integer('parent_id')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('tmp');
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_attributes');
    }
}
