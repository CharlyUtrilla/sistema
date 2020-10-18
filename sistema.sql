-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2020 a las 17:53:35
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `marca_modelo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `empleado` int(11) NOT NULL,
  `matricula` char(7) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `ultima_revision` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`id`, `marca_modelo`, `poblacion`, `empleado`, `matricula`, `estado`, `fecha_compra`, `ultima_revision`) VALUES
(1, 'Ford Transit Custom', 'Zaragoza', 2, '1234BCD', 'activo', '2020-07-27', '2020-07-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'LÃ­quidos'),
(1, 'Repuestos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `activo` enum('si','no') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `nombre`, `direccion`, `poblacion`, `estado`, `telefono`, `descripcion`, `fecha_inicio`, `activo`) VALUES
(2, 'Pepe Perez', 'Calle MarÃ­a 1', 'Zaragoza', 'EspaÃ±a', '666666666', 'Primer cliente', '2002-02-02', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `foto` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `lugar_nacimiento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `domicilio` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` int(5) NOT NULL,
  `ciudad` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `region` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `carnet_conducir` enum('si','no') COLLATE utf8_spanish_ci NOT NULL,
  `titulacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `puesto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `inicio_contrato` date NOT NULL,
  `fin_contrato` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `foto`, `nombre`, `apellidos`, `dni`, `lugar_nacimiento`, `fecha_nacimiento`, `domicilio`, `codigo_postal`, `ciudad`, `region`, `carnet_conducir`, `titulacion`, `puesto`, `inicio_contrato`, `fin_contrato`) VALUES
(1, 2, 'Carlos', 'Utrilla', '12345678A', 'Zaragoza', '1977-04-21', 'Pº Rosales 16', 50008, 'Zaragoza', 'Zaragoza', 'no', 'Auxiliar Administrativo', 'Administración', '2020-08-08', '0000-00-00'),
(2, 2, 'pepe', 'perez', '87654321Z', 'Zaragoza', '1999-12-31', 'C/ BoterÃ³n', 50001, 'Zaragoza', 'AragÃ³n', 'si', 'Oficial de carretillas', 'Carretillero', '2020-01-01', '9999-12-31'),
(6, 0, 'Alberto', 'Tierno', '12121212k', 'Zaragoza', '1999-01-01', 'C/ BoterÃ³n', 50008, 'Zaragoza', 'Zaragoza', 'no', 'Oficial de carretillas', 'Carretillero', '2019-12-31', '2099-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(4) NOT NULL,
  `fecha_compra` date NOT NULL,
  `precio_compra` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id`, `nombre`, `descripcion`, `cantidad`, `fecha_compra`, `precio_compra`) VALUES
(2, 'MÃ¡quina de envasado al vacÃ­o', 'Envasadora Mackinley 40023A 8l', 1, '2020-02-20', '123.45'),
(3, 'Cortadora', 'Modelo L400', 2, '2020-08-12', '59.99'),
(4, 'Caja registradora', 'Fort500', 1, '2001-01-01', '49.90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, 'filter.jpg', 'image/jpeg'),
(2, 'carita.jpg', 'image/jpeg'),
(3, 'liquid.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `id_supplier`) VALUES
(1, 'Filtro de gasolina', '101', '5.00', '10.00', 1, 1, '2017-06-16 07:03:16', 1),
(2, 'Garrafa de 5 litros de agua carbonatada', '50', '3.50', '7.00', 2, 3, '2020-08-11 20:09:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `total` decimal(5,2) NOT NULL,
  `date` date NOT NULL,
  `supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `qty`, `price`, `total`, `date`, `supplier`) VALUES
(1, 1, 1, '5.00', '5.00', '2020-07-25', 1),
(2, 2, 1, '3.50', '3.50', '2020-08-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `empleado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `horas_base` int(3) NOT NULL,
  `horas_extra` int(3) NOT NULL,
  `pago_base` decimal(6,2) NOT NULL,
  `pago_extra` decimal(6,2) NOT NULL,
  `total_horas` int(3) NOT NULL,
  `total_pago` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salary`
--

INSERT INTO `salary` (`id`, `empleado`, `fecha`, `horas_base`, `horas_extra`, `pago_base`, `pago_extra`, `total_horas`, `total_pago`) VALUES
(1, 'Utrilla,Carlos', '2020-08-14', 8, 2, '600.00', '200.00', 10, '800.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `total` decimal(5,2) NOT NULL,
  `date` date NOT NULL,
  `client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `total`, `date`, `client`) VALUES
(1, 1, 1, '10.00', '10.00', '2020-07-23', 1),
(2, 2, 1, '7.00', '7.00', '2020-08-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cod_postal` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `empleado` int(11) NOT NULL,
  `metros_cuadrados` decimal(4,2) NOT NULL,
  `alquiler` enum('si','no') COLLATE utf8_spanish_ci NOT NULL,
  `adquisicion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `shops`
--

INSERT INTO `shops` (`id`, `direccion`, `cod_postal`, `poblacion`, `empleado`, `metros_cuadrados`, `alquiler`, `adquisicion`) VALUES
(1, 'PÂº Rosales', '50008', 'Zaragoza', 1, '24.35', 'no', '2012-02-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `activo` enum('si','no') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `nombre`, `direccion`, `poblacion`, `estado`, `telefono`, `descripcion`, `fecha_inicio`, `activo`) VALUES
(1, 'PlÃ¡sticos Hernando', 'C/ Alvarez 2', 'Zaragoza', 'EspaÃ±a', '976123456', 'PlÃ¡sticos y envases sencillos', '2001-01-01', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Administrador', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '50b8fzt1.jpg', 1, '0000-00-00 00:00:00'),
(2, 'Usuario Especial', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'wuqrvc6z2.jpg', 1, '2020-07-28 17:00:38'),
(3, 'Usuario Normal', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, '1tvxj5493.jpg', 1, '2020-07-26 16:52:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Special', 2, 1),
(3, 'User', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto` (`foto`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indices de la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier` (`supplier`) USING BTREE;

--
-- Indices de la tabla `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `client` (`client`);

--
-- Indices de la tabla `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado` (`empleado`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
