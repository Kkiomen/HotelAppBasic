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
        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('product_id')->nullable();
            $table->string('imageUrl')->nullable();
            $table->boolean('accepted')->nullable()->default(null);
            $table->string('subject')->nullable();
            $table->string('product_name')->nullable();
            $table->string('category')->nullable();
            $table->text('attributes')->nullable();
            $table->string('target_audience')->nullable();
            $table->text('keywords')->nullable();
            $table->text('keywords_seo')->nullable();
            $table->boolean('use_html')->default(false);
            $table->text('style_and_tone')->nullable();
            $table->text('limitations')->nullable();
            $table->text('material')->nullable();
            $table->string('warranty')->nullable();
            $table->text('unique_features')->nullable();
            $table->text('description')->nullable();
            $table->text('generated_prompt')->nullable();
            $table->text('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_descriptions');
    }
};
