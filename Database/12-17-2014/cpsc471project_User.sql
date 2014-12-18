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

-- Dump completed on 2014-12-17 15:50:17
