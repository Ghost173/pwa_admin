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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('image_one')->nullable();
            $table->string('image_one_s3')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_two_s3')->nullable();
            $table->string('image_three')->nullable();
            $table->string('image_three_s3')->nullable();
            $table->string('image_four')->nullable();
            $table->string('image_four_s3')->nullable();
            $table->string('product_short_description')->nullable();
            $table->string('product_long_description')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
