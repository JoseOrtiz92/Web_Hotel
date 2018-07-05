-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2018 a las 15:25:05
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotelspa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `precio`) VALUES
(0, 'Gimnasio', 20),
(1, 'Masaje', 15),
(2, 'Spa', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(3) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `tipo`, `precio`) VALUES
(0, 'Simple', 20),
(1, 'Doble', 25),
(2, 'Simple', 20),
(4, 'Frontier', 40),
(5, 'Dreamer', 35),
(6, 'Enterpriser', 28),
(7, 'Windowmaker', 30),
(9, 'Doble', 25),
(10, 'Frontier', 40),
(11, 'Dreamer', 35),
(12, 'Enterpriser', 28),
(13, 'Windowmaker', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaactividad`
--

CREATE TABLE `reservaactividad` (
  `id_reserva` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date DEFAULT NULL,
  `id_pension` int(11) NOT NULL,
  `total_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario`, `id_habitacion`, `fecha_entrada`, `fecha_salida`, `id_pension`, `total_reserva`) VALUES
(1, 'jose', 11, '2017-12-02', '2017-12-03', 2, 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pension`
--

CREATE TABLE `tipo_pension` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_pension`
--

INSERT INTO `tipo_pension` (`id`, `tipo`, `precio`) VALUES
(0, 'Sin pension', 0),
(1, 'Media Pension', 25),
(2, 'Pension Completa', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(30) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `password` varchar(4) NOT NULL,
  `saldo` float NOT NULL DEFAULT '200'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `nombre`, `direccion`, `telefono`, `password`, `saldo`) VALUES
('admin', 'Administrador', '', '0', '9999', 200),
('jose', 'Jose', 'San Fernando', '+34695632365', '123', 314.5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservaactividad`
--
ALTER TABLE `reservaactividad`
  ADD PRIMARY KEY (`id_reserva`,`id_servicio`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_hab_fk` (`id_habitacion`),
  ADD KEY `res_idpension_fk` (`id_pension`) USING BTREE,
  ADD KEY `res_usua_fk` (`usuario`);

--
-- Indices de la tabla `tipo_pension`
--
ALTER TABLE `tipo_pension`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservaactividad`
--
ALTER TABLE `reservaactividad`
  ADD CONSTRAINT `resact_idres_fk` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `res_hab_fk` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`),
  ADD CONSTRAINT `res_idpension_fk` FOREIGN KEY (`id_pension`) REFERENCES `tipo_pension` (`id`),
  ADD CONSTRAINT `res_usua_fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
