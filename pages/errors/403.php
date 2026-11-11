<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body>
    <div class="app-shell" style="justify-content: center; align-items: center; min-height: 100vh;">
        <div class="card shadow-sm p-5 text-center" style="max-width: 450px; margin: auto;">
            <h1 class="page-title text-danger" style="font-size: 3rem; margin-bottom: 10px;">403</h1>
            <h2 style="margin-bottom: 15px;">Akses Ditolak</h2>
            <p class="text-muted mb-4">Maaf, Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
            
            <div class="actions">
                <a href="../../pages/products/index.php" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>