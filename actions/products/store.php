<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_code = trim($_POST['product_code'] ?? '');
    $product_name = trim($_POST['product_name'] ?? '');
    $category     = trim($_POST['category'] ?? '');
    $unit         = trim($_POST['unit'] ?? '');
    $price        = $_POST['price'] ?? 0;
    $stock        = $_POST['stock'] ?? 0;
    $entry_date   = $_POST['entry_date'] ?? date('Y-m-d');
    $description  = trim($_POST['description'] ?? '');

    if (empty($product_code) || empty($product_name) || empty($price)) {
        $_SESSION['error'] = "Kode, nama, dan harga produk wajib diisi!";
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/products/create.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$product_code, $product_name, $category, $unit, $price, $stock, $entry_date, $description]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Produk berhasil ditambahkan!'
        ];
        header("Location: ../../pages/products/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menyimpan ke database: " . $e->getMessage();
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/products/create.php");
        exit;
    }
}