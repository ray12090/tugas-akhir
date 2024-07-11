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
        Schema::create('penanganans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komplain_id');
            $table->string('nomor_penanganan')->unique();
            $table->date('tanggal_laporan');
            $table->text('respon')->nullable();
            $table->text('pemeriksaan_awal')->nullable();
            $table->text('keterangan_selesai')->nullable();
            $table->string('foto_pemeriksaan_awal')->nullable();
            $table->string('foto_hasil_perbaikan')->nullable();
            $table->timestamps();

            $table->foreign('komplain_id')->references('id')->on('komplains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganans');
    }
};
