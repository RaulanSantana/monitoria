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
-- Table structure for table `monitoria`
--

DROP TABLE IF EXISTS `monitoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoria` (
  `id_monitoria` int(11) NOT NULL AUTO_INCREMENT,
  `monitoria_disciplina` int(11) NOT NULL,
  `turno` varchar(100) NOT NULL,
  `monitoria_monitor` int(11) DEFAULT NULL,
  `local` varchar(100) DEFAULT NULL,
  `monitoria_dia` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`id_monitoria`),
  KEY `monitoria_FK` (`monitoria_monitor`),
  KEY `monitoria_FK_1` (`monitoria_disciplina`),
  KEY `monitoria_FK_2` (`monitoria_dia`),
  CONSTRAINT `monitoria_FK` FOREIGN KEY (`monitoria_monitor`) REFERENCES `monitor` (`id_monitor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoria_FK_1` FOREIGN KEY (`monitoria_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoria_FK_2` FOREIGN KEY (`monitoria_dia`) REFERENCES `dias` (`id_dias`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoria`
--

LOCK TABLES `monitoria` WRITE;
/*!40000 ALTER TABLE `monitoria` DISABLE KEYS */;
INSERT INTO `monitoria` VALUES (38,172,'noite',3,'aaaaa',1,'2024-04-09','2024-04-25'),(39,167,'noite',3,'sasddas',3,'2024-04-02','2024-04-26');
/*!40000 ALTER TABLE `monitoria` ENABLE KEYS */;
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
