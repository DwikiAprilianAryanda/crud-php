<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>

    <div class="toast-container">
        <div id="appToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toastTitle">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">
                Pesan notifikasi.
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Manajemen Produk</a>
        <input class="form-control form-control-light w-100 rounded-0 border-0" type="text" id="searchInput" placeholder="Cari produk..." aria-label="Search">
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i data-feather="box"></i>
                                Produk
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 fw-bold">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i data-feather="plus" class="me-1"></i>
                            Tambah Produk Baru
                        </button>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted fw-medium">Total Produk</h5>
                                <p class="h2 fw-bold" id="statTotalProduk">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted fw-medium">Total Nilai Inventaris</h5>
                                <p class="h2 fw-bold" id="statTotalNilai">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted fw-medium">Produk Terbaru</h5>
                                <p class="h2 fw-bold text-truncate" id="statProdukTerbaru">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Manajemen Data Produk</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0"> <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    <tr>
                                        <td colspan="7" class="text-center">Memuat data...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-3">
                        <nav id="paginationNav" aria-label="Page navigation">
                            </nav>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="create_nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="create_deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="create_harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="create_harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_gambar" class="form-label">Gambar Produk</label>
                            <input class="form-control" type="file" id="create_gambar" name="gambar" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="edit_harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_gambar" class="form-label">Gambar Produk (Kosongkan jika tidak diubah)</label>
                            <input class="form-control" type="file" id="edit_gambar" name="gambar" accept="image/*">
                        </div>
                        <div class="text-center">
                            <img src="" id="edit_img_preview" class="img-preview" alt="Preview Gambar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    feather.replace();

        
        
        const productTableBody = document.getElementById('productTableBody');
        const paginationNav = document.getElementById('paginationNav');
        const searchInput = document.getElementById('searchInput');
        let currentPage = 1;
        let currentSearch = '';

    const createModal = new bootstrap.Modal(document.getElementById('createModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const appToast = new bootstrap.Toast(document.getElementById('appToast'));
        
        function showToast(title, message, isError = false) {
            document.getElementById('toastTitle').textContent = title;
            document.getElementById('toastBody').textContent = message;
            const toastHeader = document.querySelector('#appToast .toast-header');
            if (isError) {
                toastHeader.classList.add('bg-danger', 'text-white');
                toastHeader.classList.remove('bg-success');
            } else {
                toastHeader.classList.add('bg-success', 'text-white');
                toastHeader.classList.remove('bg-danger');
            }
            appToast.show();
        }

        function sanitize(str) {
            if (!str) return '';
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
        }
        
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }

        
    function createTableRow(product, index) {
            const tr = document.createElement('tr');
            tr.setAttribute('data-id', product.id);
            const desc = sanitize(product.deskripsi);
            const shortDesc = desc.length > 50 ? desc.substring(0, 50) + '...' : desc;
            const imgPath = product.gambar ? `uploads/${sanitize(product.gambar)}` : 'https://via.placeholder.com/60x60/f0f0f0/ccc?text=No+Img';

            
            const limit = 5; 
            const rowNumber = (currentPage - 1) * limit + index + 1;

            tr.innerHTML = `
                <td class="fw-medium">${rowNumber}</td>
                <td class="text-muted">${product.id}</td>
                <td><img src="${imgPath}" alt="${sanitize(product.nama_produk)}" class="product-img"></td>
                <td class="fw-semibold">${sanitize(product.nama_produk)}</td>
                <td title="${desc}">${shortDesc}</td>
                <td>${formatRupiah(product.harga)}</td>
                <td>
                    <button class="btn btn-sm btn-outline-warning btn-edit" data-id="${product.id}">
                        <i data-feather="edit-2" style="width:16px; height:16px;"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${product.id}">
                        <i data-feather="trash-2" style="width:16px; height:16px;"></i>
                    </button>
                </td>
            `;
            
            tr.querySelector('.btn-edit').addEventListener('click', () => handleEditClick(product.id));
            tr.querySelector('.btn-delete').addEventListener('click', () => handleDeleteClick(product.id));
            return tr;
        }

        
    async function loadProducts(page = 1, search = '') {
            currentPage = page;
            currentSearch = search;
                
            if (page === 1 && search === '') {
                 productTableBody.innerHTML = `<tr><td colspan="7" class="text-center">Memuat data...</td></tr>`;
            }

            try {
                const response = await fetch(`api_read.php?page=${page}&search=${encodeURIComponent(search)}`);
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();

                
                if(page === 1 && search === '') { 
                    document.getElementById('statTotalProduk').innerText = data.stats.total_produk;
                    document.getElementById('statTotalNilai').innerText = formatRupiah(data.stats.total_nilai);
                    document.getElementById('statProdukTerbaru').innerText = sanitize(data.stats.produk_terbaru);
                }

                productTableBody.innerHTML = ''; 
                if (data.products && data.products.length > 0) {
                    data.products.forEach((product, index) => {
                        const tr = createTableRow(product, index);
                        productTableBody.appendChild(tr);
                    });
                } else {
                    productTableBody.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data produk ditemukan.</td></tr>`;
                }

                
                feather.replace();
                
                
                renderPagination(data.totalPages, data.currentPage);

            } catch (error) {
                console.error('Fetch error:', error);
                productTableBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Gagal memuat data.</td></tr>`;
            }
        }

        
    function renderPagination(totalPages, activePage) {
            paginationNav.innerHTML = '';
            if (totalPages <= 1) return;

            const ul = document.createElement('ul');
            ul.className = 'pagination justify-content-center mb-0';

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === activePage ? 'active' : ''}`;
                const a = document.createElement('a');
                a.className = 'page-link';
                a.href = '#';
                a.innerText = i;
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    loadProducts(i, currentSearch);
                });
                li.appendChild(a);
                ul.appendChild(li);
            }
            paginationNav.appendChild(ul);
        }

        

        
    document.getElementById('createForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('api_create.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    createModal.hide();
                    this.reset();
                    showToast('Sukses', 'Data produk berhasil ditambahkan.');
                    loadProducts(1, ''); 
                } else {
                    showToast('Error', result.message || 'Gagal menambahkan data.', true);
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                showToast('Error Fatal', 'Terjadi kesalahan. Cek konsol.', true);
            }
        });

        
    async function handleEditClick(id) {
            try {
                const response = await fetch(`api_get_detail.php?id=${id}`);
                const result = await response.json();

                if (result.success) {
                    const product = result.product;
                    document.getElementById('edit_id').value = product.id;
                    document.getElementById('edit_nama_produk').value = product.nama_produk;
                    document.getElementById('edit_deskripsi').value = product.deskripsi;
                    document.getElementById('edit_harga').value = product.harga;
                    
                    const imgPreview = document.getElementById('edit_img_preview');
                    if(product.gambar) {
                        imgPreview.src = `uploads/${product.gambar}`;
                        imgPreview.style.display = 'block';
                    } else {
                        imgPreview.src = '';
                        imgPreview.style.display = 'none';
                    }
                    editModal.show();
                } else {
                    showToast('Error', result.message || 'Gagal mengambil data.', true);
                }
            } catch (error) {
                console.error('Error fetching detail:', error);
                showToast('Error Fatal', 'Terjadi kesalahan. Cek konsol.', true);
            }
        }
        
        
    document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            try {
                const response = await fetch('api_update.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    editModal.hide();
                    this.reset();
                    showToast('Sukses', 'Data produk berhasil diperbarui.');
                    loadProducts(currentPage, currentSearch); 
                } else {
                    showToast('Error', result.message || 'Gagal memperbarui data.', true);
                }
            } catch (error) {
                console.error('Error submitting update:', error);
                showToast('Error Fatal', 'Terjadi kesalahan. Cek konsol.', true);
            }
        });

        
    async function handleDeleteClick(id) {
            if (!confirm(`Apakah Anda yakin ingin menghapus produk ID: ${id}?`)) {
                return;
            }
            
            try {
                const formData = new FormData();
                formData.append('id', id);

                const response = await fetch('api_delete.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    showToast('Sukses', 'Data produk berhasil dihapus.');
                    loadProducts(currentPage, currentSearch); 
                } else {
                    showToast('Error', result.message || 'Gagal menghapus data.', true);
                }
            } catch (error) {
                console.error('Error deleting:', error);
                showToast('Error Fatal', 'Terjadi kesalahan. Cek konsol.', true);
            }
        }

        

        
    let searchTimeout;
        searchInput.addEventListener('keyup', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                loadProducts(1, searchInput.value);
            }, 300); 
        });

        
    document.addEventListener('DOMContentLoaded', () => {
            loadProducts(1, '');
        });

    </script>
</body>
</html>