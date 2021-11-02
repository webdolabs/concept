<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('submited')->default(0);
            $table->string('email')->nullable();
            $table->string('locale');
            $table->double('items_total')->nullable();
            $table->double('items_total_VAT')->nullable();
            $table->string('currency_symbol');
            $table->string('status');
            $table->string('delivery_number')->nullable();
            $table->string('billing_number')->nullable();
            $table->bigInteger('shipping_address_id')->index()->nullable();
            $table->bigInteger('billing_address_id')->index()->nullable();
            $table->string('shipping_price_VAT')->nullable();
            $table->string('shipping_type')->nullable();
            $table->bigInteger('shipping_id')->index()->nullable();
            $table->boolean('payment_waiting')->default(0);
            $table->string('payment_price_VAT')->nullable();
            $table->string('payment_type')->nullable();
            $table->bigInteger('payment_id')->index()->nullable();
            $table->longText('customer_note')->nullable();
            $table->longText('admin_note')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->timestamp('admin_updated_at')->nullable();
            $table->timestamp('submited_at')->nullable();
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
        Schema::dropIfExists('e_orders');
    }
}
