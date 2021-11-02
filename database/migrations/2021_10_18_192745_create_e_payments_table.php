<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->double('price');
            $table->double('price_VAT');
            $table->boolean('active');
            $table->string('locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_payments');
    }
}
