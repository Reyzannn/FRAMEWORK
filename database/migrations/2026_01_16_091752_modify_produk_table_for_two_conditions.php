<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus kolom status lama dan rusak
            $table->dropColumn('status');

            // Tambah kolom baru untuk 2 kondisi
            $table->integer('stok_bagus')->default(0)->after('stok');
            $table->integer('stok_kurang_bagus')->default(0)->after('stok_bagus');

            // Optional: summary
            $table->string('status_summary')->nullable()->after('stok_kurang_bagus');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['stok_bagus', 'stok_kurang_bagus', 'status_summary']);
            $table->enum('status', ['Bagus', 'Kurang Bagus'])->default('Bagus');
        });
    }
};
