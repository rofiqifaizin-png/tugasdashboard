<?php $halaman = $halaman ?? 'beranda'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TokoKita - <?= $judul ?? 'Beranda' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
<aside class="sidebar">
  <a href="index.php" class="brand"><span><i class="bi bi-bag-heart-fill"></i></span> TokoKita</a>
  <ul class="nav flex-column">
    <li><a class="nav-link <?= $halaman=='beranda'?'active':'' ?>" href="index.php"><i class="bi bi-grid-1x2-fill"></i>Beranda</a></li>
    <li><a class="nav-link <?= $halaman=='produk'?'active':'' ?>" href="index.php"><i class="bi bi-box-seam"></i>Produk</a></li>
    <li><a class="nav-link" href="#"><i class="bi bi-receipt"></i>Pesanan</a></li>
    <li><a class="nav-link" href="#"><i class="bi bi-person-lines-fill"></i>Pelanggan</a></li>
    <li><a class="nav-link" href="#"><i class="bi bi-bar-chart-line"></i>Laporan</a></li>
    <li class="mt-4"><a class="nav-link" href="#"><i class="bi bi-box-arrow-left"></i>Keluar</a></li>
  </ul>
</aside>
<main class="content">
