<?php
$host = "sql200.infinityfree.com";
$user = "if0_39376963";
$pass = "dTBL3G434CAsHS";
$db = "if0_39376963_perpustakaan";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
