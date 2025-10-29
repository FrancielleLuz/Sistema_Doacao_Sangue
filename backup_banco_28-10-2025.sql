CREATE DATABASE  IF NOT EXISTS `bancotcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bancotcc`;
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
-- Table structure for table `cidadeestado`
--

DROP TABLE IF EXISTS `cidadeestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidadeestado` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `cidade` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_estado` (`estado`),
  CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidadeestado`
--

LOCK TABLES `cidadeestado` WRITE;
/*!40000 ALTER TABLE `cidadeestado` DISABLE KEYS */;
INSERT INTO `cidadeestado` VALUES (1,'Blumenau',1),(2,'Gaspar',1);
/*!40000 ALTER TABLE `cidadeestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica`
--

DROP TABLE IF EXISTS `clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clinica` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `usuAdm` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `cnpj` bigint NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `cidadeestado` int NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `uk_telefone` (`telefone`),
  KEY `fk_cidadeestado` (`cidadeestado`),
  CONSTRAINT `fk_cidadeestado` FOREIGN KEY (`cidadeestado`) REFERENCES `cidadeestado` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica`
--

LOCK TABLES `clinica` WRITE;
/*!40000 ALTER TABLE `clinica` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doenca`
--

DROP TABLE IF EXISTS `doenca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doenca` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doenca`
--

LOCK TABLES `doenca` WRITE;
/*!40000 ALTER TABLE `doenca` DISABLE KEYS */;
INSERT INTO `doenca` VALUES (2,'Peritonite Infecciosa Felina (PIF)','Doença viral grave causada por mutação do coronavírus felino, geralmente fatal'),(3,'Doença Renal Crônica','Comprometimento gradual dos rins, comum em gatos mais velhos, levando à insuficiência renal.'),(4,'Leucemia Felina (FeLV)','Vírus que afeta o sistema imunológico, podendo causar anemia, infecções e câncer.');
/*!40000 ALTER TABLE `doenca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doencapet`
--

DROP TABLE IF EXISTS `doencapet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doencapet` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doenca` int NOT NULL,
  `pet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `doencapet_doenca_FK` (`doenca`),
  KEY `doencapet_pet_FK` (`pet`),
  CONSTRAINT `doencapet_doenca_FK` FOREIGN KEY (`doenca`) REFERENCES `doenca` (`codigo`),
  CONSTRAINT `doencapet_pet_FK` FOREIGN KEY (`pet`) REFERENCES `pet` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doencapet`
--

LOCK TABLES `doencapet` WRITE;
/*!40000 ALTER TABLE `doencapet` DISABLE KEYS */;
/*!40000 ALTER TABLE `doencapet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradadoacao`
--

DROP TABLE IF EXISTS `entradadoacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entradadoacao` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `pet` int NOT NULL,
  `clinica` int DEFAULT NULL,
  `sangue` double DEFAULT NULL,
  `datae` date DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_pet` (`pet`),
  KEY `fk_clin` (`clinica`),
  CONSTRAINT `fk_clin` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`codigo`),
  CONSTRAINT `fk_pet` FOREIGN KEY (`pet`) REFERENCES `pet` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradadoacao`
--

LOCK TABLES `entradadoacao` WRITE;
/*!40000 ALTER TABLE `entradadoacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradadoacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especie`
--

DROP TABLE IF EXISTS `especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especie` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especie`
--

LOCK TABLES `especie` WRITE;
/*!40000 ALTER TABLE `especie` DISABLE KEYS */;
INSERT INTO `especie` VALUES (1,'Cachorro'),(3,'Gato');
/*!40000 ALTER TABLE `especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `abreviacao` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'SANTA CATARINA','SC');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame`
--

DROP TABLE IF EXISTS `exame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame`
--

LOCK TABLES `exame` WRITE;
/*!40000 ALTER TABLE `exame` DISABLE KEYS */;
INSERT INTO `exame` VALUES (2,'Hemograma completo','avalia glóbulos vermelhos, brancos e plaquetas, importante para detectar anemia, infecções e inflamações.'),(3,'Exame de fezes (coproparasitológico)','verifica a presença de parasitas intestinais'),(4,'Exame de urina (urina tipo I ou Urocultura)','analisa função renal, presença de infecção ou cristais');
/*!40000 ALTER TABLE `exame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examepet`
--

DROP TABLE IF EXISTS `examepet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examepet` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `exame` int NOT NULL,
  `pet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_exame` (`exame`),
  KEY `fk_pet2` (`pet`),
  CONSTRAINT `fk_exame` FOREIGN KEY (`exame`) REFERENCES `exame` (`codigo`),
  CONSTRAINT `fk_pet2` FOREIGN KEY (`pet`) REFERENCES `pet` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examepet`
--

LOCK TABLES `examepet` WRITE;
/*!40000 ALTER TABLE `examepet` DISABLE KEYS */;
/*!40000 ALTER TABLE `examepet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historicopeso`
--

DROP TABLE IF EXISTS `historicopeso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historicopeso` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `peso` double NOT NULL,
  `datah` date NOT NULL,
  `pet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `pet` (`pet`),
  CONSTRAINT `historicopeso_ibfk_1` FOREIGN KEY (`pet`) REFERENCES `pet` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historicopeso`
--

LOCK TABLES `historicopeso` WRITE;
/*!40000 ALTER TABLE `historicopeso` DISABLE KEYS */;
/*!40000 ALTER TABLE `historicopeso` ENABLE KEYS */;
UNLOCK TABLES;

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
  `sexo` date DEFAULT NULL,
  `doador` date DEFAULT NULL,
  `comportamento` date DEFAULT NULL,
  `codTutor` int DEFAULT NULL,
  `codRaca` int DEFAULT NULL,
  `codTipoSanguineo` int DEFAULT NULL,
  `codEspecie` int DEFAULT NULL,
  `caracteristicas` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `raca` int NOT NULL,
  `tutor` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_tutor` (`tutor`),
  KEY `fk_raca` (`raca`),
  KEY `fk_pet_tutor` (`codTutor`),
  KEY `fk_pet_raca` (`codRaca`),
  KEY `fk_pet_TipoSanguineo` (`codTipoSanguineo`),
  KEY `fk_pet_especie` (`codEspecie`),
  CONSTRAINT `fk_pet_especie` FOREIGN KEY (`codEspecie`) REFERENCES `especie` (`codigo`),
  CONSTRAINT `fk_pet_raca` FOREIGN KEY (`codRaca`) REFERENCES `raca` (`codigo`),
  CONSTRAINT `fk_pet_TipoSanguineo` FOREIGN KEY (`codTipoSanguineo`) REFERENCES `tiposanguineo` (`codigo`),
  CONSTRAINT `fk_pet_tutor` FOREIGN KEY (`codTutor`) REFERENCES `tutor` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_raca` FOREIGN KEY (`raca`) REFERENCES `raca` (`codigo`),
  CONSTRAINT `fk_tutor` FOREIGN KEY (`tutor`) REFERENCES `tutor` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raca`
--

DROP TABLE IF EXISTS `raca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `raca` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `especie` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `raca_especie_FK` (`especie`),
  CONSTRAINT `raca_especie_FK` FOREIGN KEY (`especie`) REFERENCES `especie` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raca`
--

LOCK TABLES `raca` WRITE;
/*!40000 ALTER TABLE `raca` DISABLE KEYS */;
INSERT INTO `raca` VALUES (1,'teste',NULL,1);
/*!40000 ALTER TABLE `raca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saidadoacao`
--

DROP TABLE IF EXISTS `saidadoacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saidadoacao` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `clinica` int DEFAULT NULL,
  `sangue` double DEFAULT NULL,
  `datas` date DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_clin2` (`clinica`),
  CONSTRAINT `fk_clin2` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saidadoacao`
--

LOCK TABLES `saidadoacao` WRITE;
/*!40000 ALTER TABLE `saidadoacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `saidadoacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposanguineo`
--

