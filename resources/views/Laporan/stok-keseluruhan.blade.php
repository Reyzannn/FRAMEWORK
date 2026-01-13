<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Stok Keseluruhan - Toko Maju Jaya</title>
  <style>
    body { font-family: Arial, sans-serif; color: #333; }

    /* Header */
    .header { text-align: center; margin-bottom: 20px; }
    .header h1 { margin: 0; color: #445a41; font-size: 28px; letter-spacing: 1px; }
    .header h2 { margin: 5px 0; font-size: 20px; color: #222; }

    /* Summary Box */
    .summary {
      background: #ffffff;
      padding: 15px;
      border-radius: 12px;
      box-shadow: 0 0 3px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      font-size: 14px;
    }
    .summary table td { padding: 6px 0; }

    /* Table Style */
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th {
      background: #445a41;
      color: #fff;
      padding: 12px 8px;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    td { padding: 10px 8px; font-size: 12px; border-bottom: 1px solid #eee; }
    tr:nth-child(even) { background: #f9f9ff; }
    .text-center { text-align: center; }

    /* Footer / Tanda Tangan */
    .footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 14px; }
    .footer div { width: 45%; text-align: center; }
    .footer p { margin: 3px 0; }
  </style>
</head>
<body>

  <div class="header">
    <h1>TOKO MAJU JAYA</h1>
    <p>Jl. Raya Bogor No. 123, Jakarta Timur</p>
    <h2>STOK KESELURUHAN PRODUK</h2>
    <p>Per <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></p>
  </div>

  @php
    $totalKategori = $products->pluck('kategori')->unique()->count();
    $totalBarang = $products->sum('stok');
  @endphp

  <!-- Summary Box -->
  <div class="summary">
    <table width="100%">
      <tr>
        <td><strong>Jumlah Kategori</strong></td>
        <td>: {{ $totalKategori }} kategori</td>
      </tr>
      <tr>
        <td><strong>Total Keseluruhan Barang</strong></td>
        <td>: {{ number_format($totalBarang, 0, ',', '.') }} item</td>
      </tr>
    </table>
  </div>

  <!-- Data Produk -->
  <table>
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="10%">Kode</th>
        <th width="35%">Nama Produk</th>
        <th width="15%">Kategori</th>
        <th width="10%" class="text-center">Stok</th>
        <th width="10%">Satuan</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>

 <!-- Footer / Tanda Tangan -->
<div style="margin-top: 50px;">
  <table width="100%" style="border: 0; text-align: center;">
    <tr>
      <td style="width: 50%;">
        <p>Menyetujui,</p>
        <br><br><br> <!-- ruang untuk tanda tangan -->
        <p><strong>(....................)</strong><br>Owner / Direktur</p>
      </td>
      <td style="width: 50%;">
        <p>Dibuat oleh,</p>
        <br><br><br> <!-- ruang untuk tanda tangan -->
        <p><strong>(....................)</strong><br>Manager</p>
      </td>
    </tr>
  </table>
</div>
