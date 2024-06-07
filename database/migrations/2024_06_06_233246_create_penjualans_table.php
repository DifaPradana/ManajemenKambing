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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->integer('total_harga')->nullable();
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans');
            $table->enum('status', ['Selesai', 'Belum Selesai'])->default('Belum Selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
