-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2018 a las 06:03:45
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `riesgo_auditoria`
--

CREATE DATABASE IF NOT EXISTS `riesgo_auditoria` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `riesgo_auditoria`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `id_tipo_calificacion` int(11) NOT NULL,
  `total` float NOT NULL,
  `rango` int(2) NOT NULL,
  `año` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `rgba` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `rgb` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `hex` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id_color`, `nombre`, `rgba`, `rgb`, `hex`) VALUES
(1, 'verde', '39,174,96,0.25', '39,174,96', '#27ae60'),
(2, 'amarillo', '39,174,96,0.25', '39,174,96', '#f1c40f'),
(3, 'naranja', '230,126,34,0.25', '230,126,34', '#e67e22'),
(4, 'rojo', '231,76,60,0.25', '231,76,60', '##e74c3c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factor`
--

CREATE TABLE `factor` (
  `id_factor` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `ponderacion` float NOT NULL,
  `id_tipo_calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factor`
--

INSERT INTO `factor` (`id_factor`, `descripcion`, `ponderacion`, `id_tipo_calificacion`) VALUES
(1, 'Tipo de Proceso', 0.2, 1),
(2, 'Relevancia Estratégica', 0.4, 1),
(3, 'Recursos Económicos Administrados', 0.2, 1),
(4, 'Prioridad del proceso para el organismo', 0.2, 1),
(5, 'Opinión de la UAI sobre el sistema de control interno del proceso', 0.2, 2),
(6, 'Definición de objetivos del proceso', 0.15, 2),
(7, 'Tiempo transcurrido desde la útima auditoría al proceso', 0.2, 2),
(8, 'Receptividad del/los responsable/s de las recomendaciones de auditoría', 0.1, 2),
(9, 'Observaciones de alto impacto referidas al proceso, pendientes de regulación', 0.1, 2),
(10, 'Deficiencias de organización del proceso', 0.15, 2),
(11, 'Dispersión geográfica del proceso', 0.1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_calificacion`
--

CREATE TABLE `linea_calificacion` (
  `id_linea_calificacion` int(11) NOT NULL,
  `id_calificacion` int(11) NOT NULL,
  `id_factor` int(11) NOT NULL,
  `id_valor_factor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_exposicion`
--

CREATE TABLE `nivel_exposicion` (
  `id_nivel_exposicion` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `rango_calificacion_impacto` int(11) NOT NULL,
  `rango_calificacion_probabilidad` int(11) NOT NULL,
  `color` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `nivel_exposicion`
--

INSERT INTO `nivel_exposicion` (`id_nivel_exposicion`, `nombre`, `rango_calificacion_impacto`, `rango_calificacion_probabilidad`, `color`, `id_color`) VALUES
(1, 'Riesgo medio', 1, 4, 'A', 2),
(2, 'Riesgo poco significativo', 1, 3, 'V', 1),
(3, 'Riesgo poco significativo', 1, 2, 'V', 1),
(4, 'Riesgo poco significativo', 1, 1, 'V', 1),
(5, 'Riesgo considerable', 2, 4, 'N', 3),
(6, 'Riesgo medio', 2, 3, 'A', 2),
(7, 'Riesgo poco significativo', 2, 2, 'V', 1),
(8, 'Riesgo poco significativo', 2, 1, 'V', 1),
(9, 'Riesgo significativo', 3, 4, 'R', 4),
(10, 'Riesgo considerable', 3, 3, 'N', 3),
(11, 'Riesgo medio', 3, 2, 'A', 2),
(12, 'Riesgo poco significativo', 3, 1, 'V', 1),
(13, 'Riesgo significativo', 4, 4, 'R', 4),
(14, 'Riesgo significativo', 4, 3, 'R', 4),
(15, 'Riesgo considerable', 4, 2, 'N', 3),
(16, 'Riesgo medio', 4, 1, 'A', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_exposicion_proceso`
--

CREATE TABLE `nivel_exposicion_proceso` (
  `id_nivel_exposicion_proceso` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `año` year(4) NOT NULL,
  `id_calificacion_probabilidad` int(11) NOT NULL,
  `id_calificacion_impacto` int(11) NOT NULL,
  `id_nivel_exposicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `objetivo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `responsable` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `id_nivel_exposicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_calificacion`
--

CREATE TABLE `tipo_calificacion` (
  `id_tipo_calificacion` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_calificacion`
--

INSERT INTO `tipo_calificacion` (`id_tipo_calificacion`, `nombre`) VALUES
(1, 'Impacto'),
(2, 'Probabilidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_factor`
--

CREATE TABLE `valor_factor` (
  `id_valor_factor` int(11) NOT NULL,
  `id_factor` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `valor_factor`
--

INSERT INTO `valor_factor` (`id_valor_factor`, `id_factor`, `descripcion`, `valor`) VALUES
(1, 1, 'Estratégico', 3),
(2, 1, 'Misional', 2),
(3, 1, 'Operativo', 1),
(4, 2, 'Alta', 3),
(5, 2, 'Media', 2),
(6, 2, 'Baja', 1),
(7, 3, 'Más del 35% del total considerado', 3),
(8, 3, 'Desde el 10% hasta el 35% del total considerado', 2),
(9, 3, 'Hasta 10% del total considerado', 1),
(10, 4, 'Alta', 3),
(11, 4, 'Media', 2),
(12, 4, 'Baja', 1),
(13, 10, 'Deficiencias en 3 o más componentes', 3),
(14, 10, 'Deficiencias en uno o dos componentes', 2),
(15, 10, 'Sin deficiencias', 1),
(16, 7, 'Más de 3 años', 3),
(17, 7, 'Entre 1 y 3 años', 2),
(18, 7, 'Menos de 1 año', 1),
(19, 8, 'Baja', 3),
(20, 8, 'Media', 2),
(21, 8, 'Alta', 1),
(22, 9, 'Más del 40%', 3),
(23, 9, 'Del 11% al 40%', 2),
(24, 9, 'Hasta 10% del total de observaciones', 1),
(25, 11, 'Proceso se ejecuta con gran dispersión geográfica ', 3),
(26, 11, 'El proceso se ejecuta con escasa o baja dispersión geográfica', 2),
(27, 11, 'Proceso se ejecuta en forma localizada', 1),
(28, 5, 'Inadecuado', 3),
(29, 5, 'Débil', 2),
(30, 5, 'Adecuado o razonable', 1),
(31, 6, 'Inadecuada', 3),
(32, 6, 'Parcialmente adecuada', 2),
(33, 6, 'Adecuada', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `id_proceso` (`id_proceso`),
  ADD KEY `id_tipo_calificacion` (`id_tipo_calificacion`) USING BTREE;

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `factor`
--
ALTER TABLE `factor`
  ADD PRIMARY KEY (`id_factor`),
  ADD KEY `id_tipo_calificacion` (`id_tipo_calificacion`);

--
-- Indices de la tabla `linea_calificacion`
--
ALTER TABLE `linea_calificacion`
  ADD PRIMARY KEY (`id_linea_calificacion`),
  ADD KEY `id_calificacion` (`id_calificacion`),
  ADD KEY `id_factor` (`id_factor`),
  ADD KEY `id_valor_factor` (`id_valor_factor`);

--
-- Indices de la tabla `nivel_exposicion`
--
ALTER TABLE `nivel_exposicion`
  ADD PRIMARY KEY (`id_nivel_exposicion`),
  ADD KEY `id_color` (`id_color`);

--
-- Indices de la tabla `nivel_exposicion_proceso`
--
ALTER TABLE `nivel_exposicion_proceso`
  ADD PRIMARY KEY (`id_nivel_exposicion_proceso`),
  ADD KEY `id_proceso` (`id_proceso`),
  ADD KEY `id_calificacion_probabilidad` (`id_calificacion_probabilidad`),
  ADD KEY `id_calificacion_impacto` (`id_calificacion_impacto`),
  ADD KEY `id_nivel_exposicion` (`id_nivel_exposicion`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`),
  ADD KEY `proceso_ibfk_1` (`id_nivel_exposicion`);

--
-- Indices de la tabla `tipo_calificacion`
--
ALTER TABLE `tipo_calificacion`
  ADD PRIMARY KEY (`id_tipo_calificacion`);

--
-- Indices de la tabla `valor_factor`
--
ALTER TABLE `valor_factor`
  ADD PRIMARY KEY (`id_valor_factor`),
  ADD KEY `id_factor` (`id_factor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factor`
--
ALTER TABLE `factor`
  MODIFY `id_factor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `linea_calificacion`
--
ALTER TABLE `linea_calificacion`
  MODIFY `id_linea_calificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel_exposicion`
--
ALTER TABLE `nivel_exposicion`
  MODIFY `id_nivel_exposicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `nivel_exposicion_proceso`
--
ALTER TABLE `nivel_exposicion_proceso`
  MODIFY `id_nivel_exposicion_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_calificacion`
--
ALTER TABLE `tipo_calificacion`
  MODIFY `id_tipo_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valor_factor`
--
ALTER TABLE `valor_factor`
  MODIFY `id_valor_factor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`id_tipo_calificacion`) REFERENCES `tipo_calificacion` (`id_tipo_calificacion`);

--
-- Filtros para la tabla `factor`
--
ALTER TABLE `factor`
  ADD CONSTRAINT `factor_ibfk_1` FOREIGN KEY (`id_tipo_calificacion`) REFERENCES `tipo_calificacion` (`id_tipo_calificacion`);

--
-- Filtros para la tabla `linea_calificacion`
--
ALTER TABLE `linea_calificacion`
  ADD CONSTRAINT `linea_calificacion_ibfk_1` FOREIGN KEY (`id_calificacion`) REFERENCES `calificacion` (`id_calificacion`),
  ADD CONSTRAINT `linea_calificacion_ibfk_2` FOREIGN KEY (`id_factor`) REFERENCES `factor` (`id_factor`),
  ADD CONSTRAINT `linea_calificacion_ibfk_3` FOREIGN KEY (`id_valor_factor`) REFERENCES `valor_factor` (`id_valor_factor`);

--
-- Filtros para la tabla `nivel_exposicion`
--
ALTER TABLE `nivel_exposicion`
  ADD CONSTRAINT `nivel_exposicion_ibfk_1` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`);

--
-- Filtros para la tabla `nivel_exposicion_proceso`
--
ALTER TABLE `nivel_exposicion_proceso`
  ADD CONSTRAINT `nivel_exposicion_proceso_ibfk_1` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`),
  ADD CONSTRAINT `nivel_exposicion_proceso_ibfk_2` FOREIGN KEY (`id_calificacion_probabilidad`) REFERENCES `calificacion` (`id_calificacion`),
  ADD CONSTRAINT `nivel_exposicion_proceso_ibfk_3` FOREIGN KEY (`id_calificacion_impacto`) REFERENCES `calificacion` (`id_calificacion`),
  ADD CONSTRAINT `nivel_exposicion_proceso_ibfk_4` FOREIGN KEY (`id_nivel_exposicion`) REFERENCES `nivel_exposicion` (`id_nivel_exposicion`);

--
-- Filtros para la tabla `valor_factor`
--
ALTER TABLE `valor_factor`
  ADD CONSTRAINT `valor_factor_ibfk_1` FOREIGN KEY (`id_factor`) REFERENCES `factor` (`id_factor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
