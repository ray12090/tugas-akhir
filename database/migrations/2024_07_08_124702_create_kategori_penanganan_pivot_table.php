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
        Schema::create('kategori_penanganan_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penanganan_id');
            $table->unsignedBigInteger('kategori_penanganan_id');
            $table->timestamps();

            $table->foreign('penanganan_id')->references('id')->on('penanganans')->onDelete('cascade');
            $table->foreign('kategori_penanganan_id')->references('id')->on('kategori_penanganans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_penanganan_pivot');
    }
};