DROP TABLE IF EXISTS `tiposanguineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiposanguineo` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposanguineo`
--

LOCK TABLES `tiposanguineo` WRITE;
/*!40000 ALTER TABLE `tiposanguineo` DISABLE KEYS */;
INSERT INTO `tiposanguineo` VALUES (1,'Tipo A'),(2,'Tipo B'),(3,'Tipo AB'),(5,'Tipo Mik-negativo'),(6,'DEA 1.1 positivo'),(7,'DEA 1.1 negativo'),(8,'DEA 1.2 positivo'),(9,'DEA 7 positivo');
/*!40000 ALTER TABLE `tiposanguineo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposanguineoespecie`
--

DROP TABLE IF EXISTS `tiposanguineoespecie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiposanguineoespecie` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `codTipoSanguineo` int DEFAULT NULL,
  `codEspecie` int DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_tipoSanguineoEspecie_tipoSanguineo` (`codTipoSanguineo`),
  KEY `fk_tipoSanguineoEspecie_especie` (`codEspecie`),
  CONSTRAINT `fk_tipoSanguineoEspecie_especie` FOREIGN KEY (`codEspecie`) REFERENCES `especie` (`codigo`),
  CONSTRAINT `fk_tipoSanguineoEspecie_tipoSanguineo` FOREIGN KEY (`codTipoSanguineo`) REFERENCES `tiposanguineo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposanguineoespecie`
