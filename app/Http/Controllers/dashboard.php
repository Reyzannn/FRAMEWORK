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
        $kondisi_bagus = Produk_Model::where('status', 'Bagus')->count();

        // Barang dengan status "kondisi kurang baik"
        $kondisi_kurang_bagus = Produk_Model::where('status', 'Kurang Bagus')->count();

        return view('dashboard.index', compact('produk', 'kondisi_bagus', 'kondisi_kurang_bagus'));
    }
}
