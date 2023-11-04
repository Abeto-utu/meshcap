-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 09:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meshcap`
--

-- --------------------------------------------------------

--
-- Table structure for table `camionero`
--

CREATE TABLE `camionero` (
  `id_usuario` int(11) NOT NULL,
  `estado` enum('disponible','no disponible','trabajando') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camionero`
--

INSERT INTO `camionero` (`id_usuario`, `estado`) VALUES
(1, 'disponible'),
(5, 'trabajando'),
(6, 'disponible'),
(7, 'disponible');

-- --------------------------------------------------------

--
-- Table structure for table `camionero_vehiculo`
--

CREATE TABLE `camionero_vehiculo` (
  `id_usuario` int(11) NOT NULL,
  `matricula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camionero_vehiculo`
--

INSERT INTO `camionero_vehiculo` (`id_usuario`, `matricula`) VALUES
(1, 'ABC123'),
(5, 'ABC456'),
(6, 'ABC789');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `ubicacion`) VALUES
(1, 'CRECOM', 'nasazzi 7070');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_recoleccion`
--

CREATE TABLE `cliente_recoleccion` (
  `id_recoleccion` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente_recoleccion`
--

INSERT INTO `cliente_recoleccion` (`id_recoleccion`, `id_cliente`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `linea`
--

CREATE TABLE `linea` (
  `id_linea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linea`
--

INSERT INTO `linea` (`id_linea`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `contrasenha` varchar(50) NOT NULL,
  `salt` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_usuario`, `contrasenha`, `salt`) VALUES
(1, '123456', NULL),
(2, '123456', NULL),
(3, '123456', NULL),
(4, '123456', NULL),
(5, '123456', NULL),
(6, '123456', NULL),
(7, '123456', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `estado` enum('abierto','cerrado','en camion','entregado') DEFAULT 'abierto',
  `fecha_cierre` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_abierto` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lote`
--

INSERT INTO `lote` (`id_lote`, `estado`, `fecha_cierre`, `fecha_abierto`) VALUES
(2, 'entregado', '2023-10-21 18:48:52', '2023-10-20 19:35:28'),
(3, 'entregado', '2023-10-23 22:11:28', '2023-10-20 19:35:48'),
(4, 'entregado', '2023-10-23 00:42:06', '2023-10-23 00:14:29'),
(6, 'entregado', '2023-10-24 17:40:52', '2023-10-24 17:38:49'),
(9, 'entregado', '2023-10-25 21:53:30', '2023-10-25 21:51:10'),
(10, 'entregado', '2023-10-26 01:33:56', '2023-10-26 01:32:10'),
(11, 'entregado', '2023-10-27 00:13:01', '2023-10-27 00:08:23'),
(12, 'entregado', '2023-10-27 00:12:57', '2023-10-27 00:08:47'),
(13, 'entregado', '2023-10-27 01:08:42', '2023-10-27 01:07:25'),
(14, 'entregado', '2023-10-27 01:22:26', '2023-10-27 01:21:15'),
(15, 'entregado', '2023-10-31 22:39:07', '2023-10-31 21:58:42'),
(16, 'entregado', '2023-10-31 23:43:10', '2023-10-31 23:39:57'),
(17, 'entregado', '2023-11-01 22:34:09', '2023-11-01 22:30:49'),
(18, 'entregado', '2023-11-02 17:48:27', '2023-11-02 17:47:46'),
(19, 'entregado', '2023-11-02 18:01:29', '2023-11-02 18:00:07'),
(21, 'entregado', '2023-11-02 18:06:58', '2023-11-02 18:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `destino` varchar(255) DEFAULT NULL,
  `estado` enum('en plataforma','en plataforma destino','en lote','en recorrido','entregado') DEFAULT 'en plataforma',
  `fecha_recibo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_entrega` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `destino`, `estado`, `fecha_recibo`, `fecha_entrega`) VALUES
(8, '1234 calle, localidad, Montevideo', 'en plataforma', '2023-10-19 17:27:45', NULL),
(13, '1234 perez castellano, Montevideo, Montevideo', 'en plataforma', '2023-10-20 19:06:54', NULL),
(14, '5678 perez castellano, Montevideo, Montevideo', 'en plataforma', '2023-10-20 19:14:34', NULL),
(15, '5544 18 de julio, Palmitas', 'entregado', '2023-10-23 00:48:23', '2023-10-23 00:48:23'),
(16, '1234 18 de julio, Palmitas, Soriano', 'entregado', '2023-10-23 00:48:39', '2023-10-23 00:48:39'),
(17, '4534 perez castellano, Palmitas, Soriano', 'entregado', '2023-10-23 00:48:46', '2023-10-23 00:48:46'),
(19, '4534 perez castellano, Palmitas, Soriano', 'entregado', '2023-10-23 00:48:58', '2023-10-23 00:48:58'),
(20, '1122 18 de julio, Punta del este, Maldonado', 'entregado', '2023-10-23 00:49:04', '2023-10-23 00:49:04'),
(21, '1122 18 de julio, Punta del este, Maldonado', 'entregado', '2023-10-23 00:49:09', '2023-10-23 00:49:09'),
(22, '4433 perez castellano, Maldonado, Maldonado', 'entregado', '2023-10-23 00:49:14', '2023-10-23 00:49:14'),
(23, '2342 18 de julio, Artigas, Artigas', 'entregado', '2023-10-24 17:42:48', '2023-10-24 17:42:48'),
(24, '2342 18 de julio, Artigas, Artigas', 'entregado', '2023-10-24 17:42:58', '2023-10-24 17:42:58'),
(25, '4322 9 de mayo, Artigas, Artigas', 'entregado', '2023-10-24 17:42:45', '2023-10-24 17:42:45'),
(26, '4324 calle, localidad, Soriano', 'entregado', '2023-10-25 21:54:46', '2023-10-25 21:54:46'),
(27, '4324 calle, localidad, Soriano', 'entregado', '2023-10-25 21:54:42', '2023-10-25 21:54:42'),
(28, '4324 calle, localidad, Soriano', 'entregado', '2023-10-25 21:54:49', '2023-10-25 21:54:49'),
(39, '1234 calle, Punta del este, Maldonado', 'entregado', '2023-10-26 01:41:47', '2023-10-26 01:41:47'),
(40, '12343 callecita, Maldonado, Maldonado', 'entregado', '2023-10-26 01:41:44', '2023-10-26 01:41:44'),
(41, '1234 calle, Maldonado, Maldonado', 'entregado', '2023-10-26 01:41:40', '2023-10-26 01:41:40'),
(42, '1234 calle, Mercedes, Soriano', 'entregado', '2023-10-27 00:14:12', '2023-10-27 00:14:12'),
(43, '1234 calle, Mercedes, Soriano', 'entregado', '2023-10-27 00:14:07', '2023-10-27 00:14:07'),
(44, '1234 calle, Mercedes, Soriano', 'entregado', '2023-10-27 00:14:10', '2023-10-27 00:14:10'),
(45, '3212 Peru, Maldonado, Maldonado', 'entregado', '2023-10-27 01:09:51', '2023-10-27 01:09:51'),
(46, '4342 Salvador, Punta del este, Maldonado', 'entregado', '2023-10-27 01:09:54', '2023-10-27 01:09:54'),
(47, '1234 calle, Mercedes, Soriano', 'entregado', '2023-10-27 01:40:01', '2023-10-27 01:40:01'),
(48, '1234 calle, Mercedes, Soriano', 'entregado', '2023-10-27 01:40:06', '2023-10-27 01:40:06'),
(49, '1232 18 de Julio, Palmitas, Soriano', 'entregado', '2023-10-31 23:35:47', '2023-10-31 23:35:47'),
(50, '1232 18 de Julio, Palmitas, Soriano', 'entregado', '2023-10-31 23:35:51', '2023-10-31 23:35:51'),
(51, '1234 18 de julio, Palmitas, Soriano', 'entregado', '2023-10-31 23:43:50', '2023-10-31 23:43:50'),
(52, '1234 18 de julio, Palmitas, Soriano', 'entregado', '2023-10-31 23:43:52', '2023-10-31 23:43:52'),
(53, '9983 Montevideo, Mercedes, Soriano', 'entregado', '2023-10-31 23:43:54', '2023-10-31 23:43:54'),
(54, '1234 calle, Punta del este, Maldonado', 'en plataforma destino', '2023-11-01 22:34:09', NULL),
(55, '3399 Salvador, Montevideo, Montevideo', 'entregado', '2023-11-01 18:44:59', '2023-11-01 18:44:59'),
(56, '1234 calle, Mercedes, Soriano', 'entregado', '2023-11-02 17:48:59', '2023-11-02 17:48:59'),
(57, '1234 calle, Palmitas, Soriano', 'entregado', '2023-11-02 17:49:02', '2023-11-02 17:49:02'),
(58, '3399 Salvador, Montevideo, Montevideo', 'entregado', '2023-11-02 17:49:34', '2023-11-02 17:49:34'),
(59, '1234 calle, Mercedes, Soriano', 'entregado', '2023-11-02 18:02:10', '2023-11-02 18:02:10'),
(60, '1234 calle, Mercedes, Soriano', 'entregado', '2023-11-02 18:02:12', '2023-11-02 18:02:12'),
(61, '4321 calle, Palmitas, Soriano', 'entregado', '2023-11-02 18:02:15', '2023-11-02 18:02:15'),
(62, '4321 calle, Palmitas, Soriano', 'en plataforma', '2023-11-03 19:18:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paquete_lote`
--

CREATE TABLE `paquete_lote` (
  `id_paquete` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete_lote`
--

INSERT INTO `paquete_lote` (`id_paquete`, `id_lote`) VALUES
(15, 2),
(16, 2),
(17, 2),
(20, 4),
(21, 4),
(22, 4),
(23, 6),
(24, 6),
(25, 6),
(26, 9),
(27, 9),
(28, 9),
(39, 10),
(40, 10),
(41, 10),
(42, 12),
(43, 12),
(44, 11),
(45, 13),
(46, 13),
(47, 14),
(48, 14),
(49, 15),
(50, 15),
(51, 16),
(52, 16),
(53, 16),
(54, 17),
(54, 21),
(56, 18),
(57, 18),
(59, 19),
(60, 19),
(61, 19);

-- --------------------------------------------------------

--
-- Table structure for table `paquete_recorrido`
--

CREATE TABLE `paquete_recorrido` (
  `id_paquete` int(11) NOT NULL,
  `id_recorrido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete_recorrido`
--

INSERT INTO `paquete_recorrido` (`id_paquete`, `id_recorrido`) VALUES
(15, 1),
(16, 1),
(17, 1),
(19, 1),
(20, 2),
(21, 2),
(22, 2),
(23, 3),
(24, 3),
(25, 3),
(26, 4),
(27, 4),
(28, 4),
(39, 5),
(40, 5),
(41, 5),
(42, 6),
(43, 6),
(44, 6),
(45, 7),
(46, 7),
(47, 8),
(48, 8),
(49, 10),
(50, 10),
(51, 11),
(52, 11),
(53, 11),
(56, 14),
(57, 14),
(59, 15),
(60, 15),
(61, 15);

-- --------------------------------------------------------

--
-- Table structure for table `plataforma`
--

CREATE TABLE `plataforma` (
  `id_plataforma` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plataforma`
--

INSERT INTO `plataforma` (`id_plataforma`, `nombre`, `ubicacion`) VALUES
(1, 'Montevideo', '2255 perez castellano, Montevideo'),
(2, 'Artigas', '4232 paul, Artigas'),
(3, 'Canelones', '1234 Nico, La Paz'),
(4, 'Cerro Largo', '1234  calle,  Melo'),
(5, 'Colonia', '4234 Plaza Colonia, Colonia del sacramento'),
(6, 'Durazno', '8765 Melocoton, Sandia'),
(8, 'Soriano', '4324 18 de julio, Palmitas'),
(9, 'Maldonado', '2223 Rivera, Punta del este, Maldonado'),
(10, 'Rio negro', '4321 callecita, Fray Bentos'),
(11, 'Rocha', '9999 lalala, Rocha'),
(12, 'Treinta y Tres', '3333 33, Treinta y Tres'),
(13, 'Lavalleja', '1010 Alfajores, Minas'),
(14, 'Florida', '7676 miami, Florida'),
(15, 'Tacuarembo', '9494 18 de julio, Tacuarembo'),
(16, 'Rivera', '0000 rios, Rivera'),
(17, 'San jose', '5435 solano, San jose'),
(18, 'Paysandu', '4324 calle, Paysandu'),
(19, 'Salto', '2234 calle, Salto');

-- --------------------------------------------------------

--
-- Table structure for table `plataforma_linea`
--

CREATE TABLE `plataforma_linea` (
  `id_plataforma` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plataforma_linea`
--

INSERT INTO `plataforma_linea` (`id_plataforma`, `id_linea`, `posicion`) VALUES
(1, 1, 1),
(2, 1, 8),
(3, 4, 1),
(4, 3, 3),
(5, 1, 3),
(6, 4, 3),
(8, 1, 4),
(9, 2, 1),
(10, 1, 5),
(11, 2, 2),
(12, 3, 2),
(13, 3, 1),
(14, 4, 2),
(15, 4, 4),
(16, 4, 5),
(17, 1, 2),
(18, 1, 6),
(19, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `plataforma_lote`
--

CREATE TABLE `plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) DEFAULT NULL,
  `fecha_llegada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plataforma_lote`
--

INSERT INTO `plataforma_lote` (`id_lote`, `id_plataforma`, `fecha_llegada`) VALUES
(2, 8, '2023-10-21 18:48:52'),
(3, 8, '2023-10-21 18:49:23'),
(4, 9, '2023-10-23 00:37:25'),
(6, 2, '2023-10-24 17:40:52'),
(9, 8, '2023-10-25 21:53:30'),
(10, 9, '2023-10-26 01:33:56'),
(11, 8, '2023-10-27 00:13:01'),
(12, 8, '2023-10-27 00:12:57'),
(13, 9, '2023-10-27 01:08:42'),
(14, 8, '2023-10-27 01:22:26'),
(15, 8, '2023-10-31 22:39:07'),
(16, 8, '2023-10-31 23:43:10'),
(17, 9, '2023-11-01 22:34:09'),
(18, 8, '2023-11-02 17:48:27'),
(19, 8, '2023-11-02 18:01:29'),
(21, 9, '2023-11-02 18:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `recoleccion`
--

CREATE TABLE `recoleccion` (
  `id_recoleccion` int(11) NOT NULL,
  `fecha_llegada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_ida` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recoleccion`
--

INSERT INTO `recoleccion` (`id_recoleccion`, `fecha_llegada`, `fecha_ida`) VALUES
(1, '2023-10-20 19:18:27', '2023-10-20 18:24:32'),
(2, '2023-10-20 19:21:56', '2023-10-20 19:21:39'),
(3, '2023-10-23 00:12:33', '2023-10-23 00:11:44'),
(4, '2023-10-24 17:36:22', '2023-10-24 17:24:10'),
(5, '2023-10-25 21:50:49', '2023-10-25 21:50:14'),
(6, '2023-10-25 23:45:07', '2023-10-25 23:29:57'),
(7, '2023-10-27 00:07:49', '2023-10-27 00:06:57'),
(8, '2023-10-27 01:06:43', '2023-10-27 01:06:05'),
(9, '2023-10-27 01:20:51', '2023-10-27 01:20:22'),
(10, '2023-10-31 22:21:37', '2023-10-31 22:21:04'),
(11, NULL, '2023-11-01 17:52:50'),
(12, '2023-10-31 23:39:30', '2023-10-31 23:38:45'),
(19, '2023-11-02 17:47:26', '2023-11-02 17:46:47'),
(20, '2023-11-02 17:59:38', '2023-11-02 17:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `recoleccion_vehiculo`
--

CREATE TABLE `recoleccion_vehiculo` (
  `id_recoleccion` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recoleccion_vehiculo`
--

INSERT INTO `recoleccion_vehiculo` (`id_recoleccion`, `matricula`) VALUES
(1, 'ABC123'),
(2, 'ABC123'),
(3, 'ABC123'),
(4, 'ABC456'),
(5, 'ABC456'),
(6, 'ABC456'),
(7, 'ABC456'),
(8, 'ABC456'),
(9, 'ABC456'),
(10, 'ABC123'),
(11, 'ABC456'),
(12, 'ABC123'),
(19, 'ABC123'),
(20, 'ABC123');

-- --------------------------------------------------------

--
-- Table structure for table `recorrido`
--

CREATE TABLE `recorrido` (
  `id_recorrido` int(11) NOT NULL,
  `estado` enum('finalizado','en proceso','no comenzado') DEFAULT 'no comenzado',
  `fecha_inicio` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recorrido`
--

INSERT INTO `recorrido` (`id_recorrido`, `estado`, `fecha_inicio`) VALUES
(1, 'finalizado', '2023-10-21 23:09:23'),
(2, 'finalizado', '2023-10-23 00:45:32'),
(3, 'finalizado', '2023-10-24 17:42:59'),
(4, 'finalizado', '2023-10-25 21:54:50'),
(5, 'finalizado', '2023-10-26 01:43:47'),
(6, 'finalizado', '2023-10-27 00:14:13'),
(7, 'finalizado', '2023-10-27 01:09:56'),
(8, 'finalizado', '2023-10-27 01:40:07'),
(9, 'finalizado', '2023-10-31 23:25:37'),
(10, 'finalizado', '2023-10-31 23:35:53'),
(11, 'finalizado', '2023-10-31 23:43:55'),
(12, 'finalizado', '2023-11-01 22:14:16'),
(13, 'finalizado', '2023-11-01 22:16:42'),
(14, 'finalizado', '2023-11-02 17:49:04'),
(15, 'finalizado', '2023-11-02 18:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `recorrido_vehiculo`
--

CREATE TABLE `recorrido_vehiculo` (
  `id_recorrido` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recorrido_vehiculo`
--

INSERT INTO `recorrido_vehiculo` (`id_recorrido`, `matricula`) VALUES
(1, 'ABC123'),
(2, 'ABC123'),
(3, 'ABC456'),
(4, 'ABC456'),
(5, 'ABC456'),
(6, 'ABC456'),
(7, 'ABC456'),
(8, 'ABC456'),
(9, 'ABC123'),
(10, 'ABC123'),
(11, 'ABC123'),
(12, 'ABC123'),
(13, 'ABC123'),
(14, 'ABC123'),
(15, 'ABC123');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT 'anonimo',
  `cargo` enum('camionero','funcionario','administrador','sin cargo') NOT NULL DEFAULT 'sin cargo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `cargo`) VALUES
(1, 'Ivan', 'camionero'),
(2, 'Genaro', 'funcionario'),
(3, 'Agustin', 'administrador'),
(4, 'Woody', 'sin cargo'),
(5, 'Pedro Gonzales', 'camionero'),
(6, 'Jude Bellinghim', 'camionero'),
(7, 'Tamandua', 'camionero');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_plataforma`
--

CREATE TABLE `usuario_plataforma` (
  `id_usuario` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario_plataforma`
--

INSERT INTO `usuario_plataforma` (`id_usuario`, `id_plataforma`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(20) NOT NULL,
  `estado` enum('en recorrido','en linea','en recoleccion','con conductor','sin conductor','fuera de servicio') DEFAULT 'sin conductor',
  `tipo` enum('camion','camioneta') NOT NULL DEFAULT 'camioneta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `estado`, `tipo`) VALUES
('ABC123', 'con conductor', 'camioneta'),
('ABC456', 'en recoleccion', 'camion'),
('ABC789', 'con conductor', 'camioneta'),
('YYY987', 'sin conductor', 'camion');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo_plataforma_lote`
--

CREATE TABLE `vehiculo_plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL,
  `matricula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculo_plataforma_lote`
--

INSERT INTO `vehiculo_plataforma_lote` (`id_lote`, `id_plataforma`, `matricula`) VALUES
(2, 8, 'ABC123'),
(3, 8, 'ABC123'),
(4, 9, 'ABC123'),
(6, 2, 'ABC456'),
(9, 8, 'ABC456'),
(10, 9, 'ABC456'),
(11, 8, 'ABC456'),
(12, 8, 'ABC456'),
(13, 9, 'ABC456'),
(14, 8, 'ABC456'),
(15, 8, 'ABC123'),
(16, 8, 'ABC123'),
(17, 9, 'ABC123'),
(18, 8, 'ABC123'),
(19, 8, 'ABC123'),
(21, 9, 'ABC123');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_paquete_lote_plataforma_camion`
-- (See below for the actual view)
--
CREATE TABLE `vista_paquete_lote_plataforma_camion` (
`id_paquete` int(11)
,`destino_paquete` varchar(255)
,`estado_paquete` enum('en plataforma','en plataforma destino','en lote','en recorrido','entregado')
,`id_lote` int(11)
,`estado_lote` enum('abierto','cerrado','en camion','entregado')
,`id_plataforma_lote` int(11)
,`nombre_plataforma_lote` varchar(50)
,`ubicacion_plataforma_lote` varchar(255)
,`matricula_camion` varchar(20)
,`id_camionero` int(11)
,`estado_camionero` enum('disponible','no disponible','trabajando')
);

-- --------------------------------------------------------

--
-- Structure for view `vista_paquete_lote_plataforma_camion`
--
DROP TABLE IF EXISTS `vista_paquete_lote_plataforma_camion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_paquete_lote_plataforma_camion`  AS SELECT `p`.`id_paquete` AS `id_paquete`, `p`.`destino` AS `destino_paquete`, `p`.`estado` AS `estado_paquete`, `l`.`id_lote` AS `id_lote`, `l`.`estado` AS `estado_lote`, `pl1`.`id_plataforma` AS `id_plataforma_lote`, `pl1`.`nombre` AS `nombre_plataforma_lote`, `pl1`.`ubicacion` AS `ubicacion_plataforma_lote`, `v`.`matricula` AS `matricula_camion`, `c`.`id_usuario` AS `id_camionero`, `c`.`estado` AS `estado_camionero` FROM ((((((((`paquete` `p` join `paquete_lote` `pl` on(`p`.`id_paquete` = `pl`.`id_paquete`)) join `lote` `l` on(`pl`.`id_lote` = `l`.`id_lote`)) join `plataforma_lote` `pl_lote` on(`l`.`id_lote` = `pl_lote`.`id_lote`)) join `plataforma` `pl1` on(`pl_lote`.`id_plataforma` = `pl1`.`id_plataforma`)) join `vehiculo_plataforma_lote` `vpl` on(`l`.`id_lote` = `vpl`.`id_lote`)) join `vehiculo` `v` on(`vpl`.`matricula` = `v`.`matricula`)) join `camionero_vehiculo` `cv` on(`v`.`matricula` = `cv`.`matricula`)) join `camionero` `c` on(`cv`.`id_usuario` = `c`.`id_usuario`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `camionero`
--
ALTER TABLE `camionero`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `camionero_vehiculo`
--
ALTER TABLE `camionero_vehiculo`
  ADD PRIMARY KEY (`id_usuario`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `cliente_recoleccion`
--
ALTER TABLE `cliente_recoleccion`
  ADD PRIMARY KEY (`id_recoleccion`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indexes for table `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indexes for table `paquete_lote`
--
ALTER TABLE `paquete_lote`
  ADD PRIMARY KEY (`id_paquete`,`id_lote`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indexes for table `paquete_recorrido`
--
ALTER TABLE `paquete_recorrido`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_recorrido` (`id_recorrido`);

--
-- Indexes for table `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id_plataforma`);

--
-- Indexes for table `plataforma_linea`
--
ALTER TABLE `plataforma_linea`
  ADD PRIMARY KEY (`id_plataforma`,`id_linea`),
  ADD KEY `id_linea` (`id_linea`) USING BTREE;

--
-- Indexes for table `plataforma_lote`
--
ALTER TABLE `plataforma_lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Indexes for table `recoleccion`
--
ALTER TABLE `recoleccion`
  ADD PRIMARY KEY (`id_recoleccion`);

--
-- Indexes for table `recoleccion_vehiculo`
--
ALTER TABLE `recoleccion_vehiculo`
  ADD PRIMARY KEY (`id_recoleccion`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id_recorrido`);

--
-- Indexes for table `recorrido_vehiculo`
--
ALTER TABLE `recorrido_vehiculo`
  ADD PRIMARY KEY (`id_recorrido`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `usuario_plataforma`
--
ALTER TABLE `usuario_plataforma`
  ADD PRIMARY KEY (`id_usuario`,`id_plataforma`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Indexes for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- Indexes for table `vehiculo_plataforma_lote`
--
ALTER TABLE `vehiculo_plataforma_lote`
  ADD PRIMARY KEY (`id_lote`,`id_plataforma`,`matricula`),
  ADD KEY `id_plataforma` (`id_plataforma`),
  ADD KEY `matricula` (`matricula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camionero`
--
ALTER TABLE `camionero`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `linea`
--
ALTER TABLE `linea`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `recoleccion`
--
ALTER TABLE `recoleccion`
  MODIFY `id_recoleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id_recorrido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `camionero`
--
ALTER TABLE `camionero`
  ADD CONSTRAINT `camionero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `camionero_vehiculo`
--
ALTER TABLE `camionero_vehiculo`
  ADD CONSTRAINT `camionero_vehiculo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `camionero` (`id_usuario`),
  ADD CONSTRAINT `camionero_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Constraints for table `cliente_recoleccion`
--
ALTER TABLE `cliente_recoleccion`
  ADD CONSTRAINT `cliente_recoleccion_ibfk_1` FOREIGN KEY (`id_recoleccion`) REFERENCES `recoleccion` (`id_recoleccion`),
  ADD CONSTRAINT `cliente_recoleccion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Constraints for table `paquete_lote`
--
ALTER TABLE `paquete_lote`
  ADD CONSTRAINT `paquete_lote_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `paquete_lote_ibfk_2` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

--
-- Constraints for table `paquete_recorrido`
--
ALTER TABLE `paquete_recorrido`
  ADD CONSTRAINT `paquete_recorrido_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `paquete_recorrido_ibfk_2` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`);

--
-- Constraints for table `plataforma_linea`
--
ALTER TABLE `plataforma_linea`
  ADD CONSTRAINT `plataforma_linea_ibfk_1` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`),
  ADD CONSTRAINT `plataforma_linea_ibfk_2` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id_linea`);

--
-- Constraints for table `plataforma_lote`
--
ALTER TABLE `plataforma_lote`
  ADD CONSTRAINT `plataforma_lote_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `plataforma_lote_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`);

--
-- Constraints for table `recoleccion_vehiculo`
--
ALTER TABLE `recoleccion_vehiculo`
  ADD CONSTRAINT `recoleccion_vehiculo_ibfk_1` FOREIGN KEY (`id_recoleccion`) REFERENCES `recoleccion` (`id_recoleccion`),
  ADD CONSTRAINT `recoleccion_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Constraints for table `recorrido_vehiculo`
--
ALTER TABLE `recorrido_vehiculo`
  ADD CONSTRAINT `recorrido_vehiculo_ibfk_1` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`),
  ADD CONSTRAINT `recorrido_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Constraints for table `usuario_plataforma`
--
ALTER TABLE `usuario_plataforma`
  ADD CONSTRAINT `usuario_plataforma_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_plataforma_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`);

--
-- Constraints for table `vehiculo_plataforma_lote`
--
ALTER TABLE `vehiculo_plataforma_lote`
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`),
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_3` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
