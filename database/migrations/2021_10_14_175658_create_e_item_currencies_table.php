<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEItemCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_item_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('item_id')->index();
            $table->string('locale_name');
            $table->double('price');
            $table->double('price_VAT');
            $table->integer('VAT');
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
        Schema::dropIfExists('e_item_currencies');
    }
}
