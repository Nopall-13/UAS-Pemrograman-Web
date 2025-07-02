<?php
session_start();
include 'config/koneksi.php';

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Cek email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "❌ Email sudah terdaftar.";
    } elseif ($password !== $konfirmasi) {
        $pesan = "❌ Password dan konfirmasi tidak cocok.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, level) VALUES ('$email', '$hash', '$nama', 'umum')");

        if ($query) {
            header("Location: login_user.php");
            exit;
        } else {
            $pesan = "❌ Registrasi gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e6f0ff, #f8f9fa);
            font-family: 'Segoe UI', sans-serif;
        }
        .register-box {
            max-width: 480px;
            margin: 80px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: 500;
        }
        .btn-primary {
            width: 100%;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="register-box">
    <h3>📝 Registrasi Pengguna</h3>
    <?php if ($pesan): ?>
        <div class="alert alert-warning"><?= $pesan; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email (Username)</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi" class="form-control" required minlength="6">
        </div>
        <button class="btn btn-primary">Daftar</button>
        <a href="login_user.php" class="btn btn-link d-block text-center mt-3">Sudah punya akun? Login di sini</a>
    </form>
</div>
</body>
</html>
