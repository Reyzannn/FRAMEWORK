<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_Model extends Model
{
    protected $table = 'produk';

    protected $fillable = ['nama', 'kode', 'kategori', 'satuan', 'stok', 'stok_minim', 'harga',];
}
