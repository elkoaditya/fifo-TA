-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 11:41 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eofounder`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `role`, `password`, `profile`, `created_at`, `updated_at`) VALUES
('d31e7dba-5590-4be2-8895-6332914930aa', 'admin', 'Elko Aditya', 'superadmin', 'a47964874fc92720508fc3c87218cddd', 'https://minimaltoolkit.com/images/randomdata/male/2.jpg', '2021-12-22 02:04:25', '2021-12-22 02:04:25');

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id_user`, `alamat`, `nowa`, `email`, `about`, `created_at`, `updated_at`) VALUES
('d31e7dba-5590-4be2-8895-6332914930aa', NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
