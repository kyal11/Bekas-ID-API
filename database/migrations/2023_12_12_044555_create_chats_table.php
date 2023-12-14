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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('offer_id');
            $table->enum('sender_type',['user', 'seller']);
            $table->longText('chat');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('seller_id')->on('users')->references('id');
            $table->foreign('offer_id')->on('offers')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
