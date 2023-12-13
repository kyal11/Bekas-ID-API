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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('seller_id')->nullable(false);
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->text('review');
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('user_id')->on('User')->references('id');
            $table->foreign('seller_id')->on('User')->references('id');
            $table->foreign('product_id')->on('product')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
