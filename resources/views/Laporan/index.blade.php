@extends('layouts.app')

@section('content')

@section('title', 'Laporan')

@section('header')
            <div class="flex items-center justify-between">
              <div>
                <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Laporan</h2>
                <p id="welcome-message" class="text-gray-500">Lihat laporan penjualan dan inventori</p>
              </div>
            </div>
@endsection


<section id="section-laporan" class="page-section active">
  <div class="bg-white rounded-2xl card-shadow overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#1C2B1A] to-[#445a41] px-6 py-5">
      <h3 class="text-2xl font-bold text-white">Laporan</h3>
      <p class="text-white text-sm opacity-90 mt-1">Laporan Stok dan Transaksi</p>
    </div>

    <!-- Form Pilih Laporan -->
    <div class="p-6 bg-gray-50 border-b">
      <form method="POST" action="{{ route('laporan.proses') }}" id="form-laporan">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">

<!-- Jenis Laporan -->
    <div class="md:col-span-5">
    <label for="jenis_laporan" class="block text-sm font-medium text-gray-700 mb-2">
        Jenis Laporan
    </label>
    <select name="jenis_laporan" id="jenis_laporan"
        class="w-full px-5 py-4 text-gray-700 text-base border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        required>
        <option value="">-- Pilih Jenis Laporan --</option>
        <option value="stok" {{ old('jenis_laporan') == 'stok' ? 'selected' : '' }}>
            Laporan Stok Keseluruhan
        </option>
        <option value="penjualan" {{ old('jenis_laporan') == 'penjualan' ? 'selected' : '' }}>
            Laporan Peminjaman
        </option>
    </select>
    </div>

          <!-- Tombol Preview (dipindah ke atas) -->
<div class="md:col-span-4">
  <button type="submit" name="aksi" value="previwe"
          class="w-full bg-gradient-to-r from-[#1C2B1A] to-[#445a41] text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>

    Preview Laporan
  </button>
</div>

<!-- Tombol Preview (dipindah ke bawah) -->
<div class="md:col-span-3">
  <button type="submit" name="aksi" value="download"
          class="w-full bg-gradient-to-r from-[#1C2B1A] to-[#445a41] text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all flex items-center justify-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
    </svg>
    Download PDF
  </button>
</div>
        </div>
      </form>
    </div>

    <!-- Hasil Preview Laporan (hanya muncul kalau preview) -->
    <div class="p-8">
      <h4 class="text-lg font-semibold text-gray-800 mb-6">Hasil Laporan</h4>

      <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl p-8 min-h-96">
        @if(session('preview'))
          {!! session('preview') !!}
        @else
          <div class="text-center text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2-2z"/>
            </svg>
            <p class="text-lg font-medium">Pilih jenis laporan, lalu klik Preview atau Download</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
