-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2022 a las 09:18:04
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_referencia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_precio` int(11) NOT NULL,
  `producto_peso` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_categoria` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_stock` int(11) NOT NULL,
  `producto_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `producto_nombre`, `producto_referencia`, `producto_precio`, `producto_peso`, `producto_categoria`, `producto_stock`, `producto_fecha`) VALUES
(1, 'cafe', 'cafe33', 5000, '100gr', 'expresso', 7, '2022-06-13'),
(3, 'cafe2', 'cafe1', 10000, '200gr', 'expresso', 20, '2022-06-13'),
(4, 'cafe con leche', 'cafeleche', 2000, '150gr', 'cafe', 15, '2022-06-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ventas_id` int(11) NOT NULL,
  `ventas_idproducto` int(11) NOT NULL,
  `ventas_producto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ventas_cantidad` int(11) NOT NULL,
  `ventas_total` int(11) NOT NULL,
  `ventas_comprador` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ventas_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ventas_id`, `ventas_idproducto`, `ventas_producto`, `ventas_cantidad`, `ventas_total`, `ventas_comprador`, `ventas_fecha`) VALUES
(4, 1, 'cafe', 2, 10000, 'willy', '2022-06-14'),
(11, 1, 'cafe', 2, 10000, 'lorena', '2022-06-14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ventas_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ventas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
