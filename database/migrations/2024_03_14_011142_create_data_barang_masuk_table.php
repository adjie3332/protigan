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
        Schema::create('data_barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_barang_id');
            $table->unsignedBigInteger('data_suplier_id');
            $table->integer('jumlah_masuk');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_masuk');
            $table->timestamps();

            $table->foreign('data_suplier_id')->references('id')->on('data_suplier')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('data_barang_id')->references('id')->on('data_barang')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_barang_masuk');
    }
};
