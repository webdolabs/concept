<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->index();
            $table->string('item_id')->index();
            $table->string('name')->nullable();
            $table->string('sub_name')->nullable();
            $table->double('price');
            $table->double('price_VAT');
            $table->integer('VAT');
            $table->integer('quantity');
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
        Schema::dropIfExists('e_order_items');
    }
}
