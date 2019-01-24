DROP TABLE IF EXISTS articulo;

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` varchar(512) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`idarticulo`),
  KEY `fk_articulo_categoria_idx` (`idcategoria`),
  CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO articulo VALUES("1","1","7701234000011","Impresora Epson Lx200","11","","impresora.jpg","Activo");
INSERT INTO articulo VALUES("2","1","7702004003508","Impresora Epson M300","1","","Impresora Epson.jpeg","Activo");
INSERT INTO articulo VALUES("4","3","5901234123457","Cable UTP Cat-5","20","","descarga.jpg","Activo");
INSERT INTO articulo VALUES("5","3","8412345678905","Cable VGA 2Mt","104","","images.jpg","Activo");
INSERT INTO articulo VALUES("6","7","17839893093","Remera","10","remera mangas corta gucci, con lunares talle s","","Inactivo");
INSERT INTO articulo VALUES("7","7","489393992","Conjunto deportivo","16","Conjunto deportivo adidas river plate talle xl","cancha.jpg","Activo");


DROP TABLE IF EXISTS categoria;

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO categoria VALUES("1","Equipos Cómputo","Accesorios de cómputo","1");
INSERT INTO categoria VALUES("2","Útiles","Útiles","1");
INSERT INTO categoria VALUES("3","Limpieza","Artículos de limpieza","0");
INSERT INTO categoria VALUES("4","Medicina","Artículos medicinales","1");
INSERT INTO categoria VALUES("5","Líquidos","Líquidos","1");
INSERT INTO categoria VALUES("6","Comida","productos de comida","1");
INSERT INTO categoria VALUES("7","Vestimenta","Artículos de vestimenta","1");
INSERT INTO categoria VALUES("8","Servicios","Servicios","1");
INSERT INTO categoria VALUES("9","Cables","Todo tipo de cables","1");
INSERT INTO categoria VALUES("10","Accesorios de Sonido 2","Todos los accesorios de sonido 2","0");
INSERT INTO categoria VALUES("11","fgj1","fjghf2","0");
INSERT INTO categoria VALUES("12","hjkhk2","khykuyh","0");
INSERT INTO categoria VALUES("13","qqqqqq","wwww","0");


DROP TABLE IF EXISTS detalle_ingreso;

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `idingreso` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_ingreso`),
  KEY `fk_detalle_ingreso_idx` (`idingreso`),
  KEY `fk_detalle_ingreso_articulo_idx` (`idarticulo`),
  CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO detalle_ingreso VALUES("18","13","1","10","500.00","600.00");
INSERT INTO detalle_ingreso VALUES("19","13","4","100","1.00","2.00");
INSERT INTO detalle_ingreso VALUES("20","13","5","50","10.00","15.00");
INSERT INTO detalle_ingreso VALUES("21","14","1","1","10.00","15.00");
INSERT INTO detalle_ingreso VALUES("22","15","1","1","10.00","15.00");
INSERT INTO detalle_ingreso VALUES("23","16","1","1","10.00","15.00");
INSERT INTO detalle_ingreso VALUES("24","17","2","10","150.00","200.00");
INSERT INTO detalle_ingreso VALUES("25","18","5","10","10.00","20.00");
INSERT INTO detalle_ingreso VALUES("26","19","2","12","100.00","200.00");
INSERT INTO detalle_ingreso VALUES("27","19","1","10","200.00","400.00");
INSERT INTO detalle_ingreso VALUES("30","21","2","10","100.00","200.00");
INSERT INTO detalle_ingreso VALUES("31","21","1","10","200.00","400.00");
INSERT INTO detalle_ingreso VALUES("32","22","7","10","1000.00","2000.00");
INSERT INTO detalle_ingreso VALUES("33","22","1","10","400.00","700.00");
INSERT INTO detalle_ingreso VALUES("34","23","7","10","1500.00","2500.00");
INSERT INTO detalle_ingreso VALUES("35","24","5","100","200.00","600.00");


