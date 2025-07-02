<?php
session_start();
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Perpustakaan Umum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #eef2f3, #8e9eab);
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 800px;
      margin-top: 60px;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #343a40;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-group {
      margin-top: 25px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>📚 Daftar Buku Tersedia</h2>
  
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Judul Buku</th>
        <th>Stok</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $buku = mysqli_query($conn, "SELECT * FROM buku");
      while ($row = mysqli_fetch_assoc($buku)) {
          echo "<tr><td>{$row['judul']}</td><td>{$row['stok']}</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <div class="btn-group">
    <?php if (!isset($_SESSION['user_id'])): ?>
      <a href="login_user.php" class="btn btn-success">🔐 Login untuk Pinjam</a>
      <a href="register.php" class="btn btn-secondary">📝 Daftar Akun</a>
    <?php else: ?>
      <a href="pinjam.php" class="btn btn-primary">📘 Pinjam Buku</a>
      <a href="logout_user.php" class="btn btn-danger">🚪 Logout</a>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
