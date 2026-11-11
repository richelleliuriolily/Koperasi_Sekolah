<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$suppliers = $pdo->query("SELECT * FROM suppliers ORDER BY supplier_id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier - Manajemenskull</title>
    <link rel="stylesheet" href="../../styles/base.css">
</head>
<body>
    <div class="app-shell">
        <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

        <main class="app-main">
            <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>
            
            <div class="app-content">
                <?php if ($flash): ?>
                    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
                        <?= htmlspecialchars($flash['message']) ?>
                    </div>
                <?php endif; ?>

                <div class="toolbar mb-3">
                    <a href="create.php" class="btn btn-primary">Tambah Supplier</a>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Supplier</th>
                                <th>Nama Supplier</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($suppliers)): ?>
                                <tr><td colspan="6" class="empty">Data supplier belum tersedia</td></tr>
                            <?php endif; ?>

                            <?php foreach ($suppliers as $i => $s): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($s['supplier_code']) ?></td>
                                    <td><?= htmlspecialchars($s['supplier_name']) ?></td>
                                    <td><?= htmlspecialchars($s['phone']) ?></td>
                                    <td><?= htmlspecialchars($s['address']) ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int)$s['supplier_id'] ?>" class="btn btn-outline btn-sm">Ubah</a>

                                        <form method="POST" action="../../actions/suppliers/destroy.php" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus supplier <?= htmlspecialchars(addslashes($s['supplier_name']), ENT_QUOTES) ?>?');">
                                            <input type="hidden" name="id" value="<?= (int)$s['supplier_id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>