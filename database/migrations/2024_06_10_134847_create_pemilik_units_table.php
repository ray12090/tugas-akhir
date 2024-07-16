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
        Schema::create('pemilik_units', function (Blueprint $table) {
            $table->unsignedBigInteger('pemilik_id');
            $table->unsignedBigInteger('unit_id');
            $table->date('awal_sewa');
            $table->date('akhir_sewa');
            $table->timestamps();

            $table->foreign('pemilik_id')->references('id')->on('pemiliks')->onDelete('cascade');
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
