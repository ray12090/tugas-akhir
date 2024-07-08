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
        Schema::create('penanganan_komplains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komplain_id');
            $table->text('respon')->nullable();
            $table->text('analisis_awal')->nullable();
            $table->text('keterangan_selesai')->nullable();
            $table->string('foto_analisis_awal')->nullable();
            $table->string('foto_hasil_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganan_komplains');
    }
};
