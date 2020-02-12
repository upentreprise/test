
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
DROP TABLE IF EXISTS `wp_gf_form_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_gf_form_meta` (
  `form_id` mediumint(8) unsigned NOT NULL,
  `display_meta` longtext COLLATE utf8mb4_unicode_ci,
  `entries_grid_meta` longtext COLLATE utf8mb4_unicode_ci,
  `confirmations` longtext COLLATE utf8mb4_unicode_ci,
  `notifications` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_gf_form_meta` WRITE;
/*!40000 ALTER TABLE `wp_gf_form_meta` DISABLE KEYS */;
INSERT INTO `wp_gf_form_meta` VALUES (1,'{\"title\":\"Inscription au webinaire 15 f\\u00e9vrier du samedi 15 f\\u00e9vrier | 9 h\",\"description\":\"\",\"labelPlacement\":\"top_label\",\"descriptionPlacement\":\"below\",\"button\":{\"type\":\"text\",\"text\":\"S\'inscrire\",\"imageUrl\":\"\"},\"fields\":[{\"type\":\"name\",\"id\":1,\"label\":\"\",\"adminLabel\":\"\",\"isRequired\":true,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"nameFormat\":\"advanced\",\"inputs\":[{\"id\":\"1.2\",\"label\":\"Prefix\",\"name\":\"\",\"choices\":[{\"text\":\"Mr.\",\"value\":\"Mr.\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Mrs.\",\"value\":\"Mrs.\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Miss\",\"value\":\"Miss\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Ms.\",\"value\":\"Ms.\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Dr.\",\"value\":\"Dr.\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Prof.\",\"value\":\"Prof.\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Rev.\",\"value\":\"Rev.\",\"isSelected\":false,\"price\":\"\"}],\"isHidden\":true,\"inputType\":\"radio\"},{\"id\":\"1.3\",\"label\":\"First\",\"name\":\"\",\"isHidden\":false,\"placeholder\":\"Pr\\u00e9nom\"},{\"id\":\"1.4\",\"label\":\"Middle\",\"name\":\"\",\"isHidden\":true},{\"id\":\"1.6\",\"label\":\"Last\",\"name\":\"\",\"isHidden\":false,\"placeholder\":\"Nom\"},{\"id\":\"1.8\",\"label\":\"Suffix\",\"name\":\"\",\"isHidden\":true}],\"formId\":1,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":false,\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"hidden_label\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"hidden_label\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"choices\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"multipleFiles\":false,\"maxFiles\":\"\",\"calculationFormula\":\"\",\"calculationRounding\":\"\",\"enableCalculation\":\"\",\"disableQuantity\":false,\"displayAllCategories\":false,\"useRichTextEditor\":false,\"checkboxLabel\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"},{\"type\":\"email\",\"id\":2,\"label\":\"\",\"adminLabel\":\"\",\"isRequired\":true,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"formId\":1,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":false,\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"Courriel\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"choices\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"emailConfirmEnabled\":false,\"multipleFiles\":false,\"maxFiles\":\"\",\"calculationFormula\":\"\",\"calculationRounding\":\"\",\"enableCalculation\":\"\",\"disableQuantity\":false,\"displayAllCategories\":false,\"useRichTextEditor\":false,\"checkboxLabel\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"}],\"version\":\"2.4.16.11\",\"id\":1,\"nextFieldId\":3,\"useCurrentUserAsAuthor\":true,\"postContentTemplateEnabled\":false,\"postTitleTemplateEnabled\":false,\"postTitleTemplate\":\"\",\"postContentTemplate\":\"\",\"lastPageButton\":null,\"pagination\":null,\"firstPageCssClass\":null,\"notifications\":{\"5e31b2ce5653b\":{\"id\":\"5e31b2ce5653b\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}},\"confirmations\":{\"5e31b2ce577c5\":{\"id\":\"5e31b2ce577c5\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Thanks for contacting us! We will get in touch with you shortly.\",\"url\":\"\",\"pageId\":\"\",\"queryString\":\"\"}},\"subLabelPlacement\":\"below\",\"cssClass\":\"\",\"enableHoneypot\":false,\"enableAnimation\":false,\"save\":{\"enabled\":false,\"button\":{\"type\":\"link\",\"text\":\"Save and Continue Later\"}},\"limitEntries\":false,\"limitEntriesCount\":\"\",\"limitEntriesPeriod\":\"\",\"limitEntriesMessage\":\"\",\"scheduleForm\":false,\"scheduleStart\":\"\",\"scheduleStartHour\":\"\",\"scheduleStartMinute\":\"\",\"scheduleStartAmpm\":\"\",\"scheduleEnd\":\"\",\"scheduleEndHour\":\"\",\"scheduleEndMinute\":\"\",\"scheduleEndAmpm\":\"\",\"schedulePendingMessage\":\"\",\"scheduleMessage\":\"\",\"requireLogin\":false,\"requireLoginMessage\":\"\"}',NULL,'{\"5e31b2ce577c5\":{\"id\":\"5e31b2ce577c5\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Merci, vous recevrez un courriel avec les informations pour vous connecter au webinaire.\",\"url\":\"\",\"pageId\":0,\"queryString\":\"\",\"disableAutoformat\":false,\"conditionalLogic\":[]}}','{\"5e31b2ce5653b\":{\"id\":\"5e31b2ce5653b\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}}');
/*!40000 ALTER TABLE `wp_gf_form_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

