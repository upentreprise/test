
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
DROP TABLE IF EXISTS `wp_redirection_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_redirection_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `match_url` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_data` text COLLATE utf8mb4_unicode_ci,
  `regex` int(11) unsigned NOT NULL DEFAULT '0',
  `position` int(11) unsigned NOT NULL DEFAULT '0',
  `last_count` int(10) unsigned NOT NULL DEFAULT '0',
  `last_access` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('enabled','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `action_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_code` int(11) unsigned NOT NULL,
  `action_data` mediumtext COLLATE utf8mb4_unicode_ci,
  `match_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `url` (`url`(191)),
  KEY `status` (`status`),
  KEY `regex` (`regex`),
  KEY `group_idpos` (`group_id`,`position`),
  KEY `group` (`group_id`),
  KEY `match_url` (`match_url`(191))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_redirection_items` WRITE;
/*!40000 ALTER TABLE `wp_redirection_items` DISABLE KEYS */;
INSERT INTO `wp_redirection_items` VALUES (1,'/fr','/fr',NULL,0,0,0,'0000-00-00 00:00:00',1,'enabled','url',301,'https://programmes.espaceatman.com/','url','');
/*!40000 ALTER TABLE `wp_redirection_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

