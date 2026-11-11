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
    <title>Tambah Produk - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body>
    <div class="app-shell">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="app-main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>
            
            <div class="app-content">
                <div class="page-header mb-4">
                    <h1 class="page-title">Tambah Produk Baru</h1>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="card shadow-sm p-4">
                    <form action="../../actions/products/store.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="product_code">Kode Produk</label>
                            <input type="text" id="product_code" name="product_code" class="form-control" value="<?= htmlspecialchars($old['product_code'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" value="<?= htmlspecialchars($old['product_name'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="category">Kategori</label>
                            <input type="text" id="category" name="category" class="form-control" value="<?= htmlspecialchars($old['category'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="unit">Satuan</label>
                            <input type="text" id="unit" name="unit" class="form-control" value="<?= htmlspecialchars($old['unit'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="price">Harga</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?= htmlspecialchars($old['price'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock">Stok</label>
                            <input type="number" id="stock" name="stock" class="form-control" value="<?= htmlspecialchars($old['stock'] ?? '') ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="entry_date">Tanggal Masuk</label>
                            <input type="date" id="entry_date" name="entry_date" class="form-control" value="<?= htmlspecialchars($old['entry_date'] ?? date('Y-m-d')) ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-actions flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                            <a href="index.php" class="btn btn-outline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>