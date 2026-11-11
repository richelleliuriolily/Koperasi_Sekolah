<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="card shadow-sm p-4" style="max-width: 400px; margin: 50px auto;">
            <div class="text-center mb-4">
                <h1 class="page-title">Daftar Akun Baru</h1>
                <p class="page-subtitle text-muted">Sistem Informasi Koperasi Sekolah</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="../../actions/auth/register.php" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="width: 100%;">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <p class="text-muted text-sm">Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>