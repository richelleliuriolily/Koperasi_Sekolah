<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id   = $_POST['product_id'] ?? null;
    $product_code = trim($_POST['product_code'] ?? '');
    $product_name = trim($_POST['product_name'] ?? '');
    $category     = trim($_POST['category'] ?? '');
    $unit         = trim($_POST['unit'] ?? '');
    $price        = $_POST['price'] ?? 0;
    $stock        = $_POST['stock'] ?? 0;
    $entry_date   = $_POST['entry_date'] ?? date('Y-m-d');
    $description  = trim($_POST['description'] ?? '');

    if (!$product_id || empty($product_code) || empty($product_name)) {
        $_SESSION['error'] = "Data tidak valid atau ada kolom wajib yang kosong!";
        header("Location: ../../pages/products/edit.php?id=" . $product_id);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE products SET product_code = ?, product_name = ?, category = ?, unit = ?, price = ?, stock = ?, entry_date = ?, description = ? WHERE product_id = ?");
        $stmt->execute([$product_code, $product_name, $category, $unit, $price, $stock, $entry_date, $description, $product_id]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Produk berhasil diperbarui!'
        ];
        header("Location: ../../pages/products/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal memperbarui database: " . $e->getMessage();
        header("Location: ../../pages/products/edit.php?id=" . $product_id);
        exit;
    }
}