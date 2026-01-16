<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Produk_Model;
use App\Models\BarangKeluar;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function proses(Request $request)
    {
        $jenis = $request->jenis_laporan;
        $aksi  = $request->aksi; // "preview" atau "download"

        // Validasi jenis laporan
        $allowed = ['stok', 'penjualan']; // Hanya 2 pilihan sesuai form pertama
        if (!$jenis || !in_array($jenis, $allowed)) {
            return back()->with('error', 'Pilih jenis laporan dulu!');
        }

        // === AMBIL DATA SESUAI JENIS LAPORAN ===
        if ($jenis === 'stok') {
            // LAPORAN STOK KESELURUHAN
            $data = $this->getLaporanStok();
            $view = 'laporan.stok-keseluruhan';
            $filename = 'Laporan_Stok_Keseluruhan_' . now()->format('Ymd_His') . '.pdf';

        } elseif ($jenis === 'penjualan') {
            // LAPORAN BARANG DIPINJAM
            $data = $this->getLaporanPeminjaman();
            $view = 'laporan.barang-dipinjam';
            $filename = 'Laporan_Barang_Dipinjam_' . now()->format('Ymd_His') . '.pdf';
        }

        // Pastikan view-nya ada
        if (!view()->exists($view)) {
            return back()->with('error', "Template '$view' belum dibuat!");
        }

        // KALAU DOWNLOAD → langsung PDF
        if ($aksi === 'download') {
            return Pdf::loadView($view, $data)
                ->setPaper('a4', 'potrait')
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', true)
                ->download($filename);
        }

        // KALAU PREVIEW → render HTML, simpan ke session, balik ke form
        $html = view($view, $data)->render();

        return redirect()->back()
            ->with('preview', $html)
            ->withInput();
    }

    /**
     * Fungsi untuk mengambil data laporan stok keseluruhan
     */
    private function getLaporanStok()
    {
        // Ambil semua produk yang tidak di-soft delete (deleted_at NULL)
        $products = Produk_Model::whereNull('deleted_at')->get();

        // Hitung statistik
        $total_produk = $products->count();
        $total_stok = $products->sum('stok');
        $stok_minim = $products->where('stok', '<=', 'stok_minim')->count();
        $stok_habis = $products->where('stok', 0)->count();

        return [
            'products'       => $products,
            'tanggal'        => now()->translatedFormat('d F Y'),
            'total_produk'   => $total_produk,
            'total_stok'     => $total_stok,
            'stok_minim'     => $stok_minim,
            'stok_habis'     => $stok_habis,
        ];
    }

    /**
     * Fungsi untuk mengambil data laporan barang dipinjam
     * SESUAI DENGAN MODEL YANG SUDAH ADA
     */
    private function getLaporanPeminjaman()
    {
        // Ambil data barang keluar dengan alasan mengandung "pinjam" atau "Dipinjam"
        $barangDipinjam = BarangKeluar::with(['produk' => function($query) {
            $query->withTrashed(); // Include soft deleted products
        }])
        ->where(function($query) {
            $query->where('alasan', 'like', '%pinjam%')
                  ->orWhere('alasan', 'like', '%Pinjam%')
                  ->orWhere('alasan', 'Dipinjam');
        })
        ->orderBy('tanggal_keluar', 'desc') // Sesuai field di model
        ->get();

        // Hitung total barang yang sedang dipinjam
        $total_dipinjam = $barangDipinjam->sum('jumlah');

        // Hitung barang yang sudah dihapus
        $deletedCount = $barangDipinjam->filter(function($item) {
            return $item->produk && $item->produk->deleted_at;
        })->count();

        return [
            'barangDipinjam' => $barangDipinjam,
            'tanggal'        => now()->translatedFormat('d F Y'),
            'total_dipinjam' => $total_dipinjam,
            'total_transaksi' => $barangDipinjam->count(),
            'deleted_count'  => $deletedCount,
        ];
    }
}
