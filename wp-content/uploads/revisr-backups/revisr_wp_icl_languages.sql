
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
DROP TABLE IF EXISTS `wp_icl_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_icl_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `english_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL,
  `default_locale` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encode_url` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `english_name` (`english_name`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_icl_languages` WRITE;
/*!40000 ALTER TABLE `wp_icl_languages` DISABLE KEYS */;
INSERT INTO `wp_icl_languages` VALUES (1,'en','English',1,1,'en_US','en',0),(2,'es','Spanish',1,0,'es_ES','es',0),(3,'de','German',1,0,'de_DE','de',0),(4,'fr','French',1,1,'fr_FR','fr',0),(5,'ar','Arabic',0,0,'ar','ar',0),(6,'bs','Bosnian',0,0,'bs_BA','bs',0),(7,'bg','Bulgarian',0,0,'bg_BG','bg',0),(8,'ca','Catalan',0,0,'ca','ca',0),(9,'cs','Czech',0,0,'cs_CZ','cs',0),(10,'sk','Slovak',0,0,'sk_SK','sk',0),(11,'cy','Welsh',0,0,'cy_GB','cy',0),(12,'da','Danish',1,0,'da_DK','da',0),(13,'el','Greek',0,0,'el','el',0),(14,'eo','Esperanto',0,0,'eo_UY','eo',0),(15,'et','Estonian',0,0,'et','et',0),(16,'eu','Basque',0,0,'eu_ES','eu',0),(17,'fa','Persian',0,0,'fa_IR','fa',0),(18,'fi','Finnish',0,0,'fi','fi',0),(19,'ga','Irish',0,0,'ga_IE','ga',0),(20,'he','Hebrew',0,0,'he_IL','he',0),(21,'hi','Hindi',0,0,'hi_IN','hi',0),(22,'hr','Croatian',0,0,'hr','hr',0),(23,'hu','Hungarian',0,0,'hu_HU','hu',0),(24,'hy','Armenian',0,0,'hy_AM','hy',0),(25,'id','Indonesian',0,0,'id_ID','id',0),(26,'is','Icelandic',0,0,'is_IS','is',0),(27,'it','Italian',1,0,'it_IT','it',0),(28,'ja','Japanese',1,0,'ja','ja',0),(29,'ko','Korean',0,0,'ko_KR','ko',0),(30,'ku','Kurdish',0,0,'ckb','ku',0),(31,'lv','Latvian',0,0,'lv_LV','lv',0),(32,'lt','Lithuanian',0,0,'lt_LT','lt',0),(33,'mk','Macedonian',0,0,'mk_MK','mk',0),(34,'mt','Maltese',0,0,'mt_MT','mt',0),(35,'mn','Mongolian',0,0,'mn_MN','mn',0),(36,'ne','Nepali',0,0,'ne','ne',0),(37,'nl','Dutch',1,0,'nl_NL','nl',0),(38,'no','Norwegian Bokmål',0,0,'nb_NO','no',0),(39,'pa','Punjabi',0,0,'','pa',0),(40,'pl','Polish',0,0,'pl_PL','pl',0),(41,'pt-pt','Portuguese, Portugal',0,0,'pt_PT','pt-pt',0),(42,'pt-br','Portuguese, Brazil',0,0,'pt_BR','pt-br',0),(43,'qu','Quechua',0,0,'quz_PE','qu',0),(44,'ro','Romanian',0,0,'ro_RO','ro',0),(45,'ru','Russian',1,0,'ru_RU','ru',0),(46,'sl','Slovenian',0,0,'sl_SI','sl',0),(47,'so','Somali',0,0,'so_SO','so',0),(48,'sq','Albanian',0,0,'sq_AL','sq',0),(49,'sr','Serbian',0,0,'sr_RS','sr',0),(50,'sv','Swedish',0,0,'sv_SE','sv',0),(51,'ta','Tamil',0,0,'ta_IN','ta',0),(52,'th','Thai',0,0,'th','th',0),(53,'tr','Turkish',0,0,'tr_TR','tr',0),(54,'uk','Ukrainian',0,0,'uk','uk',0),(55,'ur','Urdu',0,0,'uz_UZ','ur',0),(56,'uz','Uzbek',0,0,'uz_UZ','uz',0),(57,'vi','Vietnamese',0,0,'vi_VN','vi',0),(58,'yi','Yiddish',0,0,'','yi',0),(59,'zh-hans','Chinese (Simplified)',1,0,'zh_CN','zh-hans',0),(60,'zu','Zulu',0,0,'','zu',0),(61,'zh-hant','Chinese (Traditional)',1,0,'zh_TW','zh-hant',0),(62,'ms','Malay',0,0,'ms_MY','ms',0),(63,'gl','Galician',0,0,'gl_ES','gl',0),(64,'bn','Bengali',0,0,'bn_BD','bn',0);
/*!40000 ALTER TABLE `wp_icl_languages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

