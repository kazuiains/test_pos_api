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
        Schema::create('item_penjualan', function (Blueprint $table) {
            $table->string('nota',200)->nullable();
            $table->string('kode_barang',200)->nullable();
            $table->integer('quantity',20);
        });

        Schema::table('item_penjualan', function (Blueprint $table){
            $table->foreign('nota')->references('id_nota')->on('penjualan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_barang')->references('kode')->on('barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_penjualan');
    }
};
