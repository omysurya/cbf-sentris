/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MariaDB
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : crudbooster

 Target Server Type    : MariaDB
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 07/04/2021 10:41:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for app_sessions
-- ----------------------------
DROP TABLE IF EXISTS `app_sessions`;
CREATE TABLE `app_sessions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_devisi` int(11) NULL DEFAULT NULL,
  `id_kategori_berita` int(11) NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `distribution` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_berita_kategori` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berita
-- ----------------------------
INSERT INTO `berita` VALUES (1, '2018-09-14 10:49:45', '2018-09-14 11:00:05', NULL, 1606, NULL, NULL, 'About SenTris Brand Presenter', '<p><b><u>About</u></b></p><p>SenTris adalah sistem penunjang untuk mempermudah proses pelaporan data dan kegiatan Anda secara harian. SenTris merupakan kependekan dari Sales &amp; Tracking system yang dikembangkan oleh PT. Pharmasolindo.</p><p><u><b>How to Use ?</b></u></p><p>Untuk mendapatkan akses ke sistem ini Anda harus sudah didaftarkan oleh Administrator sistem ini sesuai divisi masing-masing, kemudian anda bisa unduh Aplikasi ini langsung dari <a href=\"https://bp.phs.co.id/installer/app-debug.apk\">https://bp.phs.co.id/installer/app-debug.apk</a>&nbsp;&nbsp;dan klik file Android Installer versi terbaru.</p><p>Aplikasi SenTris ini hanya bisa diinstall di Smartphone berbasis Android dengan minimal RAM 1 GB dan versi Android 4 (Kitkat)</p><p>Seluruh kegiatan pelaporan (entry data) yang tidak bisa dilakukan di aplikasi SenTris Brand Presenter hanya bisa dilakukan dengan membuka melalui peramban (Browser) disarankan memakai browser Chrome dengan alamat website <a href=\"https://bp.phs.co.id\">https://bp.phs.co.id</a><a href=\"https://bp.phs.co.id\"></a>&nbsp;jika ada notifikasi dari Browser untuk meminta akses lokasi wajib untuk memberikan akses dengan memilih tap menu Terima (Allow).</p><p><u><b>How to works ?</b></u></p><p>Ada beberapa core proses yang harus anda lakukan setiap berkala yang terdiri dari:</p><ol><li><b>Monthly</b><br>Kegiatan yang wajib anda lakukan adalah membuat Planing Visit (dilakukan setiap awal bulan) untuk tiap-tiap data Outlet di Area (Kota Reguler) masing-masing yang sebelumnya telah dikirim ke Admin Pusat untuk dimasukan ke sistem SenTris, Format pengisian Outlet baru yang belum ada di SenTris bisa di unduh melalui <a href=\"https://bp.phs.co.id/installer/Format-Outlet-Baru.xlsx\">https://bp.phs.co.id/installer/Format-Outlet-Baru.xlsx</a>&nbsp;pilih dokumen Format Outlet (Microsoft Excel).<br><br></li><li><b>Daily</b><br>- Melakukan Visit ke Outlet masing-masing yang sudah direncanakan dengan mengisi data Sesuai Form Visit Outlet.<br>- Melakukan Entri pelaporan Stok Produk (Awal dan Akhir sebelum pulang) di Outlet yang sedang dikunjungi.<br>- Melakukan Entri pelaporan Penjualan produk dengan menyertakan bukti penjualan yang syah (Ex: Struk / Nota Penjualan Produk)<br>- Mengisi daftar Customer yang membeli Produk di Outlet yang sedang dikunjungi tersebut di Form Report Penjualan.<br>- Melakukan absensi Pulang setelah proses pelaporan (Stok &amp; Penjualan) selesai (Sesuai Jam Kerja) melalui menu Absensi (Logout via Aplikasi SenTris)<br><br></li><li><b>Incidently</b><br>Anda bisa melakuan report yang bersifat urgensi (Darurat) seperti pengajuan Absensi (Sakit / Cuti) melalui Aplikasi.<br><br></li></ol><p><b><u>You Must Know !!</u></b></p><p>Setiap aktivitas yang anda lakukan posisi Anda akan terrekam secara berkala demi kepentingan management dalam mempertimbangkan kinerja Anda, untuk itu pastikan GPS Anda harus selalu aktif selama Jam kerja berlangsung. Jika terjadi masalah / error dalam aplikasi segera laporkan kepada IT Support agar bisa segera tertangani.</p><p><b><u>You Must Keep !!</u></b></p><p>Simpan username dan password anda dengan baik, jangan sampai orang lain mengetahuinya. Pastikan logout dari aplikasi setiap anda selesai menggunakan website <a href=\"https://bp.phs.co.id.\">https://bp.phs.co.id.</a></p><p><br></p><p><i style=\"\"><b><u>Salam Sukses</u><br></b></i><b>IT Dev</b></p>', 'ALL', 'publish', 1);

-- ----------------------------
-- Table structure for berita_kategori
-- ----------------------------
DROP TABLE IF EXISTS `berita_kategori`;
CREATE TABLE `berita_kategori`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berita_kategori
-- ----------------------------
INSERT INTO `berita_kategori` VALUES (1, '2017-12-04 08:44:39', NULL, NULL, 'Info');
INSERT INTO `berita_kategori` VALUES (2, '2020-04-24 10:31:17', NULL, NULL, 'News');

-- ----------------------------
-- Table structure for devisi
-- ----------------------------
DROP TABLE IF EXISTS `devisi`;
CREATE TABLE `devisi`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_upline_devisi` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_nsm` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_divisi`(`id`, `deleted_at`, `id_nsm`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of devisi
-- ----------------------------
INSERT INTO `devisi` VALUES (1, NULL, '2017-05-17 02:57:26', '2017-12-04 08:09:14', 0, 'KOSMETIK', NULL);
INSERT INTO `devisi` VALUES (2, '2017-05-12 23:34:10', '2017-05-17 02:56:58', '2019-06-13 10:06:02', 0, 'ETHICAL', 2555);
INSERT INTO `devisi` VALUES (3, '2017-05-17 02:57:41', NULL, '2017-12-04 08:09:22', 0, 'OTC', NULL);
INSERT INTO `devisi` VALUES (4, '2017-05-17 02:57:52', NULL, '2019-04-01 09:52:48', 0, 'OGB', NULL);
INSERT INTO `devisi` VALUES (5, '2017-05-17 02:58:09', NULL, '2017-07-25 09:39:29', 0, 'ALL', NULL);
INSERT INTO `devisi` VALUES (6, '2017-12-04 08:10:20', '2019-06-09 13:00:08', NULL, 0, 'HO', 2380);
INSERT INTO `devisi` VALUES (7, '2019-04-01 09:52:30', NULL, NULL, 0, 'PLASMA', 2799);
INSERT INTO `devisi` VALUES (8, '2019-04-01 09:52:30', NULL, NULL, 0, 'ONKOLOGI', 2799);
INSERT INTO `devisi` VALUES (9, '2019-04-26 11:10:24', NULL, NULL, 0, 'REGULER', 2555);
INSERT INTO `devisi` VALUES (10, NULL, NULL, NULL, 0, 'ONKO + PLASMA', 2799);

-- ----------------------------
-- Table structure for kalendar_event
-- ----------------------------
DROP TABLE IF EXISTS `kalendar_event`;
CREATE TABLE `kalendar_event`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_devisi` int(11) NULL DEFAULT NULL,
  `nama_bulan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bulan_ke` int(11) NULL DEFAULT NULL,
  `tahun` int(11) NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kalendar_libur
-- ----------------------------
DROP TABLE IF EXISTS `kalendar_libur`;
CREATE TABLE `kalendar_libur`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tahun` int(11) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jenis_kelamin` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_provinsi` int(11) NULL DEFAULT NULL,
  `id_kota` int(11) NULL DEFAULT NULL,
  `id_kota_reguler` int(11) NOT NULL,
  `id_devisi` int(11) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `regid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(2) NULL DEFAULT NULL COMMENT 'Status Karyawan 1=Aktif, 0=Sudah keluar',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3428 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (3427, NULL, NULL, NULL, '00000', 'css/profile.png', 'Super Administrator', NULL, NULL, NULL, '0', 'matrislab@example.com', 'Jakarta', NULL, NULL, 0, 0, NULL, NULL, 1);

-- ----------------------------
-- Table structure for kota_reguler
-- ----------------------------
DROP TABLE IF EXISTS `kota_reguler`;
CREATE TABLE `kota_reguler`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_provinsi` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9488 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kota_reguler
-- ----------------------------
INSERT INTO `kota_reguler` VALUES (1101, NULL, NULL, NULL, 11, 'KABUPATEN SIMEULUE');
INSERT INTO `kota_reguler` VALUES (1102, NULL, NULL, NULL, 11, 'KABUPATEN ACEH SINGKIL');
INSERT INTO `kota_reguler` VALUES (1103, NULL, NULL, NULL, 11, 'KABUPATEN ACEH SELATAN');
INSERT INTO `kota_reguler` VALUES (1104, NULL, NULL, NULL, 11, 'KABUPATEN ACEH TENGGARA');
INSERT INTO `kota_reguler` VALUES (1105, NULL, NULL, NULL, 11, 'KABUPATEN ACEH TIMUR');
INSERT INTO `kota_reguler` VALUES (1106, NULL, NULL, NULL, 11, 'KABUPATEN ACEH TENGAH');
INSERT INTO `kota_reguler` VALUES (1107, NULL, NULL, NULL, 11, 'KABUPATEN ACEH BARAT');
INSERT INTO `kota_reguler` VALUES (1108, NULL, NULL, NULL, 11, 'KABUPATEN ACEH BESAR');
INSERT INTO `kota_reguler` VALUES (1109, NULL, NULL, NULL, 11, 'KABUPATEN PIDIE');
INSERT INTO `kota_reguler` VALUES (1110, NULL, NULL, NULL, 11, 'KABUPATEN BIREUEN');
INSERT INTO `kota_reguler` VALUES (1111, NULL, NULL, NULL, 11, 'KABUPATEN ACEH UTARA');
INSERT INTO `kota_reguler` VALUES (1112, NULL, NULL, NULL, 11, 'KABUPATEN ACEH BARAT DAYA');
INSERT INTO `kota_reguler` VALUES (1113, NULL, NULL, NULL, 11, 'KABUPATEN GAYO LUES');
INSERT INTO `kota_reguler` VALUES (1114, NULL, NULL, NULL, 11, 'KABUPATEN ACEH TAMIANG');
INSERT INTO `kota_reguler` VALUES (1115, NULL, NULL, NULL, 11, 'KABUPATEN NAGAN RAYA');
INSERT INTO `kota_reguler` VALUES (1116, NULL, NULL, NULL, 11, 'KABUPATEN ACEH JAYA');
INSERT INTO `kota_reguler` VALUES (1117, NULL, NULL, NULL, 11, 'KABUPATEN BENER MERIAH');
INSERT INTO `kota_reguler` VALUES (1118, NULL, NULL, NULL, 11, 'KABUPATEN PIDIE JAYA');
INSERT INTO `kota_reguler` VALUES (1171, NULL, NULL, NULL, 11, 'KOTA BANDA ACEH');
INSERT INTO `kota_reguler` VALUES (1172, NULL, NULL, NULL, 11, 'KOTA SABANG');
INSERT INTO `kota_reguler` VALUES (1173, NULL, NULL, NULL, 11, 'KOTA LANGSA');
INSERT INTO `kota_reguler` VALUES (1174, NULL, NULL, NULL, 11, 'KOTA LHOKSEUMAWE');
INSERT INTO `kota_reguler` VALUES (1175, NULL, NULL, NULL, 11, 'KOTA SUBULUSSALAM');
INSERT INTO `kota_reguler` VALUES (1201, NULL, NULL, NULL, 12, 'KABUPATEN NIAS');
INSERT INTO `kota_reguler` VALUES (1202, NULL, NULL, NULL, 12, 'KABUPATEN MANDAILING NATAL');
INSERT INTO `kota_reguler` VALUES (1203, NULL, NULL, NULL, 12, 'KABUPATEN TAPANULI SELATAN');
INSERT INTO `kota_reguler` VALUES (1204, NULL, NULL, NULL, 12, 'KABUPATEN TAPANULI TENGAH');
INSERT INTO `kota_reguler` VALUES (1205, NULL, NULL, NULL, 12, 'KABUPATEN TAPANULI UTARA');
INSERT INTO `kota_reguler` VALUES (1206, NULL, NULL, NULL, 12, 'KABUPATEN TOBA SAMOSIR');
INSERT INTO `kota_reguler` VALUES (1207, NULL, NULL, NULL, 12, 'KABUPATEN LABUHAN BATU');
INSERT INTO `kota_reguler` VALUES (1208, NULL, NULL, NULL, 12, 'KABUPATEN ASAHAN');
INSERT INTO `kota_reguler` VALUES (1209, NULL, NULL, NULL, 12, 'KABUPATEN SIMALUNGUN');
INSERT INTO `kota_reguler` VALUES (1210, NULL, NULL, NULL, 12, 'KABUPATEN DAIRI');
INSERT INTO `kota_reguler` VALUES (1211, NULL, NULL, NULL, 12, 'KABUPATEN KARO');
INSERT INTO `kota_reguler` VALUES (1212, NULL, NULL, NULL, 12, 'KABUPATEN DELI SERDANG');
INSERT INTO `kota_reguler` VALUES (1213, NULL, NULL, NULL, 12, 'KABUPATEN LANGKAT');
INSERT INTO `kota_reguler` VALUES (1214, NULL, NULL, NULL, 12, 'KABUPATEN NIAS SELATAN');
INSERT INTO `kota_reguler` VALUES (1215, NULL, NULL, NULL, 12, 'KABUPATEN HUMBANG HASUNDUTAN');
INSERT INTO `kota_reguler` VALUES (1216, NULL, NULL, NULL, 12, 'KABUPATEN PAKPAK BHARAT');
INSERT INTO `kota_reguler` VALUES (1217, NULL, NULL, NULL, 12, 'KABUPATEN SAMOSIR');
INSERT INTO `kota_reguler` VALUES (1218, NULL, NULL, NULL, 12, 'KABUPATEN SERDANG BEDAGAI');
INSERT INTO `kota_reguler` VALUES (1219, NULL, NULL, NULL, 12, 'KABUPATEN BATU BARA');
INSERT INTO `kota_reguler` VALUES (1220, NULL, NULL, NULL, 12, 'KABUPATEN PADANG LAWAS UTARA');
INSERT INTO `kota_reguler` VALUES (1221, NULL, NULL, NULL, 12, 'KABUPATEN PADANG LAWAS');
INSERT INTO `kota_reguler` VALUES (1222, NULL, NULL, NULL, 12, 'KABUPATEN LABUHAN BATU SELATAN');
INSERT INTO `kota_reguler` VALUES (1223, NULL, NULL, NULL, 12, 'KABUPATEN LABUHAN BATU UTARA');
INSERT INTO `kota_reguler` VALUES (1224, NULL, NULL, NULL, 12, 'KABUPATEN NIAS UTARA');
INSERT INTO `kota_reguler` VALUES (1225, NULL, NULL, NULL, 12, 'KABUPATEN NIAS BARAT');
INSERT INTO `kota_reguler` VALUES (1271, NULL, NULL, NULL, 12, 'KOTA SIBOLGA');
INSERT INTO `kota_reguler` VALUES (1272, NULL, NULL, NULL, 12, 'KOTA TANJUNG BALAI');
INSERT INTO `kota_reguler` VALUES (1273, NULL, NULL, NULL, 12, 'KOTA PEMATANG SIANTAR');
INSERT INTO `kota_reguler` VALUES (1274, NULL, NULL, NULL, 12, 'KOTA TEBING TINGGI');
INSERT INTO `kota_reguler` VALUES (1275, NULL, NULL, NULL, 12, 'KOTA MEDAN');
INSERT INTO `kota_reguler` VALUES (1276, NULL, NULL, NULL, 12, 'KOTA BINJAI');
INSERT INTO `kota_reguler` VALUES (1277, NULL, NULL, NULL, 12, 'KOTA PADANGSIDIMPUAN');
INSERT INTO `kota_reguler` VALUES (1278, NULL, NULL, NULL, 12, 'KOTA GUNUNGSITOLI');
INSERT INTO `kota_reguler` VALUES (1301, NULL, NULL, NULL, 13, 'KABUPATEN KEPULAUAN MENTAWAI');
INSERT INTO `kota_reguler` VALUES (1302, NULL, NULL, NULL, 13, 'KABUPATEN PESISIR SELATAN');
INSERT INTO `kota_reguler` VALUES (1303, NULL, NULL, NULL, 13, 'KABUPATEN SOLOK');
INSERT INTO `kota_reguler` VALUES (1304, NULL, NULL, NULL, 13, 'KABUPATEN SIJUNJUNG');
INSERT INTO `kota_reguler` VALUES (1305, NULL, NULL, NULL, 13, 'KABUPATEN TANAH DATAR');
INSERT INTO `kota_reguler` VALUES (1306, NULL, NULL, NULL, 13, 'KABUPATEN PADANG PARIAMAN');
INSERT INTO `kota_reguler` VALUES (1307, NULL, NULL, NULL, 13, 'KABUPATEN AGAM');
INSERT INTO `kota_reguler` VALUES (1308, NULL, NULL, NULL, 13, 'KABUPATEN LIMA PULUH KOTA');
INSERT INTO `kota_reguler` VALUES (1309, NULL, NULL, NULL, 13, 'KABUPATEN PASAMAN');
INSERT INTO `kota_reguler` VALUES (1310, NULL, NULL, NULL, 13, 'KABUPATEN SOLOK SELATAN');
INSERT INTO `kota_reguler` VALUES (1311, NULL, NULL, NULL, 13, 'KABUPATEN DHARMASRAYA');
INSERT INTO `kota_reguler` VALUES (1312, NULL, NULL, NULL, 13, 'KABUPATEN PASAMAN BARAT');
INSERT INTO `kota_reguler` VALUES (1371, NULL, NULL, NULL, 13, 'KOTA PADANG');
INSERT INTO `kota_reguler` VALUES (1372, NULL, NULL, NULL, 13, 'KOTA SOLOK');
INSERT INTO `kota_reguler` VALUES (1373, NULL, NULL, NULL, 13, 'KOTA SAWAH LUNTO');
INSERT INTO `kota_reguler` VALUES (1374, NULL, NULL, NULL, 13, 'KOTA PADANG PANJANG');
INSERT INTO `kota_reguler` VALUES (1375, NULL, NULL, NULL, 13, 'KOTA BUKITTINGGI');
INSERT INTO `kota_reguler` VALUES (1376, NULL, NULL, NULL, 13, 'KOTA PAYAKUMBUH');
INSERT INTO `kota_reguler` VALUES (1377, NULL, NULL, NULL, 13, 'KOTA PARIAMAN');
INSERT INTO `kota_reguler` VALUES (1401, NULL, NULL, NULL, 14, 'KABUPATEN KUANTAN SINGINGI');
INSERT INTO `kota_reguler` VALUES (1402, NULL, NULL, NULL, 14, 'KABUPATEN INDRAGIRI HULU');
INSERT INTO `kota_reguler` VALUES (1403, NULL, NULL, NULL, 14, 'KABUPATEN INDRAGIRI HILIR');
INSERT INTO `kota_reguler` VALUES (1404, NULL, NULL, NULL, 14, 'KABUPATEN PELALAWAN');
INSERT INTO `kota_reguler` VALUES (1405, NULL, NULL, NULL, 14, 'KABUPATEN S I A K');
INSERT INTO `kota_reguler` VALUES (1406, NULL, NULL, NULL, 14, 'KABUPATEN KAMPAR');
INSERT INTO `kota_reguler` VALUES (1407, NULL, NULL, NULL, 14, 'KABUPATEN ROKAN HULU');
INSERT INTO `kota_reguler` VALUES (1408, NULL, NULL, NULL, 14, 'KABUPATEN BENGKALIS');
INSERT INTO `kota_reguler` VALUES (1409, NULL, NULL, NULL, 14, 'KABUPATEN ROKAN HILIR');
INSERT INTO `kota_reguler` VALUES (1410, NULL, NULL, NULL, 14, 'KABUPATEN KEPULAUAN MERANTI');
INSERT INTO `kota_reguler` VALUES (1471, NULL, NULL, NULL, 14, 'KOTA PEKANBARU');
INSERT INTO `kota_reguler` VALUES (1501, NULL, NULL, NULL, 15, 'KABUPATEN KERINCI');
INSERT INTO `kota_reguler` VALUES (1502, NULL, NULL, NULL, 15, 'KABUPATEN MERANGIN');
INSERT INTO `kota_reguler` VALUES (1503, NULL, NULL, NULL, 15, 'KABUPATEN SAROLANGUN');
INSERT INTO `kota_reguler` VALUES (1504, NULL, NULL, NULL, 15, 'KABUPATEN BATANG HARI');
INSERT INTO `kota_reguler` VALUES (1505, NULL, NULL, NULL, 15, 'KABUPATEN MUARO JAMBI');
INSERT INTO `kota_reguler` VALUES (1506, NULL, NULL, NULL, 15, 'KABUPATEN TANJUNG JABUNG TIMUR');
INSERT INTO `kota_reguler` VALUES (1507, NULL, NULL, NULL, 15, 'KABUPATEN TANJUNG JABUNG BARAT');
INSERT INTO `kota_reguler` VALUES (1508, NULL, NULL, NULL, 15, 'KABUPATEN TEBO');
INSERT INTO `kota_reguler` VALUES (1509, NULL, NULL, NULL, 15, 'KABUPATEN BUNGO');
INSERT INTO `kota_reguler` VALUES (1571, NULL, NULL, NULL, 15, 'KOTA JAMBI');
INSERT INTO `kota_reguler` VALUES (1572, NULL, NULL, NULL, 15, 'KOTA SUNGAI PENUH');
INSERT INTO `kota_reguler` VALUES (1601, NULL, NULL, NULL, 16, 'KABUPATEN OGAN KOMERING ULU');
INSERT INTO `kota_reguler` VALUES (1602, NULL, NULL, NULL, 16, 'KABUPATEN OGAN KOMERING ILIR');
INSERT INTO `kota_reguler` VALUES (1603, NULL, NULL, NULL, 16, 'KABUPATEN MUARA ENIM');
INSERT INTO `kota_reguler` VALUES (1604, NULL, NULL, NULL, 16, 'KABUPATEN LAHAT');
INSERT INTO `kota_reguler` VALUES (1605, NULL, NULL, NULL, 16, 'KABUPATEN MUSI RAWAS');
INSERT INTO `kota_reguler` VALUES (1606, NULL, NULL, NULL, 16, 'KABUPATEN MUSI BANYUASIN');
INSERT INTO `kota_reguler` VALUES (1607, NULL, NULL, NULL, 16, 'KABUPATEN BANYU ASIN');
INSERT INTO `kota_reguler` VALUES (1608, NULL, NULL, NULL, 16, 'KABUPATEN OGAN KOMERING ULU SELATAN');
INSERT INTO `kota_reguler` VALUES (1609, NULL, NULL, NULL, 16, 'KABUPATEN OGAN KOMERING ULU TIMUR');
INSERT INTO `kota_reguler` VALUES (1610, NULL, NULL, NULL, 16, 'KABUPATEN OGAN ILIR');
INSERT INTO `kota_reguler` VALUES (1611, NULL, NULL, NULL, 16, 'KABUPATEN EMPAT LAWANG');
INSERT INTO `kota_reguler` VALUES (1612, NULL, NULL, NULL, 16, 'KABUPATEN PENUKAL ABAB LEMATANG ILIR');
INSERT INTO `kota_reguler` VALUES (1613, NULL, NULL, NULL, 16, 'KABUPATEN MUSI RAWAS UTARA');
INSERT INTO `kota_reguler` VALUES (1671, NULL, NULL, NULL, 16, 'KOTA PALEMBANG');
INSERT INTO `kota_reguler` VALUES (1672, NULL, NULL, NULL, 16, 'KOTA PRABUMULIH');
INSERT INTO `kota_reguler` VALUES (1673, NULL, NULL, NULL, 16, 'KOTA PAGAR ALAM');
INSERT INTO `kota_reguler` VALUES (1674, NULL, NULL, NULL, 16, 'KOTA LUBUKLINGGAU');
INSERT INTO `kota_reguler` VALUES (1701, NULL, NULL, NULL, 17, 'KABUPATEN BENGKULU SELATAN');
INSERT INTO `kota_reguler` VALUES (1702, NULL, NULL, NULL, 17, 'KABUPATEN REJANG LEBONG');
INSERT INTO `kota_reguler` VALUES (1703, NULL, NULL, NULL, 17, 'KABUPATEN BENGKULU UTARA');
INSERT INTO `kota_reguler` VALUES (1704, NULL, NULL, NULL, 17, 'KABUPATEN KAUR');
INSERT INTO `kota_reguler` VALUES (1705, NULL, NULL, NULL, 17, 'KABUPATEN SELUMA');
INSERT INTO `kota_reguler` VALUES (1706, NULL, NULL, NULL, 17, 'KABUPATEN MUKOMUKO');
INSERT INTO `kota_reguler` VALUES (1707, NULL, NULL, NULL, 17, 'KABUPATEN LEBONG');
INSERT INTO `kota_reguler` VALUES (1708, NULL, NULL, NULL, 17, 'KABUPATEN KEPAHIANG');
INSERT INTO `kota_reguler` VALUES (1709, NULL, NULL, NULL, 17, 'KABUPATEN BENGKULU TENGAH');
INSERT INTO `kota_reguler` VALUES (1771, NULL, NULL, NULL, 17, 'KOTA BENGKULU');
INSERT INTO `kota_reguler` VALUES (1801, NULL, NULL, NULL, 18, 'KABUPATEN LAMPUNG BARAT');
INSERT INTO `kota_reguler` VALUES (1802, NULL, NULL, NULL, 18, 'KABUPATEN TANGGAMUS');
INSERT INTO `kota_reguler` VALUES (1803, NULL, NULL, NULL, 18, 'KABUPATEN LAMPUNG SELATAN');
INSERT INTO `kota_reguler` VALUES (1804, NULL, NULL, NULL, 18, 'KABUPATEN LAMPUNG TIMUR');
INSERT INTO `kota_reguler` VALUES (1805, NULL, NULL, NULL, 18, 'KABUPATEN LAMPUNG TENGAH');
INSERT INTO `kota_reguler` VALUES (1806, NULL, NULL, NULL, 18, 'KABUPATEN LAMPUNG UTARA');
INSERT INTO `kota_reguler` VALUES (1807, NULL, NULL, NULL, 18, 'KABUPATEN WAY KANAN');
INSERT INTO `kota_reguler` VALUES (1808, NULL, NULL, NULL, 18, 'KABUPATEN TULANGBAWANG');
INSERT INTO `kota_reguler` VALUES (1809, NULL, NULL, NULL, 18, 'KABUPATEN PESAWARAN');
INSERT INTO `kota_reguler` VALUES (1810, NULL, NULL, NULL, 18, 'KABUPATEN PRINGSEWU');
INSERT INTO `kota_reguler` VALUES (1811, NULL, NULL, NULL, 18, 'KABUPATEN MESUJI');
INSERT INTO `kota_reguler` VALUES (1812, NULL, NULL, NULL, 18, 'KABUPATEN TULANG BAWANG BARAT');
INSERT INTO `kota_reguler` VALUES (1813, NULL, NULL, NULL, 18, 'KABUPATEN PESISIR BARAT');
INSERT INTO `kota_reguler` VALUES (1871, NULL, NULL, NULL, 18, 'KOTA BANDAR LAMPUNG');
INSERT INTO `kota_reguler` VALUES (1872, NULL, NULL, NULL, 18, 'KOTA METRO');
INSERT INTO `kota_reguler` VALUES (1901, NULL, NULL, NULL, 19, 'KABUPATEN BANGKA');
INSERT INTO `kota_reguler` VALUES (1902, NULL, NULL, NULL, 19, 'KABUPATEN BELITUNG');
INSERT INTO `kota_reguler` VALUES (1903, NULL, NULL, NULL, 19, 'KABUPATEN BANGKA BARAT');
INSERT INTO `kota_reguler` VALUES (1904, NULL, NULL, NULL, 19, 'KABUPATEN BANGKA TENGAH');
INSERT INTO `kota_reguler` VALUES (1905, NULL, NULL, NULL, 19, 'KABUPATEN BANGKA SELATAN');
INSERT INTO `kota_reguler` VALUES (1906, NULL, NULL, NULL, 19, 'KABUPATEN BELITUNG TIMUR');
INSERT INTO `kota_reguler` VALUES (1971, NULL, NULL, NULL, 19, 'KOTA PANGKAL PINANG');
INSERT INTO `kota_reguler` VALUES (2101, NULL, NULL, NULL, 21, 'KABUPATEN KARIMUN');
INSERT INTO `kota_reguler` VALUES (2102, NULL, NULL, NULL, 21, 'KABUPATEN BINTAN');
INSERT INTO `kota_reguler` VALUES (2103, NULL, NULL, NULL, 21, 'KABUPATEN NATUNA');
INSERT INTO `kota_reguler` VALUES (2104, NULL, NULL, NULL, 21, 'KABUPATEN LINGGA');
INSERT INTO `kota_reguler` VALUES (2105, NULL, NULL, NULL, 21, 'KABUPATEN KEPULAUAN ANAMBAS');
INSERT INTO `kota_reguler` VALUES (2171, NULL, '2017-12-06 11:12:35', NULL, 21, 'KOTA BATAM');
INSERT INTO `kota_reguler` VALUES (2172, NULL, NULL, NULL, 21, 'KOTA TANJUNG PINANG');
INSERT INTO `kota_reguler` VALUES (3101, NULL, NULL, NULL, 31, 'KABUPATEN KEPULAUAN SERIBU');
INSERT INTO `kota_reguler` VALUES (3171, NULL, NULL, NULL, 31, 'KOTA JAKARTA SELATAN');
INSERT INTO `kota_reguler` VALUES (3172, NULL, NULL, NULL, 31, 'KOTA JAKARTA TIMUR');
INSERT INTO `kota_reguler` VALUES (3173, NULL, NULL, NULL, 31, 'KOTA JAKARTA PUSAT');
INSERT INTO `kota_reguler` VALUES (3174, NULL, NULL, NULL, 31, 'KOTA JAKARTA BARAT');
INSERT INTO `kota_reguler` VALUES (3175, NULL, NULL, NULL, 31, 'KOTA JAKARTA UTARA');
INSERT INTO `kota_reguler` VALUES (3201, NULL, NULL, NULL, 32, 'KABUPATEN BOGOR');
INSERT INTO `kota_reguler` VALUES (3202, NULL, NULL, NULL, 32, 'KABUPATEN SUKABUMI');
INSERT INTO `kota_reguler` VALUES (3203, NULL, NULL, NULL, 32, 'KABUPATEN CIANJUR');
INSERT INTO `kota_reguler` VALUES (3204, NULL, NULL, NULL, 32, 'KABUPATEN BANDUNG');
INSERT INTO `kota_reguler` VALUES (3205, NULL, NULL, NULL, 32, 'KABUPATEN GARUT');
INSERT INTO `kota_reguler` VALUES (3206, NULL, NULL, NULL, 32, 'KABUPATEN TASIKMALAYA');
INSERT INTO `kota_reguler` VALUES (3207, NULL, NULL, NULL, 32, 'KABUPATEN CIAMIS');
INSERT INTO `kota_reguler` VALUES (3208, NULL, NULL, NULL, 32, 'KABUPATEN KUNINGAN');
INSERT INTO `kota_reguler` VALUES (3209, NULL, NULL, NULL, 32, 'KABUPATEN CIREBON');
INSERT INTO `kota_reguler` VALUES (3210, NULL, NULL, NULL, 32, 'KABUPATEN MAJALENGKA');
INSERT INTO `kota_reguler` VALUES (3211, NULL, NULL, NULL, 32, 'KABUPATEN SUMEDANG');
INSERT INTO `kota_reguler` VALUES (3212, NULL, NULL, NULL, 32, 'KABUPATEN INDRAMAYU');
INSERT INTO `kota_reguler` VALUES (3213, NULL, NULL, NULL, 32, 'KABUPATEN SUBANG');
INSERT INTO `kota_reguler` VALUES (3214, NULL, NULL, NULL, 32, 'KABUPATEN PURWAKARTA');
INSERT INTO `kota_reguler` VALUES (3215, NULL, NULL, NULL, 32, 'KABUPATEN KARAWANG');
INSERT INTO `kota_reguler` VALUES (3216, NULL, NULL, NULL, 32, 'KABUPATEN BEKASI');
INSERT INTO `kota_reguler` VALUES (3217, NULL, NULL, NULL, 32, 'KABUPATEN BANDUNG BARAT');
INSERT INTO `kota_reguler` VALUES (3218, NULL, NULL, NULL, 32, 'KABUPATEN PANGANDARAN');
INSERT INTO `kota_reguler` VALUES (3271, NULL, NULL, NULL, 32, 'KOTA BOGOR');
INSERT INTO `kota_reguler` VALUES (3272, NULL, NULL, NULL, 32, 'KOTA SUKABUMI');
INSERT INTO `kota_reguler` VALUES (3273, NULL, NULL, NULL, 32, 'KOTA BANDUNG');
INSERT INTO `kota_reguler` VALUES (3274, NULL, NULL, NULL, 32, 'KOTA CIREBON');
INSERT INTO `kota_reguler` VALUES (3275, NULL, NULL, NULL, 32, 'KOTA BEKASI');
INSERT INTO `kota_reguler` VALUES (3276, NULL, NULL, NULL, 32, 'KOTA DEPOK');
INSERT INTO `kota_reguler` VALUES (3277, NULL, NULL, NULL, 32, 'KOTA CIMAHI');
INSERT INTO `kota_reguler` VALUES (3278, NULL, NULL, NULL, 32, 'KOTA TASIKMALAYA');
INSERT INTO `kota_reguler` VALUES (3279, NULL, NULL, NULL, 32, 'KOTA BANJAR');
INSERT INTO `kota_reguler` VALUES (3301, NULL, NULL, NULL, 33, 'KABUPATEN CILACAP');
INSERT INTO `kota_reguler` VALUES (3302, NULL, NULL, NULL, 33, 'KABUPATEN BANYUMAS');
INSERT INTO `kota_reguler` VALUES (3303, NULL, NULL, NULL, 33, 'KABUPATEN PURBALINGGA');
INSERT INTO `kota_reguler` VALUES (3304, NULL, NULL, NULL, 33, 'KABUPATEN BANJARNEGARA');
INSERT INTO `kota_reguler` VALUES (3305, NULL, NULL, NULL, 33, 'KABUPATEN KEBUMEN');
INSERT INTO `kota_reguler` VALUES (3306, NULL, NULL, NULL, 33, 'KABUPATEN PURWOREJO');
INSERT INTO `kota_reguler` VALUES (3307, NULL, NULL, NULL, 33, 'KABUPATEN WONOSOBO');
INSERT INTO `kota_reguler` VALUES (3308, NULL, NULL, NULL, 33, 'KABUPATEN MAGELANG');
INSERT INTO `kota_reguler` VALUES (3309, NULL, NULL, NULL, 33, 'KABUPATEN BOYOLALI');
INSERT INTO `kota_reguler` VALUES (3310, NULL, NULL, NULL, 33, 'KABUPATEN KLATEN');
INSERT INTO `kota_reguler` VALUES (3311, NULL, NULL, NULL, 33, 'KABUPATEN SUKOHARJO');
INSERT INTO `kota_reguler` VALUES (3312, NULL, NULL, NULL, 33, 'KABUPATEN WONOGIRI');
INSERT INTO `kota_reguler` VALUES (3313, NULL, NULL, NULL, 33, 'KABUPATEN KARANGANYAR');
INSERT INTO `kota_reguler` VALUES (3314, NULL, NULL, NULL, 33, 'KABUPATEN SRAGEN');
INSERT INTO `kota_reguler` VALUES (3315, NULL, NULL, NULL, 33, 'KABUPATEN GROBOGAN');
INSERT INTO `kota_reguler` VALUES (3316, NULL, NULL, NULL, 33, 'KABUPATEN BLORA');
INSERT INTO `kota_reguler` VALUES (3317, NULL, NULL, NULL, 33, 'KABUPATEN REMBANG');
INSERT INTO `kota_reguler` VALUES (3318, NULL, NULL, NULL, 33, 'KABUPATEN PATI');
INSERT INTO `kota_reguler` VALUES (3319, NULL, NULL, NULL, 33, 'KABUPATEN KUDUS');
INSERT INTO `kota_reguler` VALUES (3320, NULL, NULL, NULL, 33, 'KABUPATEN JEPARA');
INSERT INTO `kota_reguler` VALUES (3321, NULL, NULL, NULL, 33, 'KABUPATEN DEMAK');
INSERT INTO `kota_reguler` VALUES (3322, NULL, NULL, NULL, 33, 'KABUPATEN SEMARANG');
INSERT INTO `kota_reguler` VALUES (3323, NULL, NULL, NULL, 33, 'KABUPATEN TEMANGGUNG');
INSERT INTO `kota_reguler` VALUES (3324, NULL, NULL, NULL, 33, 'KABUPATEN KENDAL');
INSERT INTO `kota_reguler` VALUES (3325, NULL, NULL, NULL, 33, 'KABUPATEN BATANG');
INSERT INTO `kota_reguler` VALUES (3326, NULL, NULL, NULL, 33, 'KABUPATEN PEKALONGAN');
INSERT INTO `kota_reguler` VALUES (3327, NULL, NULL, NULL, 33, 'KABUPATEN PEMALANG');
INSERT INTO `kota_reguler` VALUES (3328, NULL, NULL, NULL, 33, 'KABUPATEN TEGAL');
INSERT INTO `kota_reguler` VALUES (3329, NULL, NULL, NULL, 33, 'KABUPATEN BREBES');
INSERT INTO `kota_reguler` VALUES (3371, NULL, NULL, NULL, 33, 'KOTA MAGELANG');
INSERT INTO `kota_reguler` VALUES (3372, NULL, NULL, NULL, 33, 'KOTA SURAKARTA');
INSERT INTO `kota_reguler` VALUES (3373, NULL, NULL, NULL, 33, 'KOTA SALATIGA');
INSERT INTO `kota_reguler` VALUES (3374, NULL, NULL, NULL, 33, 'KOTA SEMARANG');
INSERT INTO `kota_reguler` VALUES (3375, NULL, NULL, NULL, 33, 'KOTA PEKALONGAN');
INSERT INTO `kota_reguler` VALUES (3376, NULL, NULL, NULL, 33, 'KOTA TEGAL');
INSERT INTO `kota_reguler` VALUES (3401, NULL, NULL, NULL, 34, 'KABUPATEN KULON PROGO');
INSERT INTO `kota_reguler` VALUES (3402, NULL, NULL, NULL, 34, 'KABUPATEN BANTUL');
INSERT INTO `kota_reguler` VALUES (3403, NULL, NULL, NULL, 34, 'KABUPATEN GUNUNG KIDUL');
INSERT INTO `kota_reguler` VALUES (3404, NULL, NULL, NULL, 34, 'KABUPATEN SLEMAN');
INSERT INTO `kota_reguler` VALUES (3471, NULL, NULL, NULL, 34, 'KOTA YOGYAKARTA');
INSERT INTO `kota_reguler` VALUES (3501, NULL, NULL, NULL, 35, 'KABUPATEN PACITAN');
INSERT INTO `kota_reguler` VALUES (3502, NULL, NULL, NULL, 35, 'KABUPATEN PONOROGO');
INSERT INTO `kota_reguler` VALUES (3503, NULL, NULL, NULL, 35, 'KABUPATEN TRENGGALEK');
INSERT INTO `kota_reguler` VALUES (3504, NULL, NULL, NULL, 35, 'KABUPATEN TULUNGAGUNG');
INSERT INTO `kota_reguler` VALUES (3505, NULL, NULL, NULL, 35, 'KABUPATEN BLITAR');
INSERT INTO `kota_reguler` VALUES (3506, NULL, NULL, NULL, 35, 'KABUPATEN KEDIRI');
INSERT INTO `kota_reguler` VALUES (3507, NULL, NULL, NULL, 35, 'KABUPATEN MALANG');
INSERT INTO `kota_reguler` VALUES (3508, NULL, NULL, NULL, 35, 'KABUPATEN LUMAJANG');
INSERT INTO `kota_reguler` VALUES (3509, NULL, NULL, NULL, 35, 'KABUPATEN JEMBER');
INSERT INTO `kota_reguler` VALUES (3510, NULL, NULL, NULL, 35, 'KABUPATEN BANYUWANGI');
INSERT INTO `kota_reguler` VALUES (3511, NULL, NULL, NULL, 35, 'KABUPATEN BONDOWOSO');
INSERT INTO `kota_reguler` VALUES (3512, NULL, NULL, NULL, 35, 'KABUPATEN SITUBONDO');
INSERT INTO `kota_reguler` VALUES (3513, NULL, NULL, NULL, 35, 'KABUPATEN PROBOLINGGO');
INSERT INTO `kota_reguler` VALUES (3514, NULL, NULL, NULL, 35, 'KABUPATEN PASURUAN');
INSERT INTO `kota_reguler` VALUES (3515, NULL, NULL, NULL, 35, 'KABUPATEN SIDOARJO');
INSERT INTO `kota_reguler` VALUES (3516, NULL, NULL, NULL, 35, 'KABUPATEN MOJOKERTO');
INSERT INTO `kota_reguler` VALUES (3517, NULL, NULL, NULL, 35, 'KABUPATEN JOMBANG');
INSERT INTO `kota_reguler` VALUES (3518, NULL, NULL, NULL, 35, 'KABUPATEN NGANJUK');
INSERT INTO `kota_reguler` VALUES (3519, NULL, NULL, NULL, 35, 'KABUPATEN MADIUN');
INSERT INTO `kota_reguler` VALUES (3520, NULL, NULL, NULL, 35, 'KABUPATEN MAGETAN');
INSERT INTO `kota_reguler` VALUES (3521, NULL, NULL, NULL, 35, 'KABUPATEN NGAWI');
INSERT INTO `kota_reguler` VALUES (3522, NULL, NULL, NULL, 35, 'KABUPATEN BOJONEGORO');
INSERT INTO `kota_reguler` VALUES (3523, NULL, NULL, NULL, 35, 'KABUPATEN TUBAN');
INSERT INTO `kota_reguler` VALUES (3524, NULL, NULL, NULL, 35, 'KABUPATEN LAMONGAN');
INSERT INTO `kota_reguler` VALUES (3525, NULL, NULL, NULL, 35, 'KABUPATEN GRESIK');
INSERT INTO `kota_reguler` VALUES (3526, NULL, NULL, NULL, 35, 'KABUPATEN BANGKALAN');
INSERT INTO `kota_reguler` VALUES (3527, NULL, NULL, NULL, 35, 'KABUPATEN SAMPANG');
INSERT INTO `kota_reguler` VALUES (3528, NULL, NULL, NULL, 35, 'KABUPATEN PAMEKASAN');
INSERT INTO `kota_reguler` VALUES (3529, NULL, NULL, NULL, 35, 'KABUPATEN SUMENEP');
INSERT INTO `kota_reguler` VALUES (3571, NULL, NULL, NULL, 35, 'KOTA KEDIRI');
INSERT INTO `kota_reguler` VALUES (3572, NULL, NULL, NULL, 35, 'KOTA BLITAR');
INSERT INTO `kota_reguler` VALUES (3573, NULL, NULL, NULL, 35, 'KOTA MALANG');
INSERT INTO `kota_reguler` VALUES (3574, NULL, NULL, NULL, 35, 'KOTA PROBOLINGGO');
INSERT INTO `kota_reguler` VALUES (3575, NULL, NULL, NULL, 35, 'KOTA PASURUAN');
INSERT INTO `kota_reguler` VALUES (3576, NULL, NULL, NULL, 35, 'KOTA MOJOKERTO');
INSERT INTO `kota_reguler` VALUES (3577, NULL, NULL, NULL, 35, 'KOTA MADIUN');
INSERT INTO `kota_reguler` VALUES (3578, NULL, NULL, NULL, 35, 'KOTA SURABAYA');
INSERT INTO `kota_reguler` VALUES (3579, NULL, NULL, NULL, 35, 'KOTA BATU');
INSERT INTO `kota_reguler` VALUES (3601, NULL, NULL, NULL, 36, 'KABUPATEN PANDEGLANG');
INSERT INTO `kota_reguler` VALUES (3602, NULL, NULL, NULL, 36, 'KABUPATEN LEBAK');
INSERT INTO `kota_reguler` VALUES (3603, NULL, NULL, NULL, 36, 'KABUPATEN TANGERANG');
INSERT INTO `kota_reguler` VALUES (3604, NULL, NULL, NULL, 36, 'KABUPATEN SERANG');
INSERT INTO `kota_reguler` VALUES (3671, NULL, NULL, NULL, 36, 'KOTA TANGERANG');
INSERT INTO `kota_reguler` VALUES (3672, NULL, NULL, NULL, 36, 'KOTA CILEGON');
INSERT INTO `kota_reguler` VALUES (3673, NULL, NULL, NULL, 36, 'KOTA SERANG');
INSERT INTO `kota_reguler` VALUES (3674, NULL, NULL, NULL, 36, 'KOTA TANGERANG SELATAN');
INSERT INTO `kota_reguler` VALUES (5101, NULL, NULL, NULL, 51, 'KABUPATEN JEMBRANA');
INSERT INTO `kota_reguler` VALUES (5102, NULL, NULL, NULL, 51, 'KABUPATEN TABANAN');
INSERT INTO `kota_reguler` VALUES (5103, NULL, NULL, NULL, 51, 'KABUPATEN BADUNG');
INSERT INTO `kota_reguler` VALUES (5104, NULL, NULL, NULL, 51, 'KABUPATEN GIANYAR');
INSERT INTO `kota_reguler` VALUES (5105, NULL, NULL, NULL, 51, 'KABUPATEN KLUNGKUNG');
INSERT INTO `kota_reguler` VALUES (5106, NULL, NULL, NULL, 51, 'KABUPATEN BANGLI');
INSERT INTO `kota_reguler` VALUES (5107, NULL, NULL, NULL, 51, 'KABUPATEN KARANG ASEM');
INSERT INTO `kota_reguler` VALUES (5108, NULL, NULL, NULL, 51, 'KABUPATEN BULELENG');
INSERT INTO `kota_reguler` VALUES (5171, NULL, NULL, NULL, 51, 'KOTA DENPASAR');
INSERT INTO `kota_reguler` VALUES (5201, NULL, NULL, NULL, 52, 'KABUPATEN LOMBOK BARAT');
INSERT INTO `kota_reguler` VALUES (5202, NULL, NULL, NULL, 52, 'KABUPATEN LOMBOK TENGAH');
INSERT INTO `kota_reguler` VALUES (5203, NULL, NULL, NULL, 52, 'KABUPATEN LOMBOK TIMUR');
INSERT INTO `kota_reguler` VALUES (5204, NULL, NULL, NULL, 52, 'KABUPATEN SUMBAWA');
INSERT INTO `kota_reguler` VALUES (5205, NULL, NULL, NULL, 52, 'KABUPATEN DOMPU');
INSERT INTO `kota_reguler` VALUES (5206, NULL, NULL, NULL, 52, 'KABUPATEN BIMA');
INSERT INTO `kota_reguler` VALUES (5207, NULL, NULL, NULL, 52, 'KABUPATEN SUMBAWA BARAT');
INSERT INTO `kota_reguler` VALUES (5208, NULL, NULL, NULL, 52, 'KABUPATEN LOMBOK UTARA');
INSERT INTO `kota_reguler` VALUES (5271, NULL, NULL, NULL, 52, 'KOTA MATARAM');
INSERT INTO `kota_reguler` VALUES (5272, NULL, NULL, NULL, 52, 'KOTA BIMA');
INSERT INTO `kota_reguler` VALUES (5301, NULL, NULL, NULL, 53, 'KABUPATEN SUMBA BARAT');
INSERT INTO `kota_reguler` VALUES (5302, NULL, NULL, NULL, 53, 'KABUPATEN SUMBA TIMUR');
INSERT INTO `kota_reguler` VALUES (5303, NULL, NULL, NULL, 53, 'KABUPATEN KUPANG');
INSERT INTO `kota_reguler` VALUES (5304, NULL, NULL, NULL, 53, 'KABUPATEN TIMOR TENGAH SELATAN');
INSERT INTO `kota_reguler` VALUES (5305, NULL, NULL, NULL, 53, 'KABUPATEN TIMOR TENGAH UTARA');
INSERT INTO `kota_reguler` VALUES (5306, NULL, NULL, NULL, 53, 'KABUPATEN BELU');
INSERT INTO `kota_reguler` VALUES (5307, NULL, NULL, NULL, 53, 'KABUPATEN ALOR');
INSERT INTO `kota_reguler` VALUES (5308, NULL, NULL, NULL, 53, 'KABUPATEN LEMBATA');
INSERT INTO `kota_reguler` VALUES (5309, NULL, NULL, NULL, 53, 'KABUPATEN FLORES TIMUR');
INSERT INTO `kota_reguler` VALUES (5310, NULL, NULL, NULL, 53, 'KABUPATEN SIKKA');
INSERT INTO `kota_reguler` VALUES (5311, NULL, NULL, NULL, 53, 'KABUPATEN ENDE');
INSERT INTO `kota_reguler` VALUES (5312, NULL, NULL, NULL, 53, 'KABUPATEN NGADA');
INSERT INTO `kota_reguler` VALUES (5313, NULL, NULL, NULL, 53, 'KABUPATEN MANGGARAI');
INSERT INTO `kota_reguler` VALUES (5314, NULL, NULL, NULL, 53, 'KABUPATEN ROTE NDAO');
INSERT INTO `kota_reguler` VALUES (5315, NULL, NULL, NULL, 53, 'KABUPATEN MANGGARAI BARAT');
INSERT INTO `kota_reguler` VALUES (5316, NULL, NULL, NULL, 53, 'KABUPATEN SUMBA TENGAH');
INSERT INTO `kota_reguler` VALUES (5317, NULL, NULL, NULL, 53, 'KABUPATEN SUMBA BARAT DAYA');
INSERT INTO `kota_reguler` VALUES (5318, NULL, NULL, NULL, 53, 'KABUPATEN NAGEKEO');
INSERT INTO `kota_reguler` VALUES (5319, NULL, NULL, NULL, 53, 'KABUPATEN MANGGARAI TIMUR');
INSERT INTO `kota_reguler` VALUES (5320, NULL, NULL, NULL, 53, 'KABUPATEN SABU RAIJUA');
INSERT INTO `kota_reguler` VALUES (5321, NULL, NULL, NULL, 53, 'KABUPATEN MALAKA');
INSERT INTO `kota_reguler` VALUES (5371, NULL, NULL, NULL, 53, 'KOTA KUPANG');
INSERT INTO `kota_reguler` VALUES (6101, NULL, NULL, NULL, 61, 'KABUPATEN SAMBAS');
INSERT INTO `kota_reguler` VALUES (6102, NULL, NULL, NULL, 61, 'KABUPATEN BENGKAYANG');
INSERT INTO `kota_reguler` VALUES (6103, NULL, NULL, NULL, 61, 'KABUPATEN LANDAK');
INSERT INTO `kota_reguler` VALUES (6104, NULL, NULL, NULL, 61, 'KABUPATEN MEMPAWAH');
INSERT INTO `kota_reguler` VALUES (6105, NULL, NULL, NULL, 61, 'KABUPATEN SANGGAU');
INSERT INTO `kota_reguler` VALUES (6106, NULL, NULL, NULL, 61, 'KABUPATEN KETAPANG');
INSERT INTO `kota_reguler` VALUES (6107, NULL, NULL, NULL, 61, 'KABUPATEN SINTANG');
INSERT INTO `kota_reguler` VALUES (6108, NULL, NULL, NULL, 61, 'KABUPATEN KAPUAS HULU');
INSERT INTO `kota_reguler` VALUES (6109, NULL, NULL, NULL, 61, 'KABUPATEN SEKADAU');
INSERT INTO `kota_reguler` VALUES (6110, NULL, NULL, NULL, 61, 'KABUPATEN MELAWI');
INSERT INTO `kota_reguler` VALUES (6111, NULL, NULL, NULL, 61, 'KABUPATEN KAYONG UTARA');
INSERT INTO `kota_reguler` VALUES (6112, NULL, NULL, NULL, 61, 'KABUPATEN KUBU RAYA');
INSERT INTO `kota_reguler` VALUES (6171, NULL, NULL, NULL, 61, 'KOTA PONTIANAK');
INSERT INTO `kota_reguler` VALUES (6172, NULL, NULL, NULL, 61, 'KOTA SINGKAWANG');
INSERT INTO `kota_reguler` VALUES (6201, NULL, NULL, NULL, 62, 'KABUPATEN KOTAWARINGIN BARAT');
INSERT INTO `kota_reguler` VALUES (6202, NULL, NULL, NULL, 62, 'KABUPATEN KOTAWARINGIN TIMUR');
INSERT INTO `kota_reguler` VALUES (6203, NULL, NULL, NULL, 62, 'KABUPATEN KAPUAS');
INSERT INTO `kota_reguler` VALUES (6204, NULL, NULL, NULL, 62, 'KABUPATEN BARITO SELATAN');
INSERT INTO `kota_reguler` VALUES (6205, NULL, NULL, NULL, 62, 'KABUPATEN BARITO UTARA');
INSERT INTO `kota_reguler` VALUES (6206, NULL, NULL, NULL, 62, 'KABUPATEN SUKAMARA');
INSERT INTO `kota_reguler` VALUES (6207, NULL, NULL, NULL, 62, 'KABUPATEN LAMANDAU');
INSERT INTO `kota_reguler` VALUES (6208, NULL, NULL, NULL, 62, 'KABUPATEN SERUYAN');
INSERT INTO `kota_reguler` VALUES (6209, NULL, NULL, NULL, 62, 'KABUPATEN KATINGAN');
INSERT INTO `kota_reguler` VALUES (6210, NULL, NULL, NULL, 62, 'KABUPATEN PULANG PISAU');
INSERT INTO `kota_reguler` VALUES (6211, NULL, NULL, NULL, 62, 'KABUPATEN GUNUNG MAS');
INSERT INTO `kota_reguler` VALUES (6212, NULL, NULL, NULL, 62, 'KABUPATEN BARITO TIMUR');
INSERT INTO `kota_reguler` VALUES (6213, NULL, NULL, NULL, 62, 'KABUPATEN MURUNG RAYA');
INSERT INTO `kota_reguler` VALUES (6271, NULL, NULL, NULL, 62, 'KOTA PALANGKA RAYA');
INSERT INTO `kota_reguler` VALUES (6301, NULL, NULL, NULL, 63, 'KABUPATEN TANAH LAUT');
INSERT INTO `kota_reguler` VALUES (6302, NULL, NULL, NULL, 63, 'KABUPATEN KOTA BARU');
INSERT INTO `kota_reguler` VALUES (6303, NULL, NULL, NULL, 63, 'KABUPATEN BANJAR');
INSERT INTO `kota_reguler` VALUES (6304, NULL, NULL, NULL, 63, 'KABUPATEN BARITO KUALA');
INSERT INTO `kota_reguler` VALUES (6305, NULL, NULL, NULL, 63, 'KABUPATEN TAPIN');
INSERT INTO `kota_reguler` VALUES (6306, NULL, NULL, NULL, 63, 'KABUPATEN HULU SUNGAI SELATAN');
INSERT INTO `kota_reguler` VALUES (6307, NULL, NULL, NULL, 63, 'KABUPATEN HULU SUNGAI TENGAH');
INSERT INTO `kota_reguler` VALUES (6308, NULL, NULL, NULL, 63, 'KABUPATEN HULU SUNGAI UTARA');
INSERT INTO `kota_reguler` VALUES (6309, NULL, NULL, NULL, 63, 'KABUPATEN TABALONG');
INSERT INTO `kota_reguler` VALUES (6310, NULL, NULL, NULL, 63, 'KABUPATEN TANAH BUMBU');
INSERT INTO `kota_reguler` VALUES (6311, NULL, NULL, NULL, 63, 'KABUPATEN BALANGAN');
INSERT INTO `kota_reguler` VALUES (6371, NULL, NULL, NULL, 63, 'KOTA BANJARMASIN');
INSERT INTO `kota_reguler` VALUES (6372, NULL, NULL, NULL, 63, 'KOTA BANJAR BARU');
INSERT INTO `kota_reguler` VALUES (6401, NULL, NULL, NULL, 64, 'KABUPATEN PASER');
INSERT INTO `kota_reguler` VALUES (6402, NULL, NULL, NULL, 64, 'KABUPATEN KUTAI BARAT');
INSERT INTO `kota_reguler` VALUES (6403, NULL, NULL, NULL, 64, 'KABUPATEN KUTAI KARTANEGARA');
INSERT INTO `kota_reguler` VALUES (6404, NULL, NULL, NULL, 64, 'KABUPATEN KUTAI TIMUR');
INSERT INTO `kota_reguler` VALUES (6405, NULL, NULL, NULL, 64, 'KABUPATEN BERAU');
INSERT INTO `kota_reguler` VALUES (6409, NULL, NULL, NULL, 64, 'KABUPATEN PENAJAM PASER UTARA');
INSERT INTO `kota_reguler` VALUES (6411, NULL, NULL, NULL, 64, 'KABUPATEN MAHAKAM HULU');
INSERT INTO `kota_reguler` VALUES (6471, NULL, NULL, NULL, 64, 'KOTA BALIKPAPAN');
INSERT INTO `kota_reguler` VALUES (6472, NULL, NULL, NULL, 64, 'KOTA SAMARINDA');
INSERT INTO `kota_reguler` VALUES (6474, NULL, NULL, NULL, 64, 'KOTA BONTANG');
INSERT INTO `kota_reguler` VALUES (6501, NULL, NULL, NULL, 65, 'KABUPATEN MALINAU');
INSERT INTO `kota_reguler` VALUES (6502, NULL, NULL, NULL, 65, 'KABUPATEN BULUNGAN');
INSERT INTO `kota_reguler` VALUES (6503, NULL, NULL, NULL, 65, 'KABUPATEN TANA TIDUNG');
INSERT INTO `kota_reguler` VALUES (6504, NULL, NULL, NULL, 65, 'KABUPATEN NUNUKAN');
INSERT INTO `kota_reguler` VALUES (6571, NULL, NULL, NULL, 65, 'KOTA TARAKAN');
INSERT INTO `kota_reguler` VALUES (7101, NULL, NULL, NULL, 71, 'KABUPATEN BOLAANG MONGONDOW');
INSERT INTO `kota_reguler` VALUES (7102, NULL, NULL, NULL, 71, 'KABUPATEN MINAHASA');
INSERT INTO `kota_reguler` VALUES (7103, NULL, NULL, NULL, 71, 'KABUPATEN KEPULAUAN SANGIHE');
INSERT INTO `kota_reguler` VALUES (7104, NULL, NULL, NULL, 71, 'KABUPATEN KEPULAUAN TALAUD');
INSERT INTO `kota_reguler` VALUES (7105, NULL, NULL, NULL, 71, 'KABUPATEN MINAHASA SELATAN');
INSERT INTO `kota_reguler` VALUES (7106, NULL, NULL, NULL, 71, 'KABUPATEN MINAHASA UTARA');
INSERT INTO `kota_reguler` VALUES (7107, NULL, NULL, NULL, 71, 'KABUPATEN BOLAANG MONGONDOW UTARA');
INSERT INTO `kota_reguler` VALUES (7108, NULL, NULL, NULL, 71, 'KABUPATEN SIAU TAGULANDANG BIARO');
INSERT INTO `kota_reguler` VALUES (7109, NULL, NULL, NULL, 71, 'KABUPATEN MINAHASA TENGGARA');
INSERT INTO `kota_reguler` VALUES (7110, NULL, NULL, NULL, 71, 'KABUPATEN BOLAANG MONGONDOW SELATAN');
INSERT INTO `kota_reguler` VALUES (7111, NULL, NULL, NULL, 71, 'KABUPATEN BOLAANG MONGONDOW TIMUR');
INSERT INTO `kota_reguler` VALUES (7171, NULL, NULL, NULL, 71, 'KOTA MANADO');
INSERT INTO `kota_reguler` VALUES (7172, NULL, NULL, NULL, 71, 'KOTA BITUNG');
INSERT INTO `kota_reguler` VALUES (7173, NULL, NULL, NULL, 71, 'KOTA TOMOHON');
INSERT INTO `kota_reguler` VALUES (7174, NULL, NULL, NULL, 71, 'KOTA KOTAMOBAGU');
INSERT INTO `kota_reguler` VALUES (7201, NULL, NULL, NULL, 72, 'KABUPATEN BANGGAI KEPULAUAN');
INSERT INTO `kota_reguler` VALUES (7202, NULL, NULL, NULL, 72, 'KABUPATEN BANGGAI');
INSERT INTO `kota_reguler` VALUES (7203, NULL, NULL, NULL, 72, 'KABUPATEN MOROWALI');
INSERT INTO `kota_reguler` VALUES (7204, NULL, NULL, NULL, 72, 'KABUPATEN POSO');
INSERT INTO `kota_reguler` VALUES (7205, NULL, NULL, NULL, 72, 'KABUPATEN DONGGALA');
INSERT INTO `kota_reguler` VALUES (7206, NULL, NULL, NULL, 72, 'KABUPATEN TOLI-TOLI');
INSERT INTO `kota_reguler` VALUES (7207, NULL, NULL, NULL, 72, 'KABUPATEN BUOL');
INSERT INTO `kota_reguler` VALUES (7208, NULL, NULL, NULL, 72, 'KABUPATEN PARIGI MOUTONG');
INSERT INTO `kota_reguler` VALUES (7209, NULL, NULL, NULL, 72, 'KABUPATEN TOJO UNA-UNA');
INSERT INTO `kota_reguler` VALUES (7210, NULL, NULL, NULL, 72, 'KABUPATEN SIGI');
INSERT INTO `kota_reguler` VALUES (7211, NULL, NULL, NULL, 72, 'KABUPATEN BANGGAI LAUT');
INSERT INTO `kota_reguler` VALUES (7212, NULL, NULL, NULL, 72, 'KABUPATEN MOROWALI UTARA');
INSERT INTO `kota_reguler` VALUES (7271, NULL, NULL, NULL, 72, 'KOTA PALU');
INSERT INTO `kota_reguler` VALUES (7301, NULL, NULL, NULL, 73, 'KABUPATEN KEPULAUAN SELAYAR');
INSERT INTO `kota_reguler` VALUES (7302, NULL, NULL, NULL, 73, 'KABUPATEN BULUKUMBA');
INSERT INTO `kota_reguler` VALUES (7303, NULL, NULL, NULL, 73, 'KABUPATEN BANTAENG');
INSERT INTO `kota_reguler` VALUES (7304, NULL, NULL, NULL, 73, 'KABUPATEN JENEPONTO');
INSERT INTO `kota_reguler` VALUES (7305, NULL, NULL, NULL, 73, 'KABUPATEN TAKALAR');
INSERT INTO `kota_reguler` VALUES (7306, NULL, NULL, NULL, 73, 'KABUPATEN GOWA');
INSERT INTO `kota_reguler` VALUES (7307, NULL, NULL, NULL, 73, 'KABUPATEN SINJAI');
INSERT INTO `kota_reguler` VALUES (7308, NULL, NULL, NULL, 73, 'KABUPATEN MAROS');
INSERT INTO `kota_reguler` VALUES (7309, NULL, NULL, NULL, 73, 'KABUPATEN PANGKAJENE DAN KEPULAUAN');
INSERT INTO `kota_reguler` VALUES (7310, NULL, NULL, NULL, 73, 'KABUPATEN BARRU');
INSERT INTO `kota_reguler` VALUES (7311, NULL, NULL, NULL, 73, 'KABUPATEN BONE');
INSERT INTO `kota_reguler` VALUES (7312, NULL, NULL, NULL, 73, 'KABUPATEN SOPPENG');
INSERT INTO `kota_reguler` VALUES (7313, NULL, NULL, NULL, 73, 'KABUPATEN WAJO');
INSERT INTO `kota_reguler` VALUES (7314, NULL, NULL, NULL, 73, 'KABUPATEN SIDENRENG RAPPANG');
INSERT INTO `kota_reguler` VALUES (7315, NULL, NULL, NULL, 73, 'KABUPATEN PINRANG');
INSERT INTO `kota_reguler` VALUES (7316, NULL, NULL, NULL, 73, 'KABUPATEN ENREKANG');
INSERT INTO `kota_reguler` VALUES (7317, NULL, NULL, NULL, 73, 'KABUPATEN LUWU');
INSERT INTO `kota_reguler` VALUES (7318, NULL, NULL, NULL, 73, 'KABUPATEN TANA TORAJA');
INSERT INTO `kota_reguler` VALUES (7322, NULL, NULL, NULL, 73, 'KABUPATEN LUWU UTARA');
INSERT INTO `kota_reguler` VALUES (7325, NULL, NULL, NULL, 73, 'KABUPATEN LUWU TIMUR');
INSERT INTO `kota_reguler` VALUES (7326, NULL, NULL, NULL, 73, 'KABUPATEN TORAJA UTARA');
INSERT INTO `kota_reguler` VALUES (7371, NULL, NULL, NULL, 73, 'KOTA MAKASSAR');
INSERT INTO `kota_reguler` VALUES (7372, NULL, NULL, NULL, 73, 'KOTA PAREPARE');
INSERT INTO `kota_reguler` VALUES (7373, NULL, NULL, NULL, 73, 'KOTA PALOPO');
INSERT INTO `kota_reguler` VALUES (7401, NULL, NULL, NULL, 74, 'KABUPATEN BUTON');
INSERT INTO `kota_reguler` VALUES (7402, NULL, NULL, NULL, 74, 'KABUPATEN MUNA');
INSERT INTO `kota_reguler` VALUES (7403, NULL, NULL, NULL, 74, 'KABUPATEN KONAWE');
INSERT INTO `kota_reguler` VALUES (7404, NULL, NULL, NULL, 74, 'KABUPATEN KOLAKA');
INSERT INTO `kota_reguler` VALUES (7405, NULL, NULL, NULL, 74, 'KABUPATEN KONAWE SELATAN');
INSERT INTO `kota_reguler` VALUES (7406, NULL, NULL, NULL, 74, 'KABUPATEN BOMBANA');
INSERT INTO `kota_reguler` VALUES (7407, NULL, NULL, NULL, 74, 'KABUPATEN WAKATOBI');
INSERT INTO `kota_reguler` VALUES (7408, NULL, NULL, NULL, 74, 'KABUPATEN KOLAKA UTARA');
INSERT INTO `kota_reguler` VALUES (7409, NULL, NULL, NULL, 74, 'KABUPATEN BUTON UTARA');
INSERT INTO `kota_reguler` VALUES (7410, NULL, NULL, NULL, 74, 'KABUPATEN KONAWE UTARA');
INSERT INTO `kota_reguler` VALUES (7411, NULL, NULL, NULL, 74, 'KABUPATEN KOLAKA TIMUR');
INSERT INTO `kota_reguler` VALUES (7412, NULL, NULL, NULL, 74, 'KABUPATEN KONAWE KEPULAUAN');
INSERT INTO `kota_reguler` VALUES (7413, NULL, NULL, NULL, 74, 'KABUPATEN MUNA BARAT');
INSERT INTO `kota_reguler` VALUES (7414, NULL, NULL, NULL, 74, 'KABUPATEN BUTON TENGAH');
INSERT INTO `kota_reguler` VALUES (7415, NULL, NULL, NULL, 74, 'KABUPATEN BUTON SELATAN');
INSERT INTO `kota_reguler` VALUES (7471, NULL, NULL, NULL, 74, 'KOTA KENDARI');
INSERT INTO `kota_reguler` VALUES (7472, NULL, NULL, NULL, 74, 'KOTA BAUBAU');
INSERT INTO `kota_reguler` VALUES (7501, NULL, NULL, NULL, 75, 'KABUPATEN BOALEMO');
INSERT INTO `kota_reguler` VALUES (7502, NULL, NULL, NULL, 75, 'KABUPATEN GORONTALO');
INSERT INTO `kota_reguler` VALUES (7503, NULL, NULL, NULL, 75, 'KABUPATEN POHUWATO');
INSERT INTO `kota_reguler` VALUES (7504, NULL, NULL, NULL, 75, 'KABUPATEN BONE BOLANGO');
INSERT INTO `kota_reguler` VALUES (7505, NULL, NULL, NULL, 75, 'KABUPATEN GORONTALO UTARA');
INSERT INTO `kota_reguler` VALUES (7571, NULL, NULL, NULL, 75, 'KOTA GORONTALO');
INSERT INTO `kota_reguler` VALUES (7601, NULL, NULL, NULL, 76, 'KABUPATEN MAJENE');
INSERT INTO `kota_reguler` VALUES (7602, NULL, NULL, NULL, 76, 'KABUPATEN POLEWALI MANDAR');
INSERT INTO `kota_reguler` VALUES (7603, NULL, NULL, NULL, 76, 'KABUPATEN MAMASA');
INSERT INTO `kota_reguler` VALUES (7604, NULL, NULL, NULL, 76, 'KABUPATEN MAMUJU');
INSERT INTO `kota_reguler` VALUES (7605, NULL, NULL, NULL, 76, 'KABUPATEN MAMUJU UTARA');
INSERT INTO `kota_reguler` VALUES (7606, NULL, NULL, NULL, 76, 'KABUPATEN MAMUJU TENGAH');
INSERT INTO `kota_reguler` VALUES (8101, NULL, NULL, NULL, 81, 'KABUPATEN MALUKU TENGGARA BARAT');
INSERT INTO `kota_reguler` VALUES (8102, NULL, NULL, NULL, 81, 'KABUPATEN MALUKU TENGGARA');
INSERT INTO `kota_reguler` VALUES (8103, NULL, NULL, NULL, 81, 'KABUPATEN MALUKU TENGAH');
INSERT INTO `kota_reguler` VALUES (8104, NULL, NULL, NULL, 81, 'KABUPATEN BURU');
INSERT INTO `kota_reguler` VALUES (8105, NULL, NULL, NULL, 81, 'KABUPATEN KEPULAUAN ARU');
INSERT INTO `kota_reguler` VALUES (8106, NULL, NULL, NULL, 81, 'KABUPATEN SERAM BAGIAN BARAT');
INSERT INTO `kota_reguler` VALUES (8107, NULL, NULL, NULL, 81, 'KABUPATEN SERAM BAGIAN TIMUR');
INSERT INTO `kota_reguler` VALUES (8108, NULL, NULL, NULL, 81, 'KABUPATEN MALUKU BARAT DAYA');
INSERT INTO `kota_reguler` VALUES (8109, NULL, NULL, NULL, 81, 'KABUPATEN BURU SELATAN');
INSERT INTO `kota_reguler` VALUES (8171, NULL, NULL, NULL, 81, 'KOTA AMBON');
INSERT INTO `kota_reguler` VALUES (8172, NULL, NULL, NULL, 81, 'KOTA TUAL');
INSERT INTO `kota_reguler` VALUES (8201, NULL, NULL, NULL, 82, 'KABUPATEN HALMAHERA BARAT');
INSERT INTO `kota_reguler` VALUES (8202, NULL, NULL, NULL, 82, 'KABUPATEN HALMAHERA TENGAH');
INSERT INTO `kota_reguler` VALUES (8203, NULL, NULL, NULL, 82, 'KABUPATEN KEPULAUAN SULA');
INSERT INTO `kota_reguler` VALUES (8204, NULL, NULL, NULL, 82, 'KABUPATEN HALMAHERA SELATAN');
INSERT INTO `kota_reguler` VALUES (8205, NULL, NULL, NULL, 82, 'KABUPATEN HALMAHERA UTARA');
INSERT INTO `kota_reguler` VALUES (8206, NULL, NULL, NULL, 82, 'KABUPATEN HALMAHERA TIMUR');
INSERT INTO `kota_reguler` VALUES (8207, NULL, NULL, NULL, 82, 'KABUPATEN PULAU MOROTAI');
INSERT INTO `kota_reguler` VALUES (8208, NULL, NULL, NULL, 82, 'KABUPATEN PULAU TALIABU');
INSERT INTO `kota_reguler` VALUES (8271, NULL, NULL, NULL, 82, 'KOTA TERNATE');
INSERT INTO `kota_reguler` VALUES (8272, NULL, NULL, NULL, 82, 'KOTA TIDORE KEPULAUAN');
INSERT INTO `kota_reguler` VALUES (9101, NULL, NULL, NULL, 91, 'KABUPATEN FAKFAK');
INSERT INTO `kota_reguler` VALUES (9102, NULL, NULL, NULL, 91, 'KABUPATEN KAIMANA');
INSERT INTO `kota_reguler` VALUES (9103, NULL, NULL, NULL, 91, 'KABUPATEN TELUK WONDAMA');
INSERT INTO `kota_reguler` VALUES (9104, NULL, NULL, NULL, 91, 'KABUPATEN TELUK BINTUNI');
INSERT INTO `kota_reguler` VALUES (9105, NULL, NULL, NULL, 91, 'KABUPATEN MANOKWARI');
INSERT INTO `kota_reguler` VALUES (9106, NULL, NULL, NULL, 91, 'KABUPATEN SORONG SELATAN');
INSERT INTO `kota_reguler` VALUES (9107, NULL, NULL, NULL, 91, 'KABUPATEN SORONG');
INSERT INTO `kota_reguler` VALUES (9108, NULL, NULL, NULL, 91, 'KABUPATEN RAJA AMPAT');
INSERT INTO `kota_reguler` VALUES (9109, NULL, NULL, NULL, 91, 'KABUPATEN TAMBRAUW');
INSERT INTO `kota_reguler` VALUES (9110, NULL, NULL, NULL, 91, 'KABUPATEN MAYBRAT');
INSERT INTO `kota_reguler` VALUES (9111, NULL, NULL, NULL, 91, 'KABUPATEN MANOKWARI SELATAN');
INSERT INTO `kota_reguler` VALUES (9112, NULL, NULL, NULL, 91, 'KABUPATEN PEGUNUNGAN ARFAK');
INSERT INTO `kota_reguler` VALUES (9171, NULL, NULL, NULL, 91, 'KOTA SORONG');
INSERT INTO `kota_reguler` VALUES (9401, NULL, NULL, NULL, 94, 'KABUPATEN MERAUKE');
INSERT INTO `kota_reguler` VALUES (9402, NULL, NULL, NULL, 94, 'KABUPATEN JAYAWIJAYA');
INSERT INTO `kota_reguler` VALUES (9403, NULL, NULL, NULL, 94, 'KABUPATEN JAYAPURA');
INSERT INTO `kota_reguler` VALUES (9404, NULL, NULL, NULL, 94, 'KABUPATEN NABIRE');
INSERT INTO `kota_reguler` VALUES (9408, NULL, NULL, NULL, 94, 'KABUPATEN KEPULAUAN YAPEN');
INSERT INTO `kota_reguler` VALUES (9409, NULL, NULL, NULL, 94, 'KABUPATEN BIAK NUMFOR');
INSERT INTO `kota_reguler` VALUES (9410, NULL, NULL, NULL, 94, 'KABUPATEN PANIAI');
INSERT INTO `kota_reguler` VALUES (9411, NULL, NULL, NULL, 94, 'KABUPATEN PUNCAK JAYA');
INSERT INTO `kota_reguler` VALUES (9412, NULL, NULL, NULL, 94, 'KABUPATEN MIMIKA');
INSERT INTO `kota_reguler` VALUES (9413, NULL, NULL, NULL, 94, 'KABUPATEN BOVEN DIGOEL');
INSERT INTO `kota_reguler` VALUES (9414, NULL, NULL, NULL, 94, 'KABUPATEN MAPPI');
INSERT INTO `kota_reguler` VALUES (9415, NULL, NULL, NULL, 94, 'KABUPATEN ASMAT');
INSERT INTO `kota_reguler` VALUES (9416, NULL, NULL, NULL, 94, 'KABUPATEN YAHUKIMO');
INSERT INTO `kota_reguler` VALUES (9417, NULL, NULL, NULL, 94, 'KABUPATEN PEGUNUNGAN BINTANG');
INSERT INTO `kota_reguler` VALUES (9418, NULL, NULL, NULL, 94, 'KABUPATEN TOLIKARA');
INSERT INTO `kota_reguler` VALUES (9419, NULL, NULL, NULL, 94, 'KABUPATEN SARMI');
INSERT INTO `kota_reguler` VALUES (9420, NULL, NULL, NULL, 94, 'KABUPATEN KEEROM');
INSERT INTO `kota_reguler` VALUES (9426, NULL, NULL, NULL, 94, 'KABUPATEN WAROPEN');
INSERT INTO `kota_reguler` VALUES (9427, NULL, NULL, NULL, 94, 'KABUPATEN SUPIORI');
INSERT INTO `kota_reguler` VALUES (9428, NULL, NULL, NULL, 94, 'KABUPATEN MAMBERAMO RAYA');
INSERT INTO `kota_reguler` VALUES (9429, NULL, NULL, NULL, 94, 'KABUPATEN NDUGA');
INSERT INTO `kota_reguler` VALUES (9430, NULL, NULL, NULL, 94, 'KABUPATEN LANNY JAYA');
INSERT INTO `kota_reguler` VALUES (9431, NULL, NULL, NULL, 94, 'KABUPATEN MAMBERAMO TENGAH');
INSERT INTO `kota_reguler` VALUES (9432, NULL, NULL, NULL, 94, 'KABUPATEN YALIMO');
INSERT INTO `kota_reguler` VALUES (9433, NULL, NULL, NULL, 94, 'KABUPATEN PUNCAK');
INSERT INTO `kota_reguler` VALUES (9434, NULL, NULL, NULL, 94, 'KABUPATEN DOGIYAI');
INSERT INTO `kota_reguler` VALUES (9435, NULL, NULL, NULL, 94, 'KABUPATEN INTAN JAYA');
INSERT INTO `kota_reguler` VALUES (9436, NULL, NULL, NULL, 94, 'KABUPATEN DEIYAI');
INSERT INTO `kota_reguler` VALUES (9471, NULL, NULL, NULL, 94, 'KOTA JAYAPURA');
INSERT INTO `kota_reguler` VALUES (9472, '2017-12-04 17:02:06', NULL, NULL, 14, 'KOTA DUMAI');
INSERT INTO `kota_reguler` VALUES (9473, '2019-03-01 13:37:44', '2019-03-01 13:44:41', '2019-03-09 09:29:53', 32, 'CIMAHI');
INSERT INTO `kota_reguler` VALUES (9474, '2019-03-01 13:38:28', NULL, '2019-03-09 09:30:29', 32, 'KOTA CIREBON');
INSERT INTO `kota_reguler` VALUES (9475, '2019-03-01 13:38:48', NULL, '2019-03-09 09:29:11', 32, 'KABUPATEN CIREBON');
INSERT INTO `kota_reguler` VALUES (9476, '2019-03-01 13:39:07', '2019-03-01 13:44:18', '2019-03-09 09:29:06', 32, 'SUBANG');
INSERT INTO `kota_reguler` VALUES (9477, '2019-03-01 13:39:26', '2019-03-01 13:44:06', '2019-03-09 09:29:00', 32, 'SUKABUMI');
INSERT INTO `kota_reguler` VALUES (9478, '2019-03-01 13:39:50', '2019-03-01 13:43:56', '2019-03-09 09:28:55', 32, 'CIANJUR');
INSERT INTO `kota_reguler` VALUES (9479, '2019-03-01 13:40:07', '2019-03-01 13:43:43', '2019-03-09 09:28:52', 32, 'GARUT');
INSERT INTO `kota_reguler` VALUES (9480, '2019-03-01 13:40:23', NULL, '2019-03-09 09:28:43', 32, 'TASIKMALAYA');
INSERT INTO `kota_reguler` VALUES (9481, '2019-03-01 16:12:57', NULL, '2019-03-08 16:38:15', 11, 'BANDA ACEH');
INSERT INTO `kota_reguler` VALUES (9482, '2019-03-01 16:13:29', NULL, '2019-03-08 16:38:12', 11, 'LOUHSUMAWE');
INSERT INTO `kota_reguler` VALUES (9483, '2019-03-01 16:13:40', NULL, '2019-03-08 16:38:09', 11, 'LANGSA');
INSERT INTO `kota_reguler` VALUES (9484, '2019-03-01 16:14:11', NULL, '2019-03-08 16:38:06', 11, 'MOELABOH');
INSERT INTO `kota_reguler` VALUES (9485, '2019-03-05 10:58:16', NULL, '2019-03-08 16:38:02', 73, 'MAKASAR');
INSERT INTO `kota_reguler` VALUES (9486, '2019-03-05 10:58:50', NULL, '2019-03-08 16:37:59', 71, 'MANADO');
INSERT INTO `kota_reguler` VALUES (9487, '2019-03-05 10:59:19', NULL, '2019-03-08 16:37:56', 74, 'KENDARI');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `ipaddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `useragent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `module_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_menu_id` int(11) NOT NULL DEFAULT 0,
  `sorting` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, '2017-06-08 00:41:48', '2017-07-06 02:50:15', NULL, 'dashboard#', 'Home', 'fa fa-dashboard', 0, 0);
