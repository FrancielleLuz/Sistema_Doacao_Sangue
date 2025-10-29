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
  `cidade` varchar(50) DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_estado` (`estado`),
  CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidadeestado`
--

LOCK TABLES `cidadeestado` WRITE;
/*!40000 ALTER TABLE `cidadeestado` DISABLE KEYS */;
INSERT INTO `cidadeestado` VALUES (1,'Blumenau',24),(2,'Gaspar',24),(3,'Brusque',24),(4,'Itajaí',24),(5,'Timbo',24),(6,'Indaial',24);
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
  `razaoSocial` varchar(200) NOT NULL,
  `usuAdm` varchar(10) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `cnpj` bigint NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(100) NOT NULL,
  `complemento` varchar(20) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `cidadeestado` int NOT NULL,
  `telefone` int NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_telefone` (`telefone`) USING BTREE,
  KEY `fk_cidadeestado` (`cidadeestado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica`
--

LOCK TABLES `clinica` WRITE;
/*!40000 ALTER TABLE `clinica` DISABLE KEYS */;
INSERT INTO `clinica` VALUES (1,'PetSis Soluções Veterinárias','adm','adm',12345678901234,89010100,'Rua XV de Novembro, 10','','Centro',1,0);
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
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doenca`
--

LOCK TABLES `doenca` WRITE;
/*!40000 ALTER TABLE `doenca` DISABLE KEYS */;
INSERT INTO `doenca` VALUES (1,'Raiva Canina','É causada por um vírus e costuma ser fatal nos animais que apresentam os sintomas da doença. O vírus é espalhado pela saliva, seja por uma mordida de um animal infectado ou por saliva que contamina uma ferida na pele.');
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
  `codPet` int NOT NULL,
  `codDoenca` int NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_doencaPet` (`codPet`),
  UNIQUE KEY `fk_doenca` (`codDoenca`)
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
  `dtEntrada` date NOT NULL,
  `quantidade` decimal(10,0) NOT NULL,
  `dtValidade` date NOT NULL,
  `observacao` varchar(250) NOT NULL,
  `codPet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_doacaoEntradaPet` (`codPet`)
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
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especie`
--

LOCK TABLES `especie` WRITE;
/*!40000 ALTER TABLE `especie` DISABLE KEYS */;
INSERT INTO `especie` VALUES (1,'Felino'),(2,'Canino');
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
  `nome` varchar(30) NOT NULL,
  `abreviacao` varchar(2) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Acre','AC'),(2,'Alagoas','AL'),(3,'Amapá','AP'),(4,'Amazonas','AM'),(5,'Bahia','BA'),(6,'Ceará','CE'),(7,'Distrito Federal','DF'),(8,'Espírito Santo','ES'),(9,'Goiás','GO'),(10,'Maranhã','MA'),(11,'Mato Grosso','MT'),(12,'Mato Grosso do Sul','MS'),(13,'Minas Gerais','MG'),(14,'Pará','PA'),(15,'Paraíba','PB'),(16,'Paraná','PR'),(17,'Pernambuco','PE'),(18,'Piauí','PI'),(19,'Rio de Janeiro','RJ'),(20,'Rio Grande do Norte','RN'),(21,'Rio Grande do Sul','RS'),(22,'Rondônia','RO'),(23,'Roraima','RR'),(24,'Santa Catarina','SC'),(25,'São Paulo','SP'),(26,'Sergipe','SE'),(27,'Tocantins','TO');
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
  `nome` varchar(130) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame`
--

LOCK TABLES `exame` WRITE;
/*!40000 ALTER TABLE `exame` DISABLE KEYS */;
INSERT INTO `exame` VALUES (1,'Ultrassonografia abdominal','Para que serve: como exame de rotina, serve principalmente para investigar alterações nos órgãos e glândulas abdominais, como pâncreas, fígado, rins, bexiga, adrenais e intestino; essas alterações podem ser de várias origens, como neoplásica (câncer), inflamatória, infecciosa etc.');
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
  `dtEmissao` date NOT NULL,
  `dtValidade` date NOT NULL,
  `resultado` varchar(250) NOT NULL,
  `codPet` int NOT NULL,
  `codExame` int NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_petExame` (`codPet`),
  UNIQUE KEY `fk_ExamePet` (`codExame`)
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
  `data` date NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `codPet` int NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_pesoPet` (`codPet`)
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
  `nome` varchar(250) NOT NULL,
  `dtNascimento` date NOT NULL,
  `dtFalecimento` date DEFAULT NULL,
  `sexo` varchar(11) NOT NULL,
  `doador` varchar(15) DEFAULT NULL,
  `comportamento` varchar(500) DEFAULT NULL,
  `codEspecie` int NOT NULL,
  `codRaca` int NOT NULL,
  `codTipoSanguineo` int NOT NULL,
  `codTutor` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_especiepet` (`codEspecie`),
  KEY `fk_racapet` (`codRaca`),
  KEY `fk_tiposangpet` (`codTipoSanguineo`),
  KEY `fk_tutorPet` (`codTutor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (1,'Ariel Fumagalli','0000-00-00',NULL,'Feminino','Sim','Calma',1,22,2,1);
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
  `nome` varchar(30) NOT NULL,
  `especie` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_especie` (`especie`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raca`
--

LOCK TABLES `raca` WRITE;
/*!40000 ALTER TABLE `raca` DISABLE KEYS */;
INSERT INTO `raca` VALUES (1,'Persa',1),(2,'Siamês',1),(3,'Himalaia',1),(4,'Maine Coon',1),(5,'Angorá',1),(7,'Shpynx',1),(8,'Burmese',1),(9,'Ragdoll',1),(10,'British Shorthair',1),(11,'Sem Raça',2),(12,'Shih Tzu',2),(13,'Yorkshire',2),(14,'Poodle',2),(15,'Lhasa Apso',2),(16,'Golden Retriever',2),(17,'Pug',2),(18,'Labrador',2),(19,'Pinsher',2),(20,'Buldogue Francês',2),(22,'Sem Raça',1);
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
  `dtSaida` date NOT NULL,
  `quantidade` decimal(10,0) NOT NULL,
  `observacao` varchar(250) NOT NULL,
  `codEntrada` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_doacaoEntrada` (`codEntrada`) USING BTREE
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
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposanguineo`
--

LOCK TABLES `tiposanguineo` WRITE;
/*!40000 ALTER TABLE `tiposanguineo` DISABLE KEYS */;
INSERT INTO `tiposanguineo` VALUES (1,'A'),(2,'B'),(3,'AB'),(4,'DEA 1.1'),(5,'DEA 1.2'),(6,'DEA 1.3'),(7,'DEA 3'),(8,'DEA 4'),(9,'DEA 5'),(10,'DEA 7');
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
  `codEspecie` int NOT NULL,
  `codTipoSanguineo` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_especietipo` (`codEspecie`),
  KEY `fk_tipoespecie` (`codTipoSanguineo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposanguineoespecie`
--

LOCK TABLES `tiposanguineoespecie` WRITE;
/*!40000 ALTER TABLE `tiposanguineoespecie` DISABLE KEYS */;
INSERT INTO `tiposanguineoespecie` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,4),(5,2,5),(6,2,6),(7,2,7),(8,2,8),(9,2,9),(10,2,10);
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
  `nome` varchar(50) NOT NULL,
  `cpf` bigint NOT NULL,
  `dtnascimento` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cidadeestado` int NOT NULL,
  `telefone` int NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(100) NOT NULL,
  `complemento` varchar(20) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_cidadeestado` (`cidadeestado`) USING BTREE,
  UNIQUE KEY `fk_telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,'Francielle Luz',98792376539,'1998-08-14','fran@mail.com',2,2147483647,89013100,'Rua da Luz','','Dez');
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `situacao` char(1) NOT NULL DEFAULT 'A',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administradores','adm','adm@gmail.com','admin','A','2025-08-13 01:22:28'),(3,'Usuário','usu1','usu@gmail.com','12345678','A','2025-08-14 02:40:04');
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
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacina`
--

LOCK TABLES `vacina` WRITE;
/*!40000 ALTER TABLE `vacina` DISABLE KEYS */;
INSERT INTO `vacina` VALUES (1,'V3','Panleucopenia, Rinotraqueíte e Calicivirose'),(2,'V4','Panleucopenia, Rinotraqueíte, Calicivirose e Clamidiose'),(3,'V5','Panleucopenia, Rinotraqueíte, Calicivirose, Clamidiose e Leucemia Felina'),(4,'Antirrábica','Raiva'),(5,'V8','Cinomose , hepatite infecciosa canina, parvovirose, leptospirose, adenovirose, coronavirose e parainfluenza canina'),(6,'V10','Cinomose , hepatite infecciosa canina, parvovirose, leptospirose, adenovirose, coronavirose e parainfluenza canina'),(7,'Gripe Canina','Adenovírus Canino Tipo 2, Parainfluenenza Canina e Bordetella bronchiseptica');
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
  `codVacina` int NOT NULL,
  `codPet` int NOT NULL,
  `dtAplicacao` date NOT NULL,
  `dtValidade` date NOT NULL,
  `dtVencimento` date NOT NULL,
  `observacao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_VacinaPet` (`codVacina`),
  UNIQUE KEY `fk_Pet` (`codPet`)
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
  `nome` varchar(50) NOT NULL,
  `cpf` bigint NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `cidadeestado` int NOT NULL,
  `telefone` bigint NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(100) NOT NULL,
  `complemento` varchar(20) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `fk_cidadeestado` (`codigo`),
  KEY `fk_cidadeestadoVet` (`cidadeestado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario`
--

LOCK TABLES `veterinario` WRITE;
/*!40000 ALTER TABLE `veterinario` DISABLE KEYS */;
INSERT INTO `veterinario` VALUES (2,'Francielle Luz',90543705489,'fran@gmail.com.br','fran','123',2,47999873456,89000002,'Xv de Novembro, 10','','Centro'),(3,'Christian',21474836989,'christian@email.com.br','christian','123',2,4833345869,89030300,'7 de Setembro','','Centro');
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

-- Dump completed on 2025-08-21 22:02:28
