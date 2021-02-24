-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2020 a las 02:23:21
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_agua`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `id` int(11) NOT NULL,
  `Humedad` float NOT NULL,
  `Temperatura` float NOT NULL,
  `valvula_1` varchar(10) NOT NULL,
  `valvula_2` varchar(10) NOT NULL,
  `SF1` int(3) NOT NULL,
  `SF2` int(3) NOT NULL,
  `SF3` int(3) NOT NULL,
  `SNivel` varchar(5) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sensores`
--

INSERT INTO `sensores` (`id`, `Humedad`, `Temperatura`, `valvula_1`, `valvula_2`, `SF1`, `SF2`, `SF3`, `SNivel`, `Fecha_Hora`) VALUES
(1, 96.63, 23.12, 'encendida', 'apagada', 20, 0, 0, '10', '2020-10-05 22:58:50'),
(2, 57, 22.3, '', '', 0, 0, 0, '0', '2020-10-05 22:59:34'),
(3, 57, 22.2, '', '', 0, 0, 0, '0', '2020-10-05 22:59:35'),
(4, 57, 22.2, '', '', 0, 0, 0, '0', '2020-10-05 22:59:36'),
(5, 56, 22.2, '', '', 0, 0, 0, '0', '2020-10-05 22:59:38'),
(6, 56, 22.2, '', '', 0, 0, 0, '0', '2020-10-05 22:59:39'),
(7, 56, 22.3, '', '', 0, 0, 0, '0', '2020-10-05 22:59:40'),
(8, 56, 22.3, '', '', 0, 0, 0, '0', '2020-10-05 22:59:42'),
(9, 56, 22.3, '', '', 0, 0, 0, '0', '2020-10-05 22:59:43'),
(10, 56, 22.3, '', '', 0, 0, 0, '0', '2020-10-05 22:59:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19356;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
