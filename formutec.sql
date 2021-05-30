-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 07:51 AM
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
-- Table structure for table `subtemas`
--

CREATE TABLE `subtemas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pdf` text NOT NULL,
  `idTema` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subtemas`
--

INSERT INTO `subtemas` (`id`, `nombre`, `pdf`, `idTema`) VALUES
(16, 'Moda', 'http://localhost/FormuTecMatematicasWeb/public/pdf/Moda.pdf', 23),
(18, 'mediana 2', 'http://localhost/FormuTecMatematicasWeb/public/pdf/mediana 2.pdf', 22),
(19, 'mediana 4', 'http://localhost/FormuTecMatematicasWeb/public/pdf/mediana 2.pdf', 22),
(20, 'mediana 3', 'http://localhost/FormuTecMatematicasWeb/public/pdf/mediana 3.pdf', 39),
(21, 'Moda 1', 'http://localhost/FormuTecMatematicasWeb/public/pdf/Moda 1.pdf', 19),
(22, 'Moda  1500', 'http://localhost/FormuTecMatematicasWeb/public/pdf/Moda  1500.pdf', 19),
(23, 'Propiedades AritmÃ©ticas', 'http://localhost/FormuTecMatematicasWeb/public/pdf/Propiedades AritmÃ©ticas.pdf', 22);

-- --------------------------------------------------------

--
-- Table structure for table `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temas`
--

INSERT INTO `temas` (`id`, `nombre`, `imagen`, `descripcion`) VALUES
(19, 'Ãlgebra Lineal', 'http://localhost/FormuTecMatematicasWeb/public/formulas/Ãlgebra Lineal.png', 'EncontrarÃ¡s fÃ³rmulas relacionadas con el Ã¡lgebra lineal'),
(22, 'Ãlgebra', 'http://localhost/FormuTecMatematicasWeb/public/formulas/Ãlgebra.png', 'Temas de Ã¡lgebra'),
(23, 'GeometrÃ­a', 'http://localhost/FormuTecMatematicasWeb/public/formulas/GeometrÃ­a.png', 'FÃ³rmulas de geometrÃ­a'),
(39, 'Probabilida y estadÃ­stica', 'http://localhost/FormuTecMatematicasWeb/public/formulas/Probabilida y estadÃ­stica.png', 'probabilida');

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
(1, 'Vicente Aguilera PÃ©rez', 'vicente_prez@hotmail.com', '12345678'),
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
-- Indexes for table `subtemas`
--
ALTER TABLE `subtemas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTema` (`idTema`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subtemas`
--
ALTER TABLE `subtemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subtemas`
--
ALTER TABLE `subtemas`
  ADD CONSTRAINT `subtemas_ibfk_1` FOREIGN KEY (`idTema`) REFERENCES `temas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
