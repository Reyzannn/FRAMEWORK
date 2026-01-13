@extends('layouts.app')
@section('content')

@section('title', 'Daftar Account')

@section('header')
            <div class="flex items-center justify-between">
              <div>
                <h2 id="header-title" class="text-3xl font-bold text-blue-600 mb-1">Daftar Account</h2>
              </div>
            </div>
@endsection

<section id="section-daftar" class="page-section active">
  <div class="bg-white rounded-2xl card-shadow overflow-hidden">

    <div class="bg-gradient-to-r from-[#1C2B1A] to-[#445a41] px-6 py-4">
      <h3 class="text-xl font-semibold text-white">
      <div class="flex items-center justify-between">
      Daftar User
    <a href="{{ route('users.create') }}"
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-all text-sm font-semibold">
        + Tambah Akun
    </a>
</div>
    </h3>
      <p class="text-white text-sm opacity-90">Kelola akun pengguna</p>
    </div>




    <form action="{{ route('users.index') }}" method="get">
      <div class="p-6 border-b">
        <div class="flex flex-col sm:flex-row gap-4">

          <div class="flex-1 relative">
            <input name="search" type="text" placeholder="Cari user..."
              class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>

        </div>
      </div>
    </form>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-xs font-medium text-gray-500 border-b">
            <th class="px-6 py-4 text-left">USERNAME</th>
            <th class="px-6 py-4 text-center">ROLE</th>
            <th class="px-6 py-4 text-center">AKSI</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @foreach($users as $user)
          <tr class="text-sm text-gray-600">

            <td class="px-6 py-4 font-medium text-gray-800">
              {{ $user->username }}
            </td>

            <td class="px-6 py-4 text-center">
              <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-semibold">
                {{ $user->role }}
              </span>
            </td>

            <td class="px-6 py-4 text-center">
              <div class="flex items-center justify-center gap-2">

                <a href="{{ route('users.edit', $user->id) }}"
                  class="w-9 h-9 rounded-lg bg-[#4361EE] hover:bg-[#3A0CA3] text-white flex items-center justify-center shadow-md transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Yakin mau hapus user ini?')"
                    class="w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </form>

              </div>
            </td>

          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>
</section>


@endsection
