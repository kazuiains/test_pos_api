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
        Schema::create('sales', function (Blueprint $table) {
            $table->string('sale_id',200)->primary();
            $table->timestamp('date')->nullable();
            $table->string('customer_code',200)->nullable();
            $table->string('total',100);
        });

        Schema::table('sales', function (Blueprint $table){
            $table->foreign('customer_code')->references('customer_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
