-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-11-2024 a las 17:50:28
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Hotel_p`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `estado_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tbl_pais_pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estado`
--

INSERT INTO `tbl_estado` (`estado_id`, `nombre`, `tbl_pais_pais_id`) VALUES
(1, 'Guanajuato ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_habitaciones`
--

CREATE TABLE `tbl_habitaciones` (
  `habitacion_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `extencion` char(10) DEFAULT NULL,
  `camas` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id_tipo_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_habitaciones`
--

INSERT INTO `tbl_habitaciones` (`habitacion_id`, `nombre`, `capacidad`, `extencion`, `camas`, `descripcion`, `subtotal`, `total`, `id_tipo_habitacion`) VALUES
(1, 'Junior1', 3, '123', '2', 'Muy comoda', 100, 246, 1),
(2, 'Junior2', 3, '344', '3', 'Muy espaciosa ', 100, 2000, 1),
(3, 'Junior3', 4, '222', '2', 'Muy comoda y cool', 100, 246, 1),
(5, 'Platinum1', 2, '542', '1', 'Es muy comoda y lujosa', 300, 500, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_habitacion_inventario`
--

CREATE TABLE `tbl_habitacion_inventario` (
  `habitacion_inventario_id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `estatus` tinyint(1) DEFAULT 1 COMMENT '0-inactivo\n1-activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_habitacion_inventario`
--

INSERT INTO `tbl_habitacion_inventario` (`habitacion_inventario_id`, `id_habitacion`, `id_inventario`, `estatus`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_habitacion_servicios`
--

CREATE TABLE `tbl_habitacion_servicios` (
  `habitacion_servicios_id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_servicios` int(11) NOT NULL,
  `estatus` tinyint(1) DEFAULT 1 COMMENT '0-inactivo\n1-activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_habitacion_servicios`
--

INSERT INTO `tbl_habitacion_servicios` (`habitacion_servicios_id`, `id_habitacion`, `id_servicios`, `estatus`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagenes_tipo`
--

CREATE TABLE `tbl_imagenes_tipo` (
  `imagenes_tipo_id` int(11) NOT NULL,
  `imagen` text DEFAULT NULL,
  `id_tipo_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_imagenes_tipo`
--

INSERT INTO `tbl_imagenes_tipo` (`imagenes_tipo_id`, `imagen`, `id_tipo_habitacion`) VALUES
(1, 'https://hips.hearstapps.com/hmg-prod/images/gettyimages-1299952593-64c12c1141c24.jpg?crop=1xw:0.8453434844192634xh;center,top&resize=1200:*', 1),
(2, 'Array', 1),
(3, 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.elmueble.com%2Fmedio%2F2022%2F07%2F21%2Fdormitorios-veraniegos_00673693_1280x1705.jpg&tbnid=a0wLPWLFFH4XyM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY..i&imgrefurl=https%3A%2F%2Fwww.elmueble.com%2Festancias%2Fdormitorios-veraniegos-que-inspirarte-para-poner-tu-casa-modo-verano-tienen-impresionantes-vistas-mar_43449&docid=91Z8JyxFFbCzhM&w=1280&h=1705&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY,https://www.google.com/imgres?imgurl=https%3A%2F%2Fdynamic-media-cdn.tripadvisor.com%2Fmedia%2Fphoto-o%2F1c%2Fea%2F90%2F90%2Fla-playa.jpg%3Fw%3D700%26h%3D-1%26s%3D1&tbnid=mnhNDv3u4CLLuM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0..i&imgrefurl=https%3A%2F%2Fwww.tripadvisor.co%2FHotel_Feature-g1093725-d3464205-zft1-La_Playa.html&docid=I_jZJQ2uhBRyZM&w=700&h=473&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0', 1),
(4, 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.elmueble.com%2Fmedio%2F2022%2F07%2F21%2Fdormitorios-veraniegos_00673693_1280x1705.jpg&tbnid=a0wLPWLFFH4XyM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY..i&imgrefurl=https%3A%2F%2Fwww.elmueble.com%2Festancias%2Fdormitorios-veraniegos-que-inspirarte-para-poner-tu-casa-modo-verano-tienen-impresionantes-vistas-mar_43449&docid=91Z8JyxFFbCzhM&w=1280&h=1705&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY', 1),
(5, 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fdynamic-media-cdn.tripadvisor.com%2Fmedia%2Fphoto-o%2F1c%2Fea%2F90%2F90%2Fla-playa.jpg%3Fw%3D700%26h%3D-1%26s%3D1&tbnid=mnhNDv3u4CLLuM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0..i&imgrefurl=https%3A%2F%2Fwww.tripadvisor.co%2FHotel_Feature-g1093725-d3464205-zft1-La_Playa.html&docid=I_jZJQ2uhBRyZM&w=700&h=473&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0', 1),
(6, 'https://scontent.fgdl1-4.fna.fbcdn.net/v/t39.30808-6/404658869_122156260526004244_4945951268840947815_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=5f2048&_nc_ohc=ZHqzv1i5hIoAX-TJwib&_nc_ht=scontent.fgdl1-4.fna&oh=00_AfDLCG9FlCqEaQ4pXH_LVZU4i_Q6cRnmzcwYCWIfJhJLig&oe=656A300F', 1),
(7, 'https://www.instagram.com/p/C0J2nsPgvMi/', 1),
(8, 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.elmueble.com%2Fmedio%2F2022%2F07%2F21%2Fdormitorios-veraniegos_00673693_1280x1705.jpg&tbnid=a0wLPWLFFH4XyM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY..i&imgrefurl=https%3A%2F%2Fwww.elmueble.com%2Festancias%2Fdormitorios-veraniegos-que-inspirarte-para-poner-tu-casa-modo-verano-tienen-impresionantes-vistas-mar_43449&docid=91Z8JyxFFbCzhM&w=1280&h=1705&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY,https://www.google.com/imgres?imgurl=https%3A%2F%2Fdynamic-media-cdn.tripadvisor.com%2Fmedia%2Fphoto-o%2F1c%2Fea%2F90%2F90%2Fla-playa.jpg%3Fw%3D700%26h%3D-1%26s%3D1&tbnid=mnhNDv3u4CLLuM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0..i&imgrefurl=https%3A%2F%2Fwww.tripadvisor.co%2FHotel_Feature-g1093725-d3464205-zft1-La_Playa.html&docid=I_jZJQ2uhBRyZM&w=700&h=473&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygOegQIARB0', 2),
(9, 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.elmueble.com%2Fmedio%2F2022%2F07%2F21%2Fdormitorios-veraniegos_00673693_1280x1705.jpg&tbnid=a0wLPWLFFH4XyM&vet=12ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY..i&imgrefurl=https%3A%2F%2Fwww.elmueble.com%2Festancias%2Fdormitorios-veraniegos-que-inspirarte-para-poner-tu-casa-modo-verano-tienen-impresionantes-vistas-mar_43449&docid=91Z8JyxFFbCzhM&w=1280&h=1705&q=habitaciones%20playa&ved=2ahUKEwjcjsrlmOWCAxV4wskDHZ9NDJ0QMygAegQIARBY', 2),
(10, 'https://s1.abcstatics.com/Media/201504/27/hotel12--644x362.jpg', 2),
(11, 'https://beach.palaceresorts.com/bp_rooms_Two_Bedroom_Presidential_Suite_gallgrid_a_2a4093f039.jpg', 2),
(12, 'https://s1.abcstatics.com/Media/201504/27/hotel12--644x362.jpg', 2),
(13, 'https://beach.palaceresorts.com/bp_rooms_Superior_Deluxe_Lagoon_V_gallgrid_a_ed4c133d48.jpg', 2),
(14, 'https://image-tc.galaxy.tf/wipng-ejvi3rrvxwqgo601bi0b7tlwi/como-se-clasifican-las-habitaciones-en-un-hotel-de-5-estrellas-en-lima-min_standard.png?crop=0%2C0%2C555%2C416', 2),
(15, 'http://res.cloudinary.com/ptsanmiguelense-ghost/image/upload/v1701183118/valle_mentefactura/aejkngkojzbdhiksmxoa.png', 2),
(16, 'http://res.cloudinary.com/ptsanmiguelense-ghost/image/upload/v1701183119/valle_mentefactura/lvbsneuwt5t3nukamx3n.png', 2),
(17, 'http://res.cloudinary.com/ptsanmiguelense-ghost/image/upload/v1701183119/valle_mentefactura/gfqubhj5urcdnrqgqwgl.png', 2),
(18, 'http://res.cloudinary.com/ptsanmiguelense-ghost/image/upload/v1701183121/valle_mentefactura/odcg9ipn5kegcvyf8sc1.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `inventario_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`inventario_id`, `nombre`) VALUES
(1, 'Lamparas '),
(2, 'Cortinas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipio`
--

CREATE TABLE `tbl_municipio` (
  `municipio_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tbl_estado_estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_municipio`
--

INSERT INTO `tbl_municipio` (`municipio_id`, `nombre`, `tbl_estado_estado_id`) VALUES
(1, 'San miguel de allende ', 1),
(2, 'Celaya', 1),
(3, 'Leon', 1),
(4, 'Irapuato', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pago`
--

CREATE TABLE `tbl_pago` (
  `pago_id` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `tbl_reserva_reserva_id` int(11) NOT NULL,
  `tbl_tarjeta_tarjeta_id` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL COMMENT '0-No pagado\r\n1-Pagado\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pago`
--

INSERT INTO `tbl_pago` (`pago_id`, `total`, `tbl_reserva_reserva_id`, `tbl_tarjeta_tarjeta_id`, `estatus`) VALUES
(1, 300, 2, 3, 1),
(2, 550, 2, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais`
--

CREATE TABLE `tbl_pais` (
  `pais_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `extencion` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pais`
--

INSERT INTO `tbl_pais` (`pais_id`, `nombre`, `extencion`) VALUES
(1, 'Mexico', '+52'),
(2, 'Canada', '+1'),
(4, 'Estados Unidos', '+1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_preguntas`
--

CREATE TABLE `tbl_preguntas` (
  `preguntas_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_preguntas`
--

INSERT INTO `tbl_preguntas` (`preguntas_id`, `nombre`) VALUES
(1, '¿Que tan comodo te sentiste?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_registro`
--

CREATE TABLE `tbl_registro` (
  `registro_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` char(15) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` char(15) NOT NULL,
  `acceso` tinyint(1) DEFAULT 0 COMMENT '0-administrativo\n1-publico',
  `estatus` tinyint(1) DEFAULT 1 COMMENT '0-inactivo\n1-activo\n',
  `id_pais` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_registro`
--

INSERT INTO `tbl_registro` (`registro_id`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `correo`, `telefono`, `usuario`, `password`, `acceso`, `estatus`, `id_pais`, `id_estado`, `id_municipio`) VALUES
(1, 'Lizbeth', 'Chavarria', 'Guerrero', '2023-11-01', 'lizbeth@gamil.com', '4151677898', 'liz', '12345', 0, 1, 1, 1, 1),
(2, 'Jorge Alejandro', 'Exidoro', 'Lopez', '2023-11-29', 'jorge@gamil.com', '4151677898', 'jorjis', '9876', 0, 1, 1, 1, 1),
(3, 'Jose', 'Soto', 'Perez', '2002-10-05', 'jose@gamil.com', '4151677877', 'Joss', '14680', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_registro_preguntas_respuestas`
--

CREATE TABLE `tbl_registro_preguntas_respuestas` (
  `registro_preguntas_respuestas_id` int(11) NOT NULL,
  `tbl_registro_registro_id` int(11) NOT NULL,
  `tbl_preguntas_preguntas_id` int(11) NOT NULL,
  `tbl_respuesta_respuesta_id` int(11) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_registro_preguntas_respuestas`
--

INSERT INTO `tbl_registro_preguntas_respuestas` (`registro_preguntas_respuestas_id`, `tbl_registro_registro_id`, `tbl_preguntas_preguntas_id`, `tbl_respuesta_respuesta_id`, `comentario`) VALUES
(1, 1, 1, 5, 'Es un lugar muy comodo y muy limpio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `reserva_id` int(11) NOT NULL,
  `inicio_reserva` date DEFAULT NULL,
  `fin_reserva` date DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `tbl_habitaciones_habitacion_id` int(11) NOT NULL,
  `tbl_registro_registro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`reserva_id`, `inicio_reserva`, `fin_reserva`, `subtotal`, `tbl_habitaciones_habitacion_id`, `tbl_registro_registro_id`) VALUES
(1, '2023-11-01', '2023-11-05', 100, 1, 1),
(2, '2023-10-04', '2023-10-08', 250, 2, 2),
(4, '2023-09-12', '2023-10-02', 100, 3, 2),
(6, '2023-11-10', '2023-11-15', 200, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta`
--

CREATE TABLE `tbl_respuesta` (
  `respuesta_id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_respuesta`
--

INSERT INTO `tbl_respuesta` (`respuesta_id`, `nombre`) VALUES
(1, 'Muy Mala'),
(2, 'Mala'),
(3, 'Buena'),
(4, 'Muy Buena'),
(5, 'Excelente ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios`
--

CREATE TABLE `tbl_servicios` (
  `servicios_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_servicios`
--

INSERT INTO `tbl_servicios` (`servicios_id`, `nombre`) VALUES
(1, 'Agua'),
(2, 'Luz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarjeta`
--

CREATE TABLE `tbl_tarjeta` (
  `tarjeta_id` int(11) NOT NULL,
  `numero_tarjeta` char(32) DEFAULT NULL,
  `anio` char(4) DEFAULT NULL,
  `mes` char(2) DEFAULT NULL,
  `cvv` char(5) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido_paterno` varchar(45) DEFAULT NULL,
  `apellido_materno` varchar(45) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL COMMENT '0-visa, 1-mastercad',
  `monto` double DEFAULT NULL,
  `tbl_registro_registro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tarjeta`
--

INSERT INTO `tbl_tarjeta` (`tarjeta_id`, `numero_tarjeta`, `anio`, `mes`, `cvv`, `nombre`, `apellido_paterno`, `apellido_materno`, `tipo`, `monto`, `tbl_registro_registro_id`) VALUES
(1, '4345311243', '2023', '10', '435', 'Liz', 'Chavarria', 'Guerrero', 1, 900, 1),
(2, '29876534560', '2023', '08', '243', 'Fernando', 'Chavez', 'Rico', 1, 1000, 1),
(3, '98765425523', '2024', '08', '893', 'Jorge', 'Exidoro ', 'Lopez', 1, 1500, 2),
(4, '434531124323', '2023', '10', '432', 'Carlos', 'Cadena', 'Rios', 1, 5000, 1),
(5, '29876534500', '2023', '10', '176', 'Jose', 'perez', 'ruiz', 1, 147, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_habitacion`
--

CREATE TABLE `tbl_tipo_habitacion` (
  `tipo_habitacion_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `rango_precios` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_habitacion`
--

INSERT INTO `tbl_tipo_habitacion` (`tipo_habitacion_id`, `nombre`, `descripcion`, `rango_precios`) VALUES
(1, 'Junior ', 'Es una de las habitaciones mas basicas del hotel.', '$500 a $1000'),
(2, 'Platinum ', 'Es una de las mas comodas y practicas del hotel.', '$1200 a $2000'),
(4, 'Gold ', 'Es una de las habitaciones mas lujosas y con una gran vista al mar.', '$2000 a $2500');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD PRIMARY KEY (`estado_id`),
  ADD KEY `fk_tbl_estado_tbl_pais_idx` (`tbl_pais_pais_id`);

--
-- Indices de la tabla `tbl_habitaciones`
--
ALTER TABLE `tbl_habitaciones`
  ADD PRIMARY KEY (`habitacion_id`),
  ADD KEY `fk_tbl_habitaciones_tbl_tipo_habitacion1_idx` (`id_tipo_habitacion`);

--
-- Indices de la tabla `tbl_habitacion_inventario`
--
ALTER TABLE `tbl_habitacion_inventario`
  ADD PRIMARY KEY (`habitacion_inventario_id`),
  ADD KEY `fk_tbl_habitacion_inventario_tbl_habitaciones1_idx` (`id_habitacion`),
  ADD KEY `fk_tbl_habitacion_inventario_tbl_inventario1_idx` (`id_inventario`);

--
-- Indices de la tabla `tbl_habitacion_servicios`
--
ALTER TABLE `tbl_habitacion_servicios`
  ADD PRIMARY KEY (`habitacion_servicios_id`),
  ADD KEY `fk_tbl_habitacion_servicios_tbl_habitaciones1_idx` (`id_habitacion`),
  ADD KEY `fk_tbl_habitacion_servicios_tbl_servicios1_idx` (`id_servicios`);

--
-- Indices de la tabla `tbl_imagenes_tipo`
--
ALTER TABLE `tbl_imagenes_tipo`
  ADD PRIMARY KEY (`imagenes_tipo_id`),
  ADD KEY `fk_tbl_imagenes_tipo_tbl_tipo_habitacion1_idx` (`id_tipo_habitacion`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`inventario_id`);

--
-- Indices de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD PRIMARY KEY (`municipio_id`),
  ADD KEY `fk_tbl_municipio_tbl_estado1_idx` (`tbl_estado_estado_id`);

--
-- Indices de la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `fk_tbl_pago_tbl_reserva1_idx` (`tbl_reserva_reserva_id`),
  ADD KEY `fk_tbl_pago_tbl_tarjeta1_idx` (`tbl_tarjeta_tarjeta_id`);

--
-- Indices de la tabla `tbl_pais`
--
ALTER TABLE `tbl_pais`
  ADD PRIMARY KEY (`pais_id`);

--
-- Indices de la tabla `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  ADD PRIMARY KEY (`preguntas_id`);

--
-- Indices de la tabla `tbl_registro`
--
ALTER TABLE `tbl_registro`
  ADD PRIMARY KEY (`registro_id`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  ADD KEY `fk_tbl_registro_tbl_pais1_idx` (`id_pais`),
  ADD KEY `fk_tbl_registro_tbl_estado1_idx` (`id_estado`),
  ADD KEY `fk_tbl_registro_tbl_municipio1_idx` (`id_municipio`);

--
-- Indices de la tabla `tbl_registro_preguntas_respuestas`
--
ALTER TABLE `tbl_registro_preguntas_respuestas`
  ADD PRIMARY KEY (`registro_preguntas_respuestas_id`),
  ADD KEY `fk_tbl_registro_preguntas_respuestas_tbl_registro1_idx` (`tbl_registro_registro_id`),
  ADD KEY `fk_tbl_registro_preguntas_respuestas_tbl_preguntas1_idx` (`tbl_preguntas_preguntas_id`),
  ADD KEY `fk_tbl_registro_preguntas_respuestas_tbl_respuesta1_idx` (`tbl_respuesta_respuesta_id`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`reserva_id`),
  ADD KEY `fk_tbl_reserva_tbl_habitaciones1_idx` (`tbl_habitaciones_habitacion_id`),
  ADD KEY `fk_tbl_reserva_tbl_registro1_idx` (`tbl_registro_registro_id`);

--
-- Indices de la tabla `tbl_respuesta`
--
ALTER TABLE `tbl_respuesta`
  ADD PRIMARY KEY (`respuesta_id`);

--
-- Indices de la tabla `tbl_servicios`
--
ALTER TABLE `tbl_servicios`
  ADD PRIMARY KEY (`servicios_id`);

--
-- Indices de la tabla `tbl_tarjeta`
--
ALTER TABLE `tbl_tarjeta`
  ADD PRIMARY KEY (`tarjeta_id`),
  ADD KEY `fk_tbl_tarjeta_tbl_registro1_idx` (`tbl_registro_registro_id`);

--
-- Indices de la tabla `tbl_tipo_habitacion`
--
ALTER TABLE `tbl_tipo_habitacion`
  ADD PRIMARY KEY (`tipo_habitacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_habitaciones`
--
ALTER TABLE `tbl_habitaciones`
  MODIFY `habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_habitacion_inventario`
--
ALTER TABLE `tbl_habitacion_inventario`
  MODIFY `habitacion_inventario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_habitacion_servicios`
--
ALTER TABLE `tbl_habitacion_servicios`
  MODIFY `habitacion_servicios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_imagenes_tipo`
--
ALTER TABLE `tbl_imagenes_tipo`
  MODIFY `imagenes_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `inventario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  MODIFY `municipio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  MODIFY `pago_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_pais`
--
ALTER TABLE `tbl_pais`
  MODIFY `pais_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `preguntas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_registro`
--
ALTER TABLE `tbl_registro`
  MODIFY `registro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_registro_preguntas_respuestas`
--
ALTER TABLE `tbl_registro_preguntas_respuestas`
  MODIFY `registro_preguntas_respuestas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `reserva_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_respuesta`
--
ALTER TABLE `tbl_respuesta`
  MODIFY `respuesta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_servicios`
--
ALTER TABLE `tbl_servicios`
  MODIFY `servicios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tarjeta`
--
ALTER TABLE `tbl_tarjeta`
  MODIFY `tarjeta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_habitacion`
--
ALTER TABLE `tbl_tipo_habitacion`
  MODIFY `tipo_habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD CONSTRAINT `fk_tbl_estado_tbl_pais` FOREIGN KEY (`tbl_pais_pais_id`) REFERENCES `tbl_pais` (`pais_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_habitaciones`
--
ALTER TABLE `tbl_habitaciones`
  ADD CONSTRAINT `fk_tbl_habitaciones_tbl_tipo_habitacion1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tbl_tipo_habitacion` (`tipo_habitacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_habitacion_inventario`
--
ALTER TABLE `tbl_habitacion_inventario`
  ADD CONSTRAINT `fk_tbl_habitacion_inventario_tbl_habitaciones1` FOREIGN KEY (`id_habitacion`) REFERENCES `tbl_habitaciones` (`habitacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_habitacion_inventario_tbl_inventario1` FOREIGN KEY (`id_inventario`) REFERENCES `tbl_inventario` (`inventario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_habitacion_servicios`
--
ALTER TABLE `tbl_habitacion_servicios`
  ADD CONSTRAINT `fk_tbl_habitacion_servicios_tbl_habitaciones1` FOREIGN KEY (`id_habitacion`) REFERENCES `tbl_habitaciones` (`habitacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_habitacion_servicios_tbl_servicios1` FOREIGN KEY (`id_servicios`) REFERENCES `tbl_servicios` (`servicios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_imagenes_tipo`
--
ALTER TABLE `tbl_imagenes_tipo`
  ADD CONSTRAINT `fk_tbl_imagenes_tipo_tbl_tipo_habitacion1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tbl_tipo_habitacion` (`tipo_habitacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD CONSTRAINT `fk_tbl_municipio_tbl_estado1` FOREIGN KEY (`tbl_estado_estado_id`) REFERENCES `tbl_estado` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  ADD CONSTRAINT `fk_tbl_pago_tbl_reserva1` FOREIGN KEY (`tbl_reserva_reserva_id`) REFERENCES `tbl_reserva` (`reserva_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_pago_tbl_tarjeta1` FOREIGN KEY (`tbl_tarjeta_tarjeta_id`) REFERENCES `tbl_tarjeta` (`tarjeta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_registro`
--
ALTER TABLE `tbl_registro`
  ADD CONSTRAINT `fk_tbl_registro_tbl_estado1` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado` (`estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_registro_tbl_municipio1` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipio` (`municipio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_registro_tbl_pais1` FOREIGN KEY (`id_pais`) REFERENCES `tbl_pais` (`pais_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_registro_preguntas_respuestas`
--
ALTER TABLE `tbl_registro_preguntas_respuestas`
  ADD CONSTRAINT `fk_tbl_registro_preguntas_respuestas_tbl_preguntas1` FOREIGN KEY (`tbl_preguntas_preguntas_id`) REFERENCES `tbl_preguntas` (`preguntas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_registro_preguntas_respuestas_tbl_registro1` FOREIGN KEY (`tbl_registro_registro_id`) REFERENCES `tbl_registro` (`registro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_registro_preguntas_respuestas_tbl_respuesta1` FOREIGN KEY (`tbl_respuesta_respuesta_id`) REFERENCES `tbl_respuesta` (`respuesta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `fk_tbl_reserva_tbl_habitaciones1` FOREIGN KEY (`tbl_habitaciones_habitacion_id`) REFERENCES `tbl_habitaciones` (`habitacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_reserva_tbl_registro1` FOREIGN KEY (`tbl_registro_registro_id`) REFERENCES `tbl_registro` (`registro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tarjeta`
--
ALTER TABLE `tbl_tarjeta`
  ADD CONSTRAINT `fk_tbl_tarjeta_tbl_registro1` FOREIGN KEY (`tbl_registro_registro_id`) REFERENCES `tbl_registro` (`registro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
