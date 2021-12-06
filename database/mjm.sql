-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2021 pada 05.26
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mjm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nama_tabel` varchar(255) NOT NULL,
  `id_tabel` int(11) NOT NULL,
  `foto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tanggal_tagihan` date NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `jns_pembayaran` int(3) NOT NULL,
  `id_login` int(11) NOT NULL,
  `status_tempo` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `jumlah_belanja` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id_invoice_detail` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_spare_part_stok` int(11) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `setelah_diskon` int(11) NOT NULL,
  `nama_spare_part` varchar(255) NOT NULL,
  `no_seri` varchar(255) NOT NULL,
  `merk_spare_part` varchar(255) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `nama`, `foto`, `email`, `status`, `auth_key`, `alamat`) VALUES
(37, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 'Ivanda', '1592748215_8336f9b5-ead3-4bc6-9387-416e00ef7d6a.jpg', '', 0, '', ''),
(38, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1635575278_Screenshot_(37).png', '', 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_navigasi`
--

CREATE TABLE `menu_navigasi` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_navigasi`
--

INSERT INTO `menu_navigasi` (`id_menu`, `nama_menu`, `url`, `id_parent`, `no_urut`, `icon`, `status`) VALUES
(1, 'Master Data', '#', 0, 1, 'database', 0),
(2, 'Login', 'login', 1, 2, 'sign-in-alt', 0),
(3, 'Menu Navigasi', 'menu-navigasi', 1, 1, 'bars', 0),
(4, 'Hak Akses', 'systemrole', 1, 3, 'at', 0),
(249, 'Customer', 'customer', 1, 4, 'fas fa-user-friends', 0),
(250, 'Supplier', 'supplier', 1, 5, 'fas fa-user-friends', 0),
(251, 'Logistik', '#', 0, 24, 'warehouse', 0),
(253, 'Transaksi', '#', 0, 25, 'cart-plus', 0),
(254, 'Penjualan', 'invoice', 253, 1, 'shopping-basket', 0),
(258, 'Pembelian', 'spare-part', 251, 4, 'shopping-basket', 0),
(259, 'Spare Part Stok', 'spare-part-stok', 251, 5, 'archive', 0),
(260, 'Pembukuan', '#', 0, 26, 'book', 0),
(261, 'Laporan Penjualan', 'invoice/laporan-barang-keluar', 260, 1, 'file-alt', 0),
(262, 'Laporan Pembelian ', 'spare-part/laporan-barang-masuk', 260, 2, 'file-alt', 0),
(263, 'Nama Spare Part', 'nama-spare-part', 1, 7, 'tags', 0),
(264, 'Merk Spare Part', 'merk-spare-part', 1, 6, 'tags', 0),
(265, 'Satuan Spare Part', 'uom', 1, 8, 'fas fa-list-ul', 0),
(266, 'Lokasi Rak Spare Part', 'rak', 1, 9, 'fas fa-list-ul', 0),
(268, 'Log', '#', 0, 27, 'check-circle', 0),
(269, 'Log', 'log', 268, 1, 'file-alt', 0),
(270, 'Return Penjualan', 'return-penjualan', 253, 2, 'undo-alt', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_navigasi_role`
--

