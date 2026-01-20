<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Barang Dipinjam</title>
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
      background: #fff7ed;
      padding: 12px;
      border-radius: 8px;
      border-left: 4px solid #ea580c;
      margin-bottom: 20px;
    }
    .summary table { width: 100%; }
    .summary td { padding: 4px 0; }
    .summary strong { color: #ea580c; }

    /* Warning Box */
    .warning-box {
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 6px;
      padding: 10px;
      margin-bottom: 15px;
      font-size: 11px;
      color: #991b1b;
    }

    /* Table Style */
    table.main-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      table-layout: fixed;
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
      vertical-align: top;
      word-wrap: break-word;
    }
    .main-table tr:nth-child(even) { background: #f9f9f9; }

    /* Barang dihapus */
    .deleted-item {
      background: #fef2f2 !important;
      color: #991b1b;
      font-style: italic;
    }
    .deleted-badge {
      background: #fecaca;
      color: #991b1b;
      padding: 2px 6px;
      border-radius: 10px;
      font-size: 9px;
      font-weight: bold;
      margin-left: 5px;
    }

    /* Status */
    .status-dipinjam {
      background: #fef9c3;
      color: #854d0e;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 10px;
      font-weight: bold;
      display: inline-block;
    }

    /* Footer */
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

    /* Utility */
    .text-center { text-align: center; }

    @media print {
      body { margin: 0.5in; padding: 0; }
      .main-table { border: 1px solid #000 !important; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <h1>SISTEM INVENTORY PERUSAHAAN</h1>
    <h2>LAPORAN BARANG SEDANG DIPINJAM</h2>
    <p>Dicetak pada: <strong>{{ $tanggal }}</strong></p>
  </div>

  <!-- Summary -->
  <div class="summary">
    <table>
      <tr>
        <td width="33%"><strong>Total Transaksi Peminjaman</strong></td>
        <td width="34%"><strong>Total Barang Dipinjam</strong></td>
      </tr>
      <tr>
        <td>: {{ number_format($total_transaksi, 0, ',', '.') }} transaksi</td>
        <td>: {{ number_format($total_dipinjam, 0, ',', '.') }} unit</td>
      </tr>
    </table>
  </div>

  <!-- Warning untuk barang yang sudah dihapus -->
  @if($deleted_count > 0)
  <div class="warning-box">
    ⚠ Terdapat <strong>{{ $deleted_count }} produk</strong> yang telah dihapus dari daftar barang,
    tetapi masih tercatat dalam riwayat peminjaman.
  </div>
  @endif

  <!-- Data Barang Dipinjam -->
  <table class="main-table">
    <thead>
      <tr>
        <th width="6%">No</th>
        <th width="14%">Tanggal Keluar</th>
        <th width="22%">Produk</th>
        <th width="12%">Kode</th>
        <th width="10%" class="text-center">Jumlah</th>
        <th width="18%">Alasan</th>
        <th width="18%">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @forelse($barangDipinjam as $index => $item)
      @php
        $isDeleted = $item->produk && $item->produk->deleted_at;
        $tanggalFormatted = $item->tanggal_keluar
            ? \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y H:i')
            : '-';
      @endphp
      <tr class="{{ $isDeleted ? 'deleted-item' : '' }}">
        <td class="text-center">{{ $index + 1 }}</td>
        <td>{{ $tanggalFormatted }}</td>
        <td>
          @if($item->produk)
            <strong>{{ $item->produk->nama }}</strong>
            @if($isDeleted)
              <span class="deleted-badge">DIHAPUS</span>
            @endif
          @else
            <span style="color: #991b1b;">Produk tidak ditemukan</span>
          @endif
        </td>
        <td>
          @if($item->produk)
            {{ $item->produk->kode ?? '-' }}
          @else
            -
          @endif
        </td>
        <td class="text-center">
          <strong style="color: #ea580c;">{{ $item->jumlah }}</strong>
          <div style="font-size:9px; color:#666;">unit</div>
        </td>
        <td>
          <span class="status-dipinjam">{{ $item->alasan }}</span>
        </td>
        <td>{{ $item->keterangan ?? 'Tidak ada keterangan' }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center" style="padding: 20px; color: #666;">
          Tidak ada data barang dipinjam
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Catatan Kaki -->
  <div style="margin-top: 20px; font-size: 10px; color: #666; border-top: 1px dashed #ddd; padding-top: 10px;">
    <p><strong>Catatan:</strong></p>
    <ul style="margin: 5px 0; padding-left: 15px;">
      <li>Barang dengan status <span style="color:#991b1b;">DIHAPUS</span> berarti sudah tidak ada di daftar barang aktif, tetapi riwayatnya tetap disimpan.</li>
      <li>Laporan ini hanya menampilkan barang dengan alasan mengandung kata "pinjam".</li>
      <li>Total barang dipinjam dihitung berdasarkan jumlah (unit) yang tercatat.</li>
    </ul>
  </div>

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
