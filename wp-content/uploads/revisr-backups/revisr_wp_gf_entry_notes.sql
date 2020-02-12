
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
DROP TABLE IF EXISTS `wp_gf_entry_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_gf_entry_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) unsigned NOT NULL,
  `user_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `note_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `entry_user_key` (`entry_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_gf_entry_notes` WRITE;
/*!40000 ALTER TABLE `wp_gf_entry_notes` DISABLE KEYS */;
INSERT INTO `wp_gf_entry_notes` VALUES (1,1,'Admin Notification (ID: 5e31b2ce5653b)',0,'2020-01-29 16:47:14','WordPress successfully passed the notification email to the sending server.','notification','success'),(2,2,'Admin Notification (ID: 5e31b2ce5653b)',0,'2020-01-31 14:57:54','WordPress successfully passed the notification email to the sending server.','notification','success'),(3,3,'Admin Notification (ID: 5e31b2ce5653b)',0,'2020-01-31 14:59:40','WordPress successfully passed the notification email to the sending server.','notification','success'),(4,4,'Admin Notification (ID: 5e31b2ce5653b)',0,'2020-01-31 15:01:44','WordPress successfully passed the notification email to the sending server.','notification','success'),(5,5,'Admin Notification (ID: 5e31b2ce5653b)',0,'2020-02-02 17:17:05','WordPress successfully passed the notification email to the sending server.','notification','success'),(6,6,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-02 20:08:05','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success'),(7,7,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-02 22:00:16','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success'),(8,8,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-03 10:40:15','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success'),(9,9,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-03 13:24:13','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success'),(10,10,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-03 16:17:28','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success'),(11,11,'Admin Notification (ID : 5e31b2ce5653b)',0,'2020-02-10 01:26:42','WordPress a bien passé l’e-mail de notification au serveur d’envoi.','notification','success');
/*!40000 ALTER TABLE `wp_gf_entry_notes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

