@extends('layouts.app')

@section('content')

@section('title', 'Edit Produk')

@section('header')
            <div class="flex items-center justify-between">
              <div>
                <h2 id="header-title" class="text-3xl font-bold text-blue-600 mb-1">Edit Produk</h2>
                <p id="welcome-message" class="text-gray-500">Jangan terjadi kesalahan lagi!</p>
              </div>
            </div>
@endsection

<section id="section-edit" class="page-section active">
    <form action="{{ route('produk.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl p-6 card-shadow">
            <h3 class="text-xl font-semibold mb-4">Edit Produk</h3>

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

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600 font-medium">Nama Produk</label>
                    <input name="nama"
                           id="input-nama"
                           value="{{ old('nama', $product->nama) }}"
                           class="mt-2 w-full border rounded-lg px-3 py-2"
                           placeholder="Masukkan nama produk Contoh: EB001"
                           required />
                </div>
                <br>
                <div>
                    <label class="text-sm text-gray-600 font-medium">Kategori</label>
                    <select name="kategori" id="input-kategori" class="mt-2 w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Elektronik" {{ old('kategori', $product->kategori) == 'Elektronik' ? 'selected' : '' }}>
                            Elektronik
                        </option>
                        <option value="Alat Tulis" {{ old('kategori', $product->kategori) == 'Alat Tulis' ? 'selected' : '' }}>
                            Alat Tulis
                        </option>
                    </select>
                </div>
                <div>
                    <label class="text-sm text-gray-600 font-medium">Satuan</label>
                    <select name="satuan" id="input-satuan" class="mt-2 w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Satuan</option>
                        <option value="pcs" {{ old('satuan', $product->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                        <option value="box" {{ old('satuan', $product->satuan) == 'box' ? 'selected' : '' }}>box</option>
                    </select>
                </div>
            </div>

            <h3 class="text-xl font-semibold mt-6 mb-4">Stok & Harga</h3>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="text-sm text-gray-600 font-medium">Stok Awal</label>
                    <input name="stok"
                           id="input-stok"
                           type="number"
                           min="0"
                           value="{{ old('stok', $product->stok) }}"
                           class="mt-2 w-full border rounded-lg px-3 py-2"
                           required />
                </div>
                <div>
                    <label class="text-sm text-gray-600 font-medium">Stok Minimum</label>
                    <input name="stok_min"
                           id="input-stok-min"
                           type="number"
                           min="0"
                           value="{{ old('stok_min', $product->stok_minim) }}"
                           class="mt-2 w-full border rounded-lg px-3 py-2"
                           required />
                </div>
                <div>
                    <label class="text-sm text-gray-600 font-medium">Harga (Rp)</label>
                    <input name="harga"
                           id="input-harga"
                           type="number"
                           min="0"
                           value="{{ old('harga', $product->harga) }}"
                           class="mt-2 w-full border rounded-lg px-3 py-2"
                           required />
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                    Update Produk
                </button>
                <a href="{{ route('produk.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</section>
@endsection
