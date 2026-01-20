<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\Produk_Model;

class Produk extends Controller
{
    public function create()
    {
        return view('produk.tambahProduk');
    }

    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $kategori = $request->kategori ?? null;

        $products = Produk_Model::query()
            ->when($search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('kode', 'like', "%{$search}%");
                });
            })
            ->when($kategori, function ($query, $kategori) {
                $query->where('kategori', $kategori);
            })
            ->get();

        return view('produk.index', compact('products'));
    }

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|max:255',
        'kode' => 'required|unique:produk,kode|regex:/^\S+$/',
        'kategori' => 'required|in:Elektronik,Alat Tulis,Alat Mandi,Jajan,Alas Kaki,Kecantikan,Alat Dapur',
        'stok' => 'required|integer|min:0',
        'stok_bagus' => 'required|integer|min:0',
        'stok_kurang_bagus' => 'required|integer|min:0',
    ]);

    // Validasi manual: total detail harus sama dengan total stok
    $totalDetail = $request->stok_bagus + $request->stok_kurang_bagus;

    if ($totalDetail != $request->stok) {
        return redirect()->back()
            ->withErrors(['stok' => "Total detail kondisi ($totalDetail) tidak sama dengan Total Stok ({$request->stok})"])
            ->withInput();
    }

    try {
        $produk = Produk_Model::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'stok_bagus' => $request->stok_bagus,
            'stok_kurang_bagus' => $request->stok_kurang_bagus,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
    }
}

public function edit(string $id)
    {
        $product = Produk_Model::findOrFail($id);
        return view('produk.editProduk', compact('product'));
    }

    public function update(Request $request, string $id)
{
    $request->validate([
        'nama' => 'required|max:255',
        'kategori' => 'required|in:Elektronik,Alat Tulis,Alat Mandi,Jajan,Alas Kaki,Kecantikan,Alat Dapur',
        'stok' => 'required|integer|min:0',
        'stok_bagus' => 'required|integer|min:0',
        'stok_kurang_bagus' => 'required|integer|min:0',
        'alasan_pengurangan' => 'nullable|required_if:stok_berkurang,true|string',
        'keterangan' => 'nullable|string',
        'tanggal_keluar' => 'nullable|date'
    ]);

    // Validasi manual: total detail harus sama dengan total stok
    $totalDetail = $request->stok_bagus + $request->stok_kurang_bagus ;

    if ($totalDetail != $request->stok) {
        return redirect()->back()
            ->withErrors(['stok' => "Total detail kondisi ($totalDetail) tidak sama dengan Total Stok ({$request->stok})"])
            ->withInput();
    }

    try {
        $product = Produk_Model::findOrFail($id);
        $stokLama = $product->stok;
        $stokBaru = $request->stok;

        // Simpan data dasar
        $product->nama = $request->nama;
        $product->kategori = $request->kategori;
        $product->stok = $stokBaru;
        $product->stok_bagus = $request->stok_bagus;
        $product->stok_kurang_bagus = $request->stok_kurang_bagus;

        // Cek apakah stok berkurang
        if ($stokBaru < $stokLama) {
            $jumlahPengurangan = $stokLama - $stokBaru;

            // Validasi alasan pengurangan
            if (empty($request->alasan_pengurangan)) {
                return redirect()->back()
                    ->withErrors(['alasan_pengurangan' => 'Harap isi alasan pengurangan stok'])
                    ->withInput();
            }

            // Catat di barang keluar
            BarangKeluar::create([
                'produk_id' => $product->id,
                'jumlah' => $jumlahPengurangan,
                'alasan' => $request->alasan_pengurangan,
                'keterangan' => $request->keterangan,
                'tanggal_keluar' => $request->tanggal_keluar ?? date('Y-m-d'),
                'dilakukan_oleh' => auth()->check()
                    ? (auth()->user()->nama ?? auth()->user()->name ?? auth()->user()->email ?? 'Admin')
                    : 'System'
            ]);

            // Update status otomatis jika alasan 'rusak'
            if ($request->alasan_pengurangan == 'rusak') {
                // Kurangi dari stok_bagus, tambah ke stok_kurang_bagus
                // Logika ini bisa disesuaikan dengan kebutuhan
            }
        }

        $product->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
    }
}

    public function destroy(string $id)
    {
        try {
            Produk_Model::destroy($id);
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
