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
        Schema::create('stock_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
                $table->enum('type', ['masuk', 'keluar']);
                $table->integer('quantity');
                $table->string('keterangan');
                $table->date('tanggal');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
