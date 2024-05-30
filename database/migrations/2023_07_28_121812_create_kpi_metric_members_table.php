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
        Schema::create('kpi_metric_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpi_metric_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->double('target');
            $table->double('timely_value', 10, 2);
            $table->timestamps();
            $table->foreign('kpi_metric_id')->references('id')->on('kpi_metrics')->onDelete('set null');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_metric_members');
    }
};
