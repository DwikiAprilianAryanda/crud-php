<?php
header('Content-Type: application/json');
require 'config.php';

$nama_produk = trim($_POST['nama_produk'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$gambar = $_FILES['gambar'] ?? null;
$nama_gambar = null;

if (empty($nama_produk) || $harga === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Nama produk dan harga wajib diisi.']);
    exit;
}
function handleUpload($file) {
    try {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error saat upload file.');
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_baru = uniqid('produk_') . '.' . $ext;
        $tujuan = UPLOADS_DIR . $nama_file_baru;
        
        if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
            throw new Exception('Gagal memindahkan file.');
        }
        return $nama_file_baru;
    } catch (Exception $e) {
        return null;
    }
}

if ($gambar && $gambar['error'] == UPLOAD_ERR_OK) {
    $nama_gambar = handleUpload($gambar);
    if ($nama_gambar === null) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal mengupload gambar.']);
        exit;
    }
}

try {
    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nama_produk, $deskripsi, $harga, $nama_gambar]);
    $new_id = $pdo->lastInsertId();
    
    $stmt_new = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt_new->execute([$new_id]);
    $new_product = $stmt_new->fetch();

    echo json_encode(['success' => true, 'product' => $new_product]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>