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
        Schema::create('kambings', function (Blueprint $table) {
            $table->id('id_kambing');
            $table->string('kode_kambing')->required();
            $table->unsignedBigInteger('id_jenis_kambing');
            $table->unsignedBigInteger('id_kategori_kambing');
            $table->integer('umur')->required();
            $table->enum('jenis_kelamin', ['jantan', 'betina'])->required();
            $table->integer('harga_beli')->required();
            $table->unsignedBigInteger('id_penerimaan');
            $table->enum('status', ['Penggemukan', 'Siap Jual', 'Terjual'])->default('Penggemukan');
            $table->integer('harga_jual')->nullable();

            $table->foreign('id_penerimaan')->references('id_penerimaan')->on('penerimaans')->onDelete('cascade');
            $table->foreign('id_jenis_kambing')->references('id_jenis_kambing')->on('jenis_kambings')->onDelete('cascade');
            $table->foreign('id_kategori_kambing')->references('id_kategori_kambing')->on('kategori_kambings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kambings');
    }
};
