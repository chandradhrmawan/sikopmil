-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2020 at 03:51 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sikopmil`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_detail_menu`
--

CREATE TABLE IF NOT EXISTS `mst_detail_menu` (
  `id` int(11) NOT NULL,
  `id_menu` varchar(255) DEFAULT NULL,
  `slug_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_detail_menu`
--

INSERT INTO `mst_detail_menu` (`id`, `id_menu`, `slug_url`, `title`, `status`, `icon`) VALUES
(7, '7', 'master/users', 'Users', '2', NULL),
(8, '7', 'master/jabatan', 'Jabatan', '2', NULL),
(10, '7', 'master/role', 'Role', '2', NULL),
(11, '7', 'master/kendaraan', 'Kendaraan', '2', NULL),
(12, '7', 'master/supir', 'Supir', '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_jabatan`
--

CREATE TABLE IF NOT EXISTS `mst_jabatan` (
`id_jabatan` int(255) NOT NULL,
  `nm_jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jabatan`
--

INSERT INTO `mst_jabatan` (`id_jabatan`, `nm_jabatan`) VALUES
(1, 'Admin'),
(2, 'Perwira Tinggi'),
(3, 'Perwira Menengah'),
(4, 'Perwira Pertama'),
(5, 'Perwira Pertama'),
(6, 'Bintara Tinggi'),
(7, 'Bintara'),
(8, 'Tamtama Kepala'),
(9, 'Tamtama');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jenis`
--

CREATE TABLE IF NOT EXISTS `mst_jenis` (
`id_jenis` int(255) NOT NULL,
  `nm_jenis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jenis`
--

INSERT INTO `mst_jenis` (`id_jenis`, `nm_jenis`) VALUES
(1, 'Sedan'),
(2, 'Van'),
(3, 'Truck'),
(4, 'Bus'),
(5, 'Motor');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kendaraan`
--

CREATE TABLE IF NOT EXISTS `mst_kendaraan` (
`id_kendaraan` int(11) NOT NULL,
  `id_jenis` varchar(255) DEFAULT NULL,
  `id_merk` varchar(255) DEFAULT NULL,
  `id_tipe` varchar(255) DEFAULT NULL,
  `no_plat` varchar(255) DEFAULT NULL,
  `no_mesin` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(4000) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `transmisi` varchar(255) DEFAULT NULL,
  `tenaga` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kendaraan`
--

INSERT INTO `mst_kendaraan` (`id_kendaraan`, `id_jenis`, `id_merk`, `id_tipe`, `no_plat`, `no_mesin`, `judul`, `deskripsi`, `model`, `transmisi`, `tenaga`, `status`, `path`) VALUES
(1, '1', '1', '1', 'B1231', '123456789', 'FERRARI F650 SCUDERIA', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'Mobil-City-Car-Murah-Honda.png'),
(2, '1', '2', '2', '12323', '232323', 'LEXUS GX 490I HYBIRD', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'Harga-Toyota-Rush-Kebumen.png'),
(3, '2', '1', '1', '23', '23', 'MERCEDES BENZ E CLASS', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 0, 'exterior_2L_1.png'),
(4, '1', '1', '1', 'B2138129', '7487283728', 'MERCEDES-AMG GT 2018', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'Daihatsu_Terios_L_1.png'),
(5, '1', '1', '1', 'B2138129', '7487283728', 'ACURA ILX 2019', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'yaris_01.png'),
(12, '1', '1', '1', '12311', '21333', 'ACURA ILX 2019', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'agya_01.png'),
(13, '1', '2', '1', '2323', '2323', 'MERCEDES BENZ E CLASS', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, 'color-bronze-mica-metallic.png'),
(14, '1', '2', '1', '1215477', '27272727', 'MERCEDES BENZ E CLASS', 'Duis aute irure reprehender voluptate velit esacium fugiat nula pariatur excepteurd magna aliqua ut enim ad minim veniam quis nostrud Lorem ipsum dolor sit amet con sectetur adipisicing elit sed do eiusmod tempor incididunt lorem ipsum dolor sit amet, con', '2019', 'Auto', '1000 hp', 1, '805286128p.png');

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu`
--

CREATE TABLE IF NOT EXISTS `mst_menu` (
`id` int(11) NOT NULL,
  `slug_url` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `status` int(1) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_menu`
--

INSERT INTO `mst_menu` (`id`, `slug_url`, `title`, `status`, `icon`) VALUES
(7, '#', 'Master', 2, 'fa fa-database'),
(9, 'transaksi/sewa', 'Data Pemesanan', 2, 'fa fa-car'),
(10, 'master/config', 'Startpoint', 2, 'fa fa-map'),
(11, 'transaksi/laporan', 'Laporan', 2, 'fa fa-file'),
(12, 'transaksi/monitoring', 'Monitoring', 2, 'fa fa-desktop'),
(13, 'transaksi/surat_jalan', 'Cetak Surat Jalan', 2, 'fa fa-files-o'),
(14, 'transaksi/service', 'Service Kendaraan', 2, 'fa fa-cog'),
(15, 'transaksi/pengembalian', 'Pengembalian Kendaraan', 2, 'fa fa-cog'),
(16, 'data/clear', 'Clear Data', 2, 'fa fa-trash');

-- --------------------------------------------------------

--
-- Table structure for table `mst_merk`
--

CREATE TABLE IF NOT EXISTS `mst_merk` (
`id_merk` int(255) NOT NULL,
  `nm_merk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_merk`
--

INSERT INTO `mst_merk` (`id_merk`, `nm_merk`) VALUES
(1, 'Toyota'),
(2, 'Avanza'),
(3, 'Xenia'),
(4, 'Honda');

-- --------------------------------------------------------

--
-- Table structure for table `mst_role`
--

CREATE TABLE IF NOT EXISTS `mst_role` (
`id_role` int(255) NOT NULL,
  `nm_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_role`
--

INSERT INTO `mst_role` (`id_role`, `nm_role`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `mst_start_point`
--

CREATE TABLE IF NOT EXISTS `mst_start_point` (
  `id_loc` int(255) NOT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_start_point`
--

INSERT INTO `mst_start_point` (`id_loc`, `lon`, `lat`, `desc`) VALUES
(1, '106.88766003', '-6.11894777', 'Jakarta Special Capital Region, Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `mst_supir`
--

CREATE TABLE IF NOT EXISTS `mst_supir` (
`id_supir` int(255) NOT NULL,
  `nm_supir` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_supir`
--

INSERT INTO `mst_supir` (`id_supir`, `nm_supir`, `nip`, `status`) VALUES
(1, 'Heru', '72817382', NULL),
(2, 'Arman', '83298', NULL),
(3, 'Supriadi', '1029302', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_tipe`
--

CREATE TABLE IF NOT EXISTS `mst_tipe` (
`id_tipe` int(255) NOT NULL,
  `nm_tipe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_tipe`
--

INSERT INTO `mst_tipe` (`id_tipe`, `nm_tipe`) VALUES
(1, 'Coupe'),
(2, 'Hatcback'),
(3, 'Minivan');

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE IF NOT EXISTS `mst_users` (
`id_user` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `id_jabatan` int(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_role` int(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id_user`, `nama`, `username`, `password`, `nip`, `id_jabatan`, `status`, `id_role`, `alamat`) VALUES
(1, 'chandra', 'chandra', 'chandra', '10513309', 1, '1', 1, 'Jakarta'),
(3, 'asdas', 'dasd', NULL, 'asdasd', 2, '0', 1, 'asdasdasd'),
(4, 'asdas', 'dasd', 'asdasd', 'asdasd', 2, '0', 1, 'asdasdasd'),
(5, 'chandra', 'chandra', '202cb962ac59075b964b07152d234b70', '123123', 2, '0', 2, '123123'),
(6, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1231', 3, '1', 1, 'jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `tx_sewa`
--

CREATE TABLE IF NOT EXISTS `tx_sewa` (
`id_sewa` int(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `id_kendaraan` int(255) DEFAULT NULL,
  `tgl_sewa` datetime(6) DEFAULT NULL,
  `tgl_pinjam` datetime(6) DEFAULT NULL,
  `tgl_kembali` datetime(6) DEFAULT NULL,
  `tujuan_perjalanan` varchar(255) DEFAULT NULL,
  `lokasi_tujuan` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `jarak` varchar(255) DEFAULT NULL,
  `status_sewa` int(255) DEFAULT NULL,
  `Id_supir` int(255) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tx_sewa`
--

INSERT INTO `tx_sewa` (`id_sewa`, `id_user`, `id_kendaraan`, `tgl_sewa`, `tgl_pinjam`, `tgl_kembali`, `tujuan_perjalanan`, `lokasi_tujuan`, `lon`, `lat`, `jarak`, `status_sewa`, `Id_supir`, `keterangan`) VALUES
(7, 6, 1, '2020-09-20 17:58:31.000000', '2020-01-09 00:00:00.000000', '0000-00-00 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 3, 0, 'Sudah Penuh'),
(8, 6, 1, '2020-09-20 17:58:48.000000', '2020-01-09 00:00:00.000000', '2020-01-09 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 2, 1, NULL),
(9, 6, 1, '2020-09-20 17:59:32.000000', '2020-01-09 00:00:00.000000', '2020-01-09 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 3, 1, NULL),
(10, 6, 1, '2020-09-20 17:59:47.000000', '2020-01-09 00:00:00.000000', '0000-00-00 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 4, 1, NULL),
(11, 6, 1, '2020-09-20 18:00:11.000000', '2020-01-09 00:00:00.000000', '0000-00-00 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 5, 1, NULL),
(12, 6, 1, '2020-09-20 18:00:54.000000', '2020-02-09 00:00:00.000000', '2020-02-09 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(13, 6, 1, '2020-09-20 18:01:01.000000', '0000-00-00 00:00:00.000000', '2020-02-09 00:00:00.000000', 'Dinas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(14, 6, 1, '2020-09-20 18:02:46.000000', '2020-09-01 00:00:00.000000', '2020-09-30 00:00:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(15, 6, 1, '2020-09-20 18:03:26.000000', '2020-09-01 23:02:00.000000', '2020-09-30 23:02:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(16, 6, 1, '2020-09-20 18:04:04.000000', '2020-09-01 23:02:00.000000', '2020-09-30 23:02:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(17, 6, 1, '2020-09-20 18:06:15.000000', '2020-09-01 23:02:00.000000', '2020-09-30 23:02:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(18, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(19, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(20, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(21, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(22, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 1, 1, NULL),
(23, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 3, 0, 'coba tolak'),
(24, 6, 1, '2020-09-20 18:06:35.000000', '2020-09-01 23:06:00.000000', '2020-09-01 23:06:00.000000', 'DInas', 'Bandung', '107.60495390', '-6.93446940', '84.16 Km', 5, 0, 'Tolak ya'),
(25, 6, 1, '2020-09-25 15:36:38.000000', '2020-09-25 20:36:00.000000', '2020-09-26 20:36:00.000000', 'Perjalnan Dinas', 'Bandung', '107.60507047', '-6.93398334', '84.17 Km', 2, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_detail_menu`
--
ALTER TABLE `mst_detail_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
 ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `mst_jenis`
--
ALTER TABLE `mst_jenis`
 ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
 ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `mst_menu`
--
ALTER TABLE `mst_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_merk`
--
ALTER TABLE `mst_merk`
 ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `mst_role`
--
ALTER TABLE `mst_role`
 ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `mst_start_point`
--
ALTER TABLE `mst_start_point`
 ADD PRIMARY KEY (`id_loc`);

--
-- Indexes for table `mst_supir`
--
ALTER TABLE `mst_supir`
 ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `mst_tipe`
--
ALTER TABLE `mst_tipe`
 ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
 ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tx_sewa`
--
ALTER TABLE `tx_sewa`
 ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_jabatan`
--
ALTER TABLE `mst_jabatan`
MODIFY `id_jabatan` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `mst_jenis`
--
ALTER TABLE `mst_jenis`
MODIFY `id_jenis` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mst_menu`
--
ALTER TABLE `mst_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `mst_merk`
--
ALTER TABLE `mst_merk`
MODIFY `id_merk` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mst_role`
--
ALTER TABLE `mst_role`
MODIFY `id_role` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mst_supir`
--
ALTER TABLE `mst_supir`
MODIFY `id_supir` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mst_tipe`
--
ALTER TABLE `mst_tipe`
MODIFY `id_tipe` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tx_sewa`
--
ALTER TABLE `tx_sewa`
MODIFY `id_sewa` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
