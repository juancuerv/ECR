-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2022 a las 23:20:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `departamentos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `departamentos_id`) VALUES
(1, 'Medellín', 1),
(2, 'Barranquilla', 2),
(3, 'Bogotá', 11),
(4, 'Cartagena de Indias', 4),
(5, 'Tunja', 5),
(6, 'Manizales', 6),
(7, 'Florencia', 7),
(8, 'Popayán', 8),
(9, 'Valledupar', 9),
(10, 'Montería', 10),
(12, 'Quibdó', 12),
(13, 'Neiva', 13),
(14, 'Riohacha', 14),
(15, 'Santa Marta', 15),
(16, 'Villavicencio', 16),
(17, 'Pasto', 17),
(18, 'San José de Cúcuta', 18),
(19, 'Armenia', 19),
(20, 'Pereira', 20),
(21, 'Bucaramanga', 21),
(22, 'Sincelejo', 22),
(23, 'Ibagué', 23),
(24, 'Cali', 24),
(25, 'Arauca', 25),
(26, 'Yopal', 26),
(27, 'Mocoa', 27),
(28, 'San Andrés', 28),
(29, 'Leticia', 29),
(30, 'Inírida', 30),
(31, 'San José del Guaviare', 31),
(32, 'Mitú', 32),
(33, 'Puerto Carreño', 33);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ciudades_departamentos` (`departamentos_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `FK_ciudades_departamentos` FOREIGN KEY (`departamentos_id`) REFERENCES `departamentos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
