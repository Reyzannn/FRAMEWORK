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
            'nama' => 'required',
            'kode' => 'required|regex:/^\S+$/',
            'kategori' => 'required',
            'stok' => 'required|numeric|min:0',
            'status' => 'required|in:Bagus,Kurang Bagus',
        ]);

        try {
            Produk_Model::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'kategori' => $request->kategori,
                'stok' => $request->stok,
                'status' => $request->status,
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
            'nama' => 'required',
            'kategori' => 'required',
            'stok' => 'required|numeric|min:0',
            'status' => 'required|in:Bagus,Kurang Bagus',
            'alasan_pengurangan' => 'nullable|required_if:stok_berkurang,true|string', // Validasi baru
            'keterangan' => 'nullable|string',
            'tanggal_keluar' => 'nullable|date'
        ]);

         try {
        $product = Produk_Model::findOrFail($id);
        $stokLama = $product->stok;
        $stokBaru = $request->stok;

            // Simpan data dasar
            $product->nama = $request->nama;
            $product->kategori = $request->kategori;
            $product->status = $request->status;
            $product->stok = $stokBaru;

            // Cek apakah stok berkurang
            if ($stokBaru < $stokLama) {
            $jumlahPengurangan = $stokLama - $stokBaru;

            // Validasi alasan pengurangan
            if (empty($request->alasan_pengurangan)) {
                return redirect()->back()
                    ->withErrors(['alasan_pengurangan' => 'Harap isi alasan pengurangan stok'])
                    ->withInput();
            }

            // Siapkan data untuk barang_keluar
            $barangKeluarData = [
                'produk_id' => $product->id,
                'jumlah' => $jumlahPengurangan,
                'alasan' => $request->alasan_pengurangan,
                'keterangan' => $request->keterangan,
                'tanggal_keluar' => $request->tanggal_keluar ?? now(),
                'dilakukan_oleh' => 'System' // Default value
            ];

            // Coba dapatkan info user
            if (auth()->check()) {
                $user = auth()->user();

                                // Cek berdasarkan model User Anda
                if (isset($user->name)) {
                    $barangKeluarData['dilakukan_oleh'] = $user->name;
                } elseif (isset($user->username)) {
                    $barangKeluarData['dilakukan_oleh'] = $user->username;
                } elseif (isset($user->email)) {
                    $barangKeluarData['dilakukan_oleh'] = $user->email;
                } else {
                    $barangKeluarData['dilakukan_oleh'] = 'User#' . $user->id;
                }
            }

                // Catat di barang keluar
// GANTI SAJA bagian create BarangKeluar dengan ini:
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
                    $product->status = 'Kurang Bagus';
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
