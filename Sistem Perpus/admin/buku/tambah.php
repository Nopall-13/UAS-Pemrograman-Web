<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

// Ambil data relasi
$kategori = mysqli_query($conn, "SELECT * FROM kategori_buku");
$penerbit = mysqli_query($conn, "SELECT * FROM penerbit");
$pengarang = mysqli_query($conn, "SELECT * FROM pengarang");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun_terbit'];
    $id_kategori = $_POST['id_kategori'];
    $id_penerbit = $_POST['id_penerbit'];
    $id_pengarang = $_POST['id_pengarang'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO buku (judul, tahun_terbit, id_kategori, id_penerbit, id_pengarang, stok)
                         VALUES ('$judul', '$tahun', '$id_kategori', '$id_penerbit', '$id_pengarang', '$stok')");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">➕ Tambah Buku</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" min="1900" max="2099" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option disabled selected>-- Pilih Kategori --</option>
                <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                    <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Penerbit</label>
            <select name="id_penerbit" class="form-control" required>
                <option disabled selected>-- Pilih Penerbit --</option>
                <?php while ($p = mysqli_fetch_assoc($penerbit)) : ?>
                    <option value="<?= $p['id']; ?>"><?= $p['nama_penerbit']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Pengarang</label>
            <select name="id_pengarang" class="form-control" required>
                <option disabled selected>-- Pilih Pengarang --</option>
                <?php while ($pg = mysqli_fetch_assoc($pengarang)) : ?>
                    <option value="<?= $pg['id']; ?>"><?= $pg['nama_pengarang']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" min="0" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
