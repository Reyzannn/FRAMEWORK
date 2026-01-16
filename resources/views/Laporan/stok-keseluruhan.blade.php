<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Stok Keseluruhan - Sistem Inventory</title>
  <style>
    body { font-family: Arial, sans-serif; color: #333; font-size: 12px; }

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
    .header p { margin: 3px 0; color: #666; }

    /* Summary Box */
    .summary {
      background: #f8f9fa;
      padding: 12px;
      border-radius: 8px;
      border-left: 4px solid #1C2B1A;
      margin-bottom: 20px;
    }
    .summary table { width: 100%; }
    .summary td { padding: 4px 0; }
    .summary strong { color: #1C2B1A; }

    /* Status Badges */
    .status-badge {
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 10px;
      font-weight: bold;
      display: inline-block;
      min-width: 70px;
      text-align: center;
    }
    .status-bagus {
      background: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
    }
    .status-rusak {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }
    .status-perbaikan {
      background: #fef9c3;
      color: #854d0e;
      border: 1px solid #fde047;
    }
    .status-habis {
      background: #f3f4f6;
      color: #6b7280;
      border: 1px solid #d1d5db;
    }

    /* Stok Indicator */
    .stok-indicator {
      font-size: 9px;
      padding: 2px 6px;
      border-radius: 8px;
      margin-top: 3px;
      display: inline-block;
    }
    .stok-habis { background: #fef2f2; color: #dc2626; }
    .stok-minim { background: #fffbeb; color: #d97706; }
    .stok-cukup { background: #f0fdf4; color: #16a34a; }

    /* Table Style */
    table.main-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    .main-table th {
      background: #1C2B1A;
      color: white;
      padding: 10px 8px;
      font-size: 11px;
      font-weight: bold;
      text-align: left;
      border: 1px solid #ddd;
    }
    .main-table td {
      padding: 9px 8px;
      border: 1px solid #ddd;
      vertical-align: middle;
    }
    .main-table tr:nth-child(even) { background: #f9f9f9; }

    /* Highlight untuk stok rendah */
    .stok-rendah-row {
      background: #fff7ed !important;
    }
    .stok-habis-row {
      background: #fef2f2 !important;
    }

    /* Kode barang styling */
    .kode-barang {
      font-family: 'Courier New', monospace;
      font-weight: bold;
      color: #1C2B1A;
      background: #f0fdf4;
      padding: 2px 6px;
      border-radius: 4px;
      border: 1px solid #bbf7d0;
    }

    /* Footer / Signature */
    .footer {
      margin-top: 50px;
      display: flex;
      justify-content: space-between;
      font-size: 11px;
    }
    .signature-box {
      width: 45%;
      text-align: center;
      padding-top: 40px;
    }
    .signature-line {
      width: 70%;
      margin: 40px auto 5px;
      border-top: 1px solid #333;
    }

    /* Page break untuk print */
    @media print {
      .no-print { display: none; }
      .page-break { page-break-before: always; }
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
        <td width="25%"><strong>Total Jenis Barang</strong></td>
        <td width="25%">: {{ number_format($total_produk, 0, ',', '.') }} jenis</td>
      </tr>
      <tr>
        <td><strong>Total Unit Barang</strong></td>
        <td>: {{ number_format($total_stok, 0, ',', '.') }} unit</td>
      </tr>
    </table>
  </div>

  <!-- Data Produk -->
  <table class="main-table">
    <thead>
      <tr>
        <th width="4%">No</th>
        <th width="12%">Kode Barang</th>
        <th width="25%">Nama Barang</th>
        <th width="15%">Kategori</th>
        <th width="8%" class="text-center">Stok</th>
        <th width="10%">Status Barang</th>
        <th width="26%">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $index => $product)
      @php
        // Tentukan badge status
        $statusBadgeClass = 'status-bagus';
        $statusText = 'BAGUS';

        if (strtolower($product->status) == 'rusak') {
          $statusBadgeClass = 'status-rusak';
          $statusText = 'RUSAK';
        } elseif (strtolower($product->status) == 'perbaikan') {
          $statusBadgeClass = 'status-perbaikan';
          $statusText = 'PERBAIKAN';
        } elseif (strtolower($product->status) == 'habis') {
          $statusBadgeClass = 'status-habis';
          $statusText = 'HABIS';
        }
      @endphp
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>
          <div class="kode-barang">{{ $product->kode ?? 'TANPA KODE' }}</div>
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
        <td style="text-align: center;">
          <div style="font-size:14px; font-weight:bold; color:#1C2B1A;">
            {{ $product->stok }}
          </div>
        </td>
        <td>
          <span class="status-badge {{ $statusBadgeClass }}">
            {{ $statusText }}
          </span>
        </td>
        <td>
          @if($product->keterangan)
            {{ Str::limit($product->keterangan, 50) }}
          @else
            <span style="color:#9ca3af; font-style:italic;">Barang yang tersedia di inventaris</span>
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
          Tidak ada data barang
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Footer / Signature -->
  <div class="footer">
    <table width="100%" style="border: 0; text-align: center;">
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

</body>
</html>
