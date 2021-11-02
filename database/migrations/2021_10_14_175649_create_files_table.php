<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('post_id')->index()->nullable();
            $table->bigInteger('post_locale_id')->index()->nullable();
            $table->string('name');
            $table->string('alt');
            $table->string('path');
            $table->string('file_type');
            $table->string('type');
            $table->string('collection_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
