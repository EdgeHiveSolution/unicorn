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
        Schema::create('department_partner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->string('role')->nullable(); 
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('set null');


           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_partner');
    }
};
