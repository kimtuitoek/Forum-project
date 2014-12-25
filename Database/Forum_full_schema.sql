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
-- Table structure for table `History`
--

DROP TABLE IF EXISTS `History`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `History` (
  `History_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Body` text NOT NULL,
  `Date` datetime NOT NULL,
  `Post_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`History_id`),
  KEY `Post_id_History` (`Post_id`),
  CONSTRAINT `Post_id_History` FOREIGN KEY (`Post_id`) REFERENCES `Post` (`Post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `History`
--

LOCK TABLES `History` WRITE;
/*!40000 ALTER TABLE `History` DISABLE KEYS */;
/*!40000 ALTER TABLE `History` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Object`
--

DROP TABLE IF EXISTS `Object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Object` (
  `Object_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Object`
--

LOCK TABLES `Object` WRITE;
/*!40000 ALTER TABLE `Object` DISABLE KEYS */;
INSERT INTO `Object` VALUES (1),(21),(22),(23),(24),(25),(26),(27),(28),(29),(30),(31),(32),(33),(34),(35),(36),(37),(38),(39),(40),(41),(42),(43),(44),(45),(46),(47),(48),(49),(50),(51),(52),(53),(54),(55),(56),(57),(58),(59),(60),(61),(62),(63),(64),(65),(66),(67),(68),(69),(70),(71),(72),(73);
/*!40000 ALTER TABLE `Object` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `Report`
--

DROP TABLE IF EXISTS `Report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Report` (
  `Report_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Reason` varchar(45) NOT NULL,
  `Moderator_id` int(11) DEFAULT NULL,
  `Thread_id` int(11) NOT NULL,
  `Post_id` int(11) DEFAULT NULL,
  `Object_id` int(11) DEFAULT NULL,
  `Resolved` int(11) DEFAULT '0',
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `Report` DISABLE KEYS */;
INSERT INTO `Report` VALUES (66,5,'This is a fourth try at reporting with the fi',NULL,124,24,36,0,'2014-12-23 17:07:13'),(67,2,'Indecent stuff',NULL,124,24,36,0,'2014-12-23 19:10:12'),(68,5,'Testing thread reporting',NULL,128,0,48,0,'2014-12-23 19:20:05'),(69,5,'Testing 2',NULL,128,0,48,0,'2014-12-23 19:21:50');
/*!40000 ALTER TABLE `Report` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `Topic_relation`
--

DROP TABLE IF EXISTS `Topic_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Topic_relation` (
  `Parent_topic_id` int(11) unsigned NOT NULL,
  `Child_topic_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`Parent_topic_id`,`Child_topic_id`),
  KEY `Child_Topic_id_idx` (`Child_topic_id`),
  CONSTRAINT `Child_Topic_id` FOREIGN KEY (`Child_topic_id`) REFERENCES `Topic` (`Topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Parent_Topic_id` FOREIGN KEY (`Parent_topic_id`) REFERENCES `Topic` (`Topic_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Topic_relation`
--

LOCK TABLES `Topic_relation` WRITE;
/*!40000 ALTER TABLE `Topic_relation` DISABLE KEYS */;
INSERT INTO `Topic_relation` VALUES (1,12),(12,16),(16,17),(1,19),(1,20),(12,21),(1,32);
/*!40000 ALTER TABLE `Topic_relation` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`eric`@`%`*/ /*!50003 TRIGGER `cpsc471project`.`Topic_relation_BEFORE_DELETE` BEFORE DELETE ON `Topic_relation` 
	FOR EACH ROW	DELETE FROM		Topic
					WHERE			Topic_id = OLD.Child_topic_id */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `User_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) NOT NULL,
  `Status` tinyint(3) unsigned zerofill NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Post_count` int(11) NOT NULL DEFAULT '0',
  `Priviledge` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'TestNEW','NewForum',000,'test@test.com','test1','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',1,0),(2,'Test','Forum2',000,'test2@test.com','test2','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',1,2),(3,'Test','Forum3',001,'test3@test.com','test3','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',0,0),(4,'Eric','Vachon',000,'ericdvachon@gmail.com','ericadmin','13a46ce129c52e487b692100719ddc214e5d61cc63d8798f00c31b61a0a2cd50469e329c00312249e7ec15557a7f688e88979a179341b0661d3899ead197a4f1',0,0),(5,'Eric','Vachon',000,'thewafflehouse@gmail.com','neonium','bedc9d4f2432dea1a8a2b433fb2aee76878e5b2656229be59da38d9278cfe58d2590049c34360b0b9d68d60acbcd6f3c4931add281781d3120a848dca0babf98',24,2),(6,'random','random',001,'a@a.com','standard','3400b8a73e874b2242d4adf60e16d02022a84e5c55562fb3bc5f60c45ec9edc026aee9102637ff837dd6b75886110df935317e245b48205f43593b63c4a2b628',0,0),(7,'testuser','test',000,'testuser@email.com','eric','9a8013857faba6c91dce6b97571f7bbf80f116ea466fba882afc8e397f83a8c2f1b70330a137f593ace4bdbc4c9a14bdf3c8713eceb1b5f0f9b2ea855d8e6888',0,0),(8,'test','user',000,'test.user@email.com','test','9a8013857faba6c91dce6b97571f7bbf80f116ea466fba882afc8e397f83a8c2f1b70330a137f593ace4bdbc4c9a14bdf3c8713eceb1b5f0f9b2ea855d8e6888',0,0),(9,'first','last',000,'b@b.com','best','a113a9f38005c603d17c3f9ccc17805d50444d9d7dd3e7c36f69cb662ccbf22b45071185e88df35c08a97459d0d7fa95bdc9ea890bacdae8f9a6ada95275b814',0,0),(10,'first','last',000,'tester@email.com','tester','484961cdd8b2dd013928db4534133a1e9790faf6a4edf972aec4434b7b9fa967ded6a88c84f5753bb1106da681fb61055b1be6e70843adc6c9c32dd78f2f3870',0,0);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-24 20:05:50
