
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
DROP TABLE IF EXISTS `wp_wc_customer_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wc_customer_lookup` (
  `customer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_last_active` timestamp NULL DEFAULT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `country` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `postcode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_wc_customer_lookup` WRITE;
/*!40000 ALTER TABLE `wp_wc_customer_lookup` DISABLE KEYS */;
INSERT INTO `wp_wc_customer_lookup` VALUES (1,4,'test','Test','','test@test.com',NULL,'2020-01-14 19:51:10','','','',''),(2,NULL,'','Guillaume','Bleau','sysadmin@upentreprise.com','2020-01-20 22:21:33',NULL,'CA','J6E 0X6','Joliette','QC'),(3,NULL,'','selvan','selvan','selvans011@gmail.com','2020-01-22 14:32:32',NULL,'LK','20544','Kandy',''),(4,NULL,'','selvan','selvan','perinbaselvan011@gmail.com','2020-01-22 16:37:20',NULL,'LK','20544','Kandy',''),(5,8,'selvan.selvan','selvan','selvan','selvans011@gmail.com','2020-01-23 00:00:00','2020-01-23 09:24:11','LK','20544','Kandy',''),(6,9,'selvan.selvan','selvan','selvan','perinbaselvan011@gmail.com','2020-01-23 00:00:00','2020-01-23 10:39:40','LK','20544','Kandy',''),(7,10,'selvan.selvan','selvan','selvan','selvans011@gmail.com','2020-01-23 00:00:00','2020-01-23 11:37:09','LK','20544','Kandy',''),(8,11,'selvan.selvan','selvan','selvan','selvans011@gmail.com','2020-01-23 00:00:00','2020-01-23 11:53:26','LK','20544','Kandy',''),(9,13,'guillaume.bleau','Guillaume','Bleau','production@upentreprise.com','2020-01-27 00:00:00','2020-01-27 20:20:15','CA','J6E 0X6','Joliette','QC'),(10,14,'guillaume.bleau','Guillaume','Bleau','production@upentreprise.com','2020-01-27 00:00:00','2020-01-27 21:32:59','CA','J6E 0X6','Joliette','QC'),(11,15,'gros.babouin','Gros','Babouin','gros.babouin@upentreprise.com','2020-01-27 00:00:00','2020-01-27 22:09:35','CA','J6E 0X6','Joliette','QC'),(12,16,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-01-27 00:00:00','2020-01-27 22:31:26','CA','J6E 0X6','Joliette','QC'),(13,17,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-01-28 00:00:00','2020-01-28 16:40:12','CA','J6E 0X6','Joliette','QC'),(14,18,'julien.remo','Julien','Remo','jul.remo@gmail.com','2020-01-29 00:00:00','2020-01-29 01:10:17','CA','J0K 2T0','Sainte-Julienne','QC'),(15,3,'guillaume','Guillaume','Bleau','guillaume.bleau@upbusiness.ca','2020-01-30 00:00:00','2020-01-14 18:21:33','CA','J6E 0X6','Joliette','QC'),(16,19,'julien.remo-3681','Julien','Remo','julien@espaceatman.com','2020-02-01 00:00:00','2020-01-31 19:49:53','CA','J0K 2T0','Sainte-Julienne','QC'),(17,1,'info@espaceatman.com','Julien','Remo','info@espaceatman.com','2020-02-09 00:00:00','2020-01-13 20:45:57','CA','J0K 2T0','Sainte-Julienne','QC'),(18,20,'alysson.martel','Alysson','Martel','martelsimplicity@hotmail.com','2020-01-31 00:00:00','2020-01-31 20:21:49','CA','J0K 1T0','Ste-Julienne','QC'),(19,24,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-02-01 00:00:00','2020-02-01 15:42:01','CA','J6E 0X6','Joliette','QC'),(20,25,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-02-01 00:00:00','2020-02-01 15:59:18','CA','J6E 0X6','Joliette','QC'),(21,5,'dev','Équipe de développement /','Development Team','dev@upentreprise.com','2020-02-10 00:00:00','2020-01-20 16:40:47','CA','H4M 1B0','ada','QC'),(22,27,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-02-01 00:00:00','2020-02-01 19:48:24','CA','J6E 0X6','Joliette','QC'),(23,28,'julien.remo','Julien','Remo','jul.remo@gmail.com','2020-02-02 00:00:00','2020-02-02 01:32:15','CA','J0K 2T0','Sainte-Julienne','QC'),(24,26,'cooray2017','','','cooray2017@gmail.com','2020-02-02 00:00:00','2020-02-01 16:05:42','','','',''),(25,29,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-02-02 00:00:00','2020-02-02 15:58:46','CA','J6E 0X6','Joliette','QC'),(26,30,'sylvie.dube','Sylvie','Dube','sylvdube@videotron.ca','2020-02-04 00:00:00','2020-02-02 19:19:04','CA','J7L 2P4','MASCOUCHE','QC'),(27,31,'mononcle.bleau','Mononcle','Bleau','production@upentreprise.com','2020-02-02 00:00:00','2020-02-02 19:21:17','CA','J6E 0X6','Joliette','QC'),(28,33,'sylvain.desrochers','Sylvain','Desrochers','s.desrochers1974@hotmail.ca','2020-02-03 00:00:00','2020-02-03 03:26:21','CA','J0K 1C0','Saint-Ambroise de Kildare','QC'),(29,34,'viviane.lacombe','Viviane','Lacombe','viviane.lacombe.c@gmail.com','2020-02-07 00:00:00','2020-02-03 11:52:21','CA','H4E 2W2','Montréal','QC'),(30,35,'vb.bbb','Vb','Bbb','cooray2017@gmail.com','2020-02-05 00:00:00','2020-02-04 18:36:50','CA','H4M 1B0','Bjhb','QC'),(31,36,'matante.bleau','Matante','Bleau','production@upentreprise.com','2020-02-05 00:00:00','2020-02-05 14:54:40','CA','J6E 0X6','Joliette','QC'),(32,38,'julien.remo','Julien','Remo','jul.remo@gmail.com','2020-02-07 00:00:00','2020-02-07 00:33:45','CA','J0K 2T0','Sainte-Julienne','QC'),(33,39,'cc.cooray','Cc','Cooray','charleshan0078@gmail.com','2020-02-10 00:00:00','2020-02-10 13:23:02','CA','G1A 0A2','Torna','QC');
/*!40000 ALTER TABLE `wp_wc_customer_lookup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

