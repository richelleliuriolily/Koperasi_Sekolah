<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login berdasarkan session
if (!isset($_SESSION['username']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'danger',
        'message' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'
    ];
    
    header("Location: ../../pages/auth/login.php");
    exit;
    
}