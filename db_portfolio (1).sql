-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 26, 2026 at 07:49 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portfolio`
--

-- --------------------------------------------------------

--
-- Drop old tables if they exist
--

DROP TABLE IF EXISTS `tbl_linking_table`;
DROP TABLE IF EXISTS `tbl_projects`;
DROP TABLE IF EXISTS `tbl_software`;
DROP TABLE IF EXISTS `tbl_users`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `projects`;
DROP TABLE IF EXISTS `contacts`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_linking_table`
--

CREATE TABLE `tbl_linking_table` (
  `software_id` int NOT NULL,
  `projects_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `projects_id` int UNSIGNED NOT NULL,
  `mendelbalm_id` int NOT NULL,
  `burple_id` int NOT NULL,
  `mixer_id` int NOT NULL,
  `earbuds_id` int NOT NULL,
  `description` varchar(200) NOT NULL,
  `creators` varchar(200) NOT NULL,
  `date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`projects_id`, `mendelbalm_id`, `burple_id`, `mixer_id`, `earbuds_id`, `description`, `creators`, `date`) VALUES
(1, 1, 1, 1, 1, 'Founded in 1987 and later defunked, Burple is now revived as a fruity, crushed-ice\r\nbeverage. Burple is among some of the highest performing athlete\'s favourite drinks.', 'Liam Kuchta', 2025);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_software`
--

CREATE TABLE `tbl_software` (
  `software_id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `cinema4d` int NOT NULL,
  `adobe` int NOT NULL,
  `html_css_js` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `avatar` int NOT NULL,
  `specialization` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `avatar`, `specialization`) VALUES
(1, 'Liam Kuchta', 1, 'Front-End Web Developer and Designer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`projects_id`);

--
-- Indexes for table `tbl_software`
--
ALTER TABLE `tbl_software`
  ADD PRIMARY KEY (`software_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `projects_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_software`
--
ALTER TABLE `tbl_software`
  MODIFY `software_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `admin_username` varchar(100) UNIQUE NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
-- Default admin credentials: username = admin | password = admin123
--

INSERT INTO `admins` (`admin_username`, `admin_password`) VALUES
('admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P0dKtS');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `project_title` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_image_url` varchar(255),
  `project_url` varchar(255),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_title`, `project_description`, `project_image_url`, `project_url`) VALUES
('Burple', 'Founded in 1987 and later defunked, Burple is now revived as a fruity, crushed-ice beverage. Burple is among some of the highest performing athlete\'s favourite drinks.', 'images/burple2.png', 'burple.html'),
('Audionaut Earbuds', 'Premium earbuds campaign and website design showcasing innovative audio technology and sleek product design.', 'images/earbuds2.jpg', 'audionaut.html'),
('Fanshawe Industry Night', 'Website design and development for Fanshawe College\'s Industry Night event.', 'images/industry2.png', 'industry.html'),
('Music Mixer Site', 'Interactive music mixer application built with custom JavaScript and responsive design.', 'images/mixer.png', 'mixer.html'),
('Mendelbalm Makeup', 'Makeup campaign and branding design for Mendelbalm cosmetics line.', 'images/mendel2.png', 'sportsnet.html'),
('Sportsnet Animation', 'Motion graphics and animation project for Sportsnet media platform.', 'images/sports2.png', 'sportsnet.html');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_message` text NOT NULL,
  `contact_date` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
