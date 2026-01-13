<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Stok Produk - Toko Maju Jaya</title>
  <style>
    body { font-family: Arial, sans-serif; color: #333; }
    .header { text-align: center; margin-bottom: 30px; }
    .header h1 { margin: 0; color: #445a41; }
    .summary { background: #f8f9ff; padding: 5px; border-radius: 12px; margin-bottom: 25px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th { background: #445a41; color: white; padding: 12px 8px; font-size: 13px; }
    td { padding: 10px 8px; font-size: 12px; border-bottom: 1px solid #eee; }
    tr:nth-child(even) { background: #f9f9ff; }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .badge-red { background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .badge-green { background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .footer { margin-top: 50px; display: flex; justify-content: space-between; }
    .total { font-size: 18px; font-weight: bold; color: #445a41; margin-top: 20px; }
  </style>
</head>
<body>

  <div class="header">
    <h1>TOKO MAJU JAYA</h1>
    <p>Jl. Raya Bogor No. 123, Jakarta Timur</p>
    <h2>LAPORAN KESELURUHAN</h2>
    <p>Per <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></p>

  </div>

  <div class="summary">
    <table width="100%">
      <tr>
        <td><strong>Total Jenis Produk</strong></td>
        <td>: {{ $products->count() }} produk</td>
        <td><strong>Produk Stok Rendah</strong></td>
        <td>: {{ $products->where('stok', '<=', 'stok_minim')->count() }} produk</td>
      </tr>
      <tr>
        <td><strong>Total Nilai Inventori</strong></td>
        <td>: Rp {{ number_format($products->sum(fn($p) => $p->stok * $p->harga), 0, ',', '.') }}</td>
        <td><strong>Produk Habis (Stok 0)</strong></td>
        <td>: {{ $products->where('stok', 0)->count() }} produk</td>
      </tr>
    </table>
  </div>

  <table>
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="10%">Kode</th>
        <th width="25%">Nama Produk</th>
        <th width="12%">Kategori</th>
        <th width="10%" class="text-center">Stok</th>
        <th width="8%">Satuan</th>
        <th width="12%" class="text-right">Harga</th>
        <th width="13%" class="text-right">Nilai Stok</th>
        <th width="10%" class="text-center">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $index => $product)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $product->kode }}</td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->kategori }}</td>
        <td class="text-center">{{ $product->stok }}</td>
        <td>{{ $product->satuan }}</td>
        <td class="text-right">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
        <td class="text-right">Rp {{ number_format($product->stok * $product->harga, 0, ',', '.') }}</td>
        <td class="text-center">
          @if($product->stok == 0)
            <span class="badge-red">Habis</span>
          @elseif($product->stok <= $product->stok_minim)
            <span class="badge-red">Rendah</span>
          @else
            <span class="badge-green">Cukup</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total">
    Total Nilai Inventori (Modal) : <strong>Rp {{ number_format($products->sum(fn($p) => $p->stok * $p->harga), 0, ',', '.') }}</strong>
  </div>

  <div class="footer">
    <div>
      <table width="100%" style="margin-top:50px; border:0;">
  <tr>
    <td style="text-align:center;">
      <p>Menyetujui,</p>
      <br><br>
      <p><strong>(....................)</strong><br>Owner / Direktur</p>
    </td>
    <td style="text-align:center;">
      <p>Dibuat oleh,</p>
      <br><br>
      <p><strong>(....................)</strong><br>Manager</p>
    </td>
  </tr>
</table>
  </div>

</body>
</html>
