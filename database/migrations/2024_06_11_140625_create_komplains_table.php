<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('komplains', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->unique();
            $table->date('tanggal_laporan');
            $table->unsignedBigInteger('unit_id');
            $table->string('kategori_laporan');
            $table->string('nama_pelapor');
            $table->string('nomor_kontak');
            $table->text('uraian_komplain');
            $table->json('kategori'); // Storing multiple categories as JSON
            $table->text('respon')->nullable();
            $table->text('analisis_awal')->nullable();
            $table->text('keterangan_selesai')->nullable();
            $table->string('foto_analisis_awal')->nullable();
            $table->string('foto_hasil_perbaikan')->nullable();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplains');
    }
};
