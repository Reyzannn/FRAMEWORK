@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-lime-800 mb-1">Barang Keluar</h2>
        <p class="text-gray-500">Catatan pengurangan stok barang</p>
    </div>
</div>
@endsection

@section('content')
<section class="page-section active">
    <div class="bg-white rounded-2xl card-shadow overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-[#1C2B1A] to-[#445a41] px-6 py-4">
            <h3 class="text-xl font-semibold text-white">📤 Barang Keluar</h3>
            <p class="text-white text-sm opacity-90">Daftar pengurangan stok barang dengan alasan</p>
        </div>

        @if(session('success'))
        <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <!-- FILTER INFO - HANYA TAMPIL JIKA ADA PRODUK DIHAPUS -->
        @php
            $deletedCount = $barangKeluar->filter(function($item) {
                return $item->produk && $item->produk->trashed();
            })->count();
        @endphp

        @if($deletedCount > 0)
        <div class="px-6 py-3 border-b bg-yellow-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-yellow-700 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>
                        Terdapat <span class="font-bold">{{ $deletedCount }}</span> produk yang telah dihapus dari daftar barang
                    </span>
                </div>
                <div>
                    <button onclick="toggleDeletedProducts()"
                            class="text-sm bg-yellow-100 text-yellow-800 hover:bg-yellow-200 px-3 py-1.5 rounded-lg flex items-center gap-1 transition-colors">
                        <svg id="toggle-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                        <span id="toggle-text">Sembunyikan produk yang dihapus</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- TABEL -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-medium text-gray-500 border-b">
                        <th class="px-6 py-4 text-left">NO</th>
                        <th class="px-6 py-4 text-left">TANGGAL</th>
                        <th class="px-6 py-4 text-left">PRODUK</th>
                        <th class="px-6 py-4 text-left">JUMLAH</th>
                        <th class="px-6 py-4 text-left">ALASAN</th>
                        <th class="px-6 py-4 text-left">KETERANGAN</th>
                        <th class="px-6 py-4 text-left">PETUGAS</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100" id="table-body">
                    @forelse($barangKeluar as $index => $keluar)
                    <tr class="text-sm text-gray-600 hover:bg-gray-50
                               @if($keluar->produk && $keluar->produk->trashed()) deleted-product @endif">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>

                        <!-- TANGGAL -->
                        <td class="px-6 py-4">
                            @if($keluar->tanggal_keluar)
                                <p class="font-medium text-gray-800">
                                    {{ date('d/m/Y', strtotime($keluar->tanggal_keluar)) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $keluar->created_at->format('H:i') }}
                                </p>
                            @else
                                <p class="font-medium text-gray-800">-</p>
                            @endif
                        </td>

                        <!-- PRODUK DENGAN STATUS -->
                        <td class="px-6 py-4">
                            <!-- NAMA PRODUK -->
                            @if($keluar->produk)
                                <p class="font-medium text-gray-800">
                                    {{ $keluar->produk->nama }}
                                    @if($keluar->produk->trashed())
                                        <span class="ml-1 text-red-500">*</span>
                                    @endif
                                </p>

                                <!-- KODE + BADGE -->
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-500">
                                        Kode: {{ $keluar->produk->kode }}
                                    </span>

                                    @if($keluar->produk->trashed())
                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded-full border border-red-200 font-medium">
                                        ⚠️ DIHAPUS
                                    </span>
                                    @endif
                                </div>

                                <!-- INFO TAMBAHAN JIKA DIHAPUS -->
                                @if($keluar->produk->trashed())
                                <div class="mt-1 text-red-600 text-xs italic">
                                    Data disimpan untuk riwayat transaksi
                                </div>
                                @endif
                            @else
                                <div class="bg-red-50 p-2 rounded border border-red-200">
                                    <p class="font-medium text-red-700">⚠️ PRODUK TIDAK DITEMUKAN</p>
                                    <p class="text-xs text-red-600 mt-1">ID: {{ $keluar->produk_id }}</p>
                                </div>
                            @endif
                        </td>

                        <!-- JUMLAH -->
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                - {{ $keluar->jumlah }}
                            </span>
                        </td>

                        <!-- ALASAN DENGAN WARNA -->
                        <td class="px-6 py-4">
                            @php
                                $alasanColors = [
                                    'rusak' => 'bg-red-100 text-red-800 border-red-200',
                                    'habis' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'dipinjam' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'hilang' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    'dijual' => 'bg-green-100 text-green-800 border-green-200',
                                    'lainnya' => 'bg-purple-100 text-purple-800 border-purple-200',
                                ];
                                $color = $alasanColors[$keluar->alasan] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium border {{ $color }}">
                                {{ ucfirst($keluar->alasan) }}
                            </span>
                        </td>

                        <!-- KETERANGAN -->
                        <td class="px-6 py-4">
                            {{ $keluar->keterangan ?? '-' }}
                        </td>

                        <!-- PETUGAS -->
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-800">
                                {{ $keluar->dilakukan_oleh }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada catatan barang keluar</p>
                                <p class="text-sm mt-1">Pengurangan stok akan tercatat di sini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- INFO JUMLAH -->
        <div class="px-6 py-4 border-t bg-gray-50">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Total: <span class="font-semibold">{{ count($barangKeluar) }}</span> catatan barang keluar
                    @if($deletedCount > 0)
                        <span class="ml-2 text-red-600">
                            ({{ $deletedCount }} produk telah dihapus)
                        </span>
                    @endif
                </div>
                <div class="text-xs text-gray-500">
                    @if($deletedCount > 0)
                        * Produk dengan tanda ini telah dihapus dari daftar barang
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>

<style>
.deleted-product {
    background-color: #fef2f2 !important;
}
.deleted-product:hover {
    background-color: #fee2e2 !important;
}
</style>

<script>
let showDeletedProducts = true;

function toggleDeletedProducts() {
    const rows = document.querySelectorAll('.deleted-product');
    const toggleText = document.getElementById('toggle-text');
    const toggleIcon = document.getElementById('toggle-icon');

    if (showDeletedProducts) {
        // Sembunyikan produk yang dihapus
        rows.forEach(row => {
            row.style.display = 'none';
        });
        toggleText.textContent = 'Tampilkan produk yang dihapus';

        // Ganti icon mata tertutup
        toggleIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
        showDeletedProducts = false;
    } else {
        // Tampilkan produk yang dihapus
        rows.forEach(row => {
            row.style.display = '';
        });
        toggleText.textContent = 'Sembunyikan produk yang dihapus';

        // Ganti icon mata terbuka
        toggleIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
        `;
        showDeletedProducts = true;
    }
}
</script>
@endsection
