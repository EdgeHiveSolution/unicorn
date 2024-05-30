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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpi_metric_member_id')->nullable();
            $table->unsignedBigInteger('kpi_metric_id')->nullable();
            $table->unsignedBigInteger('kpi_id')->nullable();
            $table->string('title');
            $table->string('notes');
            $table->double('current_value');
            $table->double('target_value', 10, 2);
            $table->timestamps();
            $table->foreign('kpi_metric_member_id')->references('id')->on('kpi_metric_members')->onDelete('set null');
            $table->foreign('kpi_metric_id')->references('id')->on('kpi_metrics')->onDelete('set null');
            $table->foreign('kpi_id')->references('id')->on('kpis')->onDelete('set null');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
