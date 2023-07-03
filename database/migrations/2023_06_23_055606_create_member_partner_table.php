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
        
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('partner_id');

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');

            $table->primary(['member_id', 'partner_id']);
            $table->timestamps();
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
