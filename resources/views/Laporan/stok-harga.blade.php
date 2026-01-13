<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Total Nilai Inventori - Toko Maju Jaya</title>
  <style>
    body { font-family: Arial, sans-serif; color: #333; margin: 40px; }

    /* Header */
    .header { text-align: center; margin-bottom: 20px; }
    .header h1 { margin: 0; color: #445a41; font-size: 28px; letter-spacing: 1px; }
    .header h2 { margin: 5px 0; font-size: 20px; color: #222; }

    /* Summary Box */
    .summary { background: #f8f9ff; padding: 15px; border-radius: 12px; box-shadow: 0 0 3px rgba(0,0,0,0.05); margin-bottom: 20px; }
    .summary table td { padding: 6px 0; font-size: 14px; }

    /* Table Style */
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th { background: #445a41; color: #fff; padding: 12px 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
    td { padding: 10px 8px; font-size: 12px; border-bottom: 1px solid #eee; }
    tr:nth-child(even) { background: #f9f9ff; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }

    /* Total */
    .total { margin-top: 20px; font-size: 18px; font-weight: bold; color: #445a41; margin-bottom: 80px; } /* beri margin bawah agar footer tidak menimpa */

    /* Footer */
    .footer { font-size: 14px; margin-top: 50px; }
    .footer table { width: 100%; border: 0; }
    .footer td { text-align: center; vertical-align: top; }
  </style>
</head>
<body>

  <div class="header">
    <h1>TOKO MAJU JAYA</h1>
    <p>Jl. Raya Bogor No. 123, Jakarta Timur</p>
    <h2>TOTAL NILAI INVENTORI</h2>
    <p>Per <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></p>
  </div>

  @php
    $totalProduk = $products->count();
    $totalStok = $products->sum('stok');
    $totalNilai = $products->sum(fn($p) => $p->stok * $p->harga);
  @endphp

  <div class="summary">
    <table width="100%">
      <tr>
        <td><strong>Total Stok Seluruh Produk</strong></td>
        <td>: {{ number_format($totalStok, 0, ',', '.') }} item</td>
      </tr>
      <tr>
        <td><strong>Total Nilai Inventori</strong></td>
        <td>: Rp {{ number_format($totalNilai, 0, ',', '.') }}</td>
      </tr>
    </table>
  </div>

  <table>
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="10%">Kode</th>
        <th width="35%">Nama Produk</th>
        <th width="15%">Kategori</th>
        <th width="10%" class="text-center">Stok</th>
        <th width="10%">Satuan</th>
        <th width="15%" class="text-right">Nilai Stok</th>
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
        <td class="text-right">
          Rp {{ number_format($product->stok * $product->harga, 0, ',', '.') }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total">
    Total Nilai Inventori: <strong>Rp {{ number_format($totalNilai, 0, ',', '.') }}</strong>
  </div>

  <div class="footer">
    <table>
      <tr>
        <td>
          <p>Menyetujui,</p>
          <br><br>
          <p><strong>(....................)</strong><br>Owner / Direktur</p>
        </td>
        <td>
          <p>Dibuat oleh,</p>
          <br><br>
          <p><strong>(....................)</strong><br>Manager</p>
        </td>
      </tr>
    </table>
  </div>

</body>
</html>
