@extends('layouts.app')

@section('content')
<section id="section-laporan" class="page-section active">
  <div class="bg-white rounded-2xl card-shadow overflow-hidden">
    <!-- Header Biru Gradient -->
    <div class="bg-gradient-to-r from-[#4361EE] to-[#3A0CA3] px-6 py-5">
      <h3 class="text-2xl font-bold text-white">Laporan</h3>
      <p class="text-white text-sm opacity-90 mt-1">Laporan Stok dan Transaksi</p>
    </div>

    <!-- Form Pilih Laporan -->
    <div class="p-6 bg-gray-50 border-b">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end">
        <!-- Jenis Laporan -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">JENIS LAPORAN</label>
          <select id="jenis-laporan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="stok">Laporan Stok</option>
            <option value="transaksi">Laporan Transaksi</option>
            <option value="penjualan">Laporan Penjualan</option>
          </select>
        </div>

        <!-- Periode -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">PERIODE</label>
          <select id="periode-laporan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option>Semu Waktu</option>
            <option>Hari Ini</option>
            <option>Minggu Ini</option>
            <option>Bulan Ini</option>
            <option>Tahun Ini</option>
            <option>Custom Range</option>
          </select>
        </div>

        <!-- Tombol Generate -->
        <div>
          <button id="btn-generate-laporan" class="w-full bg-gradient-to-r from-[#4361EE] to-[#3A0CA3] text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all hover:from-[#3A0CA3] hover:to-[#2a0b8a] flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Generate Laporan
          </button>
        </div>
      </div>
    </div>

    <!-- Hasil Laporan -->
    <div class="p-8">
      <h4 class="text-lg font-semibold text-gray-800 mb-6">Hasil Laporan</h4>
      
      <div id="hasil-laporan" class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-12 text-center">
        <div class="text-gray-500">
          <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <p class="text-lg font-medium">(Ini masih bersifat opsional, hanya gambaran saja)</p>
          <p class="text-sm mt-2">Pilih jenis laporan dan periode, lalu klik "Generate Laporan" untuk menampilkan hasil.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection