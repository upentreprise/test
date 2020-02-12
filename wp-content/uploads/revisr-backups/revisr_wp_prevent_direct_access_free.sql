
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
DROP TABLE IF EXISTS `wp_prevent_direct_access_free`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_prevent_direct_access_free` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `post_id` mediumint(9) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_prevented` tinyint(1) DEFAULT '1',
  `hits_count` mediumint(9) NOT NULL,
  `limit_downloads` mediumint(9) DEFAULT NULL,
  `expired_date` bigint(20) DEFAULT NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_prevent_direct_access_free` WRITE;
/*!40000 ALTER TABLE `wp_prevent_direct_access_free` DISABLE KEYS */;
INSERT INTO `wp_prevent_direct_access_free` VALUES (1,1241,'2020-02-01 15:02:17','5e35d94945aa3',1,2,NULL,NULL),(2,1240,'2020-02-01 15:02:34','5e35d95a218e3',0,0,NULL,NULL),(3,1239,'2020-02-01 15:02:45','5e35d965942c7',0,0,NULL,NULL),(4,1292,'2020-02-01 17:28:30','5e35fb8e79b56',1,0,NULL,NULL);
/*!40000 ALTER TABLE `wp_prevent_direct_access_free` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

