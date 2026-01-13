<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  </head>
  <body class="h-full text-gray-900">
    <!-- overlay so background image is visible but content readable -->
    <div class="page-overlay">
      <div class="flex h-full min-h-screen">
        <!-- Sidebar -->
        @include('widgets.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
             @include('widgets.header')
          <main class="flex-1 p-8 overflow-auto">
            <!-- Dashboard Section -->
            <section id="section-dashboard" class="page-section active">
              <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-white rounded-2xl p-6 card-shadow">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                      <p id="total-products" class="text-3xl font-bold text-gray-800">2</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-xl">
                      <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 card-shadow border-l-4 border-red-500">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-gray-500 text-sm font-medium mb-1">Stok Rendah</p>
                      <p id="low-stock-count" class="text-3xl font-bold text-red-600">1</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-xl">
                      <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 card-shadow">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-gray-500 text-sm font-medium mb-1">Total Nilai Stok</p>
                      <p id="total-stock-value" class="text-2xl font-bold text-green-600">Rp 1.000.000</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-xl">
                      <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 card-shadow">
                  <h3 class="text-lg font-semibold text-red-600 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    Stok Rendah
                  </h3>
                  <div class="bg-red-50 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                      <div>
                        <p class="font-medium text-gray-800">Mouse Wireless Logitech</p>
                        <p class="text-sm text-gray-500">Kode: MWL001</p>
                      </div>
                      <div class="text-right">
                        <p class="text-lg font-bold text-red-600">3 pcs</p>
                        <p class="text-xs text-gray-500">Stok tersisa</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="bg-white rounded-2xl p-6 card-shadow">
                  <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    Aktivitas Terbaru
                  </h3>
                  <div class="bg-green-50 rounded-xl p-4">
                    <div class="flex items-center">
                      <div class="bg-green-500 w-3 h-3 rounded-full mr-3"></div>
                      <div>
                        <p class="font-medium text-gray-800">Login berhasil</p>
                        <p class="text-sm text-gray-500">Baru saja</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Tambah Produk Section -->


          <!-- Daftar Produk Section -->
<!-- Daftar Produk Section -->
<!-- Daftar Produk Section -->
<section id="section-daftar" class="page-section">
  <div class="bg-white rounded-2xl card-shadow overflow-hidden">
    <div class="bg-gradient-to-r from-[#4361EE] to-[#3A0CA3] px-6 py-4">
      <h3 class="text-xl font-semibold text-white">Daftar Produk</h3>
      <p class="text-white text-sm opacity-90">Kelola semua produk dalam inventori</p>
    </div>

    <div class="p-6 border-b">
      <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1 relative">
          <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <select class="px-4 py-2 border rounded-lg">
          <option>Semua Kategori</option>
        </select>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-xs font-medium text-gray-500 border-b">
            <th class="px-6 py-4 text-left">PRODUK</th>
            <th class="px-6 py-4 text-left">KATEGORI</th>
            <th class="px-6 py-4 text-center">STOK</th>
            <th class="px-6 py-4 text-right">HARGA</th>
            <th class="px-6 py-4 text-center">STATUS</th>
            <th class="px-6 py-4 text-center">AKSI</th>
          </tr>
        </thead>
        <tbody id="table-produk" class="divide-y divide-gray-100">
          <!-- diisi oleh JS -->
        </tbody>
      </table>
    </div>
  </div>
</section>
            <!-- Laporan Section -->
            <!-- Laporan Section -->
<section id="section-laporan" class="page-section">
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
<script src="{{ asset('js/dashboard.js') }}"></script>
      </body>
</html>
