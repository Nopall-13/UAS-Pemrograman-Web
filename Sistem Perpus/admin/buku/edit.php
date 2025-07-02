<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../config/koneksi.php';

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Ambil data buku lama
$buku = mysqli_query($conn, "SELECT * FROM buku WHERE id = $id");
$data = mysqli_fetch_assoc($buku);

// Ambil semua data relasi untuk dropdown
$kategori = mysqli_query($conn, "SELECT * FROM kategori_buku");
$penerbit = mysqli_query($conn, "SELECT * FROM penerbit");
$pengarang = mysqli_query($conn, "SELECT * FROM pengarang");

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun_terbit'];
    $id_kategori = $_POST['id_kategori'];
    $id_penerbit = $_POST['id_penerbit'];
    $id_pengarang = $_POST['id_pengarang'];
    $stok = $_POST['stok'];

    $update = "UPDATE buku SET 
                judul = '$judul',
                tahun_terbit = '$tahun',
                id_kategori = '$id_kategori',
                id_penerbit = '$id_penerbit',
                id_pengarang = '$id_pengarang',
                stok = '$stok'
               WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: index.php");
    } else {
        echo "Gagal mengedit data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Edit Buku</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="<?= $data['judul']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($kategori)) : ?>
                    <option value="<?= $row['id']; ?>" <?= $data['id_kategori'] == $row['id'] ? 'selected' : ''; ?>>
                        <?= $row['nama_kategori']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Penerbit</label>
            <select name="id_penerbit" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($penerbit)) : ?>
                    <option value="<?= $row['id']; ?>" <?= $data['id_penerbit'] == $row['id'] ? 'selected' : ''; ?>>
                        <?= $row['nama_penerbit']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Pengarang</label>
            <select name="id_pengarang" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($pengarang)) : ?>
                    <option value="<?= $row['id']; ?>" <?= $data['id_pengarang'] == $row['id'] ? 'selected' : ''; ?>>
                        <?= $row['nama_pengarang']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok']; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
