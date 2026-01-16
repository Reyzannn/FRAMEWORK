@extends('layouts.app')

@section('content')

@section('title', 'Tambah Produk')

@section('header')
            <div class="flex items-center justify-between">
              <div>
                <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Tambahkan Barang</h2>
                <p id="welcome-message" class="text-gray-500">Pastikan teliti!</p>
              </div>
            </div>
@endsection

   <section id="section-tambah" class="page-section active">
    <form action="{{ route ('produk.store') }}" method="post">
    @csrf
              <div class="bg-white rounded-2xl p-6 card-shadow">
                <h3 class="text-xl font-semibold mb-4">Informasi Dasar</h3>
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="text-sm text-gray-600 font-medium">Nama Barang</label>
                    <input name="nama" id="input-nama" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="Masukkan nama produk Contoh: EB001" />
                  </div>
                  <div>
                    <label class="text-sm text-gray-600 font-medium">Kode Barang</label>
                    <input name="kode" id="input-kode" class="mt-2 w-full border rounded-lg px-3 py-2" placeholder="Masukkan kode produk" />
                  </div>
                  <div>
                    <label class="text-sm text-gray-600 font-medium">Kategori</label>
                    <select name="kategori" id="input-kategori" class="mt-2 w-full border rounded-lg px-3 py-2">
                      <option value="">Pilih Kategori</option>
                      <option value="Elektronik">Elektronik</option>
                      <option value="Alat Tulis">Alat Tulis</option>
                      <option value="Alat Mandi">Alat Mandi</option>
                      <option value="Jajan">Jajan</option>
                      <option value="Alas Kaki">Alas Kaki</option>
                      <option value="Kecantikan">Kecantikan</option>
                      <option value="Alat Dapur">Alat Dapur</option>
                    </select>
                  </div>
                  <div>
                    <label class="text-sm text-gray-600 font-medium">Stok Barang</label>
                    <input name="stok" id="input-stok" type="number" min="0" value="0" class="mt-2 w-full border rounded-lg px-3 py-2" />
                  </div>
                    <div>
                        <label class="text-sm text-gray-600 font-medium">Status</label>
                        <select name="status" id="input-status" class="mt-2 w-full border rounded-lg px-3 py-2" required>
                            <option value="">Pilih Status</option>
                            <option value="Bagus" {{ old('status') == 'Bagus' ? 'selected' : '' }} class="text-green-700">
                                Bagus
                            </option>
                            <option value="Kurang Bagus" {{ old('status') == 'Kurang Bagus' ? 'selected' : '' }} class="text-red-700">
                                Kurang Bagus
                            </option>
                        </select>
                        <small class="text-xs text-gray-500 mt-1 block">Pilih status secara manual</small>
                    </div>
                </div>
                </div>
                <div class="mt-6 flex space-x-3">
                  <button id="simpan-produk" class="px-4 py-2 bg-lime-800 text-white rounded-lg font-semibold hover:bg-lime-900">Simpan Produk</button>
                  <button id="reset-form" class="px-4 py-2 border rounded-lg">Reset Form</button>
                </div>
              </div>
              </form>
            </section>
              @endsection
