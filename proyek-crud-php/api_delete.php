<?php
header('Content-Type: application/json');
require 'config.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan.']);
    exit;
}

try {
    $stmt_img = $pdo->prepare("SELECT gambar FROM produk WHERE id = ?");
    $stmt_img->execute([$id]);
    $gambar = $stmt_img->fetchColumn();
    $sql = "DELETE FROM produk WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    if ($gambar && file_exists(UPLOADS_DIR . $gambar)) {
        @unlink(UPLOADS_DIR . $gambar);
    }

    echo json_encode(['success' => true, 'message' => 'Produk berhasil dihapus.']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>