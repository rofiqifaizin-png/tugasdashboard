<?php
include "koneksi.php";

$cari = trim($_GET['q'] ?? '');
$like = "%" . $cari . "%";
$stmt = mysqli_prepare($koneksi, "SELECT * FROM produk WHERE nama_barang LIKE ? ORDER BY id ASC");
mysqli_stmt_bind_param($stmt, "s", $like);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);

$ringkas = mysqli_fetch_assoc(mysqli_query($koneksi,
  "SELECT COUNT(*) AS jumlah, COALESCE(SUM(stok),0) AS total_stok, COALESCE(SUM(harga*stok),0) AS nilai FROM produk"));

$pesan = [
  'tambah' => 'Produk berhasil ditambahkan.',
  'edit'   => 'Produk berhasil diperbarui.',
  'hapus'  => 'Produk berhasil dihapus.',
];
$notif = $pesan[$_GET['pesan'] ?? ''] ?? null;

$judul = "Beranda"; $halaman = "beranda";
include "layout_atas.php";
?>
<h2 class="page-title mb-4">Beranda</h2>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
      <div class="icon"><i class="bi bi-box-seam"></i></div>
      <div><div class="text-muted small">Jumlah Produk</div><div class="fs-4 fw-bold"><?= $ringkas['jumlah'] ?></div></div>
    </div></div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
      <div class="icon"><i class="bi bi-stack"></i></div>
      <div><div class="text-muted small">Total Stok</div><div class="fs-4 fw-bold"><?= number_format($ringkas['total_stok'], 0, ',', '.') ?></div></div>
    </div></div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
      <div class="icon"><i class="bi bi-cash-coin"></i></div>
      <div><div class="text-muted small">Nilai Persediaan</div><div class="fs-4 fw-bold"><?= rupiah($ringkas['nilai']) ?></div></div>
    </div></div>
  </div>
</div>

<?php if ($notif) { ?>
  <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle-fill me-2"></i><?= $notif ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php } ?>

<div class="panel">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h5 class="m-0 fw-bold">Daftar Produk</h5>
    <div class="d-flex gap-2">
      <form method="get" class="d-flex gap-2">
        <input type="text" name="q" value="<?= htmlspecialchars($cari) ?>" class="form-control" placeholder="Cari nama barang...">
        <button class="btn btn-outline-secondary" style="border-radius:10px"><i class="bi bi-search"></i></button>
      </form>
      <a href="tambah.php" class="btn btn-teal text-nowrap"><i class="bi bi-plus-lg me-1"></i>Tambah Produk</a>
    </div>
  </div>

  <div class="table-responsive">
  <table class="table table-hover mb-0">
    <thead><tr><th>#</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th class="text-end">Aksi</th></tr></thead>
    <tbody>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) {
      $badge = $row['stok'] < 20 ? 'bg-warning-subtle text-warning-emphasis' : 'bg-success-subtle text-success-emphasis'; ?>
      <tr>
        <td><?= $no++ ?></td>
        <td class="fw-semibold"><?= htmlspecialchars($row['nama_barang']) ?></td>
        <td><?= rupiah($row['harga']) ?></td>
        <td><span class="badge rounded-pill <?= $badge ?>"><?= $row['stok'] ?> unit</span></td>
        <td class="text-end">
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i> Edit</a>
          <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger"
             onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="bi bi-trash3"></i> Hapus</a>
        </td>
      </tr>
    <?php } if ($no === 1) { ?>
      <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada produk ditemukan.</td></tr>
    <?php } ?>
    </tbody>
  </table>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include "layout_bawah.php"; ?>
