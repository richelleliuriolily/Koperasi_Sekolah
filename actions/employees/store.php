<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_code = trim($_POST['employee_code'] ?? '');
    $employee_name = trim($_POST['employee_name'] ?? '');
    $phone         = trim($_POST['phone'] ?? '');
    $address       = trim($_POST['address'] ?? '');
    $position      = trim($_POST['position'] ?? '');

    if (empty($employee_code) || empty($employee_name)) {
        $_SESSION['error'] = "Kode dan nama pegawai wajib diisi!";
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/employees/create.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO employees (employee_code, employee_name, phone, address, position) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$employee_code, $employee_name, $phone, $address, $position]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Data pegawai berhasil ditambahkan!'
        ];
        header("Location: ../../pages/employees/index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal menyimpan ke database: " . $e->getMessage();
        $_SESSION['old'] = $_POST;
        header("Location: ../../pages/employees/create.php");
        exit;
    }
}