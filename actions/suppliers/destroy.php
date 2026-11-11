<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM suppliers WHERE supplier_id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Supplier berhasil dihapus!'
            ];
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus supplier: ' . $e->getMessage()
            ];
        }
    }

    header("Location: ../../pages/suppliers/index.php");
    exit;
    
}