<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('post_id')->index()->nullable();
            $table->string('sub_name')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->double('width')->nullable();
            $table->string('width_unit')->nullable();
            $table->double('height')->nullable();
            $table->string('height_unit')->nullable();
            $table->double('depth')->nullable();
            $table->string('depth_unit')->nullable();
            $table->double('buy_price')->nullable();
            $table->string('buy_price_unit')->nullable();
            $table->integer('quantity');
            $table->boolean('active');
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
        Schema::dropIfExists('e_items');
    }
}
