<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['level'] !== 'admin') {
    echo "⛔ Akses ditolak! Halaman ini hanya untuk admin.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', sans-serif;
        }

        h3 {
            font-weight: 700;
            color: #343a40;
        }

        .menu-box {
            border-radius: 20px;
            padding: 30px 20px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            height: 100%;
            cursor: pointer;
        }

        .menu-box:hover {
            transform: translateY(-6px) scale(1.02);
            background-color: #f1f3f5;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .menu-box h5 {
            font-size: 20px;
            font-weight: 600;
            margin: 10px 0 0;
        }

        .menu-box .icon {
            font-size: 30px;
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            transition: transform 0.3s ease;
        }

        .menu-box:hover .icon {
            transform: rotate(5deg) scale(1.1);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="mb-4 text-center">
        <h3>👋 Selamat datang, <?= $_SESSION['nama_lengkap']; ?></h3>
        <p class="text-muted">Level: <strong><?= ucfirst($_SESSION['level']); ?></strong></p>
    </div>

    <div class="row g-4">
        <?php
        $menu = [
            ['link' => 'buku/', 'icon' => '📚', 'label' => 'Data Buku'],
            ['link' => 'anggota/', 'icon' => '👥', 'label' => 'Data Anggota'],
            ['link' => 'peminjaman/', 'icon' => '🔄', 'label' => 'Peminjaman'],
            ['link' => 'pengembalian/', 'icon' => '🔁', 'label' => 'Pengembalian'],
            ['link' => 'denda/', 'icon' => '💸', 'label' => 'Denda'],
            ['link' => 'tools/ganti_password.php', 'icon' => '🔐', 'label' => 'Ganti Password'],
            ['link' => '../logout.php', 'icon' => '🚪', 'label' => 'Logout', 'color' => 'text-danger']
        ];

        foreach ($menu as $item) {
            $color = $item['color'] ?? 'text-dark';
            echo "
            <div class='col-md-4'>
                <a href='{$item['link']}' class='text-decoration-none {$color}'>
                    <div class='menu-box text-center'>
                        <span class='icon'>{$item['icon']}</span>
                        <h5>{$item['label']}</h5>
                    </div>
                </a>
            </div>";
        }
        ?>
    </div>
</div>
</body>
</html>
