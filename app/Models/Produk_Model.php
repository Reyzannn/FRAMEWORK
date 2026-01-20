<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk_Model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'kode',
        'kategori',
        'stok',
        'stok_bagus',
        'stok_kurang_bagus',
        'status_summary'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'stok' => 'integer',
        'stok_bagus' => 'integer',
        'stok_kurang_bagus' => 'integer',
    ];

    // Event saat menyimpan
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Validasi: total detail harus sama dengan total stok
            $totalDetail = $model->stok_bagus + $model->stok_kurang_bagus;

            if ($totalDetail != $model->stok) {
                throw new \Exception("Total detail kondisi ($totalDetail) tidak sama dengan Total Stok ({$model->stok})");
            }

            // Update status_summary
            $model->updateStatusSummary();
        });
    }

    // Method untuk update status summary
    public function updateStatusSummary()
    {
        $parts = [];
        if ($this->stok_bagus > 0) $parts[] = "Bagus: {$this->stok_bagus}";
        if ($this->stok_kurang_bagus > 0) $parts[] = "Kurang: {$this->stok_kurang_bagus}";

        $this->status_summary = implode(', ', $parts) ?: 'Tidak ada stok';
    }

    // Accessor untuk status display (HTML untuk view)
    public function getStatusDisplayAttribute()
    {
        $parts = [];
        if ($this->stok_bagus > 0) {
            $parts[] = "<div class='flex items-center justify-between'>
                <div class='flex items-center'>
                    <div class='w-2 h-2 bg-green-500 rounded-full mr-2'></div>
                    <span class='text-xs'>Bagus</span>
                </div>
                <span class='text-xs font-bold'>{$this->stok_bagus}</span>
            </div>";
        }
        if ($this->stok_kurang_bagus > 0) {
            $parts[] = "<div class='flex items-center justify-between'>
                <div class='flex items-center'>
                    <div class='w-2 h-2 bg-yellow-500 rounded-full mr-2'></div>
                    <span class='text-xs'>Kurang Bagus</span>
                </div>
                <span class='text-xs font-bold'>{$this->stok_kurang_bagus}</span>
            </div>";
        }

        return !empty($parts)
            ? "<div class='space-y-1'>" . implode('', $parts) . "</div>"
            : "<span class='text-xs text-gray-500'>Tidak ada stok</span>";
    }

    // Accessor untuk status teks biasa (untuk PDF/laporan)
    public function getStatusTextAttribute()
    {
        $parts = [];
        if ($this->stok_bagus > 0) $parts[] = "Bagus = {$this->stok_bagus}";
        if ($this->stok_kurang_bagus > 0) $parts[] = "Kurang Bagus = {$this->stok_kurang_bagus}";

        return !empty($parts) ? implode(' | ', $parts) : 'Tidak ada stok';
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }
}
