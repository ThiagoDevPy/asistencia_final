CREATE DATABASE  IF NOT EXISTS `railway` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `railway`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: autorack.proxy.rlwy.net    Database: railway
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asistencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empleado_id` int NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(28) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_evento` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empelado_id` (`empleado_id`),
  KEY `fk_evento_id` (`id_evento`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
INSERT INTO `asistencias` VALUES (1,4,'19:12:12','2024-04-11','ENTRADA',1),(2,4,'19:12:12','2025-04-11','ENTRADA',2),(3,4,'23:39:00','2024-10-05','SALIDA',2),(4,4,'23:40:00','2024-10-05','SALIDA',1),(5,5,'23:41:01','2024-10-05','ENTRADA',2),(6,5,'23:42:00','2024-10-05','SALIDA',2),(7,6,'23:46:00','2024-10-05','ENTRADA',1),(8,6,'23:46:00','2024-10-05','SALIDA',1),(9,7,'22:05:00','2024-10-06','ENTRADA',1),(10,4,'04:12:00','2024-10-07','ENTRADA',3),(11,8,'10:02:00','2024-10-07','ENTRADA',1),(12,8,'10:03:00','2024-10-07','SALIDA',1),(13,4,'14:32:00','2024-10-07','SALIDA',3);
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `documento_numero` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codigo` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carrera` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (4,'Thiago Fabrizzio Sebastian','Saldivar Adarmes','7135809','0976530853',NULL,'Ingenieria Informatica'),(5,'Santiago Tomas','Saldivar Adarmes','7135808','0971639141',NULL,'Ingienieria informatica'),(6,'Milagros Asuncion','Saldivar Adarmes','6155739','0985643525',NULL,'ingeniería comercial'),(7,'Manuel','Aquino','5786978','0972572580',NULL,'Fortnite'),(8,'Aracely Montserrat','Ayala Benítez','5555296','0984185102',NULL,'Ingeniería en Informática');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,'simposio 4','2024-10-17',1),(2,'simposio 2','2025-11-12',0),(3,'simposio 3','2024-12-07',1);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qr`
--

DROP TABLE IF EXISTS `qr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qr_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qr`
--

