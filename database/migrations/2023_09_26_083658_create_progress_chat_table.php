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
        Schema::create('progress_chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progress_id');
            $table->unsignedBigInteger('sender_id');
            // $table->unsignedBigInteger('recipient_id');
            $table->text('message');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('progress_id')->references('id')->on('progress')->onDelete('cascade');
            // Define foreign key constraints for sender and recipient
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_chat');
    }
};