DROP TABLE IF EXISTS detalle_venta;

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_venta`),
  KEY `fk_detalle_venta_articulo_idx` (`idarticulo`),
  KEY `fk_detalle_venta_idx` (`idventa`),
  CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO detalle_venta VALUES("1","1","1","10","15.00","0.00");
INSERT INTO detalle_venta VALUES("2","4","2","1","303.60","0.00");
INSERT INTO detalle_venta VALUES("3","5","4","1","6.60","0.00");
INSERT INTO detalle_venta VALUES("4","6","1","1","52.60","0.60");
INSERT INTO detalle_venta VALUES("5","6","2","1","303.60","0.30");
INSERT INTO detalle_venta VALUES("6","7","5","1","25.00","0.00");
INSERT INTO detalle_venta VALUES("7","8","4","37","6.60","0.00");
INSERT INTO detalle_venta VALUES("8","8","5","18","25.00","0.00");
INSERT INTO detalle_venta VALUES("9","8","2","45","303.60","0.00");
INSERT INTO detalle_venta VALUES("10","8","1","41","52.60","0.00");
INSERT INTO detalle_venta VALUES("11","9","5","1","25.00","0.00");
INSERT INTO detalle_venta VALUES("12","9","4","1","6.60","0.00");
INSERT INTO detalle_venta VALUES("13","10","5","2","15.00","0.00");
INSERT INTO detalle_venta VALUES("14","10","1","1","600.00","50.00");
INSERT INTO detalle_venta VALUES("15","11","5","1","15.00","0.00");
INSERT INTO detalle_venta VALUES("16","12","5","1","15.00","0.00");
INSERT INTO detalle_venta VALUES("17","13","5","2","15.00","0.00");
INSERT INTO detalle_venta VALUES("18","13","4","5","2.00","0.00");
INSERT INTO detalle_venta VALUES("19","14","1","1","161.25","0.00");
INSERT INTO detalle_venta VALUES("20","15","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("21","16","5","1","15.00","0.00");
INSERT INTO detalle_venta VALUES("22","17","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("23","18","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("24","19","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("25","20","1","2","600.00","0.00");
INSERT INTO detalle_venta VALUES("26","21","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("27","22","2","3","200.00","0.00");
INSERT INTO detalle_venta VALUES("28","23","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("29","23","5","1","15.00","0.00");
INSERT INTO detalle_venta VALUES("30","24","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("31","25","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("32","26","1","2","600.00","0.00");
INSERT INTO detalle_venta VALUES("33","27","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("34","27","5","20","15.00","0.00");
INSERT INTO detalle_venta VALUES("35","28","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("36","28","1","2","600.00","0.00");
INSERT INTO detalle_venta VALUES("37","29","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("38","29","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("39","30","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("40","31","2","2","200.00","0.00");
INSERT INTO detalle_venta VALUES("41","32","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("42","33","5","5","15.00","0.00");
INSERT INTO detalle_venta VALUES("43","33","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("44","34","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("45","35","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("46","35","5","5","15.00","0.00");
INSERT INTO detalle_venta VALUES("47","35","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("48","36","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("49","37","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("50","37","4","10","2.00","0.00");
INSERT INTO detalle_venta VALUES("51","38","4","12","2.00","0.00");
INSERT INTO detalle_venta VALUES("52","38","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("53","39","5","2","15.00","0.00");
INSERT INTO detalle_venta VALUES("54","39","4","30","2.00","0.00");
INSERT INTO detalle_venta VALUES("55","39","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("56","40","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("57","41","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("58","42","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("59","43","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("60","44","2","2","200.00","0.00");
INSERT INTO detalle_venta VALUES("61","45","7","3","1000.00","0.00");
INSERT INTO detalle_venta VALUES("62","46","2","2","200.00","0.00");
INSERT INTO detalle_venta VALUES("63","47","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("64","48","4","1","2.00","0.00");
INSERT INTO detalle_venta VALUES("65","49","5","10","15.00","0.00");
INSERT INTO detalle_venta VALUES("66","50","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("67","51","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("68","52","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("69","53","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("70","54","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("71","55","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("72","56","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("73","56","4","2","2.00","0.00");
INSERT INTO detalle_venta VALUES("74","56","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("75","57","1","3","600.00","0.00");
INSERT INTO detalle_venta VALUES("76","58","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("77","58","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("78","59","4","5","2.00","0.00");
INSERT INTO detalle_venta VALUES("79","59","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("80","60","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("81","61","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("82","62","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("83","63","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("84","64","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("85","64","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("86","65","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("87","66","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("88","66","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("89","67","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("90","68","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("91","69","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("92","69","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("93","70","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("94","71","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("95","72","5","3","15.00","0.00");
INSERT INTO detalle_venta VALUES("96","73","7","2","1000.00","0.00");
INSERT INTO detalle_venta VALUES("97","74","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("98","74","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("99","74","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("100","75","4","10","2.00","0.00");
INSERT INTO detalle_venta VALUES("101","76","5","1","15.00","0.00");
INSERT INTO detalle_venta VALUES("102","76","1","1","600.00","0.00");
INSERT INTO detalle_venta VALUES("103","77","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("104","78","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("105","78","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("106","79","4","5","2.00","0.00");
INSERT INTO detalle_venta VALUES("107","80","2","1","200.00","0.00");
INSERT INTO detalle_venta VALUES("108","80","7","1","1000.00","0.00");
INSERT INTO detalle_venta VALUES("109","81","7","10","1000.00","0.00");
INSERT INTO detalle_venta VALUES("110","82","5","2","600.00","0.00");


DROP TABLE IF EXISTS ingreso;

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL AUTO_INCREMENT,
  `idproveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`idingreso`),
  KEY `fk_ingreso_persona_idx` (`idproveedor`),
  CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idproveedor`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO ingreso VALUES("3","5","Boleta","001","001","2016-08-19 22:19:34","18.00","A");
INSERT INTO ingreso VALUES("4","6","Boleta","001","0001","2016-08-30 16:19:48","18.00","A");
INSERT INTO ingreso VALUES("5","5","Factura","001","00004","2016-08-30 16:29:00","18.00","A");
INSERT INTO ingreso VALUES("6","5","Boleta","001","0001","2016-08-31 11:02:43","18.00","A");
INSERT INTO ingreso VALUES("7","5","Boleta","001","0008","2016-08-31 11:22:33","18.00","A");
INSERT INTO ingreso VALUES("8","5","Boleta","001","0001","2016-08-31 11:37:20","18.00","A");
INSERT INTO ingreso VALUES("9","5","Boleta","007","0008","2016-08-31 15:37:16","18.00","A");
INSERT INTO ingreso VALUES("10","6","Factura","001","001","2016-09-01 16:33:03","18.00","A");
INSERT INTO ingreso VALUES("11","5","Boleta","001","0003","2016-09-01 17:00:51","18.00","A");
INSERT INTO ingreso VALUES("12","5","Boleta","001","00077","2016-09-27 15:19:58","18.00","A");
INSERT INTO ingreso VALUES("13","5","Boleta","001","00002","2016-09-29 16:12:58","18.00","A");
INSERT INTO ingreso VALUES("14","5","Boleta","001","0002","2016-10-02 13:42:22","0.00","A");
INSERT INTO ingreso VALUES("15","5","Boleta","002","0003","2016-10-02 13:43:51","18.00","A");
INSERT INTO ingreso VALUES("16","5","Ticket","001","0005","2016-10-02 13:44:13","0.00","A");
INSERT INTO ingreso VALUES("17","5","Boleta","001","000155","2016-11-01 10:38:48","18.00","A");
INSERT INTO ingreso VALUES("18","5","Boleta","0001","1233","2016-12-12 08:34:03","0.00","A");
INSERT INTO ingreso VALUES("19","5","Boleta","0011","5666","2016-12-21 07:43:00","0.00","A");
INSERT INTO ingreso VALUES("20","6","Ticket","001","456","2016-12-28 14:42:31","0.00","C");
INSERT INTO ingreso VALUES("21","5","Ticket","001","93884","2017-01-03 13:43:30","18.00","C");
INSERT INTO ingreso VALUES("22","6","Ticket","001","456","2017-01-25 08:56:21","0.00","A");
INSERT INTO ingreso VALUES("23","5","Boleta","001","3322","2017-01-25 10:11:30","0.00","A");
INSERT INTO ingreso VALUES("24","5","Boleta","009","8876","2017-01-25 10:43:15","0.00","A");


DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO migrations VALUES("2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2014_10_12_100000_create_password_resets_table","1");


DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO password_resets VALUES("dav.lazarte@gmail.com","dbeef11776106887ca8538fb80c361a334be9ee4ad6e038185b8bb06ce5c5a1e","2016-12-28 18:36:20");


DROP TABLE IF EXISTS persona;

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_persona` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO persona VALUES("1","Cliente","Ana Montenegro","DNI","74125863","Margaritas 1368 - Chiclayo","","");
INSERT INTO persona VALUES("2","Inactivo","Juan Perez","DNI","36985214","","","");
INSERT INTO persona VALUES("3","Cliente","Jose Martinez","PAS","0174589632","José Gálvez 1368 - Trujillo","96325871","jose@gmail.com");
INSERT INTO persona VALUES("4","Cliente","Juan Carlos Arcila","DNI","47715777","José Gálvez 1368","","jcarlos.ad7@gmail.com");
INSERT INTO persona VALUES("5","Proveedor","Soluciones Innovadoras Perú S.A.C","RUC","20600121234","Chiclayo 0123","931742904","informes.solinperu@gmail.com");
INSERT INTO persona VALUES("6","Proveedor","Inversiones SantaAna S.A.C","RUC","20546231478","Chongoyape 01","074963258","santaana@gmail.com");
INSERT INTO persona VALUES("7","Cliente","Diaz walter","DNI","36667742","monteros","984993020","walterjunior@gmail.com");
INSERT INTO persona VALUES("8","Cliente","Lazarte David","DNI","36527542","los sosa","38635895","dav.lazar@gmail.com");


DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("1","Juan Carlos","jcarlos.ad7@gmail.com","$2y$10$lfhJB1OGVFl2z6a0BGe7LuiyzdpkQbiX49B8Bbt21lU9QUU8zrUii","UQBlGKJeoltwG5Xi6P4O3bQj3Xq9NqJ1fXVwMAUm82CHiotswgl6KxzC1pby","2016-10-24 18:33:02","2016-12-12 06:58:47");
INSERT INTO users VALUES("3","Luis","luis.pad7@gmail.com","$2y$10$aNkfXGczdX/sYxHfH2vZb.MrZyJA/xFkHiizaX7Sddl7SUQoaAEpe","","2016-10-24 21:37:20","2016-10-24 21:37:20");
INSERT INTO users VALUES("4","David Lazarte","dav.lazarte@gmail.com","$2y$10$vjAXs55vVqQwkZ7fQ8FXwehs9YNOqS7ZvjkiUH0qtLXdiLXESlZLe","YJqQ3F9sLTEa1tcDvKx2CsBcEcttjiMFk5ALow495tcQhKTtCQSuKEjjYCpr","2016-12-14 16:10:54","2017-01-24 17:03:02");


DROP TABLE IF EXISTS venta;

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `num_comprobante` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `sena` decimal(11,2) NOT NULL,
  `cuota` decimal(11,2) NOT NULL,
  `fecha_cuota` datetime NOT NULL,
  `saldo` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_cliente_idx` (`idcliente`),
  CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO venta VALUES("1","1","Boleta","001","0001","2016-09-01 00:00:00","18.00","120.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("3","1","Boleta","001","0005","2016-09-28 15:42:43","18.00","303.60","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("4","1","Boleta","001","0005","2016-09-28 15:43:02","18.00","303.60","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("5","3","Boleta","001","0005","2016-09-28 15:43:17","18.00","6.60","0.00","0.00","0000-00-00 00:00:00","0.00","C");
INSERT INTO venta VALUES("6","6","Boleta","001","0002","2016-09-28 15:44:02","18.00","355.30","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("7","1","Boleta","001","00002","2016-09-28 16:16:35","18.00","25.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("8","1","Boleta","007","777","2016-09-28 16:18:15","18.00","16512.80","0.00","0.00","0000-00-00 00:00:00","0.00","C");
INSERT INTO venta VALUES("9","4","Boleta","001","00005","2016-09-28 22:23:28","18.00","31.60","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("10","3","Factura","001","0008","2016-09-29 16:54:13","18.00","580.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("11","1","Factura","001","0005","2016-10-02 13:46:13","18.00","15.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("12","1","Boleta","001","0007","2016-10-02 13:46:38","0.00","15.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("13","3","Factura","007","00077","2016-10-02 14:25:12","18.00","40.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("14","1","Factura","001","00010","2016-11-01 10:39:26","18.00","161.25","0.00","0.00","0000-00-00 00:00:00","0.00","C");
INSERT INTO venta VALUES("15","1","Boleta","001","233","2016-12-12 07:49:09","0.00","200.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("16","1","Ticket","002","455","2016-12-12 11:55:05","0.00","15.00","10.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("17","3","Factura","011","9988","2016-12-12 14:30:58","21.00","200.00","150.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("18","3","Seña o Cc","001","98","2016-12-20 09:00:46","0.00","200.00","100.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("19","1","Seña o Cc","001","344","2016-12-20 09:50:47","0.00","200.00","100.00","0.00","0000-00-00 00:00:00","200.00","A");
INSERT INTO venta VALUES("20","3","Seña o Cc","001","988","2016-12-20 09:55:30","0.00","1200.00","200.00","0.00","0000-00-00 00:00:00","1200.00","A");
INSERT INTO venta VALUES("21","1","Seña o Cc","001","909","2016-12-20 10:05:08","0.00","200.00","100.00","0.00","0000-00-00 00:00:00","200.00","A");
INSERT INTO venta VALUES("22","1","Contado","001","098","2016-12-20 10:19:52","0.00","600.00","200.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("23","3","Seña o Cc","001","9999","2016-12-20 10:22:43","0.00","615.00","500.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("24","1","Seña o Cc","001","9997","2016-12-20 10:28:53","0.00","200.00","100.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("25","4","Seña o Cc","001","7655","2016-12-20 10:30:00","0.00","600.00","300.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("26","1","Seña o Cc","001","899","2016-12-20 10:45:40","0.00","1200.00","400.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("27","1","Seña o Cc","001","987","2016-12-20 21:26:15","0.00","500.00","200.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("28","4","Seña o Cc","001","001233","2016-12-21 09:44:10","0.00","1400.00","400.00","0.00","0000-00-00 00:00:00","1400.00","A");
INSERT INTO venta VALUES("29","1","Seña o Cc","001","8899","2016-12-21 09:46:09","0.00","800.00","300.00","0.00","0000-00-00 00:00:00","700.00","A");
INSERT INTO venta VALUES("30","1","Seña o Cc","001","567","2016-12-21 09:57:50","0.00","600.00","200.00","0.00","0000-00-00 00:00:00","500.00","A");
INSERT INTO venta VALUES("31","1","Contado","001","987","2016-12-21 09:58:53","0.00","400.00","200.00","0.00","0000-00-00 00:00:00","100.00","A");
INSERT INTO venta VALUES("32","3","Seña o Cc","001","9876","2016-12-21 10:03:00","0.00","200.00","150.00","0.00","0000-00-00 00:00:00","50.00","A");
INSERT INTO venta VALUES("33","4","Seña o Cc","001","8976","2016-12-21 10:34:56","0.00","675.00","0.00","0.00","0000-00-00 00:00:00","475.00","C");
INSERT INTO venta VALUES("34","1","Contado","001","7683","2016-12-26 09:59:40","0.00","600.00","1000.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("35","4","Seña o Cc","001","9877","2016-12-28 15:28:57","0.00","875.00","750.00","0.00","0000-00-00 00:00:00","125.00","A");
INSERT INTO venta VALUES("36","7","Seña o Cc","001","678","2016-12-28 16:46:48","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","C");
INSERT INTO venta VALUES("37","1","Seña o Cc","001","98976","2016-12-28 16:51:34","0.00","620.00","0.00","0.00","0000-00-00 00:00:00","0.00","A");
INSERT INTO venta VALUES("38","7","Seña o Cc","001","8990","2016-12-28 16:57:29","0.00","224.00","224.00","0.00","0000-00-00 00:00:00","0.00","C");
INSERT INTO venta VALUES("39","7","Seña o Cc","001","988","2016-12-28 16:58:35","0.00","1090.00","0.00","0.00","0000-00-00 00:00:00","0.00","CANCELADO");
INSERT INTO venta VALUES("40","7","Seña o Cc","001","00987","2016-12-28 17:14:58","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","CANCELADO");
INSERT INTO venta VALUES("41","1","Contado","001","0987","2016-12-28 17:15:32","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","CANCEL");
INSERT INTO venta VALUES("42","8","Contado","001","44444","2016-12-28 17:18:14","0.00","200.00","200.00","0.00","0000-00-00 00:00:00","0.00","CANCELADO");
INSERT INTO venta VALUES("43","8","Contado","001","9888","2016-12-28 17:19:45","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","CANCELADO");
INSERT INTO venta VALUES("44","7","Seña o Cc","001","8765","2016-12-28 17:42:52","0.00","400.00","0.00","0.00","0000-00-00 00:00:00","0.00","CANCELADO");
INSERT INTO venta VALUES("45","8","Seña o Cc","001","87689","2016-12-28 17:45:20","0.00","3000.00","0.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("46","1","Seña o Cc","001","7788","2016-12-28 17:49:10","0.00","400.00","0.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("47","3","Seña o Cc","001","98765","2016-12-28 17:50:45","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("48","1","Seña o Cc","001","899","2016-12-28 17:58:34","0.00","2.00","2.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("49","7","Seña o Cc","001","988","2016-12-28 18:00:38","0.00","150.00","150.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("50","7","Contado","001","9877","2016-12-28 18:24:31","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("51","1","Tarjeta","001","8999","2016-12-28 18:26:54","21.00","600.00","600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("52","1","Seña o Cc","001","987","2016-12-28 18:45:16","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("53","7","Seña o Cc","001","0988","2017-01-03 14:57:15","0.00","600.00","600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("54","8","Contado","001","9887","2017-01-03 15:33:44","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("55","8","Contado","001","9889","2017-01-03 16:11:00","0.00","200.00","200.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("56","7","Tarjeta","001","098098","2017-01-03 16:14:00","21.00","1604.00","0.00","0.00","0000-00-00 00:00:00","1604.00","debe");
INSERT INTO venta VALUES("57","1","Seña o Cc","001","876","2017-01-03 16:28:56","0.00","1800.00","1500.00","100.00","2017-01-06 14:58:51","300.00","debe");
INSERT INTO venta VALUES("58","7","Seña o Cc","001","09876","2017-01-03 16:32:42","0.00","1600.00","1600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("59","4","Contado","001","66666","2017-01-04 16:38:01","0.00","210.00","210.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("60","1","Tarjeta","001","222222","2017-01-04 16:38:43","21.00","600.00","600.00","100.00","2017-01-05 12:13:49","0.00","cancelado");
INSERT INTO venta VALUES("61","7","Seña o Cc","001","9999","2017-01-04 16:39:41","0.00","1000.00","1000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("62","7","Seña o Cc","001","78987","2017-01-04 10:02:59","0.00","600.00","600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("63","1","Seña o Cc","001","988766","2017-01-05 10:41:16","0.00","600.00","700.00","0.00","0000-00-00 00:00:00","-100.00","debe");
INSERT INTO venta VALUES("64","7","Seña o Cc","001","9887","2017-01-04 10:52:41","0.00","1200.00","1200.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("65","1","Seña o Cc","001","0022","2017-01-05 12:03:33","0.00","600.00","600.00","100.00","2017-01-06 14:52:42","0.00","cancelado");
INSERT INTO venta VALUES("66","8","Seña o Cc","001","9865","2017-01-05 12:12:28","0.00","1200.00","1200.00","700.00","2017-01-05 14:41:38","0.00","cancelado");
INSERT INTO venta VALUES("67","1","Contado","001","4566","2017-01-05 12:13:10","0.00","600.00","600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("68","7","Seña o Cc","001","67788","2017-01-05 14:45:16","0.00","200.00","200.00","150.00","2017-01-06 14:51:52","0.00","cancelado");
INSERT INTO venta VALUES("69","8","Seña o Cc","001","7890","2017-01-06 14:55:22","0.00","1600.00","1600.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("70","4","Seña o Cc","001","9848","2017-01-06 14:57:00","0.00","600.00","400.00","200.00","2017-01-19 17:04:45","200.00","debe");
INSERT INTO venta VALUES("71","1","Seña o Cc","001","6738","2017-01-19 17:06:14","0.00","200.00","100.00","0.00","0000-00-00 00:00:00","100.00","debe");
INSERT INTO venta VALUES("72","1","Contado","001","8997","2017-01-19 17:38:13","0.00","45.00","45.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("73","7","Contado","001","9885","2017-01-20 09:17:57","0.00","2000.00","2000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("74","8","Contado","001","8997","2017-01-20 09:49:28","0.00","1800.00","1800.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("75","1","Tarjeta","001","453663","2017-01-20 11:03:33","21.00","20.00","0.00","0.00","0000-00-00 00:00:00","20.00","debe");
INSERT INTO venta VALUES("76","7","Seña o Cc","001","34456","2017-01-20 11:04:09","0.00","615.00","300.00","0.00","0000-00-00 00:00:00","315.00","debe");
INSERT INTO venta VALUES("77","1","Tarjeta","001","Visa","2017-01-24 16:30:38","21.00","1000.00","0.00","0.00","0000-00-00 00:00:00","1000.00","debe");
INSERT INTO venta VALUES("78","8","Tarjeta","001","Mastercard","2017-01-24 16:36:02","21.00","1200.00","0.00","0.00","0000-00-00 00:00:00","1200.00","debe");
INSERT INTO venta VALUES("79","1","Contado","001"," ","2017-01-24 16:55:46","0.00","10.00","10.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("80","7","Tarjeta","001","Visa","2017-01-25 08:48:42","21.00","1200.00","0.00","0.00","0000-00-00 00:00:00","1200.00","debe");
INSERT INTO venta VALUES("81","8","Contado","001"," ","2017-01-25 09:48:29","0.00","10000.00","10000.00","0.00","0000-00-00 00:00:00","0.00","cancelado");
INSERT INTO venta VALUES("82","1","Contado","001"," ","2017-01-25 10:43:48","0.00","1200.00","1200.00","0.00","0000-00-00 00:00:00","0.00","cancelado");


