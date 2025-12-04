-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2025 a las 05:18:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `descubrevictoriadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id`, `Nombre`) VALUES
(1, 'Gastronomía 🌮'),
(2, 'Entretenimiento 🎡'),
(3, 'Servicios ⛽'),
(4, 'Hospedaje 🏨'),
(5, 'Compras 🛍️');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Horario` varchar(100) DEFAULT NULL,
  `FotoUrl` varchar(500) DEFAULT NULL,
  `CategoriaId` int(11) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT 'default.jpg',
  `Facebook` varchar(500) DEFAULT NULL,
  `Instagram` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`Id`, `Nombre`, `Descripcion`, `Direccion`, `Telefono`, `Horario`, `FotoUrl`, `CategoriaId`, `FechaRegistro`, `foto`, `Facebook`, `Instagram`) VALUES
(4, 'Ginas Cup & Cake', 'Postres, almuerzos, comidas y más!', 'Calle Francisco I. Madero 349, Zona Centro, 87000 Cdad. Victoria, Tamps.', '8345647485', NULL, NULL, 1, '2025-12-03 20:18:29', '1764814709_ginas.png', 'https://www.facebook.com/ginascupandcake/?locale=es_LA', 'https://www.instagram.com/ginascupandcake/?hl=es'),
(6, 'Don Fito Tec', 'Flautas y Gorditas con el mejor sazón', 'Blvd. Emilio Portes Gil MZ3 LT4, Tecnológico, 87037 Cdad. Victoria, Tamps.', '+528116216086', NULL, NULL, 1, '2025-12-03 21:45:19', '1764819919_donfito.png', 'https://www.facebook.com/p/Don-Fito-100064800333745/?locale=es_LA', 'https://www.instagram.com/donfito__/?hl=es'),
(7, 'Cinépolis Sucursal Adelitas', 'La capital del cine', 'C. Coahuila 218, Fidel Velázquez Sánchez, 87049 Cdad. Victoria, Tamps.', '+525521226060', NULL, NULL, 2, '2025-12-03 21:48:37', '1764820117_cinepolis.jpg', 'https://www.facebook.com/p/Cin%C3%A9polis-Adelitas-Paseo-Aventa-61553781497117/', ''),
(8, 'Sora', 'El mejor sushi y bar', 'Zacatecas, Valle de Aguayo, 87020 Cdad. Victoria, Tamps.', '+528343169720', NULL, NULL, 1, '2025-12-03 21:50:29', '1764820229_sora.png', 'https://www.facebook.com/SoraSushi.Victoria/?locale=es_LA', 'https://www.instagram.com/sora.victoria/'),
(9, 'Museo de Historia Natural de Tamaulipas TAMUX', 'Tiene como objetivo primordial el ser un centro de divulgación científica y tecnológica, bajo el formato de “museo interactivo\"', 'Blvd. Fidel Velazquez s/n, Horacio Terán, 87130 Cdad. Victoria, Tamps.', '+528341549259', NULL, NULL, 2, '2025-12-03 21:52:37', '1764820357_tamux.jpeg', 'https://www.facebook.com/MuseoDeHistoriaNaturalDeTamaulipasTaMux/?locale=es_LA', 'https://www.instagram.com/museotamux/?hl=es'),
(10, 'Hotel Santander Inn & Suites', 'Hospédate en este hotel en Ciudad Victoria. Tendrás a tu disposición wifi gratis, estacionamiento gratis y servicio de recepción las 24 horas', 'Blvd. Emilio Portes Gil 1050, Nuevo Santander, 87030 Cdad. Victoria, Tamps.', '+528341710222', NULL, NULL, 4, '2025-12-03 21:55:57', '1764820557_hotel.png', 'https://www.facebook.com/p/Hotel-Nuevo-Santander-100075687865247/?locale=es_LA', ''),
(11, 'Paseo Aventa', ' Centro comercial diseñado y creado para las familias', 'Jesús Elías Piña 525, Las Adelitas, 87049 Cdad. Victoria, Tamps.', '+528346881233', NULL, NULL, 5, '2025-12-03 21:58:53', '1764820733_aventa.png', 'https://www.facebook.com/PaseoAventa/?locale=es_LA', 'https://www.instagram.com/paseoaventa/?hl=es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosadmin`
--

CREATE TABLE `usuariosadmin` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariosadmin`
--

INSERT INTO `usuariosadmin` (`Id`, `Usuario`, `PasswordHash`) VALUES
(1, 'admin', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuariosadmin`
--
ALTER TABLE `usuariosadmin`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuariosadmin`
--
ALTER TABLE `usuariosadmin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
