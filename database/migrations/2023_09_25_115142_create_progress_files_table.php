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
        Schema::create('progress_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('progress_id'); // Foreign key reference to the progress update
            $table->json('file_paths')->nullable(); // JSON column to store file paths
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('progress_id')->references('id')->on('progress')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_files');
    }
};
