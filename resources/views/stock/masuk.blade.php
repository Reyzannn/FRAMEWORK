    @extends('layouts.app')
    @section('content')

    @section('title', 'Barang Masuk')

    @section('header')
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-lime-800 mb-1">Barang Masuk</h2>
                <p class="text-gray-500">Produk yang baru ditambahkan ke sistem</p>
            </div>
        </div>
    @endsection

    <section class="page-section active">
        <div class="bg-white rounded-2xl card-shadow overflow-hidden">

            <!-- HEADER SAMA -->
            <div class="bg-gradient-to-r from-[#1C2B1A] to-[#445a41] px-6 py-4">
                <h3 class="text-xl font-semibold text-white">📥 Barang Masuk</h3>
                <p class="text-white text-sm opacity-90">Daftar produk yang baru ditambahkan ke inventory</p>
            </div>

            <!-- SEARCH & FILTER SAMA -->
            <form action="{{ route('stock.masuk') }}" method="get">
                <div class="p-6 border-b">
                    <div class="flex flex-col sm:flex-row gap-4">

                        <div class="flex-1 relative">
                            <input name="search" type="text" value="{{ request('search') }}" placeholder="Cari barang masuk..."
                                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <div class="px-4 py-2 border rounded-lg">
                            <select name="kategori" class="form-select w-full" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @php $kategoris = ['Elektronik','Alat Tulis','Alat Mandi','Jajan','Kecantikan','Alat Dapur']; @endphp
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </form>

            <!-- TABEL SAMA, TAPI DATA BERBEDA -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-medium text-gray-500 border-b">
                            <th class="px-6 py-4 text-left">NO</th>
                            <th class="px-6 py-4 text-left">TANGGAL MASUK</th>
                            <th class="px-6 py-4 text-left">PRODUK</th>
                            <th class="px-6 py-4 text-left">KATEGORI</th>
                            <th class="px-6 py-4 text-center">STOK</th>
                            <th class="px-6 py-4 text-center">STATUS</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($barangMasuk as $index => $product)
                            <tr class="text-sm text-gray-600 hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">{{ $product->created_at->format('d/m/Y') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $product->created_at->format('H:i') }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">{{ $product->nama }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Kode: {{ $product->kode }}</p>
                                </td>

                                <td class="px-6 py-4">{{ $product->kategori }}</td>

                                <td class="px-6 py-4 text-center font-semibold">
                                    {{ $product->stok }}
                                </td>

                                <td class="px-6 py-4">
                                    {!! $product->status_display !!}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada barang masuk</p>
                                        <p class="text-sm mt-1">Produk yang baru ditambahkan akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    @endsection
