<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $query->where('kategori', 'like', "%{$kategori}%");
        })
        ->get();

        return view('produk.index', compact('products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|regex:/^\S+$/',
            'kategori' => 'required',
            'satuan' => 'required',
            'stok' => 'required|numeric',
            'stok_min' => 'required|numeric',
            'harga' => 'required|numeric',
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
            die($e->getMessage());
            return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan pada database: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }



}

