-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 08:42 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_isejahtera`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `kode_jenis` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_jenis`, `nama_barang`, `unit`, `created_at`, `updated_at`) VALUES
('BRG0000001', 'JNS0000001', 'MO65', 'PCS', '2017-09-24', '2017-09-25'),
('BRG0000002', 'JNS0000002', 'Cat Yellow', 'PCS', '2017-09-24', '2017-09-25'),
('BRG0000003', 'JNS0000003', 'Cannon', 'DUS', '2017-09-25', NULL),
('BRG0000004', 'JNS0000003', 'XP', 'DUS', '2017-09-26', '2017-10-02'),
('BRG0000005', 'JNS0000001', 'SM52', 'DUS', '2017-10-02', '2017-10-02'),
('BRG0000006', 'JNS0000004', 'A3+', 'DUS', '2017-10-11', '2017-10-11'),
('BRG0000007', 'JNS0000004', 'HVS', 'PCS', '2017-10-22', NULL),
('BRG0000008', 'JNS0000001', 'GTO52', 'DUS', '2017-12-04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `trans_keluar` varchar(10) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `jumlah_keluar` int(4) DEFAULT NULL,
  `jumlah_reject` int(4) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`trans_keluar`, `kode_barang`, `jumlah_keluar`, `jumlah_reject`, `tanggal_keluar`, `created_at`, `updated_at`) VALUES
('TRK0000001', 'BRG0000001', 2, 1, '2017-10-03', '2017-10-03', NULL),
('TRK0000002', 'BRG0000003', 4, 2, '2017-10-03', '2017-10-03', '2017-10-03'),
('TRK0000003', 'BRG0000001', 6, 2, '2017-11-29', '2017-11-29', '2017-12-04'),
('TRK0000004', 'BRG0000006', 5, 3, '2017-12-03', '2017-12-03', NULL),
('TRK0000005', 'BRG0000001', 10, 4, '2017-12-04', '2017-12-04', NULL),
('TRK0000006', 'BRG0000007', 3, 1, '2017-12-09', '2017-12-09', NULL),
('TRK0000007', 'BRG0000004', 21, 6, '2017-12-10', '2017-12-10', NULL),
('TRK0000008', 'BRG0000004', 15, 5, '2017-12-10', '2017-12-10', NULL),
('TRK0000009', 'BRG0000004', 10, 5, '2017-12-10', '2017-12-10', '2017-12-10'),
('TRK0000010', 'BRG0000007', 5, 5, '2017-12-10', '2017-12-10', '2017-12-10'),
('TRK0000011', 'BRG0000007', 15, 2, '2017-12-10', '2017-12-10', '2017-12-10'),
('TRK0000012', 'BRG0000007', 5, 5, '2017-12-17', '2017-12-17', '2017-12-17'),
('TRK0000013', 'BRG0000005', 20, 5, '2017-12-17', '2017-12-17', NULL),
('TRK0000014', 'BRG0000005', 15, 5, '2017-12-17', '2017-12-17', NULL),
('TRK0000015', 'BRG0000005', 15, 5, '2017-12-17', '2017-12-17', NULL);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `transaksi_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW UPDATE gudang SET stok = stok - (new.jumlah_keluar + new.jumlah_reject)
WHERE kode_barang = new.kode_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_keluar` AFTER UPDATE ON `barang_keluar` FOR EACH ROW UPDATE gudang SET stok = stok - new.jumlah_keluar
WHERE kode_barang = new.kode_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `trans_masuk` varchar(10) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `kode_supplier` varchar(10) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah_masuk` int(3) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`trans_masuk`, `kode_barang`, `kode_supplier`, `tanggal_masuk`, `jumlah_masuk`, `created_at`, `updated_at`) VALUES
('TRM0000001', 'BRG0000001', NULL, '2017-09-26', 20, '2017-09-26', NULL),
('TRM0000002', 'BRG0000002', NULL, '2017-09-27', 2, '2017-09-19', '2017-09-27'),
('TRM0000003', 'BRG0000005', NULL, '2017-10-02', 3, '2017-10-02', '2017-10-02'),
('TRM0000004', 'BRG0000003', NULL, '2017-10-03', 15, '2017-10-03', NULL),
('TRM0000005', 'BRG0000006', NULL, '2017-10-24', 3, '2017-10-24', NULL),
('TRM0000006', 'BRG0000006', NULL, '2017-10-24', 4, '2017-10-24', NULL),
('TRM0000007', 'BRG0000006', NULL, '2017-11-29', 20, '2017-11-29', NULL),
('TRM0000008', 'BRG0000006', NULL, '2017-12-03', 20, '2017-12-03', NULL),
('TRM0000009', 'BRG0000002', NULL, '2017-12-03', 7, '2017-12-03', NULL),
('TRM0000010', 'BRG0000001', NULL, '2017-12-04', 100, '2017-12-04', NULL),
('TRM0000011', 'BRG0000007', NULL, '2017-12-12', 21, '2017-12-09', NULL),
('TRM0000012', 'BRG0000007', NULL, '2017-12-09', 3, '2017-12-09', NULL),
('TRM0000013', 'BRG0000007', NULL, '2017-12-10', 15, '2017-12-10', NULL),
('TRM0000014', 'BRG0000005', NULL, '2017-12-17', 25, '2017-12-17', NULL),
('TRM0000015', 'BRG0000005', NULL, '2017-12-17', 20, '2017-12-17', NULL);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `transaksi_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW UPDATE gudang SET stok = stok + new.jumlah_masuk
WHERE kode_barang = new.kode_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_masuk`
--

CREATE TABLE `detail_masuk` (
  `id_detail` int(11) NOT NULL,
  `trans_masuk` varchar(10) DEFAULT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `unit` varchar(4) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` int(4) DEFAULT NULL,
  `sub_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_masuk`
