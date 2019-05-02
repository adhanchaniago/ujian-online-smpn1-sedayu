-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2019 at 11:17 AM
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
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` char(13) NOT NULL,
  `email` varchar(20) NOT NULL,
  `blok` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `det_pelajaran`
--

CREATE TABLE `det_pelajaran` (
  `id_det_pelajaran` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `blok` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `formula_lcg`
--

CREATE TABLE `formula_lcg` (
  `id_formula_lcg` int(11) NOT NULL,
  `formula_name` varchar(20) DEFAULT NULL,
  `a` int(2) DEFAULT NULL,
  `b` int(2) DEFAULT NULL,
  `m` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_guru` int(11) NOT NULL,
  `nip` char(12) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `alamat` text,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `posisi` varchar(20) DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id_jadwal_ujian` int(11) NOT NULL,
  `nama_jadwal_ujian` varchar(20) DEFAULT NULL,
  `id_det_pelajaran` int(11) DEFAULT NULL,
  `id_tahun_ajaran` int(11) DEFAULT NULL,
  `semester` enum('Semester Ganjil','Semester Genap') DEFAULT NULL,
  `id_formula_lcg` int(11) DEFAULT NULL,
  `id_grup_soal` int(11) DEFAULT NULL,
  `tgl_ujian` date DEFAULT NULL,
  `jam_ujian` time DEFAULT NULL,
  `waktu_ujian` int(3) DEFAULT NULL,
  `enrol_key` varchar(20) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_pelajaran` varchar(20) DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_ujian`
--

CREATE TABLE `pendaftaran_ujian` (
  `id_pendaftaran_ujian` int(11) NOT NULL,
  `id_jadwal_ujian` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proses_ujian`
--

CREATE TABLE `proses_ujian` (
  `id_proses_ujian` int(11) NOT NULL,
  `id_pendaftaran_ujian` int(11) DEFAULT NULL,
  `jawaban_salah` char(10) DEFAULT NULL,
  `jawaban_benar` char(10) DEFAULT NULL,
  `tidak_menjawab` char(10) DEFAULT NULL,
  `jumlah_soal` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` char(20) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `alamat` text,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `nama_bpk` varchar(20) DEFAULT NULL,
  `nama_ibu` varchar(20) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `blok` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `thun_ajaran`
--

CREATE TABLE `thun_ajaran` (
  `id_thun_ajaran` int(11) NOT NULL,
  `thun_ajaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formula_lcg`
--
ALTER TABLE `formula_lcg`
  ADD PRIMARY KEY (`id_formula_lcg`);

--
-- Indexes for table `grup_soal`
--
ALTER TABLE `grup_soal`
  ADD PRIMARY KEY (`id_grup_soal`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id_hasil_ujian`),
  ADD KEY `id_proses_ujian` (`id_proses_ujian`);

--
-- Indexes for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id_jadwal_ujian`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `pendaftaran_ujian`
--
ALTER TABLE `pendaftaran_ujian`
  ADD PRIMARY KEY (`id_pendaftaran_ujian`);

--
-- Indexes for table `proses_ujian`
--
ALTER TABLE `proses_ujian`
  ADD PRIMARY KEY (`id_proses_ujian`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `thun_ajaran`
--
ALTER TABLE `thun_ajaran`
  ADD PRIMARY KEY (`id_thun_ajaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
