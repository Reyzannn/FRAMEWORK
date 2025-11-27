// --- Simple SPA navigation with hash and persistence ---
      const MENU_SELECTOR = '.menu-item';
      const sections = {
        dashboard: document.getElementById('section-dashboard'),
        tambah: document.getElementById('section-tambah'),
        daftar: document.getElementById('section-daftar'),
        laporan: document.getElementById('section-laporan')
      };

      // Array to store products
      let products = [
        { nama: 'Keyboard Mechanical', kode: 'KM001', kategori: 'Elektronik', satuan: 'pcs', stok: 12, stokMin: 5, harga: 370000 },
        { nama: 'Mouse Wireless', kode: 'MW001', kategori: 'Elektronik', satuan: 'pcs', stok: 4, stokMin: 5, harga: 270000 }
      ];

      function setActiveMenuElement(el) {
        document.querySelectorAll(MENU_SELECTOR).forEach(i => i.classList.remove('active'));
        if (el) el.classList.add('active');
      }

      function showSection(name) {
        // hide all sections
        Object.values(sections).forEach(sec => sec.classList.remove('active'));
        // show chosen
        if (sections[name]) sections[name].classList.add('active');

        // update header title & subtitle text like desain
        const headerTitle = document.getElementById('header-title');
        const welcome = document.getElementById('welcome-message');

        switch(name) {
          case 'dashboard':
            headerTitle.textContent = 'Dashboard';
            welcome.textContent = 'Ringkasan Sistem';
            break;
          case 'tambah':
            headerTitle.textContent = 'Tambahkan Produk';
            welcome.textContent = 'Pastikan Teliti!';
            break;
          case 'daftar':
            headerTitle.textContent = 'Daftar Produk';
            welcome.textContent = 'Kelola semua produk dalam inventori';
            break;
          case 'laporan':
            headerTitle.textContent = 'Laporan';
            welcome.textContent = 'Lihat laporan penjualan dan inventori';
            break;
        }
      }

      function activateByPageName(pageName) {
        // find menu element that has data-page==pageName
        const el = document.querySelector(`${MENU_SELECTOR}[data-page="${pageName}"]`);
        setActiveMenuElement(el);
        showSection(pageName);
      }

      // when user clicks menu, set location.hash (native anchor will also change hash)
      document.querySelectorAll(MENU_SELECTOR).forEach(a => {
        a.addEventListener('click', function(e){
          // default anchor behaviour will update hash; just ensure persistence
          const page = a.getAttribute('data-page');
          // save to localStorage as fallback
          try { localStorage.setItem('simbadag_active', page); } catch(e){}
          // activate immediately (hashchange listener / onload will take care too)
          activateByPageName(page);
        });
      });

      // on hash change -> update active
      window.addEventListener('hashchange', () => {
        const page = location.hash.replace('#','') || 'dashboard';
        try { localStorage.setItem('simbadag_active', page); } catch(e){}
        activateByPageName(page);
      });

      // setelah alert berhasil
