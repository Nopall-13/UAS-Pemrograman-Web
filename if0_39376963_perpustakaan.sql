-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql200.byetcluster.com
-- Generation Time: Jul 02, 2025 at 01:02 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39376963_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `alamat`, `no_telp`, `email`) VALUES
(1, 'agus', 'jj', '088', 'rawr0@gmail.com'),
(2, 'Muhammad Agus Septiawan', 'Berbas', '08123322123', 'agus@gmail.com'),
(3, 'Naufal', 'Bontang', '08123434324', 'Naufal@gmail.com'),
(4, 'Ahmad', 'Tj laut', '08123875', 'ahmad@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `id_pengarang` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `tahun_terbit`, `id_kategori`, `id_penerbit`, `id_pengarang`, `stok`) VALUES
(1, 'Pemrograman Web Dasar', 2020, 1, 1, 1, 3),
(2, 'Algoritma dan Pemrograman', 2019, 1, 2, 2, 4),
(3, 'Basis Data Lanjut', 2021, 2, 1, 3, 6),
(4, 'Jaringan Komputer', 2018, 3, 3, 4, 3),
(5, 'Sistem Operasi', 2022, 4, 2, 5, 5),
(6, 'Pemrograman Python', 2021, 1, 4, 2, 5),
(7, 'Struktur Data', 2020, 1, 1, 3, 3),
(8, 'Rekayasa Perangkat Lunak', 2019, 5, 2, 1, 4),
(9, 'Pemrograman Mobile Android', 2023, 1, 3, 4, 5),
(10, 'Desain Antarmuka Pengguna', 2021, 5, 4, 2, 3),
(11, 'Keamanan Informasi', 2020, 6, 2, 5, 4),
(12, 'Big Data dan Data Science', 2022, 2, 1, 3, 5),
(13, 'Artificial Intelligence', 2023, 7, 4, 1, 6),
(14, 'Internet of Things (IoT)', 2022, 3, 3, 2, 2),
(15, 'Cloud Computing', 2021, 6, 1, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id` int(11) NOT NULL,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(1, 1, 7, 1),
(2, 2, 1, 1),
(3, 3, 6, 1),
(4, 4, 7, 1),
(5, 5, 1, 1),
(6, 6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`) VALUES
(1, 'Teknologi'),
(2, 'Pemrograman'),
(3, 'Basis Data'),
(4, 'Jaringan'),
(5, 'Sistem Operasi'),
(6, 'AI'),
(7, 'Cloud Computing');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_anggota`, `id_user`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(1, 1, 4, '2025-07-02', '2025-07-09'),
(2, 2, 4, '2025-07-02', '2025-07-09'),
(3, 3, 4, '2025-07-02', '2025-07-09'),
(4, 4, 4, '2025-07-02', '2025-07-09'),
(5, 4, 4, '2025-07-02', '2025-07-09'),
(6, 3, 4, '2025-07-02', '2025-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(11) NOT NULL,
  `nama_penerbit` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama_penerbit`, `alamat`) VALUES
(1, 'Informatika Bandung', 'Bandung'),
(2, 'Andi Publisher', 'Yogyakarta'),
(3, 'Erlangga', 'Jakarta'),
(4, 'Graha Ilmu', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id` int(11) NOT NULL,
  `nama_pengarang` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id`, `nama_pengarang`) VALUES
(1, 'Budi Santoso'),
(2, 'Agus Kurniawan'),
(3, 'Dian Kurnia'),
(4, 'Siti Aminah'),
(5, 'Rahmat Hidayat');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `tanggal_pengembalian`) VALUES
(1, 1, '2025-07-02'),
(2, 2, '2025-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` enum('admin','umum') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', '$2y$10$8hXlRKjZV5pL4H6IhTbnnOWtwmmpw5oZnZyv9XYmVMrN2Uh1nzcIW', 'Administrator', 'admin'),
(5, 'ahmad@gmail.com', '$2y$10$yHFZs2E7QQgYHv.dyfKe3Ot9m9VmXOnzXZonennOsEOjLUh03Ie0q', 'Ahmad', 'umum'),
(4, 'Naufal@gmail.com', '$2y$10$mCnFbuEcjaVIauNu4FDnPOxjNszl848wFXZD8nLaPfFZKpFavymFC', 'Naufal', 'umum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_pengarang` (`id_pengarang`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengembalian` (`id_pengembalian`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
