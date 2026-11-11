<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = ?");
$stmt->execute([$id]);
$supplier = $stmt->fetch();

if (!$supplier) {
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Supplier tidak ditemukan!'];
    header("Location: index.php");
    exit;
}

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Supplier - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body>
    <div class="app-shell">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="app-main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>
            
            <div class="app-content">
                <div class="page-header mb-4">
                    <h1 class="page-title">Ubah Supplier</h1>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="card shadow-sm p-4">
                    <form action="../../actions/suppliers/update.php" method="POST">
                        <input type="hidden" name="supplier_id" value="<?= (int)$supplier['supplier_id'] ?>">

                        <div class="form-group mb-3">
                            <label for="supplier_code">Kode Supplier</label>
                            <input type="text" id="supplier_code" name="supplier_code" class="form-control" value="<?= htmlspecialchars($supplier['supplier_code']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="supplier_name">Nama Supplier</label>
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control" value="<?= htmlspecialchars($supplier['supplier_name']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">No. Telepon</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($supplier['phone']) ?>">
                        </div>

                        <div class="form-group mb-4">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control" rows="3"><?= htmlspecialchars($supplier['address']) ?></textarea>
                        </div>

                        <div class="form-actions flex gap-2">
                            <button type="submit" class="btn btn-primary">Perbarui Supplier</button>
                            <a href="index.php" class="btn btn-outline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>