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
        Schema::create('data_kambing_awals', function (Blueprint $table) {
            $table->id('id_data_kambing_awal');
            $table->unsignedBigInteger('id_kambing');
            $table->foreign('id_kambing')->references('id_kambing')->on('kambings')->onDelete('cascade');
            $table->integer('berat_badan_awal')->required();
            $table->integer('tinggi_badan_awal')->required();
            $table->integer('poel_awal')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kambing_awals');
    }
};
