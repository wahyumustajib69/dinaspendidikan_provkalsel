-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 Mei 2020 pada 02.12
-- Versi Server: 10.1.25-MariaDB
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
-- Database: `ppsb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat`
--

CREATE TABLE `pangkat` (
  `id_pnkt` varchar(5) NOT NULL,
  `nm_pnkt` varchar(100) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pangkat`
--

INSERT INTO `pangkat` (`id_pnkt`, `nm_pnkt`, `ket`) VALUES
('19', 'Pengatur  Tk. I', 'II/d'),
('23', 'Juru Madya', 'I/b'),
('27', 'Pembina Utama Madya', 'IV/d'),
('29', 'Juru ', 'I/c'),
('30', 'Pembina Tk. I', 'IV/b'),
('36', 'Penata Muda Tk. I', 'III/b'),
('37', 'Penata Muda', 'III/a'),
('45', 'Juru Muda', 'I/a'),
('47', 'Pembina Utama Muda', 'IV/c'),
('52', 'Penata', 'III/c'),
('59', 'Penata Tk. I', 'III/d'),
('66', 'Pembina', 'IV/a'),
('79', 'Pengatur', 'II/c'),
('82', 'Pembina Utama', 'IV/e'),
('86', 'Pengatur Muda Tk. I', 'II/b'),
('91', 'Pengatur Muda', 'II/a'),
('98', 'Juru Tk. I ', 'I/d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `jbtn` varchar(100) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_diangkat` date NOT NULL,
  `pnkg_png` int(11) NOT NULL,
  `tgl_png` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `tmp_kerja` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `pend` varchar(30) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `jbtn`, `pangkat`, `tmp_lahir`, `tgl_lahir`, `tgl_diangkat`, `pnkg_png`, `tgl_png`, `alamat`, `hp`, `tmp_kerja`, `unit_kerja`, `pend`, `foto`) VALUES
