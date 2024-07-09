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
        Schema::create('ipls', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice');
            $table->string('bulan_ipl');
            $table->date('tanggal_invoice');
            $table->date('jatuh_tempo');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('kepemilikan_id');
            $table->decimal('total_tagihan_belum_dibayar', 15, 2)->nullable();
            $table->decimal('titipan_pengelolaan', 15, 2)->nullable();
            $table->decimal('titipan_air', 15, 2)->nullable();
            $table->decimal('iuran_pengelolaan', 15, 2)->nullable();
            $table->decimal('dana_cadangan', 15, 2)->nullable();
            $table->decimal('meter_air_awal', 15, 2)->nullable();
            $table->decimal('meter_air_akhir', 15, 2)->nullable();
            $table->unsignedBigInteger('harga_air_id');
            $table->decimal('pemakaian_air', 15, 2)->nullable();
            $table->decimal('tagihan_air', 15, 2)->nullable();
            $table->decimal('denda', 15, 2)->nullable();
            $table->decimal('total', 15, 2);
            $table->string('foto_bukti_pembayaran')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('kepemilikan_id')->references('id')->on('kepemilikans')->onDelete('cascade');
            $table->foreign('harga_air_id')->references('id')->on('harga_airs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipls');
    }
};
