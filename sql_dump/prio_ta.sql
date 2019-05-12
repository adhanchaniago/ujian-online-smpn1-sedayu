-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 08:41 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prio_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama`, `alamat`, `no_telp`, `email`) VALUES
(1, 'admin', 'Super Admin', 'Jogja', '08123456789', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `grup_soal`
--

CREATE TABLE `grup_soal` (
  `id_grup_soal` int(11) NOT NULL,
  `nama_grup_soal` varchar(30) DEFAULT NULL,
  `id_pelajaran` int(11) DEFAULT NULL,
  `metode_acak` enum('LCG','SQL RANDOM') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup_soal`
--

INSERT INTO `grup_soal` (`id_grup_soal`, `nama_grup_soal`, `id_pelajaran`, `metode_acak`) VALUES
(1, 'Ujian Akhir Semester (UAS)', 3, NULL),
(2, 'Ujian Tengah Semester (UTS)', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` char(20) NOT NULL,
  `username` char(64) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` enum('Islam','Hindu','Budha','Kristen Protestan','Katolik','Kong Hu Cu') DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `username`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `agama`, `no_telp`, `email`, `gambar`, `jk`) VALUES
('1985033020190428', '1985033020190428', 'Guru Satu', 'Jogja', 'Jogja', '2019-05-01', 'Islam', '08123456789', 'gurusatu@gmail.com', 'Default-avatar.jpg', 'L'),
('1985033020190429', '1985033020190429', 'Guru Kepala Lab', 'jogja', 'jogja', '2019-05-01', 'Islam', '08123456789', 'gurukepalalab@gmail.com', 'Default-avatar1.jpg', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujian`
--

CREATE TABLE `hasil_ujian` (
  `id_hasil_ujian` int(11) NOT NULL,
  `id_proses_ujian` int(11) DEFAULT NULL,
  `nilai` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(20) DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `blok`) VALUES
(1, 'Kelas IX', 'N'),
(2, 'Kelas VIII', 'N'),
(3, 'Kelas VII', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `pbm`
--

CREATE TABLE `pbm` (
  `id_pbm` int(11) NOT NULL,
  `tahun_ajaran` char(9) DEFAULT NULL,
  `id_pelajaran` int(11) DEFAULT NULL,
  `nip` char(20) DEFAULT NULL,
  `nis` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pbm`
--

INSERT INTO `pbm` (`id_pbm`, `tahun_ajaran`, `id_pelajaran`, `nip`, `nis`) VALUES
(3, '2019/2020', 3, '1985033020190428', '111235020000120001');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama_pelajaran` varchar(20) DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `id_kelas`, `nama_pelajaran`, `blok`) VALUES
(3, 1, 'Bahasa Indonesia', 'N'),
(4, 1, 'Matematika', 'N'),
(5, 1, 'Bahasa Inggris', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(20) NOT NULL,
  `username` char(64) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `agama` enum('Islam','Hindu','Budha','Kristen Protestan','Katolik','Kong Hu Cu') DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `no_telp`, `email`, `gambar`) VALUES
('111235020000120001', '111235020000120001', 'Siswa Satu', 'jogja', 'Jogja', '2019-05-01', 'L', 'Islam', '08123456789', 'siswasatu@gmail.com', 'Default-avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_grup_soal` int(11) DEFAULT NULL,
  `soal` text,
  `gambar` varchar(50) DEFAULT NULL,
  `a` text,
  `b` text,
  `c` text,
  `d` text,
  `jawaban` enum('A','B','C','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_grup_soal`, `soal`, `gambar`, `a`, `b`, `c`, `d`, `jawaban`) VALUES
(1, 1, 'Perekonomian di dunia terus merosot yang disebabkan resesi di Eropa yang berkepanjangan. Hal ini membawa dampak yang sangat besar bagi perajin di Indonesia karena produknya tidak dapat diekspor bahkan gagal ekspor. Untuk mempertahankan kelangsungan hidup keluarga dan karyawannya banyak perajin kita yang beralih usaha lain.\r\nMakna tersurat paragraf di atas adalah ….', NULL, 'Perekonomian Indonesia merosot sehingga berdampak di perekonomian dunia.', 'Dampak kemerosoton perekonomian dunia, perajin Indonesia beralih usaha lain.', 'Kegagalan mengekspor produk karena perajin tidak mampu bersaing untuk menghasilkan produk unggulan.', ' Eropa menjadi penyebab Indonesia tidak bisa ekspor produk.', 'B'),
(2, 1, 'Dewasa ini kita tidak asing lagi mendengar kata internet. Penggunaan internet berkembang dengan pesat. Sekarang masyarakat dapat dengan mudah mengakses internet di warnet atau melalui laptop dengan modem ataupun wireless-connected bahkan lewat HP. Jumlah pengguna interenet pun akan terus bertaambah.\r\nArti istilah pesat dalam paragraf tersebut adalah ….', NULL, 'Banyak', 'Lambat', 'Cepat', ' Kuat', 'C'),
(3, 1, 'Hidup bermasyarakat perlu saling menghargai. Salah satu bentuk penghargaan adalah pemberian pujian. Membiasakan memberikan pujian berarti belajar hidup saling menghargai. Hal itu akan membuat hidup ini semakin terasa indah.\r\nMakna tersurat paragraf di atas adalah ….', NULL, 'Bentuk penghargaan tidak hanya pemberian pujian tetapi bisa juga dengan   pemberian hadiah.', ' Hidup dengan memberi akan terasa sangat indah.', 'Hidup dalam keanekaragaman harus saling menghargai.', 'Pemberian pujian merupakan salah satu bentuk penghargaan dalam hidup bermasyarakat.', 'D'),
(4, 1, 'Berdasarkan hasil penelitian, satu pohon jika dikonversi ke rupiah bisa menghasilkan oksigen senilai Rp 1.174.000,00 per hari. Tentu pohon-pohon yang ditebang secara asal-asalan akan mempengaruhi ekosistem yang ada. Jika keseimbangan alam terganggu, dampaknya akan sangat dirasakan oleh manusia. Padahal fungsi pohon itu sendiri untuk menyerap air dan menyediakan oksigen secara gratis. Bayangkan saja apabila kila harus membeli oksigen untuk bernafas, berapa biaya yang kita keluarkan?\r\n\r\nArti istilah dikonversi dalam paragraf tersebut adalah ….', NULL, 'Dibentuk', 'Ditukar', 'Digunakan', 'Dihasilkan', 'B'),
(5, 1, 'Bacalah kutipan cerpen berikut!\r\n“Mamaaaaa!!!!” teriak Sasa.\r\n“Ada apa, Sasa? Kok teriak-teriak begitu kayak di hutan saja,” tanya mama.\r\n“Ini nih, Ma. Lihat!! Masak bajunya gak muat, mana besok harus datang ke pesta ulang tahun Reno.”\r\n“Ya sudah, pakai yang lain saja atau mau pakai punya mama?” kata mama sambil tersenyum.\r\nSasa hanya bisa mengernyitkan dahinya dan mendengus kesal.\r\nMakna tersurat dari kutipan cerpen di atas adalah ….', NULL, 'Sasa kesal karena diejek oleh mamanya.', ' Sasa tidak memiliki baju untuk ke pesta ulang tahun Reno.', 'Mama memilihkan baju untuk Sasa.', 'Sasa sedang mempersiapkan baju yang akan dipakai saat pesta ulang tahun Reno.', 'B'),
(6, 1, 'Bacalah kutipan cerpen berikut!\r\nAku bersyukur kepada Tuhan karena dia telah berubah. Aku pun memaafkannya, meskipun sampai saat ini aku belum bertemu dia lagi. Aku berharap suatu hari nanti kami akan menjalin persahabatan lagi.\r\nPenggalan cerpen di atas merupakan bagian ….', NULL, 'Krisis', 'Resolusi', 'Orientasi', 'Komplikasi', 'B'),
(7, 1, 'Bacalah kutipan fabel berikut!\r\nMatahari mulai tenggelam, anak katak yang nakal itu tidak juga pulang. Ibu katak sangat khawatir. Ia kemudian mencari anak katak. Ternyata anak katak masih asyik bermain dengan teman-temannya. Ibu katak mengajak anaknya pulang. Dengan berat hati, katak menyudahi dan mengikuti ibunya pulang.\r\nKata ‘matahari yang mulai tenggelam” tersebut mengandung makna ….', NULL, 'Hari hampir sore', 'Hari hampir pagi', 'Hari hampir malam', 'Hari hampir siang', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(64) NOT NULL,
  `password` char(32) DEFAULT NULL,
  `level` enum('admin','guru','siswa','guru_kep_lab') DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `level`, `blok`) VALUES
('111235020000120001', 'bcd724d15cde8c47650fda962968f102', 'siswa', 'N'),
('1985033020190428', '77e69c137812518e359196bb2f5e9bb9', 'guru', 'N'),
('1985033020190429', '77e69c137812518e359196bb2f5e9bb9', 'guru_kep_lab', 'N'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `grup_soal`
--
ALTER TABLE `grup_soal`
  ADD PRIMARY KEY (`id_grup_soal`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id_hasil_ujian`),
  ADD KEY `id_proses_ujian` (`id_proses_ujian`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pbm`
--
ALTER TABLE `pbm`
  ADD PRIMARY KEY (`id_pbm`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`(32));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grup_soal`
--
ALTER TABLE `grup_soal`
  MODIFY `id_grup_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pbm`
--
ALTER TABLE `pbm`
  MODIFY `id_pbm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
