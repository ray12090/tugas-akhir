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
            $table->string('nik');
            $table->unsignedBigInteger('warga_negara_id');
            $table->unsignedBigInteger('agama_id');
            $table->unsignedBigInteger('perkawinan_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('village_id');
            $table->string('nama_pemilik');
            $table->string('no_hp');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->timestamps();

            $table->foreign('warga_negara_id')->references('id')->on('detail_kewarganegaraans')->onDelete('cascade');
            $table->foreign('agama_id')->references('id')->on('detail_agamas')->onDelete('cascade');
            $table->foreign('perkawinan_id')->references('id')->on('detail_perkawinans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
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
