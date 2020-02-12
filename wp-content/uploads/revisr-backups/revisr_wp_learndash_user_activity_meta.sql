
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
DROP TABLE IF EXISTS `wp_learndash_user_activity_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_learndash_user_activity_meta` (
  `activity_meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `activity_meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_meta_value` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`activity_meta_id`),
  KEY `activity_id` (`activity_id`),
  KEY `activity_meta_key` (`activity_meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_learndash_user_activity_meta` WRITE;
/*!40000 ALTER TABLE `wp_learndash_user_activity_meta` DISABLE KEYS */;
INSERT INTO `wp_learndash_user_activity_meta` VALUES (1,1,'steps_total','3'),(2,1,'steps_completed','1'),(3,1,'steps_last_id','767'),(4,2,'steps_total','1'),(5,2,'steps_completed','0'),(6,3,'steps_total','1'),(7,3,'steps_completed','0'),(8,3,'steps_last_id','419'),(9,4,'steps_total','1'),(10,4,'steps_completed','0'),(11,6,'steps_total','11'),(12,6,'steps_completed','0'),(13,6,'steps_last_id','614'),(14,7,'steps_total','11'),(15,7,'steps_completed','0'),(16,8,'steps_total','11'),(17,8,'steps_completed','0'),(18,9,'steps_total','11'),(19,9,'steps_completed','0'),(20,10,'steps_total','11'),(21,10,'steps_completed','0'),(22,11,'steps_total','0'),(23,11,'steps_completed','0'),(24,12,'steps_total','0'),(25,12,'steps_completed','0'),(26,13,'steps_total','0'),(27,13,'steps_completed','0'),(28,14,'steps_total','0'),(29,14,'steps_completed','0'),(30,15,'steps_total','3'),(31,15,'steps_completed','1'),(32,16,'steps_total','3'),(33,16,'steps_completed','0'),(34,17,'steps_total','3'),(35,17,'steps_completed','1'),(36,18,'steps_total','1'),(37,18,'steps_completed','0'),(38,18,'steps_last_id','818'),(39,19,'steps_total','1'),(40,19,'steps_completed','0'),(41,20,'steps_total','0'),(42,20,'steps_completed','0'),(43,21,'steps_total','3'),(44,21,'steps_completed','0'),(45,22,'steps_total','3'),(46,22,'steps_completed','0'),(47,23,'steps_total','0'),(48,23,'steps_completed','0'),(56,31,'steps_total','0'),(57,31,'steps_completed','0'),(58,32,'steps_total','0'),(59,32,'steps_completed','0'),(60,42,'steps_total','0'),(61,42,'steps_completed','0'),(62,43,'steps_total','1'),(63,43,'steps_completed','0'),(64,43,'steps_last_id','1185'),(65,44,'steps_total','1'),(66,44,'steps_completed','0'),(67,45,'steps_total','7'),(68,45,'steps_completed','0'),(69,46,'steps_total','7'),(70,46,'steps_completed','0'),(71,47,'steps_total','1'),(72,47,'steps_completed','1'),(73,47,'steps_last_id','1185'),(74,48,'steps_total','1'),(75,48,'steps_completed','1'),(76,49,'steps_total','4'),(77,49,'steps_completed','1'),(78,49,'steps_last_id','1185'),(79,50,'steps_total','4'),(80,50,'steps_completed','1'),(91,61,'steps_total','0'),(92,61,'steps_completed','0'),(93,62,'steps_total','0'),(94,62,'steps_completed','0'),(95,63,'steps_total','0'),(96,63,'steps_completed','0'),(97,64,'steps_total','4'),(98,64,'steps_completed','0'),(99,69,'steps_total','4'),(100,69,'steps_completed','0'),(101,69,'steps_last_id','1185'),(102,70,'steps_total','4'),(103,70,'steps_completed','0'),(104,71,'steps_total','4'),(105,71,'steps_completed','0'),(106,72,'steps_total','4'),(107,72,'steps_completed','0'),(108,73,'steps_total','4'),(109,73,'steps_completed','0'),(110,73,'steps_last_id','1185'),(111,74,'steps_total','4'),(112,74,'steps_completed','0'),(113,75,'steps_total','4'),(114,75,'steps_completed','0'),(115,76,'steps_total','4'),(116,76,'steps_completed','0'),(117,77,'steps_total','4'),(118,77,'steps_completed','0'),(119,80,'steps_total','4'),(120,80,'steps_completed','4'),(121,80,'steps_last_id','1848'),(122,81,'steps_total','4'),(123,81,'steps_completed','2'),(124,82,'steps_total','4'),(125,82,'steps_completed','3'),(126,83,'steps_total','4'),(127,83,'steps_completed','1'),(128,84,'steps_total','4'),(129,84,'steps_completed','4'),(130,86,'steps_total','4'),(131,86,'steps_completed','0'),(132,86,'steps_last_id','1185'),(133,87,'steps_total','4'),(134,87,'steps_completed','0');
/*!40000 ALTER TABLE `wp_learndash_user_activity_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

