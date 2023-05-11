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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->id();
            $table->string('product_title');
            $table->string('product_price');
            $table->string('discount_price')->nullable();
            $table->string('product_image');
            $table->string('product_category_id')->nullable();
            $table->string('product_subcategory_id')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('remark')->nullable();
            $table->string('product_star')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_status')->default(1);
            $table->string('product_add_user')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('product_view')->nullable();
            $table->string('product_collection')->default(0);
            $table->string('Feature_product')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_lists');
    }
};
