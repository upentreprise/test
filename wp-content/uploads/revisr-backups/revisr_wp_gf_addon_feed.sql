
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
DROP TABLE IF EXISTS `wp_gf_addon_feed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_gf_addon_feed` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `feed_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `meta` longtext COLLATE utf8mb4_unicode_ci,
  `addon_slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addon_form` (`addon_slug`,`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_gf_addon_feed` WRITE;
/*!40000 ALTER TABLE `wp_gf_addon_feed` DISABLE KEYS */;
INSERT INTO `wp_gf_addon_feed` VALUES (1,1,1,0,'{\"feed_name\":\"Ajout au webinaire du 15 f\\u00e9vrier 2020\",\"list\":\"18\",\"fields_email\":\"2\",\"fields_first_name\":\"1.3\",\"fields_last_name\":\"1.6\",\"fields_phone\":\"\",\"fields_orgname\":\"\",\"custom_fields\":[{\"key\":\"\",\"value\":\"\",\"custom_key\":\"\"}],\"tags\":\"Webinaire \\u00c9volution 15 f\\u00e9vrier 2020\",\"note\":\"\",\"feed_condition_conditional_logic\":\"0\",\"feed_condition_conditional_logic_object\":[],\"instant_responders\":\"1\",\"last_message\":\"1\"}','gravityformsactivecampaign',NULL);
/*!40000 ALTER TABLE `wp_gf_addon_feed` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

