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
        Schema::create('department_member', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('department_id')->constrained();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            // $table->foreignId('member_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_member');
    }
};
