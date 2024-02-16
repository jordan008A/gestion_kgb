-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestion_kgb_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrateurs` (
  `AdresseMail` varchar(255) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `MotDePasse` varchar(255) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  PRIMARY KEY (`AdresseMail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateurs`
--

LOCK TABLES `administrateurs` WRITE;
/*!40000 ALTER TABLE `administrateurs` DISABLE KEYS */;
INSERT INTO `administrateurs` VALUES ('james@bond.fr','Bond','James','$2y$10$N3V8jx20WD6Ty/lbjIIzqurKDUQsOFem4b9eF6uAlyz7bvMxu8ij.','2024-02-15');
/*!40000 ALTER TABLE `administrateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_specialite`
--

DROP TABLE IF EXISTS `agent_specialite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_specialite` (
  `AgentCodeID` char(36) NOT NULL,
  `SpecialiteNom` varchar(255) NOT NULL,
  PRIMARY KEY (`AgentCodeID`,`SpecialiteNom`),
  KEY `SpecialiteNom` (`SpecialiteNom`),
  CONSTRAINT `agent_specialite_ibfk_1` FOREIGN KEY (`AgentCodeID`) REFERENCES `agents` (`CodeID`),
  CONSTRAINT `agent_specialite_ibfk_2` FOREIGN KEY (`SpecialiteNom`) REFERENCES `specialites` (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_specialite`
--

