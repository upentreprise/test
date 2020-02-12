
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
DROP TABLE IF EXISTS `wp_pp_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_pp_groups` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metagroup_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `metagroup_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `pp_grp_metaid` (`metagroup_type`,`metagroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_pp_groups` WRITE;
/*!40000 ALTER TABLE `wp_pp_groups` DISABLE KEYS */;
INSERT INTO `wp_pp_groups` VALUES (1,'[WP administrator]','All users with a WordPress administrator role','administrator','wp_role'),(2,'[WP editor]','All users with a WordPress editor role','editor','wp_role'),(3,'[WP author]','All users with a WordPress author role','author','wp_role'),(4,'[WP contributor]','All users with a WordPress contributor role','contributor','wp_role'),(5,'[WP subscriber]','All users with a WordPress subscriber role','subscriber','wp_role'),(6,'[WP customer]','All users with a WordPress customer role','customer','wp_role'),(7,'[WP shop_manager]','All users with a WordPress shop_manager role','shop_manager','wp_role'),(8,'[WP group_leader]','All users with a WordPress group_leader role','group_leader','wp_role'),(9,'[WP wpseo_manager]','All users with a WordPress wpseo_manager role','wpseo_manager','wp_role'),(10,'[WP wpseo_editor]','All users with a WordPress wpseo_editor role','wpseo_editor','wp_role'),(11,'{Anonymous}','Anonymous users (not logged in)','wp_anon','wp_role'),(12,'{Authenticated}','All users who are logged in and have a role on the site','wp_auth','wp_role'),(13,'{All}','All users (including anonymous)','wp_all','wp_role'),(14,'[Pending Revision Monitors]','Administrators / Publishers to notify (by default) of pending revisions','rvy_pending_rev_notice','rvy_notice'),(15,'[Scheduled Revision Monitors]','Administrators / Publishers to notify when any scheduled revision is published','rvy_scheduled_rev_notice','rvy_notice');
/*!40000 ALTER TABLE `wp_pp_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

