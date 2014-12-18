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
-- Table structure for table `Action`
--

DROP TABLE IF EXISTS `Action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Action` (
  `Action_id` int(11) NOT NULL AUTO_INCREMENT,
  `Report_id` int(11) NOT NULL,
  `Moderator_id` int(11) NOT NULL,
  `Comment` varchar(45) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Recipient` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Action`
--

LOCK TABLES `Action` WRITE;
/*!40000 ALTER TABLE `Action` DISABLE KEYS */;
/*!40000 ALTER TABLE `Action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `History`
--

DROP TABLE IF EXISTS `History`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `History` (
  `Post_id` int(11) NOT NULL,
  `Edit_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Body` text NOT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Edit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `History`
--

LOCK TABLES `History` WRITE;
/*!40000 ALTER TABLE `History` DISABLE KEYS */;
INSERT INTO `History` VALUES (1,1,1,'Test post 15','2014-11-29 15:02:31'),(2,2,1,'Test post 2','2014-11-29 15:10:01'),(1,3,1,'Test post 15','2014-11-29 15:15:39'),(18,4,5,'Testing','2014-12-15 16:42:38'),(18,5,5,'Testing - this has been edited','2014-12-15 16:45:15'),(18,6,5,'Testing - this has been edited','2014-12-15 17:09:57'),(18,7,5,'Testing - this has been edited','2014-12-15 17:14:58'),(19,8,5,'','2014-12-15 17:15:00'),(18,9,5,'Testing - this has been edited','2014-12-15 17:15:21'),(18,10,5,'Testing - this has been edited','2014-12-15 17:45:12');
/*!40000 ALTER TABLE `History` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Post` (
  `Post_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Thread_id` int(11) NOT NULL,
  `Body` text NOT NULL,
  `History_id` int(11) DEFAULT NULL,
  `Status` varchar(45) DEFAULT 'OnDisplay',
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (1,1,1,'Test post 16',NULL,'OnDisplay','2014-11-29 15:15:39'),(2,2,1,'Test post 2',NULL,'OnDisplay','2014-11-29 15:10:01'),(3,3,1,'Test post 3',NULL,'OnDisplay',NULL),(4,1,1,'New post testing 1',NULL,'OnDisplay',NULL),(5,1,1,'New post testing 2',NULL,'OnDisplay',NULL),(6,1,1,'New post testing 2',NULL,'OnDisplay',NULL),(7,1,1,'New post testing 2',NULL,'OnDisplay',NULL),(8,1,1,'New post testing 3',NULL,'OnDisplay',NULL),(9,1,1,'New Post testing 4',NULL,'OnDisplay',NULL),(10,1,1,'New Post testing 5',NULL,'OnDisplay',NULL),(11,1,1,'New Post testing 6',NULL,'OnDisplay',NULL),(12,1,1,'New Post testing 7',NULL,'OnDisplay',NULL),(13,4,19,'Test 1 - eric',NULL,'OnDisplay','2014-11-30 23:34:51'),(14,4,19,'Test 2 - eric',NULL,'OnDisplay','2014-11-30 23:35:01'),(15,4,19,'Test 3 - eric',NULL,'OnDisplay','2014-11-30 23:35:08'),(16,5,19,'Test for edit',NULL,'OnDisplay','2014-12-15 16:38:03'),(17,5,0,'Testing',NULL,'OnDisplay','2014-12-15 16:39:49'),(18,5,20,'Testing - this has been edited',NULL,'OnDisplay','2014-12-15 17:45:12'),(19,5,20,'',NULL,'OnDisplay','2014-12-15 17:15:00'),(20,5,18,'Win the game',NULL,'OnDisplay','2014-12-15 17:27:09'),(21,5,18,'Edit check',NULL,'OnDisplay','2014-12-15 17:32:26'),(22,5,20,'',NULL,'OnDisplay','2014-12-15 17:45:04'),(23,5,20,'',NULL,'OnDisplay','2014-12-15 17:45:22'),(24,5,1,'Test',NULL,'OnDisplay','2014-12-15 17:45:38'),(25,5,20,'Trying',NULL,'OnDisplay','2014-12-15 17:53:51'),(26,5,20,'',NULL,'OnDisplay','2014-12-15 18:23:19'),(27,5,20,'hjk',NULL,'OnDisplay','2014-12-15 18:28:39'),(28,5,20,'',NULL,'OnDisplay','2014-12-15 18:29:37'),(29,5,1,'',NULL,'OnDisplay','2014-12-15 18:34:35'),(30,5,14,'',NULL,'OnDisplay','2014-12-15 18:45:19');
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
UNLOCK TABLES;

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
  `Object_id` int(11) DEFAULT NULL,
  `Resolved` varchar(45) DEFAULT 'Unresolved',
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `Report` DISABLE KEYS */;
/*!40000 ALTER TABLE `Report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Thread`
--

DROP TABLE IF EXISTS `Thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Thread` (
  `Object_id` varchar(128) DEFAULT NULL,
  `Name` text NOT NULL,
  `Thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `Topic_id` int(11) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `Post_count` int(11) NOT NULL DEFAULT '0',
  `Views` int(11) NOT NULL DEFAULT '0',
  `Status` varchar(45) NOT NULL DEFAULT 'Open',
  `User_id` int(11) NOT NULL,
  `Mod_id` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Thread_id`),
  KEY `Topic_id_idx` (`Topic_id`),
  CONSTRAINT `Topic_id` FOREIGN KEY (`Topic_id`) REFERENCES `Topic` (`Topic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Thread`
--

LOCK TABLES `Thread` WRITE;
/*!40000 ALTER TABLE `Thread` DISABLE KEYS */;
INSERT INTO `Thread` VALUES ('ff1a86dgh9daaa83c7063f06169dd03642c15ca5','Thread 1',1,1,'Public',7,2,'Open',1,NULL,'2014-12-01 01:04:09'),('ff1a86d229daaa83c7063f06169dd03642c15ca0','New test thread 6',12,NULL,'Public',0,4,'Open',1,NULL,'2014-11-30 23:34:23'),('62544efc82e6ef5a056a17ba0dadffef82a26f83','New test thread 7',14,NULL,'Public',0,3,'Open',1,NULL,'2014-11-29 17:58:14'),('4df0e56580d75e915d0d7c174cc3b4b6789a0e9e','New test thread 8',16,NULL,'Public',0,4,'Open',1,NULL,'2014-11-30 19:49:20'),('bd305d8fe06fc7e9e727fca9759e11c477da2ffa','New test thread 8',18,NULL,'Public',0,1,'Open',1,NULL,'2014-11-29 17:58:24'),('fa8bf965c4f204112ced809caf573670725f4c90','New test thread 9',19,NULL,'Private',0,18,'Open',1,NULL,'2014-11-30 23:41:27'),('49092761893f525b0a948e9d4f15e0c34f325781','Fresh Tester',30,NULL,'Public',0,0,'Open',5,NULL,'2014-12-16 15:03:10');
/*!40000 ALTER TABLE `Thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Topic`
--

DROP TABLE IF EXISTS `Topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Topic` (
  `Topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `Object_id` int(11) DEFAULT NULL,
  `Owner_topic_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Views` int(11) NOT NULL DEFAULT '0',
  `Creator_id` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Mod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Topic`
--

LOCK TABLES `Topic` WRITE;
/*!40000 ALTER TABLE `Topic` DISABLE KEYS */;
INSERT INTO `Topic` VALUES (1,NULL,0,'Thread 1',0,1,'0000-00-00 00:00:00',NULL),(2,NULL,0,'Thread 2',0,2,'0000-00-00 00:00:00',NULL),(3,NULL,0,'Thread 3',0,3,'0000-00-00 00:00:00',NULL),(8,NULL,0,'New test thread 1',0,1,NULL,NULL);
/*!40000 ALTER TABLE `Topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) NOT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Post_count` int(11) DEFAULT NULL,
  `Priviledge` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'TestNEW','NewForum',NULL,'test@test.com','test1','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',NULL,0),(2,'Test','Forum2',NULL,'test2@test.com','test2','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',NULL,0),(3,'Test','Forum3',NULL,'test3@test.com','test3','cab8d43bf5f2bc54a3e85eb01f6ce82d7bbd10d21cd359d8c9aa74d3c2b0321b15f53e256663bc52c52baf59f74e24bce84d3d5ba78563adf51d1951c56bc28c',NULL,0),(4,'Eric','Vachon',NULL,'ericdvachon@gmail.com','ericadmin','13a46ce129c52e487b692100719ddc214e5d61cc63d8798f00c31b61a0a2cd50469e329c00312249e7ec15557a7f688e88979a179341b0661d3899ead197a4f1',NULL,0),(5,'Eric','Vachon',NULL,'thewafflehouse@gmail.com','neonium','bedc9d4f2432dea1a8a2b433fb2aee76878e5b2656229be59da38d9278cfe58d2590049c34360b0b9d68d60acbcd6f3c4931add281781d3120a848dca0babf98',NULL,1);
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

-- Dump completed on 2014-12-17 15:30:19