LOCK TABLES `agent_specialite` WRITE;
/*!40000 ALTER TABLE `agent_specialite` DISABLE KEYS */;
INSERT INTO `agent_specialite` VALUES ('65ce1de6f3f225.48306020','Charme'),('65ce1de6f3f225.48306020','Combat rapproch├®'),('65ce1de6f3f225.48306020','Infiltration'),('65ce1de6f3f225.48306020','Pilotage'),('65ce1de6f3f225.48306020','Tir de pr├®cision'),('65ce1e108ff428.23780373','Combat rapproch├®'),('65ce1e108ff428.23780373','Explosif'),('65ce1e108ff428.23780373','Informatique'),('65ce1e108ff428.23780373','Pilotage'),('65ce1e108ff428.23780373','Tir de pr├®cision'),('65ce1e30f39b17.48868542','Charme'),('65ce1e30f39b17.48868542','Combat rapproch├®'),('65ce1e30f39b17.48868542','Infiltration'),('65ce1e30f39b17.48868542','Surveillance');
/*!40000 ALTER TABLE `agent_specialite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agents` (
  `CodeID` char(36) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Nationalite` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CodeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES ('65ce1de6f3f225.48306020','Bond','James','1974-06-11','Am├®ricaine'),('65ce1e108ff428.23780373','Reacher','Jack','1987-03-12','Britannique'),('65ce1e30f39b17.48868542','Bourne','Jason','1989-09-06','Fran├ºaise');
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cibles`
--

DROP TABLE IF EXISTS `cibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cibles` (
  `NomCode` char(36) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Nationalite` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NomCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cibles`
--

LOCK TABLES `cibles` WRITE;
/*!40000 ALTER TABLE `cibles` DISABLE KEYS */;
INSERT INTO `cibles` VALUES ('65ce1d3f2f72e6.12069164','Ivankov','Ivan','1964-09-09','Russe'),('65ce1d5a8fd7e9.14520372','Barilla','Maria','1976-10-13','Italienne'),('65ce1d8259f707.74725972','Kroos','Leny','1994-01-12','Allemande'),('65ce1d98d5bd42.28573353','Parrot','Christian','1979-04-12','Fran├ºaise'),('65ce1dbe3f9ea8.55345114','Casillas','Jos├®','1957-06-19','Espagnole');
/*!40000 ALTER TABLE `cibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `NomCode` char(36) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Nationalite` varchar(255) DEFAULT NULL,
  `Pays` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NomCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES ('65ce1c9f007f03.51402133','Wesley','Ron','1992-02-05','Allemande','Allemagne'),('65ce1cb9645715.59777431','Jager','Eren','1997-06-11','Espagnole','Espagne'),('65ce1cd18324b4.62999202','Dupont','Jean','1986-07-24','Fran├ºaise','France'),('65ce1cfd0ad881.42066697','Panzani','Luigi','1985-10-15','Italienne','Italie'),('65ce1d1eadc479.28523283','Roskov','Adriana','1977-10-18','Russe','Russie');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_agent`
--

DROP TABLE IF EXISTS `mission_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_agent` (
  `MissionNomCode` char(36) NOT NULL,
  `AgentCodeID` char(36) NOT NULL,
  PRIMARY KEY (`MissionNomCode`,`AgentCodeID`),
  KEY `AgentCodeID` (`AgentCodeID`),
  CONSTRAINT `mission_agent_ibfk_1` FOREIGN KEY (`MissionNomCode`) REFERENCES `missions` (`NomCode`),
  CONSTRAINT `mission_agent_ibfk_2` FOREIGN KEY (`AgentCodeID`) REFERENCES `agents` (`CodeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_agent`
--

LOCK TABLES `mission_agent` WRITE;
/*!40000 ALTER TABLE `mission_agent` DISABLE KEYS */;
INSERT INTO `mission_agent` VALUES ('65ce25aca9a916.21251463','65ce1e108ff428.23780373'),('65ce25aca9a916.21251463','65ce1e30f39b17.48868542'),('65ce271ca76a05.02467109','65ce1e108ff428.23780373'),('65ce27619c14c8.45918670','65ce1de6f3f225.48306020'),('65ce27a9727ed2.71805995','65ce1de6f3f225.48306020'),('65ce27a9727ed2.71805995','65ce1e108ff428.23780373'),('65ce28074a9300.12367663','65ce1de6f3f225.48306020');
/*!40000 ALTER TABLE `mission_agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_cible`
--

DROP TABLE IF EXISTS `mission_cible`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_cible` (
  `MissionNomCode` char(36) NOT NULL,
  `CibleNomCode` char(36) NOT NULL,
  PRIMARY KEY (`MissionNomCode`,`CibleNomCode`),
  KEY `CibleNomCode` (`CibleNomCode`),
  CONSTRAINT `mission_cible_ibfk_1` FOREIGN KEY (`MissionNomCode`) REFERENCES `missions` (`NomCode`),
  CONSTRAINT `mission_cible_ibfk_2` FOREIGN KEY (`CibleNomCode`) REFERENCES `cibles` (`NomCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_cible`
--

LOCK TABLES `mission_cible` WRITE;
/*!40000 ALTER TABLE `mission_cible` DISABLE KEYS */;
INSERT INTO `mission_cible` VALUES ('65ce25aca9a916.21251463','65ce1d8259f707.74725972'),('65ce271ca76a05.02467109','65ce1dbe3f9ea8.55345114'),('65ce27619c14c8.45918670','65ce1d3f2f72e6.12069164'),('65ce27a9727ed2.71805995','65ce1d98d5bd42.28573353'),('65ce28074a9300.12367663','65ce1d5a8fd7e9.14520372');
/*!40000 ALTER TABLE `mission_cible` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_contact`
--

DROP TABLE IF EXISTS `mission_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_contact` (
  `MissionNomCode` char(36) NOT NULL,
  `ContactNomCode` char(36) NOT NULL,
  PRIMARY KEY (`MissionNomCode`,`ContactNomCode`),
  KEY `ContactNomCode` (`ContactNomCode`),
  CONSTRAINT `mission_contact_ibfk_1` FOREIGN KEY (`MissionNomCode`) REFERENCES `missions` (`NomCode`),
  CONSTRAINT `mission_contact_ibfk_2` FOREIGN KEY (`ContactNomCode`) REFERENCES `contacts` (`NomCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_contact`
--

LOCK TABLES `mission_contact` WRITE;
/*!40000 ALTER TABLE `mission_contact` DISABLE KEYS */;
INSERT INTO `mission_contact` VALUES ('65ce25aca9a916.21251463','65ce1cfd0ad881.42066697'),('65ce271ca76a05.02467109','65ce1c9f007f03.51402133'),('65ce27619c14c8.45918670','65ce1d1eadc479.28523283'),('65ce27a9727ed2.71805995','65ce1cb9645715.59777431'),('65ce28074a9300.12367663','65ce1cd18324b4.62999202');
/*!40000 ALTER TABLE `mission_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_planque`
--

DROP TABLE IF EXISTS `mission_planque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_planque` (
  `MissionNomCode` char(36) NOT NULL,
  `PlanqueCode` char(36) NOT NULL,
  PRIMARY KEY (`MissionNomCode`,`PlanqueCode`),
  KEY `PlanqueCode` (`PlanqueCode`),
  CONSTRAINT `mission_planque_ibfk_1` FOREIGN KEY (`MissionNomCode`) REFERENCES `missions` (`NomCode`),
  CONSTRAINT `mission_planque_ibfk_2` FOREIGN KEY (`PlanqueCode`) REFERENCES `planques` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_planque`
--

LOCK TABLES `mission_planque` WRITE;
/*!40000 ALTER TABLE `mission_planque` DISABLE KEYS */;
INSERT INTO `mission_planque` VALUES ('65ce25aca9a916.21251463','65ce1c528cdef9.56785923'),('65ce271ca76a05.02467109','65ce1c5f80c895.54890169'),('65ce27619c14c8.45918670','65ce1c43842c51.44693989'),('65ce27a9727ed2.71805995','65ce1bd812a326.34065806'),('65ce28074a9300.12367663','65ce1bc9e5d677.97327006');
/*!40000 ALTER TABLE `mission_planque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions`
--

DROP TABLE IF EXISTS `missions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missions` (
  `NomCode` char(36) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Pays` varchar(255) DEFAULT NULL,
  `TypeMission` varchar(255) DEFAULT NULL,
  `Statut` varchar(255) DEFAULT NULL,
  `SpecialiteRequise` varchar(255) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  PRIMARY KEY (`NomCode`),
  KEY `SpecialiteRequise` (`SpecialiteRequise`),
  CONSTRAINT `missions_ibfk_1` FOREIGN KEY (`SpecialiteRequise`) REFERENCES `specialites` (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions`
--

LOCK TABLES `missions` WRITE;
/*!40000 ALTER TABLE `missions` DISABLE KEYS */;
INSERT INTO `missions` VALUES ('65ce25aca9a916.21251463','Op├®ration Aurore','Surveiller les activit├®s d&#039;un groupe de trafiquants d&#039;armes dans la r├®gion de Rome.','Italie','Surveillance','En cours','Surveillance','2024-02-27',NULL),('65ce271ca76a05.02467109','Projet Phoenix','D├®manteler un r├®seau de cybercriminalit├® op├®rant ├á partir de Berlin.','Allemagne','Infiltration','Termin├®','Informatique','2024-03-08','2024-02-15'),('65ce27619c14c8.45918670','Op├®ration Blizzard','Collecter des informations sur les mouvements de troupes ├á la fronti├¿re russe durant l&#039;hiver.','Russie','Infiltration','Echec','Infiltration','2024-12-25','2024-02-15'),('65ce27a9727ed2.71805995','Chasseur de Fant├┤mes','Neutraliser un agent double qui transmet des informations sensibles ├á une organisation ennemie.','Espagne','Assassinat','En pr├®paration','Tir de pr├®cision','2024-06-12',NULL),('65ce28074a9300.12367663','├ëchiquier','Espionner les n├®gociations secr├¿tes entre deux pays potentiellement hostiles pour anticiper un conflit.','France','Surveillance','En cours','Charme','2024-02-14',NULL);
/*!40000 ALTER TABLE `missions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planques`
--

DROP TABLE IF EXISTS `planques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planques` (
  `Code` char(36) NOT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Pays` varchar(255) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planques`
--

LOCK TABLES `planques` WRITE;
/*!40000 ALTER TABLE `planques` DISABLE KEYS */;
INSERT INTO `planques` VALUES ('65ce1bc9e5d677.97327006','123 Rue de Paris','France','Appartement'),('65ce1bd812a326.34065806','31 Rue Fiction','Espagne','Maison'),('65ce1c43842c51.44693989','123 Rue de Moscou','Russie','Entrep├┤t'),('65ce1c528cdef9.56785923','123 Rue de Turin','Italie','Appartement'),('65ce1c5f80c895.54890169','123 Rue de Berlin','Allemagne','Appartement');
/*!40000 ALTER TABLE `planques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialites` (
  `Nom` varchar(255) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialites`
--

LOCK TABLES `specialites` WRITE;
/*!40000 ALTER TABLE `specialites` DISABLE KEYS */;
INSERT INTO `specialites` VALUES ('Charme'),('Combat rapproch├®'),('Explosif'),('Infiltration'),('Informatique'),('Pilotage'),('Surveillance'),('Tir de pr├®cision');
/*!40000 ALTER TABLE `specialites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16 11:26:16
