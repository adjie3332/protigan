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
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('jumlah')->default(0);
            $table->unsignedBigInteger('id_jenis_barang');
            $table->string('satuan');
            $table->timestamps();

            $table->foreign('id_jenis_barang')->references('id')->on('data_jenis_barang')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_inventory');
    }
};