CREATE TABLE `menu_navigasi_role` (
  `id_menu_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_system_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_navigasi_role`
--

INSERT INTO `menu_navigasi_role` (`id_menu_role`, `id_menu`, `id_system_role`) VALUES
(5, 5, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(31, 31, 1),
(32, 32, 1),
(36, 36, 1),
(40, 40, 1),
(42, 42, 1),
(43, 43, 1),
(44, 44, 1),
(52, 52, 1),
(53, 53, 1),
(76, 76, 1),
(77, 77, 1),
(78, 78, 1),
(79, 79, 1),
(80, 80, 1),
(81, 81, 1),
(82, 82, 1),
(83, 83, 1),
(84, 84, 1),
(85, 85, 1),
(86, 86, 1),
(88, 88, 1),
(89, 89, 1),
(105, 105, 1),
(106, 106, 1),
(107, 107, 1),
(108, 108, 1),
(109, 109, 1),
(110, 110, 1),
(111, 111, 1),
(112, 112, 1),
(133, 61, 11),
(134, 61, 1),
(147, 71, 12),
(148, 71, 1),
(149, 75, 3),
(150, 75, 1),
(151, 87, 1),
(152, 87, 13),
(166, 47, 8),
(167, 47, 1),
(202, 91, 15),
(203, 91, 16),
(204, 91, 1),
(205, 92, 15),
(206, 92, 16),
(207, 92, 1),
(208, 93, 15),
(209, 93, 16),
(210, 93, 1),
(211, 94, 15),
(212, 94, 16),
(213, 94, 1),
(220, 98, 15),
(221, 98, 16),
(222, 98, 1),
(223, 97, 15),
(224, 97, 16),
(225, 97, 1),
(226, 99, 15),
(227, 99, 16),
(228, 99, 1),
(229, 100, 15),
(230, 100, 16),
(231, 100, 1),
(235, 102, 15),
(236, 102, 16),
(237, 102, 1),
(238, 103, 15),
(239, 103, 16),
(240, 103, 1),
(241, 104, 15),
(242, 104, 16),
(243, 104, 1),
(315, 6, 8),
(316, 6, 5),
(317, 6, 1),
(318, 62, 11),
(319, 62, 1),
(320, 63, 11),
(321, 63, 1),
(322, 64, 11),
(323, 64, 1),
(324, 65, 11),
(325, 65, 1),
(326, 66, 11),
(327, 66, 1),
(330, 67, 11),
(331, 67, 1),
(332, 68, 11),
(333, 68, 1),
(336, 69, 11),
(337, 69, 1),
(340, 70, 11),
(341, 70, 1),
(354, 57, 11),
(355, 57, 1),
(356, 57, 10),
(360, 59, 11),
(361, 59, 1),
(362, 59, 10),
(366, 60, 11),
(367, 60, 1),
(368, 60, 10),
(370, 56, 11),
(371, 56, 1),
(372, 56, 10),
(373, 55, 11),
(374, 55, 1),
(375, 55, 10),
(377, 116, 6),
(378, 116, 1),
(379, 117, 4),
(380, 117, 1),
(381, 119, 4),
(382, 119, 1),
(383, 118, 4),
(384, 118, 1),
(387, 51, 9),
(388, 51, 1),
(389, 120, 9),
(390, 120, 1),
(393, 121, 4),
(394, 121, 1),
(422, 115, 15),
(423, 115, 1),
(424, 122, 14),
(425, 122, 1),
(436, 15, 15),
(437, 15, 9),
(438, 15, 17),
(439, 15, 1),
(440, 16, 15),
(441, 16, 9),
(442, 16, 17),
(443, 16, 1),
(447, 17, 15),
(448, 17, 9),
(449, 17, 17),
(450, 17, 1),
(451, 18, 15),
(452, 18, 9),
(453, 18, 17),
(454, 18, 1),
(455, 19, 15),
(456, 19, 9),
(457, 19, 17),
(458, 19, 1),
(459, 20, 15),
(460, 20, 9),
(461, 20, 17),
(462, 20, 1),
(463, 123, 14),
(464, 123, 15),
(465, 123, 1),
(467, 124, 15),
(468, 124, 1),
(469, 125, 15),
(470, 125, 1),
(473, 73, 12),
(474, 73, 1),
(475, 74, 12),
(476, 74, 1),
(509, 7, 8),
(510, 7, 5),
(511, 7, 4),
(512, 7, 1),
(513, 8, 6),
(514, 8, 8),
(515, 8, 5),
(516, 8, 4),
(517, 8, 1),
(520, 35, 7),
(521, 35, 9),
(522, 35, 1),
(523, 38, 7),
(524, 38, 9),
(525, 38, 1),
(533, 37, 7),
(534, 37, 9),
(535, 37, 1),
(536, 39, 7),
(537, 39, 9),
(538, 39, 1),
(539, 41, 7),
(540, 41, 9),
(541, 41, 1),
(548, 126, 8),
(549, 126, 1),
(550, 128, 7),
(551, 128, 9),
(552, 128, 1),
(553, 129, 7),
(554, 129, 9),
(555, 129, 1),
(556, 130, 8),
(557, 130, 5),
(558, 130, 1),
(559, 131, 8),
(560, 131, 5),
(561, 131, 1),
(563, 132, 2),
(564, 132, 6),
(565, 132, 3),
(566, 132, 7),
(567, 132, 14),
(568, 132, 8),
(569, 132, 15),
(570, 132, 9),
(571, 132, 11),
(572, 132, 18),
(573, 132, 5),
(574, 132, 12),
(575, 132, 16),
(576, 132, 17),
(577, 132, 4),
(578, 132, 1),
(579, 132, 13),
(580, 132, 10),
(581, 113, 7),
(582, 113, 8),
(583, 113, 9),
(584, 113, 18),
(585, 113, 1),
(594, 133, 18),
(595, 133, 1),
(597, 134, 18),
(598, 134, 1),
(601, 45, 7),
(602, 45, 8),
(603, 45, 9),
(604, 45, 1),
(605, 136, 1),
(606, 136, 10),
(607, 30, 4),
(608, 30, 1),
(615, 14, 7),
(616, 14, 15),
(617, 14, 9),
(618, 14, 17),
(619, 14, 4),
(620, 14, 1),
(621, 137, 9),
(622, 137, 1),
(626, 135, 18),
(627, 135, 1),
(628, 138, 9),
(629, 138, 1),
(630, 34, 7),
(631, 34, 1),
(636, 2, 15),
(637, 2, 1),
(638, 3, 15),
(639, 3, 1),
(640, 4, 15),
(641, 4, 1),
(648, 142, 9),
(649, 142, 1),
(656, 29, 6),
(657, 29, 7),
(658, 29, 1),
(665, 141, 9),
(666, 141, 4),
(667, 141, 1),
(671, 144, 4),
(672, 144, 1),
(673, 145, 7),
(674, 145, 9),
(675, 145, 1),
(676, 146, 15),
(677, 146, 16),
(678, 146, 1),
(682, 148, 11),
(683, 148, 1),
(690, 151, 3),
(691, 151, 1),
(700, 11, 8),
(701, 11, 15),
(702, 11, 5),
(703, 11, 16),
(704, 11, 4),
(705, 11, 1),
(706, 12, 8),
(707, 12, 5),
(708, 12, 4),
(709, 12, 1),
(710, 21, 9),
(711, 21, 5),
(712, 21, 4),
(713, 21, 1),
(714, 22, 9),
(715, 22, 5),
(716, 22, 4),
(717, 22, 1),
(722, 50, 9),
(723, 50, 1),
(724, 13, 6),
(725, 13, 7),
(726, 13, 15),
(727, 13, 9),
(728, 13, 17),
(729, 13, 1),
(754, 152, 3),
(755, 152, 1),
(756, 153, 15),
(757, 153, 1),
(758, 154, 15),
(759, 154, 1),
(760, 155, 15),
(761, 155, 1),
(762, 156, 12),
(763, 156, 1),
(764, 157, 3),
(765, 157, 1),
(777, 159, 6),
(778, 159, 9),
(779, 159, 4),
(780, 159, 1),
(785, 139, 9),
(786, 139, 1),
(787, 140, 9),
(788, 140, 1),
(791, 161, 6),
(792, 161, 4),
(793, 161, 1),
(794, 162, 14),
(795, 162, 1),
(799, 163, 9),
(800, 163, 1),
(803, 165, 14),
(804, 165, 15),
(805, 165, 1),
(816, 27, 6),
(817, 27, 7),
(818, 27, 16),
(819, 27, 4),
(820, 27, 1),
(821, 28, 16),
(822, 28, 4),
(823, 28, 1),
(824, 10, 8),
(825, 10, 5),
(826, 10, 16),
(827, 10, 4),
(828, 10, 1),
(829, 114, 6),
(830, 114, 16),
(831, 114, 1),
(832, 166, 6),
(833, 166, 1),
(834, 143, 6),
(835, 143, 4),
(836, 143, 1),
(838, 167, 11),
(839, 167, 1),
(840, 167, 10),
(841, 58, 1),
(844, 168, 9),
(845, 168, 1),
(847, 170, 11),
(848, 170, 1),
(849, 171, 11),
(850, 171, 1),
(857, 172, 11),
(858, 172, 1),
(859, 173, 11),
(860, 173, 1),
(861, 174, 11),
(862, 174, 1),
(865, 176, 11),
(866, 176, 1),
(867, 177, 11),
(868, 177, 1),
(871, 179, 11),
(872, 179, 1),
(873, 180, 11),
(874, 180, 1),
(877, 182, 11),
(878, 182, 1),
(879, 183, 11),
(880, 183, 1),
(883, 185, 11),
(884, 185, 1),
(885, 186, 11),
(886, 186, 1),
(889, 188, 11),
(890, 188, 1),
(899, 160, 7),
(900, 160, 9),
(901, 160, 1),
(902, 193, 14),
(903, 193, 1),
(912, 158, 3),
(913, 158, 11),
(914, 158, 12),
(915, 158, 1),
(923, 169, 11),
(924, 169, 1),
(925, 189, 11),
(926, 189, 1),
(938, 175, 11),
(939, 175, 1),
(940, 175, 10),
(941, 178, 11),
(942, 178, 1),
(943, 178, 10),
(944, 181, 11),
(945, 181, 1),
(946, 181, 10),
(947, 184, 11),
(948, 184, 1),
(949, 184, 10),
(950, 187, 11),
(951, 187, 1),
(952, 187, 10),
(953, 190, 11),
(954, 190, 1),
(955, 190, 10),
(963, 194, 11),
(964, 194, 1),
(965, 195, 11),
(966, 195, 1),
(972, 196, 12),
(973, 196, 1),
(974, 197, 11),
(975, 197, 1),
(978, 54, 11),
(979, 54, 1),
(980, 54, 10),
(981, 198, 11),
(982, 198, 1),
(983, 164, 11),
(984, 164, 1),
(985, 164, 10),
(986, 199, 3),
(987, 199, 1),
(997, 209, 11),
(998, 209, 1),
(1011, 207, 11),
(1012, 207, 1),
(1013, 205, 11),
(1014, 205, 1),
(1019, 210, 3),
(1020, 210, 1),
(1021, 192, 2),
(1022, 192, 21),
(1023, 192, 6),
(1024, 192, 3),
(1025, 192, 19),
(1026, 192, 7),
(1027, 192, 14),
(1028, 192, 8),
(1029, 192, 15),
(1030, 192, 22),
(1031, 192, 9),
(1032, 192, 11),
(1033, 192, 18),
(1034, 192, 5),
(1035, 192, 12),
(1036, 192, 16),
(1037, 192, 17),
(1038, 192, 4),
(1039, 192, 1),
(1040, 192, 13),
(1041, 192, 10),
(1047, 48, 8),
(1048, 48, 5),
(1049, 48, 1),
(1050, 46, 8),
(1051, 46, 1),
(1054, 213, 6),
(1055, 213, 4),
(1056, 213, 1),
(1059, 211, 7),
(1060, 211, 14),
(1061, 211, 9),
(1062, 211, 24),
(1063, 211, 1),
(1069, 49, 7),
(1070, 49, 9),
(1071, 49, 25),
(1072, 49, 1),
(1076, 214, 1),
(1081, 33, 7),
(1082, 33, 9),
(1083, 33, 1),
(1084, 90, 6),
(1085, 90, 7),
(1086, 90, 15),
(1087, 90, 22),
(1088, 90, 16),
(1089, 90, 1),
(1090, 96, 2),
(1091, 96, 6),
(1092, 96, 7),
(1093, 96, 15),
(1094, 96, 22),
(1095, 96, 16),
(1096, 96, 4),
(1097, 96, 1),
(1098, 1, 6),
(1099, 1, 8),
(1100, 1, 15),
(1101, 1, 23),
(1102, 1, 11),
(1103, 1, 5),
(1104, 1, 16),
(1105, 1, 4),
(1106, 1, 1),
(1107, 9, 8),
(1108, 9, 23),
(1109, 9, 5),
(1110, 9, 4),
(1111, 9, 1),
(1113, 95, 15),
(1114, 95, 22),
(1115, 95, 16),
(1116, 95, 1),
(1120, 200, 14),
(1121, 200, 16),
(1122, 200, 17),
(1123, 200, 1),
(1124, 147, 15),
(1125, 147, 22),
(1126, 147, 16),
(1127, 147, 1),
(1128, 201, 14),
(1129, 201, 17),
(1130, 201, 1),
(1131, 202, 14),
(1132, 202, 16),
(1133, 202, 17),
(1134, 202, 1),
(1135, 203, 14),
(1136, 203, 16),
(1137, 203, 17),
(1138, 203, 1),
(1139, 204, 14),
(1140, 204, 16),
(1141, 204, 17),
(1142, 204, 1),
(1143, 206, 14),
(1144, 206, 16),
(1145, 206, 17),
(1146, 206, 1),
(1147, 208, 14),
(1148, 208, 16),
(1149, 208, 17),
(1150, 208, 1),
(1152, 215, 27),
(1153, 215, 1),
(1154, 216, 28),
(1155, 216, 1),
(1156, 217, 1),
(1157, 218, 2),
(1158, 218, 28),
(1159, 218, 21),
(1160, 218, 6),
(1161, 218, 3),
(1162, 218, 19),
(1163, 218, 7),
(1164, 218, 14),
(1165, 218, 8),
(1166, 218, 15),
(1167, 218, 23),
(1168, 218, 22),
(1169, 218, 9),
(1170, 218, 25),
(1171, 218, 11),
(1172, 218, 27),
(1173, 218, 18),
(1174, 218, 26),
(1175, 218, 5),
(1176, 218, 24),
(1177, 218, 12),
(1178, 218, 16),
(1179, 218, 17),
(1180, 218, 4),
(1181, 218, 1),
(1182, 218, 13),
(1183, 218, 10),
(1184, 219, 9),
(1185, 219, 1),
(1186, 220, 1),
(1187, 212, 23),
(1188, 212, 1),
(1191, 191, 15),
(1192, 191, 25),
(1193, 191, 1),
(1200, 221, 9),
(1201, 221, 29),
(1202, 221, 1),
(1203, 222, 9),
(1204, 222, 11),
(1205, 222, 1),
(1206, 222, 10),
(1207, 223, 11),
(1208, 223, 1),
(1209, 223, 10),
(1210, 224, 11),
(1211, 224, 1),
(1212, 224, 10),
(1213, 225, 11),
(1214, 225, 1),
(1215, 225, 10),
(1216, 226, 11),
(1217, 226, 1),
(1218, 227, 1),
(1223, 231, 1),
(1224, 231, 10),
(1225, 230, 1),
(1226, 230, 10),
(1228, 232, 1),
(1229, 233, 1),
(1230, 228, 14),
(1231, 228, 1),
(1232, 234, 14),
(1233, 234, 15),
(1234, 234, 1),
(1236, 236, 1),
(1240, 235, 11),
(1241, 235, 1),
(1242, 235, 10),
(1243, 237, 9),
(1244, 237, 1),
(1246, 238, 3),
(1247, 238, 1),
(1248, 239, 3),
(1249, 239, 1),
(1251, 241, 1),
(1252, 242, 1),
(1255, 240, 3),
(1256, 240, 1),
(1257, 243, 1),
(1259, 244, 1),
(1262, 245, 3),
(1263, 245, 1),
(1264, 246, 1),
(1265, 247, 1),
(1266, 248, 1),
(1267, 249, 1),
(1268, 250, 1),
(1269, 251, 1),
(1270, 252, 1),
(1273, 254, 1),
(1274, 255, 1),
(1275, 256, 1),
(1276, 257, 1),
(1277, 258, 1),
(1278, 259, 1),
(1280, 261, 1),
(1281, 262, 1),
(1282, 260, 1),
(1283, 263, 1),
(1284, 264, 1),
(1285, 265, 1),
(1287, 266, 1),
(1289, 268, 1),
(1290, 269, 1),
(1291, 270, 1),
(1292, 253, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk_spare_part`
--

CREATE TABLE `merk_spare_part` (
  `id_merk` int(11) NOT NULL,
  `nama_merk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_spare_part`
--

CREATE TABLE `nama_spare_part` (
  `id_nama_spare_part` int(11) NOT NULL,
  `nama_spare_part` varchar(255) NOT NULL,
  `no_seri` varchar(255) NOT NULL,
  `stok_minimal` int(11) NOT NULL,
  `nama_rak` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_penjualan`
--

CREATE TABLE `return_penjualan` (
  `id_return` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `nama_spare_part` varchar(255) NOT NULL,
  `no_seri` varchar(255) NOT NULL,
  `merk_spare_part` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `setelah_diskon` int(11) NOT NULL,
  `keterangan_return` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spare_part`
--

CREATE TABLE `spare_part` (
  `id_spare_part` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `jumlah_belanja` int(11) NOT NULL,
  `jns_pembayaran` int(3) NOT NULL,
  `no_nota_masuk` varchar(100) NOT NULL,
  `no_nota_supplier` varchar(100) NOT NULL,
  `dp` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `status_tempo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spare_part_detail`
--

CREATE TABLE `spare_part_detail` (
  `id_spare_part_detail` int(11) NOT NULL,
  `id_nama_spare_part` int(11) NOT NULL,
  `id_merk_spare_part` int(11) NOT NULL,
  `id_spare_part` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_rak` varchar(255) NOT NULL,
  `status_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spare_part_stok`
--

CREATE TABLE `spare_part_stok` (
  `id_spare_part_stok` int(11) NOT NULL,
  `nama_spare_part` varchar(150) NOT NULL,
  `no_seri` varchar(100) NOT NULL,
  `nama_rak` varchar(200) NOT NULL,
  `stok` int(11) NOT NULL,
  `merk_spare_part` varchar(150) NOT NULL,
  `id_spare_part_detail` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_role`
--

CREATE TABLE `system_role` (
  `id_system_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `system_role`
--

INSERT INTO `system_role` (`id_system_role`, `nama_role`) VALUES
(1, 'SYSTEM ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uom`
--

CREATE TABLE `uom` (
  `id_uom` int(11) NOT NULL,
  `uom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_user_role` int(11) NOT NULL,
  `id_system_role` int(11) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_user_role`, `id_system_role`, `id_login`) VALUES
(510, 7, 70),
(797, 12, 86),
(796, 11, 86),
(549, 13, 6),
(118, 2, 2),
(207, 4, 4),
(548, 1, 6),
(74, 13, 5),
(73, 1, 5),
(72, 4, 5),
(71, 12, 5),
(70, 5, 5),
(69, 11, 5),
(68, 9, 5),
(67, 8, 5),
(66, 14, 5),
(65, 7, 5),
(64, 3, 5),
(63, 6, 5),
(62, 2, 5),
(75, 10, 5),
(206, 17, 4),
(205, 16, 4),
(204, 12, 4),
(203, 5, 4),
(202, 11, 4),
(201, 9, 4),
(200, 15, 4),
(199, 8, 4),
(198, 14, 4),
(197, 7, 4),
(196, 3, 4),
(195, 6, 4),
(194, 2, 4),
(795, 3, 86),
(702, 18, 58),
(706, 18, 59),
(685, 10, 34),
(1119, 9, 80),
(936, 9, 20),
(988, 25, 31),
(1242, 25, 123),
(1109, 10, 23),
(661, 1, 1),
(119, 6, 2),
(120, 3, 2),
(121, 7, 2),
(122, 14, 2),
(123, 8, 2),
(124, 9, 2),
(125, 11, 2),
(126, 5, 2),
(127, 12, 2),
(128, 4, 2),
(129, 1, 2),
(130, 13, 2),
(131, 10, 2),
(547, 4, 6),
(546, 12, 6),
(545, 5, 6),
(544, 11, 6),
(543, 9, 6),
(542, 8, 6),
(541, 14, 6),
(540, 7, 6),
(539, 19, 6),
(538, 3, 6),
(537, 6, 6),
(536, 2, 6),
(1207, 25, 54),
(218, 8, 8),
(594, 1, 62),
(741, 17, 10),
(169, 17, 11),
(399, 7, 12),
(602, 9, 13),
(1013, 18, 14),
(1203, 4, 118),
(912, 9, 17),
(233, 10, 18),
(611, 12, 19),
(1108, 4, 23),
(561, 12, 68),
(463, 1, 22),
(217, 6, 8),
(486, 1, 3),
(610, 11, 19),
(1107, 12, 23),
(482, 14, 67),
(208, 1, 4),
(209, 13, 4),
(210, 10, 4),
(670, 1, 28),
(214, 1, 29),
(701, 3, 58),
(609, 23, 19),
(219, 5, 8),
(220, 4, 8),
(987, 9, 31),
(489, 11, 32),
(235, 10, 33),
(684, 4, 34),
(683, 12, 34),
(300, 18, 35),
(1118, 7, 80),
(592, 1, 36),
(1313, 1, 38),
(240, 2, 39),
(241, 6, 40),
(242, 3, 41),
(243, 7, 42),
(245, 14, 43),
(246, 14, 44),
(247, 15, 46),
(248, 9, 47),
(249, 4, 48),
(258, 4, 49),
(298, 19, 50),
(297, 21, 50),
(257, 6, 49),
(478, 4, 30),
(477, 6, 30),
(475, 4, 24),
(474, 6, 24),
(473, 2, 24),
(640, 9, 1),
(299, 1, 50),
(301, 4, 35),
(302, 6, 51),
(303, 4, 51),
(304, 14, 52),
(305, 15, 52),
(306, 14, 53),
(307, 16, 53),
(1206, 9, 54),
(1205, 8, 54),
(353, 4, 55),
(352, 4, 7),
(1204, 6, 54),
(359, 10, 56),
(899, 7, 57),
(740, 16, 10),
(739, 11, 10),
(476, 2, 30),
(700, 6, 58),
(705, 3, 59),
(704, 6, 59),
(378, 10, 60),
(392, 14, 61),
(393, 15, 61),
(394, 16, 61),
(395, 17, 61),
(1022, 24, 9),
(1021, 9, 9),
(400, 9, 12),
(1020, 7, 9),
(593, 19, 62),
(1199, 4, 15),
(1198, 25, 15),
(986, 22, 31),
(428, 17, 63),
(427, 16, 63),
(426, 15, 63),
(425, 14, 63),
(429, 1, 63),
(430, 10, 64),
(431, 10, 65),
(615, 12, 66),
(614, 11, 66),
(613, 23, 66),
(490, 12, 32),
(1227, 4, 69),
(512, 2, 71),
(513, 6, 71),
(514, 4, 71),
(516, 9, 72),
(1310, 1, 16),
(521, 11, 73),
(522, 12, 73),
(550, 10, 6),
(935, 7, 20),
(528, 10, 74),
(1226, 25, 69),
(1225, 9, 69),
(618, 10, 75),
(560, 11, 68),
(562, 10, 68),
(1012, 27, 14),
(1011, 9, 14),
(570, 3, 77),
(571, 3, 78),
(573, 9, 76),
(579, 9, 79),
(1312, 1, 37),
(597, 22, 81),
(738, 9, 10),
(608, 11, 82),
(612, 10, 19),
(616, 10, 66),
(619, 24, 83),
(682, 11, 34),
(681, 9, 34),
(1019, 6, 9),
(632, 11, 84),
(633, 12, 84),
(634, 10, 84),
(794, 28, 86),
(703, 4, 58),
(707, 4, 59),
(1006, 3, 87),
(1005, 6, 87),
(725, 3, 88),
(724, 2, 88),
(993, 26, 89),
(992, 3, 89),
(923, 3, 90),
(922, 2, 90),
(718, 18, 91),
(719, 2, 92),
(720, 3, 92),
(1004, 28, 87),
(726, 26, 88),
(727, 22, 93),
(737, 14, 10),
(789, 4, 94),
(1010, 7, 14),
(788, 24, 94),
(787, 27, 94),
(786, 11, 94),
(753, 27, 95),
(991, 2, 89),
(934, 10, 96),
(1117, 6, 80),
(985, 7, 31),
(769, 27, 97),
(770, 27, 98),
(771, 27, 99),
(772, 10, 100),
(785, 7, 94),
(784, 6, 94),
(790, 27, 101),
(791, 27, 102),
(895, 27, 103),
(798, 10, 86),
(799, 27, 104),
(1003, 2, 87),
(1106, 24, 23),
(1105, 11, 23),
(815, 27, 105),
(984, 6, 31),
(933, 4, 96),
(932, 24, 96),
(931, 27, 96),
(930, 11, 96),
(929, 7, 96),
(928, 6, 96),
(962, 4, 21),
(898, 2, 57),
(900, 9, 57),
(901, 11, 57),
(902, 27, 57),
(903, 10, 57),
(1197, 9, 15),
(913, 27, 106),
(961, 9, 21),
(960, 7, 21),
(959, 6, 21),
(920, 7, 107),
(1177, 4, 116),
(924, 14, 90),
(925, 16, 90),
(926, 22, 109),
(927, 27, 110),
(973, 18, 111),
(972, 3, 111),
(971, 6, 111),
(943, 3, 112),
(942, 2, 112),
(970, 2, 111),
(1104, 9, 23),
(1103, 22, 23),
(1196, 7, 15),
(1057, 4, 113),
(969, 9, 114),
(974, 4, 111),
(1037, 9, 115),
(1036, 22, 115),
(1035, 6, 115),
(989, 27, 31),
(990, 4, 31),
(1102, 23, 23),
(1007, 18, 87),
(1008, 26, 87),
(1009, 4, 87),
(1014, 5, 14),
(1015, 12, 14),
(1016, 10, 14),
(1175, 22, 116),
(1023, 4, 9),
(1115, 9, 117),
(1202, 9, 118),
(1056, 9, 113),
(1063, 14, 119),
(1055, 22, 113),
(1038, 24, 115),
(1039, 4, 115),
(1114, 7, 117),
(1113, 6, 117),
(1112, 2, 117),
(1176, 24, 116),
(1171, 4, 108),
(1170, 9, 108),
(1201, 22, 118),
(1054, 6, 113),
(1062, 7, 119),
(1061, 6, 119),
(1064, 9, 119),
(1066, 24, 121),
(1068, 1, 122),
(1101, 6, 23),
(1100, 2, 23),
(1241, 9, 123),
(1116, 4, 117),
(1120, 25, 80),
(1121, 10, 80),
(1122, 23, 124),
(1123, 11, 124),
(1124, 10, 124),
(1125, 23, 125),
(1126, 11, 125),
(1127, 10, 125),
(1141, 10, 126),
(1140, 4, 126),
(1139, 25, 126),
(1138, 9, 126),
(1137, 22, 126),
(1136, 6, 126),
(1135, 2, 126),
(1169, 22, 108),
(1168, 7, 108),
(1167, 6, 108),
(1166, 2, 108),
(1174, 7, 116),
(1173, 6, 116),
(1172, 2, 116),
(1200, 6, 118),
(1195, 6, 15),
(1194, 2, 15),
(1224, 22, 69),
(1223, 7, 69),
(1222, 6, 69),
(1208, 5, 54),
(1209, 4, 54),
(1237, 5, 127),
(1236, 11, 127),
(1235, 9, 127),
(1234, 23, 127),
(1233, 2, 127),
(1238, 12, 127),
(1239, 10, 127),
(1240, 29, 132),
(1243, 1, 123),
(1276, 28, 136),
(1275, 2, 136),
(1274, 1, 134),
(1308, 10, 135),
(1307, 11, 135),
(1306, 25, 135),
(1305, 9, 135),
(1304, 7, 135),
(1303, 2, 135),
(1277, 21, 136),
(1278, 6, 136),
(1279, 3, 136),
(1280, 19, 136),
(1281, 7, 136),
(1282, 14, 136),
(1283, 8, 136),
(1284, 15, 136),
(1285, 23, 136),
(1286, 22, 136),
(1287, 9, 136),
(1288, 25, 136),
(1289, 11, 136),
(1290, 27, 136),
(1291, 18, 136),
(1292, 26, 136),
(1293, 5, 136),
(1294, 24, 136),
(1295, 12, 136),
(1296, 29, 136),
(1297, 16, 136),
(1298, 17, 136),
(1299, 4, 136),
(1300, 1, 136),
(1301, 13, 136),
(1302, 10, 136),
(1309, 1, 166);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id_invoice_detail`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `menu_navigasi`
--
ALTER TABLE `menu_navigasi`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `menu_navigasi_role`
--
ALTER TABLE `menu_navigasi_role`
  ADD PRIMARY KEY (`id_menu_role`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_system_role` (`id_system_role`);

--
-- Indeks untuk tabel `merk_spare_part`
--
ALTER TABLE `merk_spare_part`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indeks untuk tabel `nama_spare_part`
--
ALTER TABLE `nama_spare_part`
  ADD PRIMARY KEY (`id_nama_spare_part`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `return_penjualan`
--
ALTER TABLE `return_penjualan`
  ADD PRIMARY KEY (`id_return`);

--
-- Indeks untuk tabel `spare_part`
--
ALTER TABLE `spare_part`
  ADD PRIMARY KEY (`id_spare_part`);

--
-- Indeks untuk tabel `spare_part_detail`
--
ALTER TABLE `spare_part_detail`
  ADD PRIMARY KEY (`id_spare_part_detail`);

--
-- Indeks untuk tabel `spare_part_stok`
--
ALTER TABLE `spare_part_stok`
  ADD PRIMARY KEY (`id_spare_part_stok`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `system_role`
--
ALTER TABLE `system_role`
  ADD PRIMARY KEY (`id_system_role`);

--
-- Indeks untuk tabel `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id_uom`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_user_role`),
  ADD KEY `id_system_role` (`id_system_role`),
  ADD KEY `id_login` (`id_login`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id_invoice_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `menu_navigasi`
--
ALTER TABLE `menu_navigasi`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT untuk tabel `menu_navigasi_role`
--
ALTER TABLE `menu_navigasi_role`
  MODIFY `id_menu_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1293;

--
-- AUTO_INCREMENT untuk tabel `merk_spare_part`
--
ALTER TABLE `merk_spare_part`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nama_spare_part`
--
ALTER TABLE `nama_spare_part`
  MODIFY `id_nama_spare_part` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `return_penjualan`
--
ALTER TABLE `return_penjualan`
  MODIFY `id_return` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spare_part`
--
ALTER TABLE `spare_part`
  MODIFY `id_spare_part` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spare_part_detail`
--
ALTER TABLE `spare_part_detail`
  MODIFY `id_spare_part_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spare_part_stok`
--
ALTER TABLE `spare_part_stok`
  MODIFY `id_spare_part_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `system_role`
--
ALTER TABLE `system_role`
  MODIFY `id_system_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `uom`
--
ALTER TABLE `uom`
  MODIFY `id_uom` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
