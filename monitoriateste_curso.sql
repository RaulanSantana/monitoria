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
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `curso_nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (3,'Administração'),(4,'Agronomia'),(5,'Arquitetura e Urbanismo'),(6,'Artes'),(7,'Artes Visuais'),(8,'Biomedicina'),(9,'Ciência da Computação'),(10,'Ciências Biológicas - Bacharelado'),(11,'Ciências Biológicas - Licenciatura'),(12,'Ciências Contábeis'),(13,'Ciências Econômicas'),(14,'Cinema e Mídias Digitais'),(15,'Design'),(16,'Direito'),(17,'Educação Especial'),(18,'Educação Física'),(19,'Enfermagem'),(20,'Engenharia Civil'),(21,'Engenharia de Alimentos'),(22,'Engenharia de Produção'),(23,'Engenharia Elétrica'),(24,'Engenharia Mecânica'),(25,'Engenharia Química'),(26,'Farmácia'),(27,'Fisioterapia'),(28,'Fonoaudiologia'),(29,'Gastronomia'),(30,'Intercultural em Letras'),(31,'Jornalismo'),(32,'Letras - Libras'),(33,'Letras - Português/Inglês'),(34,'Medicina'),(35,'Medicina Veterinária'),(36,'Moda'),(37,'Música'),(38,'Nutrição'),(39,'Odontologia'),(40,'Pedagogia'),(41,'Produção Audiovisual'),(42,'Psicologia'),(43,'Publicidade e Propaganda'),(44,'Relações Internacionais'),(45,'Sistemas de Informação'),(46,'Terapia Ocupacional');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-24 20:16:35
