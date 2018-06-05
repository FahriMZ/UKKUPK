-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2018 at 05:40 AM
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
  `kontak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asesor`
--

INSERT INTO `asesor` (`id_asesor`, `id_user`, `id_perusahaan`, `nama`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `kontak`) VALUES
(25, 30, 10, 'Yudi Subekti, S.Kom', 'Jl.Pagarsih Gg. Citepus Dalam II No. 23 RT.007/RW.003 Kel.Cibadak, Kec.Astana Anyara Kota Bandung 40241', 'Laki-laki', '1976-02-19', '081220083232'),
(26, 31, 11, 'Yus Jayusman, M.T', 'Bandung', 'Laki-laki', '1977-10-08', '-'),
(27, 32, 10, 'Fahri Muhamad Zulkarnaen', 'Jalan Cigondewah Kaler RT.01/RW.03 No. 57 Kode pos 40214 Bandung', 'Laki-laki', '2000-08-09', '08992032172'),
(28, 33, 11, 'Penguji Internal', 'fjdalksdjfklj', 'Laki-laki', '0329-09-20', '39840382');

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
(7, 1, 20, 10);

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
(1422, 53, 3, 9),
(1423, 53, 4, 9),
(1424, 53, 6, 0),
(1425, 53, 10, 0),
(1426, 53, 16, 0),
(1427, 53, 17, 0),
(1428, 53, 18, 0),
(1429, 53, 19, 0),
(1430, 53, 20, 0),
(1431, 53, 21, 0),
(1432, 53, 22, 0),
(1433, 53, 23, 0),
(1434, 53, 24, 0),
(1435, 53, 28, 0),
(1436, 53, 29, 0),
(1437, 53, 30, 0),
(1438, 53, 31, 0),
(1439, 53, 33, 0),
(1440, 53, 35, 0),
(1441, 53, 36, 0),
(1442, 53, 38, 0),
(1443, 53, 39, 0),
(1444, 53, 40, 0),
(1445, 53, 41, 0),
(1446, 53, 43, 0),
(1447, 53, 44, 0),
(1448, 53, 45, 0),
(1449, 53, 46, 0),
(1450, 53, 47, 0),
(1451, 53, 48, 0),
(1482, 55, 3, 10),
(1483, 55, 4, 9),
(1484, 55, 6, 9),
(1485, 55, 10, 9),
(1486, 55, 16, 9),
(1487, 55, 17, 9),
(1488, 55, 18, 9),
(1489, 55, 19, 9),
(1490, 55, 20, 9),
(1491, 55, 21, 9),
(1492, 55, 22, 9),
(1493, 55, 23, 9),
(1494, 55, 24, 9),
(1495, 55, 28, 9),
(1496, 55, 29, 9),
(1497, 55, 30, 9),
(1498, 55, 31, 9),
(1499, 55, 33, 9),
(1500, 55, 35, 9),
(1501, 55, 36, 9),
(1502, 55, 38, 9),
(1503, 55, 39, 9),
(1504, 55, 40, 9),
(1505, 55, 41, 9),
(1506, 55, 43, 9),
(1507, 55, 44, 9),
(1508, 55, 45, 9),
(1509, 55, 46, 9),
(1510, 55, 47, 9),
(1511, 55, 48, 9),
(1512, 56, 3, 8),
(1513, 56, 4, 8),
(1514, 56, 6, 8),
(1515, 56, 10, 8),
(1516, 56, 16, 8),
(1517, 56, 17, 8),
(1518, 56, 18, 8),
(1519, 56, 19, 8),
(1520, 56, 20, 8),
(1521, 56, 21, 8),
(1522, 56, 22, 8),
(1523, 56, 23, 8),
(1524, 56, 24, 8),
(1525, 56, 28, 8),
(1526, 56, 29, 8),
(1527, 56, 30, 8),
(1528, 56, 31, 8),
(1529, 56, 33, 8),
(1530, 56, 35, 8),
(1531, 56, 36, 8),
(1532, 56, 38, 8),
(1533, 56, 39, 8),
(1534, 56, 40, 8),
(1535, 56, 41, 8),
(1536, 56, 43, 8),
(1537, 56, 44, 8),
(1538, 56, 45, 8),
(1539, 56, 46, 8),
(1540, 56, 47, 8),
(1541, 56, 48, 8);

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
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id_komponen` int(11) NOT NULL,
  `komponen` text NOT NULL,
  `parent_komponen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `komponen`, `parent_komponen`) VALUES
