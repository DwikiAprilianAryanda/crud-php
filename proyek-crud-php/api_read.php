<?php
header('Content-Type: application/json');
require 'config.php';

$limit = 5;
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_clause = '';
$params = [];

if (!empty($search)) {
    $where_clause = " WHERE nama_produk LIKE ?";
    $params[] = "%$search%";
}

try {
    $stats_total_produk = $pdo->query("SELECT COUNT(id) FROM produk")->fetchColumn();
    $stats_total_nilai = $pdo->query("SELECT SUM(harga) FROM produk")->fetchColumn();
    $stats_produk_terbaru = $pdo->query("SELECT nama_produk FROM produk ORDER BY created_at DESC LIMIT 1")->fetchColumn();
    
    $stats = [
        'total_produk' => $stats_total_produk ?: 0,
        'total_nilai' => $stats_total_nilai ?: 0,
        'produk_terbaru' => $stats_produk_terbaru ?: '-'
    ];

    $count_sql = "SELECT COUNT(id) FROM produk" . $where_clause;
    $count_stmt = $pdo->prepare($count_sql);
    $count_stmt->execute($params);
    $total_rows_filtered = $count_stmt->fetchColumn();
    $total_pages = ceil($total_rows_filtered / $limit);

    $sql = "SELECT * FROM produk" . $where_clause . " ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $pdo->prepare($sql);

    $param_index = 1;
    if (!empty($search)) {
        $stmt->bindValue($param_index, $params[0]);
        $param_index++;
    }
    $stmt->bindValue($param_index, $limit, PDO::PARAM_INT);
    $param_index++;
    $stmt->bindValue($param_index, $offset, PDO::PARAM_INT);

    $stmt->execute();
    $products = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'stats' => $stats,
        'products' => $products,
        'currentPage' => $page,
        'totalPages' => $total_pages
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>