INSERT INTO `menu` VALUES (5, '2017-06-08 01:03:17', '2017-06-13 22:24:37', NULL, 'dashboard/info', 'Informasi', 'fa fa-info', 1, 3);
INSERT INTO `menu` VALUES (16, '2017-06-08 01:35:27', '2017-07-06 02:50:45', NULL, 'master#', 'Master', 'fa fa-cubes', 0, 7);
INSERT INTO `menu` VALUES (39, '2017-06-08 01:57:21', '2017-07-06 02:51:40', NULL, 'masterberita#', 'Berita', 'fa fa-newspaper-o', 16, 5);
INSERT INTO `menu` VALUES (40, '2017-06-08 01:58:02', NULL, NULL, 'berita', 'Informasi', 'fa fa-newspaper-o', 39, 2);
INSERT INTO `menu` VALUES (41, '2017-06-08 02:07:25', NULL, NULL, 'kategori-berita', 'Kategori', 'fa fa-tags', 39, 1);
INSERT INTO `menu` VALUES (42, '2017-06-08 02:08:02', '2017-07-06 02:51:52', NULL, 'masterkaryawan#', 'Karyawan', 'fa fa-users', 16, 6);
INSERT INTO `menu` VALUES (43, '2017-06-08 02:08:29', NULL, NULL, 'karyawan', 'Karyawan', 'fa fa-user', 42, 2);
INSERT INTO `menu` VALUES (44, '2017-06-08 02:08:48', NULL, NULL, 'user', 'User', 'fa fa-user', 42, 3);
INSERT INTO `menu` VALUES (45, '2017-06-08 02:09:09', '2017-06-13 08:34:15', '2021-04-07 10:33:47', 'role', 'Jabatan', 'fa fa-bars', 42, 3);
INSERT INTO `menu` VALUES (48, '2017-06-08 02:15:39', NULL, '2021-04-07 10:35:20', 'kalendar-libur', 'Kalendar', 'fa fa-calendar', 16, 9);
INSERT INTO `menu` VALUES (67, '2021-04-07 10:20:35', NULL, NULL, 'wilayah#', 'Wilayah', 'fa fa-flag', 16, 10);
INSERT INTO `menu` VALUES (68, '2021-04-07 10:22:14', NULL, NULL, 'provinsi', 'Provinsi', 'fa fa-tags', 67, 1);
INSERT INTO `menu` VALUES (69, '2021-04-07 10:22:16', NULL, NULL, 'reguler-kota', 'Kota', 'fa fa-tag', 67, 2);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NULL DEFAULT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT 0,
  `can_read` tinyint(1) NOT NULL DEFAULT 0,
  `can_create` tinyint(1) NOT NULL DEFAULT 0,
  `can_update` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for provinsi
