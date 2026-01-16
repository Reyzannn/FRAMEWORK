<?php
// app/Models/BarangKeluar.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'alasan',
        'keterangan',
        'tanggal_keluar',
        'dilakukan_oleh'
    ];

    protected $dates = ['tanggal_keluar'];

    // RELASI DENGAN withTrashed()
    public function produk()
    {
        return $this->belongsTo(Produk_Model::class, 'produk_id')->withTrashed();
    }
}
