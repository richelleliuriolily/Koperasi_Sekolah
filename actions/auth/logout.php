<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua kolom wajib diisi!";
        header("Location: ../../pages/auth/register.php");
        exit;
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Konfirmasi password tidak cocok!";
        header("Location: ../../pages/auth/register.php");
        exit;
    }

    try {
        $check = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $check->execute([$username, $email]);
        if ($check->rowCount() > 0) {
            $_SESSION['error'] = "Username atau email sudah digunakan!";
            header("Location: ../../pages/auth/register.php");
            exit;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Registrasi berhasil! Silakan login.'
        ];
        header("Location: ../../pages/auth/login.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal mendaftarkan akun: " . $e->getMessage();
        header("Location: ../../pages/auth/register.php");
        exit;
        
    }
}