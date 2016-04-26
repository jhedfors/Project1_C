-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pokes
-- ------------------------------------------------------
-- Server version	5.5.41-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pokes`
--

DROP TABLE IF EXISTS `pokes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poker_id` int(11) NOT NULL,
  `pokee_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pokes_users1_idx` (`poker_id`),
  KEY `fk_pokes_users2_idx` (`pokee_id`),
  CONSTRAINT `fk_pokes_users1` FOREIGN KEY (`poker_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pokes_users2` FOREIGN KEY (`pokee_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokes`
--

LOCK TABLES `pokes` WRITE;
/*!40000 ALTER TABLE `pokes` DISABLE KEYS */;
INSERT INTO `pokes` VALUES (37,6,5,1,'2016-04-26 08:46:00','2016-04-26 08:46:00'),(38,11,6,3,'2016-04-26 08:53:52','2016-04-26 08:53:52'),(39,6,8,3,'2016-04-26 08:55:03','2016-04-26 08:55:03'),(40,6,10,4,'2016-04-26 08:55:12','2016-04-26 08:55:12'),(41,6,11,3,'2016-04-26 08:55:58','2016-04-26 08:55:58'),(42,8,6,2,'2016-04-26 12:05:22','2016-04-26 12:05:22'),(43,6,7,2,'2016-04-26 12:17:45','2016-04-26 12:17:45'),(44,7,6,2,'2016-04-26 12:18:15','2016-04-26 12:18:15');
/*!40000 ALTER TABLE `pokes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Jayden Hedfors','Jayden','jayden@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1967-11-30 00:00:00','2016-04-25 20:14:27','2016-04-25 20:14:27'),(6,'Jeff Hedfors','Jeff','jeff@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1967-11-30 00:00:00','2016-04-25 20:14:34','2016-04-25 20:14:34'),(7,'Kazu Hedfors','Kazu','kazu@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1967-11-30 00:00:00','2016-04-25 20:14:35','2016-04-25 20:14:35'),(8,'Keefer HEdfors','Keefer','keefer@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1967-11-30 00:00:00','2016-04-25 20:14:35','2016-04-25 20:14:35'),(10,'Jim Hedfors','Jim','jim@hedfors.net','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','2016-04-22 00:00:00','2016-04-26 08:51:59','2016-04-26 08:51:59'),(11,'Julie Hedford','Julie','julie@hedford.com','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','2016-04-22 00:00:00','2016-04-26 08:53:15','2016-04-26 08:53:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-26 12:48:04
