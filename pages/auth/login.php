<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="card shadow-sm p-4" style="max-width: 400px; margin: 80px auto;">
            <div class="text-center mb-4">
                <h1 class="page-title">Masuk Sistem</h1>
                <p class="page-subtitle text-muted">Sistem Informasi Koperasi Sekolah</p>
            </div>

            <?php if ($flash): ?>
                <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="../../actions/auth/login.php" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Username / Email</label>
                    <input type="text" id="username" name="username" class="form-control" required autofocus>
                </div>

                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="width: 100%;">Masuk</button>
            </form>

            <div class="text-center mt-3">
                <p class="text-muted text-sm">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>