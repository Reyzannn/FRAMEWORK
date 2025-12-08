<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Stok Minim / Habis - Toko Maju Jaya</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      margin: 20px; /* margin lebih kecil supaya footer muat */
    }

    /* HEADER */
    .header {
      text-align: center;
      margin-bottom: 15px;
    }
    .header h1 {
      margin: 0;
      color: #4361EE;
      font-size: 28px;
    }
    .header h2 {
      margin: 5px 0;
      font-size: 20px;
      color: #222;
    }

    /* SUMMARY BOX */
    .summary {
      background: #f8f9ff;
      padding: 12px 15px;
      border-radius: 12px;
      margin-bottom: 15px;
      font-size: 14px;
    }
    .summary table td {
      padding: 5px 0;
    }

    /* TABLE */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th {
      background: #4361EE;
      color: #fff;
      padding: 12px 8px;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    td {
      padding: 10px 8px;
      font-size: 12px;
      border-bottom: 1px solid #eee;
    }
    tr:nth-child(even) { background: #f9f9ff; }
    .text-center { text-align: center; }

    /* BADGE STATUS */
    .badge-red { background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .badge-orange { background: #fff4e5; color: #f97316; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }

    /* FOOTER */
    .footer {
      margin-top: 20px;
      page-break-inside: avoid; /* jangan sampai pindah halaman */
    }
    .footer table {
      width: 100%;
      border:0;
      page-break-inside: avoid;
    }

    /* WRAPPER UNTUK FLEX */
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex: 1;
    }

  </style>
</head>
<body>

<div class="wrapper">
  <!-- HEADER -->
  <div class="header">
    <h1>TOKO MAJU JAYA</h1>
    <p>Jl. Raya Bogor No. 123, Jakarta Timur</p>
    <h2>LAPORAN STOK MINIM / HABIS</h2>
    <p>Per <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></p>
  </div>

  <!-- SUMMARY -->
  <div class="summary">
    <table width="100%">
      <tr>
        <td><strong>Produk Stok Minim</strong></td>
        <td>: {{ $products->where('stok', '<=', 'stok_minim')->count() }} produk</td>
      </tr>
      <tr>
        <td><strong>Produk Habis (Stok 0)</strong></td>
        <td>: {{ $products->where('stok', 0)->count() }} produk</td>
      </tr>
    </table>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <table>
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="10%">Kode</th>
          <th width="35%">Nama Produk</th>
          <th width="15%">Kategori</th>
          <th width="10%" class="text-center">Stok</th>
          <th width="10%">Satuan</th>
          <th width="15%" class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        @php $no = 1; @endphp
        @foreach($products as $product)
          @if($product->stok == 0 || $product->stok <= $product->stok_minim)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $product->kode }}</td>
              <td>{{ $product->nama }}</td>
              <td>{{ $product->kategori }}</td>
              <td class="text-center">{{ $product->stok }}</td>
              <td>{{ $product->satuan }}</td>
              <td class="text-center">
                @if($product->stok == 0)
                  <span class="badge-red">Habis</span>
                @else
                  <span class="badge-orange">Minim</span>
                @endif
              </td>
            </tr>
          @endif
        @endforeach

        @if($products->where('stok', 0)->count() == 0 && $products->where('stok', '<=', 'stok_minim')->count() == 0)
          <tr>
            <td colspan="7" class="text-center" style="padding:20px;">
              <strong>Tidak ada produk dengan stok minim atau habis.</strong>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <table>
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
</div>

</body>
</html>
