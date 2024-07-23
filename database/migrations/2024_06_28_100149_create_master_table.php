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
        Schema::create('master_beras', function (Blueprint $table) {
            $table->id();
            $table->string('kode_beras', 10);
            $table->string('nama_beras', 20);
            $table->integer('jumlah_stok');
            $table->string('kategori', 20);
            $table->integer('harga_jual');
            $table->integer('harga_beli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master');
    }
};
