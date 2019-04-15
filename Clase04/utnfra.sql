-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2019 a las 02:58:45
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `utnfra`
--
CREATE DATABASE `utnfra`;
USE `utnfra`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `Id` int(18) NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Legajo` int(11) NOT NULL,
  `IdLocalidad` int(18) NOT NULL,
  `CreateDttm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`Id`, `Apellido`, `Legajo`, `IdLocalidad`, `CreateDttm`) VALUES
(1, 'Cea', 1, 2, '2019-04-08 20:07:45'),
(2, 'Ko', 2, 4, '2019-04-08 20:07:45'),
(3, 'Ramirez', 3, 3, '2019-04-08 20:07:45'),
(4, 'Sanchez', 4, 2, '2019-04-08 20:07:45'),
(5, 'Iacobellis', 5, 2, '2019-04-08 20:07:45'),
(7, 'Ianello', 7, 2, '2019-04-08 20:19:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `Id` int(11) NOT NULL,
  `CodigoPostal` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`Id`, `CodigoPostal`, `Nombre`) VALUES
(2, 1321, 'La Plata'),
(3, 1451, 'Avellaneda'),
(4, 4019, 'Recoleta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`Id`, `Descripcion`) VALUES
(1, 'Programacion'),
(2, 'Laboratorio'),
(3, 'Matematica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_alumno`
--

CREATE TABLE `materia_alumno` (
  `IdMateria` int(18) NOT NULL,
  `IdAlumno` int(18) NOT NULL,
  `Cuatrimestre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia_alumno`
--

INSERT INTO `materia_alumno` (`IdMateria`, `IdAlumno`, `Cuatrimestre`, `Nota`) VALUES
(1, 1, 'primero', 10),
(1, 4, 'segundo', 4),
(2, 2, 'primero', 8),
(2, 5, 'primero', 2),
(3, 3, 'segundo', 6),
(3, 7, 'segundo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `materia_alumno`
--
ALTER TABLE `materia_alumno`
  ADD PRIMARY KEY (`IdMateria`,`IdAlumno`,`Cuatrimestre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `Id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
