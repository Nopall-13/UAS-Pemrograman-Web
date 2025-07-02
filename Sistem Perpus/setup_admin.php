<?php
include 'config/koneksi.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$nama = 'Administrator';
$level = 'admin';

mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, level) 
VALUES ('$username', '$password', '$nama', '$level')");
echo "User admin berhasil dibuat.";
