<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supplier_id   = $_POST['supplier_id'] ?? null;
    $supplier_code = trim($_POST['supplier_code'] ?? '');
    $supplier_name = trim($_POST['supplier_name'] ?? '');
    $phone         = trim($_POST['phone'] ?? '');
    $address       = trim($_POST['address'] ?? '');

    if (!$supplier_id || empty($supplier_code) || empty($supplier_name)) {
        $_SESSION['error'] = "Data tidak valid atau kolom wajib kosong!";
        header("Location: ../../pages/suppliers/edit.php?id=" . $supplier_id);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE suppliers SET supplier_code = ?, supplier_name = ?, phone = ?, address = ? WHERE supplier_id = ?");
        $stmt->execute([$supplier_code, $supplier_name, $phone, $address, $supplier_id]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Supplier berhasil diperbarui!'
        ];
        header("Location: ../../pages/suppliers/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal memperbarui database: " . $e->getMessage();
        header("Location: ../../pages/suppliers/edit.php?id=" . $supplier_id);
        exit;
        
    }
}