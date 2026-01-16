@extends('layouts.app')

@section('title', 'Edit Produk')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Edit Produk</h2>
        <p id="welcome-message" class="text-gray-500">Jangan terjadi kesalahan lagi!</p>
    </div>
</div>
@endsection

@section('content')
<section id="section-edit" class="page-section active">
    <form action="{{ route('produk.update', $product->id) }}" method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl p-6 card-shadow">
            <h3 class="text-xl font-semibold mb-6">Edit Produk</h3>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ROW 1: Nama Produk & Kategori -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm text-gray-600 font-medium mb-2">Nama Produk</label>
                    <input name="nama"
                           id="input-nama"
                           value="{{ old('nama', $product->nama) }}"
                           class="w-full border rounded-lg px-3 py-2.5"
                           placeholder="Masukkan nama produk"
                           required />
                </div>

                <div>
                    <label class="block text-sm text-gray-600 font-medium mb-2">Kategori</label>
                    <select name="kategori" id="input-kategori" class="w-full border rounded-lg px-3 py-2.5" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Elektronik" {{ old('kategori', $product->kategori) == 'Elektronik' ? 'selected' : '' }}>
                            Elektronik
                        </option>
                        <option value="Alat Tulis" {{ old('kategori', $product->kategori) == 'Alat Tulis' ? 'selected' : '' }}>
                            Alat Tulis
                        </option>
                        <option value="Alat Mandi" {{ old('kategori', $product->kategori) == 'Alat Mandi' ? 'selected' : '' }}>
                            Alat Mandi
                        </option>
                        <option value="Jajan" {{ old('kategori', $product->kategori) == 'Jajan' ? 'selected' : '' }}>
                            Jajan
                        </option>
                        <option value="Alas Kaki" {{ old('kategori', $product->kategori) == 'Alas Kaki' ? 'selected' : '' }}>
                            Alas Kaki
                        </option>
                        <option value="Kecantikan" {{ old('kategori', $product->kategori) == 'Kecantikan' ? 'selected' : '' }}>
                            Kecantikan
                        </option>
                        <option value="Alat Dapur" {{ old('kategori', $product->kategori) == 'Alat Dapur' ? 'selected' : '' }}>
                            Alat Dapur
                        </option>
                    </select>
                </div>
            </div>

            <!-- ROW 2: Stok & Status -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm text-gray-600 font-medium mb-2">Stok Saat Ini</label>
                    <div class="bg-gray-50 p-3 rounded-lg mb-2">
                        <p class="font-bold text-lg">{{ $product->stok }} unit</p>
                    </div>

                    <label class="block text-sm text-gray-600 font-medium mb-2">Stok Baru</label>
                    <input name="stok"
                           id="input-stok"
                           type="number"
                           min="0"
                           value="{{ old('stok', $product->stok) }}"
                           class="w-full border rounded-lg px-3 py-2.5"
                           onchange="checkStockChange()"
                           required />
                    <small class="text-xs text-gray-500 mt-1 block">
                        Stok saat ini: <span id="current-stock">{{ $product->stok }}</span> unit
                    </small>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 font-medium mb-2">Status</label>
                    <select name="status" id="input-status" class="w-full border rounded-lg px-3 py-2.5" required>
                        <option value="">Pilih Status</option>
                        <option value="Bagus" {{ old('status', $product->status) == 'Bagus' ? 'selected' : '' }}>
                            Bagus
                        </option>
                        <option value="Kurang Bagus" {{ old('status', $product->status) == 'Kurang Bagus' ? 'selected' : '' }}>
                            Kurang Bagus
                        </option>
                    </select>
                </div>
            </div>

            <!-- SECTION ALASAN PENGURANGAN (HIDDEN AWALNYA) -->
            <div id="alasan-section" class="hidden mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="font-semibold text-yellow-800 mb-3">⚠️ Stok Berkurang</h4>
                <p class="text-sm text-yellow-700 mb-4">
                    Stok berkurang sebanyak <span id="jumlah-pengurangan" class="font-bold">0</span> unit.
                    Harap isi alasan pengurangan.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 font-medium mb-2">Alasan Pengurangan *</label>
                        <select name="alasan_pengurangan"
                                id="input-alasan"
                                class="w-full border rounded-lg px-3 py-2.5">
                            <option value="">Pilih Alasan</option>
                            <option value="rusak">Barang Rusak</option>
                            <option value="habis">Barang Habis/Kadaluarsa</option>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="hilang">Hilang</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 font-medium mb-2">Tanggal Keluar</label>
                        <input type="date"
                               name="tanggal_keluar"
                               value="{{ date('Y-m-d') }}"
                               class="w-full border rounded-lg px-3 py-2.5">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-sm text-gray-600 font-medium mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan"
                              class="w-full border rounded-lg px-3 py-2.5"
                              rows="2"
                              placeholder="Contoh: 5 unit rusak, 2 unit hilang di gudang..."></textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-3">
                <button type="submit" class="px-5 py-2.5 bg-lime-800 text-white rounded-lg font-semibold hover:bg-lime-900 transition">
                    Update Produk
                </button>
                <a href="{{ route('produk.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</section>

<script>
function checkStockChange() {
    const currentStock = parseInt(document.getElementById('current-stock').textContent);
    const newStock = parseInt(document.getElementById('input-stok').value);
    const alasanSection = document.getElementById('alasan-section');
    const jumlahPengurangan = document.getElementById('jumlah-pengurangan');

    if (newStock < currentStock) {
        // Stok berkurang
        const pengurangan = currentStock - newStock;
        jumlahPengurangan.textContent = pengurangan;
        alasanSection.classList.remove('hidden');

        // Buat input alasan required
        document.getElementById('input-alasan').setAttribute('required', 'required');
    } else {
        // Stok bertambah atau sama
        alasanSection.classList.add('hidden');
        document.getElementById('input-alasan').removeAttribute('required');
    }
}

// Validasi form sebelum submit
document.getElementById('editForm').addEventListener('submit', function(e) {
    const currentStock = parseInt(document.getElementById('current-stock').textContent);
    const newStock = parseInt(document.getElementById('input-stok').value);
    const alasan = document.getElementById('input-alasan').value;

    if (newStock < currentStock && !alasan) {
        e.preventDefault();
        alert('Harap pilih alasan pengurangan stok!');
        document.getElementById('input-alasan').focus();
    }
});
</script>
@endsection
