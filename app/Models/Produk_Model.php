<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_Model extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'kode',
        'kategori',
        'satuan',
        'stok',
        'stok_minim',  // Perhatikan: 'stok_minim' bukan 'stok_min'
        'harga'
    ];

    // Tambahkan cast jika perlu
    protected $casts = [
        'stok' => 'integer',
        'stok_minim' => 'integer',
        'harga' => 'integer',
    ];
}
