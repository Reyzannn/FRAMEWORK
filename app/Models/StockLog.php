<?php

namespace App\Models;

use App\Models\Produk_Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable = ['product_id', 'type', 'quantity', 'keterangan', 'tanggal'];

     public function product()
    {
        return $this->belongsTo(Produk_Model::class);
    }
}
