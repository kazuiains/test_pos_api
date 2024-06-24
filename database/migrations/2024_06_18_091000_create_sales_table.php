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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('id_nota',200)->primary();
            $table->timestamp('tanggal')->nullable();
            $table->string('kode_pelanggan',200)->nullable();
            $table->string('subtotal',100);
        });

        Schema::table('penjualan', function (Blueprint $table){
            $table->foreign('kode_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
