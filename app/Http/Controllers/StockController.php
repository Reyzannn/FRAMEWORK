<?php
// app/Http/Controllers/StockController.php
namespace App\Http\Controllers;

use App\Models\Produk_Model;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function masuk()
    {
        $barangMasuk = Produk_Model::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('stock.masuk', compact('barangMasuk'));
    }

    public function keluar()
    {
        // AMBIL DENGAN PRODUK YANG SUDAH DIHAPUS JUGA
        $barangKeluar = BarangKeluar::with(['produk' => function($query) {
            $query->withTrashed();
        }])
        ->orderBy('tanggal_keluar', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('stock.keluar', compact('barangKeluar'));
    }

    public function restore($id)
    {
        $product = Produk_Model::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()
            ->with('success', 'Produk berhasil dikembalikan!');
    }

    public function forceDelete($id)
    {
        $product = Produk_Model::onlyTrashed()->findOrFail($id);
        BarangKeluar::where('produk_id', $id)->delete();
        $product->forceDelete();

        return redirect()->back()
            ->with('success', 'Produk dihapus permanen dari sistem!');
    }
}
