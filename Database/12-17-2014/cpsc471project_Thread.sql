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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-17 15:50:20
