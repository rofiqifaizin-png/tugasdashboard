<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama  = trim($_POST['nama_barang']);
    $harga = (int) $_POST['harga'];
    $stok  = (int) $_POST['stok'];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO produk (nama_barang, harga, stok) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sii", $nama, $harga, $stok);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=tambah");
    exit;
}

$judul = "Tambah Produk"; $halaman = "produk";
include "layout_atas.php";
?>
<h2 class="page-title mb-4">Tambah Produk</h2>
<div class="panel" style="max-width:640px">
  <form method="post">
    <div class="mb-3">
      <label class="form-label fw-semibold">Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Keyboard Mekanik" required>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Harga (Rp)</label>
        <input type="number" name="harga" min="0" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="stok" min="0" class="form-control" required>
      </div>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" name="simpan" class="btn btn-teal px-4"><i class="bi bi-check-lg me-1"></i>Simpan</button>
      <a href="index.php" class="btn btn-light border" style="border-radius:10px">Batal</a>
    </div>
  </form>
</div>
<?php include "layout_bawah.php"; ?>
