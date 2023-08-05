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
            $table->unsignedBigInteger('kpi_metric_id')->nullable();
            $table->string('title');
            $table->string('notes');
            $table->double('current_value');
            $table->double('target_value');
            $table->timestamps();
            $table->foreign('kpi_metric_id')->references('id')->on('kpi_metrics')->onDelete('set null');

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
