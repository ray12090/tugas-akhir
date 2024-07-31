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
        Schema::create('detail_biaya_admins', function (Blueprint $table) {
            $table->id();
            $table->decimal('biaya_admin', 15, 2);
            $table->date('tanggal_awal_berlaku');
            $table->date('tanggal_akhir_berlaku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_biaya_admins');
    }
};
