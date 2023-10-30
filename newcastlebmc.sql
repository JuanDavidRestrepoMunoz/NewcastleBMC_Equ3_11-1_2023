-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2023 a las 22:11:50
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `newcastlebmc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_material` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_tipo` int(3) NOT NULL,
  `textura` varchar(30) NOT NULL,
  `color` varchar(15) NOT NULL,
  `largo` float NOT NULL,
  `ancho` float NOT NULL,
  `costo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_material`, `nombre`, `id_tipo`, `textura`, `color`, `largo`, `ancho`, `costo`) VALUES
(11, 'hhh', 8, 'corro', 'beige', 66, 55, 15000),
(21, 'triplex', 6, 'a', 'gris', 150, 10, 12000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 7, 8, 'Hola'),
(2, 9, 8, 'Holi'),
(3, 9, 8, 'Hola'),
(4, 8, 9, 'Cómo estás??'),
(5, 8, 9, '❤');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nom_permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_us` int(2) NOT NULL,
  `costo` double NOT NULL,
  `obj` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nom`, `id_us`, `costo`, `obj`) VALUES
(2, 'Nuevo', 8, 0, ''),
(8, 'xD', 8, 0, 'Piedrax653c94f339958.json');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mate`
--

CREATE TABLE `tipo_mate` (
  `id_tipo` int(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_mate`
--

INSERT INTO `tipo_mate` (`id_tipo`, `nombre`, `descr`) VALUES
(5, 'Madera', ''),
(6, 'Carton', ''),
(7, 'Cinta', ''),
(8, 'Papel\r\n', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tip_us` int(2) NOT NULL,
  `nom_us` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `union`
--

CREATE TABLE `union` (
  `tip_us` int(2) NOT NULL,
  `id_permiso` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_us` int(2) NOT NULL,
  `tip_us` int(2) NOT NULL,
  `apod` varchar(15) NOT NULL,
  `nom1` varchar(30) NOT NULL,
  `nom2` varchar(30) NOT NULL,
  `ape1` varchar(30) NOT NULL,
  `ape2` varchar(30) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `cont` varchar(101) NOT NULL,
  `descr` varchar(250) NOT NULL,
  `img` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_us`, `tip_us`, `apod`, `nom1`, `nom2`, `ape1`, `ape2`, `correo`, `cont`, `descr`, `img`, `status`) VALUES
(7, 0, 'gargolin', 'juan', 'david', 'restrepo', 'muñoz', 'juanda5120r@gmail.com', 'bc7bfc19046343c8217a1d81c1733f05', '', 'face-0.jpg', 'Desconectado Ahora'),
(8, 0, 'Piedrax', 'Luis', '', 'Gómez', '', 'luispg369@gmail.com', '1679091c5a880faf6fb5e6087eb1b2dc', 'Ahora me estoy perreando una gata mejor', '1698016314Sin título.png', 'Conectado ahora'),
(9, 0, 'SANCHO', 'Simón', '', 'Sánchez', '', 'simonsanchez@gmail.com', '1c383cd30b7c298ab50293adfecb7b18', '', 'face-0.jpg', 'Desconectado ahora');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_tipo` (`id_tipo`) USING BTREE;

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_us` (`id_us`);

--
-- Indices de la tabla `tipo_mate`
--
ALTER TABLE `tipo_mate`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tip_us`);

--
-- Indices de la tabla `union`
--
ALTER TABLE `union`
  ADD PRIMARY KEY (`tip_us`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `tip_us` (`tip_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `tip_us` (`tip_us`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_material` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_mate`
--
ALTER TABLE `tipo_mate`
  MODIFY `id_tipo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `tip_us` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_mate` (`id_tipo`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_4` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
