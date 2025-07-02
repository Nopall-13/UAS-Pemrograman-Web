<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

$id = $_GET['id'];

$peminjaman = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT p.*, a.nama AS nama_anggota, u.nama_lengkap AS nama_petugas
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id
    JOIN users u ON p.id_user = u.id
    WHERE p.id = $id
"));

$detail = mysqli_query($conn, "
    SELECT dp.*, b.judul 
    FROM detail_peminjaman dp
    JOIN buku b ON dp.id_buku = b.id
    WHERE dp.id_peminjaman = $id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-3">🔍 Detail Peminjaman</h3>

    <div class="mb-4">
        <strong>Nama Anggota:</strong> <?= $peminjaman['nama_anggota']; ?><br>
        <strong>Tanggal Pinjam:</strong> <?= $peminjaman['tanggal_pinjam']; ?><br>
        <strong>Tanggal Kembali:</strong> <?= $peminjaman['tanggal_kembali']; ?><br>
        <strong>Petugas:</strong> <?= $peminjaman['nama_petugas']; ?>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($detail)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['jumlah']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
</div>
</body>
</html>
