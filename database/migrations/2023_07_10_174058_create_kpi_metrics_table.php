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
        Schema::create('kpi_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('response_period');
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->foreignId('kpi_id')->constrained()->onDelete('cascade');
            $table->string('on_track_value');
            $table->string('off_track_min');
            $table->string('off_track_max');
            $table->string('at_risk_min');
            $table->string('at_risk_max');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_metrics');
    }
};
