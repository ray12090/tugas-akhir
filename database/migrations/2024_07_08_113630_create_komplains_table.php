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
            $table->unsignedBigInteger('jenis_komplain_id');
            $table->unsignedBigInteger('status_komplain_id')->default(1);
            $table->unsignedBigInteger('pelapor_id')->nullable();
            $table->text('nama_pelapor');
            $table->string('no_hp');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('pelapor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jenis_komplain_id')->references('id')->on('jenis_komplains')->onDelete('cascade');
            $table->foreign('status_komplain_id')->references('id')->on('status_komplains')->onDelete('cascade');
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
