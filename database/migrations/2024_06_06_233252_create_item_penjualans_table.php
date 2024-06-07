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
        Schema::create('item_penjualans', function (Blueprint $table) {
            $table->id('id_item_penjualan');
            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_kambing');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualans');
            $table->foreign('id_kambing')->references('id_kambing')->on('kambings');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_penjualans');
    }
};
