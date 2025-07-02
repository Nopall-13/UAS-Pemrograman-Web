<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

$peminjaman = mysqli_query($conn, "
    SELECT p.*, a.nama AS nama_anggota, u.nama_lengkap AS nama_petugas
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id
    JOIN users u ON p.id_user = u.id
    ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">📚 Data Peminjaman</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Peminjaman</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($peminjaman)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_anggota']; ?></td>
                <td><?= $row['tanggal_pinjam']; ?></td>
                <td><?= $row['tanggal_kembali']; ?></td>
                <td><?= $row['nama_petugas']; ?></td>
                <td>
                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali ke Dashboard</a>
</div>
</body>
</html>
