<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id   = $_POST['employee_id'] ?? null;
    $employee_code = trim($_POST['employee_code'] ?? '');
    $employee_name = trim($_POST['employee_name'] ?? '');
    $phone         = trim($_POST['phone'] ?? '');
    $address       = trim($_POST['address'] ?? '');
    $position      = trim($_POST['position'] ?? '');

    if (!$employee_id || empty($employee_code) || empty($employee_name)) {
        $_SESSION['error'] = "Data tidak valid atau kolom wajib kosong!";
        header("Location: ../../pages/employees/edit.php?id=" . $employee_id);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE employees SET employee_code = ?, employee_name = ?, phone = ?, address = ?, position = ? WHERE employee_id = ?");
        $stmt->execute([$employee_code, $employee_name, $phone, $address, $position, $employee_id]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Data pegawai berhasil diperbarui!'
        ];
        header("Location: ../../pages/employees/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal memperbarui database: " . $e->getMessage();
        header("Location: ../../pages/employees/edit.php?id=" . $employee_id);
        exit;
        
    }
}