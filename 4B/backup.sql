-- phpMyAdmin SQL Dump
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2021 at 09:47 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dumbways`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Joker'),
(2, 'Batman'),
(3, 'Haris A.'),
(4, 'Anto'),
(5, 'Trentan'),
(6, 'Cho'),
(7, 'Rahma');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `video_link` text NOT NULL,
  `type` varchar(45) NOT NULL,
  `id_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `name`, `video_link`, `type`, `id_course`) VALUES
(1, 'aaa', 'dd', '33', 10);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'dalam menit',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `thumbnail`, `author_id`, `duration`, `description`) VALUES
(1, 'PHP', 'php.png', 1, 60, 'Berisikan tutorial pemrograman PHP khusus dasar'),
(2, 'HTML', 'html.png', 2, 60, 'Berisikan tutorial pemrograman PHP khusus dasar dan pemula'),
(3, 'Sass', 'sass.png', 3, 60, 'CSS with superpowers. SASS is the most mature, stable, and powerful'),
(4, 'CSS', 'css.png', 2, 60, 'Cascading Style Sheet (CSS) is a simple mechanism for adding style '),
(5, 'React Native', 'rn.png', 4, 60, 'React Native adalah kerangka kerja aplikasi seluler open source yang '),
(6, 'Javascript', 'js.png', 5, 60, 'Bahasa pemrograman tingkat tinggi dan dinamis. Javascript populer di'),
(7, 'NodeJs', 'nodejs.png', 6, 60, 'Node.js adalah platform perangkat lunak pada sisi peladen dan aplikasi '),
(8, 'Laravel', 'laravel.png', 7, 60, 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka'),
(10, 'adf', 'Screen Shot 2021-05-18 at 22.52.45.png', 2, 33, 'adsf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_course_fk` (`id_course`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_author_fk` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_course_fk` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_author_fk` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
