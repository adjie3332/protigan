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
        Schema::create('data_panen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_karyawan_id');
            $table->unsignedBigInteger('harga_karet_id');
            $table->date('tanggal_panen');
            $table->json('hasil_kg');
            $table->integer('total_hasil_kg');
            $table->decimal('total_gaji', 10, 2);
            $table->decimal('hasil_pemilik', 10, 2);
            $table->timestamps();

            $table->foreign('data_karyawan_id')->references('id')->on('data_karyawan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('harga_karet_id')->references('id')->on('harga_karet')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_panen');
    }
};
