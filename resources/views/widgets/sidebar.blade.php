<aside class="w-1/5 sidebar-gradient text-white flex flex-col min-h-screen p-0">
          <div class="p-6 text-center border-b border-white border-opacity-20">
            <h1 id="company-namre" class="text-xl font-bold mb-1">Inventa</h1>
            <p id="company-subtitle" class="text-xs opacity-80">PT Teknologi Nusantara  </p>
          </div>

          <nav class="flex-1 py-6">
            <ul class="space-y-2 px-4">
              <li>
                <a href="{{ route('dashboard.index') }}" data-page="dashboard" class="menu-item flex items-center px-4 py-3 rounded-lg">
                  <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                  </svg>
                  Dashboard
                </a>
              </li>
             @if($authUser->role != 'owner')
              <li>
                <a href="{{ route('produk.create') }}" data-page="tambah" class="menu-item flex items-center px-4 py-3 rounded-lg">
                  <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                  </svg>
                  Tambahkan Barang
                </a>
              </li>
              @endif
              <li>
                <a href="{{ route('produk.index') }}" data-page="daftar" class="menu-item flex items-center px-4 py-3 rounded-lg">
                  <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                  </svg>
                  Daftar Barang
                </a>
              </li>
              @if($authUser->role=='admin' || $authUser->role=='manager')
<!-- BARANG MASUK: Warehouse dengan plus -->
<!-- BARANG MASUK - Inbox dengan Plus -->
<li>
    <a href="{{ route('stock.masuk') }}" data-page="daftar" class="menu-item flex items-center px-4 py-3 rounded-lg">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <!-- Gudang dengan tanda plus -->
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            <path d="M8 11h4m-2-2v4"/>
        </svg>
        Barang Masuk
    </a>
</li>

<!-- BARANG KELUAR - Trash Can -->
<li>
    <a href="{{ route('stock.keluar') }}" data-page="daftar" class="menu-item flex items-center px-4 py-3 rounded-lg">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <!-- Tong sampah -->
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        Barang Keluar
    </a>
</li>
                <a href="{{ route('laporan.index') }}" data-page="laporan" class="menu-item flex items-center px-4 py-3 rounded-lg">
                  <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                  </svg>
                  Laporan
                </a>
              </li>
              @endif
            </ul>
          </nav>

          <div class="p-4">
            <a href="{{ route('logout') }}">
            <button id="logout-btn" class="logout-gradient w-full py-3 px-4 rounded-xl font-semibold text-white transition-all duration-200 hover:shadow-lg">
              Log Out
            </button>
            </a>
          </div>
        </aside>
