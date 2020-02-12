
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
DROP TABLE IF EXISTS `wp_wc_order_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wc_order_stats` (
  `order_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `num_items_sold` int(11) NOT NULL DEFAULT '0',
  `total_sales` double NOT NULL DEFAULT '0',
  `tax_total` double NOT NULL DEFAULT '0',
  `shipping_total` double NOT NULL DEFAULT '0',
  `net_total` double NOT NULL DEFAULT '0',
  `returning_customer` tinyint(1) DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `date_created` (`date_created`),
  KEY `customer_id` (`customer_id`),
  KEY `status` (`status`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_wc_order_stats` WRITE;
/*!40000 ALTER TABLE `wp_wc_order_stats` DISABLE KEYS */;
INSERT INTO `wp_wc_order_stats` VALUES (894,0,'2020-01-20 17:21:33','2020-01-20 22:21:33',1,0,0,0,0,0,'wc-completed',2),(897,0,'2020-01-20 17:27:50','2020-01-20 22:27:50',1,0,0,0,0,1,'wc-completed',2),(1096,0,'2020-01-22 09:32:32','2020-01-22 14:32:32',1,0,0,0,0,0,'wc-completed',3),(1099,0,'2020-01-22 09:36:44','2020-01-22 14:36:44',1,0,0,0,0,1,'wc-completed',3),(1101,0,'2020-01-22 10:06:59','2020-01-22 15:06:59',1,0,0,0,0,1,'wc-completed',3),(1104,0,'2020-01-22 10:47:52','2020-01-22 15:47:52',1,0,0,0,0,1,'wc-completed',3),(1106,0,'2020-01-22 10:59:00','2020-01-22 15:59:00',1,0,0,0,0,1,'wc-completed',3),(1109,0,'2020-01-22 11:37:20','2020-01-22 16:37:20',1,0,0,0,0,0,'wc-completed',4),(1118,0,'2020-01-23 04:06:53','2020-01-23 09:06:53',1,0,0,0,0,1,'wc-completed',3),(1126,0,'2020-01-23 04:14:51','2020-01-23 09:14:51',1,0,0,0,0,1,'wc-completed',3),(1129,0,'2020-01-23 04:24:12','2020-01-23 09:24:12',1,0,0,0,0,0,'wc-completed',5),(1139,0,'2020-01-23 05:39:41','2020-01-23 10:39:41',1,0,0,0,0,0,'wc-completed',6),(1143,0,'2020-01-23 06:37:10','2020-01-23 11:37:10',1,0,0,0,0,0,'wc-completed',7),(1150,0,'2020-01-23 06:53:28','2020-01-23 11:53:28',1,0,0,0,0,0,'wc-completed',8),(1311,0,'2020-01-27 15:20:16','2020-01-27 20:20:16',1,0,0,0,0,0,'wc-completed',9),(1316,0,'2020-01-27 16:33:00','2020-01-27 21:33:00',1,0,0,0,0,0,'wc-completed',10),(1326,0,'2020-01-27 17:09:36','2020-01-27 22:09:36',1,0,0,0,0,0,'wc-completed',11),(1330,0,'2020-01-27 17:31:27','2020-01-27 22:31:27',1,0,0,0,0,0,'wc-completed',12),(1366,0,'2020-01-28 11:40:13','2020-01-28 16:40:13',1,0,0,0,0,0,'wc-completed',13),(1388,0,'2020-01-28 20:10:18','2020-01-29 01:10:18',1,0,0,0,0,0,'wc-completed',14),(1454,0,'2020-01-29 22:29:11','2020-01-30 03:29:11',1,0,0,0,0,0,'wc-completed',15),(1479,0,'2020-01-30 15:28:29','2020-01-30 20:28:29',1,1.73,0.23,0,1.5,1,'wc-refunded',15),(1483,1479,'2020-01-30 15:32:40','2020-01-30 20:32:40',-1,-1.73,-0.23,0,-1.5,NULL,'wc-completed',15),(1487,0,'2020-01-30 15:36:03','2020-01-30 20:36:03',1,1.73,0.23,0,1.5,1,'wc-refunded',15),(1491,1487,'2020-01-30 16:09:53','2020-01-30 21:09:53',-1,-1.73,-0.23,0,-1.5,NULL,'wc-completed',15),(1586,0,'2020-01-31 14:49:54','2020-01-31 19:49:54',1,1.73,0.23,0,1.5,0,'wc-completed',16),(1593,0,'2020-01-31 15:02:12','2020-01-31 20:02:12',1,0,0,0,0,0,'wc-completed',17),(1600,0,'2020-01-31 15:21:50','2020-01-31 20:21:50',1,0,0,0,0,0,'wc-completed',18),(1767,0,'2020-02-01 10:42:01','2020-02-01 15:42:01',1,0,0,0,0,0,'wc-completed',19),(1773,0,'2020-02-01 10:59:19','2020-02-01 15:59:19',1,0,0,0,0,0,'wc-completed',20),(1806,0,'2020-02-01 13:13:08','2020-02-01 18:13:08',1,0,0,0,0,0,'wc-completed',21),(1817,0,'2020-02-01 14:48:25','2020-02-01 19:48:25',1,1.73,0.23,0,1.5,0,'wc-refunded',22),(1838,0,'2020-02-01 20:32:16','2020-02-02 01:32:16',1,1.73,0.23,0,1.5,0,'wc-completed',23),(1883,0,'2020-02-02 10:02:21','2020-02-02 15:02:21',1,0,0,0,0,1,'wc-completed',21),(1887,1817,'2020-02-02 10:54:20','2020-02-02 15:54:20',-1,-1.73,-0.23,0,-1.5,NULL,'wc-completed',22),(1892,0,'2020-02-02 10:58:47','2020-02-02 15:58:47',1,1.73,0.23,0,1.5,0,'wc-refunded',25),(2031,0,'2020-02-02 13:27:06','2020-02-02 18:27:06',1,0,0,0,0,1,'wc-completed',21),(2038,1892,'2020-02-02 14:09:53','2020-02-02 19:09:53',-1,-1.73,-0.23,0,-1.5,NULL,'wc-completed',25),(2042,0,'2020-02-02 14:19:05','2020-02-02 19:19:05',1,172.45,22.46,0,149.99,0,'wc-completed',26),(2045,0,'2020-02-02 14:21:17','2020-02-02 19:21:17',1,1.73,0.23,0,1.5,0,'wc-completed',27),(2053,0,'2020-02-02 14:48:45','2020-02-02 19:48:45',1,0,0,0,0,1,'wc-completed',21),(2059,0,'2020-02-02 15:31:54','2020-02-02 20:31:54',1,0,0,0,0,1,'wc-completed',21),(2069,0,'2020-02-02 22:26:22','2020-02-03 03:26:22',1,172.45,22.46,0,149.99,0,'wc-failed',28),(2081,0,'2020-02-03 06:52:22','2020-02-03 11:52:22',1,172.45,22.46,0,149.99,0,'wc-completed',29),(2138,0,'2020-02-04 13:36:51','2020-02-04 18:36:51',1,0,0,0,0,0,'wc-completed',30),(2163,0,'2020-02-05 09:54:41','2020-02-05 14:54:41',1,0,0,0,0,0,'wc-completed',31),(2218,0,'2020-02-06 19:33:46','2020-02-07 00:33:46',1,0,0,0,0,0,'wc-completed',32),(2272,0,'2020-02-08 08:36:56','2020-02-08 13:36:56',1,0,0,0,0,1,'wc-completed',21),(2341,0,'2020-02-10 08:23:03','2020-02-10 13:23:03',1,0,0,0,0,0,'wc-completed',33);
/*!40000 ALTER TABLE `wp_wc_order_stats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

