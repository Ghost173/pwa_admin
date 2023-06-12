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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('category_image');
            $table->string('category_image_s3_location')->nullable();
            $table->string('category_icon')->nullable();
            $table->string('category_icon_s3_location')->nullable();
            $table->string('created_user')->nullable();
            $table->timestamps();
        });
        // DB::table('site_infos')->insert(
        //     array(
        //        'category_name' => 'Sarees',
        //        'category_image' => ''
        //     )
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
