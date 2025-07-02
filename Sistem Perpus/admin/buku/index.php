<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

// ambil data buku + join kategori, penerbit, pengarang
$sql = "SELECT buku.*, kategori_buku.nama_kategori, penerbit.nama_penerbit, pengarang.nama_pengarang
        FROM buku
        LEFT JOIN kategori_buku ON buku.id_kategori = kategori_buku.id
        LEFT JOIN penerbit ON buku.id_penerbit = penerbit.id
        LEFT JOIN pengarang ON buku.id_pengarang = pengarang.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Buku</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Buku</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['nama_kategori']; ?></td>
                <td><?= $row['nama_penerbit']; ?></td>
                <td><?= $row['nama_pengarang']; ?></td>
                <td><?= $row['tahun_terbit']; ?></td>
                <td><?= $row['stok']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="../dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali ke Dashboard</a>
</div>
</div>
</body>
</html>
