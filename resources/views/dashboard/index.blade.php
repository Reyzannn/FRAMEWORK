@extends('layouts.app')

@section('content')
<section id="section-dashboard" class="page-section active">
              <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-white rounded-2xl p-6 card-shadow">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
                      <p id="total-products" class="text-3xl font-bold text-gray-800">{{$produk}}</p>
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
                      <p id="low-stock-count" class="text-3xl font-bold text-red-600">{{ $stokminim }}</p>
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
                      <p id="total-stock-value" class="text-2xl font-bold text-green-600">Rp {{ number_format($totalNilaiStok, 0, ',', '.') }}</p>
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
                <!-- CARD STOK RENDAH DENGAN SCROLL -->
                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-2 p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-red-700 mb-5 flex items-center gap-2">
                        Stok Rendah
                    </h3>

                    <!-- AREA SCROLL – ini yang bikin bisa scroll kalau banyak data -->
                    <div class="max-h-96 overflow-y-auto space-y-4 pr-2">
                        @forelse($produk_minim as $item)
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-red-100 hover:shadow-md transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-base">
                                            {{ $item->nama }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Kode: {{ $item->kode }}
                                        </p>
                                    </div>

                                    <div class="text-right ml-4">
                                        <p class="text-2xl font-bold text-red-600">
                                            {{ $item->stok }} 
                                            <span class="text-lg font-medium text-red-500">{{ $item->satuan ?? 'pcs' }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">Stok tersisa</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <p class="text-lg">Semua stok masih aman</p>
                                <p class="text-sm mt-2">Tidak ada produk yang stoknya rendah</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- TOTAL DI BAWAH -->
                    <div class="mt-4 text-right">
                        <p class="text-sm text-gray-700">
                            Total produk stok rendah: 
                            <span class="font-bold text-red-700 text-lg">
                                {{ $authUser->username}}
                            </span> 
                            Product
                        </p>
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
            <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection