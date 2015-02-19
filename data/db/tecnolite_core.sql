CREATE DATABASE  IF NOT EXISTS `t3cn0lo1t3_c5_c0r3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `t3cn0lo1t3_c5_c0r3`;
-- MySQL dump 10.13  Distrib 5.6.17, for Linux (x86_64)
--
-- Host: localhost    Database: t3cn0lo1t3_c5_c0r3
-- ------------------------------------------------------
-- Server version	5.5.41-MariaDB

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL DEFAULT '0.00000',
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (23,19,33,1,26059.00000,0.00000,26059.00000),(29,83,67,1,5547.00000,0.00000,5547.00000),(30,1,0,1,1.00000,0.00000,1.00000),(32,1,3,1,1.00000,0.00000,1.00000);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `category_order` int(10) unsigned NOT NULL,
  `category_status` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (13,0,'Hogar','','images/cat_hogar.jpg','images/cat_hogar.jpg',1403712181,1,1),(14,0,'Electrónica','','images/cat_electronica.jpg','images/cat_electronica.jpg',1403712181,1,1),(15,0,'Relojes','','images/cat_relojes.jpg','images/cat_relojes.jpg',1403712181,1,1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `credit` double unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits`
--

LOCK TABLES `credits` WRITE;
/*!40000 ALTER TABLE `credits` DISABLE KEYS */;
INSERT INTO `credits` VALUES (1,21,1936.7,1418855886),(2,2,45996.45,1409696025),(3,34,12906.38,1418151722),(4,90,8720.7,1416354040),(67,141,7925.265,1418841243),(68,19,25626.53,1418841243),(69,28,20.48056,1416333789),(70,69,32853.05,1418841243),(71,26,1217.66,1418841243),(72,29,685.38,1418841242),(73,24,9104.117,1418841243),(74,32,25226.7385,1418841243),(75,25,8705.66,1418841242),(76,66,5462.76,1418841242),(77,20,2424,1418841242),(78,146,3162.024,1418841243),(79,22,7331.38,1418841242),(80,136,710.38,1418841243),(81,101,1107.138,1416334087),(82,137,244.876,1416334088),(83,149,2070.85,1418841241),(84,59,764.312,1418228952),(85,63,74.5477,1418228953),(86,62,402.53,1418228952),(87,112,10130.612,1418228953),(88,61,0,1416334112),(89,153,0,1416334112),(90,156,0,1416334113),(91,150,0,1416334113),(92,14,703.06,1418228951),(93,16,255.6045,1418228952),(94,7,0,1416334115),(95,158,0,1416334113),(96,37,325.6007,1418228952),(97,118,3547.53,1418228951),(98,27,1604.025,1418228953),(99,17,80.12014,1418228951),(100,116,0,1416334115),(101,42,187.5477,1418228953),(102,157,75.0956,1418228953),(103,58,0,1416334114),(104,152,958.98232,1418151718),(105,119,0,1416334114),(106,155,0,1416334114),(107,30,445.5477,1418228953),(108,151,0,1416334115),(109,114,0,1416334115),(110,85,62212.0954,1418855911),(111,80,28800.84,1418855910),(112,109,36951.9896,1418855911),(113,126,46180.84,1418855910),(114,104,6332.8868,1418855910),(115,128,7954.1,1418855908),(116,5,43517.2862,1418855913),(117,10,8019.9792,1418855914),(118,107,608.2014,1418855914),(119,84,27411.3816,1418232993),(120,129,22849.96112,1418232993),(121,79,4934.5477,1418232994),(122,71,11835.5477,1418232995),(123,77,3322.9792,1418232995),(124,92,5865.0954,1418232996),(125,127,6505.8339,1418232996),(126,82,5535.89,1418232997),(127,31,10263.98234,1418855907),(128,81,816.7,1418233005),(129,83,4164.6007,1418233004),(130,142,18204.96464,1418233002),(131,72,55401.1908,1418233009),(132,18,23487.1908,1418233009),(133,147,0,1418151724),(134,89,237,1418855899),(135,160,0,1418151724),(136,148,7028,1419268373),(137,91,2905.35,1416354041),(138,170,2671.38,1418151721),(139,103,34.1344,1418151709),(140,36,42.6679,1418151710),(141,172,0,1418151710),(142,167,711.7,1418151710),(143,88,70.3339,1418151713),(144,123,604.2014,1418151714),(145,100,13767.0672,1418151722),(146,35,3749.948,1418151722),(147,168,5446.38,1418151722),(148,173,4003.438,1418151723),(149,162,978,1418151723),(150,52,10.98234,1418151715),(151,38,19643.48056,1418151723),(152,70,15970.66,1418151723),(153,65,5111.314,1418151723),(154,145,3226.69,1418151723),(155,174,275.0672,1418151718),(156,163,70.4948,1418151723),(157,166,8883.76,1418151720),(158,45,5236.0954,1418151721),(159,40,29953.6045,1418151724),(160,41,5070.5477,1418151721),(161,105,1233.66,1418151721),(162,46,75.0954,1418151721),(163,197,2671.38,1418151721),(164,51,1406.75,1418151721),(165,74,3130.94,1418151721),(166,75,1288.75,1418151721),(167,169,0,1418151721),(168,165,1233.66,1418151722),(169,99,3508.452,1418151722),(170,189,1233.658,1418151724),(171,175,2.74558,1418151725),(172,176,7255.474,1418841242),(173,222,1763.69,1418841241),(174,208,0,1418151826),(175,200,150.265,1418228952),(176,214,2215.06,1418228953),(177,182,0,1418151826),(178,204,909.375,1418228951),(179,192,3231.32,1418228953),(180,201,51.2014,1418228950),(181,60,140.9896,1418228952),(182,181,0,1418228953),(183,179,0,1418228953),(184,229,4122.4558,1418855896),(185,233,209.555,1418841238),(186,236,2671.38,1418841238),(187,237,1335.69,1418841238),(188,227,1335.69,1418841240),(189,238,1335.69,1418841240),(190,225,283.5478,1418841242),(191,235,1335.69,1418841241),(192,239,1396.2191,1418841241),(193,223,4144.5761,1418841243),(194,198,1335.69,1418841243),(195,240,1335.69,1418841243),(196,110,2894.38,1418852818),(197,249,19243.38,1418855879),(198,43,12968.84,1418855885),(199,53,12643.78,1418855885),(200,39,31510,1418855886),(201,48,21212,1418855886),(202,47,17280.7,1418855885),(203,23,12803.84,1418855886),(204,248,3948.876,1418855901),(205,245,2020.752,1418855925),(206,64,3498.9896,1418855912),(207,3,0,1424272778),(208,1,0,0);
/*!40000 ALTER TABLE `credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits_history`
--

DROP TABLE IF EXISTS `credits_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_period` int(10) unsigned NOT NULL,
  `id_username` int(10) unsigned NOT NULL,
  `credits` double unsigned NOT NULL,
  `payments` int(10) unsigned NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits_history`
--

LOCK TABLES `credits_history` WRITE;
/*!40000 ALTER TABLE `credits_history` DISABLE KEYS */;
INSERT INTO `credits_history` VALUES (1,15,21,150.1908,0,1),(2,15,21,0,0,1),(3,16,2,42675.3,0,1),(4,16,2,3321.15,0,1),(5,16,34,2671.38,0,2),(6,16,34,0,0,1),(7,16,34,2467.32,0,1),(8,16,90,0,0,2),(9,16,90,0,0,2),(10,16,90,0,0,2),(11,0,148,0,10958,1),(12,0,89,0,10522,1),(13,0,20,0,8890,1),(14,0,26,0,5547,1),(15,0,66,0,17128,1),(16,0,29,0,11094,1),(17,0,24,0,29945,1),(18,0,10,0,6606,1),(19,0,136,0,12200,1),(20,0,26,0,5547,1),(21,0,29,0,10522,1),(22,0,136,0,17910,1),(23,0,81,0,36931,1),(24,0,83,0,12200,1),(25,0,110,0,24851,1),(26,0,81,0,39128,1);
/*!40000 ALTER TABLE `credits_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits_periods`
--

DROP TABLE IF EXISTS `credits_periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits_periods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `from_date` int(10) unsigned NOT NULL,
  `to_date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits_periods`
--

LOCK TABLES `credits_periods` WRITE;
/*!40000 ALTER TABLE `credits_periods` DISABLE KEYS */;
INSERT INTO `credits_periods` VALUES (1,'Enero',1385877600,1359698399),(2,'Febrero',1359698400,1362117599),(3,'Marzo',1362117600,1364795999),(4,'Abril',1364796000,1367384399),(5,'mayo',1367384400,1370062799),(6,'junio',1370062800,1372654799),(7,'julio',1372654800,1375333199),(8,'agosto',1375333200,1378011599),(9,'septiembre',1378011600,1380603599),(10,'octubre',1380603600,1383285599),(11,'noviembre',1383285600,1385877599),(12,'diciembre',1385877600,1388555999),(13,'Junio 2014',1401602400,1404194399),(14,'Julio 2014',1,1),(15,'Agosto 2014',1406872800,1409551199),(16,'Septiembre 2014',1409551200,1412143199);
/*!40000 ALTER TABLE `credits_periods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familias` (
  `familia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`familia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mod_archivos`
--

DROP TABLE IF EXISTS `mod_archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mod_archivos` (
  `archivo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `process_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`archivo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mod_archivos`
--

LOCK TABLES `mod_archivos` WRITE;
/*!40000 ALTER TABLE `mod_archivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_check`
--

DROP TABLE IF EXISTS `order_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_check` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_security` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_check`
--

LOCK TABLES `order_check` WRITE;
/*!40000 ALTER TABLE `order_check` DISABLE KEYS */;
INSERT INTO `order_check` VALUES (1,0,148,10958.00000,1416929069,2147483647,3),(2,0,89,10522.00000,1416929133,2147483647,3),(3,0,20,8890.00000,1416931379,2147483647,3),(4,0,26,5547.00000,1416931969,2147483647,3),(5,0,66,17128.00000,1416933176,2147483647,3),(6,0,29,11094.00000,1416961713,2147483647,3),(7,0,24,29945.00000,1418273839,2147483647,3),(8,0,10,6606.00000,1418346101,2147483647,3),(9,0,136,12200.00000,1418837654,2147483647,3),(10,0,26,5547.00000,1418841878,2147483647,3),(11,0,29,10522.00000,1418842561,2147483647,3),(12,0,136,17910.00000,1418845051,2147483647,3),(13,0,81,36931.00000,1418857836,2147483647,3),(14,0,83,12200.00000,1418859591,2147483647,3),(15,0,110,24851.00000,1418859694,2147483647,3),(16,0,81,39128.00000,1418860004,2147483647,3);
/*!40000 ALTER TABLE `order_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `order_status` int(10) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_history`
--

LOCK TABLES `order_history` WRITE;
/*!40000 ALTER TABLE `order_history` DISABLE KEYS */;
INSERT INTO `order_history` VALUES (1,1,1,1416929069,2147483647),(2,2,1,1416929133,2147483647),(3,3,1,1416931379,2147483647),(4,4,1,1416931969,2147483647),(5,5,1,1416933176,2147483647),(6,6,1,1416961713,2147483647),(7,7,1,1418273839,2147483647),(8,8,1,1418346101,2147483647),(9,9,1,1418837654,2147483647),(10,10,1,1418841878,2147483647),(11,11,1,1418842561,2147483647),(12,12,1,1418845051,2147483647),(13,13,1,1418857836,2147483647),(14,14,1,1418859591,2147483647),(15,15,1,1418859694,2147483647),(16,16,1,1418860004,2147483647);
/*!40000 ALTER TABLE `order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL,
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (1,1,117,1,10958.00000,0.00000,10958.00000),(2,2,36,1,10522.00000,0.00000,10522.00000),(3,3,122,1,8890.00000,0.00000,8890.00000),(4,4,67,1,5547.00000,0.00000,5547.00000),(5,5,36,1,10522.00000,0.00000,10522.00000),(6,5,37,1,6606.00000,0.00000,6606.00000),(7,6,67,2,11094.00000,0.00000,11094.00000),(8,7,35,1,29945.00000,0.00000,29945.00000),(9,8,37,1,6606.00000,0.00000,6606.00000),(10,9,111,1,12200.00000,0.00000,12200.00000),(11,10,67,1,5547.00000,0.00000,5547.00000),(12,11,36,1,10522.00000,0.00000,10522.00000),(13,12,41,1,17910.00000,0.00000,17910.00000),(14,13,113,1,36931.00000,0.00000,36931.00000),(15,14,111,1,12200.00000,0.00000,12200.00000),(16,15,129,1,24851.00000,0.00000,24851.00000),(17,16,46,1,39128.00000,0.00000,39128.00000);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_status` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `method_id` (`method_id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1,1,148,10958.00000),(2,1,2,89,10522.00000),(3,1,3,20,8890.00000),(4,1,4,26,5547.00000),(5,1,5,66,17128.00000),(6,1,6,29,11094.00000),(7,1,7,24,29945.00000),(8,1,8,10,6606.00000),(9,1,9,136,12200.00000),(10,1,10,26,5547.00000),(11,1,11,29,10522.00000),(12,1,12,136,17910.00000),(13,1,13,81,36931.00000),(14,1,14,83,12200.00000),(15,1,15,110,24851.00000),(16,1,16,81,39128.00000);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_method`
--

LOCK TABLES `payment_method` WRITE;
/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos_canje`
--

DROP TABLE IF EXISTS `periodos_canje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodos_canje` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` int(11) DEFAULT NULL,
  `date_finish` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`periodo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos_canje`
--

LOCK TABLES `periodos_canje` WRITE;
/*!40000 ALTER TABLE `periodos_canje` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodos_canje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `permission` enum('allow','deny') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,1,'allow'),(3,2,45,'allow'),(4,3,45,'allow'),(5,2,1,'allow'),(6,3,1,'allow'),(7,1,40,'allow'),(9,3,40,'allow'),(10,1,15,'allow'),(11,2,15,'allow'),(12,3,15,'allow'),(13,1,14,'allow'),(14,2,14,'allow'),(15,3,14,'allow'),(16,1,18,'allow'),(17,2,18,'allow'),(18,3,18,'allow'),(19,1,22,'allow'),(20,2,22,'allow'),(21,3,22,'allow'),(22,1,23,'allow'),(23,2,23,'allow'),(24,3,23,'allow');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `other_sku` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned DEFAULT '0',
  `product_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'GV-01-14','Zippered passport wallet','Zippered passport wallet with 7 card slots, mesh id window, pen holder, 2 travel document pockets and zippered money pouch.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(2,'GV-02-14','Set Dinamarca','Set Dinamarca. Maletas rígidas de 28,24 y 20asa telescópica retráctil de aluminio sistema interno de cuatro ruedas que permiten giro de 360°, asa de mano superior y lateral organizadores internos. Colores plata y gris.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(3,'GV-03-14','Set Vancouver','Set Vancouver. Maleta de 28, 24 y 20. Sistema de cuatro ruedas que permiten giro de 360° alma de acero, asas telescópicas retráctiles de aluminio forro interno en poliéster, ojillos para candado de seguridad, dos bolsas frontales con cierre.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(4,'GV-04-14','Impact daypack','High sierra® impact daypack.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(5,'GV-05-14','Verve checkpoint-friendly compu-messenger','Verve checkpoint-friendly compu-messenger.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(6,'GV-06-14','Mochila','Slazenger™ classic shoe bag.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(7,'GV-07-14','Backpack High Sierra','High Sierra Backpack. Mochila de polycanvas con multicompartimentos que guarda laptop de 17´´. Con puerto para audífonos y bolsa de zipper lateral, con panel posterior.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(8,'GV-08-14','Hielera mochila Ice River','Capacidad para 18 latas. Bolsas laterales para guardar accesorios y condimentos. Pads en el asa para mayor comodidad.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(9,'GV-09-14','Bicicleta Dynosteel','Bicicleta Dynosteel. R16. 1v. niño tijera rígida, display en ruedas.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1),(10,'GV-10-14','Bicicleta Amore Mio','Bicicleta Amore Mio. R16. 1v. niña, canastilla, porta bebe, motitas y display en ruedas.','images/product_images/licuadora.jpg','images/product_images/large/licuadora.jpg',0,1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (0,13,1),(0,13,2),(0,13,3),(0,13,4),(0,14,5),(0,14,6),(0,14,7),(0,15,8),(0,15,9),(0,15,10);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_price`
--

DROP TABLE IF EXISTS `product_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `currency` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_price`
--

LOCK TABLES `product_price` WRITE;
/*!40000 ALTER TABLE `product_price` DISABLE KEYS */;
INSERT INTO `product_price` VALUES (1,1,1.00000,'LEDS',0),(2,2,1.00000,'LEDS',0),(3,3,1.00000,'LEDS',0),(4,4,1.00000,'LEDS',0),(5,5,1.00000,'LEDS',0),(6,6,1.00000,'LEDS',0),(7,7,1.00000,'LEDS',0),(8,8,1.00000,'LEDS',0),(9,9,1.00000,'LEDS',0),(10,10,1.00000,'LEDS',0);
/*!40000 ALTER TABLE `product_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) DEFAULT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntuacion`
--

DROP TABLE IF EXISTS `puntuacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puntuacion` (
  `puntuacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `cuota` float NOT NULL,
  `venta` float NOT NULL,
  `puntos` float NOT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `reg_date` int(11) DEFAULT '0',
  `status` int(11) NOT NULL COMMENT ' ',
  PRIMARY KEY (`puntuacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntuacion`
--

LOCK TABLES `puntuacion` WRITE;
/*!40000 ALTER TABLE `puntuacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntuacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `resource` varchar(125) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource`
--

LOCK TABLES `resource` WRITE;
/*!40000 ALTER TABLE `resource` DISABLE KEYS */;
INSERT INTO `resource` VALUES (1,0,1,'application_index','Application\\Controller\\Index/index',''),(2,1,2,'application_comoparticipar','Application\\Controller\\Index/comoparticipar',''),(3,1,2,'application_mispuntos','Application\\Controller\\Index/mispuntos',''),(4,1,2,'application_catalogo','Application\\Controller\\Index/catalogo',''),(5,1,2,'application_canjeartupremio','Application\\Controller\\Index/canjeartupremio',''),(6,1,2,'application_laselecciongepp','Application\\Controller\\Index/laselecciongepp',''),(7,1,2,'application_tablaposicion','Application\\Controller\\Index/tablaposicion',''),(8,1,2,'application_incentivos','Application\\Controller\\Index/incentivos',''),(9,1,2,'application_reconocimientos','Application\\Controller\\Index/reconocimientos',''),(10,1,2,'application_categoria','Application\\Controller\\Index/categoria',''),(11,1,2,'application_producto','Application\\Controller\\Index/producto',''),(12,1,2,'application_carrito','Application\\Controller\\Index/carrito',''),(13,1,2,'application_checkout','Application\\Controller\\Index/checkout',''),(14,0,1,'cscategorycmf_index','Cscategorycmf\\Controller\\Index/index','Categoy'),(15,0,1,'cscurrencypoints_index','Cscurrencypoints\\Controller\\Index/index','Cscurrencypoints'),(18,0,1,'csproductcmf_index','Csproductcmf\\Controller\\Index/index','csproductcmf'),(21,18,2,'csproductcmf_controller_index_producto','Csproductcmf\\Controller\\Index/producto','csproductcmf_controller_index_producto'),(22,0,1,'cscart_controller_index_carrito','Cscart\\Controller\\Index/carrito','cscart_controller_index_carrito'),(23,0,1,'cscheckout_controller_index_checkout','Cscheckout\\Controller\\Index/checkout','cscheckout_controller_index_checkout'),(24,0,1,'asignacion_controller_index_index','Asignacion\\Controller\\Index/index','asignacion_controller_index_index'),(25,24,2,'asignacion_controller_index_desasignaruta','Asignacion\\Controller\\Index/desasignaruta','asignacion_controller_index_desasignaruta'),(26,24,2,'asignacion_controller_index_asignaruta','Asignacion\\Controller\\Index/asignaruta','asignacion_controller_index_asignaruta'),(27,24,2,'asignacion_controller_index_buscaempleado','Asignacion\\Controller\\Index/buscaempleado','asignacion_controller_index_buscaempleado'),(28,24,2,'asignacion_controller_index_empleadoasi','Asignacion\\Controller\\Index/empleadoasi','asignacion_controller_index_empleadoasi'),(29,1,2,'application_controller_index_privacidad','Application\\Controller\\Index/privacidad','application_controller_index_privacidad'),(30,1,2,'HistorialCanjes_Controller_Index_index ','HistorialCanjes\\Controller\\Index/index ','HistorialCanjes_Controller_Index_index '),(31,1,2,'Bases_Controller_Index_index ','Bases\\Controller\\Index/index ','Bases_Controller_Index_index '),(32,0,1,'Registro_Controller_Index_index','Registro\\Controller\\Index/index','Registro_Controller_Index_index'),(33,32,2,'Registro_Controller_Index_getinfo','Registro\\Controller\\Index/getinfo','Registro_Controller_Index_getinfo'),(34,32,2,'Registro_Controller_Index_saveiu','Registro\\Controller\\Index/saveiu','Registro_Controller_Index_saveiu'),(35,32,2,'Registro_Controller_Index_confirmar','Registro\\Controller\\Index/confirmar','Registro_Controller_Index_confirmar'),(36,32,1,'Registro_Controller_Participantes_index','Registro\\Controller\\Participantes/index','Registro_Controller_Participantes_index'),(37,32,2,'Registro_Controller_Participantes_upload','Registro\\Controller\\Participantes/upload','Registro_Controller_Participantes_upload'),(38,32,2,'Registro_Controller_Participantes_process','Registro\\Controller\\Participantes/process','Registro_Controller_Participantes_process'),(39,32,2,'Registro_Controller_Participantes_download','Registro\\Controller\\Participantes/download','Registro_Controller_Participantes_download'),(40,0,1,'Facturacion_Controller_Index_index','Facturacion\\Controller\\Index/index','Facturacion_Controller_Index_index'),(41,40,2,'Facturacion_Controller_Index_upload','Facturacion\\Controller\\Index/upload','Facturacion_Controller_Index_upload'),(42,40,2,'Facturacion\\Controller\\Index/download','Facturacion\\Controller\\Index/download','Facturacion_Controller_Index_download'),(43,15,2,'Cscurrencypoints_Controller_Detalle_index','Cscurrencypoints\\Controller\\Detalle/index','Cscurrencypoints_Controller_Detalle_index'),(44,1,2,'Tutorial_Controller_Index_index','Tutorial\\Controller\\Index/index','Tutorial_Controller_Index_index'),(45,0,1,'zfcuser/complete','zfcuser/complete','');
/*!40000 ALTER TABLE `resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(40) NOT NULL,
  `id_parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador',0),(2,'Vendedor del distribuidor',0),(3,'Gerente de refaccionaria',0),(4,'Auditor Total',0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal_productos`
--

DROP TABLE IF EXISTS `sucursal_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursal_productos` (
  `user_sucursal` int(11) NOT NULL,
  `producto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal_productos`
--

LOCK TABLES `sucursal_productos` WRITE;
/*!40000 ALTER TABLE `sucursal_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sucursal_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `gid` int(10) unsigned NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','desarrolladorpc@logolinemail.com.mx','soberanes','$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu',1,1,0),(2,'vendedor','paul.soberanes@adventa.mx','Vendedor','$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu',1,2,0),(3,'gerente','paul.soberanes@adventa.mx','Gerente','$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu',1,3,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `birthdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-18 18:35:46
