
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
DROP TABLE IF EXISTS `wp_vxc_zoho_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_vxc_zoho_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci,
  `meta` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(1) NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_vxc_zoho_accounts` WRITE;
/*!40000 ALTER TABLE `wp_vxc_zoho_accounts` DISABLE KEYS */;
INSERT INTO `wp_vxc_zoho_accounts` VALUES (1,'Espace Atman','STlDRFdWSU81MGZJSFc1a1Zkd0pnT3llT2Nmd3JnS21zUUUrWXVIcCtyWFFpWDQybzliMkdMMkQxOWlIUUtkWGNSVTFvZEZSUEJLMHF1SkYvcGt5WC9iQngxNUNFV2JoZjhlZDR4Z3JWc2pWbThMakQrQTNSVmQ3R2tEYm5EMnh5MFM3TndzNG5rWUt3MUxzMFZXcll5Q09ERkU2U0RLelNneUppaEZaclJBMXVLRjBHKzd6MnFhanBybHIranhKVFFFRGliWW5JRWtzS3RPZ1k4dFFjNytsL2djRHoyUjdXTU5rcHBYRGVpd2lRN29MaDJrQVFiT3JzVHNmOG15c2g2ak5XZVA4UWM4SCsvenQvOE9oSmlDeFEwOTN6MXlCTXlMREJmK2NuUDU3QTFDYXBCRDZJOXFIdis5UElvOFNTQzVsM3M3VGk4Tzd6eTNONkowbnZTU0Z4cTJyNjVHeGxGcllwaFFVbFZSVzNCMFkvVmMxeHVwWW4xcVR3aTlVVDBtb010R0Y0amhJckNrRFNVN0VNUjMra1hibk1TVlZCeGFWd3BmcGE0WWhQcytiT0xpSkgwUnBGNW85Ujd4a0dtQSsxVXlHdDVxK0NvUzY0Vm5VRjN3Z3l1REpDTndNZlV4UDNTcTNxanQzc1NtVlVXSjBMMTNZengrVlJZMTJ0ZTZkeS9xZkdOd1NzVzE4L2J3UmR6OTFpUm9LSmM5MmpxWjlxQlFuQU1GYSszTmE4eVMxZVgzVjJhNy91T3Q2dVhVSThQNWN3Y0lVekpTb2dsRGlvYzJHV21tWHZHOERsbkJYN0N6NXNkSWpvVm5zb05VOVZXVzc3cEVkcFBNK3ZjUTVWcCtCbGhpQmdmNnFVeWVSdmFYMStRMkc4OWE5Y3gwZEJxZUF2UitUdkl6OVcwM1BNN05rS25IYVVCNDZ3ZHlYZXNZbGo4eTV1SzZIeExDYzVGU0RoTmdIcHZKQlRyQ3BxTDB3dmZWTTVOVGkyT0lxU2VzZHNBcjV2T3F5UFZEVXBha0NtTThSQWR1SVVXaTc5UT09OkZ1aGtmNFVpRHhlYnVEU2xhekNpZFE9PQ==','{\"objects\":{\"contacts\":\"Contacts\",\"invoices\":\"Invoices\",\"estimates\":\"Estimates\",\"customerpayments\":\"Customer Payments\",\"creditnotes\":\"Credit Notes\",\"recurringinvoices\":\"Recurring Invoices\",\"purchaseorders\":\"Purchase Orders\",\"salesorders\":\"Sales Orders\"},\"fields\":{\"reference_number\":{\"label\":\"Reference Number\",\"type\":\"Text\",\"name\":\"reference_number\"},\"place_of_supply\":{\"label\":\"Place Of Supply\",\"type\":\"Text\",\"name\":\"place_of_supply\"},\"gst_treatment\":{\"label\":\"Gst Treatment\",\"type\":\"Text\",\"name\":\"gst_treatment\"},\"gst_no\":{\"label\":\"Gst No\",\"type\":\"Text\",\"name\":\"gst_no\"},\"template_id\":{\"label\":\"Template Id\",\"type\":\"Text\",\"name\":\"template_id\"},\"date\":{\"label\":\"Date\",\"type\":\"date\",\"name\":\"date\"},\"payment_terms\":{\"label\":\"Payment Terms\",\"type\":\"Text\",\"name\":\"payment_terms\"},\"payment_terms_label\":{\"label\":\"Payment Terms Label\",\"type\":\"Text\",\"name\":\"payment_terms_label\"},\"due_date\":{\"label\":\"Due Date\",\"type\":\"Text\",\"name\":\"due_date\"},\"discount\":{\"label\":\"Discount\",\"type\":\"Text\",\"name\":\"discount\"},\"tax_total\":{\"label\":\"Tax Total\",\"type\":\"Text\",\"name\":\"tax_total\"},\"shipping_charge\":{\"label\":\"Shipping Charge\",\"type\":\"Text\",\"name\":\"shipping_charge\"},\"is_discount_before_tax\":{\"label\":\"Is Discount Before Tax\",\"type\":\"bool\",\"name\":\"is_discount_before_tax\"},\"discount_type\":{\"label\":\"Discount Type\",\"type\":\"Text\",\"name\":\"discount_type\"},\"is_inclusive_tax\":{\"label\":\"Is Inclusive Tax\",\"type\":\"Text\",\"name\":\"is_inclusive_tax\"},\"exchange_rate\":{\"label\":\"Exchange Rate\",\"type\":\"Text\",\"name\":\"exchange_rate\"},\"recurring_invoice_id\":{\"label\":\"Recurring Invoice Id\",\"type\":\"Text\",\"name\":\"recurring_invoice_id\"},\"invoiced_estimate_id\":{\"label\":\"Invoiced Estimate Id\",\"type\":\"Text\",\"name\":\"invoiced_estimate_id\"},\"salesperson_name\":{\"label\":\"Salesperson Name\",\"type\":\"Text\",\"name\":\"salesperson_name\"},\"project_id\":{\"label\":\"Project Id\",\"type\":\"Text\",\"name\":\"project_id\"},\"allow_partial_payments\":{\"label\":\"Allow Partial Payments\",\"type\":\"Text\",\"name\":\"allow_partial_payments\"},\"notes\":{\"label\":\"Notes\",\"type\":\"Text\",\"name\":\"notes\"},\"terms\":{\"label\":\"Terms\",\"type\":\"Text\",\"name\":\"terms\"},\"adjustment\":{\"label\":\"Adjustment\",\"type\":\"Text\",\"name\":\"adjustment\"},\"adjustment_description\":{\"label\":\"Adjustment Description\",\"type\":\"Text\",\"name\":\"adjustment_description\"},\"reason\":{\"label\":\"Reason\",\"type\":\"Text\",\"name\":\"reason\"},\"tax_authority_id\":{\"label\":\"Tax Authority Id\",\"type\":\"Text\",\"name\":\"tax_authority_id\"},\"tax_exemption_id\":{\"label\":\"Tax Exemption Id\",\"type\":\"Text\",\"name\":\"tax_exemption_id\"}},\"object\":\"invoices\",\"post_id\":\"1489\"}',1,'2020-01-28 17:48:08','2020-02-02 15:02:43'),(2,'',NULL,NULL,9,NULL,NULL);
/*!40000 ALTER TABLE `wp_vxc_zoho_accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

