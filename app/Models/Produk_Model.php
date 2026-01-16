<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ TAMBAH INI

class Produk_Model extends Model
{
    use HasFactory, SoftDeletes; // ✅ TAMBAH SoftDeletes di sini

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'kode',
        'kategori',
        'stok',
        'status'
    ];

    protected $dates = ['deleted_at']; // ✅ TAMBAH INI (optional)

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }
}
