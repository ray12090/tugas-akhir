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
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('warga_negara_id');
            $table->unsignedBigInteger('agama_id');
            $table->unsignedBigInteger('perkawinan_id');
            $table->string('nama_penyewa');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->date('awal_sewa');
            $table->date('akhir_sewa');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('warga_negara_id')->references('id')->on('detail_kewarganegaraans')->onDelete('cascade');
            $table->foreign('agama_id')->references('id')->on('detail_agamas')->onDelete('cascade');
            $table->foreign('perkawinan_id')->references('id')->on('detail_perkawinans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};
