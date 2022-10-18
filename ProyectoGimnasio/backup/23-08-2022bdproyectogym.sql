-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2022 a las 23:40:51
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
-- Indices de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  ADD PRIMARY KEY (`tbinstructorid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  MODIFY `tbinstructorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
