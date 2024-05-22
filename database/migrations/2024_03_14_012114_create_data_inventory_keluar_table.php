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
        Schema::create('data_inventory_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->unsignedBigInteger('data_inventory_id');
            $table->integer('jumlah_keluar');
            $table->date('tanggal_keluar');
            $table->string('keperluan');
            $table->timestamps();
            
            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('data_inventory_id')->references('id')->on('data_inventory')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_inventory_keluar');
    }
};
