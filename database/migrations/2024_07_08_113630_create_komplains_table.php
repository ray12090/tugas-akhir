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
            $table->unsignedBigInteger('jenis_komplain');
            $table->text('nama_pelapor');
            $table->bigInteger('no_hp');
            $table->unsignedBigInteger('bagian_komplain');
            $table->text('uraian_komplain');

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('jenis_komplain')->references('id')->on('jenis_komplains')->onDelete('cascade');
            $table->foreign('bagian_komplain')->references('id')->on('bagian_komplains')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
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
