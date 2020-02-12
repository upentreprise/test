
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
DROP TABLE IF EXISTS `wp_woocommerce_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_expiry` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_key` (`session_key`)
) ENGINE=InnoDB AUTO_INCREMENT=10234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_woocommerce_sessions` WRITE;
/*!40000 ALTER TABLE `wp_woocommerce_sessions` DISABLE KEYS */;
INSERT INTO `wp_woocommerce_sessions` VALUES (9629,'1','a:7:{s:4:\"cart\";s:492:\"a:1:{s:32:\"7940ab47468396569a906f75ff3f20ef\";a:11:{s:3:\"key\";s:32:\"7940ab47468396569a906f75ff3f20ef\";s:10:\"product_id\";i:1306;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"72dc121af982911a9c204fe15789343e\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}s:5:\"total\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}}s:13:\"line_subtotal\";d:149.99;s:17:\"line_subtotal_tax\";d:22.46;s:10:\"line_total\";d:149.99;s:8:\"line_tax\";d:22.46;}}\";s:11:\"cart_totals\";s:444:\"a:15:{s:8:\"subtotal\";s:6:\"149.99\";s:12:\"subtotal_tax\";d:22.46;s:14:\"shipping_total\";s:4:\"0.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:6:\"149.99\";s:17:\"cart_contents_tax\";d:22.46;s:19:\"cart_contents_taxes\";a:2:{i:16;d:7.5;i:18;d:14.96;}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:6:\"172.45\";s:9:\"total_tax\";d:22.46;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:8:\"customer\";s:810:\"a:26:{s:2:\"id\";s:1:\"1\";s:13:\"date_modified\";s:25:\"2020-02-01T17:10:38+00:00\";s:8:\"postcode\";s:7:\"J0K 2T0\";s:4:\"city\";s:15:\"Sainte-Julienne\";s:9:\"address_1\";s:12:\"2475 Martine\";s:7:\"address\";s:12:\"2475 Martine\";s:9:\"address_2\";s:4:\"2475\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:6:\"Julien\";s:9:\"last_name\";s:4:\"Remo\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:10:\"5149183052\";s:5:\"email\";s:18:\"jul.remo@gmail.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";}',1581429200),(9844,'04c03f8949d73c34d89866361dbf31eb','a:8:{s:4:\"cart\";s:492:\"a:1:{s:32:\"7940ab47468396569a906f75ff3f20ef\";a:11:{s:3:\"key\";s:32:\"7940ab47468396569a906f75ff3f20ef\";s:10:\"product_id\";i:1306;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"72dc121af982911a9c204fe15789343e\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}s:5:\"total\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}}s:13:\"line_subtotal\";d:149.99;s:17:\"line_subtotal_tax\";d:22.46;s:10:\"line_total\";d:149.99;s:8:\"line_tax\";d:22.46;}}\";s:11:\"cart_totals\";s:444:\"a:15:{s:8:\"subtotal\";s:6:\"149.99\";s:12:\"subtotal_tax\";d:22.46;s:14:\"shipping_total\";s:4:\"0.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:6:\"149.99\";s:17:\"cart_contents_tax\";d:22.46;s:19:\"cart_contents_taxes\";a:2:{i:16;d:7.5;i:18;d:14.96;}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:6:\"172.45\";s:9:\"total_tax\";d:22.46;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:8:\"customer\";s:691:\"a:26:{s:2:\"id\";s:1:\"0\";s:13:\"date_modified\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:0:\"\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";s:10:\"wc_notices\";N;}',1581509149),(9849,'5','a:8:{s:4:\"cart\";s:469:\"a:1:{s:32:\"7940ab47468396569a906f75ff3f20ef\";a:11:{s:3:\"key\";s:32:\"7940ab47468396569a906f75ff3f20ef\";s:10:\"product_id\";i:1306;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"72dc121af982911a9c204fe15789343e\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}s:5:\"total\";a:2:{i:16;d:0;i:18;d:0;}}s:13:\"line_subtotal\";d:149.99;s:17:\"line_subtotal_tax\";d:22.46;s:10:\"line_total\";d:0;s:8:\"line_tax\";d:0;}}\";s:11:\"cart_totals\";s:435:\"a:15:{s:8:\"subtotal\";s:6:\"149.99\";s:12:\"subtotal_tax\";d:22.46;s:14:\"shipping_total\";s:4:\"0.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:149.99;s:12:\"discount_tax\";d:22.46;s:19:\"cart_contents_total\";s:4:\"0.00\";s:17:\"cart_contents_tax\";d:0;s:19:\"cart_contents_taxes\";a:2:{i:16;d:0;i:18;d:0;}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:4:\"0.00\";s:9:\"total_tax\";d:0;}\";s:15:\"applied_coupons\";s:30:\"a:1:{i:0;s:12:\"guillaume100\";}\";s:22:\"coupon_discount_totals\";s:35:\"a:1:{s:12:\"guillaume100\";d:149.99;}\";s:26:\"coupon_discount_tax_totals\";s:34:\"a:1:{s:12:\"guillaume100\";d:22.46;}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:8:\"customer\";s:818:\"a:26:{s:2:\"id\";s:1:\"5\";s:13:\"date_modified\";s:25:\"2020-02-08T13:36:56+00:00\";s:8:\"postcode\";s:7:\"H4M 1B0\";s:4:\"city\";s:3:\"ada\";s:9:\"address_1\";s:4:\"aadd\";s:7:\"address\";s:4:\"aadd\";s:9:\"address_2\";s:6:\"ddadad\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:27:\"Équipe de développement /\";s:9:\"last_name\";s:16:\"Development Team\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:10:\"0290393030\";s:5:\"email\";s:20:\"dev@upentreprise.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";s:10:\"wc_notices\";N;}',1581513600),(9850,'09fd322f75b975069d333a5b92edb45f','a:8:{s:4:\"cart\";s:492:\"a:1:{s:32:\"7940ab47468396569a906f75ff3f20ef\";a:11:{s:3:\"key\";s:32:\"7940ab47468396569a906f75ff3f20ef\";s:10:\"product_id\";i:1306;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"72dc121af982911a9c204fe15789343e\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}s:5:\"total\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}}s:13:\"line_subtotal\";d:149.99;s:17:\"line_subtotal_tax\";d:22.46;s:10:\"line_total\";d:149.99;s:8:\"line_tax\";d:22.46;}}\";s:11:\"cart_totals\";s:444:\"a:15:{s:8:\"subtotal\";s:6:\"149.99\";s:12:\"subtotal_tax\";d:22.46;s:14:\"shipping_total\";s:4:\"0.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:6:\"149.99\";s:17:\"cart_contents_tax\";d:22.46;s:19:\"cart_contents_taxes\";a:2:{i:16;d:7.5;i:18;d:14.96;}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:6:\"172.45\";s:9:\"total_tax\";d:22.46;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:10:\"wc_notices\";N;s:8:\"customer\";s:691:\"a:26:{s:2:\"id\";s:1:\"0\";s:13:\"date_modified\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:0:\"\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";}',1581511480),(9902,'efc5dea49f6485aa040118bb1f7304e1','a:1:{s:8:\"customer\";s:792:\"a:26:{s:2:\"id\";s:2:\"39\";s:13:\"date_modified\";s:25:\"2020-02-10T13:23:10+00:00\";s:8:\"postcode\";s:7:\"G1A 0A2\";s:4:\"city\";s:5:\"Torna\";s:9:\"address_1\";s:5:\"Goosn\";s:7:\"address\";s:5:\"Goosn\";s:9:\"address_2\";s:7:\"1092hsh\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:2:\"Cc\";s:9:\"last_name\";s:6:\"Cooray\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:11:\"06993984844\";s:5:\"email\";s:24:\"charleshan0078@gmail.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";}',1581513474),(9928,'95921421c300d4b869246f1b42639dd3','a:8:{s:4:\"cart\";s:492:\"a:1:{s:32:\"7940ab47468396569a906f75ff3f20ef\";a:11:{s:3:\"key\";s:32:\"7940ab47468396569a906f75ff3f20ef\";s:10:\"product_id\";i:1306;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"72dc121af982911a9c204fe15789343e\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}s:5:\"total\";a:2:{i:16;d:7.4995;i:18;d:14.9615025;}}s:13:\"line_subtotal\";d:149.99;s:17:\"line_subtotal_tax\";d:22.46;s:10:\"line_total\";d:149.99;s:8:\"line_tax\";d:22.46;}}\";s:11:\"cart_totals\";s:444:\"a:15:{s:8:\"subtotal\";s:6:\"149.99\";s:12:\"subtotal_tax\";d:22.46;s:14:\"shipping_total\";s:4:\"0.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:6:\"149.99\";s:17:\"cart_contents_tax\";d:22.46;s:19:\"cart_contents_taxes\";a:2:{i:16;d:7.5;i:18;d:14.96;}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:6:\"172.45\";s:9:\"total_tax\";d:22.46;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:10:\"wc_notices\";N;s:8:\"customer\";s:691:\"a:26:{s:2:\"id\";s:1:\"0\";s:13:\"date_modified\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:2:\"QC\";s:7:\"country\";s:2:\"CA\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:2:\"QC\";s:16:\"shipping_country\";s:2:\"CA\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:0:\"\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";}',1581514386);
/*!40000 ALTER TABLE `wp_woocommerce_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
