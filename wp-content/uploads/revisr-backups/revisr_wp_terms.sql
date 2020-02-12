
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
DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_terms` WRITE;
/*!40000 ALTER TABLE `wp_terms` DISABLE KEYS */;
INSERT INTO `wp_terms` VALUES (1,'Non classifié(e)','non-classifiee',0),(2,'simple','simple',0),(3,'grouped','grouped',0),(4,'variable','variable',0),(5,'external','external',0),(6,'exclude-from-search','exclude-from-search',0),(7,'exclude-from-catalog','exclude-from-catalog',0),(8,'featured','featured',0),(9,'outofstock','outofstock',0),(10,'rated-1','rated-1',0),(11,'rated-2','rated-2',0),(12,'rated-3','rated-3',0),(13,'rated-4','rated-4',0),(14,'rated-5','rated-5',0),(15,'Uncategorized','uncategorized',0),(16,'Business','business',0),(17,'Design','design',0),(18,'Development','development',0),(19,'Health &amp; Fitness','health-fitness',0),(20,'Marketing','marketing',0),(21,'Music','music',0),(22,'Technology','technology',0),(23,'blog','blog',0),(24,'course','course',0),(25,'lesson','lesson',0),(26,'topic','topic',0),(27,'quiz','quiz',0),(28,'post-format-gallery','post-format-gallery',0),(30,'page','page',0),(31,'Art','art',0),(35,'wc-admin-notes','wc-admin-notes',0),(36,'course','course',0),(37,'square','square',0),(54,'demo-homepage-menu','demo-homepage-menu',0),(55,'Autos &amp; Vehicles','autos-vehicles',0),(56,'Comedy','comedy',0),(57,'Education','education',0),(58,'Film &amp; Animation','film-animation',0),(59,'Gaming','gaming',0),(60,'Howto &amp; Style','howto-style',0),(61,'Music','music',0),(62,'News &amp; Politics','news-politics',0),(63,'Nonprofits &amp; Activism','nonprofits-activism',0),(64,'People &amp; Blogs','people-blogs',0),(65,'Pets &amp; Animals','pets-animals',0),(66,'Science &amp; Technology','science-technology',0),(67,'Sports','sports',0),(68,'Travel &amp; Events','travel-events',0),(69,'Installation Stage','installation-stage',0),(70,'FFmpeg Setup Stage','ffmpeg-setup-stage',0),(71,'General Usage Stage','general-usage-stage',0),(72,'wc-admin-data','wc-admin-data',0),(73,'header','header',0),(74,'custom','custom',0),(75,'main menu','main-menu',0),(76,'FuturaPT','futurapt',0),(77,'europa','europa',0),(78,'woocommerce-db-updates','woocommerce-db-updates',0),(79,'Pleine conscience','pleine-conscience',0),(80,'popup','popup',0),(81,'Landing','landing',0),(82,'Checkout (Woo)','checkout',0),(83,'Thank You (Woo)','thankyou',0),(84,'Upsell (Woo)','upsell',0),(85,'Downsell (Woo)','downsell',0),(86,'flow-1872','flow-1872',0),(87,'Uncategorized','uncategorized',0),(88,'Optional','optional',0),(89,'Optional','optional-en',0),(90,'Required','required',0),(91,'Required','required-en',0),(92,'Not needed','not-needed',0),(93,'Not needed','not-needed-en',0);
/*!40000 ALTER TABLE `wp_terms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

