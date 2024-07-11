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
            $table->text('respon_awal')->nullable();
            $table->text('pemeriksaan_awal')->nullable();
            $table->text('penyelesaian_komplain')->nullable();
            $table->json('foto_pemeriksaan_awal')->nullable();
            $table->json('foto_hasil_perbaikan')->nullable();
            $table->tinyInteger('persetujuan_selesai_tr')->default(0);
            $table->tinyInteger('persetujuan_selesai_pelaksana')->default(0);
            $table->timestamp('tanggal_penanganan')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('komplain_id')->references('id')->on('komplains')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');

            $table->index('komplain_id');
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
