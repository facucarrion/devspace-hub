-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 01:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devspace-hub`
--
CREATE DATABASE IF NOT EXISTS `devspace-hub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `devspace-hub`;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id_follow` int(11) NOT NULL,
  `id_user_followed` int(11) DEFAULT NULL,
  `id_user_follower` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id_project` int(11) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `upvotes` int(11) DEFAULT NULL,
  `id_user_creator` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects_user`
--

CREATE TABLE `projects_user` (
  `id_projects_user` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `is_editor` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_links`
--

CREATE TABLE `project_links` (
  `id_project_link` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `link` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags_project`
--

CREATE TABLE `tags_project` (
  `id_tags_project` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `id_tag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `display_name`, `email`, `password`, `created_at`) VALUES
(25, 'facucarrion', 'Facundo Carrion', 'facundojcarrion@gmail.com', '$2y$10$GhaUjihqKaeSBsY9mwoDWugqSvyBOVuab9nSOMyEZV9CkZkO487D6', '2023-09-01 14:33:21'),
(26, 'randalfd', 'Randal Gutierrez', 'randal@gmail.com', '$2y$10$i8gdPalVJvHboihMoSR3pebVqSftvOKdO0adLLuDf.BTo8CYHBQfS', '2023-09-11 15:25:22'),
(27, 'jonitoon', 'Joni Martinez', 'joni@gmail.com', '$2y$10$lJUSo4RNMzLCOJSGApvxv.K1Aro8/bD.ZzpMBpTRf.jdImYIdSEEW', '2023-09-11 15:42:15'),
(28, 'pepebargas', 'Pepona', 'pepe@gmail.com', '$2y$10$/euShSSl0Jik.MjPJajbU.SBaNgDIasEOnfsuafttWTiztaf0KS1C', '2023-09-11 15:44:26'),
(29, 'benjitapurrun', 'Benjamin Grosso', 'benja@gmail.com', '$2y$10$DgjlJ8hGYO8CT12umK5yK.agxmDsB71FJX4JJDooKzjVd6Fbgqd3G', '2023-09-11 15:44:43'),
(30, 'lucasfernandez', 'Luquitas', 'lucas@gmail.com', '$2y$10$WwyD7okHKoILIqaKD033muTkDawNDDdmw0sS/9O6lnLxkXWZyk08G', '2023-09-11 15:46:26'),
(31, 'medogames', 'Medo Games', 'medo@gmail.com', '$2y$10$cuo/HIxoomIxFsUn/dDv5u0Fmi.v8mljTe6vSyibWlVM5.pp/7gIC', '2023-09-11 15:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id_user_link` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `link` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `id_user_followed` (`id_user_followed`),
  ADD KEY `id_user_follower` (`id_user_follower`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `id_user_creator` (`id_user_creator`);

--
-- Indexes for table `projects_user`
--
ALTER TABLE `projects_user`
  ADD PRIMARY KEY (`id_projects_user`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `project_links`
--
ALTER TABLE `project_links`
  ADD PRIMARY KEY (`id_project_link`),
  ADD KEY `id_project` (`id_project`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `tags_project`
--
ALTER TABLE `tags_project`
  ADD PRIMARY KEY (`id_tags_project`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_links`
--
ALTER TABLE `user_links`
  ADD PRIMARY KEY (`id_user_link`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects_user`
--
ALTER TABLE `projects_user`
  MODIFY `id_projects_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_links`
--
ALTER TABLE `project_links`
  MODIFY `id_project_link` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags_project`
--
ALTER TABLE `tags_project`
  MODIFY `id_tags_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id_user_link` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`id_user_followed`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`id_user_followed`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `follows_ibfk_3` FOREIGN KEY (`id_user_follower`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`id_user_creator`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`id_user_creator`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `projects_user`
--
ALTER TABLE `projects_user`
  ADD CONSTRAINT `projects_user_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`),
  ADD CONSTRAINT `projects_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `project_links`
--
ALTER TABLE `project_links`
  ADD CONSTRAINT `project_links_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

--
-- Constraints for table `tags_project`
--
ALTER TABLE `tags_project`
  ADD CONSTRAINT `tags_project_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`),
  ADD CONSTRAINT `tags_project_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`);

--
-- Constraints for table `user_links`
--
ALTER TABLE `user_links`
  ADD CONSTRAINT `user_links_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