LOCK TABLES `qr` WRITE;
/*!40000 ALTER TABLE `qr` DISABLE KEYS */;
INSERT INTO `qr` VALUES (1,'6701a5fb906e8','utilizado','2024-10-05 20:47:55'),(2,'6701a675a2959','utilizado','2024-10-05 20:49:57'),(3,'6701a6edf0e09','utilizado','2024-10-05 20:51:58'),(4,'6701a765a8f55','utilizado','2024-10-05 20:53:57'),(5,'6701a7de8e9ca','utilizado','2024-10-05 20:55:58'),(6,'6701a85a923be','utilizado','2024-10-05 20:58:02'),(7,'6701a8cdd9de9','utilizado','2024-10-05 20:59:58'),(8,'6701a94607d71','utilizado','2024-10-05 21:01:58'),(9,'6701a9bdf2b50','utilizado','2024-10-05 21:03:58'),(10,'6701aa35dd579','utilizado','2024-10-05 21:05:58'),(11,'6701aaade8636','utilizado','2024-10-05 21:07:58'),(12,'6701ab25e66a2','no utilizado','2024-10-05 21:09:58'),(13,'6702009c1f54b','no utilizado','2024-10-06 03:14:36'),(14,'670200c9afa99','utilizado','2024-10-06 03:15:21'),(15,'6702014384c0a','utilizado','2024-10-06 03:17:23'),(16,'670201bb82223','utilizado','2024-10-06 03:19:23'),(17,'6702023398425','utilizado','2024-10-06 03:21:23'),(18,'670203903f32d','utilizado','2024-10-06 03:27:12'),(19,'670204078c5c6','utilizado','2024-10-06 03:29:11'),(20,'6702047f8bbc5','utilizado','2024-10-06 03:31:11'),(21,'670205b885aea','utilizado','2024-10-06 03:36:24'),(22,'670206b5de4d4','utilizado','2024-10-06 03:40:38'),(23,'670206f9ad5b5','no utilizado','2024-10-06 03:41:45'),(24,'6702072cf2778','no utilizado','2024-10-06 03:42:37'),(25,'6702072f751eb','utilizado','2024-10-06 03:42:39'),(26,'67020803bfef3','no utilizado','2024-10-06 03:46:12'),(27,'6702080c4ccbd','utilizado','2024-10-06 03:46:20'),(28,'67023a2f983cf','no utilizado','2024-10-06 07:20:15'),(29,'670332d6b355a','utilizado','2024-10-07 01:01:10'),(30,'67033341477a6','no utilizado','2024-10-07 01:02:57'),(31,'6703335132d35','utilizado','2024-10-07 01:03:13'),(32,'67033364c5a95','no utilizado','2024-10-07 01:03:33'),(33,'670333c821f5a','no utilizado','2024-10-07 01:05:12'),(34,'670333cda6efc','utilizado','2024-10-07 01:05:17'),(35,'6703344133434','no utilizado','2024-10-07 01:07:13'),(36,'67035bb40ec02','no utilizado','2024-10-07 03:55:32'),(37,'67035c76b7c7d','no utilizado','2024-10-07 03:58:46'),(38,'670388e5a3fa8','utilizado','2024-10-07 07:08:21'),(39,'6703896736951','no utilizado','2024-10-07 07:10:31'),(40,'6703dbccd51a6','no utilizado','2024-10-07 13:02:05'),(41,'6703dc200b05f','no utilizado','2024-10-07 13:03:28'),(42,'67040e60aba68','no utilizado','2024-10-07 16:37:52'),(43,'67041079b32f0','no utilizado','2024-10-07 16:46:49'),(44,'670410b483f93','no utilizado','2024-10-07 16:47:48'),(45,'67041100ce299','no utilizado','2024-10-07 16:49:04'),(46,'6704111bb5e64','no utilizado','2024-10-07 16:49:31'),(47,'670411b307731','no utilizado','2024-10-07 16:52:02'),(48,'67041213a97c1','utilizado','2024-10-07 16:53:39'),(49,'6704128f13c89','utilizado','2024-10-07 16:55:42'),(50,'670413063f670','no utilizado','2024-10-07 16:57:41'),(51,'67041317a25a5','utilizado','2024-10-07 16:57:59'),(52,'6704139237e66','utilizado','2024-10-07 17:00:02'),(53,'6704140a0a302','no utilizado','2024-10-07 17:02:02'),(54,'6704150de525c','utilizado','2024-10-07 17:06:22'),(55,'6704158c98ebb','utilizado','2024-10-07 17:08:28'),(56,'670415ffe093b','utilizado','2024-10-07 17:10:24'),(57,'670416780b877','utilizado','2024-10-07 17:12:24'),(58,'670416f00e8fa','utilizado','2024-10-07 17:14:24'),(59,'670417684040b','utilizado','2024-10-07 17:16:24'),(60,'670417e05738d','utilizado','2024-10-07 17:18:24'),(61,'67041858373bc','utilizado','2024-10-07 17:20:24'),(62,'670418cfba019','utilizado','2024-10-07 17:22:23'),(63,'6704194832dc9','utilizado','2024-10-07 17:24:24'),(64,'670419c08f2e0','utilizado','2024-10-07 17:26:24'),(65,'67041a38a7ffc','utilizado','2024-10-07 17:28:24'),(66,'67041ab031d28','utilizado','2024-10-07 17:30:24'),(67,'67041b280b8bc','utilizado','2024-10-07 17:32:24'),(68,'67041ba0f32c6','utilizado','2024-10-07 17:34:25'),(69,'67041c17e5a8e','utilizado','2024-10-07 17:36:24'),(70,'67041c8ff33a7','utilizado','2024-10-07 17:38:24'),(71,'67041d088066b','utilizado','2024-10-07 17:40:24'),(72,'67041d7fefea8','utilizado','2024-10-07 17:42:24'),(73,'67041df81382b','utilizado','2024-10-07 17:44:24'),(74,'67041e702ddb2','utilizado','2024-10-07 17:46:24'),(75,'67041eec9f1f8','utilizado','2024-10-07 17:48:28'),(76,'67041f5fcab35','utilizado','2024-10-07 17:50:24'),(77,'67041fd7aba3b','utilizado','2024-10-07 17:52:23'),(78,'6704204fc77ff','utilizado','2024-10-07 17:54:24'),(79,'670420c84bce7','utilizado','2024-10-07 17:56:24'),(80,'6704213fa60de','utilizado','2024-10-07 17:58:23'),(81,'670421b79c8e8','utilizado','2024-10-07 18:00:23'),(82,'6704223002bb7','utilizado','2024-10-07 18:02:24'),(83,'670422a80f93e','utilizado','2024-10-07 18:04:24'),(84,'670423200efc1','utilizado','2024-10-07 18:06:24'),(85,'670423980ee8a','utilizado','2024-10-07 18:08:24'),(86,'67042410072ed','utilizado','2024-10-07 18:10:24'),(87,'6704248c488c0','utilizado','2024-10-07 18:12:28'),(88,'670425003813b','utilizado','2024-10-07 18:14:24'),(89,'67042577ab6af','no utilizado','2024-10-07 18:16:23');
/*!40000 ALTER TABLE `qr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','apellidos','admin','admin@admin.com','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','1726789670.png',0),(2,'Sebastian','Saldivar','sebas','sebastiansaldivar092@gmail.com','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','1726758482.jpg',1),(3,'sebas','saldivar','sebas1','sebas@sebas.com','$2y$10$TiSMFK7C9syPLD4c22K6fOBYZdFwDbFy.j51BmRGq3o06IrxrGCBi','1726766494.jpg',1),(4,'Manu','Aquino','eymaanu','aquimanuel8@gmail.com','$2y$10$aLITm5O0QGD9OSkMnPWspO5c5Ich8VOrwXf.fedcHrWB3X//k3Dlm','',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'railway'
--

--
-- Dumping routines for database 'railway'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-07 15:18:43
