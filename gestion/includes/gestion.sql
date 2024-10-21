-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-10-2024 a las 18:58:51
-- Versión del servidor: 8.4.2
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_registro`
--

DROP TABLE IF EXISTS `cuentas_registro`;
CREATE TABLE IF NOT EXISTS `cuentas_registro` (
  `cr_id` int NOT NULL AUTO_INCREMENT,
  `cr_nombre` varchar(25) NOT NULL,
  `cr_apellidos` varchar(100) NOT NULL,
  `cr_mail` varchar(150) NOT NULL,
  `cr_usuario` varchar(50) NOT NULL,
  `cr_password` varchar(100) NOT NULL,
  PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cuentas_registro`
--

INSERT INTO `cuentas_registro` (`cr_id`, `cr_nombre`, `cr_apellidos`, `cr_mail`, `cr_usuario`, `cr_password`) VALUES
(1, 'Santiago', 'López Bazarra', 'santiago.bazarra@udc.es', 'santiago', '123'),
(2, 'Santiago', 'López Bazarra', 'santiagolopbaz@gmail.com', 'santiago1', '$2y$10$9JaCmjA.KFz5DT.pU22BKu8AYxy9Uyz9KylJ.B4GQoGCp6wZyFJVW');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
