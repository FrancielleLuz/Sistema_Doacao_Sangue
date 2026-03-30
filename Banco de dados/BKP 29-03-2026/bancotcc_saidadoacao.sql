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
-- Table structure for table `saidadoacao`
--

DROP TABLE IF EXISTS `saidadoacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saidadoacao` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `codentdoa` int NOT NULL,
  `codpet` int NOT NULL,
  `codpetrec` int NOT NULL,
  `codvet` int NOT NULL,
  `datasaida` date NOT NULL,
  `horasaida` time NOT NULL,
  `qtdsaida` decimal(10,2) NOT NULL,
  `obsdoc` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitcol` char(1) COLLATE utf8mb4_general_ci DEFAULT 'A',
  `datres` date NOT NULL,
  `horres` time NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `uk_saida_entrada` (`codentdoa`),
  KEY `fk_saida_pet_doador` (`codpet`),
  KEY `fk_saida_pet_receptor` (`codpetrec`),
  KEY `fk_saida_veterinario` (`codvet`),
  CONSTRAINT `fk_saida_entrada` FOREIGN KEY (`codentdoa`) REFERENCES `entradadoacao` (`codigo`),
  CONSTRAINT `fk_saida_pet_doador` FOREIGN KEY (`codpet`) REFERENCES `pet` (`codigo`),
  CONSTRAINT `fk_saida_pet_receptor` FOREIGN KEY (`codpetrec`) REFERENCES `pet` (`codigo`),
  CONSTRAINT `fk_saida_veterinario` FOREIGN KEY (`codvet`) REFERENCES `veterinario` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saidadoacao`
--

LOCK TABLES `saidadoacao` WRITE;
/*!40000 ALTER TABLE `saidadoacao` DISABLE KEYS */;
INSERT INTO `saidadoacao` VALUES (1,1,1,6,1,'2026-03-29','03:11:38',25.00,'','A','2026-03-29','03:11:38'),(2,5,6,1,1,'2026-03-30','00:08:33',25.00,'','A','2026-03-30','00:08:33'),(3,6,6,1,1,'2026-03-30','00:14:54',25.00,'','I','2026-03-30','00:14:54');
/*!40000 ALTER TABLE `saidadoacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-29 21:48:22
