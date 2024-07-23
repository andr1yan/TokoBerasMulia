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
        Schema::create('keuangan_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('id_beras', 10);
            $table->date('tanggal');
            $table->integer('jumlah_masuk');
            $table->string('foto')->nullable();
            $table->integer('total_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_keluar');
    }
};
