-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 09:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_menu2`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(5) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'admin'),
(2, 'kasir'),
(3, 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(5) NOT NULL,
  `menu` varchar(25) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `gambar`, `harga`) VALUES
(2, 'Ayam Goreng Crispy', 'ayamgorengcrispy.jpg', 12000),
(3, 'Nasi Kuning', 'nasikuning.jpg', 15000),
(4, 'Ayam Geprek Jumbo', 'ayamgeprek.jpg', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(5) NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_menu` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pesanan_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `nama`, `id_menu`, `qty`, `total_harga`, `status`, `pesanan_selesai`) VALUES
(7, 'PSN1', 'Raffi', '3', '1', 15000, 'sudah dibayar', '2022-05-13 08:02:03'),
(8, 'PSN2', 'Rafli', '2', '2', 24000, 'sudah dibayar', '2021-05-13 08:02:20'),
(9, 'PSN2', 'Rafli', '3', '1', 15000, 'sudah dibayar', '2021-05-13 08:02:20'),
(11, 'PSN4', 'Qori', '3', '2', 30000, 'sudah dibayar', '2021-05-14 10:13:09'),
(12, 'PSN4', 'Qori', '4', '3', 60000, 'sudah dibayar', '2021-05-14 10:13:09'),
(13, 'PSN5', 'Fira', '2', '5', 60000, 'sudah dibayar', '2022-05-21 03:45:58'),
(14, 'PSN5', 'Fira', '3', '2', 30000, 'sudah dibayar', '2022-05-21 03:45:58'),
(15, 'PSN6', 'Rinda', '2', '2', 24000, 'sudah dibayar', '2021-05-21 03:46:07'),
(16, 'PSN6', 'Rinda', '3', '4', 60000, 'sudah dibayar', '2021-05-21 03:46:07'),
(17, 'PSN6', 'Rinda', '4', '1', 20000, 'sudah dibayar', '2021-05-21 03:46:07'),
(18, 'PSN7', 'Rozak', '2', '1', 12000, 'sudah dibayar', '2023-05-21 03:46:04'),
(19, 'PSN7', 'Rozak', '3', '1', 15000, 'sudah dibayar', '2023-05-21 03:46:04'),
(20, 'PSN7', 'Rozak', '4', '2', 40000, 'sudah dibayar', '2023-05-21 03:46:04'),
(21, 'PSN8', 'Kiko', '2', '4', 48000, 'sudah dibayar', '2022-05-21 03:46:09'),
(22, 'PSN8', 'Kiko', '4', '2', 40000, 'sudah dibayar', '2022-05-21 03:46:09'),
(23, 'PSN9', 'Fika', '2', '1', 12000, 'sudah dibayar', '2021-05-21 03:46:01'),
(24, 'PSN9', 'Fika', '3', '2', 30000, 'sudah dibayar', '2021-05-21 03:46:01'),
(25, 'PSN9', 'Fika', '4', '3', 60000, 'sudah dibayar', '2021-05-21 03:46:01'),
(28, 'PSN10', 'Dodo', '3', '1', 15000, 'sudah dibayar', '2024-05-01 02:58:01'),
(29, 'PSN11', 'farah', '2', '2', 24000, 'sudah dibayar', '2023-12-19 00:41:36'),
(30, 'PSN11', 'farah', '3', '1', 15000, 'belum dibayar', '2023-12-19 00:41:36'),
(31, 'PSN11', 'farah', '4', '2', 40000, 'belum dibayar', '2023-12-19 00:41:36'),
(32, 'PSN12', 'farah', '3', '1', 15000, 'belum dibayar', '0000-00-00 00:00:00'),
(35, 'PSN13', 'putra', '4', '3', 60000, 'belum dibayar', '0000-00-00 00:00:00'),
(36, 'PSN14', 'Ridho', '3', '2', 30000, 'sudah dibayar', '2024-05-25 02:34:20'),
(37, 'PSN14', 'Ridho', '4', '2', 40000, 'sudah dibayar', '2023-05-25 02:34:20'),
(38, 'PSN15', 'Ridho', '2', '2', 24000, 'sudah dibayar', '2023-05-25 02:36:29'),
(42, 'PSN16', 'rakha', '2', '2', 24000, 'sudah dibayar', '2023-05-25 04:06:35'),
(43, 'PSN16', 'rakha', '3', '1', 15000, 'sudah dibayar', '2023-05-25 04:06:35'),
(44, 'PSN16', 'rakha', '8', '1', 50000, 'sudah dibayar', '2023-05-25 04:06:35'),
(45, 'PSN17', 'Putri', '3', '2', 30000, 'sudah dibayar', '2023-06-09 01:10:46'),
(46, 'PSN18', 'dodo', '3', '1', 15000, 'belum dibayar', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_level` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `id_level`) VALUES
(1, 'fikri', 'fikrikasir', 'fikrikasir', 2),
(2, 'Rakha', 'rakhakasir', 'rakhakasir', 2),
(3, 'Fatur', 'faturadmin', 'faturadmin', 1),
(4, 'Rafli', 'raflikasir', 'raflikasir', 2),
(5, 'Bambang', 'bambangowner', 'bambangowner', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_level_2` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