--

LOCK TABLES `tiposanguineoespecie` WRITE;
/*!40000 ALTER TABLE `tiposanguineoespecie` DISABLE KEYS */;
INSERT INTO `tiposanguineoespecie` VALUES (2,1,3),(3,2,3),(4,3,3),(5,6,1),(6,7,1),(7,8,1),(8,9,1),(9,5,3);
/*!40000 ALTER TABLE `tiposanguineoespecie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutor` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dtnascimento` date DEFAULT NULL,
  `cpf` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cep` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rua` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `cidadeestado` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_cidade2` (`cidadeestado`),
  CONSTRAINT `fk_cidade2` FOREIGN KEY (`cidadeestado`) REFERENCES `cidadeestado` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,'Tutor 1','2000-05-11','12312312312','47999999999','TESTE@LOCAL','89000000','TESTE','','',1),(2,'Tutor 2','2025-09-23','66666666666','47966666666','teste2@gmail.com','78999999','','','',2);
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_perfil`
--

DROP TABLE IF EXISTS `usuario_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_perfil` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `situacao` enum('A','I') COLLATE utf8mb4_general_ci DEFAULT 'A',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_perfil`
--

LOCK TABLES `usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;
INSERT INTO `usuario_perfil` VALUES (1,'Administrador','A'),(2,'Atendente','A'),(3,'Tutor','A'),(4,'Visitante','A');
/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `situacao` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_perfil` int DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`),
  KEY `fk_usuario_perfil` (`fk_perfil`),
  CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`fk_perfil`) REFERENCES `usuario_perfil` (`codigo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','admin','admin@local','$2b$10$ezVDzv6c1uVCmPrmWsX0dupXpFJ3w2B9ecoSVCQDEY.TdzgJpQHJm','A','2025-10-08 16:00:07',2),(2,'TESTE','teste','TEste@local','123456','A','2025-10-08 16:40:47',4),(3,'teste2','teste2','teste2@local','teste2','A','2025-10-08 16:42:23',3),(5,'teste','teste4','teste@gmail','123333','A','2025-10-08 21:18:49',3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacina`
--

DROP TABLE IF EXISTS `vacina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacina` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacina`
--

LOCK TABLES `vacina` WRITE;
/*!40000 ALTER TABLE `vacina` DISABLE KEYS */;
INSERT INTO `vacina` VALUES (2,'Vacina tríplice felina','(VRC – protege contra rinotraqueíte, calicivirose e panleucopenia)'),(4,'Raiva','Raiva'),(5,'Leucemia felina','Leucemia felina'),(6,'V8/V10','protege contra cinomose, parvovirose, hepatite infecciosa, leptospirose, parainfluenza'),(7,'Tosse dos canis','Bordetella bronchiseptica');
/*!40000 ALTER TABLE `vacina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacinapet`
--

DROP TABLE IF EXISTS `vacinapet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacinapet` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vacina` int NOT NULL,
  `pet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `vacinapet_vacina_FK` (`vacina`),
  KEY `vacinapet_pet_FK` (`pet`),
  CONSTRAINT `vacinapet_pet_FK` FOREIGN KEY (`pet`) REFERENCES `pet` (`codigo`),
  CONSTRAINT `vacinapet_vacina_FK` FOREIGN KEY (`vacina`) REFERENCES `vacina` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacinapet`
--

LOCK TABLES `vacinapet` WRITE;
/*!40000 ALTER TABLE `vacinapet` DISABLE KEYS */;
/*!40000 ALTER TABLE `vacinapet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario`
--

DROP TABLE IF EXISTS `veterinario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veterinario` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fone` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `crmv` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `clinica` int NOT NULL,
  `cidadeestado` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `veterinario_ibfk_1` (`clinica`),
  KEY `veterinario_ibfk_2` (`cidadeestado`),
  CONSTRAINT `veterinario_ibfk_1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`codigo`),
  CONSTRAINT `veterinario_ibfk_2` FOREIGN KEY (`cidadeestado`) REFERENCES `cidadeestado` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario`
--

LOCK TABLES `veterinario` WRITE;
/*!40000 ALTER TABLE `veterinario` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-28 23:07:49
