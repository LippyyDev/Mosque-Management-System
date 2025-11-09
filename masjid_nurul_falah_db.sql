-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 10:22 AM
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
-- Database: `masjid_nurul_falah`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` longtext NOT NULL,
  `kategori` enum('Pengumuman','Kegiatan','Informasi','Dakwah/Kajian') NOT NULL,
  `tanggal_publish` datetime NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `video_youtube` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `kategori`, `tanggal_publish`, `lokasi`, `video_youtube`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Pentingnya Website Masjid di Era Digital, Pengurus Wajib Tahu.', 'Era digital telah membawa perubahan signifikan dalam hampir semua aspek kehidupan, termasuk cara kita berkomunikasi, belajar, bekerja, hingga beribadah. Transformasi digital ini mendorong institusi, baik yang bersifat komersial maupun non-komersial, untuk memiliki platform digital agar tetap relevan dengan kebutuhan masyarakat. Salah satu sektor yang sangat diuntungkan dengan kemajuan teknologi ini adalah rumah ibadah, termasuk masjid. Dalam konteks ini, website masjid menjadi alat penting untuk menjembatani jamaah dengan pengurus masjid. Artikel ini akan membahas pentingnya website masjid di era digital dan bagaimana keberadaannya dapat memberikan manfaat besar bagi jamaah.\r\n\r\nPeran Website Masjid dalam Komunikasi\r\nWebsite masjid berfungsi sebagai media komunikasi yang efektif antara pengurus masjid dan jamaah. Dalam era digital, masyarakat cenderung mencari informasi melalui internet. Dengan adanya website, masjid dapat menyampaikan berbagai informasi penting seperti jadwal shalat, pengumuman kegiatan keagamaan, hingga informasi terkait zakat dan donasi secara cepat dan tepat.\r\n\r\nSelain itu, website masjid memungkinkan komunikasi dua arah. Jamaah dapat memberikan masukan, bertanya, atau bahkan menyampaikan kritik dan saran kepada pengurus masjid melalui fitur kontak atau forum diskusi yang tersedia. Dengan demikian, website masjid tidak hanya menjadi tempat penyampaian informasi, tetapi juga membangun hubungan yang lebih erat antara masjid dan jamaahnya.\r\n\r\nManfaat Website Masjid\r\nWebsite masjid tidak hanya berfungsi sebagai media informasi, tetapi juga memberikan dampak signifikan bagi jamaah dan pengelolaan masjid. Berikut adalah beberapa dampak positif yang bisa dirasakan dengan adanya website masjid:\r\n\r\n1. Meningkatkan Partisipasi Jamaah dalam Kegiatan Masjid\r\nDengan adanya website, pengumuman tentang kegiatan masjid seperti pengajian, buka puasa bersama, hingga jadwal sholat dapat diakses dengan mudah. Jamaah yang mungkin sebelumnya tidak mengetahui kegiatan tersebut bisa lebih terlibat karena informasi tersedia secara transparan dan selalu diperbarui.\r\n\r\n2. Mempermudah Donasi Online untuk Masjid\r\nWebsite masjid dengan fitur donasi online memudahkan jamaah untuk memberikan infak atau sedekah kapan saja dan di mana saja. Ini sangat membantu terutama di era modern, di mana banyak orang lebih memilih transaksi digital daripada secara langsung. Donasi online juga membantu masjid menggalang dana dengan lebih efektif untuk keperluan pembangunan, program sosial, atau bantuan bagi yang membutuhkan.\r\n\r\n3. Memperluas Jangkauan Dakwah\r\nMelalui website, masjid dapat berbagi konten edukasi Islami seperti artikel, ceramah, atau kajian video yang dapat diakses oleh masyarakat di seluruh dunia. Ini membuka peluang bagi masjid untuk berdakwah tidak hanya ke jamaah lokal, tetapi juga ke khalayak yang lebih luas, termasuk generasi muda yang akrab dengan internet.\r\n\r\n4. Meningkatkan Kredibilitas dan Profesionalisme Masjid\r\nMemiliki website menunjukkan bahwa masjid serius dalam pengelolaan dan transparansi. Informasi seperti laporan keuangan, jadwal kegiatan, dan program masjid yang disajikan di website memberikan kepercayaan lebih kepada jamaah. Hal ini menciptakan rasa keterbukaan dan akuntabilitas dari pengurus masjid kepada masyarakat.\r\n\r\n5. Memudahkan Komunikasi Antara Pengurus dan Jamaah\r\nWebsite masjid dapat menyediakan formulir kontak atau fitur tanya jawab untuk memfasilitasi komunikasi langsung antara jamaah dan pengurus. Jamaah dapat dengan mudah menyampaikan saran, kritik, atau pertanyaan terkait masjid. Hal ini menciptakan hubungan yang lebih harmonis antara pengurus dan masyarakat.\r\n\r\n6. Efisiensi dalam Penyebaran Informasi\r\nDaripada mencetak selebaran atau mengandalkan pengumuman langsung, informasi melalui website bisa diakses kapan saja tanpa batas waktu. Ini tidak hanya menghemat biaya, tetapi juga lebih ramah lingkungan dan efisien dalam menjangkau jamaah.\r\n\r\n7. Merangkul generasi muda\r\nGenerasi muda sering mencari jawaban atas pertanyaan spiritual maupun sosial melalui internet. Dengan menyediakan konten edukatif yang relevan di website masjid, mereka dapat menemukan jawaban pada website masjid sekaligus merasa lebih terhubung dengan nilai-nilai Islam.\r\n\r\n\r\nKesimpulan\r\nWebsite masjid adalah langkah penting dalam memanfaatkan teknologi untuk menyebarkan dakwah Islam sekaligus menyediakan informasi yang dibutuhkan oleh jamaah. Dengan fitur-fitur seperti jadwal shalat, pengumuman, layanan donasi online, hingga konten dakwah, website masjid menjadi platform yang sangat relevan untuk menjangkau jamaah di era digital.\r\n\r\nPentingnya memiliki website masjid bukan hanya untuk kebutuhan komunikasi, tetapi juga untuk memperkuat hubungan antara masjid dan jamaahnya. Jika Anda belum memiliki website untuk masjid Anda, sekarang adalah waktu yang tepat untuk memulainya.', 'Informasi', '2025-06-21 09:12:00', 'Makassar', 'https://drive.google.com/file/d/10Pd6q7QeJyCZrr0IRVmhjV7KhDCDimF3/view?usp=sharing', 2, '2025-06-21 01:12:31', '2025-06-26 14:01:28'),
(4, 'Inilah Wajah-Wajah Baru di Balik Kepengurusan Masjid Nurul Falah', 'Sambut Pengurus Baru Masjid Nurul Falah: Semangat Baru, Harapan Baru!\r\n\r\nMasjid Nurul Falah memasuki babak baru dalam perjalanan pengabdiannya kepada umat. Dengan semangat kebersamaan dan niat untuk terus memakmurkan masjid, kepengurusan baru kini resmi terbentuk. Dua sosok utama yang kini dipercaya memimpin adalah Saudara Mani dan Saudara Acim.\r\n\r\nDalam acara serah terima kepengurusan yang berlangsung khidmat, para jamaah menyambut baik kehadiran pengurus baru. Saudara Mani mendapat amanah sebagai ketua pengurus masjid, sementara Saudara Acim akan turut mendampingi dalam berbagai kegiatan dan program keagamaan maupun sosial kemasyarakatan.\r\n\r\n\"Kami hanya ingin berkontribusi sesuai kemampuan kami, demi kebaikan masjid dan jamaah,\" ujar Saudara Mani dalam sambutannya.\r\n\r\nDengan semangat baru ini, diharapkan Masjid Nurul Falah semakin aktif dan berkembang, baik dalam kegiatan ibadah, pendidikan, maupun layanan sosial. Partisipasi dan dukungan dari seluruh jamaah sangat dibutuhkan agar kepengurusan ini mampu membawa perubahan positif dan berkelanjutan.\r\n\r\nMari bersama-sama kita dukung dan doakan Saudara Mani dan Saudara Acim dalam menjalankan amanahnya, agar selalu diberi kekuatan, keikhlasan, dan petunjuk dalam memajukan Masjid Nurul Falah.', 'Informasi', '2025-06-26 21:56:00', 'Lajjoa', '', 2, '2025-06-26 13:58:24', '2025-06-26 13:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `berita_gambar`
--

CREATE TABLE `berita_gambar` (
  `id` int(11) NOT NULL,
  `berita_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `berita_gambar`
