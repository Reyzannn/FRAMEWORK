// Toggle password visibility
function togglePassword() {
  const pwd = document.getElementById('password');
  const eye = document.getElementById('eye-icon');
  if (!pwd) return;
  if (pwd.type === 'password') {
    pwd.type = 'text';
    // replace eye icon to "eye-off" path (simple swap)
    eye.innerHTML = '<path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"/><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>';
  } else {
    pwd.type = 'password';
    eye.innerHTML = '<path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>';
  }
}

// Demo login handler
function handleLogin(e) {
  e.preventDefault();
  const btn = document.getElementById('login-button');
  const loginText = document.getElementById('login-text');

  if (!btn || !loginText) return;

  // set loading state
  const prev = loginText.textContent;
  btn.disabled = true;
  loginText.textContent = 'Memproses...';

  setTimeout(() => {
    loginText.textContent = prev;
    btn.disabled = false;
    // simple feedback
    const notice = document.createElement('div');
    notice.textContent = 'Demo UI: Login berhasil! (Simulasi)';
    Object.assign(notice.style, {
      position: 'fixed', left: '50%', top: '24px', transform: 'translateX(-50%)',
      background: '#2563eb', color: '#fff', padding: '10px 16px', borderRadius: '8px',
      boxShadow: '0 8px 20px rgba(0,0,0,0.12)', zIndex: 9999
    });
    document.body.appendChild(notice);
    setTimeout(()=> notice.remove(), 2600);
  }, 1300);
}

// Fungsi logout sederhana
document.querySelector('.logout-btn').addEventListener('click', () => {
  alert('Anda telah logout');
  window.location.href = 'login.html';
});

// Fungsi pencarian simulasi
document.querySelector('.search-box input').addEventListener('input', e => {
  console.log('Mencari:', e.target.value);
});

// di dalam DOMContentLoaded, tambahkan ini:
document.getElementById('table-produk').addEventListener('click', (e) => {
  const index = e.target.closest('button')?.getAttribute('data-index');
  if (!index) return;

  if (e.target.closest('.delete-btn')) {
    deleteProduct(parseInt(index));
  }

  if (e.target.closest('.edit-btn')) {
    const prod = products[index];
    // pindah ke halaman tambah
    location.hash = '#tambah';
    // isi form
    document.getElementById('input-nama').value = prod.nama;
    document.getElementById('input-kode').value = prod.kode;
    document.getElementById('input-kategori').value = prod.kategori;
    document.getElementById('input-satuan').value = prod.satuan;
    document.getElementById('input-stok').value = prod.stok;
    document.getElementById('input-stok-min').value = prod.stokMin;
    document.getElementById('input-harga').value = prod.harga;
    document.getElementById('simpan-produk').textContent = 'Update Produk';

    // simpan index yang sedang diedit
    window.editingIndex = parseInt(index);

  // Variabel global untuk menyimpan index yang sedang diedit
let editingIndex = -1;

// Event klik untuk Edit & Delete
document.getElementById('table-produk').addEventListener('click', (e) => {
  const btn = e.target.closest('button');
  if (!btn) return;
  const index = parseInt(btn.dataset.index);

  if (btn.classList.contains('delete-btn')) {
    deleteProduct(index);
  }

  if (btn.classList.contains('edit-btn')) {
    const prod = products[index];
    editingIndex = index;

    // Pindah ke halaman Tambah Produk
    location.hash = '#tambah';
    activateByPageName('tambah');

    // Isi form dengan data produk
    document.getElementById('input-nama').value = prod.nama;
    document.getElementById('input-kode').value = prod.kode;
    document.getElementById('input-kategori').value = prod.kategori;
    document.getElementById('input-satuan').value = prod.satuan;
    document.getElementById('input-stok').value = prod.stok;
    document.getElementById('input-stok-min').value = prod.stokMin;
    document.getElementById('input-harga').value = prod.harga;

    // Ubah teks tombol jadi Update
    document.getElementById('simpan-produk').textContent = 'Update Produk';
  }
});

// Ubah fungsi simpan produk (ganti yang lama dengan ini)
document.getElementById('simpan-produk').addEventListener('click', () => {
  const nama = document.getElementById('input-nama').value.trim();
  const kode = document.getElementById('input-kode').value.trim();
  const kategori = document.getElementById('input-kategori').value;
  const satuan = document.getElementById('input-satuan').value;
  const stok = parseInt(document.getElementById('input-stok').value) || 0;
  const stokMin = parseInt(document.getElementById('input-stok-min').value) || 0;
  const harga = parseInt(document.getElementById('input-harga').value) || 0;

  if (!nama || !kode) {
    alert('Nama dan Kode Produk wajib diisi!');
    return;
  }

  const product = { nama, kode, kategori, satuan, stok, stokMin, harga };

  if (editingIndex >= 0) {
    products[editingIndex] = product;
    alert('Produk berhasil diperbarui!');
    editingIndex = -1;
    document.getElementById('simpan-produk').textContent = 'Simpan Produk';
  } else {
    products.push(product);
    alert('Produk berhasil disimpan!');
  }

  renderTable();
  resetForm();
});


  }
});