<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

$denda = mysqli_query($conn, "
    SELECT d.*, a.nama, pg.tanggal_pengembalian 
    FROM denda d
    JOIN pengembalian pg ON d.id_pengembalian = pg.id
    JOIN peminjaman p ON pg.id_peminjaman = p.id
    JOIN anggota a ON p.id_anggota = a.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Denda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">💸 Data Denda</h3>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Tanggal Pengembalian</th>
                <th>Jumlah Denda</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while ($row = mysqli_fetch_assoc($denda)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tanggal_pengembalian']; ?></td>
                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                <td><?= $row['keterangan']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali ke Dashboard</a>
</div>
</body>
</html>
