-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2019 at 11:11 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azarstar_azarstar`
--

-- --------------------------------------------------------

--
-- Table structure for table `convert_words`
--

CREATE TABLE `convert_words` (
  `id` int(11) NOT NULL,
  `latin` varchar(50) NOT NULL DEFAULT '0',
  `arab` varchar(50) NOT NULL DEFAULT '0',
  `useradd` int(11) NOT NULL DEFAULT '0',
  `useredit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dict_bodies`
--

CREATE TABLE `dict_bodies` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dict_names`
--

CREATE TABLE `dict_names` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `author` varchar(100) DEFAULT NULL,
  `direction` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `alphabet` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dict_words`
--

CREATE TABLE `dict_words` (
  `id` int(11) NOT NULL,
  `dict_id` int(11) NOT NULL DEFAULT '0',
  `word_id` int(11) NOT NULL DEFAULT '0',
  `pronun` varchar(100) NOT NULL DEFAULT '',
  `speachpart` varchar(100) NOT NULL DEFAULT '',
  `deriv` varchar(100) NOT NULL DEFAULT '',
  `freq` tinyint(4) NOT NULL DEFAULT '0',
  `date_insert` int(11) NOT NULL DEFAULT '0',
  `date_update` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mywords`
--

CREATE TABLE `mywords` (
  `id` int(11) NOT NULL,
  `w` varchar(255) DEFAULT NULL,
  `m` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partofspeech`
--

CREATE TABLE `partofspeech` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `toposystems`
--

CREATE TABLE `toposystems` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `word` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `convert_words`
--
ALTER TABLE `convert_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dict_bodies`
--
ALTER TABLE `dict_bodies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dict_names`
--
ALTER TABLE `dict_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dict_words`
--
ALTER TABLE `dict_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mywords`
--
ALTER TABLE `mywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partofspeech`
--
ALTER TABLE `partofspeech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toposystems`
--
ALTER TABLE `toposystems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convert_words`
--
ALTER TABLE `convert_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dict_names`
--
ALTER TABLE `dict_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dict_words`
--
ALTER TABLE `dict_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mywords`
--
ALTER TABLE `mywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partofspeech`
--
ALTER TABLE `partofspeech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toposystems`
--
ALTER TABLE `toposystems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
