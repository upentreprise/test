
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
DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_term_taxonomy` WRITE;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES (1,1,'category','',0,2),(2,2,'product_type','',0,0),(3,3,'product_type','',0,0),(4,4,'product_type','',0,0),(5,5,'product_type','',0,0),(6,6,'product_visibility','',0,0),(7,7,'product_visibility','',0,0),(8,8,'product_visibility','',0,0),(9,9,'product_visibility','',0,0),(10,10,'product_visibility','',0,0),(11,11,'product_visibility','',0,0),(12,12,'product_visibility','',0,0),(13,13,'product_visibility','',0,0),(14,14,'product_visibility','',0,0),(15,15,'product_cat','',0,0),(16,16,'category','Some category description goes here.',0,0),(17,17,'category','',0,0),(18,18,'category','Some category description goes here.',0,0),(19,19,'category','',0,0),(20,20,'category','',0,0),(21,21,'category','',0,0),(22,22,'category','',0,0),(23,23,'post_tag','',0,0),(24,24,'post_tag','',0,0),(25,25,'post_tag','',0,0),(26,26,'post_tag','',0,0),(27,27,'post_tag','',0,0),(28,28,'post_format','',0,0),(30,30,'elementor_library_type','',0,0),(31,31,'tribe_events_cat','',0,0),(35,35,'action-group','',0,383),(36,36,'product_type','',0,2),(37,37,'action-group','',0,5),(54,54,'nav_menu','',0,6),(55,55,'spreebie_transcoder_category','',0,0),(56,56,'spreebie_transcoder_category','',0,0),(57,57,'spreebie_transcoder_category','',0,0),(58,58,'spreebie_transcoder_category','',0,0),(59,59,'spreebie_transcoder_category','',0,0),(60,60,'spreebie_transcoder_category','',0,0),(61,61,'spreebie_transcoder_category','',0,0),(62,62,'spreebie_transcoder_category','',0,0),(63,63,'spreebie_transcoder_category','',0,0),(64,64,'spreebie_transcoder_category','',0,0),(65,65,'spreebie_transcoder_category','',0,0),(66,66,'spreebie_transcoder_category','',0,0),(67,67,'spreebie_transcoder_category','',0,0),(68,68,'spreebie_transcoder_category','',0,0),(69,69,'spreebie_transcoder_error_stage','',0,0),(70,70,'spreebie_transcoder_error_stage','',0,0),(71,71,'spreebie_transcoder_error_stage','',0,0),(72,72,'action-group','',0,94),(73,73,'elementor_library_type','',0,7),(74,74,'elementor_font_type','',0,0),(75,75,'nav_menu','',0,17),(76,76,'bsf_custom_fonts','',0,0),(77,77,'bsf_custom_fonts','',0,0),(78,78,'action-group','',0,6),(79,79,'product_cat','',0,2),(80,80,'elementor_library_type','',0,1),(81,81,'cartflows_step_type','',0,0),(82,82,'cartflows_step_type','',0,1),(83,83,'cartflows_step_type','',0,0),(84,84,'cartflows_step_type','',0,0),(85,85,'cartflows_step_type','',0,0),(86,86,'cartflows_step_flow','',0,1),(87,87,'category','',0,0),(88,88,'translation_priority','',0,8),(89,89,'translation_priority','',0,1),(90,90,'translation_priority','',0,0),(91,91,'translation_priority','',0,0),(92,92,'translation_priority','',0,0),(93,93,'translation_priority','',0,0);
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

