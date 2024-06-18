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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->string('sale_code',200)->nullable();
            $table->string('item_code',200)->nullable();
            $table->integer('quantity',20);
        });

        Schema::table('sale_items', function (Blueprint $table){
            $table->foreign('sale_code')->references('sale_id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_code')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
