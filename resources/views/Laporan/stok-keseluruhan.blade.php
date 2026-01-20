<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Stok Keseluruhan - Sistem Inventory</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      font-size: 12px;
      margin: 0;
      padding: 20px;
    }

    /* Header */
    .header {
      text-align: center;
      margin-bottom: 20px;
      border-bottom: 2px solid #1C2B1A;
      padding-bottom: 15px;
    }
    .header h1 {
      margin: 0;
      color: #1C2B1A;
      font-size: 24px;
      font-weight: bold;
    }
    .header h2 {
      margin: 5px 0;
      font-size: 18px;
      color: #445a41;
      font-weight: 600;
    }
    .header p {
      margin: 3px 0;
      color: #666;
      font-size: 11px;
    }

    /* Summary Box */
    .summary {
      background: #f8f9fa;
      padding: 12px;
      border-radius: 8px;
      border-left: 4px solid #1C2B1A;
      margin-bottom: 20px;
    }
    .summary table {
      width: 100%;
    }
    .summary td {
      padding: 8px 0;
    }
    .summary strong {
      color: #1C2B1A;
    }

    /* Table Style */
    table.main-table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-top: 15px;
      table-layout: fixed;
    }
    .main-table th {
      background: #1C2B1A;
      color: white;
      padding: 12px 8px;
      font-size: 11px;
      font-weight: bold;
      text-align: left;
      border: 1px solid #2d3e2c;
    }
    .main-table td {
      padding: 10px 8px;
      border: 1px solid #ddd;
      vertical-align: top;
      word-wrap: break-word;
    }
    .main-table tr:nth-child(even) {
      background: #f9f9f9;
    }

    /* Kode barang styling */
    .kode-barang {
      font-family: 'Courier New', monospace;
      font-weight: bold;
      color: #1C2B1A;
    }

    /* Status Detail */
    .status-detail {
      font-size: 10px;
      line-height: 1.4;
    }
    .status-bagus {
      color: #166534;
    }
    .status-kurang {
      color: #854d0e;
    }

    /* Footer / Signature */
    .footer {
      margin-top: 50px;
    }
    .signature-box {
      width: 45%;
      text-align: center;
      padding-top: 40px;
    }
    .signature-line {
      width: 70%;
      height: 1px;
      margin: 60px auto 10px;
      border-top: 1px solid #333;
    }

    /* Utility classes */
    .text-center { text-align: center; }

    /* Print optimization */
    @media print {
      body {
        margin: 0.5in;
        padding: 0;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
      .main-table {
        border: 1px solid #000 !important;
        font-size: 10px;
      }
      .main-table th {
        background: #1C2B1A !important;
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <h1>SISTEM INVENTORY PERUSAHAAN</h1>
    <h2>LAPORAN STOK BARANG KESELURUHAN</h2>
    <p>Dicetak pada: <strong>{{ $tanggal }}</strong></p>
  </div>

  <!-- Summary -->
  <div class="summary">
    <table>
      <tr>
        <td width="50%"><strong>Total Jenis Barang</strong></td>
        <td width="50%"><strong>Total Unit Barang</strong></td>
      </tr>
      <tr>
        <td>: {{ number_format($total_produk, 0, ',', '.') }} jenis</td>
        <td>: {{ number_format($total_stok, 0, ',', '.') }} unit</td>
      </tr>
    </table>
  </div>

  <!-- Data Produk -->
  <table class="main-table">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="12%">Kode Barang</th>
        <th width="25%">Nama Barang</th>
        <th width="15%">Kategori</th>
        <th width="8%" class="text-center">Stok</th>
        <th width="20%">Status (Kondisi)</th>
        <th width="15%">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $index => $product)
      <tr>
        <td class="text-center">{{ $index + 1 }}</td>
        <td>
          <span class="kode-barang">{{ $product->kode ?? '-' }}</span>
        </td>
        <td>
          <strong>{{ $product->nama }}</strong>
          @if($product->deleted_at)
            <div style="color:#991b1b; font-size:9px; font-style:italic; margin-top:2px;">
              (Barang dihapus)
            </div>
          @endif
        </td>
        <td>{{ $product->kategori }}</td>
        <td class="text-center">
          <strong>{{ $product->stok }}</strong>
        </td>
        <td class="status-detail">
          <!-- MENAMPILKAN DETAIL KONDISI BARANG -->
          @if($product->stok_bagus > 0)
            <div class="status-bagus">
              <strong>Bagus:</strong> {{ $product->stok_bagus }}
            </div>
          @endif
          @if($product->stok_kurang_bagus > 0)
            <div class="status-kurang">
              <strong>Kurang Bagus:</strong> {{ $product->stok_kurang_bagus }}
            </div>
          @endif
          @if($product->stok == 0)
            <div style="color:#6b7280; font-style:italic;">
              Tidak ada stok
            </div>
          @endif
        </td>
        <td>
          @if($product->keterangan)
            {{ Str::limit($product->keterangan, 40) }}
          @else
            <span style="color:#9ca3af; font-style:italic;">-</span>
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center" style="padding: 20px; color: #666;">
          Tidak ada data barang
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Footer / Signature -->
  <div class="footer">
    <table width="100%" style="border: 0; text-align: center; margin-top: 60px;">
      <tr>
        <td width="50%">
          <p>Mengetahui,</p>
          <div class="signature-line"></div>
          <p><strong>Kepala Bagian</strong></p>
        </td>
        <td width="50%">
          <p>Dibuat oleh,</p>
          <div class="signature-line"></div>
          <p><strong>Petugas Inventory</strong></p>
        </td>
      </tr>
    </table>
  </div>

</body>
</html>
