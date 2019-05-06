-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2019 at 08:45 AM
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
  `id_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `agama` varchar(20) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `username`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `agama`, `no_telp`, `email`, `gambar`, `jk`) VALUES
('1985033020190428', '1985033020190428', 'Guru Satu', 'Jogja', 'Jogja', '2019-05-01', 'islam', '08123456789', 'gurusatu@gmail.com', NULL, 'L'),
('1985033020190429', '1985033020190429', 'Guru Kepala Lab', 'jogja', 'jogja', '2019-05-01', 'islam', '08123456789', 'gurukepalalab@gmail.com', NULL, 'L');

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
(1, 'Kelas IX', 'N');

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
  `agama` varchar(20) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `no_telp`, `email`, `gambar`) VALUES
('111235020000120001', '111235020000120001', 'Siswa Satu', 'jogja', 'Jogja', '2019-05-01', 'L', 'islam', '08123456789', 'siswasatu@gmail.com', NULL);

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
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pbm`
--
ALTER TABLE `pbm`
  MODIFY `id_pbm` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
