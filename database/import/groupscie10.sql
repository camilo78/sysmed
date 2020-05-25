-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-05-2020 a las 18:57:51
-- Versión del servidor: 8.0.20-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3



INSERT INTO `groupscie10` (`id`, `clave`, `descripcion`) VALUES
(1, 'I', 'Ciertas enfermedades infecciosas y parasitarias'),
(2, 'II', 'Neoplasias'),
(3, 'III', 'Enfermedades de la sangre y de los organos hematopoyeticos y otros trastornos que afectan el mecanismo de la inmunidad'),
(4, 'IV', 'Enfermedades endocrinas, nutricionales y metabolicas'),
(5, 'IX', 'Enfermedades del sistema circulatorio'),
(6, 'V', 'Trastornos mentales y del comportamiento'),
(7, 'VI', 'Enfermedades del sistema nervioso'),
(8, 'VII', 'Enfermedades del ojo y sus anexos'),
(9, 'VIII', 'Enfermedades del oido y de la apofisis mastoides'),
(10, 'X', 'Enfermedades del sistema respiratorio'),
(11, 'XI', 'Enfermedades del aparato digestivo'),
(12, 'XII', 'Enfermedades de la piel y el tejido subcutaneo'),
(13, 'XIII', 'Enfermedades del sistema osteomuscular y del tejido conectivo'),
(14, 'XIV', 'Enfermedades del aparato genitourinario'),
(15, 'XIX', 'Traumatismos, envenenamientos y algunas otras consecuencias de causa externa'),
(16, 'XV', 'Embarazo, parto y puerperio'),
(17, 'XVI', 'Ciertas afecciones originadas en el periodo perinatal'),
(18, 'XVII', 'Malformaciones congenitas, deformidades y anomalias cromosomicas'),
(19, 'XVIII', 'Sintomas, signos y hallazgos anormales clinicos y de laboratorio, no clasificados en otra parte'),
(20, 'XX', 'Causas extremas de morbilidad y de mortalidad'),
(21, 'XXI', 'Factores que influyen en el estado de salud y contacto con los servicios de salud'),
(22, 'XXII', 'Codigos para situaciones especiales');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `groupscie10`
--
ALTER TABLE `groupscie10`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `groupscie10`
--
ALTER TABLE `groupscie10`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
