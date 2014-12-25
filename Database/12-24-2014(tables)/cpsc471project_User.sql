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

-- Dump completed on 2014-12-24 20:02:54
