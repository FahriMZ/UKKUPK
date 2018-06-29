-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2018 at 05:50 AM
-- Server version: 10.2.14-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukkupk`
--

-- --------------------------------------------------------

--
-- Table structure for table `asesor`
--

CREATE TABLE `asesor` (
  `id_asesor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asesor`
--

INSERT INTO `asesor` (`id_asesor`, `id_user`, `id_perusahaan`, `nama`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `kontak`, `id_jurusan`) VALUES
(25, 30, 10, 'Yudi Subekti, S.Kom', 'Jl.Pagarsih Gg. Citepus Dalam II No. 23 RT.007/RW.003 Kel.Cibadak, Kec.Astana Anyara Kota Bandung 40241', 'Laki-laki', '1976-02-19', '081220083232', 4),
(26, 31, 11, 'Yus Jayusman, M.T', 'Bandung', 'Laki-laki', '1977-10-08', '-', 4),
(27, 32, 10, 'Fahri Muhamad Zulkarnaen', 'Jalan Cigondewah Kaler RT.01/RW.03 No. 57 Kode pos 40214 Bandung', 'Laki-laki', '2000-08-09', '08992032172', 4);

-- --------------------------------------------------------

--
-- Table structure for table `detail_komponen`
--

CREATE TABLE `detail_komponen` (
  `id_detail_komponen` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `skor_maksimal` int(11) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_komponen`
--

