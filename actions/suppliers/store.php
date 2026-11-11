<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supplier_code = trim($_POST['supplier_code'] ?? '');
    $supplier_name = trim($_POST['supplier_name'] ?? '');
    $phone         = trim($_POST['phone'] ?? '');
    $address       = trim($_POST['address'] ?? '');

    if (empty($supplier_code) || empty($supplier_name)) {
        $_SESSION['error'] = "Kode dan nama supplier wajib diisi!";
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/suppliers/create.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO suppliers (supplier_code, supplier_name, phone, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$supplier_code, $supplier_name, $phone, $address]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Supplier berhasil ditambahkan!'
        ];
        header("Location: ../../pages/suppliers/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menyimpan ke database: " . $e->getMessage();
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/suppliers/create.php");
        exit;
        
    }
}