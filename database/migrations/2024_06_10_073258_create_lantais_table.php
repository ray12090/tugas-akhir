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
        Schema::create('lantais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tower_id');
            $table->string('lantai');
            $table->timestamps();

            $table->foreign('tower_id')->references('id')->on('towers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lantais');
    }
};
