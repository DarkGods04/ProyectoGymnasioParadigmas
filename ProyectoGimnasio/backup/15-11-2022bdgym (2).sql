-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 08:58:34
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
-- Base de datos: `bdgym`
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
(3, 'P067', '345TEKT987', 'TEKTRO', '2022-09-01', 25150, 'En uso', 1),
(4, 'P066', '83421ULT28', 'ULTIMATE', '2022-11-08', 150000, 'En uso', 0);

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
(2, 'Cuerda', 10, 25000, 'Cuerda de 20 mtrs', 1),
(3, 'Pesa', 24, 175000, 'Pesa de 20 kilos', 1),
(4, 'Ligas rojas', 10, 20000, 'Ligas de gran resistencia', 1);

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

--
-- Volcado de datos para la tabla `tbcatalogoclientetipo`
--

INSERT INTO `tbcatalogoclientetipo` (`tbcatalogoclientetipoid`, `tbcatalogoclientetiponombre`, `tbcatalogoclientetipodescripcion`, `tbcatalogoclientetipoactivo`) VALUES
(1, 'Plata', 'Menos de 3 meses', 1),
(2, 'Oro', 'Más de 3 meses', 1),
(3, 'Platino', 'Más de 6 meses ', 1),
(4, 'Diamante', 'Más de 1 año', 1);

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
(1, 'Press de banca', 'repeticiones: 4 x 12 ', 1),
(2, 'Press militar', 'repeticiones: 4 x 12 ', 1),
(3, 'Sentadilla búlgara', 'repeticiones: 4 x 12 ', 1),
(4, 'Sentadilla goblet', 'repeticiones: 4x10', 1),
(5, 'Abdominales', 'repeticiones: 4x20', 1),
(6, 'Lagartijas', 'repeticiones: 4x12', 1);

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
(1, 'Biceps', 'Biceps del brazo', 1),
(2, 'Hombros', 'Parte superior del brazo', 1),
(3, 'Oblicuos', 'Músculos que cubren el abdomen', 1),
(4, 'Cuadriceps', 'Musculo frontal de la pierna alta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcatalogolineaproductos`
--

CREATE TABLE `tbcatalogolineaproductos` (
  `tbcatalogolineaproductosid` int(11) NOT NULL,
  `tbcatalogolineaproductosnombre` varchar(50) NOT NULL,
  `tbcatalogolineaproductosdescripcion` varchar(100) NOT NULL,
  `tbcatalogolineaproductosactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcatalogolineaproductos`
--

INSERT INTO `tbcatalogolineaproductos` (`tbcatalogolineaproductosid`, `tbcatalogolineaproductosnombre`, `tbcatalogolineaproductosdescripcion`, `tbcatalogolineaproductosactivo`) VALUES
(1, 'Cosméticos', 'Productos de belleza', 1),
(2, 'Detergentes', 'Para lavar ropa', 1),
(3, 'Abarrotes', 'Productos alimenticios', 1),
(4, 'Proteínas', 'Suplemento proteínico', 1);

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
(3, 'SinpeMovil', 'Pagos por la plataforma SINPE Movil', 1);

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

--
-- Volcado de datos para la tabla `tbcatalogorutinanivel`
--

INSERT INTO `tbcatalogorutinanivel` (`tbcatalogorutinanivelid`, `tbcatalogorutinanivelnombre`, `tbcatalogorutinaniveldescripcion`, `tbcatalogorutinanivelactivo`) VALUES
(1, 'Bajo', 'Para principiantes', 1),
(2, 'Medio', 'Ejercicios regulares', 1),
(3, 'Moderada', 'Ejercicios intermedios', 1),
(4, 'Alto', 'Ejercicios avanzados', 1),
(5, 'Militar', 'Nivel súper avanzado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcategorizacioncliente`
--

CREATE TABLE `tbcategorizacioncliente` (
  `tbcategorizacionclienteid` int(11) NOT NULL,
  `tbclienteid` int(11) NOT NULL,
  `tbcatalogoclientetipoid` int(11) NOT NULL,
  `tbcategorizacionclienteactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcategorizacioncliente`
--

INSERT INTO `tbcategorizacioncliente` (`tbcategorizacionclienteid`, `tbclienteid`, `tbcatalogoclientetipoid`, `tbcategorizacionclienteactivo`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 0);

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
(1, 'Yahir', 'Umaña', 'Arroyo', '87868584', '2000-01-12', 'Masculino', 78.5, 1.75, 'yahiru@gmail.com', 1),
(2, 'Jafet', 'González', 'García', '89888822', '2001-02-12', 'Masculino', 68.6, 1.7, 'jffgg@gmail.com', 1),
(3, 'Jimmy', 'Fonseca', 'Alvarado', '68717860', '1994-03-12', 'Masculino', 70, 1.72, 'jimmyfa@gmail.com', 1),
(4, 'María', 'Jiménez', 'Sánchez', '86456798', '2002-04-12', 'Femenino', 62, 1.62, 'mariajs@gmail.com', 1);

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
(1, 1, '2022-11-01', 76, 1),
(2, 2, '2022-11-01', 69.5, 2),
(3, 3, '2022-11-02', 71, 3),
(4, 4, '2022-11-03', 63, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcompra`
--

CREATE TABLE `tbcompra` (
  `tbcompraid` int(11) NOT NULL,
  `tbcomprafecha` date NOT NULL,
  `tbproveedorid` int(11) NOT NULL,
  `tbcompramontoneto` int(11) NOT NULL,
  `tbcompramodopago` tinyint(4) NOT NULL,
  `tbcompraactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcompra`
--

INSERT INTO `tbcompra` (`tbcompraid`, `tbcomprafecha`, `tbproveedorid`, `tbcompramontoneto`, `tbcompramodopago`, `tbcompraactivo`) VALUES
(1, '2022-11-02', 2, 30000, 0, 0),
(2, '2022-11-09', 3, 7700, 1, 1),
(3, '2022-11-13', 2, 80000, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcompradetalle`
--

CREATE TABLE `tbcompradetalle` (
  `tbcompradetalleid` int(11) NOT NULL,
  `tbcompraid` int(11) NOT NULL,
  `tbproductoid` int(11) NOT NULL,
  `tbproductocantidad` int(11) NOT NULL,
  `tbproductopreciobruto` int(11) NOT NULL,
  `tbcompradetalleactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbcompradetalle`
--

INSERT INTO `tbcompradetalle` (`tbcompradetalleid`, `tbcompraid`, `tbproductoid`, `tbproductocantidad`, `tbproductopreciobruto`, `tbcompradetalleactivo`) VALUES
(1, 1, 2, 3, 10000, 0),
(2, 2, 1, 7, 1100, 1),
(3, 3, 2, 8, 10000, 1);

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
  `tbimpuestoventaid` int(11) NOT NULL,
  `tbfacturamontoneto` float NOT NULL,
  `tbfacturaactivo` tinyint(4) NOT NULL,
  `tbcatalogopagometodoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfactura`
--

INSERT INTO `tbfactura` (`tbfacturaid`, `tbclienteid`, `tbinstructorid`, `tbfacturafechapago`, `tbcatalogopagoperidiocidadid`, `tbimpuestoventaid`, `tbfacturamontoneto`, `tbfacturaactivo`, `tbcatalogopagometodoid`) VALUES
(1, 3, 3, '2022-11-04', '3', 1, 5675, 0, 1),
(2, 1, 2, '2022-11-15', '3', 2, 19690, 1, 1),
(3, 4, 4, '2022-11-03', '3', 2, 2860, 0, 1),
(4, 3, 3, '2022-11-23', '3', 1, 28375, 1, 2),
(5, 4, 4, '2022-11-17', '3', 2, 3520, 1, 2),
(6, 2, 3, '2022-11-17', '2', 1, 2951, 1, 1),
(7, 2, 2, '2022-11-25', '2', 1, 9307, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfacturadetalle`
--

CREATE TABLE `tbfacturadetalle` (
  `tbfacturadetalleid` int(11) NOT NULL,
  `tbfacturaid` int(11) NOT NULL,
  `tbservicioid` int(11) NOT NULL,
  `tbfacturadetallemontobruto` float NOT NULL,
  `tbfacturadetalleactivo` tinyint(4) NOT NULL,
  `tbserviciocantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbfacturadetalle`
--

INSERT INTO `tbfacturadetalle` (`tbfacturadetalleid`, `tbfacturaid`, `tbservicioid`, `tbfacturadetallemontobruto`, `tbfacturadetalleactivo`, `tbserviciocantidad`) VALUES
(1, 1, 1, 5000, 0, 2),
(2, 2, 1, 2500, 1, 1),
(3, 2, 2, 2600, 1, 1),
(4, 2, 3, 12800, 1, 4),
(5, 3, 2, 2600, 0, 1),
(6, 4, 1, 2500, 1, 1),
(7, 5, 3, 3200, 1, 1),
(8, 6, 1, 2600, 1, 1),
(9, 7, 1, 5200, 1, 2),
(10, 7, 4, 3000, 1, 1);

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
(4, 'María', 'Cordero', 'maria@gmail.com', 45677332, 'CR222323333', 'Fisioterapeuta', 1);

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

--
-- Volcado de datos para la tabla `tbmedidaisometrica`
--

INSERT INTO `tbmedidaisometrica` (`tbmedidaisometricaid`, `tbgrupomuscularid`, `tbclienteid`, `tbmedidaisometricafechamedicion`, `tbmedidaisometricamedida`, `tbmedidaisometricaactivo`) VALUES
(1, 1, 1, '2022-11-01', 20, 1),
(2, 2, 1, '2022-11-01', 24, 1),
(3, 4, 1, '2022-11-01', 38, 1),
(4, 1, 3, '2022-11-02', 22, 1),
(5, 4, 3, '2022-11-02', 40, 1),
(6, 1, 4, '2022-11-02', 16, 1),
(7, 4, 4, '2022-11-02', 36, 1);

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
-- Estructura de tabla para la tabla `tbproducto`
--

CREATE TABLE `tbproducto` (
  `tbproductoid` int(11) NOT NULL,
  `tbproductonombre` varchar(50) NOT NULL,
  `tbproductodescripcion` varchar(200) NOT NULL,
  `tbproductopreciocompra` double NOT NULL,
  `tbproductoprecioventa` double NOT NULL,
  `tbproductocantidad` int(11) NOT NULL,
  `tbproductoactivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbproducto`
--

INSERT INTO `tbproducto` (`tbproductoid`, `tbproductonombre`, `tbproductodescripcion`, `tbproductopreciocompra`, `tbproductoprecioventa`, `tbproductocantidad`, `tbproductoactivo`) VALUES
(1, 'Bebida energetica Volt', 'Bebida energetica Volt perfecta para personas sinenergia', 1100, 1200, 5, 1),
(2, 'Suplementos', 'suplementos con carboidartos necesarios para subir de peso rapidamente', 10000, 13300, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedor`
--

CREATE TABLE `tbproveedor` (
  `tbproveedorid` int(11) NOT NULL,
  `tbproveedornombrecompleto` varchar(50) NOT NULL,
  `tbproveedorcasacomercial` varchar(50) NOT NULL,
  `tbcatalogolineaproductosid` int(11) NOT NULL,
  `tbproveedoractivo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbproveedor`
--

INSERT INTO `tbproveedor` (`tbproveedorid`, `tbproveedornombrecompleto`, `tbproveedorcasacomercial`, `tbcatalogolineaproductosid`, `tbproveedoractivo`) VALUES
(1, 'Allan Quesada', 'Mini súper QM', 3, 1),
(2, 'Guillermo López', 'Pañalera López', 2, 1),
(3, 'Bryan Quesada', 'Isolate proteínas', 4, 1);

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
(4, 'Aeróbicos', 'Ejercicios aeróbicos', 1),
(5, 'ewfew', 'wgerg', 0);

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
(1, 1, '2022-10-25', 2500, 0, 30, '2022-10-31'),
(2, 2, '2022-11-01', 2600, 0, 60, '2022-12-31'),
(4, 3, '2022-10-25', 3200, 1, 30, '2022-10-31'),
(5, 4, '2022-11-01', 3000, 1, 30, '2022-12-31'),
(6, 2, '2022-11-12', 2800, 1, 60, '2023-01-12'),
(7, 1, '2022-11-12', 2600, 1, 30, '2022-12-13');

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
-- Indices de la tabla `tbcatalogolineaproductos`
--
ALTER TABLE `tbcatalogolineaproductos`
  ADD PRIMARY KEY (`tbcatalogolineaproductosid`);

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
-- Indices de la tabla `tbcategorizacioncliente`
--
ALTER TABLE `tbcategorizacioncliente`
  ADD PRIMARY KEY (`tbcategorizacionclienteid`);

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
-- Indices de la tabla `tbcompra`
--
ALTER TABLE `tbcompra`
  ADD PRIMARY KEY (`tbcompraid`);

--
-- Indices de la tabla `tbcompradetalle`
--
ALTER TABLE `tbcompradetalle`
  ADD PRIMARY KEY (`tbcompradetalleid`);

--
-- Indices de la tabla `tbfactura`
--
ALTER TABLE `tbfactura`
  ADD PRIMARY KEY (`tbfacturaid`);

--
-- Indices de la tabla `tbfacturadetalle`
--
ALTER TABLE `tbfacturadetalle`
  ADD PRIMARY KEY (`tbfacturadetalleid`);

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
-- Indices de la tabla `tbmedidaisometrica`
--
ALTER TABLE `tbmedidaisometrica`
  ADD PRIMARY KEY (`tbmedidaisometricaid`);

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
-- Indices de la tabla `tbproducto`
--
ALTER TABLE `tbproducto`
  ADD PRIMARY KEY (`tbproductoid`);

--
-- Indices de la tabla `tbproveedor`
--
ALTER TABLE `tbproveedor`
  ADD PRIMARY KEY (`tbproveedorid`);

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
