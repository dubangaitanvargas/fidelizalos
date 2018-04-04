-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2018 a las 14:45:00
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fidelizalos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `numIdentificacion` int(11) DEFAULT NULL,
  `nombresClientes` varchar(100) DEFAULT NULL,
  `celular1` varchar(15) DEFAULT NULL,
  `celular2` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL COMMENT 'Debe ser validado',
  `sexo` tinyint(1) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id` int(11) NOT NULL,
  `fechahoraenvio` varchar(45) DEFAULT NULL,
  `tipoEnvio` varchar(45) DEFAULT NULL COMMENT 'Enumerada 1=Mesaje Texto y 2=Email',
  `ventas_idVentas` int(11) NOT NULL,
  `respuestaEnvio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id` int(11) NOT NULL,
  `nombreNegocios` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `ifMuestraSexo` tinyint(1) DEFAULT NULL COMMENT 'Por defecto verdadera',
  `ifMuestraFechaNacimiento` tinyint(1) DEFAULT NULL COMMENT 'Por defecto verdadera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `nombreNegocios`, `direccion`, `telefono`, `email`, `logo`, `ifMuestraSexo`, `ifMuestraFechaNacimiento`) VALUES
(0, 'SIN NEGOCIO', 'SIN NEGOCIO', NULL, NULL, NULL, NULL, NULL),
(1, 'CDA CERTIMOTOS', NULL, NULL, NULL, NULL, 1, 0),
(2, 'PORTALES', NULL, NULL, NULL, NULL, 1, 1),
(3, 'ECOAUTOS', NULL, NULL, NULL, NULL, 1, 1),
(4, 'CIAS CARDEÑOZA', NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproductos`
--

CREATE TABLE `tipoproductos` (
  `id` int(11) NOT NULL,
  `nombreTipoProductos` varchar(45) NOT NULL,
  `diasVencimiento` int(11) DEFAULT NULL,
  `diasPrimerAviso` int(11) DEFAULT NULL COMMENT 'Primer Aviso cuantos dias antes le avisa, por defecto 30',
  `diasSegundoAviso` int(11) DEFAULT NULL COMMENT 'Segundo Aviso cuantos dias antes le avisa, por defecto 15',
  `diasTercerAviso` int(11) DEFAULT NULL COMMENT 'Tercer Aviso cuantos dias antes le avisa, por defecto 3',
  `diasCuartoAviso` int(11) DEFAULT NULL COMMENT 'Cuarto Aviso cuantos dias antes le avisa, por defecto 1',
  `diasQuintoAviso` int(11) DEFAULT NULL COMMENT 'Quinto Aviso Aviso cuantos dias antes le avisa, por defecto 3 dias mas',
  `ifDiasPrimeroAviso` tinyint(1) DEFAULT NULL,
  `ifDiaSegundoAviso` tinyint(1) NOT NULL,
  `ifDiaTerceroAviso` tinyint(1) NOT NULL,
  `ifDiaCuartoAviso` tinyint(1) NOT NULL,
  `ifDiaQuintoAviso` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoproductos`
--

INSERT INTO `tipoproductos` (`id`, `nombreTipoProductos`, `diasVencimiento`, `diasPrimerAviso`, `diasSegundoAviso`, `diasTercerAviso`, `diasCuartoAviso`, `diasQuintoAviso`, `ifDiasPrimeroAviso`, `ifDiaSegundoAviso`, `ifDiaTerceroAviso`, `ifDiaCuartoAviso`, `ifDiaQuintoAviso`) VALUES
(1, 'SOAT', 365, -30, -10, -5, 1, 2, 1, 0, 1, 1, 1),
(2, 'Tecnomecanica', 364, -30, -25, -5, -1, 2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `Negocios_idNegocios` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `privileges`, `activo`, `Negocios_idNegocios`, `updated_at`, `created_at`, `remember_token`) VALUES
(22, 'Duban Andres Gaitan Vargas', 'duban@duban.com', '$2y$10$X3dStyeSPwLEmn1cAI6pR.0PnQlp24HswMpZOMLb1mEMgI8WJnSky', NULL, NULL, 1, '2018-03-28', '2018-03-16', 'ks5ZU9yLcS75oMjkJhhqs4DyQitDBuKJimfW3ijAvz45iHNQvRLFIghkPreY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fechaVentas` date DEFAULT NULL,
  `docuReferencia` varchar(20) DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `necesitaRecordatorioMsg` tinyint(1) DEFAULT NULL,
  `necesitaRecordatorioEmail` tinyint(1) DEFAULT NULL,
  `tipoProductos_idTipoProductos` int(11) NOT NULL,
  `clientes_idClientes` int(11) NOT NULL,
  `negocios_idNegocios` int(11) NOT NULL,
  `fechaPrimerVencimiento` date DEFAULT NULL,
  `fechaSegundoVencimiento` date DEFAULT NULL,
  `fechaTercerVencimiento` date DEFAULT NULL,
  `fechaCuartoVencimiento` date DEFAULT NULL,
  `fechaQuintoVencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`,`ventas_idVentas`),
  ADD KEY `fk_Envios_Ventas` (`ventas_idVentas`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_User_Negocios` (`Negocios_idNegocios`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`,`tipoProductos_idTipoProductos`,`clientes_idClientes`,`negocios_idNegocios`),
  ADD KEY `fk_Ventas_TipoProductos` (`tipoProductos_idTipoProductos`),
  ADD KEY `fk_Ventas_Negocios` (`negocios_idNegocios`),
  ADD KEY `fk_Ventas_Clientes` (`clientes_idClientes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `fk_Envios_Ventas` FOREIGN KEY (`ventas_idVentas`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_User_Negocios` FOREIGN KEY (`Negocios_idNegocios`) REFERENCES `negocios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_Ventas_Clientes` FOREIGN KEY (`clientes_idClientes`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ventas_Negocios` FOREIGN KEY (`negocios_idNegocios`) REFERENCES `negocios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ventas_TipoProductos` FOREIGN KEY (`tipoProductos_idTipoProductos`) REFERENCES `tipoproductos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
