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
        Schema::create('pemiliks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->bigInteger('no_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('warga_negara');
            $table->bigInteger('no_ktp');
            $table->unsignedBigInteger('agama_id');
            $table->unsignedBigInteger('perkawinan_id');
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemiliks');
    }
};
