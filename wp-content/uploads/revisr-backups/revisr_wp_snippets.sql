
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
DROP TABLE IF EXISTS `wp_snippets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_snippets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `scope` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'global',
  `priority` smallint(6) NOT NULL DEFAULT '10',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_snippets` WRITE;
/*!40000 ALTER TABLE `wp_snippets` DISABLE KEYS */;
INSERT INTO `wp_snippets` VALUES (1,'Example HTML shortcode','This is an example snippet for demonstrating how to add an HTML shortcode.\n\nYou can remove it, or edit it to add your own content.','\nadd_shortcode( \'shortcode_name\', function () {\n\n	$out = \'<p>write your HTML shortcode content here</p>\';\n\n	return $out;\n} );','shortcode','global',10,0,'2020-02-01 14:51:12'),(2,'Example CSS snippet','This is an example snippet for demonstrating how to add custom CSS code to your website.\n\nYou can remove it, or edit it to add your own content.','\nadd_action( \'wp_head\', function () { ?>\n<style>\n\n	/* write your CSS code here */\n\n</style>\n<?php } );\n','css','front-end',10,0,'2020-02-01 14:51:12'),(3,'Example JavaScript snippet','This is an example snippet for demonstrating how to add custom JavaScript code to your website.\n\nYou can remove it, or edit it to add your own content.','\nadd_action( \'wp_head\', function () { ?>\n<script>\n\n	/* write your JavaScript code here */\n\n</script>\n<?php } );\n','javascript','front-end',10,0,'2020-02-01 14:51:12'),(4,'Order snippets by name','Order snippets by name by default in the snippets table.','\nadd_filter( \'code_snippets/list_table/default_orderby\', function () {\n	return \'name\';\n} );\n','code-snippets-plugin','admin',10,0,'2020-02-01 14:51:12'),(5,'Order snippets by date','Order snippets by last modification date by default in the snippets table.','\nadd_filter( \'code_snippets/list_table/default_orderby\', function () {\n	return \'modified\';\n} );\n\nadd_filter( \'code_snippets/list_table/default_order\', function () {\n	return \'desc\';\n} );\n','code-snippets-plugin','admin',10,0,'2020-02-01 14:51:12'),(6,'','','// Change \"You may also like...\" text in WooCommerce\r\n\r\nadd_filter(\'gettext\', \'change_ymal\');\r\n\r\nfunction change_ymal($translated) \r\n{\r\n	$translated = str_ireplace(\'You may also like\', \'Vous aimerez aussi\', $translated);\r\n	return $translated; \r\n}\r\n\r\n','','global',10,1,'2020-02-06 10:02:29');
/*!40000 ALTER TABLE `wp_snippets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

