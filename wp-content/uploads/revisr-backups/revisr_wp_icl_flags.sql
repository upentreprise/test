
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
DROP TABLE IF EXISTS `wp_icl_flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_icl_flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_template` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang_code` (`lang_code`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_icl_flags` WRITE;
/*!40000 ALTER TABLE `wp_icl_flags` DISABLE KEYS */;
INSERT INTO `wp_icl_flags` VALUES (1,'ar','ar.png',0),(2,'bg','bg.png',0),(3,'bn','bn.png',0),(4,'bs','bs.png',0),(5,'ca','ca.png',0),(6,'cs','cs.png',0),(7,'cy','cy.png',0),(8,'da','da.png',0),(9,'de','de.png',0),(10,'el','el.png',0),(11,'en','en.png',0),(12,'eo','eo.png',0),(13,'es','es.png',0),(14,'et','et.png',0),(15,'eu','eu.png',0),(16,'fa','fa.png',0),(17,'fi','fi.png',0),(18,'fr','fr.png',0),(19,'ga','ga.png',0),(20,'gl','gl.png',0),(21,'he','he.png',0),(22,'hi','hi.png',0),(23,'hr','hr.png',0),(24,'hu','hu.png',0),(25,'hy','hy.png',0),(26,'id','id.png',0),(27,'is','is.png',0),(28,'it','it.png',0),(29,'ja','ja.png',0),(30,'ko','ko.png',0),(31,'ku','ku.png',0),(32,'lt','lt.png',0),(33,'lv','lv.png',0),(34,'mk','mk.png',0),(35,'mn','mn.png',0),(36,'ms','ms.png',0),(37,'mt','mt.png',0),(38,'ne','ne.png',0),(39,'nl','nl.png',0),(40,'no','no.png',0),(41,'pa','pa.png',0),(42,'pl','pl.png',0),(43,'pt-br','pt-br.png',0),(44,'pt-pt','pt-pt.png',0),(45,'qu','qu.png',0),(46,'ro','ro.png',0),(47,'ru','ru.png',0),(48,'sk','sk.png',0),(49,'sl','sl.png',0),(50,'so','so.png',0),(51,'sq','sq.png',0),(52,'sr','sr.png',0),(53,'sv','sv.png',0),(54,'ta','ta.png',0),(55,'th','th.png',0),(56,'tr','tr.png',0),(57,'uk','uk.png',0),(58,'ur','ur.png',0),(59,'uz','uz.png',0),(60,'vi','vi.png',0),(61,'yi','yi.png',0),(62,'zh-hans','zh.png',0),(63,'zh-hant','zh.png',0),(64,'zu','zu.png',0);
/*!40000 ALTER TABLE `wp_icl_flags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