window.editingIndex = -1; // reset
document.getElementById('simpan-produk').textContent = 'Simpan Produk';

     function renderTable() {
  const tbody = document.getElementById('table-produk');
  tbody.innerHTML = '';

  products.forEach((product, index) => {
    const isLowStock = product.stok <= product.stokMin;
    const statusBadge = isLowStock
      ? '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Stok Rendah</span>'
      : '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Tersedia</span>';

    const tr = document.createElement('tr');
    tr.className = 'hover:bg-gray-50 transition-colors';
    tr.innerHTML = `
      <td class="px-6 py-5">
        <div class="font-medium text-gray-900">${product.nama}</div>
        <div class="text-sm text-gray-500">${product.kode}</div>
      </td>
      <td class="px-6 py-5">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
          ${product.kategori || '-'}
        </span>
      </td>
      <td class="px-6 py-5 text-center ${isLowStock ? 'text-red-600 font-semibold' : 'text-gray-900'}">
        ${product.stok} ${product.satuan || 'pcs'}
      </td>
      <td class="px-6 py-5 text-right font-medium text-gray-900">
        Rp ${product.harga.toLocaleString('id-ID')}
      </td>
      <td class="px-6 py-5 text-center">${statusBadge}</td>
      <td class="px-6 py-5 text-center">
        <div class="flex items-center justify-center gap-3">
          <!-- Tombol Edit -->
          <button class="edit-btn w-9 h-9 rounded-lg bg-[#4361EE] hover:bg-[#3A0CA3] text-white flex items-center justify-center shadow-md transition-all" data-index="${index}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
          </button>
          <!-- Tombol Delete -->
          <button class="delete-btn w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md transition-all" data-index="${index}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </button>
        </div>
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById('total-products').textContent = products.length;
}

      function deleteProduct(index) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
          products.splice(index, 1);
          renderTable();
          alert('Produk dihapus!');
        }
      }

      function resetForm() {
        document.getElementById('input-nama').value = '';
        document.getElementById('input-kode').value = '';
        document.getElementById('input-kategori').value = '';
        document.getElementById('input-satuan').value = '';
        document.getElementById('input-stok').value = 0;
        document.getElementById('input-stok-min').value = 0;
        document.getElementById('input-harga').value = 0;
        document.getElementById('simpan-produk').textContent = 'Simpan Produk';
      }

      // on load -> choose from hash -> localStorage -> default
      window.addEventListener('DOMContentLoaded', () => {
        const hashPage = location.hash.replace('#','');
        const stored = (function(){ try { return localStorage.getItem('simbadag_active'); } catch(e){ return null; } })();
        const pageToOpen = hashPage || stored || 'dashboard';
        // ensure hash matches (so refreshing still shows same)
        if (!location.hash) location.hash = '#' + pageToOpen;
        activateByPageName(pageToOpen);

        renderTable();

        // basic button actions (logout modal)
        document.getElementById('logout-btn').addEventListener('click', handleLogout);

        // save/update product
        document.getElementById('simpan-produk').addEventListener('click', () => {
          const nama = document.getElementById('input-nama').value.trim();
          const kode = document.getElementById('input-kode').value.trim();
          const kategori = document.getElementById('input-kategori').value;
          const satuan = document.getElementById('input-satuan').value;
          const stok = parseInt(document.getElementById('input-stok').value) || 0;
          const stokMin = parseInt(document.getElementById('input-stok-min').value) || 0;
          const harga = parseInt(document.getElementById('input-harga').value) || 0;

          if (!nama || !kode) {
            alert('Nama dan Kode Produk harus diisi!');
            return;
          }

          const product = { nama, kode, kategori, satuan, stok, stokMin, harga };

          if (editingIndex >= 0) {
            products[editingIndex] = product;
            alert('Produk diperbarui!');
          } else {
            products.push(product);
            alert('Produk disimpan!');
          }

          renderTable();
          resetForm();
        });

        // reset form
        document.getElementById('reset-form').addEventListener('click', resetForm);

        // table button event delegation
        document.getElementById('table-produk').addEventListener('click', (e) => {
          const index = parseInt(e.target.getAttribute('data-index'));
          if (e.target.classList.contains('delete-btn')) {
            deleteProduct(index);
          }
        });
      });

      // Logout modal functions (reused from desain awal)
      function handleLogout(){
        const modal = document.createElement('div');
        modal.className = "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
        modal.innerHTML = `
          <div class="bg-white rounded-2xl p-8 max-w-md mx-4">
            <div class="text-center">
              <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/></svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-800 mb-2">Konfirmasi Logout</h3>
              <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari dashboard?</p>
              <div class="flex space-x-4">
                <button onclick="cancelLogout()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Batal</button>
                <button onclick="confirmLogout()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Ya, Logout</button>
              </div>
            </div>
          </div>
        `;
        document.body.appendChild(modal);
      }
      function cancelLogout(){
        const modal = document.querySelector('.fixed.inset-0');
        if (modal) modal.remove();
      }
      function confirmLogout(){
        cancelLogout();
        const toast = document.createElement('div');
        toast.className = "fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50";
        toast.textContent = "Logout berhasil! Sampai jumpa lagi.";
        document.body.appendChild(toast);
        setTimeout(()=> toast.remove(), 2500);
        // in real app: redirect to login
      }
