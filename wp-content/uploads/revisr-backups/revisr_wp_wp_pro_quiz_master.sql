
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
DROP TABLE IF EXISTS `wp_wp_pro_quiz_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wp_pro_quiz_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `result_text` text NOT NULL,
  `result_grade_enabled` tinyint(1) NOT NULL,
  `title_hidden` tinyint(1) NOT NULL,
  `btn_restart_quiz_hidden` tinyint(1) NOT NULL,
  `btn_view_question_hidden` tinyint(1) NOT NULL,
  `question_random` tinyint(1) NOT NULL,
  `answer_random` tinyint(1) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `statistics_on` tinyint(1) NOT NULL,
  `statistics_ip_lock` int(10) unsigned NOT NULL,
  `show_points` tinyint(1) NOT NULL,
  `quiz_run_once` tinyint(1) NOT NULL,
  `quiz_run_once_type` tinyint(4) NOT NULL,
  `quiz_run_once_cookie` tinyint(1) NOT NULL,
  `quiz_run_once_time` int(10) unsigned NOT NULL,
  `numbered_answer` tinyint(1) NOT NULL,
  `hide_answer_message_box` tinyint(1) NOT NULL,
  `disabled_answer_mark` tinyint(1) NOT NULL,
  `show_max_question` tinyint(1) NOT NULL,
  `show_max_question_value` int(10) unsigned NOT NULL,
  `show_max_question_percent` tinyint(1) NOT NULL,
  `toplist_activated` tinyint(1) NOT NULL,
  `toplist_data` text NOT NULL,
  `show_average_result` tinyint(1) NOT NULL,
  `prerequisite` tinyint(1) NOT NULL,
  `quiz_modus` tinyint(3) unsigned NOT NULL,
  `show_review_question` tinyint(1) NOT NULL,
  `quiz_summary_hide` tinyint(1) NOT NULL,
  `skip_question_disabled` tinyint(1) NOT NULL,
  `email_notification` tinyint(3) unsigned NOT NULL,
  `user_email_notification` tinyint(1) unsigned NOT NULL,
  `show_category_score` tinyint(1) unsigned NOT NULL,
  `hide_result_correct_question` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hide_result_quiz_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hide_result_points` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `autostart` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `forcing_question_solve` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hide_question_position_overview` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hide_question_numbering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `form_activated` tinyint(1) unsigned NOT NULL,
  `form_show_position` tinyint(3) unsigned NOT NULL,
  `start_only_registered_user` tinyint(1) unsigned NOT NULL,
  `questions_per_page` tinyint(3) unsigned NOT NULL,
  `sort_categories` tinyint(1) unsigned NOT NULL,
  `show_category` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_wp_pro_quiz_master` WRITE;
/*!40000 ALTER TABLE `wp_wp_pro_quiz_master` DISABLE KEYS */;
INSERT INTO `wp_wp_pro_quiz_master` VALUES (1,'Quiz','AAZZAAZZ','a:3:{s:4:\"text\";a:1:{i:0;s:0:\"\";}s:7:\"prozent\";a:1:{i:0;i:0;}s:5:\"activ\";a:1:{i:0;i:1;}}',1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,1,0,0,'a:8:{s:25:\"toplistDataAddPermissions\";i:1;s:15:\"toplistDataSort\";i:1;s:22:\"toplistDataAddMultiple\";b:0;s:19:\"toplistDataAddBlock\";i:1;s:20:\"toplistDataShowLimit\";i:1;s:17:\"toplistDataShowIn\";i:0;s:18:\"toplistDataCaptcha\";b:0;s:23:\"toplistDataAddAutomatic\";b:0;}',0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0);
/*!40000 ALTER TABLE `wp_wp_pro_quiz_master` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

