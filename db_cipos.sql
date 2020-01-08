-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 04:39 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barcode` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barcode`, `nama_barang`, `satuan`, `harga_beli`, `stok`, `harga_jual`, `profit`, `image`, `idcabang`) VALUES
(1, 'A0000000001', 'Mie Ayam', 'PCS', 10000, 6, 20000, 10000, 'miayam.jpg', 1),
(2, 'A0000000002', 'Sayur Asem', 'PCS', 4000, 13, 8000, 4000, 'sayur_asem.jpg', 1),
(3, 'A0000000003', 'Martabak', 'PCS', 23000, 8, 35000, 12000, 'martabak.jpg', 1),
(4, 'A0000000004', 'Sate Ayam', 'PCS', 5000, 100, 7000, 2000, 'sate.jpg', 1),
(5, 'A0000000005', 'Indomie Telor', 'PCS', 5000, 1, 10000, 5000, 'indomie.jpg', 1),
(6, 'A0000000006', 'Bakso', 'PCS', 5000, 1, 15000, 10000, 'bakso.jpg', 3),
(7, 'A0000000007', 'tesa', 'BOTOL', 10000, 11, 100000, 90000, 'girl1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `id` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `lokasi_cabang` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = aktif, 2 = nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cabang`
--

INSERT INTO `tb_cabang` (`id`, `nama_cabang`, `lokasi_cabang`, `status`) VALUES
(1, 'Cabang A', 'Jl Raya Bogor', 1),
(3, 'Cabang B', 'Jl Raya Depok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kustomer`
--

CREATE TABLE `tb_kustomer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kustomer`
--

INSERT INTO `tb_kustomer` (`id`, `nama`, `alamat`, `hp`, `email`, `idcabang`) VALUES
(1, 'Reza', 'bogor', '08565686568', 'rezachrismardianto@ymail.com', 1),
(2, 'Dewi', 'Bogor', '09894394903', 'dewi@ymail.com', 3),
(3, 'asu', 'asu', '89381203', 'asu@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `nama`, `password`, `level`, `foto`, `idcabang`) VALUES
(4, 'admin', 'Reza Chrismardianto', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'cozyvape.png', 1),
(5, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'abc2.png', 1),
(6, 'tes', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'admin', 'Koala.jpg', 3),
(7, 'owner', 'owner', 'a6973aab24a60123f98bb21261d6f6de', 'owner', 'cozyvape.png', NULL),
(8, 'cabanga', 'cabanga', 'a6973aab24a60123f98bb21261d6f6de', 'kasir', 'boy.png', 1),
(10, 'ownersatu', 'Ownersatu', 'a6973aab24a60123f98bb21261d6f6de', 'owner', 'boy1.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(20) NOT NULL,
  `kode_barcode` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `profit_penjualan` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `status` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `kode_penjualan`, `kode_barcode`, `jumlah`, `subtotal`, `diskon`, `total`, `profit_penjualan`, `tgl_penjualan`, `status`, `id_pelanggan`, `idcabang`) VALUES
(4, '071598643', 'A0000000005', 1, 10000, 0, 10000, 5000, '2019-08-16', 1, NULL, 1),
(5, '491568732', 'A0000000005', 1, 10000, 0, 10000, 5000, '2019-08-16', 1, NULL, 1),
(6, '391748265', 'A0000000005', 1, 10000, 0, 10000, 5000, '2019-08-16', 0, NULL, 1),
(26, '248097651', 'A0000000006', 1, 15000, 0, 15000, 10000, '2019-08-16', 0, NULL, 3);

--
-- Triggers `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `tb_penjualan` FOR EACH ROW begin
update tb_barang set stok = stok-new.jumlah
where kode_barcode = new.kode_barcode;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(255) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `total_diskon` int(11) NOT NULL,
  `total_all` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kembali` int(11) NOT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`id`, `kode_penjualan`, `sub_total`, `total_diskon`, `total_all`, `total_bayar`, `total_kembali`, `idcabang`) VALUES
(1, '071598643', 10000, 0, 10000, 10000, 0, 1),
(2, '491568732', 10000, 0, 10000, 10000, 0, 1),
(3, '391748265', 10000, 0, 10000, 10000, 0, 1),
(4, '248097651', 15000, 0, 15000, 15000, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kustomer`
--
ALTER TABLE `tb_kustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kustomer`
--
ALTER TABLE `tb_kustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
