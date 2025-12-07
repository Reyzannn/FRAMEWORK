<?php

namespace App\Http\Controllers;

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
            'satuan' => 'required',
            'stok' => 'required|numeric|min:0',
            'stok_min' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            Produk_Model::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'kategori' => $request->kategori,
                'satuan' => $request->satuan,
                'stok' => $request->stok,
                'stok_minim' => $request->stok_min,
                'harga' => $request->harga,
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
            'satuan' => 'required',
            'stok' => 'required|numeric|min:0',
            'stok_min' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            $product = Produk_Model::findOrFail($id);

            $product->update([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'satuan' => $request->satuan,
                'stok' => $request->stok,
                'stok_minim' => $request->stok_min,
                'harga' => $request->harga,
            ]);

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
