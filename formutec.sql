-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 10:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formutec`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `motivo` tinyint(4) NOT NULL,
  `mensaje` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `nombre`, `email`, `motivo`, `mensaje`) VALUES
(5, 'Vicente', 'vicente_prez@hotmail.com', 1, 'menjiderioi846456312456456');

-- --------------------------------------------------------

--
-- Table structure for table `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temas`
--

INSERT INTO `temas` (`id`, `nombre`, `imagen`) VALUES
(19, 'Ãlgebra Lineal', 'http://localhost/FormuTecMatematicasWeb/public/formulas/Ãlgebra Lineal.png'),
(21, 'Probabilidad y EstadÃ­stica', 'http://localhost/FormuTecMatematicasWeb/public/formulas/Probabilidad y EstadÃ­stica.png');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'Vicente Aguilera', 'vicente_prez@hotmail.com', '123456'),
(2, 'vicente', 'vicente@hotmail.com', '12345678'),
(3, 'vicente', 'vice@hotmail.com', '12345678'),
(4, 'vicente', 'vic@hotmail.com', '12345678'),
(5, 'vicente', 'p@gmail.com', '123456789'),
(6, 'vicente', 'vicente_prez13@gmail.com', '123456789'),
(7, 'vicente', 'vicente_prez138@gmail.com', '12345687'),
(8, 'Vicente', 'vicente_p@hotmail.com', '13456111'),
(9, 'Vicente', 'vicente_8rez@hotmail.com', '12345678'),
(10, 'Vicente', 'vicente_8re@hotmail.com', '12345678'),
(11, 'Vicente', 'vicente_8r@hotmail.com', '12345678'),
(12, 'Vicente', 'vicente_r@hotmail.com', '12345678'),
(13, 'Vicente', 'vicente_7@hotmail.com', '123456789'),
(14, 'Vicente', 'vicente_8@hotmail.com', '123456789'),
(15, 'Vicente', 'vicente8@hotmail.com', '1234567899'),
(16, 'Vicente', '@FFF', '1235ertyuikjh'),
(17, 'Vicente', '@FF', 'jgfdsfghjjhgf'),
(18, 'Vicente', '@F', 'kjhgfdsdfghj'),
(19, 'vicente111111111', 'vicente_prez5558@gmail.com', '12345655555587'),
(20, 'vicente111111111', 'vicente_pr58@gmail.com', '12345655555587');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
