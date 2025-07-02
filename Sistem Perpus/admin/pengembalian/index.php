<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

// ambil semua peminjaman yang belum dikembalikan
$peminjaman = mysqli_query($conn, "
    SELECT p.id, a.nama, p.tanggal_pinjam, p.tanggal_kembali 
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id
    LEFT JOIN pengembalian pg ON p.id = pg.id_peminjaman
    WHERE pg.id IS NULL
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">🔁 Pengembalian Buku</h3>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while ($row = mysqli_fetch_assoc($peminjaman)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tanggal_pinjam']; ?></td>
                <td><?= $row['tanggal_kembali']; ?></td>
                <td>
                    <a href="kembalikan.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Kembalikan</a>
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
