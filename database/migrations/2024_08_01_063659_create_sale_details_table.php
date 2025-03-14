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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id');
            $table->integer('barang_id');
            $table->decimal('harga_bandrol');
            $table->integer('qty');
            $table->decimal('diskon_pct');
            $table->decimal('diskon_nilai');
            $table->decimal('harga_diskon');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
