
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
DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'info@espaceatman.com','$P$BUaxdgrKNnkHPQHf3cFH.kzkt7SBkc.','julien','info@espaceatman.com','','2020-01-13 20:45:57','',0,'Julien'),(2,'vincent','$P$BuaJewuaZy60JpM1XJI3b/T5b.KD2Q0','vincent','vincent.masse@upbusiness.ca','http://upentreprise.com','2020-01-14 18:21:07','',0,'Vincent Masse'),(3,'guillaume','$P$Bu9l7jehO94ROL5i8irRKoqf5/1nY51','guillaume','guillaume.bleau@upbusiness.ca','http://upentreprise.com','2020-01-14 18:21:33','1579026484:$P$B644Zv801Q1WWkhdPDngzEdjiW9A0u0',0,'Guillaume Bleau'),(5,'dev','$P$BKzJH6G.7oBxfV865ebZdwDzjhm1eF0','dev','dev@upentreprise.com','http://upentreprise.com','2020-01-20 16:40:47','',0,'Équipe de développement / Development Team'),(12,'cloudways','$P$BTyN8TD5KiTiUUjq4/q8VIwgYR3K4F.','cloudways','support@cloudways.com','http://cloudways.com','2020-01-24 21:23:18','',0,'CloudWays Support'),(30,'sylvie.dube','$P$B4IIMcfRyIZJtJ7C2X8Pz9x8z4iZHA.','sylvie-dube','sylvdube@videotron.ca','','2020-02-02 19:19:04','',0,'Sylvie Dube'),(33,'sylvain.desrochers','$P$BLd6404QJhIjtQ/fmkGyb4LIcGdUOz1','sylvain-desrochers','s.desrochers1974@hotmail.ca','','2020-02-03 03:26:21','',0,'Sylvain Desrochers'),(34,'viviane.lacombe','$P$ByhMoVpivU5hcC9.BjAcj0.dwAeO560','viviane-lacombe','viviane.lacombe.c@gmail.com','','2020-02-03 11:52:21','',0,'Viviane Lacombe'),(35,'vb.bbb','$P$BrNjfhyoVHxXQGo7IR8K89rBZjk5PX1','vb-bbb','cooray2017@gmail.com','','2020-02-04 18:36:50','',0,'Vb Bbb'),(36,'matante.bleau','$P$B671l3KUVRTgJz6l5CN6nVWfr1eZ3Z.','matante-bleau','production@upentreprise.com','','2020-02-05 14:54:40','1580917416:$P$BruLOR9cJERx1a6i2dH2A4n7xwpJbM1',0,'Matante Bleau'),(37,'dev1','$P$Bzhm44YULu5/3XBHEMx2FJ4iAAOkHp1','dev1','saaktech.pk@gmail.com','','2020-02-05 20:21:09','1580934070:$P$BD0Q8dr580pKylGTFuOxPW2B.dCswy0',0,'DEV DeV'),(38,'julien.remo','$P$B5LL.X.ZJ/fvkfYNM4d2hbhLqAMYbl0','julien-remo','jul.remo@gmail.com','','2020-02-07 00:33:45','',0,'Julien Remo'),(39,'cc.cooray','$P$BtsC3rsi/./3Mq4F3WhDDTjHG8uG/K0','cc-cooray','charleshan0078@gmail.com','','2020-02-10 13:23:02','',0,'Cc Cooray');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