(1, 'Persiapan Kerja', NULL),
(2, 'Proses (Sistematika & Cara Kerja)', NULL),
(3, 'Menginstal software sesuai dengan kebutuhan', 1),
(4, 'Mengecek hasil instalasi software', 1),
(5, 'Menerapkan algoritma pemrograman', 2),
(6, 'Menggunakan Prosedur dan Fungsi', 5),
(7, 'Hasil Kerja', NULL),
(8, 'Sikap Kerja', NULL),
(10, 'Menggunakan library pemrograman grafis', 5),
(11, 'Membuat aplikasi basis data menggunakan SQL', 2),
(12, 'Membuat halaman web dinamis/form', 2),
(13, 'Membuat aplikasi desktop', 2),
(14, 'Membuat aplikasi program basis data', 2),
(15, 'Mengintegrasikan sebuah basis data dengan sebuah situs web', 2),
(16, 'Membuat dan mengisi table', 11),
(17, 'Mengoperasikan tabel dan View table', 11),
(18, 'Membuat web menggunakan bahasa pemrograman server side', 12),
(19, 'Menambahkan function pada halaman web dinamis', 12),
(20, 'Membuat aplikasi desktop menggunakan bahasa script pemrograman', 13),
(21, 'Menerapkan konsep pemrograman berorientasi objek', 13),
(22, 'Menggunakan triggers', 14),
(23, 'Menerapkan Administrasi Database Server', 14),
(24, 'Membuat koneksi basis data', 15),
(25, 'Waktu', NULL),
(27, 'Halaman Web', 7),
(28, 'Layout', 27),
(29, 'Link', 27),
(30, 'User interface', 27),
(31, 'Komposisi warna', 27),
(32, 'Aplikasi desktop', 7),
(33, 'Menubar (menu/submenu)', 32),
(35, 'Toolbar (icon bar)', 32),
(36, 'User interface', 32),
(37, 'Database', 7),
(38, 'Tabel', 37),
(39, 'Relation', 37),
(40, 'Query', 37),
(41, 'Report', 7),
(42, 'Keamanan Data', 7),
(43, 'Back up data', 42),
(44, 'Pembatasan akses', 42),
(45, 'Bekerja sesuai kaidah keselamatan kerja', 8),
(46, 'Bekerja sesuai kaidah keselamatan alat dan manusia', 8),
(47, 'Waktu persiapan kerja', 25),
(48, 'Waktu pelaksanaan', 25);

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
(53, 27, '01-111-001-8', '1', 'pra ukk'),
(55, 26, '01-111-001-8', '1', 'real ukk'),
(56, 27, '01-111-002-7', '1', 'pra ukk');

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
  `id_tahun_ajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `email`, `kontak`, `id_tahun_ajar`) VALUES
('01-111-001-8', 'AFRYDHO RIKKO RAMADHYAN', 'KOMPLEK BUMI PAKUSARAKAN 2 BLOK G1 NO 13 KODE POS 40552 TELP. 081221877776', 'Laki-laki', '1999-12-09', 'rikkoramadhyan9@gmail.com', '081221877776', 1),
('01-111-002-7', 'ANENG AMANAH', 'JALAN HOLIS GANG HAJI HASAN MUGNI KODE POS 40211 TELP. 089632283608', 'Perempuan', '1999-11-01', 'anengamanah08@gmail.com', '089632283608', 1),
('01-111-003-6', 'ARRADEA FATHUSSALAM', 'JALAN RANCABENTANG NO.505 B KODE POS  TELP. 082117532869', 'Laki-laki', '2000-06-19', 'fathussalam12@gmail.com', '082117532869', 1),
('01-111-004-5', 'AYU LESTARI NURJANAH', 'JL. BUNISARI NO 07 KODE POS 40552 TELP. 089634962177', 'Perempuan', '2000-01-30', 'ayulestarinurjanah30@gmail.com', '089634962177', 1),
('01-111-005-4', 'BAGAS MAFTUH', 'TAMAN HOLIS INDAH BLOK KASUR KODE POS 40214 TELP. 089525959556', 'Laki-laki', '2000-08-12', 'maftuhbagas@gmail.com', '089525959556', 1),
('01-111-006-3', 'DELFANY ARCADIA VALESKA', 'KOMP. TAMAN MUTIARA BLOK C3 NO 19 KODE POS 40523 TELP. 081337916093', 'Perempuan', '2000-07-01', 'delfanyarcadia@gmail.com', '081337916093', 1),
('01-111-007-2', 'FACHRUL YUSUF MUBAROQ', 'KP. CITUNJUNG KODE POS 40561 TELP. 089608953572', 'Laki-laki', '1999-09-26', 'fachrulyusuf.mubaroq@gmail.com', '089608953572', 1),
('01-111-008-9', 'FAUZAN MADANI HANAFIA', 'GG.POLISI NO.86/5A KODE POS 40171 TELP. 08882316513', 'Laki-laki', '1999-10-26', 'fauzanmadani7@gmail.com', '08882316513', 1),
('01-111-009-8', 'FITRIANI', 'JALAN TERUSAN SURYANI KODE POS 40211 TELP. 081322050833', 'Perempuan', '1999-01-29', 'fitriani.dewi2515@gmail.com', '081322050833', 1),
('01-111-010-7', 'HEQI FATIHA PUTRI', 'JL.CIHANJUANG BABUT TENGAH KODE POS 40315 TELP. 081910170305', 'Perempuan', '1999-10-09', 'heqifatihaputri@gmail.com', '081910170305', 1),
('01-111-011-6', 'IKHBAL ARCHENO', 'JALAN KEBON JERUK NO.242 RT.03/RW.20 CIBEREUM CIMAHI SELATAN KODE POS 40535 TELP. 081322197912', 'Laki-laki', '2000-10-17', 'ikhbalikhbal17@gmail.com', '0895382322634', 1),
('01-111-012-5', 'IRFAN MARZUKI', 'GRAHA BUKIT RAYA 3 A11/40 RT.02/RW.25, DESA CILAME, KEC. NGAMPRAH, KAB.BANDUNG BARAT TELP. 087777857007', 'Laki-laki', '2000-04-04', 'ragnaboyx@gmail.com', '087777857007', 1),
('01-111-013-4', 'KURNIA UTAMI', 'JL KARANG SARI NO 59 KODE POS 40535 TELP. 089605536379', 'Perempuan', '1999-10-02', 'niautami1999@gmail.com', '089605536379', 1),
('01-111-014-3', 'MUHAMMAD FARID PUTRA RIYADI', 'JALAN RADEN GANDA II NO 60 KODE POS 40175 TELP. 0895335623067', 'Laki-laki', '2000-11-22', 'faridputra2211@gmail.com', '0895335623067', 1),
('01-111-015-2', 'MUHAMMAD RIZKY SETIABUDI', 'KP. SINDANG PALAY KODE POS 40559 TELP. 081394978656', 'Laki-laki', '2000-05-01', 'ikikunaon@gmail.com', '081394978656', 1),
('01-111-016-9', 'MUTIA MAUDYA RAHMAYANTI', 'BLOK PASAR BATUJAJAR NO.26 KODE POS 40561 TELP. 085314974341', 'Perempuan', '2000-06-07', 'mutiamaudyaa7@gmail.com', '085314974341', 1),
('01-111-017-8', 'NAILA PUJI LESTARI', 'JL. H. ALPI NO 144A/80 KODE POS 40212 TELP. 087822401428', 'Perempuan', '2000-05-26', 'nailalestari265@gmail.com', '087822401428', 1),
('01-111-018-7', 'NAUFAL LUTHFIANDA RIFANA PUTRA', 'JALAN BABAKAN CIANJUR KODE POS 40175 TELP. 08995774247', 'Laki-laki', '2001-05-26', 'n.luthfianda@gmail.com', '08995774247', 1),
('01-111-019-6', 'RAMA DANTE TANJAK', 'SARIJADI BLOK 10 NOMOR 118 RT.05/RW.04 KEL.SARIJADI, KEC. SUKASARI, KOTA BANDUNG TELP. 081313997637', 'Laki-laki', '1999-12-13', 'ryuuakiyoshi@gmail.com', '081313997637', 1),
('01-111-020-5', 'RIKY SUBAGJA', 'JALAN REUNGAS KODE POS 40215 TELP. 0895331244689', 'Laki-laki', '1999-08-04', 'rikisubagja247@gmail.com', '0895331244689', 1),
('01-111-021-4', 'RIMA RIZKI MILENIA', 'KP. CIHARASHAS GG.CSSOUND KODE POS 40552 TELP. 082240935647', 'Perempuan', '2000-01-05', 'rizkirima5@gmail.com', '082240935647', 1),
('01-111-022-3', 'RIZKI ALI RAMADAN', 'JALAN. PESANTREN KODE POS 40512 TELP. 089656818986', 'Laki-laki', '1999-12-12', 'aliiirzk@gmail.com', '089656818986', 1),
('01-111-023-2', 'RIZKY MILAN ALPASYA WIJAKSONO', 'JL.SATRIA RAYA KOMPLEKS CIBOLERANG KODE POS 40224 TELP. 085721325704', 'Laki-laki', '1999-12-20', 'rizkymilanalpasya@gmail.com', '085721325704', 1),
('01-111-024-9', 'SOPHIA CLARA AS SHOPA', 'JL.BOJONG SARI (KAPUR) KODE POS 40212 TELP. 082115256938', 'Perempuan', '2000-05-09', 'asshopa95@gmail.com', '082115256938', 1),
('01-111-025-8', 'SUPRIATNA', 'KP. TIPAR TIMUR KODE POS 40553 TELP. 082117247690', 'Laki-laki', '2000-01-17', 'asupri504@gmail.com', '082117247690', 1),
('01-111-026-7', 'WAWAN GUNAWAN', 'JALAN BOJONG RAYA. GANG HAJI SANUSI KODE POS 40212 TELP. 083829943243', 'Laki-laki', '2000-03-04', 'wansgun1141@gmail.com', '083829943243', 1),
('01-111-027-6', 'WISNU AJI PERMANA', 'TAMAN RAHAYU 2 G8 20 KODE POS 40224 TELP. 089630697802', 'Laki-laki', '2000-04-17', 'wisnuapermana1704@gmail.com', '089630697802', 1),
('01-111-028-5', 'YOGA ASMARA SUTRISNO', 'JL.CIBARENGKOK KODE POS 40162 TELP. 089655397003', 'Laki-laki', '2000-05-19', 'Yoga1asmara@gmail.com', '089655397003', 1),
('01-111-029-4', 'ALLI TAUFIK RACHMAN', 'JALAN GEGERKALONG GIRANG NOMOR 71 (KHALIFAH LAUNDRY)  KODE POS 40153 TELP. 089656837298', 'Laki-laki', '1999-10-06', 'allitaufik6@gmail.com', '089656837298', 1),
('01-111-030-3', 'AMALIA NUR OKTAVIANA', 'JALAN SUKAWARNA NO.22 KODE POS 40173 TELP. 0895335611272', 'Perempuan', '2000-10-03', 'amalianuro74@gmail.com', '0895435611272', 1),
('01-111-031-2', 'ANNISA NUR HADIYANTI', 'JALAN CIBUNTU TIMUR  KODE POS 40211 TELP. 082115980568', 'Perempuan', '2000-02-23', 'annisanurhadiyanti@gmail.com', '082115980568', 1),
('01-111-032-9', 'ASEP HUSEN', 'JL. DR. SETIABUDHI NO. 89 RT.03/RW.05 KEL. GEGERKALONG, KEC. SUKASARI BANDUNG 40153 TELP. 081223099852', 'Laki-laki', '1999-10-07', 'asephusen909@gmail.com', '81223099852', 1),
('01-111-033-8', 'DANIEL DWI FORTUNA', 'JL. CIPEDES TENGAH 38 KODE POS 40162 TELP. 0895328248194', 'Laki-laki', '2000-05-26', 'danieldwifortuna48@gmail.com', '0895328248194', 1),
('01-111-034-7', 'DEA FITRI HANDAYANI', 'MARGAASIH JL.JATI INDAH D1/03  KODE POS 40215 TELP. 083829162444', 'Perempuan', '2000-12-16', 'deafitrih16@gmail.com', '083829162444', 1),
('01-111-035-6', 'DEWI NURLELA', 'JALAN PESANTREN 6 KODE POS 40513 TELP. 081802723322', 'Perempuan', '2000-02-01', 'ddewi.nurlela@gmail.com', '081802723322', 1),
('01-111-036-5', 'ELIZTA KRISNAWANTI SETIADI', 'JALAN MENTOR 01 NO.01 KODE POS 40175 TELP. 081224001974', 'Perempuan', '2000-07-27', 'eliztasetiady@gmail.com', '081224001974', 1),
('01-111-037-4', 'FAHRI MUHAMAD ZULKARNAEN', 'JALAN CIGONDEWAH KALER NO 57 KODE POS 40214 TELP. 082215152259', 'Laki-laki', '2000-08-09', 'mzfahri620@gmail.com', '082215152259', 1),
('01-111-038-3', 'FIKI RIEZA MUZHAFFAR', 'KOMP. BUMI PAKUSARAKAN 2 BLOK E1 NO.05 RT.05/RW.23 DESA TANIMULYA, KEC.NGAMPRAK, KAB.BANDUNG BARAT, 40552 TELP. 081394344536', 'Laki-laki', '2000-01-23', 'riezhaffar@gmail.com', '81394344536', 1),
('01-111-039-2', 'GRESYELA PAULINA VALENTINE', 'JALAN TERUSAN PASIRKOJA,GANG MISBAH DALAM  KODE POS 40221 TELP. 081214676281', 'Perempuan', '2000-03-25', 'gresyelapaul@gmail.com', '081214676281', 1),
('01-111-040-9', 'ILHAM FATHUR ROBBANI', 'JALAN RAJAWALI TIMUR GANG MASJID AL - HIKMAH  KODE POS 40183 TELP. 087823972002', 'Laki-laki', '2000-03-25', 'ilhamfathurrobbani@gmail.com', '087823972002', 1),
('01-111-041-8', 'INTAN NURMALASARI', 'JALAN RAYA BATUJAJAR KODE POS 40553 TELP. 085878187425', 'Perempuan', '1999-12-04', 'Intann89.in@gmail.com', '085878187425', 1),
('01-111-042-7', 'KUKUH MANGKU HIDAYATULLAH', 'JLN. RAJAWALI TIMUR, GG.TARUNA, II, NO.26 KODE POS 40182 TELP. 08987757455', 'Laki-laki', '1999-08-02', 'kukuhpelog15@gmail.com', '08987757455', 1),
('01-111-043-6', 'MIRA NOVIANTI', 'JALAN JAMIKA GG.SITI MARIAH1 KODE POS 40231 TELP. 0895373616398', 'Perempuan', '2000-11-19', 'Miranovianti024@gmail.com', '0895373616398', 1),
('01-111-044-5', 'MUHAMAD IQBAL FARHAN MAULANA', 'JALAN CIGONDEWAH KALER NO 30 KODE POS 40214 TELP. 0895411757441', 'Laki-laki', '2000-02-07', 'Mifm36pisan@gmail.com', '0895411757441', 1),
('01-111-045-4', 'MUHAMMAD SYAIFUL MAHIALHAKIM', 'JL. GUNUNG BATU NO.58 KODE POS 40175 TELP. 085215311486', 'Laki-laki', '2000-05-28', 'family.syaiful007@gmail.com', '085215311486', 1),
('01-111-046-3', 'NICHOLAS BENYAMIN', 'JALAN MALEBER UTARA GANG BAKTI 2NO 100 KODE POS 40184 TELP. 082140908880', 'Laki-laki', '1998-02-25', 'nikolasbenyamin888@gmail.com', '082140908880', 1),
('01-111-047-2', 'NISA RAHMA SARI', 'JALAN TEGAL KAWUNG CLUSTER NO 1  KODE POS 40511 TELP. 082118456009', 'Perempuan', '2000-04-18', 'nisarahmasari00@gmail.com', '082118456009', 1),
('01-111-048-9', 'RD. FITRIANY NUR HAQ SANIAH NATAPRAJA', 'JALAN IBU SANGKI GG.SETIAMANAH KODE POS 40531 TELP. 0+62895636925696', 'Perempuan', '1999-09-30', 'Nataprajaradenfitriany@gmail.com', '0895636925696', 1),
('01-111-049-8', 'REGHAN HAQI MAULANA', 'JL INDUSTRI BARAT KODE POS 40174 TELP. 089609947724', 'Laki-laki', '2000-06-29', 'Maulanareghan290@gmail.com', '089609947724', 1),
('01-111-050-7', 'RIVALDI ALFIANSYAH', 'JALAN MALEBER UTARA GANG TUNDUNG SARI NO 30 KODE POS  TELP. 083820671648', 'Laki-laki', '2000-04-09', 'cos.aldi007@gmail.com', '083820671648', 1),
('01-111-051-6', 'RIZKI FEBRIANSYAH', 'JL. AKSAN NO.07  KODE POS 40221 TELP. 089666031593', 'Laki-laki', '2000-02-29', 'juniordua14@gmail.com', '089666031593', 1),
('01-111-052-5', 'ROIS MUZAQI', 'DS. CIPATIK KP. CANGKUANG JL. SITUWANGI KODE POS 40767 TELP. 081224305474', 'Laki-laki', '2000-04-22', 'rmuzaqi22@gmail.com', '081224305474', 1),
('01-111-053-4', 'TEDDY GUNAWAN', 'JALAN BABAKAN CIBEUREUM NO 63  KODE POS 40184 TELP. 087824580241', 'Laki-laki', '2000-04-17', 'teddygunawan2410@gmail.com', '087824580241', 1),
('01-111-054-3', 'VERA DWI FAJRIANI', 'JL.KERKOF RT 11/09 LEUWI GAJAH, KIHAPIT BARAT, CIMAHI SELATAN KODE POS 30352 TELP. 081384046621', 'Perempuan', '2000-02-12', 'veradwifajriani12@gmail.com', '081384046621', 1),
('01-111-055-2', 'WENDY SETIAWAN', 'JALAN KEBON KOPI GANG SALUYU 2 NO.80 KODE POS 40535 TELP. 085703751813', 'Laki-laki', '1999-10-28', 'wsetiawan135790@gmail.com', '085703751813', 1),
('01-111-056-9', 'YANUAR WANDA PUTRA', 'JL. MARGA ASRI VI G. BLOK C/170 KODE POS 40215 TELP. 087825418390', 'Laki-laki', '2001-01-18', 'yanuar.wanda2@gmail.com', '087825418390', 1),
('01-111-057-8', 'YUSUF ABDUL ROZZAQ', 'JL.ANDIR GG.AHMAD NO.4CA/78 KODE POS 40182 TELP. 087746533867', 'Laki-laki', '2000-10-18', 'usuv.official@gmail.com', '087746533867', 1),
('01-111-058-7', 'ADRI ARIYULIANTI', 'BANTAT GEDANG NO.46 KODE POS 40552 TELP. 083812156035', 'Perempuan', '2000-07-13', 'adri.ariyulianti20@gmail.com', '083812156035', 1),
('01-111-059-6', 'ARDI NAUFAN HADIAN', 'JALAN PANDU DALAM NO 40 KODE POS 40173 TELP. 089690220329', 'Laki-laki', '2000-06-11', 'ardinaufanhadian@gmail.com', '089690220329', 1),
('01-111-060-5', 'ASRI FITRIA HANDAYANI', 'KP. CIBOGO LAMPING KODE POS 40216 TELP. 08986473994', 'Perempuan', '2000-01-04', 'asrifitriah@gmail.com', '08986473994', 1),
('01-111-061-4', 'ASSAR TAUFIK HIDAYAT', 'JALAN PALEDANG  KODE POS 40184 TELP. 0895339648075', 'Laki-laki', '2000-07-21', 'Akunm260@gmail.com ', '0895339648075', 1),
('01-111-062-3', 'DEBORA OKTAVIANE TAKAHOPEKANG', 'JL. K. H. USMAN DHOMIRI NO. 166 KODE POS  TELP. 081319882879', 'Perempuan', '2000-10-01', 'Deboraoktavianet@gmail.com', '081319882879', 1),
('01-111-063-2', 'DINI MULYANI', 'CIJERAH, GG MANUNGGAL 2C KODE POS 40213 TELP. 085624073854', 'Perempuan', '2000-06-18', 'Dinim179@gmail.com', '085624073854', 1),
('01-111-064-9', 'EGI SAPUTRA', 'KP. SINDANG SARI KODE POS 40553 TELP. 085722691393', 'Laki-laki', '2000-02-08', 'iniegi08@gmail.com', '085722691393', 1),
('01-111-065-8', 'FATHONA AJI', 'JL BABAKAN CIBEUREUM KODE POS 40184 TELP. 0895338584737', 'Laki-laki', '2000-05-03', 'fathona21@gmail.com', '0895338584737', 1),
('01-111-066-7', 'FIRDHA NUR ALIFIA', 'BENTANG PADALARANG REGENCY A 7 NO 5 KODE POS 40553 TELP. 082240317525', 'Perempuan', '2000-07-01', 'firdhana01@gmail.com', '082240317525', 1),
('01-111-067-6', 'HANDAYANI JOLISSETIAWATI', 'JL SADARMANAH GG PASANTREN 1 LEUWIGAJAH  KODE POS 40532 TELP. 089656822871', 'Perempuan', '2000-03-20', 'eki.tiana24@gmail.com', '089656822871', 1),
('01-111-068-5', 'HERU HERDIANSYAH', 'JALAN PALEDANG NO. 379 KODE POS 40184 TELP. 083822303711', 'Laki-laki', '2000-11-05', 'heruherdiansyah21@gmail.com', '083822303711', 1),
('01-111-069-4', 'INSAN MUKHLISIN', 'JL.SOEKARNO HATTA, BBK CIPARAY BLOK AGER SARI KODE POS 40222 TELP. 082240256716', 'Laki-laki', '2000-09-03', 'Insanmukhlisin0@gmail.com', '082240256716', 1),
('01-111-070-3', 'JEANNIE ARDYA KAMILA MARBUN', 'BLOK WARUNGPULUS NO. 471 KODE POS 40561 TELP. 081222871941', 'Perempuan', '2001-01-16', 'Jeannieakm@gmail.com', '081222871941', 1),
('01-111-071-2', 'MALIK WALI', 'JL.RH.ABDUL HALIM NO.55/63 KODE POS 40522 TELP. 0895610411042', 'Laki-laki', '2000-01-20', 'malikxleep@gmail.com', '0895610411042', 1),
('01-111-072-9', 'MUGIA NURUL MATIN', 'JL. CIGONDEWAH KIDUL NO. 13 KODE POS 40214 TELP. 083821283351', 'Laki-laki', '2000-06-10', 'seemugia1@gmail.com', '083821283351', 1),
('01-111-073-8', 'MUHAMMAD FARHAN HABIBIE', 'JL. MOCILFATAH NO 30 KODE POS 40184 TELP. 081324440003', 'Laki-laki', '1999-08-31', 'Farhanhabibie10@gmail.com', '081324440003', 1),
('01-111-074-7', 'MUHAMMAD RESTU AZIZI', 'JALAN AKI PADMA NO 10 KODE POS 40222 TELP. 083151201948', 'Laki-laki', '2000-01-16', 'mrazzalone@gmail.com', '083151201948', 1),
('01-111-075-6', 'MUHAMMAD TAUFIK ARIEF PUTRA', 'JL.CIJERAH PAL 3 GG.SUKARAME DEKET LAPANG ANZURA RUMAH PA ARIEF KODE POS 40213 TELP. 087824303673', 'Laki-laki', '1999-11-13', 'arcrief13@gmail.com', '087824303673', 1),
('01-111-076-5', 'RAKA PUTRA PRATAMA', 'JL.BUDHI NO.79  KODE POS 40175 TELP. 089604189027', 'Laki-laki', '1999-10-29', 'rakap3@gmail.com', '089604189027', 1),
('01-111-077-4', 'RIKI AHMAD FADILAH', 'JL CIROYOM NO 79 KODE POS 40125 TELP. 083130322420', 'Laki-laki', '2000-06-07', 'rikiahnad629@gmail.com', '083130322420', 1),
('01-111-078-3', 'RIZKI', 'KP KANCAH  KODE POS 40559 TELP. 089627280986', 'Laki-laki', '1999-12-26', 'rizkiramadhan2625@gmail.com', '089627280986', 1),
('01-111-079-2', 'RIZKY AGESTYAS ATHALLAH', 'JL. CITEPUS 2 KODE POS 40173 TELP. 085724624816', 'Laki-laki', '2000-08-17', 'Agestyasrizky@gmail.com ', '085724624816', 1),
('01-111-080-9', 'SALSHA SYAMI FIRIZKI', 'JALAN RAYA BATUJAJAR, KP. RESMIGALIH KODE POS 40561 TELP. 081320672564', 'Perempuan', '2000-01-04', 'salshasyami8080@gmail.com', '081320672564', 1),
('01-111-081-8', 'SIDIQ NUGRAHA', '\nJL CIMINDI GG HJ ARSAD KODE POS 40535 TELP. 085320669162', 'Laki-laki', '1999-12-03', 'sidiknugraha111@gmail.com ', '085320669162', 1),
('01-111-082-7', 'SYARIF HIDAYATULOH', 'JALAN IBU GANIRAH NOMOR 27 KODE POS 40531 TELP. 089525437290', 'Laki-laki', '2000-11-06', 'syarifhidayatuloh111@gmail.com', '089525437290', 1),
('01-111-083-6', 'TUBAGUS FAJAR NURRACHMAN', 'JL. DUNGUS CARIANG KODE POS 40183 TELP. 082120250610', 'Laki-laki', '2000-07-24', 'Tebewew@gmail.com', '082120250610', 1),
('01-111-084-5', 'VINA INVIA AVIANTI', 'JALAN SAPTA MARGA BLOK E NO. 2 KODE POS 40184 TELP. 0895343549598', 'Perempuan', '1999-11-04', 'pshandksy@gmail.com', '0895343549598', 1),
('01-111-085-4', 'WHISNU MULYA PRATAMA', 'JALAN KOLONEL MASTURI NO.73 KODE POS 40525 TELP. 081321735516', 'Laki-laki', '1999-10-08', 'mulyawhisnu23@gmail.com', '081321735516', 1),
('01-111-086-3', 'YEGAR SAHADUTA WIJAYA', 'JALAN PANEMBAKAN NO:45 KODE POS 40512 TELP. 087881920802', 'Laki-laki', '2000-03-25', 'yegarsw@gmail.com', '087881920802', 1);

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
(28, 'Administrator', '$2y$10$Uqlzr3UFIN.W5FcW7Yjc5O7wyKQE4fcXx86w1Qa05UeL9XIIXKzvK', 'administrator', NULL, 'uTEApRqcOJ77tIuJElZuPBk2gy6Jqv1ZScB5qrKbbtj0LRIgMtKC7GdjQ9YQ'),
(30, '19021976-1-CCDI', '$2y$10$x7bUXloW/Vxe8UJoGRAQ3ey4WYDHABjFKkRaPtdKEEpuuN96cH9Qe', 'asesor', 'yudi.subekti.skom@gmail.com', 'VgQfHxnnsCLyBDXjmcm6I4Wykj7afr9wvnZDscgWjqXcRk3hKR7AWIuzKUU5'),
(31, 'eks', '$2y$10$EaAaBNWjHL620buBtBjx6O8VWENDcSqt0U7GWDUuvH8uQYwfKWYk6', 'asesor', 'yusjayusman@gmail.com', 'wNPP2BVZkYDRTEh6vgUwBscZGowiRlrTIlop0v2muzB2MtLzdnPGs6ZO5RNj'),
(32, 'fahri', '$2y$10$EaAaBNWjHL620buBtBjx6O8VWENDcSqt0U7GWDUuvH8uQYwfKWYk6', 'asesor', 'mzfahri620@gmail.com', 'X5s84gdttzc3YRAMNB4FLRQY4Ig0uJm4UDE8ux04G8SRmrsSntndc3ao8L38'),
(33, '20090329-28-PSBI', '$2y$10$wCUeJubo9eJXfoSXV.luzuiE5/wjb1uydulYFcyrmN2twtFm4dbbq', 'asesor', 'adsf@fdasfcs.ss', 'M2KkZkOtD5ieRPUJ0sBPN5MEBwr9NI7Hwbj0826DvXWNWAFoBhfbBzxffyfC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id_asesor`),
  ADD KEY `asesor_ibfk_1` (`id_user`),
  ADD KEY `asesor_ibfk_2` (`id_perusahaan`);

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
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`),
  ADD KEY `parent_komponen` (`parent_komponen`);

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
  ADD KEY `id_tahun_ajar` (`id_tahun_ajar`);

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
  MODIFY `id_asesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `detail_komponen`
--
ALTER TABLE `detail_komponen`
  MODIFY `id_detail_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id_detail_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1542;

--
-- AUTO_INCREMENT for table `dokumen_asesor`
--
ALTER TABLE `dokumen_asesor`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asesor`
--
ALTER TABLE `asesor`
  ADD CONSTRAINT `asesor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `asesor_ibfk_2` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE;

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
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_ibfk_1` FOREIGN KEY (`parent_komponen`) REFERENCES `komponen` (`id_komponen`);

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
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);

--
-- Constraints for table `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  ADD CONSTRAINT `tahun_aktif_ibfk_1` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
