# Aplikasi Manajemen Produk (PHP Native CRUD Dashboard)

Aplikasi ini adalah dashboard CRUD (Create, Read, Update, Delete) untuk manajemen produk. Dibangun murni menggunakan **PHP Native** (tanpa framework), koneksi **PDO**, dan antarmuka (UI) modern dengan **Bootstrap 5** dan **AJAX**.

Semua operasi data (tambah, edit, hapus, cari, pindah halaman) dieksekusi di latar belakang tanpa me-refresh halaman, memberikan pengalaman pengguna yang cepat dan profesional.

-----

## Fitur yang Tersedia 

  * **Full CRUD (Create, Read, Update, Delete)** via AJAX tanpa *refresh* halaman.
  * **Upload Gambar Produk** (termasuk preview, update, dan hapus file otomatis saat data dihapus/diperbarui).
  * **Layout Dashboard Profesional** dengan Sidebar, Navbar, dan Kartu Statistik (Total Produk, Nilai Inventaris, Produk Terbaru).
  * **Pencarian (Search)** data secara dinamis (live search).
  * **Pagination** dinamis via AJAX.
  * **Antarmuka Modal (Pop-up)** Bootstrap 5 untuk menambah dan mengedit data.
  * **Notifikasi Toast** (pop-up) untuk pesan sukses atau error.
  * **Validasi Server-side** dan sanitasi output (Anti SQL Injection & XSS).
  * **Desain Responsif** dan modern dengan CSS kustom.

-----

## Kebutuhan Sistem

  * Server lokal (XAMPP, Laragon, WAMP, MAMP).
  * PHP 8.0 atau lebih baru (dengan ekstensi `pdo_mysql` aktif).
  * Database MySQL atau MariaDB.
  * Browser modern (Chrome, Firefox, Safari, Edge).

-----

## Cara Instalasi dan Konfigurasi

1.  **Clone repositori ini:**

    ```sh
    git clone [URL_GITHUB_ANDA]
    ```

2.  **Masuk ke folder proyek:**

    ```sh
    cd proyek-crud-php
    ```

3.  **Buat Database:**
    Buka phpMyAdmin atau HeidiSQL, buat database baru dengan nama `db_toko`.

4.  **Impor Database:**
    Impor struktur tabel ke database `db_toko` Anda menggunakan file `database.sql` yang ada di repositori ini.

5.  **Konfigurasi Koneksi:**
    Di dalam folder `proyek-crud-php/`, **buat file baru** bernama `config.php`.

6.  **Edit `config.php`:**
    Salin konten dari bagian **Contoh Environment Config** di bawah ini, tempel ke file `config.php` baru Anda, dan sesuaikan `db_user` serta `db_pass` jika diperlukan.

7.  **Atur Izin Folder:**
    Pastikan server web Anda (Apache/Nginx) memiliki izin untuk menulis ke folder `uploads/`.

8.  **Selesai\!**
    Buka aplikasi di browser Anda (misal: `http://localhost/proyek-crud-php/`).

-----

## Struktur Folder

```
/proyek-crud-php/
|-- api_create.php       (Logika backend untuk menambah data)
|-- api_read.php         (Logika backend untuk membaca data & statistik)
|-- api_update.php       (Logika backend untuk update data)
|-- api_delete.php       (Logika backend untuk menghapus data)
|-- api_get_detail.php   (Logika backend untuk mengambil 1 data)
|-- config.php           (File konfigurasi koneksi - DIBUAT MANUAL)
|-- database.sql         (Struktur database SQL)
|-- index.php            (File utama - Tampilan/Frontend)
|-- style.css            (File styling)
|-- uploads/             (Folder untuk gambar produk)
    |-- (file gambar...)
```

-----

## Contoh Environment Config


```php
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);


define('UPLOADS_DIR', __DIR__ . '/uploads/');


$db_host = 'localhost';
$db_name = 'db_toko';
$db_user = 'root';      
$db_pass = '';          


try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Pesan error jika koneksi gagal
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $e->getMessage()]);
    exit;
}
?>
```

-----

## Screenshot Aplikasi

<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/e50f4582-2e70-4a21-bb48-d03f4d816555" />



<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/4568becc-2a98-4679-a191-01b75944d42a" />



<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/6a6a12c1-09b5-43f5-9697-8be970e83203" />
