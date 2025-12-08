@extends('layouts.app')
@section('content')

@section('title', 'Daftar Produk')

@section('header')
            <div class="flex items-center justify-between">
              <div>
                <h2 id="header-title" class="text-3xl font-bold text-blue-600 mb-1">Daftar Produk</h2>
                <p id="welcome-message" class="text-gray-500">Kelola semua produk dalam inventori</p>
              </div>
            </div>
@endsection

<section id="section-daftar" class="page-section active">
  <div class="bg-white rounded-2xl card-shadow overflow-hidden">

    <div class="bg-gradient-to-r from-[#4361EE] to-[#3A0CA3] px-6 py-4">
      <h3 class="text-xl font-semibold text-white">Daftar Produk</h3>
      <p class="text-white text-sm opacity-90">Kelola semua produk dalam inventori</p>
    </div>

    <form action="{{ route('produk.index') }}" method="get">
      <div class="p-6 border-b">
        <div class="flex flex-col sm:flex-row gap-4">

          <div class="flex-1 relative">
            <input name="search" type="text" placeholder="Cari produk..."
                   class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>

          <form action="{{ route('produk.index') }}" method="GET" class="col-md-3">
                <div class="input-group px-4 py-2 border rounded-lg">
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="Elektronik" {{ request('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="Alat Tulis" {{ request('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                        <option value="Alat Mandi" {{ request('kategori') == 'Alat Mandi' ? 'selected' : '' }}>Alat Mandi</option>
                        <option value="Jajan" {{ request('kategori') == 'Jajan' ? 'selected' : '' }}>Jajan</option>
                        <option value="Kecantikan" {{ request('kategori') == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                        <option value="Alat Dapur" {{ request('kategori') == 'Alat Dapur' ? 'selected' : '' }}>Alat Dapur</option>
                    </select>
                </div>
            </form>

        </div>
      </div>
    </form>

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
          @foreach($products as $product)
          <tr class="text-sm text-gray-600">

            <td class="px-6 py-4">
              <p class="font-medium text-gray-800">{{ $product->nama }}</p>
              <p class="text-xs text-gray-500 mt-1">Kode: {{ $product->kode }}</p>
            </td>

            <td class="px-6 py-4">{{ $product->kategori }}</td>

            <td class="px-6 py-4 text-center">
              {{ $product->stok }} {{ $product->satuan }}
            </td>

            <td class="px-6 py-4 text-right">
              Rp {{ number_format($product->harga, 0, ',', '.') }}
            </td>

            <td class="px-6 py-4 text-center">
              @if($product->stok <= $product->stok_minim)
                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">Rendah</span>
              @else
                <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Cukup</span>
              @endif
            </td>

            <td class="px-6 py-4 text-center">
              <div class="flex items-center justify-center gap-2">

                {{-- Tombol Edit --}}
                <a href="{{ route('produk.edit', $product->id) }}"
                   class="w-9 h-9 rounded-lg bg-[#4361EE] hover:bg-[#3A0CA3] text-white flex items-center justify-center shadow-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>

                {{-- Tombol Delete --}}
                <form action="{{ route('produk.destroy', $product->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure?')"
                          class="w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </form>

              </div>
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</section>

@endsection
