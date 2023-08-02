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
        Schema::create('member_partner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('member_id')->constrained();
            $table->foreignId('partner_id')->constrained();
            $table->string('role')->nullable();
            $table->foreignId('kpi_id')->nullable()->constrained(); // Add foreign key for kpi_id
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_partner');
    }
};
