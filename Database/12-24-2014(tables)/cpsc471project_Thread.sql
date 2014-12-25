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
-- Table structure for table `Thread`
--

DROP TABLE IF EXISTS `Thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Thread` (
  `Object_id` int(11) DEFAULT NULL,
  `Name` text NOT NULL,
  `Thread_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Topic_id` int(11) unsigned DEFAULT NULL,
  `Post_count` int(11) NOT NULL DEFAULT '0',
  `Views` int(11) NOT NULL DEFAULT '-1',
  `Status` tinyint(3) unsigned zerofill NOT NULL,
  `User_id` int(11) unsigned NOT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Thread_id`),
  KEY `User_id_idx` (`User_id`),
  KEY `Object_id_Thread_idx` (`Object_id`),
  KEY `Topic_id_Thread_idx` (`Topic_id`),
  CONSTRAINT `Object_id_Thread` FOREIGN KEY (`Object_id`) REFERENCES `Object` (`Object_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Topic_id_Thread` FOREIGN KEY (`Topic_id`) REFERENCES `Topic` (`Topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User_id_Thread` FOREIGN KEY (`User_id`) REFERENCES `User` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Thread`
--

LOCK TABLES `Thread` WRITE;
/*!40000 ALTER TABLE `Thread` DISABLE KEYS */;
INSERT INTO `Thread` VALUES (28,'This is a thread',124,1,3,82,000,5,'2014-12-21 19:00:45'),(30,'Test thread new topic',125,12,1,5,000,5,'2014-12-21 20:51:31'),(39,'Thread is a sub topic',126,16,1,0,000,5,'2014-12-23 14:56:38'),(41,'Thread is a sub sub topic',127,17,1,0,000,5,'2014-12-23 14:57:05'),(48,'New test thread 1',128,1,1,6,000,2,'2014-12-23 19:16:07'),(69,'test Thread ',132,1,1,0,000,5,'2014-12-24 16:18:46'),(71,'test',133,32,2,1,000,5,'2014-12-24 16:19:54');
/*!40000 ALTER TABLE `Thread` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Thread_BEFORE_INSERT` BEFORE INSERT ON `Thread` 
	FOR EACH ROW BEGIN 
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

-- Dump completed on 2014-12-24 20:02:44
