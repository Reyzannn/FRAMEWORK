@extends('layouts.app')

@section('content')
@section('title', 'Edit Produk')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Edit Barang</h2>
        <p id="welcome-message" class="text-gray-500">Perbarui informasi barang</p>
    </div>
</div>
@endsection

<section id="section-edit" class="page-section active">
    <form action="{{ route('produk.update', $product->id) }}" method="post" id="form-edit-produk">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl p-6 card-shadow">
            <h3 class="text-xl font-semibold mb-6">Informasi Dasar</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Nama Barang</label>
                        <input name="nama" id="input-nama" value="{{ old('nama', $product->nama) }}"
                               class="mt-2 w-full border rounded-lg px-3 py-2.5" required />
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-medium">Kode Barang</label>
                        <input value="{{ $product->kode }}"
                               class="mt-2 w-full border rounded-lg px-3 py-2.5 bg-gray-50" readonly />
                        <input type="hidden" name="kode" value="{{ $product->kode }}">
                        <p class="text-xs text-gray-500 mt-1">Kode tidak dapat diubah</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-medium">Kategori</label>
                        <select name="kategori" id="input-kategori" class="mt-2 w-full border rounded-lg px-3 py-2.5" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik" {{ old('kategori', $product->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Alat Tulis" {{ old('kategori', $product->kategori) == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                            <option value="Alat Mandi" {{ old('kategori', $product->kategori) == 'Alat Mandi' ? 'selected' : '' }}>Alat Mandi</option>
                            <option value="Jajan" {{ old('kategori', $product->kategori) == 'Jajan' ? 'selected' : '' }}>Jajan</option>
                            <option value="Alas Kaki" {{ old('kategori', $product->kategori) == 'Alas Kaki' ? 'selected' : '' }}>Alas Kaki</option>
                            <option value="Kecantikan" {{ old('kategori', $product->kategori) == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                            <option value="Alat Dapur" {{ old('kategori', $product->kategori) == 'Alat Dapur' ? 'selected' : '' }}>Alat Dapur</option>
                        </select>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- Total Stok -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Total Stok</label>
                        <input name="stok" id="input-stok" type="number" min="0"
                               value="{{ old('stok', $product->stok) }}"
                               class="mt-2 w-full border rounded-lg px-3 py-2.5" required
                               oninput="validateStok(); toggleFormPengurangan();" />
                        <p class="text-xs text-gray-500 mt-1">Total keseluruhan barang</p>
                    </div>

                    <!-- DETAIL KONDISI BARANG -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Detail Kondisi Barang</h4>

                        <!-- Bagus -->
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-1">
                                <label class="text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                        <span>Bagus</span>
                                    </div>
                                </label>
                                <span class="text-xs text-gray-500">Jumlah:</span>
                            </div>
                            <input name="stok_bagus" id="input-stok-bagus" type="number" min="0"
                                value="{{ old('stok_bagus', $product->stok_bagus) }}"
                                class="w-full border border-green-200 rounded-lg px-3 py-2"
                                oninput="validateStok()" required />
                        </div>

                        <!-- Kurang Bagus -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label class="text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                        <span>Kurang Bagus</span>
                                    </div>
                                </label>
                                <span class="text-xs text-gray-500">Jumlah:</span>
                            </div>
                            <input name="stok_kurang_bagus" id="input-stok-kurang-bagus" type="number" min="0"
                                value="{{ old('stok_kurang_bagus', $product->stok_kurang_bagus) }}"
                                class="w-full border border-yellow-200 rounded-lg px-3 py-2"
                                oninput="validateStok()" required />
                        </div>

                        <!-- Validasi -->
                        <div id="stok-validation" class="mt-4 p-3 text-sm rounded hidden">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="validation-message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAMPILKAN JIKA STOK BERKURANG -->
            @php
                $stokLama = $product->stok;
                $stokBaru = old('stok', $product->stok);
                $stokBerkurang = $stokBaru < $stokLama;
            @endphp

            @if($stokBerkurang)
            <div id="form-pengurangan-stok" class="mt-8 p-6 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="text-sm font-medium text-yellow-800 mb-3">Form Pengurangan Stok</h4>
                <p class="text-xs text-yellow-600 mb-4">Stok berkurang dari sebelumnya ({{ $stokLama }} unit)</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Alasan Pengurangan</label>
                        <select name="alasan_pengurangan" class="mt-2 w-full border rounded-lg px-3 py-2.5">
                            <option value="">Pilih Alasan</option>
                            <option value="rusak" {{ old('alasan_pengurangan') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="hilang" {{ old('alasan_pengurangan') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            <option value="dipinjam" {{ old('alasan_pengurangan') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="lainnya" {{ old('alasan_pengurangan') == 'lainnya' ? 'selected' : '' }}>Lainnya (Tuliskan di Deskripsi)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-medium">Tanggal Keluar</label>
                        <input name="tanggal_keluar" type="date" value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                               class="mt-2 w-full border rounded-lg px-3 py-2.5" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600 font-medium">Keterangan (Opsional)</label>
                        <textarea name="keterangan" rows="2"
                                  class="mt-2 w-full border rounded-lg px-3 py-2.5">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tombol -->
            <div class="mt-8 flex space-x-3">
                <button type="submit" id="simpan-perubahan"
                        class="px-5 py-2.5 bg-lime-800 text-white rounded-lg font-semibold hover:bg-lime-900 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('produk.index') }}"
                   class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</section>

<script>
function validateStok() {
    const totalStok = parseInt(document.getElementById('input-stok').value) || 0;
    const stokBagus = parseInt(document.getElementById('input-stok-bagus').value) || 0;
    const stokKurangBagus = parseInt(document.getElementById('input-stok-kurang-bagus').value) || 0;

    // Hanya jumlahkan 2 kondisi
    const totalDetail = stokBagus + stokKurangBagus;
    const validationDiv = document.getElementById('stok-validation');
    const message = document.getElementById('validation-message');
    const submitBtn = document.getElementById('simpan-perubahan');

    if (totalDetail === totalStok) {
        validationDiv.className = 'mt-4 p-3 text-sm rounded bg-green-50 text-green-700 border border-green-200';
        message.textContent = `✓ Valid! Total detail (${totalDetail}) sama dengan Total Stok (${totalStok})`;
        validationDiv.classList.remove('hidden');
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        validationDiv.className = 'mt-4 p-3 text-sm rounded bg-red-50 text-red-700 border border-red-200';
        message.textContent = `✗ Tidak valid! Total detail (${totalDetail}) tidak sama dengan Total Stok (${totalStok})`;
        validationDiv.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

function toggleFormPengurangan() {
    const totalStokInput = document.getElementById('input-stok');
    const stokLama = parseInt('{{ $product->stok }}') || 0;
    const stokBaru = parseInt(totalStokInput.value) || 0;
    const formPenguranganDiv = document.getElementById('form-pengurangan-stok');

    if (!formPenguranganDiv) return;

    if (stokBaru < stokLama) {
        formPenguranganDiv.style.display = 'block';

        // Set required pada alasan pengurangan
        const alasanSelect = formPenguranganDiv.querySelector('select[name="alasan_pengurangan"]');
        if (alasanSelect) {
            alasanSelect.required = true;
        }
    } else {
        formPenguranganDiv.style.display = 'none';

        // Hapus required jika stok tidak berkurang
        const alasanSelect = formPenguranganDiv.querySelector('select[name="alasan_pengurangan"]');
        if (alasanSelect) {
            alasanSelect.required = false;
        }
    }
}

// Validasi awal
document.addEventListener('DOMContentLoaded', function() {
    validateStok();
    toggleFormPengurangan();
});
</script>

<style>
#stok-validation.hidden {
    display: none;
}
</style>

@endsection
