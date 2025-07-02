<?php
include 'config/koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = date('Y-m-d');
$tanggal_kembali = date('Y-m-d', strtotime('+7 days')); // 7 hari ke depan

// Cek apakah anggota sudah ada
$cek = mysqli_query($conn, "SELECT * FROM anggota WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    $anggota = mysqli_fetch_assoc($cek);
    $id_anggota = $anggota['id'];
} else {
    mysqli_query($conn, "INSERT INTO anggota (nama, alamat, no_telp, email)
                         VALUES ('$nama', '$alamat', '$no_telp', '$email')");
    $id_anggota = mysqli_insert_id($conn);
}

// Masukkan ke peminjaman (user_id 0 untuk umum)
$id_user_umum = 4; // ← ID dari user "umum" yang kamu tambahkan
mysqli_query($conn, "INSERT INTO peminjaman (id_anggota, id_user, tanggal_pinjam, tanggal_kembali)
                     VALUES ($id_anggota, $id_user_umum, '$tanggal_pinjam', '$tanggal_kembali')");

$id_peminjaman = mysqli_insert_id($conn);

// Masukkan ke detail_peminjaman
mysqli_query($conn, "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah)
                     VALUES ($id_peminjaman, $id_buku, 1)");

// Kurangi stok buku
mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id = $id_buku");

// Redirect ke halaman sukses
header("Location: sukses.php");
exit;
?>
