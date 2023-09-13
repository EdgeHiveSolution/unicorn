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
            $table->unsignedBigInteger('metric_id')->nullable();
            $table->string('title');
            $table->string('type');
            $table->string('target');
            $table->string('response_period');
            // $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->foreignId('kpi_id')->constrained()->onDelete('cascade');
            $table->double('timely_value', 10, 2)->nullable();
            $table->string('on_track_value');
            $table->string('off_track_min');
            $table->string('off_track_max');
            $table->string('at_risk_min');
            $table->string('at_risk_max');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('metric_id')->references('id')->on('metrics');



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
