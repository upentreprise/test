
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
DROP TABLE IF EXISTS `wp_gf_entry_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_gf_entry_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `entry_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  `item_index` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_key` (`meta_key`(191)),
  KEY `entry_id` (`entry_id`),
  KEY `meta_value` (`meta_value`(191))
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_gf_entry_meta` WRITE;
/*!40000 ALTER TABLE `wp_gf_entry_meta` DISABLE KEYS */;
INSERT INTO `wp_gf_entry_meta` VALUES (1,1,1,'1.3','Guillaume',''),(2,1,1,'1.6','Bleau',''),(3,1,1,'2','guillaume.bleau@upbusiness.ca',''),(4,1,1,'gravityformsactivecampaign_is_fulfilled','1',NULL),(5,1,1,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(6,1,2,'1.3','Julien',''),(7,1,2,'1.6','Remo',''),(8,1,2,'2','Jul.Remo@gmail.com',''),(9,1,2,'gravityformsactivecampaign_is_fulfilled','1',NULL),(10,1,2,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(11,1,3,'1.3','Julien',''),(12,1,3,'1.6','Remo',''),(13,1,3,'2','Jul.Remo@gmail.com',''),(14,1,3,'gravityformsactivecampaign_is_fulfilled','1',NULL),(15,1,3,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(16,1,4,'1.3','Julien',''),(17,1,4,'1.6','Remo',''),(18,1,4,'2','Jul.Remo@gmail.com',''),(19,1,4,'gravityformsactivecampaign_is_fulfilled','1',NULL),(20,1,4,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(21,1,5,'1.3','Lacombe',''),(22,1,5,'1.6','Viviane',''),(23,1,5,'2','Viviane.lacombe.c@gmail.com',''),(24,1,5,'gravityformsactivecampaign_is_fulfilled','1',NULL),(25,1,5,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(26,1,6,'1.3','Nathalie',''),(27,1,6,'1.6','Caron',''),(28,1,6,'2','nath.caron@sympatico.ca',''),(29,1,6,'gravityformsactivecampaign_is_fulfilled','1',NULL),(30,1,6,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(31,1,7,'1.3','danielle',''),(32,1,7,'1.6','Pothel',''),(33,1,7,'2','danpoth@videotorn.ca',''),(34,1,7,'gravityformsactivecampaign_is_fulfilled','1',NULL),(35,1,7,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(36,1,8,'1.3','Marie-lyne',''),(37,1,8,'1.6','Lafond',''),(38,1,8,'2','marielynelafond@gmail.com',''),(39,1,8,'gravityformsactivecampaign_is_fulfilled','1',NULL),(40,1,8,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(41,1,9,'1.3','Sylvie',''),(42,1,9,'1.6','Dube',''),(43,1,9,'2','Sylvdube@videotron.ca',''),(44,1,9,'gravityformsactivecampaign_is_fulfilled','1',NULL),(45,1,9,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(46,1,10,'1.3','Lynne',''),(47,1,10,'1.6','Lambert',''),(48,1,10,'2','lynne.lambert@hotmail.com',''),(49,1,10,'gravityformsactivecampaign_is_fulfilled','1',NULL),(50,1,10,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL),(51,1,11,'1.3','Amelie',''),(52,1,11,'1.6','Gaumond',''),(53,1,11,'2','Agaumond@cible-emploi.qc.ca',''),(54,1,11,'gravityformsactivecampaign_is_fulfilled','1',NULL),(55,1,11,'processed_feeds','a:1:{s:26:\"gravityformsactivecampaign\";a:1:{i:0;s:1:\"1\";}}',NULL);
/*!40000 ALTER TABLE `wp_gf_entry_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

