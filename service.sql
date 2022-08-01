-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 07:39 PM
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
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `antriservice`
--

CREATE TABLE `antriservice` (
  `id_antrian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_antri` date NOT NULL,
  `status` enum('masuk','proses') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antriservice`
--

INSERT INTO `antriservice` (`id_antrian`, `id_pelanggan`, `tanggal_antri`, `status`) VALUES
(1, 1, '0000-00-00', 'proses'),
(2, 1, '2022-05-14', 'proses'),
(3, 1, '2022-05-17', 'proses'),
(4, 1, '2022-05-17', 'proses'),
(5, 1, '2022-05-18', 'proses'),
(6, 12, '2022-05-18', 'proses'),
(7, 12, '2022-05-19', 'proses'),
(8, 12, '2022-05-19', 'proses'),
(9, 13, '2022-05-19', 'proses'),
(10, 12, '2022-05-19', 'proses'),
(11, 12, '2022-05-28', 'masuk'),
(12, 12, '2022-05-28', 'masuk'),
(13, 12, '2022-05-28', 'masuk'),
(14, 12, '2022-05-28', 'masuk'),
(15, 12, '2022-05-28', 'masuk'),
(16, 12, '2022-05-28', 'masuk'),
(17, 12, '2022-05-28', 'masuk'),
(18, 12, '2022-05-28', 'masuk'),
(19, 12, '2022-05-28', 'masuk'),
(20, 12, '2022-05-28', 'masuk'),
(21, 12, '2022-05-28', 'masuk'),
(22, 12, '2022-05-28', 'masuk'),
(23, 12, '2022-05-28', 'masuk'),
(24, 12, '2022-05-28', 'masuk'),
(25, 12, '2022-05-28', 'masuk'),
(26, 12, '2022-05-28', 'masuk'),
(27, 12, '2022-05-28', 'masuk'),
(28, 12, '2022-05-28', 'masuk'),
(29, 12, '2022-05-28', 'masuk'),
(30, 12, '2022-05-28', 'masuk'),
(31, 12, '2022-05-28', 'masuk'),
(32, 12, '2022-05-28', 'masuk'),
(33, 12, '2022-05-28', 'masuk'),
(34, 12, '2022-05-28', 'masuk'),
(35, 12, '2022-05-28', 'masuk'),
(36, 12, '2022-05-28', 'masuk'),
(37, 12, '2022-05-28', 'masuk'),
(38, 12, '2022-05-28', 'masuk'),
(39, 12, '2022-05-28', 'masuk'),
(40, 12, '2022-05-29', 'masuk'),
(41, 12, '2022-05-29', 'masuk'),
(42, 12, '2022-05-29', 'masuk'),
(43, 12, '2022-05-29', 'masuk'),
(44, 12, '2022-05-29', 'masuk'),
(45, 12, '2022-05-29', 'masuk'),
(46, 12, '2022-05-29', 'masuk'),
(47, 12, '2022-05-29', 'masuk'),
(48, 16, '2022-06-13', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `berat` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `stok_barang`, `berat`) VALUES
(1, 'Tinta Printer', 20000, 50, 200),
(3, 'Scanner', 45000, 10, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjangservice`
--

CREATE TABLE `keranjangservice` (
  `id_keranjang` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telpon_pegawai` varchar(15) NOT NULL,
  `alamat_pegawai` text NOT NULL,
  `role` enum('admin','teknisi') NOT NULL,
  `status_pegawai` enum('admin','longgar','kerja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `username`, `password`, `no_telpon_pegawai`, `alamat_pegawai`, `role`, `status_pegawai`) VALUES
(1, 'Hehe Admin', 'test', 'test', '391', 'teknisi', 'admin', 'admin'),
(2, 'Hehe Hehe Hehe', 'teknisi', 'teknisi', '391', 'teknisi', 'teknisi', 'kerja'),
(3, 'maman Recing', 'recing', 'recing', '83109', 'jkanfa', 'teknisi', 'longgar');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telpon_pelanggan` varchar(15) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `no_telpon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'Maman', 'Maman', 'Maman', '8041', 'Pereng'),
(12, 'Ardhi Rahmaan Muhaimin Salam', 'pelanggan', 'pelanggan', '89552421341', 'jambangan, pereng mojogedang,karanganyar'),
(13, 'pelanggan coba', 'coba', 'coba', '48104203', 'jamabangan'),
(16, 'test', 'test', 'test', '6289522983270', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `resi` varchar(20) NOT NULL,
  `ekspedisi` enum('JNT','JNE','SICEPAT','TIKI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal_service` date NOT NULL,
  `status_service` enum('proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `id_pelanggan`, `id_pegawai`, `tanggal_service`, `status_service`) VALUES
(1, 1, 2, '2022-05-11', 'selesai'),
(2, 1, 2, '2022-05-09', 'selesai'),
(3, 1, 3, '2022-05-12', 'selesai'),
(4, 1, 3, '2022-05-04', 'selesai'),
(5, 1, 2, '2022-05-18', 'selesai'),
(6, 1, 2, '2022-05-19', 'selesai'),
(7, 1, 2, '2022-05-19', 'selesai'),
(8, 1, 2, '2022-05-19', 'selesai'),
(9, 12, 2, '2022-05-28', 'selesai'),
(10, 13, 2, '2022-05-29', 'proses'),
(11, 16, 2, '2022-06-13', 'proses'),
(12, 12, 2, '2022-07-30', 'selesai'),
(13, 12, 2, '2022-07-30', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_palanggan` int(11) NOT NULL,
  `kode_transaksi` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antriservice`
--
ALTER TABLE `antriservice`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `keranjangservice`
--
ALTER TABLE `keranjangservice`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pegawain` (`id_pegawai`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_palanggan` (`id_palanggan`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antriservice`
--
ALTER TABLE `antriservice`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjangservice`
--
ALTER TABLE `keranjangservice`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antriservice`
--
ALTER TABLE `antriservice`
  ADD CONSTRAINT `antriservice_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjangservice`
--
ALTER TABLE `keranjangservice`
  ADD CONSTRAINT `keranjangservice_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjangservice_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_pesanan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_palanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
