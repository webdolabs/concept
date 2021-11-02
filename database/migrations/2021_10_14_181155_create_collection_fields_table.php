<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('position')->nullable();
            $table->string('fieldtype');
            $table->string('table')->nullable();
            $table->integer('order');
            $table->bigInteger('parent_id')->index()->nullable();
            $table->bigInteger('collection_id')->index();
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
        Schema::dropIfExists('collection_fields');
    }
}