INSERT INTO `detail_komponen` (`id_detail_komponen`, `id_komponen`, `skor_maksimal`, `bobot`) VALUES
(2, 2, 60, 30),
(3, 7, 50, 40),
(4, 8, 20, 10),
(6, 25, 20, 10),
(7, 1, 20, 10),
(9, 64, 10, 10),
(10, 68, 40, 40),
(11, 77, 40, 40),
(12, 88, 5, 5),
(13, 96, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id_detail_penilaian` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `skor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id_detail_penilaian`, `id_penilaian`, `id_komponen`, `skor`) VALUES
(213, 67, 65, 10),
(214, 67, 66, 10),
(215, 67, 67, 10),
(216, 67, 69, 8),
(217, 67, 70, 8),
(218, 67, 71, 8),
(219, 67, 72, 8),
(220, 67, 73, 8),
(221, 67, 74, 8),
(222, 67, 75, 8),
(223, 67, 76, 8),
(224, 67, 78, 10),
(225, 67, 80, 10),
(226, 67, 81, 10),
(227, 67, 82, 10),
(228, 67, 83, 10),
(229, 67, 84, 10),
(230, 67, 85, 10),
(231, 67, 86, 10),
(232, 67, 87, 10),
(233, 67, 89, 9),
(234, 67, 90, 9),
(235, 67, 91, 9),
(236, 67, 92, 9),
(237, 67, 93, 9),
(238, 67, 97, 9);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_asesor`
--

CREATE TABLE `dokumen_asesor` (
  `id_dokumen` int(11) NOT NULL,
  `nama_dokumen` text NOT NULL,
  `tanggal_diupload` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_asesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_asesor`
--

INSERT INTO `dokumen_asesor` (`id_dokumen`, `nama_dokumen`, `tanggal_diupload`, `id_asesor`) VALUES
(28, 'lamaran_bot_1528720451.pdf', '2018-06-11 12:34:11', 27),
(29, 'foto_crop_1528720615.png', '2018-06-11 12:36:55', 27);

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `standar_skor` enum('tidak','7,0 - 7,9','8,0 - 8,9','9,0 - 10') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `id_komponen`, `indikator`, `standar_skor`) VALUES
(1, 3, 'Menginstall software aplikasi sesuai SOP secara mandiri', '9,0 - 10'),
(2, 3, 'Menginstall software aplikasi sesuai SOP dengan bantuan', '8,0 - 8,9'),
(3, 3, 'Menginstall software aplikasi tidak sesuai SOP secara mandiri', '7,0 - 7,9'),
(5, 4, 'Hasil install normal bekerja sesuai SOP', '9,0 - 10'),
(6, 4, 'Hasil install tidak bekerja sesuai SOP dan dapat diperbaiki secara mandiri', '8,0 - 8,9'),
(7, 4, 'Hasil install tidak bekerja sesuai SOP dan diperbaiki dengan bantuan', '7,0 - 7,9'),
(8, 4, 'Hasil install tidak bekerja sesuai SOP dan harus install ulang', 'tidak'),
(9, 6, 'Prosedur dan fungsi dibuat sesuai SOP', '9,0 - 10'),
(10, 6, 'Prosedur dan fungsi dibuat sesuai SOP tetapi ada kesalahan', '8,0 - 8,9'),
(11, 6, 'Prosedur dan fungsi tidak dibuat sesuai SOP', '7,0 - 7,9'),
(12, 6, 'Prosedur dan fungsi tidak dibuat', 'tidak'),
(15, 10, 'Library pemrograman grafik digunakan dan sesuai SOP', '9,0 - 10'),
(16, 10, 'Library pemrograman grafik dapat digunakan tetapi tidak sesuai SOP', '8,0 - 8,9'),
(17, 10, 'Library pemrograman grafik tidak dapat digunakan', '7,0 - 7,9'),
(18, 10, 'Library pemrograman grafik tidak dibuat', 'tidak'),
(19, 16, 'Tabel dibuat dan diisi serta sesuai SOP', '9,0 - 10'),
(20, 16, 'Tabel dibuat dan diisi tetapi tidak sesuai SOP', '8,0 - 8,9'),
(21, 16, 'Tabel dibuat dan akan tetapi tidak diisi', '7,0 - 7,9'),
(22, 16, 'Tabel tidak dibuat', 'tidak'),
(23, 17, 'View dibuat dan diisi serta sesuai SOP', '9,0 - 10'),
(24, 17, 'View dibuat dan diisi ada perbaikan', '8,0 - 8,9'),
(25, 17, 'View dibuat tidak sesuai SOP', '7,0 - 7,9'),
(26, 17, 'View tidak dibuat', 'tidak'),
(27, 3, 'Instalasi tidak sesuai', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(200) NOT NULL,
  `deskripsi_jurusan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `deskripsi_jurusan`) VALUES
(2, 'Multimedia', NULL),
(3, 'Teknik Komputer Jaringan', NULL),
(4, 'Rekayasa Perangkat Lunak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_aktif`
--

CREATE TABLE `jurusan_aktif` (
  `id_jurusan_aktif` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan_aktif`
--

INSERT INTO `jurusan_aktif` (`id_jurusan_aktif`, `id_jurusan`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_jurusan`) VALUES
(11, '12 rpl 1', 4),
(12, '12 MM 1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id_komponen` int(11) NOT NULL,
  `komponen` text NOT NULL,
  `parent_komponen` int(11) DEFAULT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `komponen`, `parent_komponen`, `id_jurusan`) VALUES
(1, 'Persiapan Kerja', NULL, 4),
(2, 'Proses (Sistematika & Cara Kerja)', NULL, 4),
(3, 'Menginstal software sesuai dengan kebutuhan', 1, 4),
(4, 'Mengecek hasil instalasi software', 1, 4),
(5, 'Menerapkan algoritma pemrograman', 2, 4),
(6, 'Menggunakan Prosedur dan Fungsi', 5, 4),
(7, 'Hasil Kerja', NULL, 4),
(8, 'Sikap Kerja', NULL, 4),
(10, 'Menggunakan library pemrograman grafis', 5, 4),
(11, 'Membuat aplikasi basis data menggunakan SQL', 2, 4),
(12, 'Membuat halaman web dinamis/form', 2, 4),
(13, 'Membuat aplikasi desktop', 2, 4),
(14, 'Membuat aplikasi program basis data', 2, 4),
(15, 'Mengintegrasikan sebuah basis data dengan sebuah situs web', 2, 4),
(16, 'Membuat dan mengisi table', 11, 4),
(17, 'Mengoperasikan tabel dan View table', 11, 4),
(18, 'Membuat web menggunakan bahasa pemrograman server side', 12, 4),
(19, 'Menambahkan function pada halaman web dinamis', 12, 4),
(20, 'Membuat aplikasi desktop menggunakan bahasa script pemrograman', 13, 4),
(21, 'Menerapkan konsep pemrograman berorientasi objek', 13, 4),
(22, 'Menggunakan triggers', 14, 4),
(23, 'Menerapkan Administrasi Database Server', 14, 4),
(24, 'Membuat koneksi basis data', 15, 4),
(25, 'Waktu', NULL, 4),
(27, 'Halaman Web', 7, 4),
(28, 'Layout', 27, 4),
(29, 'Link', 27, 4),
(30, 'User interface', 27, 4),
(31, 'Komposisi warna', 27, 4),
(32, 'Aplikasi desktop', 7, 4),
(33, 'Menubar (menu/submenu)', 32, 4),
(35, 'Toolbar (icon bar)', 32, 4),
(36, 'User interface', 32, 4),
(37, 'Database', 7, 4),
(38, 'Tabel', 37, 4),
(39, 'Relation', 37, 4),
(40, 'Query', 37, 4),
(41, 'Report', 7, 4),
(42, 'Keamanan Data', 7, 4),
(43, 'Back up data', 42, 4),
(44, 'Pembatasan akses', 42, 4),
(45, 'Bekerja sesuai kaidah keselamatan kerja', 8, 4),
(46, 'Bekerja sesuai kaidah keselamatan alat dan manusia', 8, 4),
(47, 'Waktu persiapan kerja', 25, 4),
(48, 'Waktu pelaksanaan', 25, 4),
(64, 'Persiapan Kerja', NULL, 2),
(65, 'Menyajikan hasil pembuatan script', 64, 2),
(66, 'Menyajikan hasil pembuatan storyboard', 64, 2),
(67, 'Menyajikan daftar pertanyaan', 64, 2),
(68, 'Proses (Sistematika & Cara Kerja)', NULL, 2),
(69, 'Menyajikan hasil pengambilan gambar bergerak berdasarkan teknik pergerakan kamera', 68, 2),
(70, 'Menyajikan hasil pengambilan gambar bergerak berdasarkan sudut pandang pengambilan gambar', 68, 2),
(71, 'Mengolah tata cahaya untuk pengambilan gambar bergerak', 68, 2),
(72, 'Menyajikan hasil pembuatan teks 3 dimensi', 68, 2),
(73, 'Membuat obyek pada aplikasi animasi 2 dimensi', 68, 2),
(74, 'Menyajikan hasil rekaman audio', 68, 2),
(75, 'Menyajikan hasil efek sebagai penunjang video', 68, 2),
(76, 'Menyajikan hasil pemaketan produksi video', 68, 2),
(77, 'Hasil Kerja', NULL, 2),
(78, 'Dokumen Proposal Penawaran Produk', 77, 2),
(79, 'Produk Film Pendek', 77, 2),
(80, 'Menyajikan hasil pengambilan gambar bergerak berdasarkan teknik pergerakan kamera', 79, 2),
(81, 'Menyajikan hasil pengambilan gambar bergerak berdasarkan sudut pandang pengambilan gambar', 79, 2),
(82, 'Mengolah tata cahaya untuk pengambilan gambar bergerak', 79, 2),
(83, 'Menyajikan hasil pembuatan teks 3 dimensi', 79, 2),
(84, 'Membuat obyek pada aplikasi animasi 2 dimensi', 79, 2),
(85, 'Menyajikan hasil  rekaman audio', 79, 2),
(86, 'Menyajikan hasil efek sebagai penunjang video', 79, 2),
(87, 'Menyajikan hasil pemaketan produksi video', 79, 2),
(88, 'Sikap Kerja', NULL, 2),
(89, 'Kecermatan dalam memilih skala prioritas kerja', 88, 2),
(90, 'Ketelitian dan kehati-hatian dalam mencari dan menerapkan data dan dokumen', 88, 2),
(91, 'Kreatifitas dalam mencari dan menerapkan ide', 88, 2),
(92, 'Kesantunan  menyampaikan informasi dan percaya diri dalam meminta pendapat orang lain dan melaporkan hasil kerja', 88, 2),
(93, 'Responsif dengan kondisi dan tanggung jawab dalam segala pekerjaan', 88, 2),
(96, 'Waktu', NULL, 2),
(97, 'Bisa menyelesaikan pekerjaan sebelum batas waktu yang diberikan', 96, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  `id_peserta` varchar(30) NOT NULL,
  `paket_soal` varchar(10) NOT NULL,
  `tipe_ukk` enum('pra ukk','real ukk') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_asesor`, `id_peserta`, `paket_soal`, `tipe_ukk`) VALUES
(67, 27, '01-111-029-03', '1', 'pra ukk');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `direktur_perusahaan` varchar(200) NOT NULL,
  `tipe_perusahaan` enum('internal','eksternal') NOT NULL DEFAULT 'eksternal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `direktur_perusahaan`, `tipe_perusahaan`) VALUES
(10, 'CV. CIPTA DAYA INFORMATIKA', 'Gedung Berlian Sport & Hall, Lantai 2, Jl. Raya Purwakarta No.251 Ciburuy - Padalarang - Kab. Bandung Barat 40551, Telp . 022-61773775, website : http://www.cdi.co.id, E-mail : info@cdi.co.id', 'Yaya Suharya, S.Kom, M.T', 'internal'),
(11, 'PT. SOLMIT BANGUN INDOENSIA', 'Surapati Core M. 29 Jl. PHH. Mustofa No. 39, Bandung – Telp : +62 22 8724 1411 – Fax : +62 22 87241411', 'DR. Abdurrahman, M.T', 'eksternal'),
(17, 'CV. Termasyur', '-', '-', 'eksternal'),
(18, 'PT. Nandeka', 'dfkdsajl', '-', 'internal'),
(19, 'PT. Sakarea', 'fkadlfjl', '-', 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` varchar(30) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `id_tahun_ajar` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `email`, `kontak`, `id_tahun_ajar`, `id_kelas`) VALUES
('01-111-029-02', 'Wendy Setiawan', 'Jalan Kebonkopi', 'Laki-laki', '2000-12-12', 'wsetiawan135790@gmail.com', '312738917389', 1, 11),
('01-111-029-03', 'Multahada', 'fkjadskjkj', 'Laki-laki', '2000-01-10', 'ds@fexca.cs', '948239084', 1, 12),
('01-111-029-04', 'Zen Mukari', 'Jalan Safari', 'Laki-laki', '2000-12-12', 'efad2@DASCC.S', '2131231', 1, 12),
('02-111-28-4', 'Peserta 3', 'example address…', 'Laki-laki', '1970-01-01', 'p3@example.com', '9328139823', 3, 11),
('02-111-29-3', 'Peserta 2', 'example address…', 'Perempuan', '1970-01-01', 'p2@example.com', '3912839182', 2, 11),
('02-111-30-2', 'Peserta 1', 'example address…', 'Laki-laki', '1970-01-01', 'p1@example.com', '9328139823', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajar`
--

CREATE TABLE `tahun_ajar` (
  `id_tahun_ajar` int(11) NOT NULL,
  `tahun_ajar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajar`
--

INSERT INTO `tahun_ajar` (`id_tahun_ajar`, `tahun_ajar`) VALUES
(1, '2017-2018'),
(2, '2018-2019'),
(3, '2019-2020'),
(4, '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_aktif`
--

CREATE TABLE `tahun_aktif` (
  `id_tahun_aktif` int(11) NOT NULL,
  `id_tahun_ajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_aktif`
--

INSERT INTO `tahun_aktif` (`id_tahun_aktif`, `id_tahun_ajar`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `akses` enum('administrator','asesor') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `akses`, `email`, `remember_token`) VALUES
(28, 'Administrator', '$2y$10$Uqlzr3UFIN.W5FcW7Yjc5O7wyKQE4fcXx86w1Qa05UeL9XIIXKzvK', 'administrator', NULL, '2TaJcj1b9VN4t20K72EYfADh4GnJCBka2i2f9x0Hay4K8bQvZBwJZF0xqymf'),
(30, '19021976-1-CCDI', '$2y$10$x7bUXloW/Vxe8UJoGRAQ3ey4WYDHABjFKkRaPtdKEEpuuN96cH9Qe', 'asesor', 'yudi.subekti.skom@gmail.com', 'VgQfHxnnsCLyBDXjmcm6I4Wykj7afr9wvnZDscgWjqXcRk3hKR7AWIuzKUU5'),
(31, 'eks', '$2y$10$EaAaBNWjHL620buBtBjx6O8VWENDcSqt0U7GWDUuvH8uQYwfKWYk6', 'asesor', 'yusjayusman@gmail.com', '65UJUhRNRVVpGgKEpv4T91GaE9hDZYs9aV5eE2R0OgRfOyKp60OO4TcOF8ff'),
(32, 'fahri', '$2y$10$EaAaBNWjHL620buBtBjx6O8VWENDcSqt0U7GWDUuvH8uQYwfKWYk6', 'asesor', 'mzfahri620@gmail.com', '335zcPeq3CToEjh4l8DganDCDeOhI5SAs6oiYjKlHNc4EWOUo5y3ShQyDhfG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id_asesor`),
  ADD KEY `asesor_ibfk_1` (`id_user`),
  ADD KEY `asesor_ibfk_2` (`id_perusahaan`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `detail_komponen`
--
ALTER TABLE `detail_komponen`
  ADD PRIMARY KEY (`id_detail_komponen`),
  ADD KEY `id_komponen` (`id_komponen`);

--
-- Indexes for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id_detail_penilaian`),
  ADD KEY `detail_penilaian_ibfk_1` (`id_komponen`),
  ADD KEY `detail_penilaian_ibfk_2` (`id_penilaian`);

--
-- Indexes for table `dokumen_asesor`
--
ALTER TABLE `dokumen_asesor`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `dokumen_asesor_ibfk_1` (`id_asesor`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`),
  ADD KEY `id_komponen` (`id_komponen`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `jurusan_aktif`
--
ALTER TABLE `jurusan_aktif`
  ADD PRIMARY KEY (`id_jurusan_aktif`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`),
  ADD KEY `parent_komponen` (`parent_komponen`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `penilaian_ibfk_1` (`id_asesor`),
  ADD KEY `penilaian_ibfk_2` (`id_peserta`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_tahun_ajar` (`id_tahun_ajar`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  ADD PRIMARY KEY (`id_tahun_ajar`);

--
-- Indexes for table `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  ADD PRIMARY KEY (`id_tahun_aktif`),
  ADD KEY `id_tahun_ajar` (`id_tahun_ajar`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asesor`
--
ALTER TABLE `asesor`
  MODIFY `id_asesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_komponen`
--
ALTER TABLE `detail_komponen`
  MODIFY `id_detail_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id_detail_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `dokumen_asesor`
--
ALTER TABLE `dokumen_asesor`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurusan_aktif`
--
ALTER TABLE `jurusan_aktif`
  MODIFY `id_jurusan_aktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  MODIFY `id_tahun_ajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  MODIFY `id_tahun_aktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asesor`
--
ALTER TABLE `asesor`
  ADD CONSTRAINT `asesor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `asesor_ibfk_2` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `asesor_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_komponen`
--
ALTER TABLE `detail_komponen`
  ADD CONSTRAINT `detail_komponen_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`);

--
-- Constraints for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen_asesor`
--
ALTER TABLE `dokumen_asesor`
  ADD CONSTRAINT `dokumen_asesor_ibfk_1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`) ON DELETE CASCADE;

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`);

--
-- Constraints for table `jurusan_aktif`
--
ALTER TABLE `jurusan_aktif`
  ADD CONSTRAINT `jurusan_aktif_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_ibfk_1` FOREIGN KEY (`parent_komponen`) REFERENCES `komponen` (`id_komponen`),
  ADD CONSTRAINT `komponen_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE;

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`),
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  ADD CONSTRAINT `tahun_aktif_ibfk_1` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
