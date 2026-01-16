@extends('layouts.app')

@section('content')
<section id="section-dashboard" class="page-section active">
    <div class="grid grid-cols-3 gap-6 mb-8">
        <!-- Total Produk -->
        <div class="stat-card bg-white rounded-2xl p-6 card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Barang</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $produk }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Barang Kondisi Baik -->
        <div class="stat-card bg-white rounded-2xl p-6 card-shadow border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Barang Kondisi Bagus</p>
                    <p class="text-3xl font-bold text-green-600">{{ $kondisi_bagus }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Barang Kondisi Kurang Baik -->
        <div class="stat-card bg-white rounded-2xl p-6 card-shadow border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Barang Kondisi Kurang Bagus</p>
                    <p class="text-3xl font-bold text-red-600">{{ $kondisi_kurang_bagus }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-2xl p-6 card-shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
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
</section>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
