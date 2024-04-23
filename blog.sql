-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 03:03 AM
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
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `date_posted`, `content`) VALUES
(1, 'testing title', '2024-02-21 22:29:33', 'This is just a test for the content section! '),
(2, 'new testing edit', '2024-02-22 02:42:26', 'completed 2 edit update time stamp'),
(3, 'long test', '2024-02-21 22:47:34', 'Test 1 2 - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut nisi quis quam aliquam consequat non tincidunt ante. Nulla quis tincidunt risus. Mauris ultricies auctor tempus. Duis condimentum vel urna in aliquet. Suspendisse auctor, ex molestie placerat vulputate, arcu enim interdum nunc, eu eleifend nibh tortor vitae turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean porta, nisl ac facilisis lacinia, urna quam egestas lorem, a pulvinar augue dolor id enim.\r\n\r\nNulla finibus est metus, a sodales nulla dapibus quis. Pellentesque in dictum tortor. Praesent euismod leo sit amet nulla lobortis interdum. Sed vulputate turpis nec porta mattis. Nunc sed iaculis leo. Etiam in felis eu odio tempus mattis eu ut arcu. Morbi sit amet eleifend nibh. Vivamus pretium vestibulum augue ut fringilla. Vestibulum imperdiet erat sit amet diam tristique, vitae hendrerit ex blandit. Nam consectetur et metus in elementum. Donec metus ex, laoreet sed lo-'),
(12, 'testing post', '2024-02-22 02:37:26', 'testing post');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
