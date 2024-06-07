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
        Schema::create('penerimaans', function (Blueprint $table) {
            $table->id('id_penerimaan');
            $table->date('tanggal_penerimaan')->required();
            $table->integer('total_penerimaan')->required();
            $table->unsignedBigInteger('id_supplier')->required();
            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');
            $table->unsignedBigInteger('id_admin')->required();
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaans');
    }
};
