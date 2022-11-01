-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2022 a las 07:07:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `tbactivofijomontocompra` float NOT NULL,
  `tbactivofijoestadouso` varchar(100) NOT NULL,
  `tbactivofijoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbactivofijo`
--

INSERT INTO `tbactivofijo` (`tbactivofijoid`, `tbactivofijoplaca`, `tbactivofijoserie`, `tbactivofijomodelo`, `tbactivofijofechacompra`, `tbactivofijomontocompra`, `tbactivofijoestadouso`, `tbactivofijoactivo`) VALUES
(1, 'P065', '890LVLT27', 'Level', '2006-08-07', 20000, 'En uso', 1),
(2, 'P066', '83421ULT28', 'LevelUltimate', '2022-09-10', 85000, 'Fuera de uso', 1),
(3, 'P067', '345TEKT987', 'TEKTRO', '2022-09-01', 25150, 'En uso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbactivovariable`
--

CREATE TABLE `tbactivovariable` (
  `tbactivovariableid` int(11) NOT NULL,
  `tbactivovariablenombre` varchar(50) NOT NULL,
  `tbactivovariablecantidad` int(11) NOT NULL,
  `tbactivovariablemontocompra` float NOT NULL,
  `tbactivovariabledescripcion` varchar(200) NOT NULL,
  `tbactivovariableactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbactivovariable`
--

INSERT INTO `tbactivovariable` (`tbactivovariableid`, `tbactivovariablenombre`, `tbactivovariablecantidad`, `tbactivovariablemontocompra`, `tbactivovariabledescripcion`, `tbactivovariableactivo`) VALUES
(1, 'Mancuernas', 24, 150000, 'Mancuernas de 10Lbs', 1),
(2, 'Cuerda', 10, 15000, 'Cuerda de 20 mtrs', 1),
(3, 'Pesa', 24, 5000, 'Pesa de 20 kilos', 1),
(4, 'Mancuernas', 10, 513206, 'Mancuernas de 10Lbs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogoclientetipo`
--

CREATE TABLE `tbcatalogoclientetipo` (
  `tbcatalogoclientetipoid` int(11) NOT NULL,
  `tbcatalogoclientetiponombre` varchar(50) NOT NULL,
  `tbcatalogoclientetipodescripcion` varchar(200) NOT NULL,
  `tbcatalogoclientetipoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogoejercicio`
--

CREATE TABLE `tbcatalogoejercicio` (
  `tbcatalogoejercicioid` int(11) NOT NULL,
  `tbcatalogoejercicionombre` varchar(50) NOT NULL,
  `tbcatalogoejerciciodescripcion` varchar(300) NOT NULL,
  `tbcatalogoejercicioactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcatalogoejercicio`
--

INSERT INTO `tbcatalogoejercicio` (`tbcatalogoejercicioid`, `tbcatalogoejercicionombre`, `tbcatalogoejerciciodescripcion`, `tbcatalogoejercicioactivo`) VALUES
(1, 'press militar', 'repeticiones: 4 x 12 ', 0),
(2, 'banca scott', 'repeticiones: 4 x 12 ', 1),
(3, 'prensa', 'repeticiones: 4 x 12 ', 0),
(4, 'prensa', 'repeticiones: 4 x 12 ', 1),
(5, 'prensad', 'dfff', 0),
(6, 'banca declinada', 'repeticiones: 4 x 12 ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogogrupomuscular`
--

CREATE TABLE `tbcatalogogrupomuscular` (
  `tbcatalogogrupomuscularid` int(11) NOT NULL,
  `tbcatalogogrupomuscularnombre` varchar(200) NOT NULL,
  `tbcatalogogrupomusculardescripcion` varchar(1000) NOT NULL,
  `tbcatalogogrupomuscularactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcatalogogrupomuscular`
--

INSERT INTO `tbcatalogogrupomuscular` (`tbcatalogogrupomuscularid`, `tbcatalogogrupomuscularnombre`, `tbcatalogogrupomusculardescripcion`, `tbcatalogogrupomuscularactivo`) VALUES
(1, 'Biceps', ' ni idea que es 1', 1),
(2, 'hombros', 'fefr', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogopagometodo`
--

CREATE TABLE `tbcatalogopagometodo` (
  `tbcatalogopagometodoid` int(11) NOT NULL,
  `tbcatalogopagometodonombre` varchar(50) NOT NULL,
  `tbcatalogopagometododescripcion` varchar(100) NOT NULL,
  `tbcatalogopagometodoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcatalogopagometodo`
--

INSERT INTO `tbcatalogopagometodo` (`tbcatalogopagometodoid`, `tbcatalogopagometodonombre`, `tbcatalogopagometododescripcion`, `tbcatalogopagometodoactivo`) VALUES
(1, 'Contado', 'Pagos que se realizan antes de la fecha de pago', 1),
(2, 'Transferencia', 'Pagos mediante transferencia', 1),
(3, 'SinpeMovil', 'Pagos por la plataforma SINPE Movil', 1),
(4, 'con', 'hh', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogopagoperidiocidad`
--

CREATE TABLE `tbcatalogopagoperidiocidad` (
  `tbcatalogopagoperidiocidadid` int(11) NOT NULL,
  `tbcatalogopagoperidiocidadnombre` varchar(50) NOT NULL,
  `tbcatalogopagoperidiocidaddescripcion` varchar(100) NOT NULL,
  `tbcatalogopagoperidiocidadactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcatalogopagoperidiocidad`
--

INSERT INTO `tbcatalogopagoperidiocidad` (`tbcatalogopagoperidiocidadid`, `tbcatalogopagoperidiocidadnombre`, `tbcatalogopagoperidiocidaddescripcion`, `tbcatalogopagoperidiocidadactivo`) VALUES
(1, 'Diario', 'Pagos diarios', 1),
(2, 'Semanal', 'Pagos semanales', 1),
(3, 'Mensual', 'Pagos mensuales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogorutinanivel`
--

CREATE TABLE `tbcatalogorutinanivel` (
  `tbcatalogorutinanivelid` int(11) NOT NULL,
  `tbcatalogorutinanivelnombre` varchar(50) NOT NULL,
  `tbcatalogorutinaniveldescripcion` varchar(200) NOT NULL,
  `tbcatalogorutinanivelactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tbclientepeso` float NOT NULL,
  `tbclientealtura` float NOT NULL,
  `tbclientecorreo` varchar(50) NOT NULL,
  `tbclienteactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbcliente`
--

INSERT INTO `tbcliente` (`tbclienteid`, `tbclientenombre`, `tbclienteapellido1`, `tbclienteapellido2`, `tbclientetelefono`, `tbclientefechanacimiento`, `tbclientegenero`, `tbclientepeso`, `tbclientealtura`, `tbclientecorreo`, `tbclienteactivo`) VALUES
(1, 'Juan', 'Jiménez', 'Mora', '99999999', '2003-02-14', 'Masculino', 88, 1.7, 'juannmora7@gmail.com', 1),
(2, 'Mario', 'Lopez', 'Juarez', '88760901', '2015-02-19', 'Masculino', 68, 1.82, ' juare333@gmail.com', 1),
(3, 'Sergio', 'Andrade', 'Villalobos', '87878787', '2022-09-07', 'Masculino', 77, 1.9, 'sergio@gmail.com', 1),
(4, 'Jafet David', 'González', 'García', '84585370', '2022-10-28', 'Masculino', 58.6, 1.63, 'jafet.jdgg@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientepeso`
--

CREATE TABLE `tbclientepeso` (
  `tbclientepesoid` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbclientepesofecha` date NOT NULL,
  `tbclientepesopeso` float NOT NULL,
  `tbclientepesoinstructorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientepeso`
--

INSERT INTO `tbclientepeso` (`tbclientepesoid`, `tbclienteid`, `tbclientepesofecha`, `tbclientepesopeso`, `tbclientepesoinstructorid`) VALUES
(1, 1, '2022-10-10', 55, 2),
(2, 2, '2022-10-01', 90, 1),
(3, 1, '2022-10-27', 56, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfactura`
--

CREATE TABLE `tbfactura` (
  `tbfacturaid` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbinstructorid` int(11) NOT NULL,
  `tbfacturafechapago` date NOT NULL,
  `tbcatalogopagoperidiocidadid` varchar(200) NOT NULL,
  `tbservicioid` varchar(200) NOT NULL,
  `tbfacturamontobruto` float NOT NULL,
  `tbimpuestoventaid` int(11) NOT NULL,
  `tbfacturamontoneto` float NOT NULL,
  `tbfacturaactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbclienteid`, `tbinstructorid`, `tbfacturafechapago`, `tbcatalogopagoperidiocidadid`, `tbservicioid`, `tbfacturamontobruto`, `tbimpuestoventaid`, `tbfacturamontoneto`, `tbfacturaactivo`) VALUES
(1, 1, 1, '2022-10-01', '1', '1;2', 6500, 1, 7345, 1),
(2, 3, 2, '2022-10-20', '2', '1;2', 5800, 2, 6380, 1),
(3, 2, 3, '2022-10-21', '3', '2;3', 6800, 1, 7718, 1),
(4, 1, 1, '2022-10-21', '1', '3', 3600, 2, 3960, 1),
(5, 4, 1, '2022-10-28', '2', '1', 2600, 1, 2951, 1),
(6, 3, 1, '2022-10-12', '1', '2;4', 5600, 3, 6048, 1),
(7, 3, 2, '2022-10-27', '2', '2', 2600, 1, 2951, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimpuestoventa`
--

CREATE TABLE `tbimpuestoventa` (
  `tbimpuestoventaid` tinyint(11) NOT NULL,
  `tbimpuestoventavalor` float NOT NULL,
  `tbimpuestoventadescripcion` varchar(100) NOT NULL,
  `tbimpuestoventaactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbimpuestoventa`
--

INSERT INTO `tbimpuestoventa` (`tbimpuestoventaid`, `tbimpuestoventavalor`, `tbimpuestoventadescripcion`, `tbimpuestoventaactivo`) VALUES
(1, 13.5, 'I.V.A', 1),
(2, 10, 'Pago atrasado', 1),
(3, 8, 'Sobrecargo', 1);

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
(1, 'Arturo', 'Elizondo', 'arturo1998@gmail.com', 87234090, 'CR123456789', 'Entrenador personal', 1),
(2, 'Cristian', 'Brenes', 'cristianbr@gmail.com', 87687678, 'BN123456789', 'Fisioterapeuta', 1),
(3, 'Cindy', 'Fernández', 'cindylf@gmail.com', 87234093, 'CR123456789', 'Nutricionista', 1),
(4, 'María', 'Cordero', 'maria@gmail.com', 45677332, 'CR222323333', 'Fisioterapeuta', 1),
(5, 'Isaí', 'Ríos', 'isairios@gmail.com', 65123123, 'CR987659999', 'Nutricionista', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmedidaisometrica`
--

CREATE TABLE `tbmedidaisometrica` (
  `tbmedidaisometricaid` int(11) NOT NULL,
  `tbgrupomuscularid` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbmedidaisometricafechamedicion` date NOT NULL,
  `tbmedidaisometricamedida` int(11) NOT NULL,
  `tbmedidaisometricaactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmodalidadfuncional`
--

CREATE TABLE `tbmodalidadfuncional` (
  `tbmodalidadfuncionalid` int(11) NOT NULL,
  `tbmodalidadfuncionalnombre` varchar(50) NOT NULL,
  `tbmodalidadfuncionaldescripcion` varchar(100) NOT NULL,
  `tbmodalidadfuncionalactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbmodalidadfuncional`
--

INSERT INTO `tbmodalidadfuncional` (`tbmodalidadfuncionalid`, `tbmodalidadfuncionalnombre`, `tbmodalidadfuncionaldescripcion`, `tbmodalidadfuncionalactivo`) VALUES
(1, 'Cardio', 'Perdida de peso', 1),
(2, 'Hipertrofia', 'Ganancia muscular', 1),
(3, 'Resistencia', 'Mejora cardiovascular', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmodalidadfuncionalcriterio`
--

CREATE TABLE `tbmodalidadfuncionalcriterio` (
  `tbmodalidadfuncionalcriterioid` int(11) NOT NULL,
  `tbmodalidadfuncionalid` int(11) NOT NULL,
  `tbmodalidadfuncionalcriterionombre` varchar(50) NOT NULL,
  `tbmodalidadfuncionalcriteriodescripcion` varchar(1000) NOT NULL,
  `tbmodalidadfuncionalcriteriorangomaximo` int(11) NOT NULL,
  `tbmodalidadfuncionalcriteriorangominimo` int(11) NOT NULL,
  `tbmodalidadfuncionalcriterioactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbmodalidadfuncionalcriterio`
--

INSERT INTO `tbmodalidadfuncionalcriterio` (`tbmodalidadfuncionalcriterioid`, `tbmodalidadfuncionalid`, `tbmodalidadfuncionalcriterionombre`, `tbmodalidadfuncionalcriteriodescripcion`, `tbmodalidadfuncionalcriteriorangomaximo`, `tbmodalidadfuncionalcriteriorangominimo`, `tbmodalidadfuncionalcriterioactivo`) VALUES
(1, 3, 'Resistencia tiempo', 'Mantener su esfuerzo de manera eficaz durante el mayor tiempo posible', 45, 15, 1),
(2, 1, 'Fuerza del corazón', 'Cantidad de pulsaciones por minuto', 50, 10, 1),
(3, 2, 'RM', 'Máximo de repeticiones ejecutadas por ejercicio', 30, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicio`
--

CREATE TABLE `tbservicio` (
  `tbservicioid` int(11) NOT NULL,
  `tbservicionombre` varchar(50) NOT NULL,
  `tbserviciodescripcion` varchar(100) NOT NULL,
  `tbservicioactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbservicio`
--

INSERT INTO `tbservicio` (`tbservicioid`, `tbservicionombre`, `tbserviciodescripcion`, `tbservicioactivo`) VALUES
(1, 'Spinning', 'Cardio haciendo spinning', 1),
(2, 'Zumba', 'Cardio haciendo zumba', 1),
(3, 'Yoga', 'Meditación mediante el yoga', 1),
(4, 'aeróbicos', 'aeróbicos ', 1),
(5, 'ewfew', 'wgerg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbserviciotarifa`
--

CREATE TABLE `tbserviciotarifa` (
  `tbserviciotarifaid` int(11) NOT NULL,
  `tbservicioid` int(11) NOT NULL,
  `tbserviciotarifafechamodificacion` date NOT NULL,
  `tbserviciotarifamonto` float NOT NULL,
  `tbserviciotarifaactivo` tinyint(4) NOT NULL,
  `tbserviciotarifaperiodicidadactualizacion` int(11) DEFAULT NULL,
  `tbserviciotarifaproximafechaactualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbserviciotarifa`
--

INSERT INTO `tbserviciotarifa` (`tbserviciotarifaid`, `tbservicioid`, `tbserviciotarifafechamodificacion`, `tbserviciotarifamonto`, `tbserviciotarifaactivo`, `tbserviciotarifaperiodicidadactualizacion`, `tbserviciotarifaproximafechaactualizacion`) VALUES
(1, 1, '2022-10-25', 2500, 1, 30, '2022-10-31'),
(2, 2, '2022-11-01', 2600, 1, 60, '2022-12-31'),
(4, 3, '2022-10-25', 3200, 0, 30, '2022-10-31'),
(5, 4, '2022-11-01', 3000, 0, 30, '2022-12-31'),
(6, 4, '2022-10-31', 30000, 1, 30, '2022-12-01'),
(7, 4, '2022-10-31', 30000, 0, 60, '2022-12-31'),
(8, 3, '2022-10-31', 3200, 1, 60, '2022-12-30'),
(9, 4, '2022-10-31', 30000, 1, 90, '2022-11-01'),
(10, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(11, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(12, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(13, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(14, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(15, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(16, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(17, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(18, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(19, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(20, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(21, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(22, 5, '2022-10-31', 45654, 0, 60, '2022-11-01'),
(23, 5, '2022-10-31', 456543, 0, 60, '2022-12-31'),
(24, 5, '2022-10-31', 45654, 1, 60, '2022-12-31');

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
-- Indices de la tabla `tbcatalogoclientetipo`
--
ALTER TABLE `tbcatalogoclientetipo`
  ADD PRIMARY KEY (`tbcatalogoclientetipoid`);

--
-- Indices de la tabla `tbcatalogoejercicio`
--
ALTER TABLE `tbcatalogoejercicio`
  ADD PRIMARY KEY (`tbcatalogoejercicioid`);

--
-- Indices de la tabla `tbcatalogogrupomuscular`
--
ALTER TABLE `tbcatalogogrupomuscular`
  ADD PRIMARY KEY (`tbcatalogogrupomuscularid`);

--
-- Indices de la tabla `tbcatalogopagometodo`
--
ALTER TABLE `tbcatalogopagometodo`
  ADD PRIMARY KEY (`tbcatalogopagometodoid`);

--
-- Indices de la tabla `tbcatalogopagoperidiocidad`
--
ALTER TABLE `tbcatalogopagoperidiocidad`
  ADD PRIMARY KEY (`tbcatalogopagoperidiocidadid`);

--
-- Indices de la tabla `tbcatalogorutinanivel`
--
ALTER TABLE `tbcatalogorutinanivel`
  ADD PRIMARY KEY (`tbcatalogorutinanivelid`);

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
-- Indices de la tabla `tbfactura`
--
ALTER TABLE `tbfactura`
  ADD PRIMARY KEY (`tbfacturaid`);

--
-- Indices de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`tbimpuestoventaid`);

--
-- Indices de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  ADD PRIMARY KEY (`tbinstructorid`);

--
-- Indices de la tabla `tbmodalidadfuncional`
--
ALTER TABLE `tbmodalidadfuncional`
  ADD PRIMARY KEY (`tbmodalidadfuncionalid`);

--
-- Indices de la tabla `tbmodalidadfuncionalcriterio`
--
ALTER TABLE `tbmodalidadfuncionalcriterio`
  ADD PRIMARY KEY (`tbmodalidadfuncionalcriterioid`);

--
-- Indices de la tabla `tbservicio`
--
ALTER TABLE `tbservicio`
  ADD PRIMARY KEY (`tbservicioid`);

--
-- Indices de la tabla `tbserviciotarifa`
--
ALTER TABLE `tbserviciotarifa`
  ADD PRIMARY KEY (`tbserviciotarifaid`);

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
-- AUTO_INCREMENT de la tabla `tbcatalogoejercicio`
--
ALTER TABLE `tbcatalogoejercicio`
  MODIFY `tbcatalogoejercicioid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbcatalogopagometodo`
--
ALTER TABLE `tbcatalogopagometodo`
  MODIFY `tbcatalogopagometodoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  MODIFY `tbimpuestoventaid` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  MODIFY `tbinstructorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbmodalidadfuncional`
--
ALTER TABLE `tbmodalidadfuncional`
  MODIFY `tbmodalidadfuncionalid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
