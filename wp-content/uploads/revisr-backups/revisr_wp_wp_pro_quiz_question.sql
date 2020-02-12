
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
DROP TABLE IF EXISTS `wp_wp_pro_quiz_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wp_pro_quiz_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `online` tinyint(1) unsigned NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `points` int(11) NOT NULL,
  `question` text NOT NULL,
  `correct_msg` text NOT NULL,
  `incorrect_msg` text NOT NULL,
  `correct_same_text` tinyint(1) NOT NULL,
  `tip_enabled` tinyint(1) NOT NULL,
  `tip_msg` text NOT NULL,
  `answer_type` varchar(50) NOT NULL,
  `show_points_in_box` tinyint(1) NOT NULL,
  `answer_points_activated` tinyint(1) NOT NULL,
  `answer_data` longtext NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `answer_points_diff_modus_activated` tinyint(1) unsigned NOT NULL,
  `disable_correct` tinyint(1) unsigned NOT NULL,
  `matrix_sort_answer_criteria_width` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_wp_pro_quiz_question` WRITE;
/*!40000 ALTER TABLE `wp_wp_pro_quiz_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wp_pro_quiz_question` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

