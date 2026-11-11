<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Produk berhasil dihapus!'
            ];
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus produk: ' . $e->getMessage()
            ];
        }
    }

    header("Location: ../../pages/products/index.php");
    exit;
}