
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
DROP TABLE IF EXISTS `wp_yoast_seo_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_yoast_seo_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=1249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_yoast_seo_links` WRITE;
/*!40000 ALTER TABLE `wp_yoast_seo_links` DISABLE KEYS */;
INSERT INTO `wp_yoast_seo_links` VALUES (192,'https://programmes.espaceatman.com/wp-content/uploads/2020/01/Respiration-Viloma-1.m4a',1848,0,'internal'),(198,'https://programmes.espaceatman.com/wp-content/uploads/2020/01/Respiration-carrée.m4a',1854,0,'internal'),(201,'https://programmes.espaceatman.com/wp-content/uploads/2020/01/Respiration-yoguique-complète.m4a',1843,0,'internal'),(552,'https://programmes.espaceatman.com/product/programme-evolution-guide-pour-letre-pre-vente/',686,1306,'internal'),(553,'',686,0,'internal'),(554,'',686,0,'internal'),(555,'',686,0,'internal'),(556,'',686,0,'internal'),(557,'',686,0,'internal'),(558,'',686,0,'internal'),(559,'https://programmes.espaceatman.com/product/programme-evolution-guide-pour-letre-pre-vente/',686,1306,'internal'),(560,'',686,0,'internal'),(561,'',686,0,'internal'),(562,'https://programmes.espaceatman.com/product/programme-evolution-guide-pour-letre-pre-vente/',686,1306,'internal'),(563,'https://www.facebook.com/espaceatman/',686,0,'external'),(564,'https://www.espaceatman.com/',686,0,'external'),(565,'https://www.instagram.com/julien_espace.atman/?hl=fr-ca',686,0,'external'),(566,'https://programmes.espaceatman.com/wp-admin/profile.php',1903,0,'internal'),(567,'https://programmes.espaceatman.com/?sfwd-courses=techniques-de-respiration',1903,686,'internal'),(568,'https://programmes.espaceatman.com/?sfwd-courses=evolution-guide-pour-l-etre',1903,686,'internal'),(582,'https://programmes.espaceatman.com/wp-admin/profile.php',426,0,'internal'),(583,'https://programmes.espaceatman.com/courses/techniques-de-respiration/',426,0,'internal'),(584,'https://programmes.espaceatman.com/courses/evolution-guide-pour-l-etre/',426,417,'internal'),(585,'https://programmes.espaceatman.com/',426,686,'internal'),(634,'https://programmes.espaceatman.com/lessons/capsule-6-integrer-sa-verite/',417,0,'internal'),(635,'https://programmes.espaceatman.com/lessons/capsule-6-integrer-sa-verite/',417,1254,'internal'),(636,'https://programmes.espaceatman.com/lessons/capsule-5-voir-clair-au-quotidien/',417,1251,'internal'),(637,'https://programmes.espaceatman.com/lessons/capsule-5-voir-clair-au-quotidien/',417,1251,'internal'),(638,'https://programmes.espaceatman.com/lessons/capsule-4-du-mental-vers-le-coeur/',417,1232,'internal'),(639,'https://programmes.espaceatman.com/lessons/capsule-4-du-mental-vers-le-coeur/',417,1232,'internal'),(640,'https://programmes.espaceatman.com/lessons/capsule-3-la-meditation/',417,1222,'internal'),(641,'https://programmes.espaceatman.com/lessons/capsule-3-la-meditation/',417,1222,'internal'),(642,'https://programmes.espaceatman.com/courses/evolution-guide-pour-l-etre/lessons/techniques-de-respiration/',417,417,'internal'),(643,'https://programmes.espaceatman.com/lessons/techniques-de-respiration/',417,1185,'internal'),(644,'https://programmes.espaceatman.com/lessons/capsule-2/',417,818,'internal'),(645,'https://programmes.espaceatman.com/lessons/capsule-2/',417,818,'internal'),(646,'https://programmes.espaceatman.com/courses/evolution-guide-pour-l-etre/lessons/capsule-1-bien-se-connaitre/',417,417,'internal'),(647,'https://programmes.espaceatman.com/lessons/capsule-1-bien-se-connaitre/',417,767,'internal'),(648,'https://programmes.espaceatman.com/wp-admin/profile.php',417,0,'internal'),(649,'https://programmes.espaceatman.com/courses/techniques-de-respiration/',417,1183,'internal'),(1196,'',2292,0,'internal'),(1197,'',2292,0,'internal'),(1198,'',2292,0,'internal'),(1199,'',2292,0,'internal'),(1200,'',2292,0,'internal'),(1201,'',2292,0,'internal'),(1202,'https://programmes.espaceatman.com/product/programme-evolution-guide-pour-letre-pre-vente/',2292,1306,'internal'),(1203,'',2292,0,'internal'),(1204,'',2292,0,'internal'),(1205,'https://programmes.espaceatman.com/product/programme-evolution-guide-pour-letre-pre-vente/',2292,1306,'internal'),(1206,'https://www.facebook.com/espaceatman/',2292,0,'external'),(1207,'https://www.espaceatman.com/',2292,0,'external'),(1208,'https://www.instagram.com/julien_espace.atman/?hl=fr-ca',2292,0,'external'),(1229,'#',691,0,'internal'),(1230,'#',691,0,'internal'),(1231,'#',691,0,'internal'),(1232,'#',691,0,'internal'),(1233,'#',691,0,'internal'),(1234,'#',691,0,'internal'),(1235,'#',691,0,'internal'),(1236,'#',691,0,'internal'),(1237,'#',691,0,'internal'),(1238,'#',691,0,'internal'),(1239,'#',691,0,'internal'),(1240,'#',691,0,'internal'),(1241,'#',691,0,'internal'),(1242,'#',691,0,'internal'),(1243,'#',691,0,'internal'),(1244,'#',691,0,'internal'),(1245,'#',691,0,'internal'),(1246,'#',691,0,'internal'),(1247,'#',691,0,'internal'),(1248,'#',691,0,'internal');
/*!40000 ALTER TABLE `wp_yoast_seo_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

