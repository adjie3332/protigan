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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->unsignedBigInteger('data_inventory_id');
            $table->unsignedBigInteger('data_panen_id');
            $table->string('keterangan');
            $table->integer('pemasukan');
            $table->integer('pengeluaran');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('data_inventory_id')->references('id')->on('data_inventory')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('data_panen_id')->references('id')->on('data_panen')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
