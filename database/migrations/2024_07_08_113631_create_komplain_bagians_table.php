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
        Schema::create('komplain_bagians', function (Blueprint $table) {
            $table->unsignedBigInteger('komplain_id');
            $table->unsignedBigInteger('bagian_komplain_id');

            $table->foreign('komplain_id')->references('id')->on('komplains')->onDelete('cascade');
            $table->foreign('bagian_komplain_id')->references('id')->on('bagian_komplains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplain_bagians');
    }
};
