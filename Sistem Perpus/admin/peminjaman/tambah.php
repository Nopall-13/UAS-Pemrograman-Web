<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

// Ambil data anggota dan buku
$anggota = mysqli_query($conn, "SELECT * FROM anggota");
$buku = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");

// Simpan data peminjaman
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $id_user = $_SESSION['user_id'];
    $buku_ids = $_POST['id_buku']; // array id buku
    $jumlah = $_POST['jumlah'];    // array jumlah pinjam

    // Simpan ke tabel peminjaman
    mysqli_query($conn, "INSERT INTO peminjaman (id_anggota, id_user, tanggal_pinjam, tanggal_kembali) 
                         VALUES ($id_anggota, $id_user, '$tanggal_pinjam', '$tanggal_kembali')");

    $id_peminjaman = mysqli_insert_id($conn);

    // Simpan detail peminjaman
    for ($i = 0; $i < count($buku_ids); $i++) {
        $id_buku = $buku_ids[$i];
        $jml = $jumlah[$i];
        mysqli_query($conn, "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah)
                             VALUES ($id_peminjaman, $id_buku, $jml)");

        // Update stok buku
        mysqli_query($conn, "UPDATE buku SET stok = stok - $jml WHERE id = $id_buku");
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">➕ Tambah Peminjaman</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Anggota</label>
            <select name="id_anggota" class="form-control" required>
                <option disabled selected>-- Pilih Anggota --</option>
                <?php while ($a = mysqli_fetch_assoc($anggota)) : ?>
                    <option value="<?= $a['id']; ?>"><?= $a['nama']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <h5>Buku yang Dipinjam</h5>
        <div id="buku-container">
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="id_buku[]" class="form-control" required>
                        <option disabled selected>-- Pilih Buku --</option>
                        <?php mysqli_data_seek($buku, 0); while ($b = mysqli_fetch_assoc($buku)) : ?>
                            <option value="<?= $b['id']; ?>"><?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" min="1" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="tambahBaris()">+ Tambah Buku</button>
        <br>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function tambahBaris() {
    const container = document.getElementById('buku-container');
    const clone = container.children[0].cloneNode(true);
    container.appendChild(clone);
}
</script>
</body>
</html>