--

INSERT INTO `berita_gambar` (`id`, `berita_id`, `gambar`, `created_at`) VALUES
(17, 4, '1750946304_f65034cb5e5c1c8501ce.jpg', '2025-06-26 13:58:24'),
(18, 3, '1750946488_cb0ef462e1068617c73e.png', '2025-06-26 14:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('Pending','Verified','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id`, `nama`, `nominal`, `bukti_pembayaran`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Fadhilyatun Mahmudah, S.H.I.', 100000.00, '1750586248_7e844245d288969ea7ad.png', '', 'Verified', '2025-06-22 09:57:28', '2025-06-22 09:57:40'),
(4, 'poss', 12000.00, '1750586739_624ac3abf59f4d800402.png', '', 'Pending', '2025-06-22 10:05:39', '2025-06-22 10:05:39'),
(5, 'alip', 90000.00, '1750718134_055fc52caf5ae19a8677.png', 'tes', 'Verified', '2025-06-23 22:35:34', '2025-06-23 22:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `video_youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `tanggal`, `foto`, `video_youtube`, `created_at`, `updated_at`) VALUES
(6, 'Kegiatan Rapat Masjid', '2025-06-22', NULL, '', '2025-06-22 12:07:22', '2025-10-24 00:01:22'),
(7, 'Buka Puasa Bersama', '2025-04-13', NULL, '', '2025-10-24 00:02:06', '2025-10-24 00:02:06'),
(8, 'Sahur Bersama', '2025-04-15', NULL, '', '2025-10-24 00:03:16', '2025-10-24 00:03:16'),
(9, 'Berbagi Sembako', '2025-01-01', NULL, '', '2025-10-24 00:07:49', '2025-10-24 00:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_gambar`
--

CREATE TABLE `galeri_gambar` (
  `id` int(11) NOT NULL,
  `galeri_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `galeri_gambar`
--

INSERT INTO `galeri_gambar` (`id`, `galeri_id`, `gambar`, `created_at`) VALUES
(31, 6, '1761264082_2fe16393d5116d969450.png', '2025-10-24 00:01:22'),
(32, 7, '1761264126_2a6e6349a2ec2856140b.jpg', '2025-10-24 00:02:06'),
(33, 8, '1761264196_c51b9bf1bf30492a525f.webp', '2025-10-24 00:03:16'),
(34, 9, '1761264469_21604d3d7f95054c3c34.jpg', '2025-10-24 00:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `imam_khatib`
--

CREATE TABLE `imam_khatib` (
  `id` int(11) NOT NULL,
  `nama_imam` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Shalat Jumat','Tarawih','Idul Fitri','Idul Adha') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_khatib` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `imam_khatib`
--

INSERT INTO `imam_khatib` (`id`, `nama_imam`, `tanggal`, `jenis`, `keterangan`, `created_at`, `updated_at`, `nama_khatib`) VALUES
(3, 'Acim', '2025-07-04', 'Shalat Jumat', '', '2025-06-22 04:00:04', '2025-06-23 10:31:56', 'Ustadz Abdul Somad');

-- --------------------------------------------------------

--
-- Table structure for table `imam_muadzin_harian`
--

CREATE TABLE `imam_muadzin_harian` (
  `id` int(11) NOT NULL,
  `nama_imam_harian` varchar(100) NOT NULL,
  `nama_muadzin` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `imam_muadzin_harian`
--

INSERT INTO `imam_muadzin_harian` (`id`, `nama_imam_harian`, `nama_muadzin`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Andi Hasyim', 'Mani', NULL, '', '2025-06-22 21:59:13', '2025-06-23 09:07:46'),
(2, 'Muhammad Alif Qadri', 'Muhammad Alif Qadri', NULL, '', '2025-06-22 22:45:41', '2025-06-22 22:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('Baik','Rusak','Diperbaiki') NOT NULL DEFAULT 'Baik',
  `foto_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `nama_barang`, `kategori`, `tanggal_pembelian`, `jumlah`, `kondisi`, `foto_barang`, `created_at`, `updated_at`) VALUES
(1, 'TES', 'Sosial', '2025-06-20', 1, 'Baik', '1750381805_d8456c3cf051f46399f9.png', '2025-06-19 17:10:05', '2025-06-19 19:17:47'),
(2, 'dsdsSSA', 'SASA', '2025-06-20', 1, 'Baik', '1750389118_9dbc074bb822dd7badaf.jpeg', '2025-06-19 19:11:58', '2025-06-19 19:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti_transaksi` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `tanggal_transaksi`, `jenis`, `kategori`, `nominal`, `keterangan`, `bukti_transaksi`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2025-06-20', 'Pemasukan', 'Zakat', 50000.00, 'tes', '1750383744_2408ed3273166bcd6856.png', 2, '2025-06-19 17:42:24', '2025-06-19 17:42:52'),
(2, '2025-06-21', 'Pemasukan', 'Donasi', 9500000.00, '', NULL, 2, '2025-06-21 11:45:38', '2025-06-21 11:45:38'),
(3, '2025-03-21', 'Pemasukan', 'Donasi', 3000000.00, '', NULL, 2, '2025-06-21 11:56:22', '2025-06-21 11:56:35'),
(4, '2025-06-22', 'Pengeluaran', 'Kegiatan', 200000.00, 'Makan makan', NULL, 2, '2025-06-22 05:11:42', '2025-06-22 05:11:42'),
(5, '2025-06-22', 'Pemasukan', 'Donasi', 100000.00, 'Donasi dari alip', NULL, 2, '2025-06-22 09:27:10', '2025-06-22 09:27:10'),
(6, '2025-06-22', 'Pemasukan', 'Donasi', 100000.00, 'Donasi dari Fadhilyatun Mahmudah, S.H.I.', NULL, 2, '2025-06-22 09:57:40', '2025-06-22 09:57:40'),
(7, '2025-06-24', 'Pemasukan', 'Donasi', 90000.00, 'Donasi dari alip', NULL, 2, '2025-06-23 22:35:50', '2025-06-24 13:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `isi_masukan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`id`, `nama`, `kontak`, `isi_masukan`, `created_at`, `updated_at`) VALUES
(1, 'alip', '', 'TES PO', '2025-06-22 10:49:33', '2025-06-22 10:49:33'),
(2, 'ACIM', '', 'KOTOR LANTAI NYA', '2025-07-05 23:42:00', '2025-07-05 23:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_masjid` varchar(100) NOT NULL DEFAULT 'Masjid Nurul Falah',
  `alamat` text NOT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rekening_bank` text DEFAULT NULL,
  `foto_qris` varchar(255) DEFAULT NULL,
  `qris_visible` tinyint(1) NOT NULL DEFAULT 1,
  `sejarah` longtext DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `tahun_berdiri` year(4) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_masjid`, `alamat`, `nomor_hp`, `email`, `rekening_bank`, `foto_qris`, `qris_visible`, `sejarah`, `visi`, `misi`, `tahun_berdiri`, `updated_at`) VALUES
(1, 'Masjid Nurul Falah', 'Leworeng, Kec. Donri Donri, Kab. Soppeng, Sulsel 90853', '089647090771', 'info@masjidnurinsankamil.com', 'BRI: 9012931301 BNI: BNI: 9012931301', '1750543097_b485c401c652452d1888.png', 1, 'Masjid Nurul Falah didirikan sebagai pusat ibadah dan kegiatan keagamaan masyarakat Desa Leworeng. Masjid ini menjadi tempat berkumpulnya umat Muslim untuk melaksanakan ibadah dan memperkuat ukhuwah islamiyah.', 'Menjadi pusat ibadah dan dakwah yang mampu membina umat menuju kehidupan yang islami dan berkualitas.', '1. Menyelenggarakan kegiatan ibadah dan dakwah secara berkesinambungan\r\n2. Membina generasi muda muslim yang berakhlak mulia\r\n3. Mengembangkan kegiatan sosial kemasyarakatan\r\n4. Menjadi pusat pendidikan agama Islam', '2010', '2025-06-24 11:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Anuws', 'Hakim Tinggi', '1750380363_36bf903fc9be54dbfc65.webp', '2025-06-18 21:03:50', '2025-06-19 16:46:03'),
(2, 'Kahar Lampe', 'Ketua', '1750384549_377b4be8a68f6ce021b9.jpeg', '2025-06-19 17:55:49', '2025-06-21 11:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `persuratan`
--

CREATE TABLE `persuratan` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `perihal` varchar(200) NOT NULL,
  `isi_surat` longtext NOT NULL,
  `nama_penandatangan` varchar(100) NOT NULL,
  `jabatan_penandatangan` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `persuratan`
--

INSERT INTO `persuratan` (`id`, `lokasi`, `tanggal`, `nomor`, `lampiran`, `perihal`, `isi_surat`, `nama_penandatangan`, `jabatan_penandatangan`, `created_by`, `created_at`, `updated_at`, `tujuan`) VALUES
(6, 'we', '2025-06-21', '05/MNF/VI/2025', '1', 'Tes', 'Assalamu’alaikum Warahmatullahi Wabarakatuh\r\n\r\nSegala puji hanya milik Allah Subhanahu wa Ta’ala, shalawat serta salam semoga tercurah kepada junjungan kita Nabi Muhammad Shallallahu ‘alaihi wasallam, beserta keluarga dan para sahabatnya.\r\n\r\nDengan ini, kami pengurus Masjid Nurul Falah Leworeng mengajak partisipasi seluruh warga untuk bersama-sama melaksanakan kerja bakti dalam rangka menjaga kebersihan dan kenyamanan masjid kita tercinta.\r\n\r\nAdapun kegiatan kerja bakti akan dilaksanakan pada:\r\n\r\nHari/Tanggal : Minggu, 29 Juni 2025\r\nWaktu : Pukul 07.30 WITA – Selesai\r\nTempat : Masjid Nurul Falah, Desa Leworeng\r\n\r\nKegiatan ini meliputi pembersihan area dalam dan luar masjid, taman, tempat wudhu, serta lingkungan sekitar masjid. Diharapkan kepada seluruh warga untuk membawa peralatan kebersihan seperti sapu, cangkul, parang, dan alat kebersihan lainnya yang dimiliki.\r\n\r\nPartisipasi Bapak/Ibu/Saudara/i sangat kami harapkan demi terwujudnya masjid yang bersih, nyaman, dan menambah kekhusyukan dalam beribadah.\r\n\r\nDemikian surat ini kami sampaikan. Atas perhatian dan kehadirannya, kami ucapkan terima kasih.\r\n\r\nWassalamu’alaikum Warahmatullahi Wabarakatuh', 'Kahar Lampe', 'Pengurus Masjid', 2, '2025-06-24 14:01:15', '2025-06-26 13:25:37', 'Masyarakat1'),
(7, '', '0000-00-00', '', NULL, '', '<div style=\"font-family:\'Times New Roman\',Times,serif;\">\r\n                    <table style=\"width:100%;margin-bottom:10px;\">\r\n                        <tbody><tr><td style=\"width:90px;\"><b>Nomor</b></td><td style=\"width:10px;\">:</td><td></td></tr>\r\n                        <tr><td><b>Lampiran</b></td><td>:</td><td></td></tr>\r\n                        <tr><td><b>Perihal</b></td><td>:</td><td></td></tr>\r\n                    </tbody></table>\r\n                    <div style=\"margin-bottom:20px;\">\r\n                        <div>Kepada Yth.</div>\r\n                        <div style=\"font-weight:bold;\"> </div>\r\n                        <div>di-</div>\r\n                        <div style=\"font-weight:bold;letter-spacing:2px;\">T E M P A T</div>\r\n                    </div>\r\n                    <div style=\"min-height:200px;\">d</div><div style=\"min-height:200px;\">sd</div>\r\n                </div>', '', '', 2, '2025-06-24 22:35:38', '2025-06-24 22:35:38', ''),
(8, '', '0000-00-00', '', NULL, '', '<div style=\"font-family:\'Times New Roman\',Times,serif;\">\r\n                    <table style=\"width:100%;margin-bottom:10px;\">\r\n                        <tbody><tr><td style=\"width:90px;\"><b>Nomor</b></td><td style=\"width:10px;\">:</td><td></td></tr>\r\n                        <tr><td><b>Lampiran</b></td><td>:</td><td></td></tr>\r\n                        <tr><td><b>Perihal</b></td><td>:</td><td></td></tr>\r\n                    </tbody></table>\r\n                    <div style=\"margin-bottom:20px;\">\r\n                        <div>Kepada Yth.</div>\r\n                        <div style=\"font-weight:bold;\"> </div>\r\n                        <div>di-</div>\r\n                        <div style=\"font-weight:bold;letter-spacing:2px;\">T E M P A T</div>\r\n                    </div>\r\n                    <div style=\"min-height:200px;\">d</div><div style=\"min-height:200px;\">sd</div>\r\n                </div>', '', '', 2, '2025-06-24 22:35:38', '2025-06-24 22:35:38', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `foto_profil`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2a$12$i5fgU9jp.O9p8U2ZyQcpN.j841PaKigzFnQlN70SturxKD1rIojeC', 'Administrator', 'Admin', '1750454640_7e40f28c3430b7372d2f.jpeg', '2025-06-19 04:39:05', '2025-10-23 23:54:08'),
(2, 'user', '$2a$12$i5fgU9jp.O9p8U2ZyQcpN.j841PaKigzFnQlN70SturxKD1rIojeC', 'Max Verstappen', 'User', '1750896300_1c098303a76ea7cd5f1b.jpg', '2025-06-19 04:39:05', '2025-10-23 23:54:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_berita_user` (`created_by`);

--
-- Indexes for table `berita_gambar`
--
ALTER TABLE `berita_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_berita_gambar` (`berita_id`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri_gambar`
--
ALTER TABLE `galeri_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_galeri_gambar` (`galeri_id`);

--
-- Indexes for table `imam_khatib`
--
ALTER TABLE `imam_khatib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imam_muadzin_harian`
--
ALTER TABLE `imam_muadzin_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_keuangan_user` (`created_by`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persuratan`
--
ALTER TABLE `persuratan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persuratan_user` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `berita_gambar`
--
ALTER TABLE `berita_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galeri_gambar`
--
ALTER TABLE `galeri_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `imam_khatib`
--
ALTER TABLE `imam_khatib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imam_muadzin_harian`
--
ALTER TABLE `imam_muadzin_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persuratan`
--
ALTER TABLE `persuratan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `fk_berita_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berita_gambar`
--
ALTER TABLE `berita_gambar`
  ADD CONSTRAINT `fk_berita_gambar` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galeri_gambar`
--
ALTER TABLE `galeri_gambar`
  ADD CONSTRAINT `fk_galeri_gambar` FOREIGN KEY (`galeri_id`) REFERENCES `galeri` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `fk_keuangan_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `persuratan`
--
ALTER TABLE `persuratan`
  ADD CONSTRAINT `fk_persuratan_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
