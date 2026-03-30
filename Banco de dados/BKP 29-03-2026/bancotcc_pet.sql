-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: bancotcc
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pet` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dtFalecimento` date DEFAULT NULL,
  `dtNascimento` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `doador` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `comportamento` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codTutor` int DEFAULT NULL,
  `codRaca` int DEFAULT NULL,
  `codTipoSanguineo` int DEFAULT NULL,
  `codEspecie` int DEFAULT NULL,
  `caracteristicas` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_pet_tutor` (`codTutor`),
  KEY `fk_pet_raca` (`codRaca`),
  KEY `fk_pet_TipoSanguineo` (`codTipoSanguineo`),
  KEY `fk_pet_especie` (`codEspecie`),
  CONSTRAINT `fk_pet_especie` FOREIGN KEY (`codEspecie`) REFERENCES `especie` (`codigo`),
  CONSTRAINT `fk_pet_raca` FOREIGN KEY (`codRaca`) REFERENCES `raca` (`codigo`),
  CONSTRAINT `fk_pet_TipoSanguineo` FOREIGN KEY (`codTipoSanguineo`) REFERENCES `tiposanguineo` (`codigo`),
  CONSTRAINT `fk_pet_tutor` FOREIGN KEY (`codTutor`) REFERENCES `tutor` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (1,'Animal 1',NULL,'2024-01-01','M','S','Calmo',1,1,9,1,'teste2'),(3,'Animal 2',NULL,'2020-09-08','F','N','calmo',2,2,1,3,'teste 3'),(4,'Animal 5',NULL,'2025-12-03','F','N','Calmo',1,1,7,1,'teste'),(5,'animal teste',NULL,'2025-12-03','F','N','Calmo',2,2,1,3,'teste'),(6,'nome 2',NULL,'2025-01-01','F','S','Calmo',1,2,1,3,'teste');
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-29 21:48:21
