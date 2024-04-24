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
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `disciplina_nome` varchar(100) DEFAULT NULL,
  `disciplina_fase` int(11) DEFAULT NULL,
  `disciplina_professor` int(11) DEFAULT NULL,
  `disciplina_curso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `disciplina_FK` (`disciplina_professor`),
  KEY `disciplina_FK_1` (`disciplina_curso`),
  CONSTRAINT `disciplina_FK` FOREIGN KEY (`disciplina_professor`) REFERENCES `professor` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `disciplina_FK_1` FOREIGN KEY (`disciplina_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES (115,'Abex I: Análise de Modelos Organizacionais',1,NULL,3),(116,'Comunicação Organizacional',1,NULL,3),(117,'Contabilidade Introdutória',1,NULL,3),(118,'Evolução do Pensamento da Administração',1,NULL,3),(119,'Funções e Papéis do Administrador',1,NULL,3),(120,'Gestão de Projetos',1,NULL,3),(121,'Interpretação e Argumentação',1,NULL,3),(122,'Abex II: Desenvolvimento de Atividade Comportamental',2,NULL,3),(123,'Comportamento Organizacional',2,NULL,3),(124,'Direito Empresarial',2,26,3),(125,'Inteligência Emocional e Liderança',2,NULL,3),(126,'Matemática Aplicada à Gestão',2,NULL,3),(127,'Pesquisa em Gestão e Negócios',2,NULL,3),(128,'Abex III: Projeção de Cenários',3,17,3),(129,'Administração da Produção e Operações',3,NULL,3),(130,'Direito Trabalhista e Previdenciário',3,17,3),(131,'Direitos Humanos e Cidadania',3,17,3),(132,'Fundamentos do Marketing',3,NULL,3),(133,'Gestão de Custos',3,NULL,3),(134,'Tecnologias e Cultura Digital',3,NULL,3),(135,'Abex IV: Administração de Marketing e Marketing Digital',4,17,3),(136,'Administração de Vendas',4,NULL,3),(137,'Análise de Viabilidade Econômico-financeira',4,NULL,3),(138,'Empreendedorismo, Criatividade e Inovação',4,NULL,3),(139,'Gestão de Pessoas',4,NULL,3),(140,'Responsabilidade Socioambiental',4,NULL,3),(141,'Abex V: Gestão do Agronegócio',5,17,3),(142,'Administração de Materiais e Logística',5,NULL,3),(143,'Economia',5,NULL,3),(144,'Eletiva I',5,16,3),(145,'Finanças Corporativas',5,NULL,3),(146,'Gestão de Processos',5,NULL,3),(147,'Abex VI: Gestão de Pessoal',6,17,3),(148,'Administração Estratégica de Pessoas',6,NULL,3),(149,'Eletiva II',6,NULL,3),(150,'Gestão da Produção',6,NULL,3),(151,'Gestão Integrada de Canais de Marketing',6,NULL,3),(152,'Mercado Financeiro e de Capitais',7,NULL,3),(153,'Metodologias ágeis de Gestão',7,NULL,3),(154,'Pesquisa Operacional',7,NULL,3),(155,'Planejamento e Gestão Tributária',7,NULL,3),(156,'Sistema de Transporte',7,NULL,3),(157,'Trabalho de Conclusão de Curso I',7,NULL,3),(158,'Administração Estratégica',8,NULL,3),(159,'Comércio Internacional',8,NULL,3),(160,'Estágio Supervisionado',8,NULL,3),(161,'Gestão de Marcas',8,NULL,3),(162,'Orçamento Empresarial',8,NULL,3),(163,'Trabalho de Conclusão de Curso II',8,NULL,3),(164,'Abex I: Introdução ao Curso e Espaços Profissionais',1,NULL,45),(165,'Algoritmos e Programação I',1,NULL,45),(166,'Laboratório de Programação',1,NULL,45),(167,'Lógica para Computação',1,26,45),(168,'Fundamentos de Matemática',1,NULL,45),(169,'Interpretação e Argumentação',1,NULL,45),(170,'Gestão de Projetos',1,NULL,45),(171,'Abex II: Projeto de Software I',2,17,45),(172,'Arquitetura de Computadores',2,26,45),(173,'Algoritmos e Programação II',2,26,45),(174,'Engenharia de Software I',2,26,45),(175,'Pesquisa Interdisciplinar',2,NULL,45),(176,'Inteligência Emocional e Liderança',2,NULL,45),(177,'Abex III: Projeto de Software II',3,17,45),(178,'Banco de Dados I',3,26,45),(179,'Direitos Humanos e Cidadania',3,NULL,45),(180,'Engenharia de Software II',3,17,45),(181,'Programação com Estruturas Avançadas de Dados',3,26,45),(182,'Tecnologias e Cultura Digital',3,NULL,45),(183,'Abex IV: Projeto Integrado I',4,NULL,45),(184,'Banco de Dados II',4,NULL,45),(185,'Empreendedorismo, Criatividade e Inovação',4,17,45),(186,'Estatística e Probabilidade Discreta',4,NULL,45),(187,'Fundamentos de Administração',4,26,45),(188,'Responsabilidade Socioambiental',4,NULL,45),(189,'Sistemas Operacionais',4,NULL,45),(190,'Abex V: Projeto Integrado II',5,NULL,45),(191,'Desenvolvimento para Web',5,17,45),(192,'Eletiva I',5,NULL,45),(193,'Engenharia de Usabilidade',5,16,45),(194,'Redes de Computadores',5,17,45),(195,'Teoria Geral dos Sistemas',5,NULL,45),(196,'Abex VI: Projeto Integrado III',6,NULL,45),(197,'Desenvolvimento para Dispositivos Móveis',6,NULL,45),(198,'Eletiva II',6,NULL,45),(199,'Gerência de Projetos de Software',6,NULL,45),(200,'Qualidade de Software',6,NULL,45),(201,'Ciência de Dados e Big Data',7,NULL,45),(202,'Gerência e Segurança em Redes de Computadores',7,NULL,45),(203,'Modelagem de Processos de Negócios',7,NULL,45),(204,'Sistemas de Informação e Decisão (sistemas Integrados de Gestão)',7,NULL,45),(205,'Trabalho de Conclusão de Curso I',7,NULL,45),(206,'Desenvolvimento de Equipes nas Organizações',8,17,45),(207,'Ferramentas de Inteligência nos Negócios',8,NULL,45),(208,'Governança em TI',8,NULL,45),(209,'Trabalho de Conclusão de Curso II',8,NULL,45);
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
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
