-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 10:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpeg_bispar`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_documents`
--

CREATE TABLE `activity_documents` (
  `documentID` int(11) NOT NULL,
  `activityType` enum('Promotion','Retirement') DEFAULT NULL,
  `activityID` int(11) DEFAULT NULL,
  `uploadedBy` varchar(20) DEFAULT NULL,
  `documentNumber` char(2) DEFAULT NULL,
  `documentName` varchar(255) DEFAULT NULL,
  `documentType` varchar(255) DEFAULT NULL,
  `documentPath` varchar(255) DEFAULT NULL,
  `sectionName` varchar(50) DEFAULT NULL,
  `uploadTime` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_documents`
--

INSERT INTO `activity_documents` (`documentID`, `activityType`, `activityID`, `uploadedBy`, `documentNumber`, `documentName`, `documentType`, `documentPath`, `sectionName`, `uploadTime`) VALUES
(108, 'Promotion', 12, '1902', '2', 'Dokumen2', 'Required Documents', '2019-11-08 15-04-06DOKUMEN 2.pdf', NULL, '2019-11-08 15:04:06'),
(109, 'Promotion', 12, '1902', '3', 'Dokumen3', 'Required Documents', '2019-11-08 15-04-06DOKUMEN 3.pdf', NULL, '2019-11-08 15:04:06'),
(110, 'Promotion', 12, '1902', '1', 'Dokumen4', 'Required Documents', '2019-11-08 15-06-33DOKUMEN 4.pdf', NULL, '2019-11-08 15:06:33'),
(111, 'Promotion', 12, '1902', '4', '', 'SK', '2019-11-08 15-08-39DOKUMEN 5.pdf', NULL, '2019-11-08 15:08:39'),
(112, 'Retirement', 18, '1902', '1', 'Dokumen1', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 1.pdf', NULL, '2019-11-08 15:11:05'),
(114, 'Retirement', 18, '1902', '3', 'Dokumen3', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 3.pdf', NULL, '2019-11-08 15:11:05'),
(115, 'Retirement', 18, '1902', '4', 'Dokumen4', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 4.pdf', NULL, '2019-11-08 15:11:05'),
(116, 'Retirement', 18, '1902', '5', 'Dokumen5', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 5.pdf', NULL, '2019-11-08 15:11:05'),
(117, 'Retirement', 18, '1902', '6', 'Dokumen6', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 6.pdf', NULL, '2019-11-08 15:11:05'),
(118, 'Retirement', 18, '1902', '7', 'Dokumen7', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 7.pdf', NULL, '2019-11-08 15:11:05'),
(119, 'Retirement', 18, '1902', '8', 'Dokumen8', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 8.pdf', NULL, '2019-11-08 15:11:05'),
(120, 'Retirement', 18, '1902', '9', 'Dokumen9', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 9.pdf', NULL, '2019-11-08 15:11:05'),
(121, 'Retirement', 18, '1902', '10', 'Dokumen10', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 10.pdf', NULL, '2019-11-08 15:11:05'),
(122, 'Retirement', 18, '1902', '11', 'Dokumen11', 'Required Documents', '2019-11-08 15-11-05DOKUMEN 11.pdf', NULL, '2019-11-08 15:11:05'),
(123, 'Retirement', 18, '1902', '2', 'Dokumen9', 'Required Documents', '2019-11-08 15-15-33DOKUMEN 9.pdf', NULL, '2019-11-08 15:15:33'),
(124, 'Retirement', 18, '1902', '12', '', 'SK', '2019-11-08 15-19-01DOKUMEN 1.pdf', NULL, '2019-11-08 15:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationID` int(11) NOT NULL,
  `activityType` enum('Promotion','Retirement') DEFAULT NULL,
  `activityID` int(11) DEFAULT NULL,
  `requester` varchar(50) DEFAULT NULL,
  `updatedBy` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationID`, `activityType`, `activityID`, `requester`, `updatedBy`, `content`, `time`) VALUES
(131, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'silahkan unduh sk pensiun dokumen 1', '2019-11-08 15:19:01'),
(130, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:19:01'),
(129, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'sedang tahap pengiriman ke ditjen', '2019-11-08 15:16:34'),
(128, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:16:34'),
(127, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'dokumen benar', '2019-11-08 15:16:03'),
(126, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:16:03'),
(125, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:15:33'),
(124, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'kesalahan berkas dokumen 2 ubah menjadi dokumen 9', '2019-11-08 15:14:39'),
(123, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:14:39'),
(122, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'tahap pemeriksaan dokumen', '2019-11-08 15:12:17'),
(121, 'Retirement', 18, NULL, 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:12:17'),
(120, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'silahkan unduh sk baru dokumen 5', '2019-11-08 15:08:39'),
(119, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'File SK diupload', '2019-11-08 15:08:39'),
(118, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'tahap pengiriman ke ditjen', '2019-11-08 15:07:41'),
(117, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'Dokumen benar', '2019-11-08 15:07:12'),
(115, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'ubah dokumen 1 menjadi dokumen 4', '2019-11-08 15:06:11'),
(116, 'Promotion', 12, '1902', 'Muhammad Bayu Khrisna Murthi', 'Update Dokumen', '2019-11-08 15:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `ttd` text DEFAULT NULL,
  `tmt_sk_terakhir` date DEFAULT NULL,
  `perguruan_tinggi` varchar(100) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `tahun_pendidikan` varchar(50) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan_fungsional` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `isRetired` char(1) DEFAULT '0',
  `roleID` int(11) DEFAULT NULL,
  `lastUpdated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `password`, `nama`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `photo`, `ttd`, `tmt_sk_terakhir`, `perguruan_tinggi`, `pendidikan`, `tahun_pendidikan`, `golongan`, `jabatan_fungsional`, `jabatan`, `isRetired`, `roleID`, `lastUpdated`) VALUES
('1902', '21232f297a57a5a743894a0e4a801fc3', 'Muhammad Bayu Khrisna Murthi', 'Depok', '1997-09-18', '087880343055', '5dc5206b74e79.png', NULL, '2031-12-10', 'UHAMKA', 'S1', '2019', 'III/a', NULL, 'Penata Dokumen', '1', 15, '2019-11-08 15:08:39'),
('196108261987031001', '21232f297a57a5a743894a0e4a801fc3', 'Muryanto', 'Karangmojo, Gn Kidul', '1961-08-26', '', NULL, '', '2007-04-01', 'SMA ', 'SLTA', '1982', 'III/b', 'Fungsional Umum', 'pengadministrasi Kerumahtanggaan', '0', 16, '2019-10-30 07:21:58'),
('196205071982031004', '', 'M. Soleh', 'Jakarta', '1962-05-07', '', '5db8d764c2b17.png', '', '2006-04-01', 'KPA', 'SLTP', '1985', 'II/c', 'Fungsional Umum', 'Petugas Keamanan', '0', 16, '2019-10-30 07:20:52'),
('196205121987031003', '', 'Mardi', 'Jakarta', '1962-05-12', '', NULL, '', '2003-04-01', 'SD', 'SD', '1981', 'II/a', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196205241992032001', '', 'Dra. Sri Sulistyorini, M.M.', 'Kulonprogo', '1962-05-24', '', NULL, '', '2015-10-01', 'UNPAM', 'S2', '2014', 'IV/a', 'Fungsional Umum', 'Petugas Perpustakaan', '0', NULL, '2019-09-15 17:19:40'),
('196208261990011001', '', 'Slamet', 'Jakarta', '1962-08-26', '', NULL, '', '2010-04-01', 'SMA', 'SLTA', '1984', 'III/b', 'Fungsional Umum', 'pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196210011987031003', '', 'Tongani', 'Jakarta', '1962-10-01', '', NULL, '', '2018-04-01', 'SMA ', 'SLTA', '2002', 'III/b', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('196211091990012001', '', 'Endang  Suyutik, S.Pd.', 'Padang', '1962-11-09', '', NULL, '', '2012-04-01', 'STKIP-Purnama', 'S1', '1999', 'III/d', 'Fungsional Umum', 'Pengolah Data Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('196301081985031005', '', 'Sunardi, S.Pd.', 'Cirebon', '1963-01-08', '', NULL, '', '2012-10-01', 'STKIP-Purnama', 'S1', '2006', 'III/d', 'Fungsional Umum', 'Pengolah Data Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196305081982031002', '', 'Mat Izih', 'Jakarta', '1963-05-08', '', NULL, '', '2015-04-01', 'SMU', 'SLTA', '2002', 'III/a', 'Fungsional Umum', 'Pemproses Mutasi Kepegawaian', '0', NULL, '2019-09-15 17:19:40'),
('196305241990011001', '', 'Saut Sanusi, S.Pd.', 'Bogor', '1963-05-24', '', NULL, '', '2017-10-01', 'STKIP-Purnama', 'S1', '2003', 'III/d', 'Fungsional Umum', 'Analis Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196306141981111001', '', 'Zainudin', 'Bogor', '1963-06-14', '', NULL, '', '2010-04-01', 'KPAAN 4 Jakarta', 'SLTA', '1989', 'III/b', 'Fungsional Umum', 'Petugas Keamanan', '0', NULL, '2019-09-15 17:19:40'),
('196307221990012001', '', 'Titi Marhayati, S.Pd.', 'Jakarta', '1963-07-22', '', NULL, '', '2018-04-01', 'STKIP-Purnama', 'S1', '2006', 'III/d', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196401111990012001', '', 'Rosdanur', 'Padang', '1964-01-11', '', NULL, '', '2010-04-01', 'SMA', 'SLTA', '2002', 'III/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196402161988101001', '', 'Ahmad Sadik ', 'Jakarta', '1964-02-16', '', NULL, '', '2011-04-01', 'SMA', 'SLTA', '1986', 'III/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196402271985032004', '', 'Djuairiah, S.Pd.', 'Parung Bingung', '1964-02-27', '', NULL, '', '2013-04-01', 'STKIP-Purnama', 'S1', '2006', 'III/d', 'Fungsional Umum', 'Penyusun Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196403191987031001', '', 'Rusli Arif, S.Sos.', 'Jakarta', '1964-03-19', '', NULL, '', '2014-04-01', 'STIA YAPPANN', 'S1', '2007', 'III/d', 'Fungsional Umum', 'Pengolah Data Evaluasi Fasilitasi Peningkatan Kompetensi', '0', NULL, '2019-09-15 17:19:40'),
('196404011990011001', '', 'Yureni', 'Yogyakarta', '1964-04-01', '', NULL, '', '2009-10-01', 'SMP', 'SLTP', '1982', 'II/c', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196404231986031002', '', 'Subardjo, S.E.', 'Jakarta', '1964-04-23', '', NULL, '', '2014-04-01', 'UNPAM', 'S1', '2006', 'III/d', 'Fungsional Umum', 'Penyusun Laporan Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('196404302014092001', '', 'Een Supiyanih', 'Bogor', '1964-04-30', '', NULL, '', '2018-10-01', 'SD', 'SD', '1980', 'I/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196405121990012001', '', 'Rusmini, S.Pd.', 'Cilacap', '1964-05-12', '', NULL, '', '2012-04-01', 'STKIP-Purnama', 'S1', '1999', 'III/d', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196407142014092002', '', 'Maisaroh', 'Jakarta', '1964-07-14', '', NULL, '', '2018-10-01', 'Paket A', 'SD', '2003', 'I/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196410101990011001', '', 'Hartoyo, S.Pd.', 'Jakarta', '1964-10-10', '', NULL, '', '2018-04-01', 'STKIP-Purnama', 'S1', '2006', 'III/d', 'Fungsional Umum', 'Pengolah Data Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196501052014092001', '', 'Mardiyah', 'Jakarta', '1965-01-05', '', NULL, '', '2018-10-01', 'Paket A', 'SD', '2003', 'I/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196501181990012002', '', 'Sumarni', 'Gombong', '1965-01-18', '', NULL, '', '2009-10-01', 'SMEA ', 'SLTA', '1985', 'III/b', 'Fungsional Umum', 'Pengadministrasi Kerumahtanggan', '0', NULL, '2019-09-15 17:19:40'),
('196503241990011001', '', 'Suparno', 'Jakarta', '1965-03-24', '', NULL, '', '2016-10-01', 'SMU', 'SLTA', '2000', 'III/a', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196505061990012001', '', 'Sulastri. S.Pd.', 'Gunungkidul', '1965-05-06', '', NULL, '', '2017-04-01', 'STKIP-Purnama', 'S1', '2006', 'III/d', 'Fungsional Umum', 'pengadministrasi Kebutuhan Penyelanggaan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196505071989031001', '', 'Chris Santoso', 'Jakarta', '1965-05-07', '', NULL, '', '2009-04-01', 'SMA', 'SLTA', '1986', 'III/b', 'Fungsional Umum', 'Pemproses Mutasi Kepegawaian', '0', NULL, '2019-09-15 17:19:40'),
('196505201990011002', '', 'Adin', 'Bogor', '1965-05-20', '', NULL, '', '2013-10-01', 'SMA', 'SLTA', '1991', 'III/b', 'Fungsional Umum', 'Pengolah Data Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196511122005012004', '', 'Dra. Hj. Kokom Komariah, M.Si.', 'Subang', '1965-11-12', '', NULL, '', '2017-10-01', '', 'S2', '2008', 'IV/b', 'Fungsional Umum', 'Analis Pelaksanaan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196512251987031001', '', 'Yendri', 'Padang', '1965-12-25', '', NULL, '', '2006-04-01', 'SMEA ', 'SLTA', '1985', 'III/b', 'Fungsional Umum', 'Pengadministrasi Umum', '0', NULL, '2019-09-15 17:19:40'),
('196602081990012001', '', 'Maria Nini Kean', 'Ende', '1966-02-08', '', NULL, '', '2010-04-01', 'SMA', 'SLTA', '1987', 'III/b', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelanggaan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196605121986031004', '', 'Roni', 'Jakarta', '1966-05-12', '', NULL, '', '2016-10-01', 'SMA ', 'SLTA', '1996', 'III/b', 'Fungsional Umum', 'Penata Dokumen', '0', NULL, '2019-09-15 17:19:40'),
('196606021990012001', '', 'Sumirahayu, S.Pd.', 'Tulung Agung', '1966-06-02', '', NULL, '', '2018-04-01', 'STKIP-Purnama', 'S1', '2004', 'III/d', 'Fungsional Umum', 'Penata Dokumen Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('196607061990011003', '', 'Sumanto', 'Karangmojo', '1966-07-06', '', NULL, '', '2017-04-01', 'SMUN Karang Mojo', 'SLTA', '1987', 'III/a', 'Fungsional Umum', 'Penata Dokumen Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('196607101990011001', '', 'Djoko Siswantoro', 'Jakarta', '1966-07-10', '', NULL, '', '2011-04-01', 'SMA ', 'SLTA', '1988', 'III/a', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196608032014091001', '', 'Gozali Sahlan', 'Jakarta', '1966-08-03', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1983', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196608171990012001', '', 'N. Agesti', 'Kuningan', '1966-08-17', '', NULL, '', '2009-10-01', 'SMEA ', 'SLTA', '1986', 'III/b', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196608202002121004', '', 'Yusyanto, SE', 'Gunung Kidul', '1966-08-20', '', NULL, '', '2018-10-01', 'SMU Pemb. II Kr.Mojo', 'SLTA', '1987', 'III/a', 'Fungsional Umum', 'pengadministrasi Persuratan', '0', NULL, '2019-09-15 17:19:40'),
('196609061992032008', '', 'Ismirah, SE.', 'Bantul', '1966-09-06', '', NULL, '', '2017-04-01', 'Univ. Pamulang', 'S1', '2016', 'III/c', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196611021987031002', '', 'Rozali', 'Jakarta', '1966-11-02', '', NULL, '', '2015-04-01', 'SMA Paket C', 'SLTA', '2007', 'II/d', 'Fungsional Umum', 'Petugas Keamanan', '0', NULL, '2019-09-15 17:19:40'),
('196703121990011002', '', 'Wijiyono, S.Pd.', 'Kokap-Kulonprogo', '1967-03-12', '', NULL, '', '2018-04-01', 'STKIP-Purnama', 'S1', '2003', 'III/d', 'Fungsional Umum', 'Pengolah Data Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196704101990011001', '', 'Achmad Yani', 'Jakarta', '1967-04-10', '', NULL, '', '2018-04-01', 'SMAP', 'SLTA', '2002', 'II/d', 'Fungsional Umum', 'Penata Dokumen Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('196704121990112001', '', 'Ria Komalayanti', 'Jakarta', '1967-04-12', '', NULL, '', '2010-04-01', 'SMKK ', 'SLTA', '1988', 'III/b', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196704241990022001', '', 'Aprianti', 'Jakarta', '1967-04-24', '', NULL, '', '2009-04-01', 'SMEA', 'SLTA', '1988', 'III/b', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196705021990022001', '', 'Supriyati', 'Jakarta', '1967-05-02', '', NULL, '', '2017-10-01', 'SMA', 'SLTA', '2001', 'III/a', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196705031990012001', '', 'Mayanti, S.Pd., M.M.', 'Jakarta', '1967-05-03', '', NULL, '', '2017-10-01', 'UNPAM', 'S2', '2014', 'III/d', 'Fungsional Umum', 'Bendahara Penerimaan', '0', NULL, '2019-09-15 17:19:40'),
('196705041990011001', '', 'Endang Wijaya', 'Jakarta', '1967-05-04', '', NULL, '', '2018-04-01', 'SMA Paket C', 'SLTA', '2001', 'II/d', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196705241990011001', '', 'Sukamto, S.Pd.', 'Klaten', '1967-05-24', '', NULL, '', '2012-10-01', 'STKIP- Purnama', 'S1', '2000', 'III/d', 'Fungsional Umum', 'Teknisi Sarana dan Prasarana Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196705251992031001', '', 'Somarul Soleh, S.Pd.', 'Subang', '1967-05-25', '', NULL, '', '2015-10-01', 'STKIP-Purnama', 'S1', '2004', 'III/c', 'Fungsional Umum', 'pengadministrasi Kerumahtanggaan', '0', NULL, '2019-09-15 17:19:40'),
('196708201990012001', '', 'Titin  Agustini', 'Jakarta', '1967-08-20', '', NULL, '', '2010-04-01', 'SMA 49 Jakarta', 'SLTA', '1986', 'III/b', 'Fungsional Umum', 'Pemproses Mutasi Kepegawaian', '0', NULL, '2019-09-15 17:19:40'),
('196708231990011001', '', 'Agus Edyzar', 'Jakarta', '1967-08-23', '', NULL, '', '2017-04-01', 'SMA. Paket C', 'SLTA', '2002', 'III/a', 'Fungsional Umum', 'Pemproses Mutasi Kepegawaian', '0', NULL, '2019-09-15 17:19:40'),
('196709161990012001', '', 'Arifie Lukiyanti', 'Jakarta', '1967-09-16', '', NULL, '', '2010-04-01', 'SMKK', 'SLTA', '1986', 'III/b', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196710251990012001', '', 'Elda Theresia, S.Pd., M.M.', 'Palembang', '1967-10-25', '', NULL, '', '2014-04-01', 'UNPAM', 'S2', '2013', 'IV/a', 'Fungsional Umum', 'Pengolah Data Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196712101990031001', '', 'Matalih', 'Jakarta', '1967-12-10', '', NULL, '', '2009-04-01', 'SMEA ', 'SLTA', '1988', 'III/b', 'Fungsional Umum', 'pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196801121990021001', '', 'Waluyo, S.Pd., M.M.', 'Jogonalan, Klaten', '1968-01-12', '', NULL, '', '2012-10-01', 'Un.Krisna Dwipayana', 'S2', '2008', 'IV/a', 'Fungsional Umum', 'Penyusun Program Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('196801191992031002', '', 'Pandu Hardiantoro', 'Yogyakarta', '1968-01-19', '', NULL, '', '2011-10-01', 'SMSR ', 'SLTA', '1988', 'III/b', 'Fungsional Umum', 'pengadministrasi Umum', '0', NULL, '2019-09-15 17:19:40'),
('196803091990011001', '', 'Muhamad Zaini', 'Jakarta', '1968-03-09', '', NULL, '', '2015-01-10', 'SMA', 'SLTA', '1995', 'III/b', 'Fungsional Umum', 'Pengemudi', '0', NULL, '2019-09-15 17:19:40'),
('196805032005011002', '', 'Susiladi, S.E.', 'Pemalang', '1968-05-03', '', NULL, '', '2016-04-01', 'UNPAM', 'S1', '2010', 'III/b', 'Fungsional Umum', 'Penyusun Informasi dan Publikasi', '0', NULL, '2019-09-15 17:19:40'),
('196805122014091001', '', 'Karyadih', 'Jakarta', '1968-05-12', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1984', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196805252014092002', '', 'Dariyatmi', 'Wonogiri', '1968-05-25', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1985', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196806072005012001', '', 'Dwi Wahyu Wardani', 'Purworejo', '1968-06-07', '', NULL, '', '2017-04-01', 'SMK', 'SLTA', '1987', 'II/d', 'Fungsional Umum', 'Pemproses Mutasi Kepegawaian', '0', NULL, '2019-09-15 17:19:40'),
('196806211990011001', '', 'Sanusi', 'Jakarta', '1968-06-21', '', NULL, '', '2010-04-01', 'SMT Kosgoro Pasarminggu', 'SLTA', '1998', 'III/b', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('196806262014092001', '', 'Siti Syamsiah', 'Tangerang', '1968-06-26', '', NULL, '', '2018-10-01', 'SMEA', 'SLTA', '1987', 'II/b', 'Fungsional Umum', 'Penata Dokumen', '0', NULL, '2019-09-15 17:19:40'),
('196807062005011002', '', 'Kuat Dwiyono', 'Wonosobo', '1968-07-06', '', NULL, '', '2017-04-01', 'SMA', 'SLTA', '1989', 'II/d', 'Fungsional Umum', 'pengadministrasi Persuratan', '0', NULL, '2019-09-15 17:19:40'),
('196808092014091001', '', 'Riwayat', 'Magelang', '1968-08-09', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1986', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196809082014091001', '', 'Bahtra Irawan', 'Jakarta', '1968-09-08', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1986', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('196810012007011002', '', 'Sutana', 'Indramayu', '1968-10-01', '', NULL, '', '2015-04-01', 'SLTA', 'SLTA', '1988', 'II/c', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196810032005011003', '', 'Bunyamin', 'Jakarta', '1968-10-03', '', NULL, '', '2017-04-01', 'SGO', 'SLTA', '1988', 'II/d', 'Fungsional Umum', 'Petugas Keamanan', '0', NULL, '2019-09-15 17:19:40'),
('196811122007011001', '', 'Herman', 'Jakarta', '1968-11-12', '', NULL, '', '2015-04-01', 'SMP', 'SLTP', '1983', 'II/a', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('196901111990021001', '', 'Basirun, S.Pd.', 'Sidarata', '1969-01-11', '', NULL, '', '2017-04-01', 'STKIP-Purnama', 'S1', '2008', 'III/d', 'Fungsional Umum', 'Analis Pelaksanaan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196901131990011001', '', 'Supardi', 'Jakarta', '1969-01-13', '', NULL, '', '2018-04-01', 'SMA Paket C', 'SLTA', '2007', 'II/d', 'Fungsional Umum', 'Petugas Keamanan', '0', NULL, '2019-09-15 17:19:40'),
('196902121998032002', '', 'Indrianancy Indra, S.E., M.M.', 'Sawahlunto', '1969-02-12', '', NULL, '', '2015-04-01', 'UNPAM', 'S2', '2014', 'IV/a', 'Fungsional Umum', 'Analis Pelaksanaan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196905041990022001', '', 'Alawiyah', 'Jakarta', '1969-05-04', '', NULL, '', '2009-04-01', 'SMEA ', 'SLTA', '1989', 'III/b', 'Fungsional Umum', 'Petugas Perpustakaan', '0', NULL, '2019-09-15 17:19:40'),
('196906052005011002', '', 'Dasiman', 'Pacitan', '1969-06-05', '', NULL, '', '2017-04-01', 'SMEA', 'SLTA', '1991', 'II/d', 'Fungsional Umum', 'pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('196906111989122001', '', 'Erpin Juniati Nababan, S.Pd.', 'Desa Pollung', '1969-06-11', '', NULL, '', '2017-10-01', 'UNJ', 'S1', '2004', 'III/d', 'Fungsional Umum', 'Penyusun Laporan Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('196907081992032002', '', 'Mentas Kumalaningsih, S.Ikom.', 'Yogyakarta', '1969-07-08', '', NULL, '', '2016-04-01', 'STIKOM Prosia', 'S1', '2009', 'III/c', 'Fungsional Umum', 'Pengadministrasi Poliklinik', '0', NULL, '2019-09-15 17:19:40'),
('196907151990022001', '', 'Kurniawati', 'Cikembar, Sukabumi', '1969-07-15', '', NULL, '', '2009-04-01', 'SMEA ', 'SLTA', '1989', 'III/b', 'Fungsional Umum', 'Petugas Perpustakaan', '0', NULL, '2019-09-15 17:19:40'),
('196911022002121001', '', 'Tatang, S.E.', 'Ciamis', '1969-11-02', '', NULL, '', '2016-04-01', 'UNPAM', 'S1', '2012', 'III/a', 'Fungsional Umum', 'Pengolah Data Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('196911132005042001', '', 'Noni Aisyah, S.Pd.', 'Kisaran', '1969-11-13', '', NULL, '', '2015-10-01', 'Univ. Syah Kuala', 'S1', '1997', 'III/d', 'Fungsional Umum', 'Pengadministrasi Persuratan', '0', NULL, '2019-09-15 17:19:40'),
('197002031992032002', '', 'Nirmahayu, S.Pd.', 'Ujung Pandang', '1970-02-03', '', NULL, '', '2016-04-01', 'STKIP-Purnama', 'S1', '2006', 'III/c', 'Fungsional Umum', 'Penyusun Laporan Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('197003041990011001', '', 'Syafe\'ih', 'Jakarta', '1970-03-04', '', NULL, '', '2015-04-01', 'SMA Paket C', 'SLTA', '2003', 'II/c', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('197009032002121002', '', 'Widodo', 'Bantul', '1970-09-03', '', NULL, '', '2015-04-01', 'SMKKN Bantul', 'SLTA', '1992', 'II/d', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('197010232001122001', '', 'Tri Kartika Widyaningsih, S.Kom., M.T.', 'Jakarta', '1970-10-23', '', NULL, '', '2018-04-01', 'ITB ', 'S2', '2007', 'IV/a', 'Fungsional Umum', 'Analis Data dan Informasi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('197101182014091002', '', 'Supomo', 'Purworejo', '1971-01-18', '', NULL, '', '2018-10-01', 'STM', 'SLTA', '1992', 'II/b', 'Fungsional Umum', 'Pengemudi', '0', NULL, '2019-09-15 17:19:40'),
('197101292002121001', '', 'Hendro Susilo, SST.Par.', 'Purworejo', '1971-01-29', '', NULL, '', '2017-04-01', 'STP. Trisakti', 'DIV', '2008', 'III/c', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('197106142014091001', '', 'Abdurahman', 'Bogor', '1971-06-14', '', NULL, '', '2018-10-01', 'SMP', 'SLTP', '1987', 'I/d', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('197107092014091001', '', 'Satimin', 'Sragen', '1971-07-09', '', NULL, '', '2018-10-01', 'SD', 'SD', '1984', 'I/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('197108032001122001', '', 'Ida Nurlina, S.Pd. M.M.', 'Jakarta', '1971-08-03', '', NULL, '', '2016-10-01', 'Univ. Pamulang', 'S2', '2016', 'III/c', 'Fungsional Umum', 'Pengolah Data Ketatalaksanaan', '0', NULL, '2019-09-15 17:19:40'),
('197110012014092002', '', 'Susilawati', 'Padang', '1971-10-01', '', NULL, '', '2018-10-01', 'SMEA', 'SLTA', '1990', 'II/b', 'Fungsional Umum', 'Penata Dokumen', '0', NULL, '2019-09-15 17:19:40'),
('197111051990092001', '', 'Saiyah, S.Pd.', 'Jakarta', '1971-11-05', '', NULL, '', '2015-04-01', 'STKIP-Purnama', 'S1', '2008', 'III/b', 'Fungsional Umum', 'Pengolah Data Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('197208082007011002', '', 'Hariyadi', 'Bogor', '1972-08-08', '', NULL, '', '2015-04-01', 'SMP', 'SLTP', '1997', 'II/a', 'Fungsional Umum', 'Pengemudi', '0', NULL, '2019-09-15 17:19:40'),
('197305012002121002', '', 'Supriyono, S.Pd.', 'Bantul', '1973-05-01', '', NULL, '', '2018-10-01', 'STKIP-Purnama', 'S1', '2004', 'III/d', 'Fungsional Umum', 'Pengelola Wisma', '0', NULL, '2019-09-15 17:19:40'),
('197309132002121001', '', 'Endri Handono, S.Pd., M.M.', 'Bantul', '1973-09-13', '', NULL, '', '2017-10-01', 'UNPAM', 'S2', '2014', 'III/d', 'Fungsional Umum', 'Penyusun Laporan Keuangan', '0', NULL, '2019-09-15 17:19:40'),
('197311162002121001', '', 'Subandi, A.Md.', 'Bogor', '1973-11-16', '', NULL, '', '2017-10-01', 'ISTN Jakarta', 'D3', '2000', 'III/b', 'Fungsional Umum', 'Pengolah Surat Perintah Membayar', '0', NULL, '2019-09-15 17:19:40'),
('197409292002121002', '', 'Lili Husada, SST.Par.', 'Jakarta', '1974-09-29', '', NULL, '', '2017-04-01', 'STP. Trisakti', 'DIV', '2008', 'III/c', 'Fungsional Umum', 'Analis Ketatalaksanaan', '0', NULL, '2019-09-15 17:19:40'),
('197508242005012001', '', 'Minta Setiowati, S.E.', 'Jakarta', '1975-08-24', '', NULL, '', '2016-04-01', 'UNPAM', 'S1', '2012', 'III/a', 'Fungsional Umum', 'Pengolah Surat Perintah Membayar', '0', NULL, '2019-09-15 17:19:40'),
('197510302002121001', '', 'Hendro Basuki, S.S.', 'Jakarta', '1975-10-30', '', NULL, '', '2016-04-01', 'UNPAM', 'S1', '2012', 'III/a', 'Fungsional Umum', 'Pengolah Data Evaluasi Fasilitasi Peningkatan Kompetensi', '0', NULL, '2019-09-15 17:19:40'),
('197606192005012001', '', 'Yetti Mulyati, A.Md.', 'Jakarta', '1976-06-19', '', NULL, '', '2017-04-01', 'AKPL. LPI', 'D3', '1998', 'III/b', 'Fungsional Umum', 'Bendahara Pengeluaran', '0', NULL, '2019-09-15 17:19:40'),
('197607102014091003', '', 'Nasadi', 'Bogor', '1976-07-10', '', NULL, '', '2018-10-01', 'MAN 4 Jakarta', 'SLTA', '1995', 'II/b', 'Fungsional Umum', 'Pramu Kantor', '0', NULL, '2019-09-15 17:19:40'),
('197607262001121002', '', 'Wahyu Hidayat, S.Kom.', 'Jakarta', '1976-07-26', '', NULL, '', '2014-04-01', 'Univ.Gunadarma', 'S1', '2000', 'III/d', 'Fungsional Umum', 'Pengelola Sistem dan Jaringan', '0', NULL, '2019-09-15 17:19:40'),
('197609222008011009', '', 'Victor Imanuel Nahumury, S.E.', 'Jakarta', '1976-09-22', '', NULL, '', '2016-04-01', 'STIE', 'S1', '2004', 'III/c', 'Fungsional Umum', 'Penyusun Program dan Anggaran', '0', NULL, '2019-09-15 17:19:40'),
('197701152007011001', '', 'Ilyasa', 'Bogor', '1977-01-15', '', NULL, '', '2018-10-01', 'SMA Paket C', 'SLTA', '2005', 'II/c', 'Fungsional Umum', 'Pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('197707262005011002', '', 'Shahrial Efendi', 'Jakarta', '1977-07-26', '', NULL, '', '2017-04-01', 'SMA', 'SLTA', '2001', 'II/d', 'Fungsional Umum', 'pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('197709062014091003', '', 'Asep Subagja', 'Sagalaherang', '1977-09-06', '', NULL, '', '2018-10-01', 'MTS', 'SLTP', '1993', 'I/d', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('197804242009101001', '', 'Ade Saefudin. S.I.P.', 'Cirebon', '1978-04-24', '', NULL, '', '2017-01-10', '', 'S1', '', 'III/c', 'Fungsional Umum', 'pengadministrasi Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('197808182007101001', '', 'Marudin', 'Bogor', '1978-08-18', '', NULL, '', '2016-04-01', 'SLTA', 'SLTA', '1997', 'II/c', 'Fungsional Umum', 'Teknisi Sarana dan Prasarana Kantor', '0', NULL, '2019-09-15 17:19:40'),
('197809112008012010', '', 'Titin Karnasih, S.Pd.', 'Jakarta', '1978-09-11', '', NULL, '', '2016-04-01', 'UNJ', 'S1', '2004', 'III/c', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('197811282002121004', '', 'Dody Andriansyah, A.Md.', 'Jakarta', '1978-11-28', '', NULL, '', '2018-10-01', 'AKPINDO', 'D3', '2001', 'III/b', 'Fungsional Umum', 'pengadministrasi Kerumahtanggaan', '0', NULL, '2019-09-15 17:19:40'),
('197905072008012039', '', 'Tantri Miharti, S.Pd., M.M', 'Jakarta', '1979-05-07', '', NULL, '', '2016-04-01', 'UNJ', 'S1', '2003', 'III/c', 'Fungsional Umum', 'Teknisi Laboratorium', '0', NULL, '2019-09-15 17:19:40'),
('197907172005012001', '', 'Harnani Fatmawati, S.Pd.', 'Jakarta', '1979-07-17', '', NULL, '', '2017-04-01', 'UNJ', 'S1', '2005', 'III/c', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('197909062002122006', '', 'Wilia Ningsih, S.E., M.Pd.', 'Tangerang', '1979-09-06', '', NULL, '', '2018-10-01', 'UNJ', 'S2', '2009', 'III/d', 'Fungsional Umum', 'Penyusun Program Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('197911122002122001', '', 'Renny Trisnawati, S.Pd.*', 'Jakarta', '1979-11-12', '', NULL, '', '2016-04-01', 'UNJ', 'S1', '2006', 'III/c', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198005182014091002', '', 'Muhamad Suhud', 'Bogor', '1980-05-18', '', NULL, '', '2018-10-01', 'SLTP ', 'SLTP', '1997', 'I/d', 'Fungsional Umum', 'Pramu Wisma', '0', NULL, '2019-09-15 17:19:40'),
('198011242005012001', '', 'Ristiarini Endah Winarti, S.Pd.', 'Jakarta', '1980-11-24', '', NULL, '', '2017-04-01', 'UNJ', 'S1', '2004', 'III/d', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198105102002122003', '', 'Mino Finta Bhakti Akhiri, S.E.', 'Depok', '1981-05-10', '', NULL, '', '2016-04-01', 'UNPAM', 'S1', '2010', 'III/b', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198106172005012003', '', 'Nurlaili, S.Pd., M.Pd.', 'Palembang', '1981-06-17', '', NULL, '', '2017-04-01', 'UNIV. Pakuan Bogor', 'S2', '2014', 'III/d', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198107012010121003', '', 'Yudhi Aryo Yulianto, S.E.', 'Depok', '1981-07-01', '', NULL, '', '2015-04-01', 'Univ. Bung Karno', 'S1', '2006', 'III/b', 'Fungsional Umum', 'Pengolah Data Evaluasi Fasilitasi Peningkatan Kompetensi', '0', NULL, '2019-09-15 17:19:40'),
('198108152015042001', '', 'Aqsya Riani, S.Pd.', 'Padang', '1981-08-15', '', NULL, '', '2015-04-01', 'UNP Padang', 'S1', '2014', 'III/a', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198202082009122001', '', 'Ida Aru Wirdaningsih, S.E.', 'Cirebon', '1982-02-08', '', NULL, '', '2018-04-01', 'Univ. Siliwangi', 'S1', '2005', 'III/c', 'Fungsional Umum', 'Analis Perencanaan dan Pengembangan Pegawai', '0', NULL, '2019-09-15 17:19:40'),
('198206122008011013', '', 'Wawan Saepul Irwan, S.Pd., M.Si', 'Karawang', '1982-06-12', '', NULL, '', '2016-04-01', 'UNJ', 'S1', '2007', 'III/c', 'Fungsional Umum', 'Analis Barang Milik Negara', '0', NULL, '2019-09-15 17:19:40'),
('198208012010121002', '', 'Khairul Baladi, SST.Par.', 'Jakarta', '1982-08-01', '', NULL, '', '2015-04-01', 'STP Trisakti', 'DIV', '2004', 'III/b', 'Fungsional Umum', 'Pengolah Data dan Informasi  Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('198208032009121001', '', 'Zaenal Muttaqien, SST.Par.', 'Bogor', '1982-08-03', '', NULL, '', '2018-04-01', 'STP. Bandung', 'DIV', '2008', 'III/c', 'Fungsional Umum', 'Analis Data dan Informasi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('198307122014091001', '', 'Rudi', 'Bogor', '1983-07-12', '', NULL, '', '2018-10-01', 'SMK', 'SLTA', '2002', 'II/b', 'Fungsional Umum', 'Teknisi Sarana dan Prasarana Kantor', '0', NULL, '2019-09-15 17:19:40'),
('198312252002122002', '', 'Ela Laelasari', 'Tasikmalaya', '1983-12-25', '', NULL, '', '2015-04-01', 'SMKN 3 Bogor', 'SLTA', '2002', 'II/d', 'Fungsional Umum', 'Penata Dokumen', '0', NULL, '2019-09-15 17:19:40'),
('198501042008032002', '', 'Nurlaili, S.ST.Par., M.Par', 'Ternate', '1985-01-04', '', NULL, '', '2016-10-01', 'STP. Trisakti', 'DIV', '2007', 'III/b', 'Fungsional Umum', 'Bendahara Pengeluaran Pembantu', '0', NULL, '2019-09-15 17:19:40'),
('198602222009121004', '', 'Mohammad Moudika Akbar, SST.Par.', 'Jakarta', '1986-02-22', '', NULL, '', '2018-04-01', 'STP. Bandung', 'DIV', '2009', 'III/c', 'Fungsional Umum', 'Penyusun Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('198701152010122002', '', 'Rosalina Wahyuningtyas, S.E., M.M.', 'Tangerang', '1987-01-15', '', NULL, '', '2015-04-01', 'UHAMKA', 'S2', '2015', 'III/b', 'Fungsional Umum', 'Penyusun Program Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan', '0', NULL, '2019-09-15 17:19:40'),
('198701182015042002', '', 'Lugina Aulya Zaman, S.T.', 'Subang', '1987-01-18', '', NULL, '', '2015-04-01', 'Univ. Al Azhar Indonesia', 'S1', '2009', 'III/a', 'Fungsional Umum', 'Pengelola Surat Perintah Membayar', '0', NULL, '2019-09-15 17:19:40'),
('198704292010122004', '', 'Suci Ririn Apriani, S.Pd.', 'Jakarta', '1987-04-29', '', NULL, '', '2015-04-01', 'UNJ', 'S1', '2010', 'III/b', 'Fungsional Umum', 'Penata Dokuman', '0', NULL, '2019-09-15 17:19:40'),
('198912232015042003', '', 'Dian Pratiwi, S.Pd.', 'Madiun', '1989-12-23', '', NULL, '', '2015-04-01', 'UNJ Jakarta', 'S1', '2013', 'III/a', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('199108152015041002', '', 'Rizki Respati Prabowo, S.Pd.', 'Surakarta', '1991-08-15', '', NULL, '', '2015-04-01', 'UNS Surakarta', 'S1', '2013', 'III/a', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('199110132015042004', '', 'Kurniawati, S.Pd.', 'Bandung', '1991-10-13', '', NULL, '', '2015-04-01', 'UPI Bandung', 'S1', '2014', 'III/a', 'Fungsional Umum', 'Pengadministrasi Kebutuhan Penyelenggaraan Diklat', '0', NULL, '2019-09-15 17:19:40'),
('199110282015041004', '', 'Widia Aditama, S.T.', 'Kebumen', '1991-10-28', '', NULL, '', '2015-04-01', 'UHAMKA', 'S1', '2013', 'III/a', 'Fungsional Umum', 'Penata Usaha Pimpinan', '0', NULL, '2019-09-15 17:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_activity`
--

CREATE TABLE `promotion_activity` (
  `activityID` int(11) NOT NULL,
  `userRequestNIP` varchar(50) DEFAULT NULL,
  `currentSK` date DEFAULT NULL,
  `promotionSK` date DEFAULT NULL,
  `currentGolongan` varchar(255) DEFAULT NULL,
  `promotionGolongan` varchar(255) DEFAULT NULL,
  `adminReviewNIP` varchar(50) DEFAULT NULL,
  `startReviewTime` datetime DEFAULT NULL,
  `finishReviewTime` datetime DEFAULT NULL,
  `requestStatus` enum('Open','Sedang Dikirim','Sedang Direview','Reject','Done') NOT NULL DEFAULT 'Open',
  `mark` text DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `lastUpdated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion_activity`
--

INSERT INTO `promotion_activity` (`activityID`, `userRequestNIP`, `currentSK`, `promotionSK`, `currentGolongan`, `promotionGolongan`, `adminReviewNIP`, `startReviewTime`, `finishReviewTime`, `requestStatus`, `mark`, `approved`, `createdDate`, `lastUpdated`) VALUES
(12, '1902', '2027-12-10', '2031-12-10', 'III/b', 'III/a', '1902', '2019-11-08 00:00:00', NULL, 'Done', 'silahkan unduh sk baru dokumen 5', 'Y', '2019-11-08 15:04:05', '2019-11-08 15:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `ref_golongan`
--

CREATE TABLE `ref_golongan` (
  `golongan` varchar(255) NOT NULL,
  `pangkat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_golongan`
--

INSERT INTO `ref_golongan` (`golongan`, `pangkat`) VALUES
('I/b', 'Juru Muda Tk. I'),
('I/c', 'Juru'),
('II/a', 'Pengatur Muda'),
('II/b', 'Pengatur Muda Tk. I'),
('II/c', 'Pengatur'),
('III/a', 'Penata Muda'),
('III/b', 'Penata Muda Tk. I'),
('III/c', 'Penata'),
('III/d', 'Penata Tk. I'),
('IV/a', 'Pembina'),
('IV/b', 'Pembina Tk. I');

-- --------------------------------------------------------

--
-- Table structure for table `ref_jabatan_fungsional`
--

CREATE TABLE `ref_jabatan_fungsional` (
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_jabatan_fungsional`
--

INSERT INTO `ref_jabatan_fungsional` (`jabatan`) VALUES
('Fungsional Umum');

-- --------------------------------------------------------

--
-- Table structure for table `ref_jabatan_khusus`
--

CREATE TABLE `ref_jabatan_khusus` (
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_jabatan_khusus`
--

INSERT INTO `ref_jabatan_khusus` (`jabatan`) VALUES
('Analis Barang Milik Negara'),
('Analis Data dan Informasi Pendidik dan Tenaga Kependidikan'),
('Analis Ketatalaksanaan'),
('Analis Pelaksanaan Diklat'),
('Analis Perencanaan dan Pengembangan Pegawai'),
('Bendahara Penerimaan'),
('Bendahara Pengeluaran'),
('Bendahara Pengeluaran Pembantu'),
('Pemproses Mutasi Kepegawaian'),
('Penata Dokumen'),
('Penata Dokumen Keuangan'),
('Penata Usaha Pimpinan'),
('pengadministrasi Barang Milik Negara'),
('pengadministrasi Kebutuhan Penyelanggaan Diklat'),
('Pengadministrasi Kebutuhan Penyelenggaraan Diklat'),
('pengadministrasi Kerumahtanggaan'),
('Pengadministrasi Kerumahtanggan'),
('Pengadministrasi Persuratan'),
('Pengadministrasi Poliklinik'),
('Pengadministrasi Umum'),
('Pengelola Sistem dan Jaringan'),
('Pengelola Surat Perintah Membayar'),
('Pengelola Wisma'),
('Pengemudi'),
('Pengolah Data Barang Milik Negara'),
('Pengolah Data dan Informasi  Pendidik dan Tenaga Kependidikan'),
('Pengolah Data Evaluasi Fasilitasi Peningkatan Kompetensi'),
('Pengolah Data Ketatalaksanaan'),
('Pengolah Data Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan'),
('Pengolah Data Penyelenggaraan Diklat'),
('Pengolah Surat Perintah Membayar'),
('Penyusun Informasi dan Publikasi'),
('Penyusun Kebutuhan Penyelenggaraan Diklat'),
('Penyusun Laporan Keuangan'),
('Penyusun Program dan Anggaran'),
('Penyusun Program Peningkatan Kompetensi Pendidik dan Tenaga Kependidikan'),
('Petugas Keamanan'),
('Petugas Perpustakaan'),
('Pramu Kantor'),
('Pramu Wisma'),
('Teknisi Laboratorium'),
('Teknisi Sarana dan Prasarana Kantor');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pangkat`
--

CREATE TABLE `ref_pangkat` (
  `pangkat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_pangkat`
--

INSERT INTO `ref_pangkat` (`pangkat`) VALUES
('Juru Muda Tk.I'),
('Juru Tk.I'),
('Pembina'),
('Pembina Tk. I'),
('Penata'),
('Penata Muda'),
('Penata Muda Tk. I'),
('Penata Tk. I'),
('Pengatur'),
('Pengatur Muda'),
('Pengatur Muda Tk. I'),
('Pengatur Tk. I');

-- --------------------------------------------------------

--
-- Table structure for table `retirement_activity`
--

CREATE TABLE `retirement_activity` (
  `activityID` int(11) NOT NULL,
  `userRequestNIP` varchar(50) DEFAULT NULL,
  `currentSK` date DEFAULT NULL,
  `retSK` varchar(50) DEFAULT NULL,
  `bup` varchar(50) DEFAULT NULL,
  `currentGolongan` varchar(255) DEFAULT NULL,
  `adminReviewNIP` varchar(50) DEFAULT NULL,
  `startReviewTime` datetime DEFAULT NULL,
  `finishReviewTime` datetime DEFAULT NULL,
  `requestStatus` enum('Open','Sedang Dikirim','Sedang Direview','Reject','Done') NOT NULL DEFAULT 'Open',
  `mark` text DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `lastUpdated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `retirement_activity`
--

INSERT INTO `retirement_activity` (`activityID`, `userRequestNIP`, `currentSK`, `retSK`, `bup`, `currentGolongan`, `adminReviewNIP`, `startReviewTime`, `finishReviewTime`, `requestStatus`, `mark`, `approved`, `createdDate`, `lastUpdated`) VALUES
(18, '1902', '2031-12-10', NULL, NULL, 'III/a', '1902', '2019-11-08 00:00:00', NULL, 'Done', 'silahkan unduh sk pensiun dokumen 1', 'Y', '2019-11-08 15:11:05', '2019-11-08 15:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleName`) VALUES
(15, 'Administrator'),
(16, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_access`
--

CREATE TABLE `role_has_access` (
  `roleID` int(11) DEFAULT NULL,
  `access` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_has_access`
--

INSERT INTO `role_has_access` (`roleID`, `access`) VALUES
(15, 'employee'),
(15, 'employee/add'),
(15, 'employee/edit'),
(15, 'employee/delete'),
(15, 'employee/detail'),
(15, 'update_position'),
(15, 'promotion/request'),
(15, 'promotion/request/add'),
(15, 'promotion/request/edit'),
(15, 'promotion/request/delete'),
(15, 'promotion/detail'),
(15, 'promotion/request/review'),
(15, 'promotion/report'),
(15, 'promotion/report/edit'),
(15, 'promotion/report/delete'),
(15, 'promotion/detail'),
(15, 'retirement/request'),
(15, 'retirement/request/add'),
(15, 'retirement/request/edit'),
(15, 'retirement/request/delete'),
(15, 'retirement/detail'),
(15, 'retirement/request/review'),
(15, 'retirement/report'),
(15, 'retirement/report/edit'),
(15, 'retirement/report/delete'),
(15, 'retirement/detail'),
(15, 'notification'),
(15, 'show_all_notification'),
(15, 'golongan'),
(15, 'roles'),
(15, 'roles/add'),
(15, 'roles/edit'),
(15, 'roles/delete'),
(16, 'promotion/request'),
(16, 'promotion/request/add'),
(16, 'promotion/request/edit'),
(16, 'promotion/request/delete'),
(16, 'promotion/detail'),
(16, 'promotion/detail'),
(16, 'retirement/request'),
(16, 'retirement/request/add'),
(16, 'retirement/request/edit'),
(16, 'retirement/request/delete'),
(16, 'retirement/detail'),
(16, 'retirement/detail'),
(16, 'notification');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_documents`
--
ALTER TABLE `activity_documents`
  ADD PRIMARY KEY (`documentID`),
  ADD KEY `FK_activity_documents_pegawai` (`uploadedBy`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `nip` (`nip`),
  ADD KEY `FK_pegawai_ref_golongan` (`golongan`),
  ADD KEY `FK_pegawai_ref_jabatan_fungsional` (`jabatan_fungsional`),
  ADD KEY `FK_pegawai_ref_jabatan_khusus` (`jabatan`);

--
-- Indexes for table `promotion_activity`
--
ALTER TABLE `promotion_activity`
  ADD PRIMARY KEY (`activityID`),
  ADD KEY `FK_activitypromotion_pegawai` (`userRequestNIP`),
  ADD KEY `FK_activitypromotion_pegawai_2` (`adminReviewNIP`),
  ADD KEY `FK_activitypromotion_ref_golongan` (`currentGolongan`),
  ADD KEY `FK_activitypromotion_ref_golongan_2` (`promotionGolongan`);

--
-- Indexes for table `ref_golongan`
--
ALTER TABLE `ref_golongan`
  ADD PRIMARY KEY (`golongan`),
  ADD KEY `golongan` (`golongan`);

--
-- Indexes for table `ref_jabatan_fungsional`
--
ALTER TABLE `ref_jabatan_fungsional`
  ADD PRIMARY KEY (`jabatan`),
  ADD KEY `jabatan` (`jabatan`);

--
-- Indexes for table `ref_jabatan_khusus`
--
ALTER TABLE `ref_jabatan_khusus`
  ADD PRIMARY KEY (`jabatan`),
  ADD KEY `jabatan` (`jabatan`);

--
-- Indexes for table `ref_pangkat`
--
ALTER TABLE `ref_pangkat`
  ADD PRIMARY KEY (`pangkat`),
  ADD KEY `pangkat` (`pangkat`);

--
-- Indexes for table `retirement_activity`
--
ALTER TABLE `retirement_activity`
  ADD PRIMARY KEY (`activityID`),
  ADD KEY `FK_activitypromotion_pegawai` (`userRequestNIP`),
  ADD KEY `FK_activitypromotion_pegawai_2` (`adminReviewNIP`),
  ADD KEY `FK_activitypromotion_ref_golongan` (`currentGolongan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `role_has_access`
--
ALTER TABLE `role_has_access`
  ADD KEY `FK_role_has_access_role` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_documents`
--
ALTER TABLE `activity_documents`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `promotion_activity`
--
ALTER TABLE `promotion_activity`
  MODIFY `activityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `retirement_activity`
--
ALTER TABLE `retirement_activity`
  MODIFY `activityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `promotion_activity`
--
ALTER TABLE `promotion_activity`
  ADD CONSTRAINT `FK_activitypromotion_pegawai` FOREIGN KEY (`userRequestNIP`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activitypromotion_pegawai_2` FOREIGN KEY (`adminReviewNIP`) REFERENCES `pegawai` (`nip`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `FK_activitypromotion_ref_golongan` FOREIGN KEY (`currentGolongan`) REFERENCES `ref_golongan` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_activitypromotion_ref_golongan_2` FOREIGN KEY (`promotionGolongan`) REFERENCES `ref_golongan` (`golongan`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `retirement_activity`
--
ALTER TABLE `retirement_activity`
  ADD CONSTRAINT `retirement_activity_ibfk_1` FOREIGN KEY (`userRequestNIP`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retirement_activity_ibfk_2` FOREIGN KEY (`adminReviewNIP`) REFERENCES `pegawai` (`nip`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `retirement_activity_ibfk_3` FOREIGN KEY (`currentGolongan`) REFERENCES `ref_golongan` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
