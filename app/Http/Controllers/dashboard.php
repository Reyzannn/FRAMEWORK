<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk_Model;

class dashboard extends Controller
{
    public function index()
    {
        $produk = Produk_Model::count();
        // Barang dengan status "kondisi baik"
        $kondisi_bagus = Produk_Model::where('stok_bagus', '>', 0)->count();

        // Barang dengan status "kondisi kurang baik"
        $kondisi_kurang_bagus = Produk_Model::where('stok_kurang_bagus' , '>', 0)->count();

        return view('dashboard.index', compact('produk', 'kondisi_bagus', 'kondisi_kurang_bagus'));
    }
}
