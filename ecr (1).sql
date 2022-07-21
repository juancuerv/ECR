-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2022 a las 23:37:38
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color_detectado`
--

CREATE TABLE `color_detectado` (
  `id` int(11) NOT NULL,
  `R` int(11) NOT NULL,
  `G` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `serial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color_orina`
--

CREATE TABLE `color_orina` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `color_orina`
--

INSERT INTO `color_orina` (`id`, `descripcion`) VALUES
(1, 'Sin color, transparente'),
(2, 'Color paja pálida'),
(3, 'Amarilla transparente'),
(4, 'Amarilla oscura'),
(5, 'Ambar o miel'),
(6, 'Jarabe o cerveza negra'),
(7, 'Rosada o rojiza'),
(8, 'Naranja'),
(9, 'Azul o verde'),
(10, 'Morada'),
(11, 'Espumosa u hormigueante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color_usuario`
--

CREATE TABLE `color_usuario` (
  `id` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES
(1, 'Antioquia'),
(2, 'Atlantico'),
(3, 'D. C. Santa Fe de Bogota'),
(4, 'Bolivar'),
(5, 'Boyaca'),
(6, 'Caldas'),
(7, 'Caqueta'),
(8, 'Cauca'),
(9, 'Cesar'),
(10, 'Cordoba'),
(11, 'Cundinamarca'),
(12, 'Choco'),
(13, 'Huila'),
(14, 'La Guajira'),
(15, 'Magdalena'),
(16, 'Meta'),
(17, 'Nariño'),
(18, 'Norte de Santander'),
(19, 'Quindio'),
(20, 'Risaralda'),
(21, 'Santander'),
(22, 'Sucre'),
(23, 'Tolima'),
(24, 'Valle'),
(25, 'Arauca'),
(26, 'Casanare'),
(27, 'Putumayo'),
(28, 'San Andres'),
(29, 'Amazonas'),
(30, 'Guainia'),
(31, 'Guaviare'),
(32, 'Vaupes'),
(33, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id` int(11) NOT NULL,
  `num_orina` int(11) NOT NULL,
  `num_miccion` int(11) NOT NULL,
  `presion` int(11) NOT NULL,
  `diabetes` tinyint(1) NOT NULL,
  `medicamento` int(11) NOT NULL,
  `acido` tinyint(1) NOT NULL,
  `reumaticas` tinyint(1) NOT NULL,
  `enf_renales` tinyint(1) NOT NULL,
  `quistes_ren` tinyint(1) NOT NULL,
  `color_orina` int(11) NOT NULL,
  `porc_riesgo` decimal(10,3) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`id`, `num_orina`, `num_miccion`, `presion`, `diabetes`, `medicamento`, `acido`, `reumaticas`, `enf_renales`, `quistes_ren`, `color_orina`, `porc_riesgo`, `usuario_id`) VALUES
(1, 1, 2, 90, 0, 1, 0, 0, 0, 0, 2, '93.650', 2),
(2, 3, 1, 90, 0, 1, 0, 0, 0, 0, 2, '98.650', 2),
(3, 1, 2, 90, 0, 1, 0, 0, 0, 0, 3, '58.970', 2),
(5, 4, 3, 130, 1, 1, 0, 0, 0, 0, 1, '90.910', 2),
(6, 5, 3, 100, 1, 1, 0, 0, 1, 0, 1, '76.460', 2),
(7, 5, 3, 120, 1, 1, 0, 0, 1, 1, 1, '75.990', 2),
(8, 4, 3, 160, 1, 1, 0, 0, 0, 0, 1, '90.910', 2),
(9, 4, 3, 150, 1, 1, 1, 1, 1, 1, 1, '51.520', 2),
(10, 5, 3, 140, 1, 1, 1, 1, 1, 1, 1, '69.700', 2),
(11, 2, 1, 120, 0, 1, 0, 0, 1, 0, 1, '99.150', 2),
(12, 2, 1, 120, 0, 2, 0, 0, 1, 0, 1, '82.050', 2),
(13, 5, 3, 140, 1, 4, 1, 1, 1, 1, 1, '100.000', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios_medicos`
--

CREATE TABLE `formularios_medicos` (
  `id` int(11) NOT NULL,
  `formulario_id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `recomendacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formularios_medicos`
--

INSERT INTO `formularios_medicos` (`id`, `formulario_id`, `medico_id`, `estado`, `recomendacion`) VALUES
(1, 1, 2, 0, 1),
(2, 2, 2, 0, 2),
(4, 8, 2, 1, NULL),
(5, 11, 1, 1, NULL),
(6, 13, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `descripcion`) VALUES
(1, 'No consume'),
(2, 'Antifúngicos'),
(3, 'Antibióticos'),
(4, 'Anti inflamatorios'),
(5, 'Inmunosupresores'),
(6, 'Inhibidores de enzima convertidora'),
(7, 'Antivirales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `disponibilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `usuario_id`, `disponibilidad`) VALUES
(1, 4, 1),
(2, 5, 1),
(3, 6, 0),
(4, 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendaciones`
--

CREATE TABLE `recomendaciones` (
  `id` int(11) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_recomendacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recomendaciones`
--

INSERT INTO `recomendaciones` (`id`, `descripcion`, `fecha_recomendacion`) VALUES
(1, 'Consultar a la EPS, en la fecha 21/07/2022.', '2022-07-20'),
(2, 'Consumir 2 litros de agua al día, reducir el consumo de carbohidratos, repetir el formulario en 3 meses.', '2022-07-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Paciente'),
(3, 'Médico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `num_id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `ciudades_id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` int(1) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `num_id`, `login`, `pass`, `tipo_usuario`, `activo`, `ciudades_id`, `nombres`, `apellidos`, `fecha_nac`, `genero`, `correo`) VALUES
(1, 1002958890, 'juancuerv', '202cb962ac59075b964b07152d234b70', 1, 1, 1, 'Juan Pablo', 'Cuervo Dorado', '2001-03-01', 1, 'syskidney@gmail.com'),
(2, 1002472654, 'mcerazo', 'c6f057b86584942e415435ffb1fa93d4', 2, 0, 3, 'María Camila', 'Erazo', '2000-10-03', 2, 'syskidney@gmail.com'),
(3, 1104578945, 'mcardona', '202cb962ac59075b964b07152d234b70', 1, 1, 2, 'Mariana', 'Cardona', '2000-12-02', 2, 'syskidney@gmail.com'),
(4, 1104578946, 'agarcia', '202cb962ac59075b964b07152d234b70', 3, 1, 1, 'Jaime Andrés ', 'García', '1999-02-04', 1, 'syskidney@gmail.com'),
(5, 1104578947, 'lmunoz', '202cb962ac59075b964b07152d234b70', 3, 1, 2, 'Lina', 'Muñoz', '1998-02-04', 2, 'syskidney@gmail.com'),
(6, 1104578948, 'maleja', '202cb962ac59075b964b07152d234b70', 3, 1, 3, 'María Alejandra', 'Ruíz', '2000-04-01', 2, 'syskidney@gmail.com'),
(7, 1104578949, 'gabsep', '202cb962ac59075b964b07152d234b70', 3, 1, 4, 'Gabriela', 'Delgado', '1999-09-09', 2, 'syskidney@gmail.com'),
(8, 1104578950, 'laumam', '202cb962ac59075b964b07152d234b70', 2, 1, 4, 'Laura', 'Muñoz', '1995-09-30', 2, 'syskidney@gmail.com'),
(9, 1104578951, 'arturito', '202cb962ac59075b964b07152d234b70', 2, 1, 5, 'Arturo', 'Hurtado', '2000-08-05', 1, 'syskidney@gmail.com'),
(10, 1104578952, 'luisb', '202cb962ac59075b964b07152d234b70', 2, 1, 5, 'Luis Carlos', 'Bonilla', '2002-11-09', 1, 'syskidney@gmail.com'),
(11, 1104578953, 'lcastillo', '202cb962ac59075b964b07152d234b70', 2, 0, 6, 'Lorena ', 'Castillo', '1999-07-16', 2, 'syskidney@gmail.com'),
(12, 1104578954, 'cmendez', '202cb962ac59075b964b07152d234b70', 2, 1, 6, 'Camilo', 'Mendez', '1995-04-15', 1, 'syskidney@gmail.com'),
(13, 1004568879, 'annieb', '202cb962ac59075b964b07152d234b70', 1, 1, 1, 'Annie Katherine', 'Barco ', '2000-02-02', 2, 'syskidney@gmail.com'),
(14, 1002947789, 'antoniom', '202cb962ac59075b964b07152d234b70', 2, 0, 1, 'Antonio Javier', 'Muñoz', '1960-03-01', 1, 'syskidney@gmail.com'),
(15, 123456789, 'lindam', '202cb962ac59075b964b07152d234b70', 1, 1, 1, 'Linda', 'Muñoz', '1999-03-01', 2, 'syskidney@gmail.com'),
(16, 1004876123, 'vrealpe', '202cb962ac59075b964b07152d234b70', 2, 1, 1, 'Santiago ', 'Realpe', '1990-02-01', 1, 'syskidney@gmail.com'),
(17, 9839302, 'luisdiaz', '202cb962ac59075b964b07152d234b70', 2, 1, 7, 'Luis ', 'Díaz', '1990-06-16', 1, 'syskidney@gmail.com'),
(18, 97123456, 'ccertuche', '202cb962ac59075b964b07152d234b70', 2, 1, 1, 'Camila', 'Certuche', '1997-03-01', 2, 'syskidney@gmail.com'),
(19, 96123141, 'vtrujilllo', '202cb962ac59075b964b07152d234b70', 1, 1, 1, 'Vladimir', 'Trujillo', '1990-01-01', 1, 'syskidney@gmail.com'),
(20, 75619134, 'ccuervo', '202cb962ac59075b964b07152d234b70', 2, 1, 1, 'Carlos', 'Cuervo', '1968-04-14', 1, 'carlosfcuervo20@hotmail.com'),
(21, 1002836363, 'linacg', '202cb962ac59075b964b07152d234b70', 2, 1, 1, 'Lina', 'Cabrera', '2001-01-15', 2, 'lmarcg@gmail.com'),
(22, 1002282821, 'sofiam', '202cb962ac59075b964b07152d234b70', 2, 1, 1, 'Sofía', 'Muñoz', '2001-07-15', 2, 'sofiam@unicauca.edu.co');

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
-- Indices de la tabla `color_detectado`
--
ALTER TABLE `color_detectado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color_orina`
--
ALTER TABLE `color_orina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color_usuario`
--
ALTER TABLE `color_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_color` (`id_color`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario_id`),
  ADD KEY `fk_color` (`color_orina`),
  ADD KEY `fk_medicamento` (`medicamento`);

--
-- Indices de la tabla `formularios_medicos`
--
ALTER TABLE `formularios_medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recomendacion_id` (`recomendacion`),
  ADD KEY `fk_formulario_medico` (`formulario_id`),
  ADD KEY `fk_medico_formulario` (`medico_id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_contactos_ciudades` (`ciudades_id`),
  ADD KEY `FK_usuarios_tipo` (`tipo_usuario`),
  ADD KEY `FK_usuarios_genero` (`genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `color_detectado`
--
ALTER TABLE `color_detectado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `color_orina`
--
ALTER TABLE `color_orina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `color_usuario`
--
ALTER TABLE `color_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `formularios_medicos`
--
ALTER TABLE `formularios_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `FK_ciudades_departamentos` FOREIGN KEY (`departamentos_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `color_usuario`
--
ALTER TABLE `color_usuario`
  ADD CONSTRAINT `fk_id_color` FOREIGN KEY (`id_color`) REFERENCES `color_detectado` (`id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD CONSTRAINT `fk_color` FOREIGN KEY (`color_orina`) REFERENCES `color_orina` (`id`),
  ADD CONSTRAINT `fk_medicamento` FOREIGN KEY (`medicamento`) REFERENCES `medicamentos` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `formularios_medicos`
--
ALTER TABLE `formularios_medicos`
  ADD CONSTRAINT `fk_formulario_medico` FOREIGN KEY (`formulario_id`) REFERENCES `formularios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medico_formulario` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recomendacion_id` FOREIGN KEY (`recomendacion`) REFERENCES `recomendaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_ciudades` FOREIGN KEY (`ciudades_id`) REFERENCES `ciudades` (`id`),
  ADD CONSTRAINT `FK_usuarios_genero` FOREIGN KEY (`genero`) REFERENCES `genero` (`id`),
  ADD CONSTRAINT `FK_usuarios_tipo` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
