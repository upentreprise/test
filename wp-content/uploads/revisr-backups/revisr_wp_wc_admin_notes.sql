
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
DROP TABLE IF EXISTS `wp_wc_admin_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wc_admin_notes` (
  `note_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_data` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_reminder` datetime DEFAULT NULL,
  `is_snoozable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_wc_admin_notes` WRITE;
/*!40000 ALTER TABLE `wp_wc_admin_notes` DISABLE KEYS */;
INSERT INTO `wp_wc_admin_notes` VALUES (1,'wc-admin-welcome-note','info','en_US','New feature(s)','Welcome to the new WooCommerce experience! In this new release you\'ll be able to have a glimpse of how your store is doing in the Dashboard, manage important aspects of your business (such as managing orders, stock, reviews) from anywhere in the interface, dive into your store data with a completely new Analytics section and more!','info','{}','unactioned','woocommerce-admin','2020-01-14 18:11:39',NULL,0),(2,'wc-admin-add-first-product','info','en_US','Add your first product','Grow your revenue by adding products to your store. Add products manually, import from a sheet, or migrate from another platform.','product','{}','unactioned','woocommerce-admin','2020-01-14 18:11:39',NULL,0),(3,'wc-admin-wc-helper-connection','info','en_US','Connect to WooCommerce.com','Connect to get important product notifications and updates.','info','{}','unactioned','woocommerce-admin','2020-01-14 18:11:39',NULL,0),(4,'wc-admin-mobile-app','info','en_US','Installer l’application mobile Woo','Installez l’application mobile WooCommerce pour gérer les commandes, recevoir des notifications de ventes et afficher les mesures clés, où que vous soyez.','phone','{}','unactioned','woocommerce-admin','2020-01-16 18:12:53',NULL,0),(5,'wc-admin-store-notice-giving-feedback','info','en_US','Passez en revue votre expérience','Si vous aimez WooCommerce Admin, s’il vous plaît laissez-nous une note de 5 étoiles. Un grand merci à l’avance!','info','{}','unactioned','woocommerce-admin','2020-01-17 19:01:08',NULL,0),(6,'wc-admin-facebook-extension','info','en_US','Marché sur Facebook','Développez votre entreprise en ciblant les bonnes personnes et en augmentant les ventes avec Facebook. Vous pouvez installer cette extension gratuite maintenant.','thumbs-up','{}','actioned','woocommerce-admin','2020-01-17 19:01:08',NULL,0),(8,'wc-admin-usage-tracking-opt-in','info','en_US','Aidez WooCommerce à améliorer ses services grâce au suivi de l’utilisation','La collecte de données d’utilisation nous permet d’améliorer WooCommerce. Votre boutique sera considérée au fur et à mesure que nous évaluerons les nouvelles fonctionnalités, jugeons la qualité d’une mise à jour ou déterminerons si une amélioration est logique. Vous pouvez toujours visiter le <a href=\"https://programmes.espaceatman.com/wp-admin/admin.php?page=wc-settings&#038;tab=advanced&#038;section=woocommerce_com\" target=\"_blank\">Réglages</a> et choisir d’arrêter de partager des données. <a href=\"https://woocommerce.com/usage-tracking\" target=\"_blank\">Lire plus de</a> sur les données que nous recueillons.','info','{}','unactioned','woocommerce-admin','2020-01-21 18:12:18',NULL,0),(9,'wc-admin-orders-milestone','info','en_US','Congratulations on processing 10 orders!','You\'ve hit the 10 orders milestone! Look at you go. Browse some WooCommerce success stories for inspiration.','trophy','{}','unactioned','woocommerce-admin','2020-01-23 10:35:13',NULL,0),(11,'wc-admin-new-sales-record','info','en_US','New sales record!','Woohoo, February 2nd was your record day for sales! Net Sales was $344,90 beating the previous record of $3,46 set on February 1st.','trophy','{\"old_record_date\":\"2020-02-01\",\"old_record_amt\":3.46,\"new_record_date\":\"2020-02-02\",\"new_record_amt\":344.9}','unactioned','woocommerce-admin','2020-02-03 23:22:46',NULL,0);
/*!40000 ALTER TABLE `wp_wc_admin_notes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

