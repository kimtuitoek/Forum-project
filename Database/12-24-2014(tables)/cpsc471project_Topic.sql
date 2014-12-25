CREATE DATABASE  IF NOT EXISTS `cpsc471project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cpsc471project`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 75.155.72.50    Database: cpsc471project
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `Topic`
--

DROP TABLE IF EXISTS `Topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Topic` (
  `Topic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Object_id` int(11) DEFAULT NULL,
  `Name` varchar(45) NOT NULL,
  `Creator_id` int(11) unsigned NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Status` tinyint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`Topic_id`),
  KEY `Object_id_Topic_idx` (`Object_id`),
  KEY `Creator_id_Topic_idx` (`Creator_id`),
  CONSTRAINT `Creator_id_Topic` FOREIGN KEY (`Creator_id`) REFERENCES `User` (`User_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `Object_id_Topic` FOREIGN KEY (`Object_id`) REFERENCES `Object` (`Object_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Topic`
--

LOCK TABLES `Topic` WRITE;
/*!40000 ALTER TABLE `Topic` DISABLE KEYS */;
INSERT INTO `Topic` VALUES (1,1,'Forum',5,'2014-12-21 15:23:40',000),(12,23,'New topic',5,'2014-12-21 18:30:23',000),(16,37,'This is a test at a sub-topic',5,'2014-12-23 14:44:43',000),(17,38,'This is a test sub-sub-topic',5,'2014-12-23 14:56:11',000),(19,44,'This is a second topic',5,'2014-12-23 17:39:14',000),(20,45,'And this is a third topic',5,'2014-12-23 17:39:23',000),(21,46,'This is a test of the new topic fix',5,'2014-12-23 17:42:45',000),(32,68,'Test Topic',5,'2014-12-24 16:14:39',000);
/*!40000 ALTER TABLE `Topic` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Topic_BEFORE_INSERT` BEFORE INSERT ON `Topic`
	FOR EACH ROW  BEGIN 
					INSERT INTO Object () VALUES ();
                    SET		NEW.Object_id = LAST_INSERT_ID();
				END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-24 20:02:49
