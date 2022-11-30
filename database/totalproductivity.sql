-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2022 a las 19:15:34
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `totalproductivity`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `area_nombre` varchar(35) NOT NULL,
  `material` int(11) NOT NULL,
  `proceso` varchar(35) NOT NULL,
  `subproceso` varchar(35) NOT NULL,
  `status` varchar(15) NOT NULL,
  `imagen` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `area_nombre`, `material`, `proceso`, `subproceso`, `status`, `imagen`) VALUES
(1, 'EPS PLAIN', 1, 'Preexpansion', 'Modelado', 'Activo', ''),
(2, 'EPS PRINT', 2, 'Modelado', 'Pintado', 'Activo', ''),
(3, 'PAPER CUP', 3, 'Impresion', 'Formado', 'Activo', ''),
(4, 'TERMOFORMADO', 5, 'Llenado', 'Empaquetado', 'Activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eficiencias`
--

CREATE TABLE `eficiencias` (
  `id_eficiencias` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `ruta_produccion` int(11) NOT NULL,
  `nombre_area` int(11) NOT NULL,
  `ciclo_meta` varchar(25) NOT NULL,
  `meta_hora` varchar(25) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eficiencias`
--

INSERT INTO `eficiencias` (`id_eficiencias`, `codigo_producto`, `descripcion`, `ruta_produccion`, `nombre_area`, `ciclo_meta`, `meta_hora`, `status`) VALUES
(1, 1, 'Operacion', 1, 4, '145', '12', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `id_materiaprima` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `area_nombre` int(11) NOT NULL,
  `subarea` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`id_materiaprima`, `nombre`, `material`, `area_nombre`, `subarea`, `status`) VALUES
(1, 'Poliestireno', 'E 0-1', 1, 'Produccion', 'Activo'),
(2, 'Papel', 'A 0-1', 1, 'Produccion', 'Activo'),
(3, 'Polietileno', 'C 0-1', 3, 'Produccion', 'Activo'),
(4, 'Plastico', 'B 0-1', 4, 'Calidad', 'Activo'),
(5, 'Carton', 'Z 0-1', 3, 'Calidad', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `perfil` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `perfil`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problemas`
--

CREATE TABLE `problemas` (
  `id_problema` int(11) NOT NULL,
  `nombre_problema` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `nombre_area` varchar(35) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `problemas`
--

INSERT INTO `problemas` (`id_problema`, `nombre_problema`, `descripcion`, `nombre_area`, `status`) VALUES
(1, 'Work center A0-1 no trabajo 1 hora', 'Se dio mantenimiento al work center A0-1', 'EPS PLAIN', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(25) NOT NULL,
  `codigo_sistema` varchar(25) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `nombre_area` int(11) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `ciclo_meta` varchar(25) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `codigo_sistema`, `descripcion`, `nombre_area`, `observaciones`, `ciclo_meta`, `status`) VALUES
(1, 'A-450', 'C-111', 'Empaquetado', 4, 'Orden Starbocks', '180', 'Activo'),
(2, 'F-135', 'B-111', 'Producto Terminado', 3, 'Orden KFC', '200', 'Activo'),
(3, 'A-450', 'C-111', 'Pruebas Calidad', 2, 'Orden 7 Eleven', '250', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_produccion`
--

CREATE TABLE `ruta_produccion` (
  `id_rutaproduccion` int(11) NOT NULL,
  `workcenter` int(11) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `meta_hora` varchar(30) NOT NULL,
  `ciclo_estado` varchar(25) NOT NULL,
  `fecha_hora` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ruta_produccion`
--

INSERT INTO `ruta_produccion` (`id_rutaproduccion`, `workcenter`, `observaciones`, `meta_hora`, `ciclo_estado`, `fecha_hora`, `status`) VALUES
(1, 1, 'Mantenimiento', '15', '200', '2022-11-24', 'Activo'),
(2, 2, 'Operacion', '10', '180', '2022-11-24', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(35) NOT NULL,
  `nomina` varchar(15) NOT NULL,
  `perfil` varchar(25) NOT NULL,
  `puesto` varchar(30) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contrasena` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `nombre_area` varchar(35) NOT NULL,
  `token` varchar(255) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `nomina`, `perfil`, `puesto`, `email`, `contrasena`, `status`, `nombre_area`, `token`, `perfil_id`, `area_id`) VALUES
(1, 'Angel Uriel Sanchez Montoya', '47329', 'Administrador', 'Supervisor IT', 'angel.sanchez@dart.biz', 'angel12345', 'Activo', 'EPS PLAIN', '', 1, 1),
(2, 'Angel Uriel Sanchez Montoya', '47329', 'Administrador', 'Supervisor IT', 'angel.sanchez@dart.biz', 'angel12345', 'Inactivo', 'EPS PRINT', '', 1, 2),
(3, 'Alexis Angeles Segundo', '270804', 'Administrador', 'Practicante IT', 'alexis.angeles@dart.biz', 'alexis12345', 'Activo', 'EPS PRINT', '', 1, 2),
(4, 'Alexis Angeles Segundo', '270804', 'Supervisor', 'Practicante IT', 'alexis.angeles@dart.biz', 'alexis12345', 'Activo', 'PAPER CUP', '', 2, 3),
(5, 'Alexis Angeles Segundo', '270804', 'Usuario', 'Practicante IT', 'alexis.angeles@dart.biz', 'alexis12345', 'Activo', 'TERMOFORMADO', '', 3, 4),
(6, 'Tomas Flores', '123456', 'Usuario', 'Supervisor', 'tomas.flores@dart.biz', 'tomas12345', 'Activo', 'TERMOFORMADO', '', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workcenter`
--

CREATE TABLE `workcenter` (
  `id_workcenter` int(11) NOT NULL,
  `workcenter` varchar(45) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `numero_serie` varchar(30) NOT NULL,
  `fabricante` varchar(45) NOT NULL,
  `area_nombre` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `workcenter`
--

INSERT INTO `workcenter` (`id_workcenter`, `workcenter`, `modelo`, `numero_serie`, `fabricante`, `area_nombre`, `material`, `status`) VALUES
(1, 'A 1-6', 'Uline', 'JK123MH451', 'Fang-Yuan', 1, 1, 'Activo'),
(2, 'A 7-12', 'Uline', 'JK123MH018', 'Fang-Yuan', 2, 2, 'Activo'),
(3, 'A 1-8', 'Uline', 'JK123MH154', 'Fang-Yuan', 4, 3, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `material` (`material`);

--
-- Indices de la tabla `eficiencias`
--
ALTER TABLE `eficiencias`
  ADD PRIMARY KEY (`id_eficiencias`),
  ADD KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `ruta_produccion` (`ruta_produccion`),
  ADD KEY `nombre_area` (`nombre_area`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`id_materiaprima`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `problemas`
--
ALTER TABLE `problemas`
  ADD PRIMARY KEY (`id_problema`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `ruta_produccion`
--
ALTER TABLE `ruta_produccion`
  ADD PRIMARY KEY (`id_rutaproduccion`),
  ADD KEY `workcenter` (`workcenter`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `workcenter`
--
ALTER TABLE `workcenter`
  ADD PRIMARY KEY (`id_workcenter`),
  ADD KEY `material` (`material`),
  ADD KEY `area_nombre` (`area_nombre`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `eficiencias`
--
ALTER TABLE `eficiencias`
  MODIFY `id_eficiencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `id_materiaprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `problemas`
--
ALTER TABLE `problemas`
  MODIFY `id_problema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ruta_produccion`
--
ALTER TABLE `ruta_produccion`
  MODIFY `id_rutaproduccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `workcenter`
--
ALTER TABLE `workcenter`
  MODIFY `id_workcenter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_2` FOREIGN KEY (`material`) REFERENCES `materia_prima` (`id_materiaprima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eficiencias`
--
ALTER TABLE `eficiencias`
  ADD CONSTRAINT `eficiencias_ibfk_1` FOREIGN KEY (`ruta_produccion`) REFERENCES `ruta_produccion` (`id_rutaproduccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eficiencias_ibfk_2` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eficiencias_ibfk_3` FOREIGN KEY (`nombre_area`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ruta_produccion`
--
ALTER TABLE `ruta_produccion`
  ADD CONSTRAINT `ruta_produccion_ibfk_1` FOREIGN KEY (`workcenter`) REFERENCES `workcenter` (`id_workcenter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `workcenter`
--
ALTER TABLE `workcenter`
  ADD CONSTRAINT `workcenter_ibfk_2` FOREIGN KEY (`material`) REFERENCES `materia_prima` (`id_materiaprima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workcenter_ibfk_3` FOREIGN KEY (`area_nombre`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
