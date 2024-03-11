-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: snowTricks
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (29,'libero'),(30,'et'),(31,'illum'),(32,'tenetur');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `comment_user_id_id` int DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`),
  KEY `IDX_9474526C1F67EF2F` (`comment_user_id_id`),
  CONSTRAINT `FK_9474526C1F67EF2F` FOREIGN KEY (`comment_user_id_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (176,254,282,'Molestias et et quo nihil eum alias non vel minima maxime eius sit vero.','2024-03-11 14:48:27'),(177,255,283,'Natus repudiandae reprehenderit asperiores officiis pariatur commodi at eaque ut qui facilis praesentium sed.','2024-03-11 14:48:27'),(178,256,284,'Id et fugiat eligendi vel assumenda et aut beatae sed.','2024-03-11 14:48:27'),(179,257,285,'Laborum illum consequatur quaerat ipsam cumque eum.','2024-03-11 14:48:27'),(180,258,286,'Ex illo possimus quos quo corporis maiores.','2024-03-11 14:48:27'),(181,259,287,'Ex autem ipsum pariatur labore aut sed eaque veritatis saepe exercitationem.','2024-03-11 14:48:27'),(182,260,288,'Temporibus voluptatem aut ipsa doloribus culpa aliquid qui.','2024-03-11 14:48:27'),(183,261,289,'Provident ad ad quas voluptas fugiat minima dolore eaque consequatur vel maxime odit.','2024-03-11 14:48:27'),(184,262,290,'Voluptatibus in dolorem minus ullam dolorem aut et ut et enim et.','2024-03-11 14:48:27'),(185,263,291,'Mollitia eveniet et veniam corporis nobis odit rerum.','2024-03-11 14:48:27'),(186,264,292,'Consequatur tenetur minima fuga commodi adipisci commodi et.','2024-03-11 14:48:27'),(187,265,293,'Ducimus est aut dolorem sint eveniet cum.','2024-03-11 14:48:27'),(188,266,294,'Commodi officiis quis autem asperiores ut mollitia dolore minus aut vel in.','2024-03-11 14:48:27'),(189,267,295,'Consequatur voluptate iure aspernatur id soluta fugiat ut quos in voluptates molestiae.','2024-03-11 14:48:27'),(190,268,296,'Nihil minus dolorem numquam voluptas aut recusandae et dolores illum et iusto.','2024-03-11 14:48:27'),(191,269,297,'Qui hic ut voluptatibus doloremque suscipit qui omnis et ex ut itaque maxime.','2024-03-11 14:48:27'),(192,270,298,'Aliquid ut omnis veritatis eaque possimus autem eius voluptatem et et voluptatem architecto adipisci.','2024-03-11 14:48:27'),(193,271,299,'Aperiam nisi fugiat velit hic ipsa sunt est repellat dolor dolore.','2024-03-11 14:48:27'),(194,272,300,'Qui eos voluptatibus id commodi sunt sequi et perspiciatis laudantium dicta cum.','2024-03-11 14:48:27'),(195,274,302,'Assumenda quaerat distinctio iste quas temporibus fuga odio.','2024-03-11 14:48:27'),(196,NULL,NULL,'Repellendus quasi tempora ut aperiam voluptatum error qui est consequatur sint eos quod.','2024-03-11 14:48:27'),(197,256,303,'dzdfaqzd','2024-03-11 15:23:48');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_video`
--

DROP TABLE IF EXISTS `external_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `external_video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E8AA9AFB281BE2E` (`trick_id`),
  CONSTRAINT `FK_4E8AA9AFB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_video`
--

