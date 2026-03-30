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
-- Table structure for table `entradadoacao`
--

DROP TABLE IF EXISTS `entradadoacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entradadoacao` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `codpet` int NOT NULL,
  `codVet` int NOT NULL,
  `datent` date NOT NULL,
  `horent` time NOT NULL,
  `datres` date NOT NULL,
  `horres` time NOT NULL,
  `datven` date NOT NULL,
  `codlot` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `obsdoc` varchar(3000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qtdcol` decimal(7,3) NOT NULL,
  `codtip` int NOT NULL,
  `sitcol` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codigo`),
  KEY `fk_pet` (`codpet`),
  KEY `fk_veterinario` (`codVet`),
  KEY `fk_tipo_sanguineo` (`codtip`),
  CONSTRAINT `fk_pet` FOREIGN KEY (`codpet`) REFERENCES `pet` (`codigo`),
  CONSTRAINT `fk_tipo_sanguineo` FOREIGN KEY (`codtip`) REFERENCES `tiposanguineo` (`codigo`),
  CONSTRAINT `fk_veterinario` FOREIGN KEY (`codVet`) REFERENCES `veterinario` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradadoacao`
--

LOCK TABLES `entradadoacao` WRITE;
/*!40000 ALTER TABLE `entradadoacao` DISABLE KEYS */;
INSERT INTO `entradadoacao` VALUES (1,1,1,'2026-06-05','10:00:00','2026-06-05','10:00:00','2027-06-05','20260625-001',NULL,225.000,1,'A'),(2,1,1,'2026-03-28','19:30:00','2026-03-28','23:33:53','2026-03-28','20260329-001','',33.000,9,'I'),(3,1,1,'2026-03-28','21:42:00','2026-03-29','01:44:49','2026-04-11','20260329-002','teste',13.000,9,'A'),(4,6,1,'2026-03-29','18:37:00','2026-03-29','23:37:52','2026-05-29','20260329-001','',25.000,1,'A'),(5,6,1,'2026-03-29','18:37:00','2026-03-29','23:38:40','2026-05-29','20260329-002','',25.000,1,'A'),(6,6,1,'2026-03-29','18:37:00','2026-03-29','23:41:36','2026-05-29','20260329-003','',25.000,1,'A'),(7,6,1,'2026-03-29','18:37:00','2026-03-29','23:42:32','2026-05-29','20260329-004','',25.000,1,'A'),(8,1,1,'2026-03-29','18:37:00','2026-03-29','23:45:35','2026-05-29','20260329-005','',25.000,9,'A');
/*!40000 ALTER TABLE `entradadoacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-29 21:48:20
