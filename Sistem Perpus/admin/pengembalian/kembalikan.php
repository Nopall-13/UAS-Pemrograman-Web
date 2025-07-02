<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
include '../../config/koneksi.php';

$id = $_GET['id'];
$tanggal_pengembalian = date('Y-m-d');

// Tambah ke tabel pengembalian
mysqli_query($conn, "INSERT INTO pengembalian (id_peminjaman, tanggal_pengembalian) VALUES ($id, '$tanggal_pengembalian')");

// Tambah denda otomatis jika terlambat
$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT tanggal_kembali FROM peminjaman WHERE id = $id
"));

$jatuh_tempo = $data['tanggal_kembali'];
$selisih = (strtotime($tanggal_pengembalian) - strtotime($jatuh_tempo)) / (60 * 60 * 24);

if ($selisih > 0) {
    $denda = $selisih * 1000;
    mysqli_query($conn, "INSERT INTO denda (id_pengembalian, jumlah, keterangan)
                         VALUES (LAST_INSERT_ID(), $denda, 'Terlambat $selisih hari')");
}

header("Location: index.php");
exit;
?>
