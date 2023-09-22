-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2023 a las 20:50:40
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meshcap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camionero`
--

CREATE TABLE `camionero` (
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camionero_vehiculo`
--

CREATE TABLE `camionero_vehiculo` (
  `id_usuario` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_recoleccion`
--

CREATE TABLE `cliente_recoleccion` (
  `id_recoleccion` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id_linea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `contrasenha` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `contrasenha`, `salt`, `cargo`) VALUES
(222, 'almacen', NULL, 'almacenero'),
(333, 'repartidor', NULL, 'repartidor'),
(444, 'camionero', NULL, 'camionero'),
(911, 'backoffice', NULL, 'backoffice');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `fecha_cierre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_abierto` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `estado`, `fecha_cierre`, `fecha_abierto`) VALUES
(1, 'De camino al destino', '2023-09-22 16:23:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
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
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `destino`, `estado`, `fecha_recibo`, `fecha_entrega`, `correo_destinatario`) VALUES
(1, 'La casa del mate osea el de enfrente Este es el editado, No se que seria este atributoasdadsadadasdadadadasdad, Montevideo', 'De Camino al Almacen', '2023-09-22 16:10:58', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_lote`
--

CREATE TABLE `paquete_lote` (
  `id_paquete` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_recorrido`
--

CREATE TABLE `paquete_recorrido` (
  `id_paquete` int(11) NOT NULL,
  `id_recorrido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE `plataforma` (
  `id_plataforma` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,6) DEFAULT NULL,
  `longitud` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plataforma`
--

INSERT INTO `plataforma` (`id_plataforma`, `nombre`, `ubicacion`, `latitud`, `longitud`) VALUES
(2, 'Montevideo', '22222222  aaaaaaaaaa,  aaaaaaaaaaaaaaaa', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma_linea`
--

CREATE TABLE `plataforma_linea` (
  `id_plataforma` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma_lote`
--

CREATE TABLE `plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) DEFAULT NULL,
  `fecha_llegada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoleccion`
--

CREATE TABLE `recoleccion` (
  `id_recoleccion` int(11) NOT NULL,
  `fecha_llegada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_ida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoleccion_vehiculo`
--

CREATE TABLE `recoleccion_vehiculo` (
  `id_recoleccion` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `id_recorrido` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido_vehiculo`
--

CREATE TABLE `recorrido_vehiculo` (
  `id_recorrido` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_plataforma`
--

CREATE TABLE `usuario_plataforma` (
  `id_usuario` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(255) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `estado`, `tipo`) VALUES
('STB45544', '', ''),
('STB4554422', 'Libre', 'Camioneta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_plataforma_lote`
--

CREATE TABLE `vehiculo_plataforma_lote` (
  `id_lote` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camionero`
--
ALTER TABLE `camionero`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `camionero_vehiculo`
--
ALTER TABLE `camionero_vehiculo`
  ADD PRIMARY KEY (`id_usuario`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_recoleccion`
--
ALTER TABLE `cliente_recoleccion`
  ADD PRIMARY KEY (`id_recoleccion`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `paquete_lote`
--
ALTER TABLE `paquete_lote`
  ADD PRIMARY KEY (`id_paquete`,`id_lote`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indices de la tabla `paquete_recorrido`
--
ALTER TABLE `paquete_recorrido`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_recorrido` (`id_recorrido`);

--
-- Indices de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id_plataforma`);

--
-- Indices de la tabla `plataforma_linea`
--
ALTER TABLE `plataforma_linea`
  ADD PRIMARY KEY (`id_plataforma`,`id_linea`),
  ADD KEY `id_linea` (`id_linea`);

--
-- Indices de la tabla `plataforma_lote`
--
ALTER TABLE `plataforma_lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Indices de la tabla `recoleccion`
--
ALTER TABLE `recoleccion`
  ADD PRIMARY KEY (`id_recoleccion`);

--
-- Indices de la tabla `recoleccion_vehiculo`
--
ALTER TABLE `recoleccion_vehiculo`
  ADD PRIMARY KEY (`id_recoleccion`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id_recorrido`);

--
-- Indices de la tabla `recorrido_vehiculo`
--
ALTER TABLE `recorrido_vehiculo`
  ADD PRIMARY KEY (`id_recorrido`,`matricula`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_plataforma`
--
ALTER TABLE `usuario_plataforma`
  ADD PRIMARY KEY (`id_usuario`,`id_plataforma`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `vehiculo_plataforma_lote`
--
ALTER TABLE `vehiculo_plataforma_lote`
  ADD PRIMARY KEY (`id_lote`,`id_plataforma`,`matricula`),
  ADD KEY `id_plataforma` (`id_plataforma`),
  ADD KEY `matricula` (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camionero`
--
ALTER TABLE `camionero`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32132;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recoleccion`
--
ALTER TABLE `recoleccion`
  MODIFY `id_recoleccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id_recorrido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camionero_vehiculo`
--
ALTER TABLE `camionero_vehiculo`
  ADD CONSTRAINT `camionero_vehiculo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `camionero` (`id_usuario`),
  ADD CONSTRAINT `camionero_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `cliente_recoleccion`
--
ALTER TABLE `cliente_recoleccion`
  ADD CONSTRAINT `cliente_recoleccion_ibfk_1` FOREIGN KEY (`id_recoleccion`) REFERENCES `recoleccion` (`id_recoleccion`),
  ADD CONSTRAINT `cliente_recoleccion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `paquete_lote`
--
ALTER TABLE `paquete_lote`
  ADD CONSTRAINT `paquete_lote_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `paquete_lote_ibfk_2` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

--
-- Filtros para la tabla `paquete_recorrido`
--
ALTER TABLE `paquete_recorrido`
  ADD CONSTRAINT `paquete_recorrido_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `paquete_recorrido_ibfk_2` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`);

--
-- Filtros para la tabla `plataforma_linea`
--
ALTER TABLE `plataforma_linea`
  ADD CONSTRAINT `plataforma_linea_ibfk_1` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`),
  ADD CONSTRAINT `plataforma_linea_ibfk_2` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id_linea`);

--
-- Filtros para la tabla `plataforma_lote`
--
ALTER TABLE `plataforma_lote`
  ADD CONSTRAINT `plataforma_lote_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `plataforma_lote_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`);

--
-- Filtros para la tabla `recoleccion_vehiculo`
--
ALTER TABLE `recoleccion_vehiculo`
  ADD CONSTRAINT `recoleccion_vehiculo_ibfk_1` FOREIGN KEY (`id_recoleccion`) REFERENCES `recoleccion` (`id_recoleccion`),
  ADD CONSTRAINT `recoleccion_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `recorrido_vehiculo`
--
ALTER TABLE `recorrido_vehiculo`
  ADD CONSTRAINT `recorrido_vehiculo_ibfk_1` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`),
  ADD CONSTRAINT `recorrido_vehiculo_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `usuario_plataforma`
--
ALTER TABLE `usuario_plataforma`
  ADD CONSTRAINT `usuario_plataforma_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_plataforma_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`);

--
-- Filtros para la tabla `vehiculo_plataforma_lote`
--
ALTER TABLE `vehiculo_plataforma_lote`
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`),
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id_plataforma`),
  ADD CONSTRAINT `vehiculo_plataforma_lote_ibfk_3` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
