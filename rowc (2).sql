-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2018 at 09:13 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rowc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '1' COMMENT '0=>main admin,1=>sub admin,2=>coach',
  `status` enum('Active','Not Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `last_name`, `phone`, `email`, `password`, `remember_token`, `profile`, `gender`, `language`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin p', NULL, '56565656', 'admin@gmail.com', '$2y$10$Mmt3ePI1c2oi4arjezdeH.DaARy45wQPKQbsZLPqQCaJci9X5Rcse', 'fMBrUU4bbGS2RZr2Nk53XFle8crc0zfiJeu4LElQx9hDKRI9VGMx0cmctAk5', '1530288706dU4ap.jpg', NULL, NULL, 0, 'Active', '2017-11-14 20:08:24', '2018-07-02 16:14:42'),
(2, 'subadmin', NULL, '456454566', 'subadmin@gmail.com', '$2y$10$Mmt3ePI1c2oi4arjezdeH.DaARy45wQPKQbsZLPqQCaJci9X5Rcse', NULL, NULL, NULL, NULL, 1, 'Not Active', '2018-07-02 07:19:49', '2018-07-19 12:28:32'),
(3, 'nell', NULL, '5456465465', 'nelson@gmail.com', '$2y$10$NsrubRBxbniljQdUb6OeeOLvdp81X1vlR1LNWYVZAM1OETimfG47m', NULL, NULL, NULL, NULL, 1, 'Active', '2018-07-02 08:34:28', '2018-07-02 08:34:28'),
(4, 'josh', 'pathan', '54564564564654', 'josh@gmail.com', '$2y$10$YYZeRXEFR4rbqa.LcovFzOE4ln4kU4UWft8ZFaJTIOCtoT5Y9STMu', NULL, NULL, 'Male', 'English,Spanish', 2, 'Active', '2018-07-02 09:49:21', '2018-07-02 10:23:24'),
(5, 'mollie', 'pay', '45456456456', 'coach@gmail.com', '$2y$10$DorNoLiO5PQlB4TJdOIeU.Z03Yb7YTRXHZTHOfVR0Jlw5TCQG7AEu', 'A7OrwRaMY0s0wlJYWB9PylP7S17IsbDuwn8zPSzUfNVB8lwj5jarBjYqNVZO', '1530547106HArzK.jpg', 'Female', 'English,Spanish', 2, 'Active', '2018-07-02 10:09:43', '2018-07-02 16:40:26'),
(6, 'hurry', 'maker', '45645646465465', 'markson@gmail.com', '$2y$10$Higo2DoPPsllqSNFICwvlO.zsrk0X9bGsM2zcs84u6fRiowBof9iK', 'RcElYaNtYbAw2JvZ3YxtZt6JGk9mir3efDP6tBTkPUYGGTZDBuZQlIlasuLE', NULL, 'Male', 'English', 2, 'Active', '2018-07-02 10:10:55', '2018-07-02 15:57:25'),
(7, 'tom', 'tom', '1324134141', 'tom@gmail.com', '$2y$10$JnFV0I5awW3Qv361kLV1/erSuNaVYWOgyobAMECLau8NwygV13IZG', 'q1sdbncJObMEpeC0htYqlHz6zPbYUPZOsswg1NJKiv4cR3kFnMMkTEKRnxfx', NULL, 'Male', 'English,Spanish', 2, 'Active', '2018-07-06 05:20:11', '2018-07-06 05:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `track_id`, `student_id`, `hour`, `date`, `created_at`, `updated_at`) VALUES
(13, 2, 1, 6, '2018-07-22', '2018-07-22 23:45:03', '2018-07-22 23:45:03'),
(3, 2, 20, 6, '2018-07-22', '2018-07-22 10:11:12', '2018-07-22 10:11:12'),
(4, 2, 21, 6, '2018-07-21', '2018-07-22 10:11:17', '2018-07-22 10:11:53'),
(5, 2, 22, 6, '2018-07-22', '2018-07-22 10:11:20', '2018-07-22 10:11:20'),
(6, 2, 23, 6, '2018-07-22', '2018-07-22 10:11:26', '2018-07-22 10:11:26'),
(7, 2, 24, 6, '2018-07-22', '2018-07-22 10:11:28', '2018-07-22 10:11:28'),
(8, 2, 26, 6, '2018-07-22', '2018-07-22 10:11:33', '2018-07-22 10:11:33'),
(9, 2, 2, 6, '2018-07-22', '2018-07-22 10:11:36', '2018-07-22 10:11:36'),
(10, 2, 4, 6, '2018-07-22', '2018-07-22 10:11:38', '2018-07-22 10:11:38'),
(11, 2, 21, 6, '2018-07-22', '2018-07-22 10:11:58', '2018-07-22 10:11:58'),
(14, 2, 1, 6, '2018-07-23', '2018-07-23 16:51:40', '2018-07-23 16:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `coach_documents`
--

CREATE TABLE `coach_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `coach_id` int(11) NOT NULL,
  `document_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `document_file` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coach_documents`
--

INSERT INTO `coach_documents` (`id`, `coach_id`, `document_type`, `document_file`, `created_at`, `updated_at`) VALUES
(1, 5, 'Medical', '1532187758v52Gz.docx', '2018-07-21 15:40:22', '2018-07-21 15:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `coach_track`
--

CREATE TABLE `coach_track` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coach_track`
--

INSERT INTO `coach_track` (`id`, `coach_id`, `track_id`, `created_at`, `updated_at`) VALUES
(3, 4, 8, '2018-07-15 14:49:08', '2018-07-15 14:49:08'),
(2, 5, 2, '2018-07-02 18:46:33', '2018-07-02 18:46:33'),
(4, 4, 11, '2018-07-19 11:15:40', '2018-07-19 11:15:40'),
(5, 7, 12, '2018-07-15 14:51:20', '2018-07-15 14:51:20'),
(6, 4, 5, '2018-07-15 14:51:34', '2018-07-15 14:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `common_documents`
--

CREATE TABLE `common_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `document_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Parent',
  `common_file` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `common_documents`
--

INSERT INTO `common_documents` (`id`, `title`, `document_type`, `common_file`, `created_at`, `updated_at`) VALUES
(2, 'RWC Staff Code of Conduct', 'Coach', '1531157520NjeTU.pdf', '2018-07-09 17:27:57', '2018-07-22 05:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_07_102346_create_email_templates_table', 2),
(4, '2018_02_07_102857_create_email_tmplates_table', 3),
(5, '2018_02_07_121408_create_email_templates_table', 4),
(6, '2018_02_08_042449_create_role_managements_table', 5),
(7, '2018_02_09_041705_create_sub_admins_table', 6),
(8, '2018_02_09_075633_create_business_users_table', 7),
(9, '2018_02_09_080114_create_customers_table', 8),
(10, '2018_02_09_100924_create_promotions_table', 9),
(11, '2018_02_09_114830_create_general_settings_table', 10),
(12, '2018_02_20_110629_create_add_templates_table', 11),
(13, '2018_02_20_175007_create_events_table', 12),
(14, '2018_02_21_162739_create_places_table', 13),
(15, '2018_02_26_151612_create_jobs_table', 14),
(16, '2018_03_28_165356_create_dispute_places_table', 15),
(17, '2018_06_17_110944_create_tracks_table', 16),
(18, '2018_06_17_111857_create_coaches_table', 17),
(19, '2018_06_17_112907_create_students_table', 18),
(20, '2018_07_02_165829_create_parents_table', 19),
(21, '2018_07_02_170403_create_parent_details_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `start_date`, `end_date`, `location`, `created_at`, `updated_at`) VALUES
(1, 'RWC-Fall', '2018-06-19', '2019-02-22', 'GITC', '2018-06-29 16:21:41', '2018-06-29 16:21:41'),
(2, 'RWC -Summerrrr', '2018-06-21 00:00:00', '2020-05-21 00:00:00', 'GITC', '2018-06-29 16:26:44', '2018-06-29 16:26:44'),
(3, 'RWC-Testing', '2018-06-15 00:00:00', '2018-10-18 00:00:00', 'GITC', '2018-06-29 16:27:28', '2018-06-29 16:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `section_track`
--

CREATE TABLE `section_track` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_track`
--

INSERT INTO `section_track` (`id`, `section_id`, `track_id`, `created_at`, `updated_at`) VALUES
(14, 2, 8, '2018-07-19 12:34:52', '2018-07-19 12:34:52'),
(13, 2, 4, '2018-07-19 12:34:52', '2018-07-19 12:34:52'),
(12, 2, 3, '2018-07-19 12:34:52', '2018-07-19 12:34:52'),
(11, 1, 2, '2018-07-15 14:53:48', '2018-07-15 14:53:48'),
(9, 3, 4, '2018-07-15 13:23:26', '2018-07-15 13:23:26'),
(8, 3, 3, '2018-07-15 13:23:26', '2018-07-15 13:23:26'),
(10, 3, 5, '2018-07-15 13:23:26', '2018-07-15 13:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `unique_identity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `unique_identity`, `created_at`, `updated_at`) VALUES
(1, 'paresh', 'gababni', 'paresh@gmail.com', '8866292528', 'Male', '1_2018_paresh', '2018-06-17 18:30:00', '2018-06-10 18:30:00'),
(2, 'sam', 'patel', 'sam@gmail.com', '13215656', 'Male', '2_2018_sam', '2018-07-02 11:18:20', '2018-07-02 11:19:08'),
(3, 'kk', 'kk', 'kk@gmail.com', '123231231', 'Male', '3_2018_kk', '2018-07-06 05:24:07', '2018-07-06 05:24:07'),
(4, 'Tomas', 'tom', 'tomas@gmail.com', '123123123', 'Male', '4_2018_Tomas', '2018-07-06 05:24:32', '2018-07-06 05:24:32'),
(5, 'Pinky', 'Shots', 'pinky@gmail.com', '12312142', 'Female', '5_2018_Pinky', '2018-07-06 05:24:57', '2018-07-06 05:24:57'),
(6, 'Roy', 'joshoua', 'roy@gmail.com', '123124124', 'Male', '6_2018_Roy', '2018-07-06 05:25:17', '2018-07-06 05:25:17'),
(7, 'Ron', 'rim', 'ron@gmail.com', '45341243242', 'Male', '7_2018_Ron', '2018-07-06 05:25:47', '2018-07-06 05:25:47'),
(8, 'Pinky', 'Shots', 'pinky@gmail.com', '234342344', 'Female', '8_2018_Pinky', '2018-07-06 05:26:34', '2018-07-06 05:26:34'),
(10, 'Eugenio', 'Gade', 'Eugenio.Gade@dummy.com', '12312312312', 'Male', '10_2018_Eugenio', '2018-07-10 05:15:18', '2018-07-10 05:15:18'),
(11, 'Merlin', 'Zollars', 'Zollars.Merlin@a.com', '123123123', 'Male', '11_2018_Merlin', '2018-07-10 05:15:57', '2018-07-10 05:15:57'),
(12, 'Gabriele', 'Schug', 'Gabriele.Schug@as.com', '12312312', 'Female', '12_2018_Gabriele', '2018-07-10 05:16:36', '2018-07-10 05:16:36'),
(13, 'Maritza', 'Stoke', 'Maritza.Stoke@a.com', '123123', 'Female', '13_2018_Maritza', '2018-07-10 05:18:18', '2018-07-10 05:18:18'),
(14, 'Russel', 'Nitta', 'Russel.Nitta@asd.com', '123123', 'Male', '14_2018_Russel', '2018-07-10 05:18:48', '2018-07-10 05:18:48'),
(15, 'Kimberley', 'Barcelo', 'Kimberley.Barcelo@ads.com', '123123123', 'Female', '15_2018_Kimberley', '2018-07-10 05:19:23', '2018-07-10 05:19:34'),
(16, 'Joya', 'Lehr', 'Joya.Lehr@qwe.com', '2123123123', 'Female', '16_2018_Joya', '2018-07-10 05:20:13', '2018-07-10 05:20:13'),
(17, 'Kirsten', 'Mccollister', 'Kirsten.Mccollister@asda.com', '12312312', 'Female', '17_2018_Kirsten', '2018-07-10 05:20:45', '2018-07-10 05:20:45'),
(18, 'Shera', 'Rigney', 'Shera.Rigney@asd.com', '123123123', 'Female', '18_2018_Shera', '2018-07-10 05:21:14', '2018-07-10 05:21:14'),
(19, 'Ngan', 'Massman', 'Ngan.Massman@asdasd.com', '12312312', 'Female', '19_2018_Ngan', '2018-07-10 05:21:42', '2018-07-10 05:21:42'),
(20, 'Kacey', 'Snodgrass', 'Kacey.Snodgrass@asda.com', '12312312', 'Female', '20_2018_Kacey', '2018-07-10 05:22:06', '2018-07-10 05:22:06'),
(21, 'Vivan', 'Annunziata', 'Vivan.Annunziata@asdas.com', '12312312', 'Female', '21_2018_Vivan', '2018-07-10 05:22:39', '2018-07-10 05:22:39'),
(22, 'Justa', 'Barahona', 'Barahona.Justa@asd.com', '12312', 'Female', '22_2018_Justa', '2018-07-10 05:23:07', '2018-07-10 05:23:07'),
(23, 'Kareen', 'Danek', 'Kareen.Danek@adas.com', '12312312312', 'Female', '23_2018_Kareen', '2018-07-10 05:23:32', '2018-07-10 05:23:32'),
(24, 'Micha', 'Brabant', 'Micha.Brabant@asd.com', '12312312', 'Female', '24_2018_Micha', '2018-07-10 05:23:58', '2018-07-10 05:23:58'),
(25, 'Kenton', 'Nagata', 'Kenton.Nagata@asda.com', '213123', 'Male', '25_2018_Kenton', '2018-07-10 05:24:23', '2018-07-10 05:24:23'),
(26, 'Jonathan', 'Rheaume', 'Jonathan.Rheaume@asda.com', '123123', 'Male', '26_2018_Jonathan', '2018-07-10 05:25:06', '2018-07-10 05:25:06'),
(27, 'Miguelina', 'Bustamante', 'Bustamante.Miguelina@asda.com', '12312', 'Female', '27_2018_Miguelina', '2018-07-10 05:25:36', '2018-07-10 05:25:36'),
(28, 'Argelia', 'Monks', 'Argelia.Monks@asda.com', '123123', 'Female', '28_2018_Argelia', '2018-07-10 05:26:29', '2018-07-10 05:26:29'),
(29, 'Deneen', 'Sirmans', 'Deneen.Sirmans@asdas.com', '1231231', 'Female', '29_2018_Deneen', '2018-07-10 05:26:55', '2018-07-10 05:26:55'),
(30, 'Joan', 'Justus', 'Joan.Justus@a.com', '1213321', 'Male', '30_2018_Joan', '2018-07-10 05:36:39', '2018-07-10 05:36:39'),
(31, 'Shyla', 'Streiff', 'Shyla.Streiff@a.com', '2132132', 'Female', '31_2018_Shyla', '2018-07-10 05:37:08', '2018-07-10 05:37:08'),
(32, 'Tanja', 'Townes', 'Tanja.Townes@ad.com', '1223243', 'Female', '32_2018_Tanja', '2018-07-10 05:37:39', '2018-07-10 05:37:39'),
(33, 'Loma', 'Lovette', 'Loma.Lovette@ssd.com', '23243221', 'Female', '33_2018_Loma', '2018-07-10 05:38:17', '2018-07-10 05:38:17'),
(34, 'Amelia', 'Alexander', 'Amelia.Alexander@asd.com', '321212342342', 'Female', '34_2018_Amelia', '2018-07-10 05:38:51', '2018-07-10 05:38:51'),
(35, 'Malik', 'Mirarchi', 'Malik.Mirarchi@asda.com', '213231342432', 'Male', '35_2018_Malik', '2018-07-10 05:39:26', '2018-07-10 05:39:26'),
(36, 'Edward', 'Ellsworth', 'Edward.Ellsworth@sad.com', '23131321323', 'Male', '36_2018_Edward', '2018-07-10 05:40:00', '2018-07-10 05:40:00'),
(37, 'Joleen', 'Javier', 'Joleen.Javier@sads.com', '232431432', 'Female', '37_2018_Joleen', '2018-07-10 05:40:36', '2018-07-10 05:40:36'),
(38, 'Diamond', 'Drouin', 'Diamond.Drouin@sda.com', '324214323', 'Female', '38_2018_Diamond', '2018-07-10 05:41:07', '2018-07-10 05:41:07'),
(39, 'Felicita', 'Felten', 'Felicita.Felten@sda.com', '243241', 'Female', '39_2018_Felicita', '2018-07-10 05:42:10', '2018-07-10 05:42:10'),
(40, 'Luanna', 'Leach', 'Luanna.Leach@sdad.com', '32132143', 'Female', '40_2018_Luanna', '2018-07-10 05:42:42', '2018-07-10 05:42:42'),
(41, 'Lenny', 'Lundstrom', 'Lenny.Lundstrom@adsads.com', '32432432', 'Male', '41_2018_Lenny', '2018-07-10 05:43:17', '2018-07-10 05:43:17'),
(42, 'Lilliam', 'Lasater', 'Lilliam.Lasater@eewera.com', '324324324', 'Female', '42_2018_Lilliam', '2018-07-10 05:43:55', '2018-07-10 05:43:55'),
(43, 'Casie', 'Conkling', 'Casie.Conkling@ads.com', '223421243', 'Female', '43_2018_Casie', '2018-07-10 05:44:32', '2018-07-10 05:44:32'),
(44, 'Bev', 'Billy', 'Bev.Billy@asd.com', '23133412', 'Female', '44_2018_Bev', '2018-07-10 05:45:03', '2018-07-10 05:45:03'),
(45, 'Kellie', 'Kennard', 'Kellie.Kennard@asd.com', '2131213', 'Female', '45_2018_Kellie', '2018-07-10 05:45:34', '2018-07-10 05:45:34'),
(46, 'Garret', 'Garver', 'Garret.Garver@sad.com', '3424324', 'Female', '46_2018_Garret', '2018-07-10 05:46:14', '2018-07-10 05:46:14'),
(47, 'Nisha', 'Nicastro', 'Nisha.Nicastro@sad.com', '123132', 'Female', '47_2018_Nisha', '2018-07-10 05:46:58', '2018-07-10 05:46:58'),
(48, 'Vickie', 'Vanguilder', 'Vickie.Vanguilder@asd.com', '1321432', 'Female', '48_2018_Vickie', '2018-07-10 05:47:27', '2018-07-10 05:47:27'),
(49, 'Romona', 'Ruge', 'Romona.Ruge@sad.com', '3424123423', 'Female', '49_2018_Romona', '2018-07-10 05:48:03', '2018-07-10 05:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `student_document`
--

CREATE TABLE `student_document` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_document`
--

INSERT INTO `student_document` (`id`, `parent_id`, `document_type`, `document_file`, `created_at`, `updated_at`) VALUES
(1, 1, 'Health Insurance', '1530640982An47g.pdf', '2018-07-03 18:03:02', '2018-07-03 18:03:02'),
(2, 1, 'Medical Forms', '1530641044ypGHU.docx', '2018-07-03 18:04:04', '2018-07-03 18:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `student_track`
--

CREATE TABLE `student_track` (
  `id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_track`
--

INSERT INTO `student_track` (`id`, `track_id`, `student_id`, `created_at`, `updated_at`) VALUES
(9, 2, 2, '2018-07-03 12:18:05', '2018-07-03 12:18:05'),
(8, 2, 1, '2018-07-03 12:18:02', '2018-07-03 12:18:02'),
(18, 3, 10, '2018-07-10 05:31:20', '2018-07-10 05:31:20'),
(11, 2, 4, '2018-07-07 03:26:00', '2018-07-07 03:26:00'),
(17, 1, 5, '2018-07-09 23:33:33', '2018-07-09 23:33:33'),
(19, 13, 12, '2018-07-10 05:31:51', '2018-07-10 05:31:51'),
(20, 13, 13, '2018-07-10 05:31:57', '2018-07-10 05:31:57'),
(21, 13, 14, '2018-07-10 05:32:01', '2018-07-10 05:32:01'),
(22, 13, 15, '2018-07-10 05:32:05', '2018-07-10 05:32:05'),
(23, 3, 10, '2018-07-10 05:32:23', '2018-07-10 05:32:23'),
(24, 3, 12, '2018-07-10 05:32:29', '2018-07-10 05:32:29'),
(25, 3, 13, '2018-07-10 05:32:33', '2018-07-10 05:32:33'),
(26, 4, 14, '2018-07-10 05:32:40', '2018-07-10 05:32:40'),
(27, 4, 15, '2018-07-10 05:32:43', '2018-07-10 05:32:43'),
(28, 4, 16, '2018-07-10 05:32:46', '2018-07-10 05:32:46'),
(29, 12, 7, '2018-07-10 05:33:51', '2018-07-10 05:33:51'),
(30, 12, 6, '2018-07-10 05:33:56', '2018-07-10 05:33:56'),
(31, 12, 3, '2018-07-10 05:34:16', '2018-07-10 05:34:16'),
(32, 5, 36, '2018-07-10 05:48:23', '2018-07-10 05:48:23'),
(33, 6, 37, '2018-07-10 05:48:30', '2018-07-10 05:48:30'),
(34, 7, 38, '2018-07-10 05:48:36', '2018-07-10 05:48:36'),
(35, 8, 39, '2018-07-10 05:48:44', '2018-07-10 05:48:44'),
(36, 9, 40, '2018-07-10 05:48:52', '2018-07-10 05:48:52'),
(37, 10, 41, '2018-07-10 05:48:58', '2018-07-10 05:48:58'),
(38, 11, 42, '2018-07-10 05:49:04', '2018-07-10 05:49:04'),
(39, 11, 43, '2018-07-10 05:49:10', '2018-07-10 05:49:10'),
(40, 10, 44, '2018-07-10 05:49:16', '2018-07-10 05:49:16'),
(41, 9, 45, '2018-07-10 05:49:22', '2018-07-10 05:49:22'),
(42, 8, 46, '2018-07-10 05:49:34', '2018-07-10 05:49:34'),
(43, 5, 47, '2018-07-10 05:49:41', '2018-07-10 05:49:41'),
(44, 6, 48, '2018-07-10 05:49:47', '2018-07-10 05:49:47'),
(45, 7, 49, '2018-07-10 05:50:01', '2018-07-10 05:50:01'),
(53, 12, 18, '2018-07-10 17:46:30', '2018-07-10 17:46:30'),
(52, 12, 25, '2018-07-10 17:46:16', '2018-07-10 17:46:16'),
(51, 12, 17, '2018-07-10 17:46:13', '2018-07-10 17:46:13'),
(50, 12, 11, '2018-07-10 17:46:09', '2018-07-10 17:46:09'),
(58, 2, 21, '2018-07-19 12:56:50', '2018-07-19 12:56:50'),
(57, 2, 20, '2018-07-19 12:56:28', '2018-07-19 12:56:28'),
(59, 2, 22, '2018-07-19 12:57:13', '2018-07-19 12:57:13'),
(60, 2, 23, '2018-07-19 12:58:19', '2018-07-19 12:58:19'),
(61, 2, 24, '2018-07-19 12:58:51', '2018-07-19 12:58:51'),
(62, 2, 26, '2018-07-19 12:58:55', '2018-07-19 12:58:55'),
(63, 2, 19, '2018-07-23 05:57:31', '2018-07-23 05:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `short_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `short_title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Ionic57', NULL, 'Creation of Mobile apps', '2018-06-29 16:29:06', '2018-06-29 16:29:06'),
(3, 'Film 101', NULL, 'Making Short Film', '2018-06-29 16:29:22', '2018-06-29 16:29:22'),
(4, 'CISCO', NULL, 'SOME NETWORK THING', '2018-06-29 16:29:35', '2018-06-29 16:29:35'),
(5, 'Data Entry', NULL, 'enter data', '2018-06-29 16:29:51', '2018-06-29 16:29:51'),
(6, 'PHP', 'Programming', 'Php Programming Class', '2018-07-06 05:19:04', '2018-07-06 05:19:04'),
(8, 'Foreign Finance', 'XYZ', 'ABC', '2018-07-10 05:28:09', '2018-07-10 05:28:09'),
(9, 'Resource Management', 'XYZ', 'ABC', '2018-07-10 05:29:37', '2018-07-10 05:29:37'),
(10, 'Environmental Development', 'XYZ', 'ABC', '2018-07-10 05:29:56', '2018-07-10 05:29:56'),
(11, 'Biosecurity', 'XYZ', 'ABC', '2018-07-10 05:30:14', '2018-07-10 05:30:14'),
(12, 'Culinary Arts', 'XYZ', 'ABC', '2018-07-10 05:30:33', '2018-07-10 05:30:33'),
(13, 'Language Culture', 'XYZ', 'ABC', '2018-07-10 05:31:03', '2018-07-10 05:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_identity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(161) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `student_identity`, `password`, `phone`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'anmol@gmail.com', 'jay1', 'patel', '1_2018_paresh', '$2y$10$Ij7HdRCakPdTn.ACGxzFB.SDx.BKyy8VSn0YGdVQVKRkld0ZQRmMC', '564456456456', 'Male', '98ea1eWHcCHRVaKgKNdAgmJ548NAlW9aS76JnRtdy8a3pHCs3QzoZ8Wa923H', '2018-06-18 16:21:56', '2018-06-19 02:08:29'),
(2, 'sam@gmail.com', 'sam', 'ping', '2_2018_sam', '$2y$10$Ij7HdRCakPdTn.ACGxzFB.SDx.BKyy8VSn0YGdVQVKRkld0ZQRmMC', '45645645645646', 'Male', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach_documents`
--
ALTER TABLE `coach_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach_track`
--
ALTER TABLE `coach_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common_documents`
--
ALTER TABLE `common_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_track`
--
ALTER TABLE `section_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_document`
--
ALTER TABLE `student_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_track`
--
ALTER TABLE `student_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coach_documents`
--
ALTER TABLE `coach_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coach_track`
--
ALTER TABLE `coach_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `common_documents`
--
ALTER TABLE `common_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section_track`
--
ALTER TABLE `section_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `student_document`
--
ALTER TABLE `student_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_track`
--
ALTER TABLE `student_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
