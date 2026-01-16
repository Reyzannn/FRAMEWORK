<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Smartphone ABC',
                'kode' => 'PRD001',
                'kategori' => 'Elektronik',
                'stok' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Buku Tulis A5',
                'kode' => 'PRD002',
                'kategori' => 'Alat Tulis',
                'stok' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Shampoo Fresh',
                'kode' => 'PRD003',
                'kategori' => 'Alat Mandi',
                'stok' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Keripik Pedas',
                'kode' => 'PRD004',
                'kategori' => 'Jajan',
                'stok' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sandal Jepit Classic',
                'kode' => 'PRD005',
                'kategori' => 'Alas Kaki',
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bedak Halus Natural',
                'kode' => 'PRD006',
                'kategori' => 'Kecantikan',
                'stok' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Wajan Anti Lengket',
                'kode' => 'PRD007',
                'kategori' => 'Alat Dapur',
                'stok' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
