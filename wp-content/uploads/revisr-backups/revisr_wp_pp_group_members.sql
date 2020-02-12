
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
DROP TABLE IF EXISTS `wp_pp_group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_pp_group_members` (
  `group_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `member_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `add_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_limited` tinyint(2) NOT NULL DEFAULT '0',
  `start_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date_gmt` datetime NOT NULL DEFAULT '2035-01-01 00:00:00',
  KEY `pp_group_user` (`group_id`,`user_id`),
  KEY `pp_member_status` (`status`,`member_type`),
  KEY `pp_member_date` (`start_date_gmt`,`end_date_gmt`,`date_limited`,`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_pp_group_members` WRITE;
/*!40000 ALTER TABLE `wp_pp_group_members` DISABLE KEYS */;
INSERT INTO `wp_pp_group_members` VALUES (1,1,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(1,2,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(1,3,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(1,5,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(1,12,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,18,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,19,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,20,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,22,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,23,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,26,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00'),(6,27,'member','active','0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2035-01-01 00:00:00');
/*!40000 ALTER TABLE `wp_pp_group_members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

