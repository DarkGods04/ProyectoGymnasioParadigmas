-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2022 a las 23:44:51
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
-- Base de datos: `bdproyectogym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbactivofijo`
--

CREATE TABLE `tbactivofijo` (
  `tbactivofijoid` tinyint(4) NOT NULL,
  `tbactivofijoplaca` varchar(50) NOT NULL,
  `tbactivofijoserie` varchar(50) NOT NULL,
  `tbactivofijomodelo` varchar(100) NOT NULL,
  `tbactivofijofechacompra` date NOT NULL,
  `tbactivofijoestadouso` varchar(100) NOT NULL,
  `tbactivofijoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbactivofijo`
--

INSERT INTO `tbactivofijo` (`tbactivofijoid`, `tbactivofijoplaca`, `tbactivofijoserie`, `tbactivofijomodelo`, `tbactivofijofechacompra`, `tbactivofijoestadouso`, `tbactivofijoactivo`) VALUES
(1, 'P065', '890LVLT27', 'Level', '2006-08-07', 'En uso', 1),
(2, 'P066', '83421ULT28', 'LevelUltimate', '2022-09-10', 'Fuera de uso', 1),
(3, 'P067', '345TEKT987', 'TEKTRO', '2022-09-01', 'En uso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbactivovariable`
--

CREATE TABLE `tbactivovariable` (
  `tbactivovariableid` int(11) NOT NULL,
  `tbactivovariablenombre` varchar(50) NOT NULL,
  `tbactivovariablecantidad` int(11) NOT NULL,
  `tbactivovariabledescripcion` varchar(200) NOT NULL,
  `tbactivovariableactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbactivovariable`
--

INSERT INTO `tbactivovariable` (`tbactivovariableid`, `tbactivovariablenombre`, `tbactivovariablecantidad`, `tbactivovariabledescripcion`, `tbactivovariableactivo`) VALUES
(1, 'Mancuernas', 24, 'Mancuernas de 10Lbs', 1),
(2, 'Cuerda', 10, '3 mtrs', 1),
(3, 'Pesa', 24, 'Pesa de 20 kilos', 1),
(4, 'Mancuerna doble', 12, 'Mancuerna doble de 30kilos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcliente`
--

CREATE TABLE `tbcliente` (
  `tbclienteid` int(11) NOT NULL,
  `tbclientenombre` varchar(50) NOT NULL,
  `tbclienteapellido1` varchar(50) NOT NULL,
  `tbclienteapellido2` varchar(50) NOT NULL,
  `tbclientetelefono` varchar(50) NOT NULL,
  `tbclientefechanacimiento` date NOT NULL,
  `tbclientegenero` varchar(50) NOT NULL,
  `tbclientepeso` varchar(50) NOT NULL,
  `tbclientealtura` varchar(50) NOT NULL,
  `tbclientecorreo` varchar(50) NOT NULL,
  `tbclienteactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido1`, `tbclienteapellido2`, `tbclientetelefono`, `tbclientefechanacimiento`, `tbclientegenero`, `tbclientepeso`, `tbclientealtura`, `tbclientecorreo`, `tbclienteactivo`) VALUES
(1, 'Juan', 'Jiménez', 'Mora', '999999999999', '2003-02-14', 'Masculino', '88kg', '1.70', 'juannmora7777@gmail.com', 1),
(2, 'Mario', 'Lopez', 'Juarez', '88760901', '2015-02-19', 'Masculino', '656kg', ' 1.82', ' juare333@gmail.com', 1),
(3, 'Sergio', 'Andrade', 'Villalobos', '87878787', '2022-09-07', 'Masculino', '76', '1.90', 'sergio@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientepeso`
--

CREATE TABLE `tbclientepeso` (
  `tbclientepesoid` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbclientepesofecha` date NOT NULL,
  `tbclientepesopeso` int(10) NOT NULL,
  `tbinstructorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientepeso`
--

INSERT INTO `tbclientepeso` (`tbclientepesoid`, `tbclienteid`, `tbclientepesofecha`, `tbclientepesopeso`, `tbinstructorid`) VALUES
(1, 1111, '2022-07-19', 65, 1),
(2, 2222, '2022-07-26', 68, 2),
(3, 3333, '2022-07-29', 69, 3),
(4, 4444, '2022-07-30', 70, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinstructor`
--

CREATE TABLE `tbinstructor` (
  `tbinstructorid` int(11) NOT NULL,
  `tbinstructornombre` varchar(50) NOT NULL,
  `tbinstructorapellido` varchar(50) NOT NULL,
  `tbinstructorcorreo` varchar(50) NOT NULL,
  `tbinstructortelefono` int(11) NOT NULL,
  `tbinstructornumcuenta` varchar(50) NOT NULL,
  `tbinstructortipo` varchar(50) NOT NULL,
  `tbinstructoractivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbinstructor`
--

INSERT INTO `tbinstructor` (`tbinstructorid`, `tbinstructornombre`, `tbinstructorapellido`, `tbinstructorcorreo`, `tbinstructortelefono`, `tbinstructornumcuenta`, `tbinstructortipo`, `tbinstructoractivo`) VALUES
(1, 'Arturo', 'Elizondo', 'arturo1998@gmail.com', 87234092, 'CR123456789', 'Entrenador personal', 1),
(2, 'Cristian', 'Brenes', 'cristianbr@gmail.com', 87687678, 'BN123456789', 'Fisioterapeuta', 1),
(3, 'Cindy', 'Fernández', 'cindylf@gmail.com', 87234093, 'CR123456789', 'Nutricionista', 1),
(4, 'María', 'Cordero', 'maria@gmail.com', 45677332, 'CR2223233333', 'Fisioterapeuta', 1),
(5, 'Isaí', 'Ríos', 'isairios@gmail.com', 65123123, 'CR987659999', 'Nutricionista', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbactivofijo`
--
ALTER TABLE `tbactivofijo`
  ADD PRIMARY KEY (`tbactivofijoid`);

--
-- Indices de la tabla `tbactivovariable`
--
ALTER TABLE `tbactivovariable`
  ADD PRIMARY KEY (`tbactivovariableid`);

--
-- Indices de la tabla `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`tbclienteid`);

--
-- Indices de la tabla `tbclientepeso`
--
ALTER TABLE `tbclientepeso`
  ADD PRIMARY KEY (`tbclientepesoid`);

--
-- Indices de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  ADD PRIMARY KEY (`tbinstructorid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbactivofijo`
--
ALTER TABLE `tbactivofijo`
  MODIFY `tbactivofijoid` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbactivovariable`
--
ALTER TABLE `tbactivovariable`
  MODIFY `tbactivovariableid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  MODIFY `tbinstructorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
