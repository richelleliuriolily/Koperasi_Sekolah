<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$employees = $pdo->query("SELECT * FROM employees ORDER BY employee_id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai - Manajemenskull</title>
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
                    <a href="create.php" class="btn btn-primary">Tambah Pegawai</a>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Pegawai</th>
                                <th>Telepon</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($employees)): ?>
                                <tr><td colspan="7" class="empty">Data pegawai belum tersedia</td></tr>
                            <?php endif; ?>

                            <?php foreach ($employees as $i => $e): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($e['employee_code']) ?></td>
                                    <td><?= htmlspecialchars($e['employee_name']) ?></td>
                                    <td><?= htmlspecialchars($e['phone']) ?></td>
                                    <td><?= htmlspecialchars($e['position']) ?></td>
                                    <td><?= htmlspecialchars($e['address']) ?></td>
                                    <td class="actions">
                                        <a href="edit.php?id=<?= (int)$e['employee_id'] ?>" class="btn btn-outline btn-sm">Ubah</a>

                                        <form method="POST" action="../../actions/employees/destroy.php" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus pegawai <?= htmlspecialchars(addslashes($e['employee_name']), ENT_QUOTES) ?>?');">
                                            <input type="hidden" name="id" value="<?= (int)$e['employee_id'] ?>">
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