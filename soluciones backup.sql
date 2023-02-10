-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2023 a las 20:41:00
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soluciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `codigo` int(11) NOT NULL,
  `cod_dian` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`codigo`, `cod_dian`, `nombre`, `departamento`) VALUES
(1, 1234, 'Mosquera', 1),
(2, 1235, 'Funza', 1),
(3, 1156, 'Bogota D.C', 2),
(4, 2234, 'Medellin', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `codigo` int(11) NOT NULL,
  `cod_dian` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`codigo`, `cod_dian`, `nombre`) VALUES
(1, 1245, 'Cundinamarca'),
(2, 1456, 'Bogota D.C.'),
(3, 2987, 'Medellin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `codigo` int(11) NOT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `digito` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `ciudad` int(11) NOT NULL,
  `representante` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` text DEFAULT NULL,
  `cant_emple` int(11) DEFAULT NULL,
  `cant_max_ofertas` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`codigo`, `nit`, `digito`, `nombre`, `logo`, `direccion`, `ciudad`, `representante`, `telefono`, `correo`, `cant_emple`, `cant_max_ofertas`, `estado`, `fecha_creacion`) VALUES
(1, '123456789', 1, 'empresa-prueba', NULL, 'Esta es una direccion falsa', 3, 'Miguel martinez', '98765432', 'empresa@solempre.co', 13, -1, 1, '2023-02-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_oferta`
--

CREATE TABLE `estado_oferta` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_oferta`
--

INSERT INTO `estado_oferta` (`codigo`, `descripcion`) VALUES
(1, 'Postulacion'),
(2, 'Entrevista'),
(3, 'Pruebas'),
(4, 'Contratacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `codigo` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`codigo`, `descripcion`, `estado`) VALUES
(1, 'Secundaria', NULL),
(2, 'Tecnico', NULL),
(3, 'Tecnologo', NULL),
(4, 'Universitario', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio_oferta`
--

CREATE TABLE `estudio_oferta` (
  `estudio` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `activo` int(11) DEFAULT 1,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keywords`
--

CREATE TABLE `keywords` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `keywords`
--

INSERT INTO `keywords` (`codigo`, `descripcion`) VALUES
(1, 'Salud'),
(2, 'Construcción'),
(3, 'Hidrocarburos'),
(4, 'Analista Financiero'),
(5, 'Desarrollador'),
(6, 'Sistemas ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `codigo` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad_max` int(11) DEFAULT -1,
  `salario` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `sector` int(11) NOT NULL,
  `experencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`codigo`, `empresa`, `nombre`, `descripcion`, `cantidad_max`, `salario`, `ciudad`, `fecha_creacion`, `fecha_publicacion`, `fecha_vencimiento`, `sector`, `experencia`) VALUES
(1, 1, 'este es el nombre', 'es una descripcion ', 13, 1500000, 2, '2023-02-09', '2023-02-09', '2023-02-10', 1, 1),
(2, 1, 'segunda', 'descripciones ', 4, 200000, 1, '2023-02-09', '2023-02-17', '2023-02-25', 1, 3),
(3, 1, 'numeoro 2', 'Esta esta oferta es la numero 2\r\nOK', 12, 12323453, 1, '2023-02-10', '2023-02-16', '2023-03-08', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_keyword`
--

CREATE TABLE `oferta_keyword` (
  `oferta` int(11) NOT NULL,
  `keyword` int(11) NOT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `codigo` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  `numero_doc` varchar(20) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `ciudad` int(11) NOT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` text NOT NULL,
  `curriculum` text DEFAULT NULL,
  `activo` int(11) DEFAULT 1,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`codigo`, `tipo_doc`, `numero_doc`, `nombre`, `apellido`, `fecha_nacimiento`, `ciudad`, `direccion`, `telefono`, `correo`, `curriculum`, `activo`, `fecha_creacion`) VALUES
(1, 1, '101609369', 'Miguel Angel', 'Martinez ramirez', '0000-00-00', 3, 'Esta direccion es nueva', '78965412', 'usuario@solempre.co', 'null', 1, '2023-02-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`codigo`, `descripcion`, `activo`) VALUES
(1, 'Tecnologia', 1),
(2, 'Construccion', 1),
(3, 'Salud', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_doc`
--

CREATE TABLE `tipo_doc` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_doc`
--

INSERT INTO `tipo_doc` (`codigo`, `descripcion`, `activo`) VALUES
(1, 'Cédula ciudadanía', 1),
(2, 'Tarjeta identidad', 1),
(3, 'Cédula extranjería ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL,
  `persona` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `usuario` varchar(200) NOT NULL,
  `contra` text NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `persona`, `empresa`, `usuario`, `contra`, `fecha_creacion`, `estado`, `tipo`) VALUES
(1, 1, NULL, 'usuario', '9250e222c4c71f0c58d4c54b50a880a312e9f9fed55d5c3aa0b0e860ded99165', '0000-00-00', 1, 2),
(2, NULL, 1, 'empresa', '307ca7a62478d2e67ccf1319d291ad8d3efff0971dc326bbe225fa8d880fb165', '2023-02-09', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_oferta`
--

CREATE TABLE `usuario_oferta` (
  `persona` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado` int(11) NOT NULL,
  `activo` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_oferta`
--

INSERT INTO `usuario_oferta` (`persona`, `oferta`, `fecha_creacion`, `estado`, `activo`) VALUES
(1, 1, '2023-02-10', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `estado_oferta`
--
ALTER TABLE `estado_oferta`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `estudio_oferta`
--
ALTER TABLE `estudio_oferta`
  ADD PRIMARY KEY (`estudio`,`oferta`),
  ADD KEY `oferta` (`oferta`);

--
-- Indices de la tabla `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `ciudad` (`ciudad`),
  ADD KEY `sector` (`sector`);

--
-- Indices de la tabla `oferta_keyword`
--
ALTER TABLE `oferta_keyword`
  ADD PRIMARY KEY (`oferta`,`keyword`),
  ADD KEY `keyword` (`keyword`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `tipo_doc` (`tipo_doc`),
  ADD KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `tipo_doc`
--
ALTER TABLE `tipo_doc`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `persona` (`persona`),
  ADD UNIQUE KEY `empresa` (`empresa`);

--
-- Indices de la tabla `usuario_oferta`
--
ALTER TABLE `usuario_oferta`
  ADD PRIMARY KEY (`persona`,`oferta`),
  ADD KEY `oferta` (`oferta`),
  ADD KEY `estado` (`estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_oferta`
--
ALTER TABLE `estado_oferta`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `keywords`
--
ALTER TABLE `keywords`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_doc`
--
ALTER TABLE `tipo_doc`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`codigo`);

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`codigo`);

--
-- Filtros para la tabla `estudio_oferta`
--
ALTER TABLE `estudio_oferta`
  ADD CONSTRAINT `estudio_oferta_ibfk_1` FOREIGN KEY (`estudio`) REFERENCES `estudios` (`codigo`),
  ADD CONSTRAINT `estudio_oferta_ibfk_2` FOREIGN KEY (`oferta`) REFERENCES `ofertas` (`codigo`);

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`codigo`),
  ADD CONSTRAINT `ofertas_ibfk_2` FOREIGN KEY (`sector`) REFERENCES `sector` (`codigo`);

--
-- Filtros para la tabla `oferta_keyword`
--
ALTER TABLE `oferta_keyword`
  ADD CONSTRAINT `oferta_keyword_ibfk_1` FOREIGN KEY (`oferta`) REFERENCES `ofertas` (`codigo`),
  ADD CONSTRAINT `oferta_keyword_ibfk_2` FOREIGN KEY (`keyword`) REFERENCES `keywords` (`codigo`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_doc`) REFERENCES `tipo_doc` (`codigo`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`codigo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `persona` (`codigo`);

--
-- Filtros para la tabla `usuario_oferta`
--
ALTER TABLE `usuario_oferta`
  ADD CONSTRAINT `usuario_oferta_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `persona` (`codigo`),
  ADD CONSTRAINT `usuario_oferta_ibfk_2` FOREIGN KEY (`oferta`) REFERENCES `ofertas` (`codigo`),
  ADD CONSTRAINT `usuario_oferta_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estado_oferta` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