--

INSERT INTO `detail_masuk` (`id_detail`, `trans_masuk`, `kode_barang`, `unit`, `harga`, `jumlah`, `sub_total`) VALUES
(1, 'TRM0000003', 'BRG0000001', 'PCS', 20000, 1, 20000),
(2, 'TRM0000003', 'BRG0000002', 'DUS', 30000, 1, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `kode_barang`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'BRG0000001', 95, '2017-09-25', '2017-09-26'),
(2, 'BRG0000002', 20, '2017-09-26', NULL),
(5, 'BRG0000003', 21, '2017-09-26', '2017-12-10'),
(6, 'BRG0000006', 55, '2017-10-24', NULL),
(7, 'BRG0000004', 45, '2017-12-04', '2017-12-10'),
(8, 'BRG0000005', 80, '2017-12-04', '2017-12-17'),
(9, 'BRG0000007', 25, '2017-12-04', '2017-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `kode_jenis` varchar(10) NOT NULL,
  `nama_jenis` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kode_jenis`, `nama_jenis`, `created_at`, `updated_at`) VALUES
('JNS0000001', 'Plat', '2017-09-24', NULL),
('JNS0000002', 'Cat', '2017-09-23', '2017-09-25'),
('JNS0000003', 'Printer', '2017-09-25', '2017-09-25'),
('JNS0000004', 'Kertas', '2017-10-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(75) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
('SPL0000001', 'PT. APF Channel', '085781476040', 'Papan Mas, Tambun Selatan', '2017-10-02', NULL),
('SPL0000002', 'PT. Sosro Indonesia', '021876574524', 'Indoporlen, Bekasi Timur', '2017-10-02', NULL),
('SPL0000003', 'PT. Coca Cola Amatil Indonesia', '087810218732', 'Karawang, Cibitung Utara', '2017-10-02', '2017-10-02'),
('SPL0000004', 'CV Pardana Bisa', '085781476040', 'Papan Mas', '2017-12-03', '2017-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`trans_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`trans_masuk`);

--
-- Indexes for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
