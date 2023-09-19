-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 12:44 AM
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
  `estado` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camionero`
--

INSERT INTO `camionero` (`id_usuario`, `estado`, `cargo`) VALUES
(1, 'disponible', 'camionero'),
(3, 'disponible', 'camionero');

-- --------------------------------------------------------

--
-- Table structure for table `camionero_vehiculo`
--

CREATE TABLE `camionero_vehiculo` (
  `id_usuario` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camionero_vehiculo`
--

INSERT INTO `camionero_vehiculo` (`id_usuario`, `matricula`) VALUES
(1, 'STP1000');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `ubicacion`) VALUES
(1, 'Crecom', '3480 Camino Sanfuentes, Montevideo, Montevideo');

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
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`id_usuario`, `estado`, `cargo`) VALUES
(2, 'disponible', 'funcionario');

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
(1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `contrasenha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `es_administrador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_usuario`, `contrasenha`, `salt`, `es_administrador`) VALUES
(1, 'genaro', NULL, 0),
(2, 'agustin', NULL, 0),
(3, 'ivan', NULL, 0),
(4, 'root', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `fecha_cierre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_abierto` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lote`
--

INSERT INTO `lote` (`id_lote`, `estado`, `fecha_cierre`, `fecha_abierto`) VALUES
(1, 'entregado', '2023-09-12 13:00:00', '2023-09-12 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `destino` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `fecha_recibo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_entrega` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correo_destinatario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `destino`, `estado`, `fecha_recibo`, `fecha_entrega`, `correo_destinatario`) VALUES
(1, 'Soriano', 'no recepcionado', '2023-09-19 22:44:18', '2023-09-19 22:44:18', 'destinatario1@example.com'),
(2, 'Soriano', 'recepcionado', '2023-09-11 03:00:00', '2023-09-19 22:44:18', 'destinatario2@example.com'),
(3, 'Soriano', 'entregado', '2023-09-10 03:00:00', '2023-09-12 03:00:00', 'destinatario3@example.com'),
(4, 'Canelones', 'no recepcionado', '2023-09-19 22:44:18', '2023-09-19 22:44:18', 'destinatario4@example.com'),
(5, 'Soriano', 'recepcionado', '2023-09-09 03:00:00', '2023-09-19 22:44:18', 'destinatario5@example.com'),
(6, 'Canelones', 'entregado', '2023-09-08 03:00:00', '2023-09-13 03:00:00', 'destinatario6@example.com'),
(7, 'Canelones', 'no recepcionado', '2023-09-19 22:44:18', '2023-09-19 22:44:18', 'destinatario7@example.com'),
(8, 'San Jose', 'recepcionado', '2023-09-07 03:00:00', '2023-09-19 22:44:18', 'destinatario8@example.com'),
(9, 'San Jose', 'entregado', '2023-09-06 03:00:00', '2023-09-14 03:00:00', 'destinatario9@example.com'),
(10, 'San Jose', 'recepcionado', '2023-09-05 03:00:00', '2023-09-19 22:44:18', 'destinatario10@example.com');

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
(9, 1);

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
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plataforma`
--

CREATE TABLE `plataforma` (
  `id_plataforma` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,6) DEFAULT NULL,
  `longitud` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plataforma`
--

INSERT INTO `plataforma` (`id_plataforma`, `nombre`, `ubicacion`, `latitud`, `longitud`) VALUES
(1, 'Montevideo', '2638 Camino Juan Burghi, Montevideo, Montevideo', -34.902144, -56.186476),
(2, 'San Jose', '1105 Coronel Ciceron Marin, San Jose de Mato, San Jose', -34.327129, -56.719850),
(3, 'Colonia', '723 Fernando Felipe Bassahun, Colonia del Sacramento, Colonia', -34.472789, -57.839386),
(4, 'Soriano', '870 Juan Antonio Lavalleja, Soriano', -33.543400, -58.414604);

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
(2, 1, 1),
(3, 1, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `plataforma_lote`
--

CREATE TABLE `plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) DEFAULT NULL,
  `fecha_llegada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plataforma_lote`
--

INSERT INTO `plataforma_lote` (`id_lote`, `id_plataforma`, `fecha_llegada`) VALUES
(1, 2, '2023-09-11 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `recoleccion`
--

CREATE TABLE `recoleccion` (
  `id_recoleccion` int(11) NOT NULL,
  `fecha_llegada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_ida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recoleccion`
--

INSERT INTO `recoleccion` (`id_recoleccion`, `fecha_llegada`, `fecha_ida`) VALUES
(1, '2023-09-11 13:00:00', '2023-09-11 17:00:00'),
(2, '2023-09-12 12:30:00', '2023-09-12 15:30:00'),
(3, '2023-09-12 17:00:00', '2023-09-12 20:00:00');

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
(1, 'STP1000'),
(2, 'STP1000'),
(3, 'STP1000');

-- --------------------------------------------------------

--
-- Table structure for table `recorrido`
--

CREATE TABLE `recorrido` (
  `id_recorrido` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recorrido`
--

INSERT INTO `recorrido` (`id_recorrido`, `estado`, `fecha_inicio`) VALUES
(1, 'finalizado', '2023-09-13 11:00:00');

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
(1, 'MAA6562');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`) VALUES
(1, 'Genaro Amaral'),
(2, 'Agustin Casanas'),
(3, 'Ivan Caballero');

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
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(255) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `estado`, `tipo`) VALUES
('ABA9595', 'disponible', 'camioneta'),
('MAA6562', 'disponible', 'camioneta'),
('STP1000', 'disponible', 'camión');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo_plataforma_lote`
--

CREATE TABLE `vehiculo_plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculo_plataforma_lote`
--

INSERT INTO `vehiculo_plataforma_lote` (`id_lote`, `id_plataforma`, `matricula`) VALUES
(1, 2, 'STP1000');

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
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_usuario`);

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
  ADD KEY `id_linea` (`id_linea`);

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `linea`
--
ALTER TABLE `linea`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recoleccion`
--
ALTER TABLE `recoleccion`
  MODIFY `id_recoleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id_recorrido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
