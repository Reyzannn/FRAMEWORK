<aside class="w-1/5 sidebar-gradient text-white flex flex-col min-h-screen p-0">
          <div class="p-6 text-center border-b border-white border-opacity-20">
            <div class="mb-4 flex justify-center">
              <!-- simple house icon -->
              <svg width="60" height="60" viewBox="0 0 60 60" class="text-white">
                <path d="M10 30 L30 10 L50 30 L50 50 L10 50 Z" fill="currentColor" stroke="rgba(255,255,255,0.25)" stroke-width="1"/>
                <rect x="25" y="35" width="10" height="15" fill="rgba(255,255,255,0.18)"/>
                <rect x="20" y="25" width="6" height="6" fill="rgba(255,255,255,0.18)"/>
                <rect x="34" y="25" width="6" height="6" fill="rgba(255,255,255,0.18)"/>
              </svg>
            </div>
            <h1 id="company-name" class="text-xl font-bold mb-1">simbadag</h1>
            <p id="company-subtitle" class="text-xs opacity-80">PT. RIZKY JAYA BADAI</p>
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
                  Tambahkan Produk
                </a>
              </li>
              @endif
              <li>
                <a href="{{ route('produk.index') }}" data-page="daftar" class="menu-item flex items-center px-4 py-3 rounded-lg">
                  <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                  </svg>
                  Daftar Produk
                </a>
              </li>
              @if($authUser->role=='admin')
              <li>
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
