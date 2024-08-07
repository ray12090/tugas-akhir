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
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('pemilik_id');
            $table->unsignedBigInteger('tagihan_air_id')->nullable();
            $table->unsignedBigInteger('biaya_admin_id')->nullable();
            $table->string('nomor_invoice');
            $table->string('bulan_ipl');
            $table->date('tanggal_invoice');
            $table->date('jatuh_tempo');
            $table->decimal('total', 15, 2);
            $table->string('foto_bukti_pembayaran')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('pemilik_id')->references('id')->on('pemiliks')->onDelete('cascade');
            $table->foreign('tagihan_air_id')->references('id')->on('detail_tagihan_airs')->onDelete('cascade');
            $table->foreign('biaya_admin_id')->references('id')->on('detail_biaya_admins')->onDelete('cascade');
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
