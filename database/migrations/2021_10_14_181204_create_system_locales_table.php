<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_locales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->string('lang');
            $table->string('lang_label');
            $table->string('currency_label')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->boolean('default');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_locales');
    }
}
