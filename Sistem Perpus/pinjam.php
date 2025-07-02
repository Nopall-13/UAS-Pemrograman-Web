<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Form Peminjaman Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f5f7fa, #c3cfe2);
      font-family: 'Segoe UI', sans-serif;
    }
    .card-form {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .card-form h3 {
      margin-bottom: 25px;
      text-align: center;
      color: #343a40;
    }
    .form-label {
      font-weight: 500;
    }
    .btn-success {
      width: 100%;
      font-weight: bold;
    }
    .btn-secondary {
      width: 100%;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="card-form">
  <h3>📘 Form Peminjaman Buku</h3>
  <form action="proses_pinjam.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required placeholder="Alamat lengkap"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">No Telepon</label>
      <input type="text" name="no_telp" class="form-control" required placeholder="08xxxxxxxxxx">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
    </div>
    <div class="mb-3">
      <label class="form-label">📚 Buku yang Ingin Dipinjam</label>
      <select name="id_buku" class="form-control" required>
        <option value="">-- Pilih Buku --</option>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id']}'>{$row['judul']}</option>";
        }
        ?>
      </select>
    </div>
    <button class="btn btn-success">Ajukan Peminjaman</button>
    <a href="index.php" class="btn btn-secondary">← Kembali ke Beranda</a>
  </form>
</div>

</body>
</html>
