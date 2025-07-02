<?php
session_start();
include '../../config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// ⛔ Cek apakah user adalah admin
if ($_SESSION['level'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}

$pesan = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($password_baru != $konfirmasi) {
        $pesan = "❌ Password tidak cocok.";
    } else {
        $hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "UPDATE users SET password = '$hash_baru' WHERE id = $user_id");

        if ($query) {
            $pesan = "✅ Password berhasil diganti.";
        } else {
            $pesan = "❌ Gagal mengganti password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 col-md-6">
    <h3>Ganti Password</h3>
    <?php if ($pesan): ?>
        <div class="alert alert-info"><?= $pesan; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password_baru" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi" class="form-control" required minlength="6">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
