<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('order_id');
            $table->string('invoice_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_quantity');
            $table->string('product_unit_price');
            $table->string('product_total_price');
            $table->string('product_image')->nullable();
            $table->string('payment_method');
            $table->string('delivery_charge')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_time')->nullable();
            $table->string('order_status')->nullable();
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
