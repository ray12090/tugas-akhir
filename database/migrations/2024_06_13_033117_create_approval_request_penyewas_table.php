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
        Schema::create('approval_request_penyewas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyewa_id');
            $table->varchar('status');
            $table->unsignedBigInteger('approved_by');
            $table->timestamps();

            $table->foreign('penyewa_id')->references('id')->on('peyewas')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_request_penyewas');
    }
};
