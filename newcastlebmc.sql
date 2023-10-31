-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 00:22:14
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
  `id_us` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_tipo` int(3) NOT NULL,
  `textura` longtext NOT NULL,
  `color` varchar(15) NOT NULL,
  `largo` float NOT NULL,
  `ancho` float NOT NULL,
  `costo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_material`, `id_us`, `nombre`, `id_tipo`, `textura`, `color`, `largo`, `ancho`, `costo`) VALUES
(1, 8, 'Cartón paja', 6, 'madera', 'gris', 65, 100, 4000),
(2, 8, 'Cinta normal', 7, 'redonda', 'transparente', 20, 60, 3000);

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
(5, 8, 7, 'wow'),
(6, 9, 7, 'ñ'),
(7, 10, 9, 'Oeeeee'),
(8, 7, 9, 'que dice el juanda '),
(9, 7, 9, 'un saludo pa las perras chechooooo'),
(10, 9, 8, 'Hola'),
(11, 8, 9, 'Hola'),
(12, 10, 9, 'hola chancletica'),
(13, 9, 10, 'Hey, Wake Up chocolito'),
(14, 7, 9, 'si'),
(15, 10, 9, 'Hey chancletico'),
(16, 9, 10, 'Hola chocolito'),
(17, 10, 9, 'Te amo Hugo❤️'),
(18, 10, 9, '🥰🥰'),
(19, 9, 10, 'hola'),
(20, 10, 9, 'Ey'),
(21, 9, 10, 'Hola'),
(22, 10, 9, 'Huguito'),
(23, 9, 10, 'Chocolito'),
(24, 10, 9, 'Cómo estás??'),
(25, 9, 10, 'Eyyyy'),
(26, 10, 9, 'hey friend'),
(27, 10, 9, 'your mock up is the best'),
(28, 10, 9, 'Holiii'),
(29, 9, 10, '👌👌'),
(30, 10, 9, 'hola '),
(31, 10, 9, 'como estas'),
(32, 10, 9, 'hola'),
(33, 10, 9, 'hola'),
(34, 10, 9, 'hola'),
(35, 10, 9, 'hola amigo'),
(36, 10, 9, 'hola claudia'),
(37, 9, 10, '👌👌'),
(38, 10, 9, 'hola'),
(39, 10, 9, 'si'),
(40, 10, 9, '❤️'),
(41, 10, 9, 'hola'),
(42, 10, 9, 'oe'),
(43, 10, 9, 'jolsa'),
(44, 10, 9, 'hola'),
(45, 10, 7, 'bebe que hacemoooooooooo'),
(46, 7, 12, 'se arreglo pa salir'),
(47, 7, 12, 'freshkerias');

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
(2, 'Hola', 8, 0, '');

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
(7, 0, 'gargolin', 'juan', 'david', 'restrepo', 'muñoz', 'juanda5120r@gmail.com', 'bc7bfc19046343c8217a1d81c1733f05', 'Mera maquina Ma G', 'face-0.jpg', 'Conectado ahora'),
(8, 0, 'Piedra', 'Luis', '', 'Gómez', '', 'luispg369@gmail.com', '1679091c5a880faf6fb5e6087eb1b2dc', 'Ahora me estoy perreando una gata mejor', '16987052941687928472438.jpg', 'Conectado ahora'),
(9, 0, 'SANCHO', 'Simón', '', 'Sánchez', '', 'simonsanchez@gmail.com', '1c383cd30b7c298ab50293adfecb7b18', 'Hola gd', 'face-0.jpg', 'Conectado ahora'),
(10, 0, 'el_lechepaix.', 'Hugi', 'Alejandro', 'Torres', 'V.', 'huguitotorres0530@gmail.com', 'ac5585d98646d255299c359140537783', 'famoso stremer de 17 años nacido en cucuta en la frontera con venezuela', 'face-0.jpg', 'Conectado ahora'),
(12, 0, 'Cu u u u u ux', 'Salomon', '', 'Villada ', 'Hoyos', 'cuuux@g.co', 'b9a6d4c312a69bb4e8ac5349f0f06a38', '', 'face-0.jpg', 'Conectado ahora');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_tipo` (`id_tipo`) USING BTREE,
  ADD KEY `id_us` (`id_us`);

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
  MODIFY `id_material` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_us` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_mate` (`id_tipo`),
  ADD CONSTRAINT `materiales_ibfk_2` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_4` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
