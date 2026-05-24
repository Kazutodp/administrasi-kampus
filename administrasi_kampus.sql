-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2026 at 06:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administrasi_kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NIDN` varchar(15) NOT NULL,
  `Nama_Dosen` varchar(30) NOT NULL,
  `Jurusan` varchar(50) NOT NULL,
  `Jenis_Kelamin` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIDN`, `Nama_Dosen`, `Jurusan`, `Jenis_Kelamin`, `Email`) VALUES
('0812048501', 'Dr. Eng. I Made Sukarta, M.T.', '55201', 'Laki-laki', 'made.sukarta@ac.id'),
('0823088802', 'Rina Wijayanti, M.Kom.', '55301', 'Perempuan', 'rina.wijayanti@ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `Id_Jadwal` varchar(15) NOT NULL,
  `Kode_Matakuliah` varchar(15) NOT NULL,
  `NIDN_Pengampu` varchar(15) NOT NULL,
  `Hari` varchar(20) NOT NULL,
  `Jam` varchar(20) NOT NULL,
  `Ruangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `Id_KRS` varchar(15) NOT NULL,
  `NIM` varchar(15) NOT NULL,
  `Id_Jadwal` varchar(15) NOT NULL,
  `Tahun_Akademik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(15) NOT NULL,
  `Nama_Mahasiswa` varchar(30) NOT NULL,
  `Id_Prodi` varchar(15) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Alamat` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `Nama_Mahasiswa`, `Id_Prodi`, `Jenis_Kelamin`, `Alamat`) VALUES
('5520124001', 'Ahmad Rifai', '55201', 'Laki-laki', 'Jl. Pejanggik No. 45, Mataram'),
('5520124012', 'Siti Aminah', '55301', 'Perempuan', 'Jl. Majapahit No. 12, Ampenan'),
('5520124025', 'Putri Rahmawati', '61201', 'Perempuan', 'Jl. Langko No. 10, Dasan Agung'),
('5720124018', 'Ni Luh Putu Lestari', '23201', 'Perempuan', 'Jl. Bung Karno, Rembiga'),
('6120524007', 'Kevin Sanjaya', '20201', 'Laki-laki', 'Jl. Saleh Sungkar, Meninting');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `Kode_Matakuliah` varchar(15) NOT NULL,
  `Nama_Matakuliah` varchar(30) NOT NULL,
  `SKS` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `Sifat_Matakuliah` varchar(20) DEFAULT NULL,
  `Jenis_Matakuliah` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`Kode_Matakuliah`, `Nama_Matakuliah`, `SKS`, `semester`, `Sifat_Matakuliah`, `Jenis_Matakuliah`) VALUES
('INF406', 'Jaringan Komputer', 3, 4, 'Wajib', 'Teori & Praktikum'),
('INF612', 'Keamanan Jaringan & Penetratio', 3, 7, 'Pilihan', 'Teori & Praktikum'),
('INF615', 'Pengembangan Aplikasi Mobile', 3, 6, 'Pilihan', 'Praktikum');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `Id_Nilai` varchar(15) NOT NULL,
  `Id_KRS` varchar(15) NOT NULL,
  `Nilai_angka` decimal(10,0) NOT NULL,
  `Nilai_Huruf` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `Id_Prodi` varchar(15) NOT NULL,
  `Nama_Prodi` varchar(30) NOT NULL,
  `Fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`Id_Prodi`, `Nama_Prodi`, `Fakultas`) VALUES
('20201', 'Teknik Mesin (S1)', 'Fakultas Teknik'),
('22201', 'Arsitektur (S1)', 'Fakultas Teknik / Desain'),
('23201', 'Teknik Elektro (S1)', 'Fakultas Teknik'),
('55201', 'Teknik Informatika (S1)', 'Fakultas Ilmu Komputer / Teknik'),
('55301', 'Teknologi Informasi (S1)', 'Fakultas Teknologi Informasi'),
('61201', 'Manajemen (S1)', 'Fakultas Ekonomi dan Bisnis'),
('74201', 'Ilmu Hukum (S1)', 'Fakultas Hukum');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id_User` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id_User`, `Username`, `Password`) VALUES
(1, 'admin', '00000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIDN`),
  ADD KEY `Jurusan` (`Jurusan`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`Id_Jadwal`),
  ADD KEY `Kode_Matakuliah` (`Kode_Matakuliah`),
  ADD KEY `NIDN_Pengampu` (`NIDN_Pengampu`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`Id_KRS`) USING BTREE,
  ADD KEY `NIM` (`NIM`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `Id_Prodi` (`Id_Prodi`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`Kode_Matakuliah`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`Id_Nilai`),
  ADD KEY `Id_KRS` (`Id_KRS`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`Id_Prodi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`Jurusan`) REFERENCES `prodi` (`Id_Prodi`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`Kode_Matakuliah`) REFERENCES `matakuliah` (`Kode_Matakuliah`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`NIDN_Pengampu`) REFERENCES `dosen` (`NIDN`);

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`Id_Prodi`) REFERENCES `prodi` (`Id_Prodi`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`Id_KRS`) REFERENCES `krs` (`Id_KRS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
