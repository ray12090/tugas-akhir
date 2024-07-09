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
        Schema::create('penanganan_komplain_kategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penanganan_komplain_id');
            $table->unsignedBigInteger('kategori_komplain_id');
            $table->timestamps();

            $table->foreign('penanganan_komplain_id')->references('id')->on('penanganan_komplains')->onDelete('cascade');
            $table->foreign('kategori_komplain_id')->references('id')->on('kategori_komplains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganan_komplain_kategoris');
    }
};
