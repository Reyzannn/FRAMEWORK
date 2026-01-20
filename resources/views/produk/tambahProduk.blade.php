@extends('layouts.app')

@section('content')
@section('title', 'Tambah Produk')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Tambahkan Barang</h2>
        <p id="welcome-message" class="text-gray-500">Pastikan teliti! Semua field wajib diisi.</p>
    </div>
</div>
@endsection

<section id="section-tambah" class="page-section active">
    <!-- TAMPILKAN ERROR VALIDASI -->
    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center text-red-700">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Terdapat kesalahan dalam pengisian form:</span>
        </div>
        <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('produk.store') }}" method="post" id="form-tambah-produk">
        @csrf
        <div class="bg-white rounded-2xl p-6 card-shadow">
            <h3 class="text-xl font-semibold mb-6">Informasi Dasar</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Nama Barang <span class="text-red-500">*</span></label>
                        <input name="nama" id="input-nama" class="mt-2 w-full border rounded-lg px-3 py-2.5 @error('nama') border-red-500 @enderror"
                               placeholder="Contoh: Buku Tulis A5" value="{{ old('nama') }}" required />
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Maksimal 255 karakter</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-medium">Kode Barang <span class="text-red-500">*</span></label>
                        <input name="kode" id="input-kode" class="mt-2 w-full border rounded-lg px-3 py-2.5 @error('kode') border-red-500 @enderror"
                               placeholder="Format: P0101 (tanpa spasi)" value="{{ old('kode') }}" required />
                        @error('kode')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Harus unik, tidak boleh ada spasi</p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 font-medium">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="input-kategori" class="mt-2 w-full border rounded-lg px-3 py-2.5 @error('kategori') border-red-500 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Alat Tulis" {{ old('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                            <option value="Alat Mandi" {{ old('kategori') == 'Alat Mandi' ? 'selected' : '' }}>Alat Mandi</option>
                            <option value="Jajan" {{ old('kategori') == 'Jajan' ? 'selected' : '' }}>Jajan</option>
                            <option value="Alas Kaki" {{ old('kategori') == 'Alas Kaki' ? 'selected' : '' }}>Alas Kaki</option>
                            <option value="Kecantikan" {{ old('kategori') == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                            <option value="Alat Dapur" {{ old('kategori') == 'Alat Dapur' ? 'selected' : '' }}>Alat Dapur</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- TOTAL STOK -->
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Total Stok <span class="text-red-500">*</span></label>
                        <input name="stok" id="input-stok" type="number" min="0" value="{{ old('stok', 0) }}"
                               class="mt-2 w-full border rounded-lg px-3 py-2.5 @error('stok') border-red-500 @enderror" required
                               oninput="validateStok()" />
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Total keseluruhan barang (harus angka ≥ 0)</p>
                    </div>

                    <!-- DETAIL KONDISI BARANG -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Detail Kondisi Barang <span class="text-red-500">*</span></h4>

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
                            <input name="stok_bagus" id="input-stok-bagus" type="number" min="0" value="{{ old('stok_bagus', 0) }}"
                                class="w-full border border-green-200 rounded-lg px-3 py-2 @error('stok_bagus') border-red-500 @enderror"
                                oninput="validateStok()" required />
                            @error('stok_bagus')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                            <input name="stok_kurang_bagus" id="input-stok-kurang-bagus" type="number" min="0" value="{{ old('stok_kurang_bagus', 0) }}"
                                class="w-full border border-yellow-200 rounded-lg px-3 py-2 @error('stok_kurang_bagus') border-red-500 @enderror"
                                oninput="validateStok()" required />
                            @error('stok_kurang_bagus')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Validasi Real-time -->
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

            <!-- Tombol -->
            <div class="mt-8 flex space-x-3">
                <button type="submit" id="simpan-produk"
                        class="px-5 py-2.5 bg-lime-800 text-white rounded-lg font-semibold hover:bg-lime-900 transition">
                    Simpan Produk
                </button>
                <button type="button" id="reset-form"
                        class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Reset Form
                </button>
            </div>
        </div>
    </form>
</section>

<script>
function validateStok() {
    const totalStok = parseInt(document.getElementById('input-stok').value) || 0;
    const stokBagus = parseInt(document.getElementById('input-stok-bagus').value) || 0;
    const stokKurangBagus = parseInt(document.getElementById('input-stok-kurang-bagus').value) || 0;

    const totalDetail = stokBagus + stokKurangBagus;
    const validationDiv = document.getElementById('stok-validation');
    const message = document.getElementById('validation-message');
    const submitBtn = document.getElementById('simpan-produk');

    if (totalDetail === totalStok) {
        validationDiv.className = 'mt-4 p-3 text-sm rounded bg-green-50 text-green-700 border border-green-200';
        message.textContent = `✓ Valid! Total detail kondisi (${totalDetail}) sama dengan Total Stok (${totalStok})`;
        validationDiv.classList.remove('hidden');
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        validationDiv.className = 'mt-4 p-3 text-sm rounded bg-red-50 text-red-700 border border-red-200';
        message.textContent = `✗ Tidak valid! Total detail kondisi (${totalDetail}) tidak sama dengan Total Stok (${totalStok})`;
        validationDiv.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

// Reset form
document.getElementById('reset-form').addEventListener('click', function() {
    if(confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
        document.getElementById('form-tambah-produk').reset();
        document.getElementById('input-stok').value = 0;
        document.getElementById('input-stok-bagus').value = 0;
        document.getElementById('input-stok-kurang-bagus').value = 0;
        document.getElementById('stok-validation').classList.add('hidden');
        document.getElementById('simpan-produk').disabled = false;
        document.getElementById('simpan-produk').classList.remove('opacity-50', 'cursor-not-allowed');
    }
});

// Validasi awal saat load
document.addEventListener('DOMContentLoaded', function() {
    validateStok();
});

// Validasi sebelum submit (additional)
document.getElementById('form-tambah-produk').addEventListener('submit', function(e) {
    const totalStok = parseInt(document.getElementById('input-stok').value) || 0;
    const stokBagus = parseInt(document.getElementById('input-stok-bagus').value) || 0;
    const stokKurangBagus = parseInt(document.getElementById('input-stok-kurang-bagus').value) || 0;
    const totalDetail = stokBagus + stokKurangBagus;

    if (totalDetail !== totalStok) {
        e.preventDefault();
        alert('Silakan periksa kembali: Total detail kondisi harus sama dengan Total Stok.');
        return false;
    }

    return true;
});
</script>

<style>
#stok-validation.hidden {
    display: none;
}
</style>
@endsection
