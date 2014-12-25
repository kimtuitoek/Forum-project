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
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Post` (
  `Post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` int(11) unsigned NOT NULL,
  `Thread_id` int(11) unsigned NOT NULL,
  `Body` text NOT NULL,
  `History_id` int(11) unsigned DEFAULT NULL,
  `Status` tinyint(3) unsigned zerofill NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Object_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Post_id`),
  KEY `User_id_idx` (`User_id`),
  KEY `Thread_id_Post` (`Thread_id`),
  KEY `Object_id_Post_idx` (`Object_id`),
  CONSTRAINT `Object_id_Post` FOREIGN KEY (`Object_id`) REFERENCES `Object` (`Object_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Thread_id_Post` FOREIGN KEY (`Thread_id`) REFERENCES `Thread` (`Thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User_id_Post` FOREIGN KEY (`User_id`) REFERENCES `User` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (21,5,124,'This is a post body',NULL,000,'2014-12-21 19:00:45',29),(22,5,125,'this is the body',NULL,000,'2014-12-21 20:51:31',31),(23,5,124,'This post tests the system! ',NULL,000,'2014-12-22 22:42:17',35),(24,1,124,'New post',NULL,000,'2014-12-22 23:42:32',36),(25,5,126,'Isn\'t this fancy',NULL,000,'2014-12-23 14:56:38',40),(26,5,127,'It seems to be working right!',NULL,000,'2014-12-23 14:57:05',42),(27,2,128,'This is a thread',NULL,000,'2014-12-23 19:16:08',49),(31,5,132,'test',NULL,000,'2014-12-24 16:18:46',70),(32,5,133,'test',NULL,000,'2014-12-24 16:19:54',72),(33,5,133,'hello!',NULL,000,'2014-12-24 16:21:26',73);
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Post_BEFORE_INSERT` BEFORE INSERT ON `Post` 
	FOR EACH ROW BEGIN 
					INSERT INTO Object () VALUES ();
                    SET		NEW.Object_id = LAST_INSERT_ID();
				END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Update_Post_Count` AFTER INSERT 
        ON `Post` FOR EACH ROW	BEGIN
									UPDATE	Thread as t 
									SET		Post_count = Post_count + 1
									WHERE	t.Thread_id = NEW.Thread_id;
									UPDATE	User as u 
									SET		Post_count = Post_count + 1
									WHERE	u.User_id = NEW.User_id;
                                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Post_BEFORE_DELETE` BEFORE DELETE 
		ON `Post` FOR EACH ROW  BEGIN
									UPDATE	Thread as t 
									SET		Post_count = Post_count - 1
									WHERE	t.Thread_id = OLD.Thread_id;
									DELETE FROM	Thread
									WHERE		Thread_id = OLD.Thread_id
												AND Post_count = 0;
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

-- Dump completed on 2014-12-24 20:02:59