-- ----------------------------
DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE `provinsi`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 95 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of provinsi
-- ----------------------------
INSERT INTO `provinsi` VALUES (11, NULL, NULL, NULL, 'ACEH');
INSERT INTO `provinsi` VALUES (12, NULL, NULL, NULL, 'SUMATERA UTARA');
INSERT INTO `provinsi` VALUES (13, NULL, NULL, NULL, 'SUMATERA BARAT');
INSERT INTO `provinsi` VALUES (14, NULL, NULL, NULL, 'RIAU');
INSERT INTO `provinsi` VALUES (15, NULL, NULL, NULL, 'JAMBI');
INSERT INTO `provinsi` VALUES (16, NULL, NULL, NULL, 'SUMATERA SELATAN');
INSERT INTO `provinsi` VALUES (17, NULL, NULL, NULL, 'BENGKULU');
INSERT INTO `provinsi` VALUES (18, NULL, NULL, NULL, 'LAMPUNG');
INSERT INTO `provinsi` VALUES (19, NULL, NULL, NULL, 'KEPULAUAN BANGKA BELITUNG');
INSERT INTO `provinsi` VALUES (21, NULL, NULL, NULL, 'KEPULAUAN RIAU');
INSERT INTO `provinsi` VALUES (31, NULL, NULL, NULL, 'DKI JAKARTA');
INSERT INTO `provinsi` VALUES (32, NULL, NULL, NULL, 'JAWA BARAT');
INSERT INTO `provinsi` VALUES (33, NULL, NULL, NULL, 'JAWA TENGAH');
INSERT INTO `provinsi` VALUES (34, NULL, NULL, NULL, 'DI YOGYAKARTA');
INSERT INTO `provinsi` VALUES (35, NULL, NULL, NULL, 'JAWA TIMUR');
INSERT INTO `provinsi` VALUES (36, NULL, NULL, NULL, 'BANTEN');
INSERT INTO `provinsi` VALUES (51, NULL, NULL, NULL, 'BALI');
INSERT INTO `provinsi` VALUES (52, NULL, NULL, NULL, 'NUSA TENGGARA BARAT');
INSERT INTO `provinsi` VALUES (53, NULL, NULL, NULL, 'NUSA TENGGARA TIMUR');
INSERT INTO `provinsi` VALUES (61, NULL, NULL, NULL, 'KALIMANTAN BARAT');
INSERT INTO `provinsi` VALUES (62, NULL, NULL, NULL, 'KALIMANTAN TENGAH');
INSERT INTO `provinsi` VALUES (63, NULL, NULL, NULL, 'KALIMANTAN SELATAN');
INSERT INTO `provinsi` VALUES (64, NULL, NULL, NULL, 'KALIMANTAN TIMUR');
INSERT INTO `provinsi` VALUES (65, NULL, NULL, NULL, 'KALIMANTAN UTARA');
INSERT INTO `provinsi` VALUES (71, NULL, NULL, NULL, 'SULAWESI UTARA');
INSERT INTO `provinsi` VALUES (72, NULL, NULL, NULL, 'SULAWESI TENGAH');
INSERT INTO `provinsi` VALUES (73, NULL, NULL, NULL, 'SULAWESI SELATAN');
INSERT INTO `provinsi` VALUES (74, NULL, NULL, NULL, 'SULAWESI TENGGARA');
INSERT INTO `provinsi` VALUES (75, NULL, NULL, NULL, 'GORONTALO');
INSERT INTO `provinsi` VALUES (76, NULL, NULL, NULL, 'SULAWESI BARAT');
INSERT INTO `provinsi` VALUES (81, NULL, NULL, NULL, 'MALUKU');
INSERT INTO `provinsi` VALUES (82, NULL, NULL, NULL, 'MALUKU UTARA');
INSERT INTO `provinsi` VALUES (91, NULL, NULL, NULL, 'PAPUA BARAT');
INSERT INTO `provinsi` VALUES (94, NULL, NULL, NULL, 'PAPUA');

