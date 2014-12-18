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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-17 15:50:24
