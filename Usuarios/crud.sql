-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2023 a las 01:07:52
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(11) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `numero_paquete` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `destino`, `descripcion`, `fecha`, `numero_paquete`) VALUES
(77, 'Luis alberto de herrera y juan roman riquelme 3304', 'jfsdhfskjhfskjhfskjhfkshfksfhkshfkshfkhfskfkshfskjfskfhsfskhfskjfsfsf', '2023-07-07 09:03:22', 2147483647),
(78, 'Luis alberto de herrera y juan roman riquelme 3304', 'asda', '2023-07-07 11:04:22', 1010101010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `clave` varchar(20) NOT NULL,
  `puesto` varchar(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `numero_funcionario` int(10) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`clave`, `puesto`, `id_usuario`, `numero_funcionario`, `fecha_ingreso`) VALUES
('backoffice', 'backoffice', 9, 1234567890, '2023-07-07 10:23:21'),
('ivan12345', 'camionero', 15, 1010101010, '2023-07-07 10:54:31'),
('Pepito234', 'almaceneroMontevideo', 28, 1212121212, '2023-07-07 23:05:22'),
('123123', 'almaceneroInterior', 29, 2147483647, '2023-07-07 23:05:42'),
('Pepito234', 'repartidor', 30, 2112332133, '2023-07-07 23:06:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
