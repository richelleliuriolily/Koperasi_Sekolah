<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM employees WHERE employee_id = ?");
            $stmt->execute([$id]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data pegawai berhasil dihapus!'
            ];
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus pegawai: ' . $e->getMessage()
            ];
        }
    }

    header("Location: ../../pages/employees/index.php");
    exit;
}