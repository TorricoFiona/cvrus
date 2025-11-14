-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 01:24:39
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
-- Base de datos: `cvrus1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum`
--

CREATE TABLE `curriculum` (
  `id_cv` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_generacion` datetime DEFAULT current_timestamp(),
  `ruta_archivo_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum_empresa`
--

CREATE TABLE `curriculum_empresa` (
  `id_cv` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(150) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `division` varchar(20) DEFAULT NULL,
  `turno` enum('Mañana','Tarde','Noche','Vespertino') DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacionadicional`
--

CREATE TABLE `educacionadicional` (
  `id_educacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `institucion` varchar(150) DEFAULT NULL,
  `curso_realizado` varchar(150) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `educacionadicional`
--

INSERT INTO `educacionadicional` (`id_educacion`, `id_usuario`, `institucion`, `curso_realizado`, `fecha_inicio`, `fecha_fin`) VALUES
(9, 17, 'E.E.S.T N°3', 'pensamiento computacional', '2225-12-31', '2025-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `rubro` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_usuario`
--

CREATE TABLE `experiencia_usuario` (
  `id_experiencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` enum('laboral','otro') NOT NULL DEFAULT 'otro',
  `empresa` varchar(150) DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `experiencia_usuario`
--

INSERT INTO `experiencia_usuario` (`id_experiencia`, `id_usuario`, `tipo`, `empresa`, `puesto`, `fecha_inicio`, `fecha_fin`, `descripcion`) VALUES
(2, 1705, 'laboral', 'Findmyspace', '', '0000-00-00', '0000-00-00', ''),
(8, 17, 'laboral', 'Findmyspace', 'scrum master', '2025-12-31', '2025-03-31', 'en este trabajo hacia todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulariocomplementario`
--

CREATE TABLE `formulariocomplementario` (
  `id_formulario` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `presentacion` varchar(400) DEFAULT NULL,
  `perfil_egresado` varchar(100) DEFAULT NULL,
  `disponibilidad` varchar(100) DEFAULT NULL,
  `disponibilidad_viaje` varchar(100) DEFAULT NULL,
  `area_pretendida` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulariocomplementario`
--

INSERT INTO `formulariocomplementario` (`id_formulario`, `id_usuario`, `presentacion`, `perfil_egresado`, `disponibilidad`, `disponibilidad_viaje`, `area_pretendida`) VALUES
(11, 1705, 'sdsadsdsadssdsa', '', 'fdfsdfdfsdfds', 'yes', 'dfdsfdf'),
(12, 17, 'hola mi nombre es uriel y tata', 'informatica', 'mis horarios disponibles son de x a x', 'yes', 'desarrollador web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades_usuario`
--

CREATE TABLE `habilidades_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` enum('personal','tecnica') NOT NULL,
  `habilidad` text NOT NULL,
  `nivel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidades_usuario`
--

INSERT INTO `habilidades_usuario` (`id`, `id_usuario`, `tipo`, `habilidad`, `nivel`) VALUES
(8, 1705, 'personal', 'dfdsfdfd', NULL),
(19, 17, 'personal', 'magico y juego al futbol', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas_usuario`
--

CREATE TABLE `idiomas_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `idioma` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `idiomas_usuario`
--

INSERT INTO `idiomas_usuario` (`id`, `id_usuario`, `idioma`) VALUES
(3, 1705, 'dsfdsfdsfd'),
(9, 17, 'español e ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `id_modalidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id_modalidad`, `nombre`) VALUES
(22, 'Informática'),
(23, 'Alimentos'),
(24, 'Arte'),
(25, 'Sociales'),
(26, 'Economía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `ID_NACIONALIDAD` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo_iso` char(2) DEFAULT NULL COMMENT 'Código ISO 3166-1 alpha-2',
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`ID_NACIONALIDAD`, `nombre`, `codigo_iso`, `activo`) VALUES
(1, 'Argentina', 'AR', 1),
(2, 'Bolivia', 'BO', 1),
(3, 'Brasil', 'BR', 1),
(4, 'Chile', 'CL', 1),
(5, 'Colombia', 'CO', 1),
(6, 'Costa Rica', 'CR', 1),
(7, 'Cuba', 'CU', 1),
(8, 'República Dominicana', 'DO', 1),
(9, 'Ecuador', 'EC', 1),
(10, 'El Salvador', 'SV', 1),
(11, 'Guatemala', 'GT', 1),
(12, 'Honduras', 'HN', 1),
(13, 'México', 'MX', 1),
(14, 'Nicaragua', 'NI', 1),
(15, 'Panamá', 'PA', 1),
(16, 'Paraguay', 'PY', 1),
(17, 'Perú', 'PE', 1),
(18, 'Puerto Rico', 'PR', 1),
(19, 'Uruguay', 'UY', 1),
(20, 'Venezuela', 'VE', 1),
(21, 'Canadá', 'CA', 1),
(22, 'Estados Unidos', 'US', 1),
(23, 'Alemania', 'DE', 1),
(24, 'España', 'ES', 1),
(25, 'Francia', 'FR', 1),
(26, 'Italia', 'IT', 1),
(27, 'Reino Unido', 'GB', 1),
(28, 'Rusia', 'RU', 1),
(29, 'Egipto', 'EG', 1),
(30, 'Nigeria', 'NG', 1),
(31, 'Sudáfrica', 'ZA', 1),
(32, 'Arabia Saudita', 'SA', 1),
(33, 'China', 'CN', 1),
(34, 'India', 'IN', 1),
(35, 'Japón', 'JP', 1),
(36, 'Corea del Sur', 'KR', 1),
(37, 'Australia', 'AU', 1),
(38, 'Nueva Zelanda', 'NZ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas_usuario`
--

CREATE TABLE `practicas_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `puesto` varchar(150) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `practicas_usuario`
--

INSERT INTO `practicas_usuario` (`id`, `id_usuario`, `empresa`, `puesto`, `fecha_inicio`, `fecha_fin`, `descripcion`) VALUES
(0, 17, 'Findmyspace', 'd23234dfsdf', '3322-02-23', '0000-00-00', 'dfsadasdasdsadsd3sdsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_usuario`
--

CREATE TABLE `proyectos_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `proyecto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos_usuario`
--

INSERT INTO `proyectos_usuario` (`id`, `id_usuario`, `proyecto`) VALUES
(0, 17, 'findmyspace');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos_usuario`
--

CREATE TABLE `titulos_usuario` (
  `id_titulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `titulos_usuario`
--

INSERT INTO `titulos_usuario` (`id_titulo`, `id_usuario`, `titulo`) VALUES
(0, 17, 'tecnico en informatica personal y profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verificado` tinyint(1) NOT NULL DEFAULT 0,
  `verificacion_token` varchar(90) DEFAULT NULL,
  `verificacion_enviada_en` datetime DEFAULT NULL,
  `verificado_en` datetime DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `telefono` varchar(30) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `domicilio` varchar(30) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `ID_MODALIDAD` int(11) NOT NULL,
  `id_nacionalidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `email_verificado`, `verificacion_token`, `verificacion_enviada_en`, `verificado_en`, `id_curso`, `telefono`, `fecha_nacimiento`, `domicilio`, `localidad`, `ID_MODALIDAD`, `id_nacionalidad`) VALUES
(15, 'Ian', 'Basly', 'baslyian5@gmail.com', '$2y$10$i1NhTE67S9lTJE8TEa.hJeMQ3rVyGULgkIJE4744rzricudjcdUK2', 1, NULL, '2025-11-12 14:39:34', '2025-11-12 15:15:26', NULL, '', NULL, NULL, NULL, 0, NULL),
(16, 'leandro', 'loza', 'lozaleandro54@gmail.com', '$2y$10$P4lZ.2xngD79Qk4P3AN/ge2CPjySdjX2C2jMXdVarZx4jQaC9h6Yq', 1, NULL, '2025-11-12 14:44:43', '2025-11-12 14:45:17', NULL, '', NULL, NULL, NULL, 0, NULL),
(17, 'Uriel', 'Maza', 'urielmaza38@gmail.com', '$2y$10$HBFi3dTkHo4ci54yn0zBTerrgO4XxNR1mQNy1dDXrHGkvBMV1kodW', 1, NULL, '2025-11-12 21:27:26', '2025-11-12 21:27:57', 0, '+541161757162', '3333-03-23', 'los ombues 70', 'Manuel Alberti', 22, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id_cv`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `curriculum_empresa`
--
ALTER TABLE `curriculum_empresa`
  ADD PRIMARY KEY (`id_cv`,`id_empresa`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `idx_anio` (`anio`);

--
-- Indices de la tabla `educacionadicional`
--
ALTER TABLE `educacionadicional`
  ADD PRIMARY KEY (`id_educacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `experiencia_usuario`
--
ALTER TABLE `experiencia_usuario`
  ADD PRIMARY KEY (`id_experiencia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `formulariocomplementario`
--
ALTER TABLE `formulariocomplementario`
  ADD PRIMARY KEY (`id_formulario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `habilidades_usuario`
--
ALTER TABLE `habilidades_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `idx_habilidades_nivel` (`nivel`);

--
-- Indices de la tabla `idiomas_usuario`
--
ALTER TABLE `idiomas_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`id_modalidad`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`ID_NACIONALIDAD`),
  ADD UNIQUE KEY `uk_codigo_iso` (`codigo_iso`);

--
-- Indices de la tabla `practicas_usuario`
--
ALTER TABLE `practicas_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `proyectos_usuario`
--
ALTER TABLE `proyectos_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `titulos_usuario`
--
ALTER TABLE `titulos_usuario`
  ADD PRIMARY KEY (`id_titulo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `curso_ibfk_1` (`id_curso`),
  ADD KEY `idx_usuario_id_nacionalidad` (`id_nacionalidad`);
ALTER TABLE `usuario` ADD FULLTEXT KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `educacionadicional`
--
ALTER TABLE `educacionadicional`
  MODIFY `id_educacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `experiencia_usuario`
--
ALTER TABLE `experiencia_usuario`
  MODIFY `id_experiencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `formulariocomplementario`
--
ALTER TABLE `formulariocomplementario`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `habilidades_usuario`
--
ALTER TABLE `habilidades_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `idiomas_usuario`
--
ALTER TABLE `idiomas_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id_modalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `ID_NACIONALIDAD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_nacionalidad` FOREIGN KEY (`id_nacionalidad`) REFERENCES `nacionalidad` (`ID_NACIONALIDAD`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
