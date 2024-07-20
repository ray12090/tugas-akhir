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
        Schema::create('komplain_lokasi_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('komplain_id');
            $table->unsignedBigInteger('lokasi_komplain_id');
            $table->text('uraian_komplain')->nullable();
            $table->string('foto_komplain')->nullable();

            $table->foreign('komplain_id')->references('id')->on('komplains')->onDelete('cascade');
            $table->foreign('lokasi_komplain_id')->references('id')->on('lokasi_komplains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplain_lokasi_pivot');
    }
};
