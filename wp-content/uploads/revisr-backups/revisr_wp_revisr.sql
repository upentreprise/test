
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
DROP TABLE IF EXISTS `wp_revisr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_revisr` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text,
  `event` varchar(42) NOT NULL,
  `user` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_revisr` WRITE;
/*!40000 ALTER TABLE `wp_revisr` DISABLE KEYS */;
INSERT INTO `wp_revisr` VALUES (1,'2020-02-08 13:13:10','Error pulling changes from the remote repository.','error','dev'),(2,'2020-02-10 04:38:31','Successfully created a new repository.','init','dev'),(3,'2020-02-10 04:42:27','Successfully backed up the database.','backup','dev'),(4,'2020-02-10 04:42:27','Committed <a href=\"https://programmes.espaceatman.com/wp-admin/admin.php?page=revisr_view_commit&commit=65818b3&success=true\">#65818b3</a> to the local repository.','commit','dev'),(5,'2020-02-10 04:43:39','Created new branch: Évolution-program-is-published','branch','dev'),(6,'2020-02-10 04:44:58','Created new branch: bbPress','branch','dev'),(7,'2020-02-10 04:53:44','Successfully backed up the database.','backup','dev'),(8,'2020-02-10 04:53:45','Committed <a href=\"https://programmes.espaceatman.com/wp-admin/admin.php?page=revisr_view_commit&commit=9b62daa&success=true\">#9b62daa</a> to the local repository.','commit','dev'),(9,'2020-02-10 04:53:45','Error pushing changes to the remote repository.','error','dev'),(10,'2020-02-10 04:55:31','Checked out branch: Évolution-program-is-published.','branch','dev'),(11,'2020-02-10 04:55:54','Checked out branch: bbPress.','branch','dev'),(12,'2020-02-10 05:00:16','Successfully backed up the database.','backup','dev'),(13,'2020-02-10 05:00:17','Committed <a href=\"https://programmes.espaceatman.com/wp-admin/admin.php?page=revisr_view_commit&commit=aaab916&success=true\">#aaab916</a> to the local repository.','commit','dev'),(14,'2020-02-10 05:46:20','Successfully imported the database. ','import','dev'),(15,'2020-02-10 09:25:36','Successfully backed up the database.','backup','dev'),(16,'2020-02-10 09:25:36','There was an error committing the changes to the local repository.','error','dev'),(17,'2020-02-10 09:30:26','Successfully backed up the database.','backup','dev'),(18,'2020-02-10 09:30:27','Committed <a href=\"https://programmes.espaceatman.com/wp-admin/admin.php?page=revisr_view_commit&commit=4348153&success=true\">#4348153</a> to the local repository.','commit','dev');
/*!40000 ALTER TABLE `wp_revisr` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