('19601225 198206 1 045', 'Drs. Fahmi Baharuddin', 'Kepala Dinas Pendidikan dan Kebudayaan Kab. Balangan', '27', 'Banjarbaru', '1960-12-25', '1982-06-28', 29, '1979-06-12', 'Jl. Sukamara Komp. Suaka Insan  RT.013 RW.009, Kelurahan Landasan Ulin Barat, Kecamatan Landasan Ulin, Kota Banjarbaru', '081145217488', 'Dinas Pendidikan dan Kebudayaan Kab. Balangan', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Doktor', 'RONALDO.jpg'),
('19721212 200604 1 010', 'Muhammad Rizwan', 'Kepala Sekolah SMK N 1 Martapura', '66', 'Banjarbaru', '1972-12-12', '2006-04-12', 29, '1999-08-12', 'Jl. A. Yani Km 69', '088705112148', 'SMK N 1 Martapura Kabupaten Banjar', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Sarjana', 'beckham.jpg'),
('19730806 199303 1 004', 'Jackie Chan', 'Guru Olahraga', '36', 'Wuhan', '1973-08-06', '1993-03-12', 23, '1998-04-23', 'Jl. Maju Mundur', '08111500280', 'SMK N 1 Martapura Kabupaten Banjar', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Sarjana', 'chan.jpg'),
('19820308 200903 2 011', 'Wiandra Dewi Ozawa', 'Guru Matematika', '59', 'Okinawa', '1982-03-08', '2009-03-12', 45, '2005-03-17', 'Jl. Mangku Bumi, Kemplek Bumi Mas Raya, Kelurahan Landasan Ulin, Banjarbaru', '085612238712', 'SMK N 1 Martapura Kabupaten Banjar', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Diploma', 'wiandra.jpg'),
('19850721 201106 1 021', 'James Bond, S.Pd', 'Guru Biologi', '47', 'Banjarmasin', '1985-07-21', '2011-06-21', 45, '1996-07-12', 'Jl. Mangku Bumi, Kelurahan Karang Dadap', '08111500280', 'SMK N 1 Martapura Kabupaten Banjar', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Magister', 'jb.jpg'),
('19931124 201705 2 001', 'Wahyu Mustajib', 'Guru Geografi', '36', 'Banjarbaru', '1992-12-30', '2017-05-12', 98, '2012-04-12', 'Jl. Sapta Marga, Kelurahan Guntung Payung, Kecamatan Landasan Ulin, Banjarbaru', '0895413505277', 'SMK N 1 Martapura Kabupaten Banjar', 'Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', 'Sarjana', 'fotoktp.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `user`, `pass`, `email`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pen_dj`
--

CREATE TABLE `pen_dj` (
  `nosurat` varchar(40) NOT NULL,
  `tgl_surat` date NOT NULL,
  `nm_pmh` varchar(90) NOT NULL,
  `tlh` varchar(50) NOT NULL,
  `ttl` date NOT NULL,
  `stts` varchar(30) NOT NULL,
  `hub` varchar(20) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `tgl_wft` date NOT NULL,
  `idpn` int(11) NOT NULL,
  `pkt_usul` varchar(50) NOT NULL,
  `gol_usul` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pen_dj`
--

INSERT INTO `pen_dj` (`nosurat`, `tgl_surat`, `nm_pmh`, `tlh`, `ttl`, `stts`, `hub`, `nip`, `tgl_wft`, `idpn`, `pkt_usul`, `gol_usul`) VALUES
('0001-Set/Disdikbud/2020', '2020-05-05', 'Emily Padernborn', 'Frankfurt', '1982-09-12', 'Janda', 'Isteri', '19601225 198206 1 045', '2019-12-29', 82, 'Pembina Utama', 'IV/e'),
('0002-Set/Disdikbud/2020', '2020-06-02', 'Sammy Mahotra', 'New Delhi', '1989-02-23', 'Duda', 'Suami', '19820308 200903 2 011', '2020-04-21', 66, 'Pembina', 'IV/a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pen_dn`
--

CREATE TABLE `pen_dn` (
  `no_sur` varchar(40) NOT NULL,
  `tgs` date NOT NULL,
  `nip` varchar(30) NOT NULL,
  `no_recom` varchar(40) NOT NULL,
  `no_spn` varchar(30) NOT NULL,
  `thmt` date NOT NULL,
  `idpnkt` int(11) NOT NULL,
  `nmpnkt` varchar(40) NOT NULL,
  `golpk` varchar(30) NOT NULL,
  `alm_pen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pen_dn`
--

INSERT INTO `pen_dn` (`no_sur`, `tgs`, `nip`, `no_recom`, `no_spn`, `thmt`, `idpnkt`, `nmpnkt`, `golpk`, `alm_pen`) VALUES
('0001-set/disdikbud/2020', '2020-05-14', '19730806 199303 1 004', 'AD-2144/V/2020', 'DIS-XII/V-2020', '2020-07-01', 66, 'Pembina', 'IVa', 'Jl. Manggis, Kel. Landasan Ulin, Banjarbaru'),
('0002-set/disdikbud/2020', '2020-06-16', '19931124 201705 2 001', 'BRP-2020-11', 'AKL/V-2020', '2020-08-26', 52, 'Penata', 'III/c', 'Jl. Sapta Marga, Kelurahan Guntung Payung, Kecamatan Landasan Ulin, Banjarbaru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pidana`
--

CREATE TABLE `pidana` (
  `no` varchar(40) NOT NULL,
  `tanggal` date NOT NULL,
  `nip_kadin` varchar(30) NOT NULL,
  `kadin` varchar(90) NOT NULL,
  `pnk_kdin` varchar(30) NOT NULL,
  `gol_kadin` varchar(20) NOT NULL,
  `jbtn_kadin` varchar(255) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pidana`
--

INSERT INTO `pidana` (`no`, `tanggal`, `nip_kadin`, `kadin`, `pnk_kdin`, `gol_kadin`, `jbtn_kadin`, `nip`) VALUES
('0001-Set/Disdikbud/2020', '2020-05-14', '19631229 198503 1 010', 'Drs. H. Muhammad Yusuf Effendi, M.AP', 'Pembina Utama Madya', 'IV/d', 'Kepala Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', '19601225 198206 1 045'),
('0002-Set/Disdikbud/2020', '2020-06-24', '19631229 198503 1 010', 'Drs. H. Muhammad Yusuf Effendi, M.AP', 'Pembina Utama Madya', 'IV/d', 'Kepala Dinas Pendidikan dan Kebudayaan \r\nProvinsi Kalimantan Selatan', '19931124 201705 2 001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pimpinan`
--

CREATE TABLE `pimpinan` (
  `ni` varchar(30) NOT NULL,
  `nma` varchar(90) NOT NULL,
  `png` varchar(60) NOT NULL,
  `jbt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pimpinan`
--

INSERT INTO `pimpinan` (`ni`, `nma`, `png`, `jbt`) VALUES
('19631229 198503 1 010', 'Drs. H. Muhammad Yusuf Effendi, M.AP', '27', 'Kepala Dinas Pendidikan dan Kebudayaan \r\nProvinsi Kalimantan Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pmpp`
--

CREATE TABLE `pmpp` (
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `nip` varchar(40) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `tgl_pensiun` date NOT NULL,
  `alm_pensiun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pmpp`
--

INSERT INTO `pmpp` (`no_surat`, `tgl_surat`, `nip`, `tgl_pengajuan`, `tgl_pensiun`, `alm_pensiun`) VALUES
('0001-set/disdikbud/2020', '2020-05-13', '19601225 198206 1 045', '2020-05-13', '2020-12-31', 'Jl. Sukamara Komp. Suaka Insan  RT.013 RW.009, Kelurahan Landasan Ulin Barat, Kecamatan Landasan Ulin, Kota Banjarbaru'),
('0002-set/disdikbud/2020', '2020-05-20', '19730806 199303 1 004', '2020-05-20', '2020-08-31', 'Jl. Maju Mundur'),
('0003-set/disdikbud/2020', '2020-06-16', '19721212 200604 1 010', '2020-06-16', '2021-07-21', 'Jl. A. Yani Km 12, Kelurahan Karang Intan, Kecamatan Kertak Hanyar, Kabupaten Banjar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promosi`
--

CREATE TABLE `promosi` (
  `id_pro` varchar(5) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `jbtn_baru` varchar(100) NOT NULL,
  `id_pkb` int(11) NOT NULL,
  `pnkt_lama` varchar(11) NOT NULL,
  `pnkt_baru` varchar(50) NOT NULL,
  `gol_baru` varchar(20) NOT NULL,
  `atasan` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tmp_baru` varchar(255) NOT NULL,
  `tmp_lama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `promosi`
--

INSERT INTO `promosi` (`id_pro`, `nip`, `jbtn_baru`, `id_pkb`, `pnkt_lama`, `pnkt_baru`, `gol_baru`, `atasan`, `tgl_mulai`, `tmp_baru`, `tmp_lama`) VALUES
('1118', '19730806 199303 1 004', 'Guru Olahraga', 36, '86', 'Penata Muda Tk. I', 'III/b', 'Kepala SMK N 1 Martapura', '2020-07-31', 'SMK N 1 Martapura', 'SMK N 1 Martapura'),
('1290', '19931124 201705 2 001', 'Guru Geografi', 36, '86', 'Penata Muda Tk. I', 'III/b', 'Kepala SMK N 1 Martapura', '2020-06-30', 'SMK N 1 Martapura', 'SMK N 1 Martapura'),
('2427', '19721212 200604 1 010', 'Kepala Sekolah SMK N 1 Martapura', 66, '23', 'Pembina', 'IV/a', '-', '2020-08-31', 'SMK N 1 Martapura', 'SMK N 1 Martapura'),
('3619', '19601225 198206 1 045', 'Kepala Dinas Pendidikan dan Kebudayaan Kab. Balangan', 27, '47', 'Pembina Utama Madya', 'IV/d', 'Kepala Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan', '2020-06-01', 'Dinas Pendidikan dan Kebudayaan Kab. Balangan', 'Dinas Pendidikan dan Kebudayaan Kab. Balangan'),
('5513', '19850721 201106 1 021', 'Guru Biologi', 47, '37', 'Pembina Utama Muda', 'IV/c', 'Kepala SMK N 1 Martapura', '2020-05-29', 'SMK N 1 Martapura', 'SMK N 1 Martapura'),
('8929', '19820308 200903 2 011', 'Guru Matematika', 59, '91', 'Penata Tk. I', 'III/d', 'Kepala SMK N 1 Martapura', '2020-07-01', 'SMK N 1 Martapura', 'SMK N 1 Martapura');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id_pnkt`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `pnkt` (`pangkat`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pen_dj`
--
ALTER TABLE `pen_dj`
  ADD PRIMARY KEY (`nosurat`),
  ADD KEY `p_nip` (`nip`);

--
-- Indexes for table `pen_dn`
--
ALTER TABLE `pen_dn`
  ADD PRIMARY KEY (`no_sur`),
  ADD KEY `pnip` (`nip`);

--
-- Indexes for table `pidana`
--
ALTER TABLE `pidana`
  ADD PRIMARY KEY (`no`),
  ADD KEY `pdnip` (`nip`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`ni`),
  ADD KEY `png` (`png`);

--
-- Indexes for table `pmpp`
--
ALTER TABLE `pmpp`
  ADD PRIMARY KEY (`no_surat`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `promosi`
--
ALTER TABLE `promosi`
  ADD PRIMARY KEY (`id_pro`),
  ADD KEY `fk_nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pnkt` FOREIGN KEY (`pangkat`) REFERENCES `pangkat` (`id_pnkt`);

--
-- Ketidakleluasaan untuk tabel `pen_dj`
--
ALTER TABLE `pen_dj`
  ADD CONSTRAINT `p_nip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Ketidakleluasaan untuk tabel `pen_dn`
--
ALTER TABLE `pen_dn`
  ADD CONSTRAINT `pnip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Ketidakleluasaan untuk tabel `pidana`
--
ALTER TABLE `pidana`
  ADD CONSTRAINT `pdnip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Ketidakleluasaan untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD CONSTRAINT `png` FOREIGN KEY (`png`) REFERENCES `pangkat` (`id_pnkt`);

--
-- Ketidakleluasaan untuk tabel `pmpp`
--
ALTER TABLE `pmpp`
  ADD CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Ketidakleluasaan untuk tabel `promosi`
--
ALTER TABLE `promosi`
  ADD CONSTRAINT `fk_nip` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
