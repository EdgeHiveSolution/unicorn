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
        Schema::create('kpi_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpi_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kpi_id')->references('id')->on('kpis')->onDelete('set null');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_members');
    }
};
