<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body>
    <div class="app-shell">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="app-main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>
            
            <div class="app-content">
                <div class="page-header mb-4">
                    <h1 class="page-title">Tambah Pegawai Baru</h1>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="card shadow-sm p-4">
                    <form action="../../actions/employees/store.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="employee_code">Kode Pegawai</label>
                            <input type="text" id="employee_code" name="employee_code" class="form-control" value="<?= htmlspecialchars($old['employee_code'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="employee_name">Nama Pegawai</label>
                            <input type="text" id="employee_name" name="employee_name" class="form-control" value="<?= htmlspecialchars($old['employee_name'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">No. Telepon</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="position">Jabatan</label>
                            <input type="text" id="position" name="position" class="form-control" value="<?= htmlspecialchars($old['position'] ?? '') ?>">
                        </div>

                        <div class="form-group mb-4">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control" rows="3"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
                        </div>

                        <div class="form-actions flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php" class="btn btn-outline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>