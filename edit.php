<?php
include "koneksi.php";

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

if (isset($_POST['update'])) {
    $nama  = trim($_POST['nama_barang']);
    $harga = (int) $_POST['harga'];
    $stok  = (int) $_POST['stok'];

    $stmt = mysqli_prepare($koneksi, "UPDATE produk SET nama_barang=?, harga=?, stok=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "siii", $nama, $harga, $stok, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=edit");
    exit;
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM produk WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    header("Location: index.php");
    exit;
}

$judul = "Edit Produk"; $halaman = "produk";
include "layout_atas.php";
?>
<h2 class="page-title mb-4">Edit Produk</h2>
<div class="panel" style="max-width:640px">
  <form method="post">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
      <label class="form-label fw-semibold">Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Harga (Rp)</label>
        <input type="number" name="harga" min="0" class="form-control" value="<?= $data['harga'] ?>" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="stok" min="0" class="form-control" value="<?= $data['stok'] ?>" required>
      </div>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" name="update" class="btn btn-teal px-4"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
      <a href="index.php" class="btn btn-light border" style="border-radius:10px">Batal</a>
    </div>
  </form>
</div>
<?php include "layout_bawah.php"; ?>
