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
        Schema::create('ipl_jenis_tagihans_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ipl_id');
            $table->unsignedBigInteger('jenis_tagihan_id');
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();

            $table->foreign('ipl_id')->references('id')->on('ipls')->onDelete('cascade');
            $table->foreign('jenis_tagihan_id')->references('id')->on('detail_jenis_tagihans')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipl_jenis_tagihans_pivot');
    }
};
