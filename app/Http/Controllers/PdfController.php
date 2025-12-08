<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Produk_Model;

class PdfController extends Controller
{
    public function proses(Request $request)
    {
        $jenis = $request->jenis_laporan;
        $aksi  = $request->aksi; // "preview" atau "download"

        // Validasi jenis laporan
        $allowed = ['stok', 'stok_harga', 'stok_habis', 'penjualan'];
        if (!$jenis || !in_array($jenis, $allowed)) {
            return back()->with('error', 'Pilih jenis laporan dulu!');
        }

        // === AMBIL DATA YANG SAMA PERSIS SEPERTI DI cetakStok() ===
        $products     = Produk_Model::all();
        $produk_minim = Produk_Model::whereColumn('stok', '<=', 'stok_minim')->get();

        // Data umum untuk semua laporan
        $data = [
            'tanggal'       => now()->format('d F Y'),
            'products'      => $products,
            'produk_minim'  => $produk_minim,
        ];

        // Tentukan view sesuai pilihan
        $view = match ($jenis) {
            'stok'        => 'laporan.stok-keseluruhan',
            'stok_harga'  => 'laporan.stok-harga',
            'stok_habis'  => 'laporan.stok-habis',
            'penjualan'   => 'laporan.Keseluruhan',
            default       => 'laporan.Keseluruhan',
        };

        // Pastikan view-nya ada
        if (!view()->exists($view)) {
            return back()->with('error', "Template '$view' belum dibuat!");
        }

        // KALAU DOWNLOAD → langsung PDF
        if ($aksi === 'download') {
            return Pdf::loadView($view, $data)
                ->setPaper('a4', 'potrait')
                ->download('Laporan_' . str_replace('_', ' ', ucfirst($jenis)) . '_' . now()->format('Ymd_His') . '.pdf');
        }

        // KALAU PREVIEW → render HTML, simpan ke session, balik ke form
        $html = view($view, $data)->render();

        return redirect()->back()
            ->with('preview', $html)
            ->withInput(); // Ini yang bikin dropdown jenis_laporan tetap terpilih!!
    }

    // Fungsi lama kamu bisa dihapus atau dibiarkan sebagai route terpisah
    // public function cetakStok() { ... }
}