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
        Schema::create('detail_tagihan_airs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biaya_air_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('meter_air_awal', 15, 2);
            $table->decimal('meter_air_akhir', 15, 2);
            $table->decimal('pemakaian_air', 15, 2);
            $table->decimal('tagihan_air', 15, 2);
            $table->timestamps();

            $table->foreign('biaya_air_id')->references('id')->on('detail_biaya_airs')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tagihan_airs');
    }
};
