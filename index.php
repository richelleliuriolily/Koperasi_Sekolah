<?php
$title = "Beranda - BukuKita";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="styles/index.css">
</head>

<body>
  <?php require_once __DIR__ . "/components/landing/header.php" ?>

  <section class="hero">
    <h1>Kelola Koperasi Sekolah </h1>
    <p>Manajemenskull membantu dalam mencatat pengeluaran dan pembelian suatu produk.</p>
    <div class="hero-cta">
      <a href="pages/auth/login.php" class="btn btn-primary">Masuk ke Akun</a>
      <a href="pages/categories/index.php" class="btn btn-outline">Lihat Kategori</a>
    </div>
  </section>

  <section class="features">
    <div class="feature-card">
      <h3>Manajemen produk</h3>
      <p>Admin dapat menambah, mengubah, dan menghapus koperasi.</p>
    </div>
    <div class="feature-card">
      <h3>Manajemen Supplier</h3>
      <p>Setiap supplier dapat dikelompokkan .</p>
    </div>
    <div class="feature-card">
      <h3>Hak pegawai</h3>
      <p>Admin mengelola data pengawai, jabatan, gaji tersimpan rapi.</p>
    </div>
  </section>

  <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</body>

</html>
