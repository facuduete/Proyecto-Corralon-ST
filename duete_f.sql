-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2024 a las 17:14:39
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
-- Base de datos: `duete_f`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `activo`) VALUES
(1, 'Construcción en seco', 1),
(2, 'Materiales gruesos', 1),
(3, 'Ladrillos y Viguetas', 1),
(4, 'Pisos y Revestimientos', 1),
(5, 'Herramientas', 1),
(6, 'Materiales para techos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `motivo` int(11) NOT NULL,
  `comentario` varchar(1000) NOT NULL,
  `visto` varchar(20) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `apellido`, `tel`, `email`, `motivo`, `comentario`, `visto`) VALUES
(1, 'Facundo', 'Duete', '3794036485', 'facu.duete@gmail.com', 3, 'Hola, estoy teniendo problemas al intentar realizar una compra', 'SI'),
(2, 'Mati', 'Maidana', '3784999996', 'mati@gmail.com', 4, 'Intenté llamar al número de telefono pero no atendió nadie', 'SI'),
(3, 'Facundo', 'Duete', '379488878', 'facu@gmail.com', 2, 'Compré una bolsa de cemento pero nunca llegó', 'SI'),
(4, 'Pepe', 'Gomez', '3784858585', 'facu.duete@gmail.com', 4, 'Se me rompió mi pala, hay devolución?', 'NO'),
(5, 'Mariano', 'Lopez', '3784757575', 'maxiriano01@gmail.com', 1, 'ya aceptan los billetes nuevos de 10mil? Gracias', 'NO'),
(6, 'Juan', 'Romero', '7364545454', 'juanca@gmail.com', 3, 'Compré mal un producto, aceptan devoluciones?', 'NO'),
(7, 'Juan', 'Carlos', '6574747483', 'juan77@gmail.com', 1, 'aceptan mercado pago?', 'NO'),
(8, 'Pepe', 'Gomez', '37896565', 'pepe@pepe.com', 4, 'Hola quisiera saber cuanto tardan los envíos', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_consultas`
--

CREATE TABLE `motivos_consultas` (
  `id_motivo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `motivos_consultas`
--

INSERT INTO `motivos_consultas` (`id_motivo`, `descripcion`) VALUES
(1, 'Medios de pago'),
(2, 'Estado del pedido'),
(3, 'Problema con la compra'),
(4, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(2) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_prod` varchar(200) NOT NULL,
  `marca_prod` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(15,2) NOT NULL,
  `precio_vta` float(15,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `eliminado` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_prod`, `marca_prod`, `imagen`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `eliminado`) VALUES
(1, 'Cemento 50kg', 'Loma Negra', '1717029984_20885efa5619e01fa39f.png', 2, 7479.20, 9479.20, 2994, 50, 'NO'),
(2, 'Cal Hidratada 20Kg', 'Santa Elena', '1717029994_e464cc00a205584ca8bc.png', 2, 3100.00, 4161.27, 2000, 60, 'NO'),
(3, 'Hidrófugo Ceresita 10Kg', 'Weber', '1717030001_46a91fa8849161ebb6b2.png', 2, 10000.00, 14070.63, 2300, 20, 'NO'),
(4, 'Revoque Fino Interior 25Kg', 'Weber', '1717030010_668d93cce1ae8fd67d54.png', 2, 4206.38, 5206.38, 20, 20, 'NO'),
(5, 'Cemento 50kg', 'Avellaneda', '1717030023_bdf0934986272a4244b8.png', 2, 6518.34, 8518.34, 1650, 30, 'NO'),
(6, 'Aditivo Tacurú 10Lts', 'Weber', '1717030031_372be950a3198122221e.png', 2, 60459.50, 74459.50, 569, 30, 'NO'),
(7, 'Cal Hidratada 25Kg', 'El Milagro', '1717030040_5a13a2611e2b3419b246.png', 2, 10145.06, 12145.06, 1500, 60, 'NO'),
(8, 'Revoque Exterior 3 en 1 Mix E 30Kg', 'Weber', '1717030543_bd9c148788fedd92c919.png', 2, 4794.92, 6794.92, 130, 3, 'SI'),
(9, 'Andamio Reforzado 193cmX130cm', 'Deper', '1717030053_f318c4a842b23df1ee84.png', 5, 210087.84, 235087.84, 60, 5, 'NO'),
(10, 'Taladro Percutor 13mm 650W', 'Black & Decker', '1717030061_e18ad514288d382edbde.png', 5, 70789.52, 85789.52, 90, 3, 'NO'),
(11, 'Carretilla Chapa Ruedas Macizas', 'Deper', '1717030068_29d68a9ce5ae6dbd8143.png', 5, 60557.30, 78557.30, 70, 5, 'NO'),
(12, 'Amoladora Angular 115mm 820W', 'Hamilton', '1717030079_b2de169350c34dad25fb.png', 5, 30000.00, 35000.84, 70, 10, 'NO'),
(13, 'Cal Hidratada 25Kg', 'Avellaneda', '1718287559_6df0f4bb80e067945734.png', 2, 3500.00, 3886.70, 900, 20, 'NO'),
(14, 'Hidrófugo Ceresita 20Kg', 'Weber', '1718287742_4f742046e37b092c6865.png', 2, 25000.00, 28397.85, 600, 40, 'NO'),
(15, 'Hidrófugo Ceresita 1Kg', 'Weber', '1718287783_df9d3196207b24589a82.png', 2, 2500.00, 2845.30, 700, 30, 'NO'),
(16, 'Hidrófugo Ceresita 200Kg', 'Weber', '1718287838_1576afd46bcd7007a2a4.png', 2, 150000.00, 163500.55, 69, 5, 'NO'),
(17, 'Mortero Adhesivo 30kg', 'Retak', '1718287931_59a1437bf52f0dd50b6f.png', 2, 20000.00, 22147.90, 600, 20, 'NO'),
(18, 'Yeso Blanco Bolsa 30kg', 'Tuyango', '1718288039_e91f8740313f53b5a055.png', 2, 9000.00, 9899.90, 700, 30, 'NO'),
(19, 'Aditivo Tacurú 1 Lt', 'Weber', '1718288097_3a60ba20b7d13bf0312e.png', 2, 12000.00, 12739.90, 1200, 50, 'NO'),
(20, 'Arena en Bolsa', 'Corralón ST', '1718288352_2daa7201106e6367f35c.png', 2, 1500.00, 1700.42, 1300, 40, 'SI'),
(21, 'Piedra en Bolsa', 'Corralón ST', '1718288409_2ce6b05c4be6bd56463c.png', 2, 2000.00, 2067.60, 860, 20, 'NO'),
(22, 'Yeso Tradicional 1kg', 'Tuyango', '1718288468_21a9af4ef18eb4a2f01b.png', 2, 1500.00, 1700.60, 1540, 16, 'NO'),
(23, 'Bolsón de Arena Fina', 'Corralón ST', '1718288552_9e41ab2f64a963202328.png', 2, 30000.00, 35000.90, 599, 40, 'NO'),
(24, 'Bolsón de Piedra Partida', 'Corralón ST', '1718288686_22a2042cdbcaebe53f82.png', 2, 60000.00, 66700.90, 400, 18, 'NO'),
(25, 'Cuchara de Albañil N8', 'Biasonni', '1718291462_f0fed82430c7bc8ac1e1.png', 5, 8000.00, 8700.60, 399, 20, 'NO'),
(26, 'Cuchara de Albañil N8 Punta Mocha', 'Biasonni', '1718291510_d1c528150f0dd1a77af7.png', 5, 9000.00, 9600.60, 400, 20, 'NO'),
(27, 'Amoladora Angular 115mm 830W', 'Dewalt', '1718291685_fc3401c800c58dce4675.png', 5, 70000.00, 73137.90, 500, 15, 'NO'),
(28, 'Amoladora Angular 115mm 850W', 'Lusqtoff', '1718291816_ec99c6ebd49356f5110b.png', 5, 80000.00, 83960.60, 400, 30, 'SI'),
(29, 'Balde Albañil Reforzado', 'Flomar', '1718291873_f559379c8fa5243e419f.png', 5, 1500.00, 1800.45, 598, 12, 'NO'),
(30, 'Caballete Extensible Telescópico', 'Deper', '1718292219_166f88fd82d496f0f181.png', 5, 85000.00, 92358.60, 200, 10, 'NO'),
(31, 'Corta Hierro 25cm', 'Biasonni', '1718292368_57924e099d70a67d9c53.png', 5, 6000.00, 6522.60, 230, 10, 'NO'),
(32, 'Cortadora Cerámica 60cm con Escuadra', 'Rubi', '1718292422_3f7d6d3112526b057ccb.png', 5, 75000.00, 82077.80, 60, 5, 'NO'),
(33, 'Disco de Corte Metal 115mm', 'Tyrolit', '1718292581_4faf2405bd4644ad5dac.png', 5, 3000.00, 3683.40, 150, 14, 'NO'),
(34, 'Disco de Corte Acero 115mm', 'Tyrolit', '1718292635_a7fde50bbe11b254af4d.png', 5, 3500.00, 3879.74, 150, 14, 'NO'),
(35, 'Escalera Tipo Pintor', 'R&F', '1718292856_c4d06b27c32b0b940bfe.png', 5, 40000.00, 48904.15, 39, 4, 'NO'),
(36, 'Escalera Aluminio 16 Escalones Plegable', 'Lusqtoff', '1718293007_d29bd956b1b347ee2b2b.png', 5, 140000.00, 149955.30, 60, 4, 'NO'),
(37, 'Filtro 20cm para Fino ', 'Ferramsur', '1718293360_47889c9f964d26e8b696.png', 5, 1500.00, 1977.28, 122, 20, 'NO'),
(38, 'Fratacho Pino 25cm', 'Ferramsur', '1718293401_8dea593ed48aa182bbd1.png', 5, 2000.00, 2226.80, 149, 12, 'NO'),
(39, 'Guantes Gris Moteado', 'Randon', '1718293491_32e0ce4d4ffdb8763242.png', 5, 700.00, 830.69, 60, 4, 'NO'),
(40, 'Hormigonera 130 80lts Compact', 'Deper', '1718293580_66b52a75b0c6a0ed963b.png', 5, 350000.00, 404611.91, 150, 10, 'NO'),
(41, 'Llave Francesa 19mm N6', 'Ingco', '1718293767_0b705fb89c6047b0ab83.png', 5, 4500.00, 5193.60, 150, 13, 'NO'),
(42, 'Llave inglesa N8', 'Ingco', '1718296349_911edc3a692e1a2c288f.png', 5, 10000.00, 11856.30, 150, 18, 'NO'),
(43, 'Manguera Para Nivel 3m', 'Ingco', '1718296446_4c7ab14fd41a1a984d24.png', 5, 2000.00, 2957.60, 60, 3, 'NO'),
(44, 'Nivel Manual 40cm', 'Sola', '1718296611_8122100d1aa0f232e57d.png', 5, 15000.00, 19021.60, 150, 15, 'NO'),
(45, 'Pala Ancha', 'Gherardi', '1718305939_8c97b47de0b5e34bc8ae.png', 5, 35000.00, 40827.80, 499, 20, 'NO'),
(46, 'Pala de Punta', 'Gherardi', '1718297141_e558974e075aa7074fc3.png', 5, 35000.00, 38900.60, 500, 20, 'NO'),
(47, 'Tenaza N9', 'Gherardi', '1718297284_6aeaa6d5cb5e3c20296e.png', 5, 15000.00, 16886.30, 200, 30, 'NO'),
(48, 'Tijera Corta Caños PVC', 'Ingco', '1718297332_34127d3eb28ebcb7d745.png', 5, 9000.00, 10086.60, 2, 2, 'NO'),
(49, 'Punta de Hierro 25cm', 'Biasonni', '1718297453_cafcef9fd4f2c2f2de29.png', 5, 7500.00, 7930.60, 149, 12, 'NO'),
(50, 'Rotomartillo 850W', 'Lusqtoff', '1718297569_76155c07ae72bf9929da.png', 5, 100000.00, 111265.90, 68, 10, 'NO'),
(51, 'Sierra Circular 1200W', 'Skil', '1718297680_b55c0a03540f694cea6d.png', 5, 130000.00, 142873.91, 60, 5, 'NO'),
(52, 'Martillo Encofrador', 'Hamilton', '1718297754_39f9c8305c652bf03211.png', 5, 10000.00, 13416.60, 200, 21, 'SI'),
(53, 'Maza Albañil 3Kg', 'Ingco', '1718297937_dc6c803c566fd5e75112.png', 5, 10000.00, 11479.30, 150, 14, 'NO'),
(54, 'Soldado FLUX 120A 50Hz', 'Lusqtoff', '1718298057_f21f98b3e0f0ab592e11.png', 5, 190000.00, 201018.30, 50, 3, 'NO'),
(55, 'Tornillo T2 Aguja', 'Dismar', '1718300195_af738e065dec321770e7.png', 1, 20.00, 25.87, 3999, 200, 'NO'),
(56, 'Tornillo T1 Aguja', 'Dismar', '1718300243_cfcf34bf8bbf0271d95e.png', 1, 30.00, 34.63, 5000, 100, 'NO'),
(57, 'Tornillo T1 Mecha', 'Dismar', '1718300297_e800048abe5364169b55.png', 1, 30.00, 37.69, 5000, 100, 'NO'),
(58, 'Solera Galvanizado 35X35X260', 'Trimat', '1718300381_decfa30c895655a81b87.png', 1, 2000.00, 2561.60, 1000, 30, 'NO'),
(59, 'Montante Galvanizado 34X35X30', 'Trimat', '1718300431_7f38850d91c895835128.png', 1, 3000.00, 3354.07, 1000, 20, 'NO'),
(60, 'Placa Superboard 240X120 6mm', 'Eternit', '1718301430_7241c09690ab989c62ae.jpg', 1, 50000.00, 55347.66, 300, 20, 'NO'),
(61, 'Masilla Lpu 15Kg', 'Novoplack', '1718300577_928d92504dd9279be913.png', 1, 13000.00, 15970.33, 200, 12, 'NO'),
(62, 'Masilla Lpu 7Kg', 'Novoplack', '1718300614_781a3f80549d993b76bb.png', 1, 6000.00, 8706.33, 250, 13, 'NO'),
(63, 'Masilla en Polvo', 'Placostic', '1718300659_1b13b0528ec6ca47554f.png', 1, 35000.00, 38291.56, 500, 20, 'NO'),
(64, 'Cinta Microperforada Papel 150M', 'Drywall', '1718300798_cb0ea69841e3380dae9b.png', 1, 12000.00, 15450.33, 200, 18, 'NO'),
(65, 'Cinta Tramada Auto Adhesiva 50M', 'Drywall', '1718300846_86b71b375d0d2044940a.png', 1, 5000.00, 5354.60, 200, 10, 'NO'),
(66, 'Tarugo Nylon N8', 'Dismar', '1718300972_12479099752d23fcdd9d.jpg', 1, 50.00, 64.33, 2000, 120, 'NO'),
(67, 'Tornillo Fijador Aguja', 'Dismar', '1718301340_e5a23551d7bf4f423877.png', 1, 60.00, 67.99, 4967, 100, 'NO'),
(68, 'Masilla Invisible 15Kg', 'Eternit', '1718301385_655df70d0e532e1f4c5a.png', 1, 170000.00, 179522.23, 200, 10, 'NO'),
(69, 'Placa Estándar 120X240', 'Placo', '1718301910_99cfed0f5dc31d21b189.png', 1, 12000.00, 15299.90, 300, 20, 'NO'),
(70, 'Placa Resistente a la Humedad 120X240', 'Durlock', '1718302055_d8a6806a43fbbac7a3b7.png', 1, 15000.00, 16427.33, 194, 10, 'NO'),
(71, 'Placa Resistente al Fuego 120X240', 'Durlock', '1718302417_e5bf4f7919fc20b897a3.png', 1, 12000.00, 14374.33, 200, 10, 'NO'),
(72, 'Placa Estándar 120X240', 'Durlock', '1718302405_8fa7b6d0dc96ee90bac9.png', 1, 9000.00, 9788.30, 499, 20, 'NO'),
(73, 'Ladrillo de Poliéster 10X42X100', 'Mastroblock', '1718303342_e158b41e4cae45f827bf.png', 3, 3000.00, 4131.07, 1970, 30, 'NO'),
(74, 'Vigueta Pretensada de Hormigón 4m', 'Qualita', '1718303411_f08ebf63715d90ef2e8e.png', 3, 10000.00, 13104.77, 980, 40, 'NO'),
(75, 'Ladrillo Común', 'Chacabuco', '1718303465_5facf41fc9453ff20826.png', 3, 100.00, 119.31, 5490, 300, 'NO'),
(76, 'Columna de Hierro 10X10X3Mts', 'Acindar', '1718303516_2cad30612e5f8b1747ec.png', 3, 14000.00, 16511.28, 999, 30, 'NO'),
(77, 'Ladrillo Hueco 12X18X33', 'Later-cer', '1718303600_7fd7281d44f003c3f4b3.png', 3, 400.00, 446.13, 9400, 200, 'NO'),
(78, 'Ladrillo Hueco 12X18X33 9T', 'Later-cer', '1718303715_f61d051c0e47099597db.png', 3, 400.00, 416.91, 9697, 200, 'NO'),
(79, 'Ladrillo Hueco 18X18X33', 'Later-cer', '1718303754_e58f4776636510c77555.png', 3, 600.00, 688.60, 10000, 200, 'NO'),
(80, 'Ladrillo Hueco Portante 12X19X33', 'Later-cer', '1718303821_b026b3b1aacfd3b0da38.png', 3, 800.00, 820.31, 10000, 200, 'NO'),
(81, 'Bloque para Muro 20cm', 'Precast', '1718303896_48a5fa1be701d79e3d58.png', 3, 1500.00, 1718.90, 5000, 100, 'NO'),
(82, 'Estribos 10X10cm 6mm X10 Unidades', 'Nagel', '1718304050_08be340781400a5a38b4.png', 3, 25000.00, 27199.60, 1000, 20, 'NO'),
(83, 'Alambre Galvanizado 1000m', 'Acindar', '1718304152_03054decffe045b7e764.png', 3, 280000.00, 288470.59, 80, 10, 'NO'),
(84, 'Barra de Hierro Lisa N8', 'Acindar', '1718304561_29498c6ec331036b8eca.png', 3, 6000.00, 7536.20, 999, 20, 'NO'),
(85, 'Barra de Hierro Torsionada 8mm', 'Acindar', '1718304721_c2dd3b42bb24ea323619.png', 3, 8000.00, 9554.30, 1898, 100, 'NO'),
(86, 'Adhesivo para Cerámicos 30Kg', 'Lopego', '1718326414_cbf4bc930f33eab6112e.png', 4, 5500.00, 6206.44, 479, 20, 'NO'),
(87, 'Pastina Classic Color Negro 2Kg', 'Weber', '1718326489_5d57f5270218dac8d37d.jpg', 4, 4000.00, 4735.32, 600, 30, 'NO'),
(88, 'Pastina Prestige Color Niebla 2Kg', 'Weber', '1718326535_19e8618fb60c7064804c.jpg', 4, 8000.00, 9107.37, 600, 20, 'NO'),
(89, 'Cerámica Primera Gris Nápoles', 'Cañuelas', '1718326598_67cfe37df1cbd5a7c4cc.jpg', 4, 6000.00, 6712.22, 200, 15, 'NO'),
(90, 'Pastina Classic Color Hueso 2Kg', 'Weber', '1718326670_c42058d73e0a2a9d6873.jpg', 4, 4000.00, 4735.32, 600, 30, 'NO'),
(91, 'Adhesivo Impermeable 30Kg', 'Lopego', '1718327033_d85b2cdb4921d774c8b1.png', 4, 10000.00, 11440.80, 200, 10, 'NO'),
(92, 'Adhesivo Pro Porcelanatos 25Kg', 'Weber', '1718327090_36e8e039454a259893ae.png', 4, 14000.00, 15762.31, 200, 6, 'NO'),
(93, 'Pastina Prestige Color Ceniza 2Kg', 'Weber', '1718327154_a3542b16e8d797ec157c.jpg', 4, 8500.00, 9107.37, 200, 12, 'NO'),
(94, 'Pastina Classic Color Nieve 2Kg', 'Weber', '1718327194_710e8e0429a1a36a89e9.jpg', 4, 4000.00, 4735.32, 600, 20, 'NO'),
(95, 'Pastina Classic Color Plomo 2Kg', 'Weber', '1718327223_546759ae0fcffd631fb7.jpg', 4, 4000.00, 4735.32, 6000, 20, 'NO'),
(96, 'Adhesivo Revoque Seco 25Kg', 'Placo', '1718327287_5d11f4722f679adda04e.png', 4, 35000.00, 39486.55, 200, 11, 'NO'),
(97, 'Adhesivo Superflex', 'Weber', '1718327323_59bea81c108ba218b3db.png', 4, 20000.00, 26225.70, 200, 14, 'NO'),
(98, 'Cerámica Alberdi Brillante', 'Morisco', '1718327432_8a3e6a453f1d4bb125de.jpg', 4, 8500.00, 9252.30, 279, 20, 'NO'),
(99, 'Cerámica Beige ', 'Cañuelas', '1718327464_fa43d6759eaaa3bdff93.jpg', 4, 7000.00, 7750.90, 479, 20, 'NO'),
(100, 'Cerámica Negra Brillante', 'Cañuelas', '1718327527_d7b9af786286f9fad9bf.jpg', 4, 10000.00, 12032.62, 260, 20, 'NO'),
(101, 'Cerámica Gris Sardegna', 'Cañuelas', '1718327572_61d3607efa33035bc8b7.jpg', 4, 6000.00, 6916.03, 300, 20, 'NO'),
(102, 'Cerámica Aguamarina Satinado', 'Veneciano Mix', '1718327635_5650b01d8c532b9e2f81.jpg', 4, 8000.00, 8766.33, 300, 20, 'NO'),
(103, 'Lapiz Brillante Metálico 3m', 'Dylan', '1718327683_fa02b2dcf1b76d7a218f.png', 4, 20000.00, 23603.22, 500, 10, 'NO'),
(104, 'Tirafondo Cabeza Hexagonal 75mm', 'Cepego', '1718328901_a811db37cab7bc5c14c8.png', 6, 25.00, 31.77, 6000, 50, 'NO'),
(105, 'Tornillo Autoperforante con Arandela de Goma', 'Cepego', '1718328974_7ab848be9acf9521213b.png', 6, 50.00, 86.46, 5999, 30, 'NO'),
(106, 'Arandela de Chapa', 'Cepego', '1718329076_51eddeb34a3beb630b67.png', 6, 50.00, 75.55, 1999, 20, 'NO'),
(107, 'Teja Colonial Bolla', 'Fantini', '1718329148_9157856b6d3ae293d4ec.png', 6, 850.00, 941.77, 10000, 150, 'NO'),
(108, 'Membrana de Aluminio X Metro', 'Ekobit', '1718329207_56ad3320819dcdcd125b.png', 6, 1000.00, 1333.90, 500, 20, 'NO'),
(109, 'Chapa Canaleta 1mX0.25m', 'Cincalum', '1718329304_6659caa9a4441ada591e.png', 6, 3000.00, 3289.49, 600, 30, 'NO'),
(110, 'Chapa Trapezoidal 1mX0.25m', 'Cincalum', '1718329364_83ecff473c29271b2969.png', 6, 3000.00, 3300.66, 600, 20, 'NO'),
(111, 'Chapa Canaleta Negra 1mX0.25m', 'Cincalum', '1718329415_bf54a6db594cdf448ea6.png', 6, 4000.00, 4603.22, 600, 10, 'NO'),
(112, 'Chapa Trapezoidal Negra 1mX0.25m', 'Cincalum', '1718329448_4a123a4af120b4c1a22f.png', 6, 4000.00, 4733.83, 600, 20, 'NO'),
(113, 'Chapa Canaleta Verde 1mX0.25m', 'Cincalum', '1718329473_4f6ac7c0de2cf5040450.png', 6, 4000.00, 4733.83, 600, 20, 'NO'),
(114, 'Membrana Asfáltica con Aluminio 3mm', 'Clipperflex', '1718329535_466c7482244e906c9b48.png', 6, 8500.00, 9189.60, 248, 20, 'NO'),
(115, 'Emulsión Asfáltica 4Kg', 'Megaflex', '1718329590_4d95ecbfee946af7337d.png', 6, 13000.00, 15711.60, 199, 10, 'NO'),
(116, 'Canaleta Rectangular 7cm-15cm', 'Cincalum', '1718329713_03b551f5fd84c16eeab5.png', 6, 17000.00, 20643.60, 200, 12, 'NO'),
(117, 'Soporte para Canaleta 7cm-15cm', 'Cincalum', '1718329753_5edad1f6d23a6b3e53f6.png', 6, 2500.00, 3116.90, 250, 20, 'NO'),
(118, 'Cumbrera Galvanizada Nro25', 'Cincalum', '1718329809_98466a88ab1e04aa8b22.png', 6, 10000.00, 11511.90, 250, 20, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `perfil_id` int(2) NOT NULL DEFAULT 2,
  `baja` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `usuario`, `tel`, `email`, `pass`, `perfil_id`, `baja`) VALUES
(35, 'Facundo', 'Duete', 'facuAdmin', '3794123456', 'facu.duete@gmail.com', '$2y$10$/O2HGEn0GSiZJUqOpkobbupm.LoGkW2/7Xs0AP.6Kydu.FDFCvilq', 1, 'NO'),
(36, 'Facundo', 'Duete', 'facuUsuario', '3794036486', 'facutrabajador@gmail.com', '$2y$10$eLX0/NaXFI5JbPZHWX25oOp.iQV.7/uMxIVyxLMja91y1XuUfbZVG', 2, 'NO'),
(41, 'Juan', 'Romero', 'juanca77', '3978465743', 'juancalolero@gmail.com', '$2y$10$3zxlwtKrXlmaewUnn8W7zebs.eRBiHbuiTRTwxq.JeWhcwf4ek8Ou', 2, 'NO'),
(42, 'Claudio', 'Galarza', 'claudio240km', '12345671', 'claudio@gmail.com', '$2y$10$iWFZKST3O1CZ45FiRRvcMeBZbnfQ2EdA9a8SVjgAFcqkJG7E3OF96', 1, 'SI'),
(43, 'Matias', 'Maidana', 'matilolero', '37849561', 'mati@gmail.com', '$2y$10$puej27mE6OTjFTnmX81YCeUrb3qqe/g/td4rlprdqrtxQvyU/x8oS', 2, 'SI'),
(44, 'Mariano', 'Stemberg', 'marianousuario', '37940306485', 'facu@algo.com', '$2y$10$F56XTcMBzcpbuT3V6M99q.1iK88zw0g.arz.Ulisgdq6teBCJoiHi', 2, 'SI'),
(45, 'Maximiliano', 'Lopez', 'maxilopez123', '3748564743', 'maxi@maxi.net', '$2y$10$ni9ydTC5rt5Ulb/MAcughOco3AyOwpAI9OHnKIjVqQBjdkMCW7Rai', 2, 'NO'),
(46, 'Facundo', 'Usuario', 'facuUsuario1', '3794885566', 'usuario@gmail.com', '$2y$10$WI09I4t8k41IuOMMTMPjYudvOYzfF2y09/.1rsjAIZTFBaHx6/O1K', 2, 'NO'),
(47, 'Facundo', 'Admin', 'facuAdmin1', '3794552244', 'admin@gmail.com', '$2y$10$RhZA0vNprSNdcZ0q1fOvVeX5DkHghuCoitZJNvZEFhGuTvwnNAFr2', 1, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariospromociones`
--

CREATE TABLE `usuariospromociones` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `respuesta` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariospromociones`
--

INSERT INTO `usuariospromociones` (`id`, `email`, `respuesta`) VALUES
(1, 'facuAdmin@gmail.com', 'SI'),
(2, 'matimainzed@gmail.com', 'SI'),
(3, 'dariana@gmail.com', 'SI'),
(4, 'maximiliano@gmail.com', 'SI'),
(5, 'juancalolero@gmail.com', 'SI'),
(6, 'mariano@gmail.com', 'SI'),
(7, 'claudiogalarza@gmail.com', 'NO'),
(8, 'facu@algo.com', 'NO'),
(9, 'facu.duete@gmail.com', 'NO'),
(10, 'claudio@gmail.com', 'SI'),
(11, 'juanca77@gmail.com', 'SI'),
(12, 'facutrabajador@gmail.com', 'NO'),
(13, 'chacho123@gmail.com', 'NO'),
(14, 'duete445@gmail.com', 'NO'),
(15, 'facu123@algo.com', 'NO'),
(16, 'maxi@gmail.net', 'NO'),
(17, 'pepenavarro@gmail.com', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `usuario_id`, `total_venta`) VALUES
(6, '2024-06-16 12:23:14', 36, 240652.41),
(7, '2024-06-16 12:47:31', 36, 41352.00),
(8, '2024-06-16 12:48:11', 36, 56502.44),
(9, '2024-06-16 13:00:32', 36, 7750.90),
(10, '2024-06-16 13:00:49', 36, 7750.90),
(11, '2024-06-16 13:01:45', 36, 7750.90),
(12, '2024-06-16 13:02:01', 36, 74459.50),
(13, '2024-06-16 13:22:34', 36, 10891601.00),
(14, '2024-06-16 13:23:34', 36, 1333270.38),
(15, '2024-06-16 13:33:33', 36, 13744840.00),
(16, '2024-06-16 13:34:09', 36, 13744840.00),
(17, '2024-06-16 13:34:24', 36, 13744840.00),
(18, '2024-06-16 13:37:47', 36, 18958.40),
(19, '2024-06-16 14:05:47', 36, 7536.20),
(20, '2024-06-16 20:13:08', 36, 534420.81),
(21, '2024-06-16 21:45:07', 36, 6473045.00),
(22, '2024-06-17 11:58:13', 46, 196652.56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(4, 6, 100, 20, 12032.62),
(5, 7, 21, 20, 2067.60),
(6, 8, 21, 20, 2067.60),
(7, 8, 86, 1, 6206.44),
(8, 8, 99, 1, 7750.90),
(9, 8, 75, 10, 119.31),
(10, 9, 99, 1, 7750.90),
(11, 10, 99, 1, 7750.90),
(12, 11, 99, 1, 7750.90),
(13, 12, 6, 1, 74459.50),
(14, 13, 1, 1149, 9479.20),
(15, 14, 22, 784, 1700.60),
(16, 15, 1, 1450, 9479.20),
(17, 16, 1, 1450, 9479.20),
(18, 17, 1, 1450, 9479.20),
(19, 18, 1, 2, 9479.20),
(20, 19, 84, 1, 7536.20),
(21, 20, 106, 1, 75.55),
(22, 20, 114, 2, 9189.60),
(23, 20, 105, 1, 86.46),
(24, 20, 23, 1, 35000.90),
(25, 20, 1, 1, 9479.20),
(26, 20, 16, 1, 163500.55),
(27, 20, 29, 1, 1800.45),
(28, 20, 49, 1, 7930.60),
(29, 20, 50, 1, 111265.90),
(30, 20, 35, 1, 48904.15),
(31, 20, 38, 1, 2226.80),
(32, 20, 78, 300, 416.91),
(33, 20, 67, 13, 67.99),
(34, 20, 55, 1, 25.87),
(35, 20, 72, 1, 9788.30),
(36, 21, 83, 20, 288470.59),
(37, 21, 85, 1, 9554.30),
(38, 21, 75, 200, 119.31),
(39, 21, 76, 1, 16511.28),
(40, 21, 77, 600, 446.13),
(41, 21, 74, 20, 13104.77),
(42, 21, 73, 30, 4131.07),
(43, 22, 70, 6, 16427.33),
(44, 22, 67, 20, 67.99),
(45, 22, 1, 3, 9479.20),
(46, 22, 78, 3, 416.91),
(47, 22, 25, 1, 8700.60),
(48, 22, 29, 1, 1800.45),
(49, 22, 45, 1, 40827.80),
(50, 22, 115, 1, 15711.60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `motivo` (`motivo`);

--
-- Indices de la tabla `motivos_consultas`
--
ALTER TABLE `motivos_consultas`
  ADD PRIMARY KEY (`id_motivo`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `usuariospromociones`
--
ALTER TABLE `usuariospromociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `motivos_consultas`
--
ALTER TABLE `motivos_consultas`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuariospromociones`
--
ALTER TABLE `usuariospromociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`motivo`) REFERENCES `motivos_consultas` (`id_motivo`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
