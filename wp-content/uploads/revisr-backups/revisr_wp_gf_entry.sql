
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
DROP TABLE IF EXISTS `wp_gf_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_gf_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `is_starred` tinyint(1) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(39) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_agent` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_amount` decimal(19,2) DEFAULT NULL,
  `payment_method` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_fulfilled` tinyint(1) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `transaction_type` tinyint(1) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `form_id_status` (`form_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_gf_entry` WRITE;
/*!40000 ALTER TABLE `wp_gf_entry` DISABLE KEYS */;
INSERT INTO `wp_gf_entry` VALUES (1,1,NULL,'2020-01-29 16:47:12','2020-01-29 16:47:12',0,0,'127.0.0.1','https://programmes.espaceatman.com/','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36','CAD',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,'active'),(2,1,NULL,'2020-01-31 14:57:51','2020-01-31 14:57:51',0,0,'127.0.0.1','https://programmes.espaceatman.com/','Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/81.0.264749124 Mobile/15E148 Safari/605.1','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(3,1,NULL,'2020-01-31 14:59:38','2020-01-31 14:59:38',0,0,'127.0.0.1','https://programmes.espaceatman.com/','Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/81.0.264749124 Mobile/15E148 Safari/605.1','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(4,1,NULL,'2020-01-31 15:01:41','2020-01-31 15:01:41',0,0,'127.0.0.1','https://programmes.espaceatman.com/','Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/81.0.264749124 Mobile/15E148 Safari/605.1','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(5,1,NULL,'2020-02-02 17:17:03','2020-02-02 17:17:03',0,0,'107.171.210.210','https://programmes.espaceatman.com/','Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(6,1,NULL,'2020-02-02 20:08:04','2020-02-02 20:08:04',0,0,'65.92.82.112','https://programmes.espaceatman.com/fr/','Mozilla/5.0 (Linux; Android 9; SAMSUNG SM-G965W) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/10.2 Chrome/71.0.3578.99 Mobile Safari/537.36','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(7,1,NULL,'2020-02-02 22:00:14','2020-02-02 22:00:14',0,0,'24.225.150.14','https://programmes.espaceatman.com/fr/','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/18.17763','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(8,1,NULL,'2020-02-03 10:40:13','2020-02-03 10:40:13',0,0,'207.164.113.232','https://programmes.espaceatman.com/fr/','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.4 Safari/605.1.15','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(9,1,NULL,'2020-02-03 13:24:12','2020-02-03 13:24:12',0,0,'173.176.56.40','https://programmes.espaceatman.com/fr/','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.4 Safari/605.1.15','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(10,1,NULL,'2020-02-03 16:17:26','2020-02-03 16:17:26',0,0,'24.203.103.185','https://programmes.espaceatman.com/','Mozilla/5.0 (Linux; Android 9; SAMSUNG SM-A205W) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/10.2 Chrome/71.0.3578.99 Mobile Safari/537.36','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active'),(11,1,NULL,'2020-02-10 01:26:40','2020-02-10 01:26:40',0,0,'166.62.157.116','https://programmes.espaceatman.com/','Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBDV/iPhone10,4;FBMD/iPhone;FBSN/iOS;FBSV/13.3;FBSS/2;FBID/phone;FBLC/fr_CA;FBOP/5;FBCR/Fido]','CAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active');
/*!40000 ALTER TABLE `wp_gf_entry` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