-- ----------------------------
-- Table structure for referensi
-- ----------------------------
DROP TABLE IF EXISTS `referensi`;
CREATE TABLE `referensi`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parameter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nilai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, '2017-05-13 19:09:58', '2021-04-07 10:35:13', NULL, 'SUPERADMIN', 'a:14:{s:10:\"dashboard#\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:14:\"dashboard/info\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:7:\"master#\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:13:\"masterberita#\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:6:\"berita\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:15:\"kategori-berita\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:15:\"masterkaryawan#\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:8:\"karyawan\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:4:\"user\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:4:\"role\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:14:\"kalendar-libur\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:8:\"wilayah#\";a:1:{s:8:\"can_view\";s:1:\"1\";}s:8:\"provinsi\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}s:12:\"reguler-kota\";a:5:{s:8:\"can_view\";s:1:\"1\";s:10:\"can_create\";s:1:\"1\";s:8:\"can_read\";s:1:\"1\";s:10:\"can_update\";s:1:\"1\";s:10:\"can_delete\";s:1:\"1\";}}');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nilai` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, '2021-04-07 08:11:43', NULL, '_token', 'mrY6jvmGRhkHD6JqSu90Fwv3rbsA3pggKEv1URQF');
INSERT INTO `setting` VALUES (2, '2021-04-07 08:11:43', NULL, 'mail_type', NULL);
INSERT INTO `setting` VALUES (3, '2021-04-07 08:11:43', NULL, 'mail_hostname', NULL);
INSERT INTO `setting` VALUES (4, '2021-04-07 08:11:43', NULL, 'mail_port', NULL);
INSERT INTO `setting` VALUES (5, '2021-04-07 08:11:43', NULL, 'mail_username', NULL);
INSERT INTO `setting` VALUES (6, '2021-04-07 08:11:43', NULL, 'mail_password', NULL);
INSERT INTO `setting` VALUES (7, '2021-04-07 08:11:43', NULL, 'email_admin', NULL);
INSERT INTO `setting` VALUES (8, '2021-04-07 08:11:43', NULL, 'last_app_version', NULL);
INSERT INTO `setting` VALUES (9, '2021-04-07 08:11:43', NULL, 'visit_dokter_baru', '0');
INSERT INTO `setting` VALUES (10, '2021-04-07 08:11:43', NULL, 'auto_closing_visit_plan', NULL);
INSERT INTO `setting` VALUES (11, '2021-04-07 08:11:43', NULL, 'auto_closing_sales_plan', NULL);
INSERT INTO `setting` VALUES (12, '2021-04-07 08:11:43', NULL, 'auto_closing_entry_claim', NULL);
INSERT INTO `setting` VALUES (13, '2021-04-07 08:11:43', NULL, 'max_visit_dokter_per_day', NULL);
INSERT INTO `setting` VALUES (14, '2021-04-07 08:11:43', NULL, 'max_visit_outlet_per_day', NULL);
INSERT INTO `setting` VALUES (15, '2021-04-07 08:11:43', NULL, 'time_visit_siang_from', NULL);
INSERT INTO `setting` VALUES (16, '2021-04-07 08:11:43', NULL, 'time_visit_siang_to', NULL);
INSERT INTO `setting` VALUES (17, '2021-04-07 08:11:43', NULL, 'time_visit_malam_from', NULL);
INSERT INTO `setting` VALUES (18, '2021-04-07 08:11:43', NULL, 'time_visit_malam_to', NULL);
INSERT INTO `setting` VALUES (19, '2021-04-07 08:11:43', NULL, 'submit', 'Simpan');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_karyawan` int(11) NULL DEFAULT NULL,
  `kode_sales` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `catatan_mutasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_provinsi` int(11) NULL DEFAULT NULL,
  `id_kota` int(11) NULL DEFAULT NULL,
  `id_teritorial` int(11) NULL DEFAULT NULL,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_area` int(11) NULL DEFAULT NULL,
  `id_region` int(11) NULL DEFAULT NULL,
  `id_devisi` int(11) NULL DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `last_online_datetime` datetime NULL DEFAULT NULL,
  `last_app_version` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `id_atasan_am` int(11) NULL DEFAULT NULL,
  `id_am` int(11) NULL DEFAULT NULL,
  `id_sm` int(11) NULL DEFAULT NULL,
  `id_gpm` int(11) NULL DEFAULT NULL,
  `id_user_jabatan` int(11) NULL DEFAULT NULL,
  `is_mr_satelite` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_karyawan`(`id_karyawan`, `id_provinsi`, `id_kota`, `id_teritorial`, `id_role`, `id_area`, `id_region`, `id_devisi`, `status`, `is_online`, `id_atasan_am`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1607 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1606, '2017-12-04 01:20:48', '2018-07-03 02:01:44', NULL, 3427, '00.000A', 'admin', '$2y$10$1HzrDjnyL4e6JlKGs4e/2.3H3ETYO8bCvgUSvsRDIqPeSqdWTbY56', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'enable', 0, NULL, '0.0.45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5994, 0);

-- ----------------------------
-- Table structure for versi_app
-- ----------------------------
DROP TABLE IF EXISTS `versi_app`;
CREATE TABLE `versi_app`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_devisi` int(11) NULL DEFAULT NULL,
  `major` int(11) NOT NULL DEFAULT 0,
  `minor` int(11) NOT NULL DEFAULT 0,
  `revision` int(11) NOT NULL DEFAULT 0,
  `build` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
