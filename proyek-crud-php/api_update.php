<?php
header('Content-Type: application/json');
require 'config.php';

function handleUpload($file) {
    try {
        if ($file['error'] !== UPLOAD_ERR_OK) { throw new Exception('Error saat upload.'); }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_baru = uniqid('produk_') . '.' . $ext;
        $tujuan = UPLOADS_DIR . $nama_file_baru;
        if (!move_uploaded_file($file['tmp_name'], $tujuan)) { throw new Exception('Gagal memindahkan file.'); }
        return $nama_file_baru;
    } catch (Exception $e) { return null; }
}

$id = $_POST['id'] ?? null;
$nama_produk = trim($_POST['nama_produk'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$gambar_baru = $_FILES['gambar'] ?? null;
$nama_gambar_baru = null;

if (empty($id) || empty($nama_produk) || $harga === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID, Nama, dan Harga wajib diisi.']);
    exit;
}

try {
    $stmt_old = $pdo->prepare("SELECT gambar FROM produk WHERE id = ?");
    $stmt_old->execute([$id]);
    $gambar_lama = $stmt_old->fetchColumn();
    $nama_gambar_baru = $gambar_lama; // Default pakai gambar lama

    if ($gambar_baru && $gambar_baru['error'] == UPLOAD_ERR_OK) {
        $nama_gambar_baru = handleUpload($gambar_baru);
        if ($nama_gambar_baru === null) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal mengupload gambar baru.']);
            exit;
        }
        
        if ($gambar_lama && file_exists(UPLOADS_DIR . $gambar_lama)) {
            @unlink(UPLOADS_DIR . $gambar_lama);
        }
    }

    $sql = "UPDATE produk SET nama_produk = ?, deskripsi = ?, harga = ?, gambar = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nama_produk, $deskripsi, $harga, $nama_gambar_baru, $id]);

    $stmt_new = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt_new->execute([$id]);
    $updated_product = $stmt_new->fetch();

    echo json_encode(['success' => true, 'product' => $updated_product]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>