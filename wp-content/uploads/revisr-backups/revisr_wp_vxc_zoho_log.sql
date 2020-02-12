
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
DROP TABLE IF EXISTS `wp_vxc_zoho_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_vxc_zoho_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `crm_id` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `response` text COLLATE utf8mb4_unicode_ci,
  `extra` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_vxc_zoho_log` WRITE;
/*!40000 ALTER TABLE `wp_vxc_zoho_log` DISABLE KEYS */;
INSERT INTO `wp_vxc_zoho_log` VALUES (1,1479,1475,0,'','','contacts','completed','Invalid value passed for contact_name - 4','{\"first_name\":{\"value\":\"Guillaume\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Bleau\",\"label\":\"Last Name\"},\"email\":{\"value\":\"guillaume.bleau@upbusiness.ca\",\"label\":\"Email\"},\"phone\":{\"value\":\"4504990092\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"UPentreprise\",\"label\":\"Company Name\"},\"billing_address\":{\"value\":\"207.2 RUE SAINT-PIERRE NORD\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"\",\"label\":\"Billing Street2\",\"field\":\"_billing_address_2\"},\"billing_city\":{\"value\":\"Joliette\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J6E 0X6\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"4504990092\",\"label\":\"Billing Phone\"}}','{\"code\":4,\"message\":\"Invalid value passed for contact_name\"}','[]',0,'2020-01-30 20:28:33'),(2,1487,1475,0,'1902008000000150001','https://books.zoho.com/app#/contacts/1902008000000150001','contacts','completed','','{\"first_name\":{\"value\":\"Guillaume\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Bleau\",\"label\":\"Last Name\"},\"email\":{\"value\":\"guillaume.bleau@upbusiness.ca\",\"label\":\"Email\"},\"phone\":{\"value\":\"4504990092\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"UPentreprise\",\"label\":\"Company Name\"},\"billing_address\":{\"value\":\"207.2 RUE SAINT-PIERRE NORD\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"\",\"label\":\"Billing Street2\",\"field\":\"_billing_address_2\"},\"billing_city\":{\"value\":\"Joliette\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J6E 0X6\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"4504990092\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Guillaume\\u00a0 Bleau\",\"label\":\"Contact Name\"}}','{\"code\":0,\"message\":\"Le contact a \\u00e9t\\u00e9 ajout\\u00e9.\",\"contact\":{\"contact_id\":\"1902008000000150001\",\"contact_name\":\"Guillaume\\u00a0 Bleau\",\"company_name\":\"UPentreprise\",\"first_name\":\"Guillaume\",\"last_name\":\"Bleau\",\"designation\":\"\",\"department\":\"\",\"website\":\"\",\"language_code\":\"\",\"language_code_formatted\":\"\",\"contact_salutation\":\"\",\"email\":\"guillaume.bleau@upbusiness.ca\",\"phone\":\"4504990092\",\"mobile\":\"\",\"portal_status\":\"disabled\",\"is_client_review_asked\":false,\"has_transaction\":false,\"contact_type\":\"customer\",\"customer_sub_type\":\"business\",\"owner_id\":\"\",\"owner_name\":\"\",\"source\":\"api\",\"documents\":[],\"twitter\":\"\",\"facebook\":\"\",\"is_crm_customer\":false,\"is_linked_with_zohocrm\":false,\"primary_contact_id\":\"1902008000000150003\",\"zcrm_account_id\":\"\",\"zcrm_contact_id\":\"\",\"crm_owner_id\":\"\",\"payment_terms\":0,\"payment_terms_label\":\"Payable \\u00e0 r\\u00e9ception\",\"credit_limit_exceeded_amount\":0,\"currency_id\":\"1902008000000000101\",\"currency_code\":\"CAD\",\"currency_symbol\":\"$\",\"price_precision\":2,\"exchange_rate\":\"\",\"can_show_customer_ob\":true,\"can_show_vendor_ob\":true,\"opening_balance_amount\":0,\"opening_balance_amount_bcy\":\"\",\"outstanding_ob_receivable_amount\":0,\"outstanding_ob_payable_amount\":0,\"outstanding_receivable_amount\":0,\"outstanding_receivable_amount_bcy\":0,\"outstanding_payable_amount\":0,\"outstanding_payable_amount_bcy\":0,\"unused_credits_receivable_amount\":0,\"unused_credits_receivable_amount_bcy\":0,\"unused_credits_payable_amount\":0,\"unused_credits_payable_amount_bcy\":0,\"unused_retainer_payments\":0,\"status\":\"active\",\"payment_reminder_enabled\":true,\"is_sms_enabled\":true,\"is_client_review_settings_enabled\":true,\"custom_fields\":[],\"custom_field_hash\":[],\"is_taxable\":true,\"tax_id\":\"\",\"tax_name\":\"\",\"tax_percentage\":\"\",\"contact_category\":\"\",\"sales_channel\":\"direct_sales\",\"ach_supported\":false,\"billing_address\":{\"address_id\":\"1902008000000150004\",\"attention\":\"\",\"address\":\"207.2 RUE SAINT-PIERRE NORD\",\"street2\":\"\",\"city\":\"Joliette\",\"state_code\":\"\",\"state\":\"QC\",\"zip\":\"J6E 0X6\",\"country\":\"CA\",\"phone\":\"4504990092\",\"fax\":\"\"},\"shipping_address\":{\"address_id\":\"1902008000000150006\",\"attention\":\"\",\"address\":\"\",\"street2\":\"\",\"city\":\"\",\"state_code\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"\",\"phone\":\"\",\"fax\":\"\"},\"contact_persons\":[{\"contact_person_id\":\"1902008000000150003\",\"salutation\":\"\",\"first_name\":\"Guillaume\",\"last_name\":\"Bleau\",\"email\":\"guillaume.bleau@upbusiness.ca\",\"phone\":\"4504990092\",\"mobile\":\"\",\"mobile_country_code\":\"\",\"mobile_code_formatted\":\"\",\"department\":\"\",\"designation\":\"\",\"skype\":\"\",\"fax\":\"\",\"zcrm_contact_id\":\"\",\"is_added_in_portal\":false,\"can_invite\":true,\"is_primary_contact\":true,\"is_portal_invitation_accepted\":false,\"is_sms_enabled_for_cp\":true,\"photo_url\":\"https:\\/\\/secure.gravatar.com\\/avatar\\/be534e6570e0cb132e8aadfaf14bb119?&d=mm\"}],\"addresses\":[],\"pricebook_id\":\"\",\"pricebook_name\":\"\",\"default_templates\":{\"invoice_template_id\":\"\",\"invoice_template_name\":\"\",\"bill_template_id\":\"\",\"bill_template_name\":\"\",\"estimate_template_id\":\"\",\"estimate_template_name\":\"\",\"creditnote_template_id\":\"\",\"creditnote_template_name\":\"\",\"paymentthankyou_template_id\":\"\",\"paymentthankyou_template_name\":\"\",\"invoice_email_template_id\":\"\",\"invoice_email_template_name\":\"\",\"estimate_email_template_id\":\"\",\"estimate_email_template_name\":\"\",\"creditnote_email_template_id\":\"\",\"creditnote_email_template_name\":\"\",\"paymentthankyou_email_template_id\":\"\",\"paymentthankyou_email_template_name\":\"\",\"payment_remittance_email_template_id\":\"\",\"payment_remittance_email_template_name\":\"\"},\"associated_with_square\":false,\"cards\":[],\"checks\":[],\"bank_accounts\":[],\"vpa_list\":[],\"notes\":\"\",\"created_time\":\"2020-01-30T15:36:09-0500\",\"last_modified_time\":\"2020-01-30T15:36:09-0500\",\"tags\":[],\"zohopeople_client_id\":\"\"}}','[]',1,'2020-01-30 20:36:09'),(3,1487,1475,0,'1902008000000150001','https://books.zoho.com/app#/contacts/1902008000000150001','contacts','update','','{\"first_name\":{\"value\":\"Guillaume\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Bleau\",\"label\":\"Last Name\"},\"email\":{\"value\":\"guillaume.bleau@upbusiness.ca\",\"label\":\"Email\"},\"phone\":{\"value\":\"4504990092\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"UPentreprise\",\"label\":\"Company Name\"},\"billing_address\":{\"value\":\"207.2 RUE SAINT-PIERRE NORD\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"\",\"label\":\"Billing Street2\",\"field\":\"_billing_address_2\"},\"billing_city\":{\"value\":\"Joliette\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J6E 0X6\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"4504990092\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Guillaume\\u00a0 Bleau\",\"label\":\"Contact Name\"}}','{\"code\":0,\"message\":\"Les informations sur le contact ont \\u00e9t\\u00e9 enregistr\\u00e9es.\",\"contact\":{\"contact_id\":\"1902008000000150001\",\"contact_name\":\"Guillaume\\u00a0 Bleau\",\"company_name\":\"UPentreprise\",\"first_name\":\"Guillaume\",\"last_name\":\"Bleau\",\"designation\":\"\",\"department\":\"\",\"website\":\"\",\"language_code\":\"\",\"language_code_formatted\":\"\",\"contact_salutation\":\"\",\"email\":\"guillaume.bleau@upbusiness.ca\",\"phone\":\"4504990092\",\"mobile\":\"\",\"portal_status\":\"disabled\",\"is_client_review_asked\":false,\"has_transaction\":false,\"contact_type\":\"customer\",\"customer_sub_type\":\"business\",\"owner_id\":\"\",\"owner_name\":\"\",\"source\":\"api\",\"documents\":[],\"twitter\":\"\",\"facebook\":\"\",\"is_crm_customer\":false,\"is_linked_with_zohocrm\":false,\"primary_contact_id\":\"1902008000000150003\",\"zcrm_account_id\":\"\",\"zcrm_contact_id\":\"\",\"crm_owner_id\":\"\",\"payment_terms\":0,\"payment_terms_label\":\"Payable \\u00e0 r\\u00e9ception\",\"credit_limit_exceeded_amount\":0,\"currency_id\":\"1902008000000000101\",\"currency_code\":\"CAD\",\"currency_symbol\":\"$\",\"price_precision\":2,\"exchange_rate\":\"\",\"can_show_customer_ob\":true,\"can_show_vendor_ob\":true,\"opening_balance_amount\":0,\"opening_balance_amount_bcy\":\"\",\"outstanding_ob_receivable_amount\":0,\"outstanding_ob_payable_amount\":0,\"outstanding_receivable_amount\":0,\"outstanding_receivable_amount_bcy\":0,\"outstanding_payable_amount\":0,\"outstanding_payable_amount_bcy\":0,\"unused_credits_receivable_amount\":0,\"unused_credits_receivable_amount_bcy\":0,\"unused_credits_payable_amount\":0,\"unused_credits_payable_amount_bcy\":0,\"unused_retainer_payments\":0,\"status\":\"active\",\"payment_reminder_enabled\":true,\"is_sms_enabled\":true,\"is_client_review_settings_enabled\":true,\"custom_fields\":[],\"custom_field_hash\":[],\"is_taxable\":true,\"tax_id\":\"\",\"tax_name\":\"\",\"tax_percentage\":\"\",\"contact_category\":\"\",\"sales_channel\":\"direct_sales\",\"ach_supported\":false,\"billing_address\":{\"address_id\":\"1902008000000150004\",\"attention\":\"\",\"address\":\"207.2 RUE SAINT-PIERRE NORD\",\"street2\":\"\",\"city\":\"Joliette\",\"state_code\":\"\",\"state\":\"QC\",\"zip\":\"J6E 0X6\",\"country\":\"CA\",\"phone\":\"4504990092\",\"fax\":\"\"},\"shipping_address\":{\"address_id\":\"1902008000000150006\",\"attention\":\"\",\"address\":\"\",\"street2\":\"\",\"city\":\"\",\"state_code\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"\",\"phone\":\"\",\"fax\":\"\"},\"contact_persons\":[{\"contact_person_id\":\"1902008000000150003\",\"salutation\":\"\",\"first_name\":\"Guillaume\",\"last_name\":\"Bleau\",\"email\":\"guillaume.bleau@upbusiness.ca\",\"phone\":\"4504990092\",\"mobile\":\"\",\"mobile_country_code\":\"\",\"mobile_code_formatted\":\"\",\"department\":\"\",\"designation\":\"\",\"skype\":\"\",\"fax\":\"\",\"zcrm_contact_id\":\"\",\"is_added_in_portal\":false,\"can_invite\":true,\"is_primary_contact\":true,\"is_portal_invitation_accepted\":false,\"is_sms_enabled_for_cp\":true,\"photo_url\":\"https:\\/\\/secure.gravatar.com\\/avatar\\/be534e6570e0cb132e8aadfaf14bb119?&d=mm\"}],\"addresses\":[],\"pricebook_id\":\"\",\"pricebook_name\":\"\",\"default_templates\":{\"invoice_template_id\":\"\",\"invoice_template_name\":\"\",\"bill_template_id\":\"\",\"bill_template_name\":\"\",\"estimate_template_id\":\"\",\"estimate_template_name\":\"\",\"creditnote_template_id\":\"\",\"creditnote_template_name\":\"\",\"paymentthankyou_template_id\":\"\",\"paymentthankyou_template_name\":\"\",\"invoice_email_template_id\":\"\",\"invoice_email_template_name\":\"\",\"estimate_email_template_id\":\"\",\"estimate_email_template_name\":\"\",\"creditnote_email_template_id\":\"\",\"creditnote_email_template_name\":\"\",\"paymentthankyou_email_template_id\":\"\",\"paymentthankyou_email_template_name\":\"\",\"payment_remittance_email_template_id\":\"\",\"payment_remittance_email_template_name\":\"\"},\"associated_with_square\":false,\"cards\":[],\"checks\":[],\"bank_accounts\":[],\"vpa_list\":[],\"notes\":\"\",\"created_time\":\"2020-01-30T15:36:09-0500\",\"last_modified_time\":\"2020-01-30T15:36:09-0500\",\"tags\":[],\"zohopeople_client_id\":\"\"}}','[]',2,'2020-01-30 21:09:58'),(4,1586,1475,0,'1902008000000153002','https://books.zoho.com/app#/contacts/1902008000000153002','contacts','completed','','{\"first_name\":{\"value\":\"Julien\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Remo\",\"label\":\"Last Name\"},\"email\":{\"value\":\"julien@espaceatman.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"5149183052\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"Espace Atman\",\"label\":\"Company Name\"},\"billing_address\":{\"value\":\"2475 Martine 2475\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"2475\",\"label\":\"Billing Street2\"},\"billing_city\":{\"value\":\"Sainte-Julienne\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J0K 2T0\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"5149183052\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Julien\\u00a0 Remo\",\"label\":\"Contact Name\"}}','{\"code\":0,\"message\":\"Le contact a \\u00e9t\\u00e9 ajout\\u00e9.\",\"contact\":{\"contact_id\":\"1902008000000153002\",\"contact_name\":\"Julien\\u00a0 Remo\",\"company_name\":\"Espace Atman\",\"first_name\":\"Julien\",\"last_name\":\"Remo\",\"designation\":\"\",\"department\":\"\",\"website\":\"\",\"language_code\":\"\",\"language_code_formatted\":\"\",\"contact_salutation\":\"\",\"email\":\"julien@espaceatman.com\",\"phone\":\"5149183052\",\"mobile\":\"\",\"portal_status\":\"disabled\",\"is_client_review_asked\":false,\"has_transaction\":false,\"contact_type\":\"customer\",\"customer_sub_type\":\"business\",\"owner_id\":\"\",\"owner_name\":\"\",\"source\":\"api\",\"documents\":[],\"twitter\":\"\",\"facebook\":\"\",\"is_crm_customer\":false,\"is_linked_with_zohocrm\":false,\"primary_contact_id\":\"1902008000000153004\",\"zcrm_account_id\":\"\",\"zcrm_contact_id\":\"\",\"crm_owner_id\":\"\",\"payment_terms\":0,\"payment_terms_label\":\"Payable \\u00e0 r\\u00e9ception\",\"credit_limit_exceeded_amount\":0,\"currency_id\":\"1902008000000000101\",\"currency_code\":\"CAD\",\"currency_symbol\":\"$\",\"price_precision\":2,\"exchange_rate\":\"\",\"can_show_customer_ob\":true,\"can_show_vendor_ob\":true,\"opening_balance_amount\":0,\"opening_balance_amount_bcy\":\"\",\"outstanding_ob_receivable_amount\":0,\"outstanding_ob_payable_amount\":0,\"outstanding_receivable_amount\":0,\"outstanding_receivable_amount_bcy\":0,\"outstanding_payable_amount\":0,\"outstanding_payable_amount_bcy\":0,\"unused_credits_receivable_amount\":0,\"unused_credits_receivable_amount_bcy\":0,\"unused_credits_payable_amount\":0,\"unused_credits_payable_amount_bcy\":0,\"unused_retainer_payments\":0,\"status\":\"active\",\"payment_reminder_enabled\":true,\"is_sms_enabled\":true,\"is_client_review_settings_enabled\":true,\"custom_fields\":[],\"custom_field_hash\":[],\"is_taxable\":true,\"tax_id\":\"\",\"tax_name\":\"\",\"tax_percentage\":\"\",\"contact_category\":\"\",\"sales_channel\":\"direct_sales\",\"ach_supported\":false,\"billing_address\":{\"address_id\":\"1902008000000153005\",\"attention\":\"\",\"address\":\"2475 Martine 2475\",\"street2\":\"2475\",\"city\":\"Sainte-Julienne\",\"state_code\":\"\",\"state\":\"QC\",\"zip\":\"J0K 2T0\",\"country\":\"CA\",\"phone\":\"5149183052\",\"fax\":\"\"},\"shipping_address\":{\"address_id\":\"1902008000000153007\",\"attention\":\"\",\"address\":\"\",\"street2\":\"\",\"city\":\"\",\"state_code\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"\",\"phone\":\"\",\"fax\":\"\"},\"contact_persons\":[{\"contact_person_id\":\"1902008000000153004\",\"salutation\":\"\",\"first_name\":\"Julien\",\"last_name\":\"Remo\",\"email\":\"julien@espaceatman.com\",\"phone\":\"5149183052\",\"mobile\":\"\",\"mobile_country_code\":\"\",\"mobile_code_formatted\":\"\",\"department\":\"\",\"designation\":\"\",\"skype\":\"\",\"fax\":\"\",\"zcrm_contact_id\":\"\",\"is_added_in_portal\":false,\"can_invite\":true,\"is_primary_contact\":true,\"is_portal_invitation_accepted\":false,\"is_sms_enabled_for_cp\":true,\"photo_url\":\"https:\\/\\/secure.gravatar.com\\/avatar\\/d2f2c20c784302b6f9681f42dffddd99?&d=mm\"}],\"addresses\":[],\"pricebook_id\":\"\",\"pricebook_name\":\"\",\"default_templates\":{\"invoice_template_id\":\"\",\"invoice_template_name\":\"\",\"bill_template_id\":\"\",\"bill_template_name\":\"\",\"estimate_template_id\":\"\",\"estimate_template_name\":\"\",\"creditnote_template_id\":\"\",\"creditnote_template_name\":\"\",\"paymentthankyou_template_id\":\"\",\"paymentthankyou_template_name\":\"\",\"invoice_email_template_id\":\"\",\"invoice_email_template_name\":\"\",\"estimate_email_template_id\":\"\",\"estimate_email_template_name\":\"\",\"creditnote_email_template_id\":\"\",\"creditnote_email_template_name\":\"\",\"paymentthankyou_email_template_id\":\"\",\"paymentthankyou_email_template_name\":\"\",\"payment_remittance_email_template_id\":\"\",\"payment_remittance_email_template_name\":\"\"},\"associated_with_square\":false,\"cards\":[],\"checks\":[],\"bank_accounts\":[],\"vpa_list\":[],\"notes\":\"\",\"created_time\":\"2020-01-31T14:49:59-0500\",\"last_modified_time\":\"2020-01-31T14:49:59-0500\",\"tags\":[],\"zohopeople_client_id\":\"\"}}','[]',1,'2020-01-31 19:50:00'),(5,1593,1475,0,'','','contacts','completed','Le client « Julien  Remo » existe déjà. Spécifiez un nom différent. - 3062','{\"first_name\":{\"value\":\"Julien\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Remo\",\"label\":\"Last Name\"},\"email\":{\"value\":\"jul.remo@gmail.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"5149183052\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"\",\"label\":\"Company Name\",\"field\":\"_billing_company\"},\"billing_address\":{\"value\":\"2475 Martine 2475\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"2475\",\"label\":\"Billing Street2\"},\"billing_city\":{\"value\":\"Sainte-Julienne\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J0K 2T0\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"5149183052\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Julien\\u00a0 Remo\",\"label\":\"Contact Name\"}}','{\"code\":3062,\"message\":\"Le client \\u00ab\\u00a0Julien\\u00a0 Remo\\u00a0\\u00bb existe d\\u00e9j\\u00e0. Sp\\u00e9cifiez un nom diff\\u00e9rent.\"}','[]',0,'2020-01-31 20:02:14'),(6,1600,1475,0,'1902008000000155001','https://books.zoho.com/app#/contacts/1902008000000155001','contacts','completed','','{\"first_name\":{\"value\":\"Alysson\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Martel\",\"label\":\"Last Name\"},\"email\":{\"value\":\"martelsimplicity@hotmail.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"5147573052\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"\",\"label\":\"Company Name\",\"field\":\"_billing_company\"},\"billing_address\":{\"value\":\"2475 rue Martine\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"\",\"label\":\"Billing Street2\",\"field\":\"_billing_address_2\"},\"billing_city\":{\"value\":\"Ste-Julienne\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J0K 1T0\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"5147573052\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Alysson\\u00a0 Martel\",\"label\":\"Contact Name\"}}','{\"code\":0,\"message\":\"Le contact a \\u00e9t\\u00e9 ajout\\u00e9.\",\"contact\":{\"contact_id\":\"1902008000000155001\",\"contact_name\":\"Alysson\\u00a0 Martel\",\"company_name\":\"\",\"first_name\":\"Alysson\",\"last_name\":\"Martel\",\"designation\":\"\",\"department\":\"\",\"website\":\"\",\"language_code\":\"\",\"language_code_formatted\":\"\",\"contact_salutation\":\"\",\"email\":\"martelsimplicity@hotmail.com\",\"phone\":\"5147573052\",\"mobile\":\"\",\"portal_status\":\"disabled\",\"is_client_review_asked\":false,\"has_transaction\":false,\"contact_type\":\"customer\",\"customer_sub_type\":\"business\",\"owner_id\":\"\",\"owner_name\":\"\",\"source\":\"api\",\"documents\":[],\"twitter\":\"\",\"facebook\":\"\",\"is_crm_customer\":false,\"is_linked_with_zohocrm\":false,\"primary_contact_id\":\"1902008000000155003\",\"zcrm_account_id\":\"\",\"zcrm_contact_id\":\"\",\"crm_owner_id\":\"\",\"payment_terms\":0,\"payment_terms_label\":\"Payable \\u00e0 r\\u00e9ception\",\"credit_limit_exceeded_amount\":0,\"currency_id\":\"1902008000000000101\",\"currency_code\":\"CAD\",\"currency_symbol\":\"$\",\"price_precision\":2,\"exchange_rate\":\"\",\"can_show_customer_ob\":true,\"can_show_vendor_ob\":true,\"opening_balance_amount\":0,\"opening_balance_amount_bcy\":\"\",\"outstanding_ob_receivable_amount\":0,\"outstanding_ob_payable_amount\":0,\"outstanding_receivable_amount\":0,\"outstanding_receivable_amount_bcy\":0,\"outstanding_payable_amount\":0,\"outstanding_payable_amount_bcy\":0,\"unused_credits_receivable_amount\":0,\"unused_credits_receivable_amount_bcy\":0,\"unused_credits_payable_amount\":0,\"unused_credits_payable_amount_bcy\":0,\"unused_retainer_payments\":0,\"status\":\"active\",\"payment_reminder_enabled\":true,\"is_sms_enabled\":true,\"is_client_review_settings_enabled\":true,\"custom_fields\":[],\"custom_field_hash\":[],\"is_taxable\":true,\"tax_id\":\"\",\"tax_name\":\"\",\"tax_percentage\":\"\",\"contact_category\":\"\",\"sales_channel\":\"direct_sales\",\"ach_supported\":false,\"billing_address\":{\"address_id\":\"1902008000000155004\",\"attention\":\"\",\"address\":\"2475 rue Martine\",\"street2\":\"\",\"city\":\"Ste-Julienne\",\"state_code\":\"\",\"state\":\"QC\",\"zip\":\"J0K 1T0\",\"country\":\"CA\",\"phone\":\"5147573052\",\"fax\":\"\"},\"shipping_address\":{\"address_id\":\"1902008000000155006\",\"attention\":\"\",\"address\":\"\",\"street2\":\"\",\"city\":\"\",\"state_code\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"\",\"phone\":\"\",\"fax\":\"\"},\"contact_persons\":[{\"contact_person_id\":\"1902008000000155003\",\"salutation\":\"\",\"first_name\":\"Alysson\",\"last_name\":\"Martel\",\"email\":\"martelsimplicity@hotmail.com\",\"phone\":\"5147573052\",\"mobile\":\"\",\"mobile_country_code\":\"\",\"mobile_code_formatted\":\"\",\"department\":\"\",\"designation\":\"\",\"skype\":\"\",\"fax\":\"\",\"zcrm_contact_id\":\"\",\"is_added_in_portal\":false,\"can_invite\":true,\"is_primary_contact\":true,\"is_portal_invitation_accepted\":false,\"is_sms_enabled_for_cp\":true,\"photo_url\":\"https:\\/\\/secure.gravatar.com\\/avatar\\/d330826339a3ab85ee415594d71f2ed6?&d=mm\"}],\"addresses\":[],\"pricebook_id\":\"\",\"pricebook_name\":\"\",\"default_templates\":{\"invoice_template_id\":\"\",\"invoice_template_name\":\"\",\"bill_template_id\":\"\",\"bill_template_name\":\"\",\"estimate_template_id\":\"\",\"estimate_template_name\":\"\",\"creditnote_template_id\":\"\",\"creditnote_template_name\":\"\",\"paymentthankyou_template_id\":\"\",\"paymentthankyou_template_name\":\"\",\"invoice_email_template_id\":\"\",\"invoice_email_template_name\":\"\",\"estimate_email_template_id\":\"\",\"estimate_email_template_name\":\"\",\"creditnote_email_template_id\":\"\",\"creditnote_email_template_name\":\"\",\"paymentthankyou_email_template_id\":\"\",\"paymentthankyou_email_template_name\":\"\",\"payment_remittance_email_template_id\":\"\",\"payment_remittance_email_template_name\":\"\"},\"associated_with_square\":false,\"cards\":[],\"checks\":[],\"bank_accounts\":[],\"vpa_list\":[],\"notes\":\"\",\"created_time\":\"2020-01-31T15:21:52-0500\",\"last_modified_time\":\"2020-01-31T15:21:52-0500\",\"tags\":[],\"zohopeople_client_id\":\"\"}}','[]',1,'2020-01-31 20:21:53'),(7,1838,1475,0,'','','contacts','completed','Le client « Julien  Remo » existe déjà. Spécifiez un nom différent. - 3062','{\"first_name\":{\"value\":\"Julien\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Remo\",\"label\":\"Last Name\"},\"email\":{\"value\":\"jul.remo@gmail.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"5149183052\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"\",\"label\":\"Company Name\",\"field\":\"_billing_company\"},\"billing_address\":{\"value\":\"2475 Martine 2475\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"2475\",\"label\":\"Billing Street2\"},\"billing_city\":{\"value\":\"Sainte-Julienne\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J0K 2T0\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"5149183052\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Julien\\u00a0 Remo\",\"label\":\"Contact Name\"}}','{\"code\":3062,\"message\":\"Le client \\u00ab\\u00a0Julien\\u00a0 Remo\\u00a0\\u00bb existe d\\u00e9j\\u00e0. Sp\\u00e9cifiez un nom diff\\u00e9rent.\"}','[]',0,'2020-02-02 01:32:33'),(8,1883,1475,0,'','','contacts','completed','Le client « Équipe de développement /  Development Team » existe déjà. Spécifiez un nom différent. - 3062','{\"first_name\":{\"value\":\"\\u00c9quipe de d\\u00e9veloppement \\/\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Development Team\",\"label\":\"Last Name\"},\"email\":{\"value\":\"dev@upentreprise.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"0290393030\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"\",\"label\":\"Company Name\",\"field\":\"_billing_company\"},\"billing_address\":{\"value\":\"aadd ddadad\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"ddadad\",\"label\":\"Billing Street2\"},\"billing_city\":{\"value\":\"ada\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"H4M 1B0\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"0290393030\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"\\u00c9quipe de d\\u00e9veloppement \\/\\u00a0 Development Team\",\"label\":\"Contact Name\"}}','{\"code\":3062,\"message\":\"Le client \\u00ab\\u00a0\\u00c9quipe de d\\u00e9veloppement \\/\\u00a0 Development Team\\u00a0\\u00bb existe d\\u00e9j\\u00e0. Sp\\u00e9cifiez un nom diff\\u00e9rent.\"}','[]',0,'2020-02-02 15:02:44'),(9,1892,1475,0,'1902008000000153015','https://books.zoho.com/app#/contacts/1902008000000153015','contacts','completed','','{\"first_name\":{\"value\":\"Mononcle\",\"label\":\"First Name\"},\"last_name\":{\"value\":\"Bleau\",\"label\":\"Last Name\"},\"email\":{\"value\":\"production@upentreprise.com\",\"label\":\"Email\"},\"phone\":{\"value\":\"4504990092\",\"label\":\"Phone\"},\"company_name\":{\"value\":\"UPentreprise\",\"label\":\"Company Name\"},\"billing_address\":{\"value\":\"207.2 RUE SAINT-PIERRE NORD\",\"label\":\"Billing Address\"},\"billing_street2\":{\"value\":\"\",\"label\":\"Billing Street2\",\"field\":\"_billing_address_2\"},\"billing_city\":{\"value\":\"Joliette\",\"label\":\"Billing City\"},\"billing_state\":{\"value\":\"QC\",\"label\":\"Billing State\"},\"billing_zip\":{\"value\":\"J6E 0X6\",\"label\":\"Billing Zip\"},\"billing_country\":{\"value\":\"CA\",\"label\":\"Billing Country\"},\"billing_phone\":{\"value\":\"4504990092\",\"label\":\"Billing Phone\"},\"contact_name\":{\"value\":\"Mononcle\\u00a0 Bleau\",\"label\":\"Contact Name\"}}','{\"code\":0,\"message\":\"Le contact a \\u00e9t\\u00e9 ajout\\u00e9.\",\"contact\":{\"contact_id\":\"1902008000000153015\",\"contact_name\":\"Mononcle\\u00a0 Bleau\",\"company_name\":\"UPentreprise\",\"first_name\":\"Mononcle\",\"last_name\":\"Bleau\",\"designation\":\"\",\"department\":\"\",\"website\":\"\",\"language_code\":\"\",\"language_code_formatted\":\"\",\"contact_salutation\":\"\",\"email\":\"production@upentreprise.com\",\"phone\":\"4504990092\",\"mobile\":\"\",\"portal_status\":\"disabled\",\"is_client_review_asked\":false,\"has_transaction\":false,\"contact_type\":\"customer\",\"customer_sub_type\":\"business\",\"owner_id\":\"\",\"owner_name\":\"\",\"source\":\"api\",\"documents\":[],\"twitter\":\"\",\"facebook\":\"\",\"is_crm_customer\":false,\"is_linked_with_zohocrm\":false,\"primary_contact_id\":\"1902008000000153017\",\"zcrm_account_id\":\"\",\"zcrm_contact_id\":\"\",\"crm_owner_id\":\"\",\"payment_terms\":0,\"payment_terms_label\":\"Payable \\u00e0 r\\u00e9ception\",\"credit_limit_exceeded_amount\":0,\"currency_id\":\"1902008000000000101\",\"currency_code\":\"CAD\",\"currency_symbol\":\"$\",\"price_precision\":2,\"exchange_rate\":\"\",\"can_show_customer_ob\":true,\"can_show_vendor_ob\":true,\"opening_balance_amount\":0,\"opening_balance_amount_bcy\":\"\",\"outstanding_ob_receivable_amount\":0,\"outstanding_ob_payable_amount\":0,\"outstanding_receivable_amount\":0,\"outstanding_receivable_amount_bcy\":0,\"outstanding_payable_amount\":0,\"outstanding_payable_amount_bcy\":0,\"unused_credits_receivable_amount\":0,\"unused_credits_receivable_amount_bcy\":0,\"unused_credits_payable_amount\":0,\"unused_credits_payable_amount_bcy\":0,\"unused_retainer_payments\":0,\"status\":\"active\",\"payment_reminder_enabled\":true,\"is_sms_enabled\":true,\"is_client_review_settings_enabled\":true,\"custom_fields\":[],\"custom_field_hash\":[],\"is_taxable\":true,\"tax_id\":\"\",\"tax_name\":\"\",\"tax_percentage\":\"\",\"contact_category\":\"\",\"sales_channel\":\"direct_sales\",\"ach_supported\":false,\"billing_address\":{\"address_id\":\"1902008000000153018\",\"attention\":\"\",\"address\":\"207.2 RUE SAINT-PIERRE NORD\",\"street2\":\"\",\"city\":\"Joliette\",\"state_code\":\"\",\"state\":\"QC\",\"zip\":\"J6E 0X6\",\"country\":\"CA\",\"phone\":\"4504990092\",\"fax\":\"\"},\"shipping_address\":{\"address_id\":\"1902008000000153020\",\"attention\":\"\",\"address\":\"\",\"street2\":\"\",\"city\":\"\",\"state_code\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"\",\"phone\":\"\",\"fax\":\"\"},\"contact_persons\":[{\"contact_person_id\":\"1902008000000153017\",\"salutation\":\"\",\"first_name\":\"Mononcle\",\"last_name\":\"Bleau\",\"email\":\"production@upentreprise.com\",\"phone\":\"4504990092\",\"mobile\":\"\",\"mobile_country_code\":\"\",\"mobile_code_formatted\":\"\",\"department\":\"\",\"designation\":\"\",\"skype\":\"\",\"fax\":\"\",\"zcrm_contact_id\":\"\",\"is_added_in_portal\":false,\"can_invite\":true,\"is_primary_contact\":true,\"is_portal_invitation_accepted\":false,\"is_sms_enabled_for_cp\":true,\"photo_url\":\"https:\\/\\/secure.gravatar.com\\/avatar\\/012a8f74a0bc16ab49dc97de194f39bc?&d=mm\"}],\"addresses\":[],\"pricebook_id\":\"\",\"pricebook_name\":\"\",\"default_templates\":{\"invoice_template_id\":\"\",\"invoice_template_name\":\"\",\"bill_template_id\":\"\",\"bill_template_name\":\"\",\"estimate_template_id\":\"\",\"estimate_template_name\":\"\",\"creditnote_template_id\":\"\",\"creditnote_template_name\":\"\",\"paymentthankyou_template_id\":\"\",\"paymentthankyou_template_name\":\"\",\"invoice_email_template_id\":\"\",\"invoice_email_template_name\":\"\",\"estimate_email_template_id\":\"\",\"estimate_email_template_name\":\"\",\"creditnote_email_template_id\":\"\",\"creditnote_email_template_name\":\"\",\"paymentthankyou_email_template_id\":\"\",\"paymentthankyou_email_template_name\":\"\",\"payment_remittance_email_template_id\":\"\",\"payment_remittance_email_template_name\":\"\"},\"associated_with_square\":false,\"cards\":[],\"checks\":[],\"bank_accounts\":[],\"vpa_list\":[],\"notes\":\"\",\"created_time\":\"2020-02-02T10:59:01-0500\",\"last_modified_time\":\"2020-02-02T10:59:01-0500\",\"tags\":[],\"zohopeople_client_id\":\"\"}}','[]',1,'2020-02-02 15:59:01');
/*!40000 ALTER TABLE `wp_vxc_zoho_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
