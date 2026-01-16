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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode')->unique();
            $table->enum('kategori', ['Elektronik', 'Alat Tulis', 'Alat Mandi', 'Jajan', 'Alas Kaki', 'Kecantikan', 'Alat Dapur']);
            $table->integer('stok');
            $table->enum('status', ['Bagus', 'Kurang Bagus'])->default('Bagus');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
