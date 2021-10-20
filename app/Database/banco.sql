-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 05:31 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `correo` varchar(85) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `telefono`, `correo`, `created_at`, `updated_at`) VALUES
(1, 'Esneider', 'Buelvas', '30131200', 'esneider@mail.com', '2021-08-25 16:57:48', '2021-09-02 16:33:44'),
(2, 'Manuel', 'Olivo', '31055557', 'manuel@mail.com', '2021-08-25 19:12:59', '2021-08-25 19:12:59'),
(3, 'Nanc', 'Merca', '30431681', 'nanc@mail.com', '2021-08-25 19:24:15', '2021-08-25 19:24:15'),
(4, 'Marco', 'Pinto', '30431683', 'pintomarco@mail.com', '2021-08-25 19:49:13', '2021-08-26 14:35:00'),
(5, 'NomCinco', 'ApCinco', '30500000', 'cinco@gmail.com', '2021-08-30 16:18:37', '2021-08-30 16:18:37'),
(6, 'nomSeis', 'apeSeis', '30500000', 'seis@mail.com', '2021-08-30 15:53:37', '2021-08-30 15:53:37'),
(7, 'nomSiete', 'apeSiete', '30700000', 'siete@gmail.com', '2021-08-30 16:18:37', '2021-08-30 16:18:37'),
(8, 'nomOcho', 'apeOcho', '30800000', 'ocho@gmail.com', '2021-08-30 16:14:28', '2021-08-30 16:14:28'),
(9, 'nomNueve', 'apeNueve', '30900000', 'nueve@gmail.com', '2021-08-30 16:14:28', '2021-08-30 16:14:28'),
(10, 'nomDiez', 'apeDiez', '31000000', 'diez@hotmail.com', '2021-08-30 21:15:55', '2021-08-30 21:23:00'),
(11, 'nomOnce', 'apeOnce', '31100000', 'once@hotmail.com', '2021-09-01 19:37:53', '2021-09-01 19:38:48'),
(13, 'nomOnce', 'apeOnce', '31100000', 'once@gmail.com', '2021-09-09 19:16:09', '2021-09-09 19:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(11) NOT NULL,
  `moneda` varchar(3) NOT NULL,
  `fondo` decimal(8,2) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuenta`
--

INSERT INTO `cuenta` (`id`, `moneda`, `fondo`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, 'cop', '1000.00', 1, '2021-08-30 15:05:58', '2021-09-06 15:38:33'),
(2, 'usa', '2000.00', 2, '2021-08-30 15:06:20', '2021-09-06 15:39:15'),
(3, 'eua', '3000.00', 3, '2021-08-30 15:47:23', '2021-09-06 15:39:27'),
(4, 'eua', '110000.00', 3, '2021-08-30 15:58:32', '2021-08-30 15:58:32'),
(5, 'EGP', '50000.00', 4, '2021-08-30 16:04:08', '2021-08-30 16:04:08'),
(6, 'XOF', '6000.00', 6, '2021-08-30 16:09:16', '2021-08-30 16:09:16'),
(7, 'ars', '7000.00', 7, '2021-08-30 19:54:16', '2021-08-30 19:54:16'),
(8, 'nzd', '8000.00', 8, '2021-09-01 19:56:32', '2021-09-01 19:56:32'),
(9, 'gbp', '9000.00', 9, '2021-09-01 19:59:59', '2021-09-01 20:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-09-07 21:33:27', '2021-09-07 21:33:27'),
(2, 'cajero', '2021-09-09 20:57:21', '2021-09-09 20:57:21'),
(3, 'cliente', '2021-09-10 19:20:43', '2021-09-10 19:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_transaccion`
--

CREATE TABLE `tipo_transaccion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(65) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_transaccion`
--

INSERT INTO `tipo_transaccion` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'deposito', '2021-09-02 21:36:53', '2021-09-02 21:36:53'),
(2, 'retiro', '2021-09-03 15:57:51', '2021-09-03 19:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `tipo_transaccion_id` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaccion`
--

INSERT INTO `transaccion` (`id`, `cuenta_id`, `tipo_transaccion_id`, `monto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1000.00', '2021-09-03 20:12:29', '2021-09-03 20:12:29'),
(4, 1, 2, '8100.00', '2021-09-03 21:38:55', '2021-09-03 21:38:55'),
(5, 1, 2, '800.00', '2021-09-03 21:39:30', '2021-09-03 21:39:30'),
(6, 1, 2, '9000.00', '2021-09-06 15:37:33', '2021-09-06 15:37:33'),
(7, 1, 2, '9000.00', '2021-09-06 15:37:54', '2021-09-06 15:37:54'),
(8, 1, 2, '9000.00', '2021-09-06 15:38:26', '2021-09-06 15:38:26'),
(9, 1, 1, '900.00', '2021-09-06 15:38:29', '2021-09-06 20:25:13'),
(10, 1, 2, '9000.00', '2021-09-06 15:38:33', '2021-09-06 15:38:33'),
(11, 3, 2, '107000.00', '2021-09-06 15:39:27', '2021-09-06 15:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(65) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `rol_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `username`, `password`, `rol_id`, `created_at`, `updated_at`) VALUES
(1, 'esneider buelvas', 'esneider', '$2y$10$Qyr3QNUlWLoEvacvFrC6w.5ytwWrJ2UZspdiYkFKFvcslaoygSmrG', 1, '2021-09-07 21:34:02', '2021-09-07 21:34:02'),
(2, 'Manuel', 'manuel', '$2y$10$/JZZFBUxvqfHMm46EyUWEe6jqR3GuWZsIcZGKo2c40Oaqf/N.BBTy', 2, '2021-09-08 19:15:50', '2021-09-08 19:15:50'),
(3, 'tercero', 'usutercero', '$2y$10$gD541FbXVIGpXcFv9W3wPOycksNLyzOSOjzA2.xafplaLABogaVym', 3, '2021-09-13 14:03:22', '2021-09-13 14:03:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cuenta_cliente_idx` (`cliente_id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion_UNIQUE` (`descripcion`);

--
-- Indexes for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaccion_cuenta1_idx` (`cuenta_id`),
  ADD KEY `fk_transaccion_tipo_transaccion1_idx` (`tipo_transaccion_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_rol_idx` (`rol_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `fk_cuenta_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transaccion_cuenta` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaccion_tipo_transaccion` FOREIGN KEY (`tipo_transaccion_id`) REFERENCES `tipo_transaccion` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
