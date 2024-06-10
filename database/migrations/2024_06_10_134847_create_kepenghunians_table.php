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
        Schema::create('kepenghunians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->date('tanggal_huni');
            $table->integer('status');
            $table->string('nama');
            $table->bigInteger('no_hp');
            $table->date('tanggal_lahir');
            $table->integer('warna_negara');
            $table->bigInteger('no_ktp');
            $table->integer('agama');
            $table->string('alamat');
            $table->date('awal_sewa');
            $table->date('akhir_sewa');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepenghunians');
    }
};
