-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: imsnew
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `dept_wise_details`
--

DROP TABLE IF EXISTS `dept_wise_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dept_wise_details` (
  `purchase_id` int(11) DEFAULT NULL,
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dept_residing` varchar(100) DEFAULT NULL,
  `consumable` varchar(3) DEFAULT NULL,
  `report` longtext,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dept_wise_details`
--

LOCK TABLES `dept_wise_details` WRITE;
/*!40000 ALTER TABLE `dept_wise_details` DISABLE KEYS */;
INSERT INTO `dept_wise_details` VALUES (NULL,2,'wer',NULL,NULL,NULL,NULL),(NULL,3,'def',NULL,NULL,NULL,NULL),(NULL,4,'frg',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dept_wise_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date DEFAULT NULL,
  `purchase_time` time DEFAULT NULL,
  `invoice_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost_per_unit` float DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  `consumable` varchar(3) DEFAULT NULL,
  `invoice_bought_from` varchar(100) DEFAULT NULL,
  `distributed_to_dept` varchar(100) DEFAULT NULL,
  `report` longtext,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (7,'2019-11-14','23:45:00','books',23,50,1150,'no','S r stationaries','cse','good'),(8,'2019-11-15','10:23:00','sticks',450,7,3150,'no','R S E','sports','good quality'),(9,'2019-11-19','10:45:00','chalk',300,3,900,'yes','sr stationaries','cse','medium quality'),(11,'2019-11-01','14:45:00','aps',3,3,9,'yes','aps','aps','aps'),(19,'2019-11-06','00:00:00','vid',4,4,16,'yes','vid','vid','vid'),(20,'2019-11-06','23:45:00','aps',4,4,16,'yes','aps','aps','aps');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER insstock AFTER INSERT ON purchase FOR EACH ROW INSERT INTO stock_details(purchase_id,stock_name,quantity,dept_residing,consumable,report) VALUES(NEW.purchase_id,NEW.invoice_name,NEW.quantity,NEW.distributed_to_dept,NEW.consumable,NEW.report) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `purchase_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_date` date DEFAULT NULL,
  `sales_time` time DEFAULT NULL,
  `stock_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `consumable` varchar(3) DEFAULT NULL,
  `delivered_from` varchar(100) DEFAULT NULL,
  `delivered_to` varchar(100) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `report` longtext,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (8,9,25,'2019-11-14','11:45:00','sticks',45,'yes','sports','rsv',450,'good quality'),(8,9,26,'2019-11-06','23:45:00','sticks',350,'yes','sports','CVS',670,'good quality'),(7,8,27,'2019-11-14','11:56:00','books',20,'no','cse','ece',560,'good');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_details`
--

DROP TABLE IF EXISTS `stock_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_details` (
  `purchase_id` int(11) DEFAULT NULL,
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dept_residing` varchar(100) DEFAULT NULL,
  `consumable` varchar(3) DEFAULT NULL,
  `report` longtext,
  `sales_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_details`
--

LOCK TABLES `stock_details` WRITE;
/*!40000 ALTER TABLE `stock_details` DISABLE KEYS */;
INSERT INTO `stock_details` VALUES (7,8,'books',3,'cse','no','good',27),(8,9,'sticks',405,'sports','yes','good quality',25),(9,10,'chalk',300,'cse','yes','medium quality',NULL),(8,11,'sticks',55,'sports','yes','good quality',26),(11,12,'aps',3,'aps','yes','aps',NULL),(19,15,'vid',4,'vid','yes','vid',NULL),(20,16,'aps',4,'aps','yes','aps',NULL);
/*!40000 ALTER TABLE `stock_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL,
  `marks` int(3) DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'wersty','3',34,'fe');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
INSERT INTO `user_login` VALUES (1,'abc','abc@xyz.com','123456'),(2,'vidya','vidya@example.com','Hassan@123'),(3,'xyz','abc@xyz.com','123456'),(4,'vidya','vidyashreehs1201@gmail.com','0987654321');
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-23 20:00:45