LOCK TABLES `external_video` WRITE;
/*!40000 ALTER TABLE `external_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `external_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id` int NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_C53D045FBF396750` FOREIGN KEY (`id`) REFERENCES `upload_media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (94,'Numquam praesentium.'),(95,'Mollitia molestias quaerat.'),(96,'Perspiciatis dignissimos.'),(97,'Quod qui placeat.'),(100,'Vel qui.');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trick`
--

DROP TABLE IF EXISTS `trick`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trick` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `update_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_D8F0A91EF675F31B` (`author_id`),
  KEY `IDX_D8F0A91E12469DE2` (`category_id`),
  CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_D8F0A91EF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trick`
--

LOCK TABLES `trick` WRITE;
/*!40000 ALTER TABLE `trick` DISABLE KEYS */;
INSERT INTO `trick` VALUES (254,282,30,'et-est','Et est.','Perspiciatis sed dolorem.','Et id debitis quibusdam qui ipsa consequatur. Adipisci aut iste impedit error voluptas. Amet soluta sunt quibusdam quis laudantium perferendis.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(255,283,31,'sed-laborum','Sed laborum.','Omnis at repellendus.','Voluptate cumque quae eum enim placeat. Est doloribus velit pariatur nisi. Et ut culpa perspiciatis id dolorem.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(256,284,32,'porro-eum-aperiam','Porro eum aperiam.','Nihil quis aspernatur ut voluptas.','Perferendis enim non fugit molestiae illo dolores. Voluptas rerum odit fugiat. Totam et aliquam sit.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(257,285,29,'aut-ducimus-aut','Aut ducimus aut.','Voluptatum incidunt ipsum vitae.','Et itaque sequi consequatur vero. Eveniet reprehenderit quibusdam cum voluptatem optio nulla rerum dolorem. Adipisci officia qui dolorem voluptatem doloremque est corrupti. Ex iusto aliquam officiis minus dolorem velit quas. Enim in vel quidem minus.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(258,286,30,'quibusdam-occaecati-error','Quibusdam occaecati error.','A unde at.','Vel non voluptatem ut esse perspiciatis dolorem similique. Neque sapiente sed odit est corrupti fugiat laborum quae. Dolorem sit illo dolor nostrum.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(259,287,31,'itaque-qui','Itaque qui.','Aut suscipit suscipit voluptatibus.','Quia natus dolorum sint nihil non. Fuga architecto accusantium alias similique numquam. Incidunt eligendi corrupti maiores praesentium quia alias quas.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(260,288,32,'excepturi-neque-dolor','Excepturi neque dolor.','Natus voluptatum quae porro.','Mollitia sunt harum voluptatem magnam dolorem numquam consectetur. Recusandae libero delectus qui vel assumenda quidem. Distinctio dolor voluptatem architecto et dolores aliquam quia.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(261,289,29,'incidunt-ea','Incidunt ea.','Saepe numquam.','Assumenda ea laudantium facilis. Fugit voluptas inventore eum eos magnam quis iusto aut. Alias non eaque praesentium. Consequatur ea aut et tempore fuga voluptatem hic voluptates.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(262,290,30,'molestiae-excepturi-accusantium','Molestiae excepturi accusantium.','Temporibus blanditiis earum repudiandae.','Accusantium sunt quia iusto praesentium suscipit veritatis fuga. Maiores aut ipsa tempora perferendis. Suscipit aperiam voluptas quo incidunt id quaerat.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(263,291,31,'beatae-rerum-veritatis','Beatae rerum veritatis.','Saepe blanditiis magnam officiis.','Id delectus in sapiente ipsam qui. Nesciunt dolorum saepe molestiae repudiandae quidem voluptas.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(264,292,32,'quasi-excepturi-facilis','Quasi excepturi facilis.','Assumenda non et qui veniam.','Maxime quia repellat aut animi laboriosam. Non illo ad et quasi. Adipisci non et dicta excepturi ipsam nesciunt perspiciatis. Necessitatibus sunt laborum molestiae facilis quia molestiae in.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(265,293,29,'consequatur-similique-aut','Consequatur similique aut.','Repellat earum vero velit.','Et officiis optio sint praesentium sunt tempora. Qui repellendus dicta esse. Dicta impedit non voluptatum ducimus ut ex. Est nobis nulla laudantium modi itaque. Aut explicabo magnam omnis ut qui nam facere cupiditate.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(266,294,30,'modi-id','Modi id.','Quo quibusdam qui dolorum.','Consequatur libero magnam magnam adipisci unde temporibus aut voluptatem. Aut voluptatem exercitationem error laboriosam. Sit aperiam cum adipisci dicta quod. Voluptas eum amet minus impedit vero et.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(267,295,31,'voluptas-ratione-molestias','Voluptas ratione molestias.','Voluptas officia temporibus soluta.','Voluptatibus cupiditate voluptatem aut illum accusamus. Earum aut eveniet quia et. Quaerat in odio itaque fugit aperiam. Animi praesentium et unde sequi rem illo magni.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(268,296,32,'ea-aliquid','Ea aliquid.','Libero voluptatum accusantium.','Laudantium occaecati magni animi et iste. Distinctio dolore repudiandae voluptatem dolor qui voluptas ut. Sed inventore est enim quia eius.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(269,297,29,'et-non-illo','Et non illo.','Sapiente deleniti placeat reprehenderit.','Necessitatibus enim nisi repudiandae et est quo et dolor. Minima aut sunt eum quod voluptas eaque rerum. Iusto dolorem fuga dolores. Ea sint aut incidunt non.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(270,298,30,'cumque-vel-provident','Cumque vel provident.','Esse voluptates sit doloremque sit.','Fugiat sit inventore eum qui. Recusandae et nesciunt eos perferendis odit. Omnis esse nobis officiis placeat consequatur vitae quod.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(271,299,31,'eveniet-consequatur-reprehenderit','Eveniet consequatur reprehenderit.','Quo et veniam est.','Distinctio ut accusamus maiores quam veniam. Quia quod sit dolor voluptatem porro hic error. Minima alias et dolor voluptatem ducimus nihil.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(272,300,32,'cumque-inventore','Cumque inventore.','Vel tempora maiores voluptatibus.','Dolorem aut perferendis esse ut maxime et et. Perspiciatis dignissimos enim fugiat qui nemo nesciunt.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(273,301,29,'maiores-esse-veniam','Maiores esse veniam.','Consequatur sunt autem.','Et est veniam placeat qui blanditiis. Quae voluptatum rerum mollitia et optio.','2024-03-11 14:48:27','2024-03-11 14:48:27'),(274,302,29,'test','test','Nemo deserunt aut quia.','Harum ut nulla qui et. Quod dolor sed dolore dolores quia. Et ullam illum eius error molestiae velit dolor.','2024-03-11 14:48:27','2024-03-11 14:48:27');
/*!40000 ALTER TABLE `trick` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_media`
--

DROP TABLE IF EXISTS `upload_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4371EC13B281BE2E` (`trick_id`),
  CONSTRAINT `FK_4371EC13B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_media`
--

LOCK TABLES `upload_media` WRITE;
/*!40000 ALTER TABLE `upload_media` DISABLE KEYS */;
INSERT INTO `upload_media` VALUES (94,254,'50_50_Grinds.png','image'),(95,255,'50_50_Grinds.png','image'),(96,256,'50_50_Grinds.png','image'),(97,257,'50_50_Grinds.png','image'),(98,254,'50_50.mp4','video'),(99,255,'50_50.mp4','video'),(100,274,'50_50_Grinds.png','image'),(101,274,'50_50.mp4','video');
/*!40000 ALTER TABLE `upload_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` json DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (282,'veniam','pottier.robert@herve.com','$2y$13$1SuMKxmHkAACYy82t8H1XOR9fe9.79Z.K9rUD0mdWEWsuyXFeQzUK','[\"ROLE_USER\"]',0,''),(283,'necessitatibus','auguste49@begue.com','$2y$13$dLjqN9fwZAWUPz8JIBS1NuuWFuVMKGJwWQMZjRFLm7hZ338XNYpOW','[\"ROLE_USER\"]',0,''),(284,'quia','vlabbe@tele2.fr','$2y$13$x7UqdxR11Bnxazj0bg9HBOXPE5XyFfHbMfgDBMJddfwGwyFSvtJ0O','[\"ROLE_USER\"]',0,''),(285,'consequatur','sophie25@free.fr','$2y$13$EPRPsE6FKnpd4PqHaKg8Jeb7JCu011Hq.CPyrmk2IxE01W7qujvD6','[\"ROLE_USER\"]',0,''),(286,'velit','vgosselin@schneider.com','$2y$13$oMre.B3g3XK5iMedHVKUh.sa9WM9NctAQEeNj40RgMR7sLHOmaXKS','[\"ROLE_USER\"]',0,''),(287,'autem','catherine.joubert@dasilva.com','$2y$13$dR2Vkc66/I1rpsL8nIU90.Pwg/nHUhhgD.GQPWlUhnWnKKqc16wZC','[\"ROLE_USER\"]',0,''),(288,'earum','sguerin@gmail.com','$2y$13$2vzHDhujIoBnqGAtqkhBBOS6Wnf8Mqnrd/dxtw3.mpg2syZ4oeCky','[\"ROLE_USER\"]',0,''),(289,'et','sabine43@mallet.com','$2y$13$SN7ORmdKYSB9sxiOjdE/TOP4/M9REEJKaSUu9gkqVRALoj0.PUM7K','[\"ROLE_USER\"]',0,''),(290,'illo','rene90@live.com','$2y$13$3kdBxm9FNGE53cq4L7n5BeeHGRstLTLieeoI1BuEQUrh5hpYF5WD2','[\"ROLE_USER\"]',0,''),(291,'in','martin.margaud@maillard.com','$2y$13$yzSW2KHNiQIdX.BSttlnweMxjC9nf6tLTtTKhNwWWyi37VOG9Phd.','[\"ROLE_USER\"]',0,''),(292,'molestias','pthibault@barre.org','$2y$13$gC1Aa5uJUvF1mMNZvFLsPuxn.PUGPk48a2hBrqaboa4C2u7lEk3fy','[\"ROLE_USER\"]',0,''),(293,'maxime','bernard44@julien.com','$2y$13$zoXXj6VrgtZvNWS/v3NeweD4cgRz89dU/G2x5DyJZ07EZqwiPKbei','[\"ROLE_USER\"]',0,''),(294,'maxime','william.boucher@ledoux.fr','$2y$13$ssmhTyK0pd6C.qvkxbT36uHY5936uN/fjaSAVelk1l.e/.0nkM69m','[\"ROLE_USER\"]',0,''),(295,'quam','victoire74@rolland.com','$2y$13$wF4/Ny1Tt1eof6XIZZlAN.8m4ylzu4S1hAnVPBjidCRnfM/YFWeAu','[\"ROLE_USER\"]',0,''),(296,'voluptatem','launay.marie@bodin.com','$2y$13$Cj2Yo/QIx5HkFGZvwFJ6ve.nhIb.z8dXJcltZUog7t2PrC.ckSl3e','[\"ROLE_USER\"]',0,''),(297,'aperiam','penelope45@live.com','$2y$13$QiJKQtTgpMmgCChEKULUluQhOtdQPch53W3St87b6djSRMQxl.jM6','[\"ROLE_USER\"]',0,''),(298,'nihil','alexandrie32@bonneau.fr','$2y$13$qUgd9ttsIYB9iyTPf7As3eUpt73YHNaXqfT6hjTav2L7YFYxL5z7O','[\"ROLE_USER\"]',0,''),(299,'molestiae','roger88@dbmail.com','$2y$13$cK13R/j3fgs33LkFZZggJe.ab50A2aRMnKwAQpYLD8c3KFP2s.78q','[\"ROLE_USER\"]',0,''),(300,'corrupti','qlouis@orange.fr','$2y$13$AVaTpc9j3ayBQl4rHMAxoeWrZmlLecR6TpPHFC5GrgAPJsaKtu8/e','[\"ROLE_USER\"]',0,''),(301,'sequi','yves.costa@lopes.com','$2y$13$i8HtM.NkTfkp/1/zHBmvs.HfnCGHnNIdkv53I8yRxnrgSD1MynEoC','[\"ROLE_USER\"]',0,''),(302,'fuga','elisabeth20@laposte.net','$2y$13$w.NXMzcUA2g8cgPlEg7RnO2UjxZcp0ZbA2MdclwiPFrBCJdF5HzvG','[\"ROLE_USER\"]',0,''),(303,'toto','piero69450@gmail.com','$2y$13$3jqil0VcYYU2rrBWBvsVGOdMLBZ9pZ3xxkbkUulvx54AmwynJCrjC','[\"ROLE_USER\"]',1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video` (
  `id` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_7CC7DA2CBF396750` FOREIGN KEY (`id`) REFERENCES `upload_media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (98),(99),(101);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-11 16:28:00
