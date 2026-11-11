<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
        header("Location: ../../pages/auth/login.php"); 
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Set session login
            $_SESSION['user_id'] = $user['user_id'] ?? $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? 'admin';

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Berhasil masuk ke sistem!'
            ];
            header("Location: ../../pages/products/index.php"); 
            exit;
        } else {
            $_SESSION['error'] = "Username atau password salah!";
            header("Location: ../../pages/auth/login.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Terjadi kesalahan database: " . $e->getMessage();
        header("Location: ../../pages/auth/login.php");
        exit;
    }
}