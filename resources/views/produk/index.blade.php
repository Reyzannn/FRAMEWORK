@extends('layouts.app')

@section('content')
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
          <input name="search" type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <select name="kategori" class="px-4 py-2 border rounded-lg" value="{{ request('kategori') }}">
            <option>Semua Kategori</option>
          <option>elektronik</option>
            <option value="alat_tulis">alat tulis</option>

        </select>
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
                <td class="px-6 py-4 text-center">{{ $product->stok }} {{ $product->satuan }}</td>
                <td class="px-6 py-4 text-right">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-center">
                @if($product->stok <= $product->stok_minim)
                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">Rendah</span>
                @else
                <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Cukup</span>
                @endif
                </td>
                <td class="px-6 py-4 text-center">
                <a href="#" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection