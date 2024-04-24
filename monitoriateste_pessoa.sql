-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: monitoriateste
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_pessoa` varchar(150) NOT NULL,
  `matricula` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  UNIQUE KEY `matricula_un` (`matricula`),
  UNIQUE KEY `email_un` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (16,'professor1',12312312,'professor1@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(17,'monitor1',4324234,'monitor1@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(18,'profesor4',54354353,'professor4@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(19,'teste11',342354354,'teste11@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(20,'raulan santana pereira',20231235,'raulan.santana@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(23,'glaucia francescon',748905,'glauciafrancescon@unochapeco.edu.br','0240e8eb084b35b255236106709c28e714512407'),(24,'daniel ticudo',3432423,'daniel@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(26,'joao inacio',201756784,'joaoinacio@unochapeco.edu.br','3a9fb1381f4a6c0ec1a1f97a74bccea69aac8900'),(27,'monitor teste',4561321,'monitorteste@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(28,'jorge antonio di domenico',4561325,'jorge@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(29,'professor teste 4',4546522,'professorteste4@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(31,'radames pereira',65665464,'radames@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(32,'aluno novo',4132423,'alunonovo@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(35,'aluno novo2',2147483647,'alunonovo2@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(36,'aluno exemplo',45312315,'alunoexemplo@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(37,'ariel',46545656,'ariel@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab'),(38,'aluno1',4452132,'aluno1@unochapeco.edu.br','2a03345bd8d45a3eba17c13819519cf2945ed5d0'),(39,'professor exemplo1',5665456,'professor_exemplo1@unochapeco.edu.br','428891933fca67b26c5e8df2b1949b9df6758fab');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-24 20:16:36
