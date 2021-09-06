-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql106.epizy.com
-- Generation Time: Feb 24, 2021 at 10:05 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_26227062_praktikum`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `title`, `image`, `text`, `date`, `user_id`) VALUES
(50, 'geri jw', 'assets/images/blogImages/small159457849821291234_1668075806558868_1643635889_n.jpg', 'geri jw', 1594578498, 43),
(52, '123', 'assets/images/blogImages/small1594588436B612-2016-07-04-01-52-12.jpg', '123', 1594588436, 46),
(55, 'H proba', 'assets/images/blogImages/small1594595756B612-2016-08-12-03-43-58.jpg', 'H proba', 1594595756, 48),
(56, 'Ovo je macka', 'assets/images/blogImages/small1594596447IMG_20200712_011733.jpg', 'Ovo je macka', 1594596447, 49);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE `blog_tag` (
  `blog_tag_id` int(255) NOT NULL,
  `blog_id` int(255) NOT NULL,
  `tag_id` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`blog_tag_id`, `blog_id`, `tag_id`) VALUES
(16, 50, 7),
(17, 50, 2),
(18, 50, 15),
(20, 52, 2),
(21, 52, 3),
(22, 53, 5),
(23, 53, 10),
(24, 53, 12),
(25, 54, 14),
(26, 54, 7),
(27, 54, 6),
(28, 54, 15),
(29, 54, 10),
(30, 54, 8),
(31, 55, 7),
(32, 55, 15),
(33, 55, 5),
(34, 55, 4),
(35, 55, 12),
(36, 55, 17),
(37, 55, 3),
(38, 56, 14),
(39, 56, 2),
(40, 57, 14),
(41, 57, 1);

-- --------------------------------------------------------

--
-- Table structure for table `footer_link`
--

CREATE TABLE `footer_link` (
  `footer_link_id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `href` varchar(100) NOT NULL,
  `footer_type_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer_link`
--

INSERT INTO `footer_link` (`footer_link_id`, `name`, `href`, `footer_type_id`) VALUES
(1, 'Facebook', 'https://www.facebook.com/', 1),
(2, 'Twitter', 'https://twitter.com/', 1),
(3, 'Instagram', 'https://www.instagram.com/', 1),
(4, 'Documentation', 'documentation.pdf', 2),
(5, 'Author', '#author', 2);

-- --------------------------------------------------------

--
-- Table structure for table `footer_type`
--

CREATE TABLE `footer_type` (
  `footer_type_id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer_type`
--

INSERT INTO `footer_type` (`footer_type_id`, `type`) VALUES
(1, 'social'),
(2, 'additional');

-- --------------------------------------------------------

--
-- Table structure for table `menu_link`
--

CREATE TABLE `menu_link` (
  `menu_link_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `href` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_link`
--

INSERT INTO `menu_link` (`menu_link_id`, `name`, `href`, `icon`) VALUES
(1, 'Sign In', '#modalSignIn', NULL),
(2, 'Sign Up', '#modalSignUp', NULL),
(3, 'Home', '#', 'home'),
(4, 'Profile', '#', 'person'),
(5, 'Logout', 'model/user/logout.php', 'exit_to_app'),
(6, 'Manage', 'index.php?page=manage', 'edit'),
(7, 'Analysis', 'index.php?page=analysis', 'timeline');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `menu_type_id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`menu_type_id`, `type`) VALUES
(1, 'unauthorised'),
(2, 'user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type_menu_link`
--

CREATE TABLE `menu_type_menu_link` (
  `menu_type_menu_link_id` int(100) NOT NULL,
  `menu_type_id` int(50) NOT NULL,
  `menu_link_id` int(50) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_type_menu_link`
--

INSERT INTO `menu_type_menu_link` (`menu_type_menu_link_id`, `menu_type_id`, `menu_link_id`, `priority`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(5, 2, 5, 1),
(6, 3, 6, 2),
(7, 3, 5, 3),
(8, 3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `title`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `title`) VALUES
(1, 'Fashion'),
(2, 'Food'),
(3, 'Travel'),
(4, 'Music'),
(5, 'Lifestyle'),
(6, 'Fitness and health'),
(7, 'Do it yourself'),
(8, 'Sports'),
(9, 'Art'),
(10, 'Parenting'),
(11, 'Business'),
(12, 'Personal'),
(13, 'Gaming'),
(14, 'Animal'),
(15, 'Language learning'),
(16, 'Finance'),
(17, 'Self improvement');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `create_date` int(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `role_id` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `email`, `password`, `image`, `create_date`, `is_active`, `role_id`) VALUES
(43, 'geerisq', NULL, 'geri@gmail.com', 'a71c6294eb0ab003c4f66210d906df88', NULL, 1594305446, 0, 1),
(44, 'geeris', NULL, 'geeris77@gmail.com', '973696ef07947fe7d3f6fa2b354580ed', NULL, 1594372769, 0, 2),
(50, 'milena', NULL, 'milena.vesic@ict.edu.rs', '655fa5d6d229c94f0a320c6332a69144', NULL, 1594806659, 1, 1),
(46, 'slatki123', NULL, 'slatki23@gmail.com', 'd6f32f7cbaa4a852024010ee923fc43a', NULL, 1594494134, 1, 1),
(49, 'LeteZelenko', NULL, 'davazelenko@gmail.com', 'a06e88c49499b53d2c8162a3cb1cd622', NULL, 1594596235, 1, 1),
(48, 'noviKorisnik', NULL, 'novi@gmail.com', '11ed4a4e23539261974cc3147cd2c043', NULL, 1594594856, 0, 1),
(51, 'Sampai', NULL, 'sanddosa@hotmail.com', 'bfee371daf800025e825622161fcb9bb', NULL, 1595860058, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blog_ibfk_1` (`user_id`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`blog_tag_id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `footer_link`
--
ALTER TABLE `footer_link`
  ADD PRIMARY KEY (`footer_link_id`),
  ADD KEY `footer_type_id` (`footer_type_id`);

--
-- Indexes for table `footer_type`
--
ALTER TABLE `footer_type`
  ADD PRIMARY KEY (`footer_type_id`);

--
-- Indexes for table `menu_link`
--
ALTER TABLE `menu_link`
  ADD PRIMARY KEY (`menu_link_id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`menu_type_id`);

--
-- Indexes for table `menu_type_menu_link`
--
ALTER TABLE `menu_type_menu_link`
  ADD PRIMARY KEY (`menu_type_menu_link_id`),
  ADD KEY `menu_type` (`menu_type_id`),
  ADD KEY `menu_link` (`menu_link_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `image` (`image`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `blog_tag_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `footer_link`
--
ALTER TABLE `footer_link`
  MODIFY `footer_link_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `footer_type`
--
ALTER TABLE `footer_type`
  MODIFY `footer_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_link`
--
ALTER TABLE `menu_link`
  MODIFY `menu_link_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `menu_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_type_menu_link`
--
ALTER TABLE `menu_type_menu_link`
  MODIFY `menu_type_menu_link_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
