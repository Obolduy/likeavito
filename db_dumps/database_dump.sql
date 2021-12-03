--
-- Table structure for table `api_user_tokens`
--

DROP TABLE IF EXISTS `api_user_tokens`;
CREATE TABLE `api_user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `actual_from` date NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `api_user_tokens`
--

LOCK TABLES `api_user_tokens` WRITE;
/*!40000 ALTER TABLE `api_user_tokens` DISABLE KEYS */;
INSERT INTO `api_user_tokens` VALUES (1,'fmdfmdddddddsaf8884',45,'2021-05-11'),(2,'3c5d30acfe44904c5e76d4836d6c490e',46,'2021-05-11'),(3,'59a23e5452ce22374195fe741950b171',21,'2021-05-11');
/*!40000 ALTER TABLE `api_user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_03c11c6ef820ce52050506d9f9c0cac9`
--

DROP TABLE IF EXISTS `chat_03c11c6ef820ce52050506d9f9c0cac9`;
CREATE TABLE `chat_03c11c6ef820ce52050506d9f9c0cac9` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_03c11c6ef820ce52050506d9f9c0cac9`
--

LOCK TABLES `chat_03c11c6ef820ce52050506d9f9c0cac9` WRITE;
/*!40000 ALTER TABLE `chat_03c11c6ef820ce52050506d9f9c0cac9` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_03c11c6ef820ce52050506d9f9c0cac9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_18fadeb3abce5f4e7e0900dae55b7a05`
--

DROP TABLE IF EXISTS `chat_18fadeb3abce5f4e7e0900dae55b7a05`;
CREATE TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_18fadeb3abce5f4e7e0900dae55b7a05`
--

LOCK TABLES `chat_18fadeb3abce5f4e7e0900dae55b7a05` WRITE;
/*!40000 ALTER TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_18fadeb3abce5f4e7e0900dae55b7a05` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_228345f6ae2939a931d88d74fd48889c`
--

DROP TABLE IF EXISTS `chat_228345f6ae2939a931d88d74fd48889c`;
CREATE TABLE `chat_228345f6ae2939a931d88d74fd48889c` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_228345f6ae2939a931d88d74fd48889c`
--

LOCK TABLES `chat_228345f6ae2939a931d88d74fd48889c` WRITE;
/*!40000 ALTER TABLE `chat_228345f6ae2939a931d88d74fd48889c` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_228345f6ae2939a931d88d74fd48889c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_266bd346b627ef35a01ae7e79056b892`
--

DROP TABLE IF EXISTS `chat_266bd346b627ef35a01ae7e79056b892`;
CREATE TABLE `chat_266bd346b627ef35a01ae7e79056b892` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_266bd346b627ef35a01ae7e79056b892`
--

LOCK TABLES `chat_266bd346b627ef35a01ae7e79056b892` WRITE;
/*!40000 ALTER TABLE `chat_266bd346b627ef35a01ae7e79056b892` DISABLE KEYS */;
INSERT INTO `chat_266bd346b627ef35a01ae7e79056b892` VALUES (1,'sd',1,'2021-10-03 19:40:49'),(2,'dfdffd',1,'2021-10-03 19:40:51'),(3,'Прикол',1,'2021-10-03 19:41:09'),(4,'ds',1,'2021-10-03 19:42:15'),(5,'cd',1,'2021-10-03 19:46:09'),(6,'ds',1,'2021-10-03 19:49:27'),(7,'Другое сообщение',80,'2021-10-03 20:35:32'),(8,'Арр',80,'2021-10-03 20:40:31');
/*!40000 ALTER TABLE `chat_266bd346b627ef35a01ae7e79056b892` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_53200e57c4ccd64378017b367b5d3b4e`
--

DROP TABLE IF EXISTS `chat_53200e57c4ccd64378017b367b5d3b4e`;
CREATE TABLE `chat_53200e57c4ccd64378017b367b5d3b4e` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_53200e57c4ccd64378017b367b5d3b4e`
--

LOCK TABLES `chat_53200e57c4ccd64378017b367b5d3b4e` WRITE;
/*!40000 ALTER TABLE `chat_53200e57c4ccd64378017b367b5d3b4e` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_53200e57c4ccd64378017b367b5d3b4e` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_613d3d5df83eba8845a8211a48fdd3dd`
--

DROP TABLE IF EXISTS `chat_613d3d5df83eba8845a8211a48fdd3dd`;
CREATE TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_613d3d5df83eba8845a8211a48fdd3dd`
--

LOCK TABLES `chat_613d3d5df83eba8845a8211a48fdd3dd` WRITE;
/*!40000 ALTER TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd` DISABLE KEYS */;
INSERT INTO `chat_613d3d5df83eba8845a8211a48fdd3dd` VALUES (1,'Новое сообщение4',11,'2021-06-05 17:47:03'),(2,'Новое сообщение4',11,'2021-06-05 17:47:46');
/*!40000 ALTER TABLE `chat_613d3d5df83eba8845a8211a48fdd3dd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_7b097ef194d72cb9b3264c4ff252d78a`
--

DROP TABLE IF EXISTS `chat_7b097ef194d72cb9b3264c4ff252d78a`;
CREATE TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_7b097ef194d72cb9b3264c4ff252d78a`
--

LOCK TABLES `chat_7b097ef194d72cb9b3264c4ff252d78a` WRITE;
/*!40000 ALTER TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a` DISABLE KEYS */;
INSERT INTO `chat_7b097ef194d72cb9b3264c4ff252d78a` VALUES (1,'fdsdfdfs',49,'2021-06-03 10:28:34'),(2,'fsdfdf',49,'2021-06-03 14:01:05'),(3,'fsd',1,'2021-06-03 14:03:32'),(5,'v',1,'2021-06-03 14:05:44'),(6,'fsd',1,'2021-06-03 14:08:06'),(14,'cxz',1,'2021-06-03 15:27:33'),(15,'fffggf',1,'2021-06-03 16:26:47'),(16,'vdvd',1,'2021-06-03 16:26:50'),(17,'gfghg',1,'2021-06-03 16:26:55'),(18,'Новый текст',49,'2021-06-03 16:27:27'),(20,'ff[ff[f[f[f[',1,'2021-06-03 16:30:50'),(21,'Еще новое',1,'2021-06-03 16:35:28'),(22,'dcddsvdvvdfvvvvfv',1,'2021-06-03 16:57:32'),(23,'dfsdfdsfsdfdf',1,'2021-06-03 16:59:09'),(24,'cvxcvxcc',1,'2021-06-03 17:00:31'),(25,'ahahhah',1,'2021-06-03 17:02:53'),(26,'vdvdvd',1,'2021-06-03 17:03:04'),(27,'fsdf',1,'2021-06-03 17:08:11'),(28,'мввчм',1,'2021-06-03 17:13:20'),(29,'Xnj nfrjt',49,'2021-06-05 15:00:44'),(30,'Что такое',49,'2021-06-05 15:00:48'),(31,'vfvfd',49,'2021-06-05 15:57:44'),(32,'a?',49,'2021-06-05 15:57:48'),(33,'dd',49,'2021-06-05 15:57:51'),(34,'Вот текст',49,'2021-06-05 15:58:36'),(35,'',49,'2021-06-05 15:58:38'),(36,'Последнее',49,'2021-06-05 15:59:27'),(37,'ахахах',49,'2021-06-05 15:59:31'),(38,'dds',49,'2021-06-05 16:06:18'),(39,'Ластван',49,'2021-06-05 16:08:05'),(40,'НАМАААААААААААААААНА',1,'2021-06-05 16:10:45'),(41,'Данила ты что крези',49,'2021-06-05 16:12:37'),(42,'[t[',49,'2021-06-05 16:18:51'),(43,'Дrtrtr',1,'2021-06-05 16:19:16'),(44,'xssssss',1,'2021-06-05 16:54:18'),(45,'',1,'2021-06-05 17:15:50'),(46,'',1,'2021-06-05 17:16:25'),(47,'',1,'2021-06-05 17:17:41'),(48,'Vot forma',1,'2021-06-05 17:17:58'),(49,'fsd',49,'2021-06-05 17:31:35'),(50,'ss',49,'2021-06-05 17:32:49'),(51,'dfgergerg',49,'2021-06-05 17:33:05'),(52,'fdsfd',49,'2021-06-05 17:35:35'),(53,'fdsf',49,'2021-06-05 17:36:03'),(54,'ss',49,'2021-06-05 17:36:18'),(55,'fds',49,'2021-06-05 17:37:35'),(56,'dffe',49,'2021-06-05 17:37:39'),(57,'cvbvbvbb',49,'2021-06-05 17:38:06');
/*!40000 ALTER TABLE `chat_7b097ef194d72cb9b3264c4ff252d78a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--

DROP TABLE IF EXISTS `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`;
CREATE TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd`
--

LOCK TABLES `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` WRITE;
/*!40000 ALTER TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` DISABLE KEYS */;
INSERT INTO `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` VALUES (1,'Test Message2',9,'2021-06-05 17:47:03'),(2,'Test Message2',9,'2021-06-05 17:47:45');
/*!40000 ALTER TABLE `chat_8d9ed36bfaa70b8e8fb691b326e1a0dd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_b548521f5c2763bb46c98923ce8cb7c8`
--

DROP TABLE IF EXISTS `chat_b548521f5c2763bb46c98923ce8cb7c8`;
CREATE TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_b548521f5c2763bb46c98923ce8cb7c8`
--

LOCK TABLES `chat_b548521f5c2763bb46c98923ce8cb7c8` WRITE;
/*!40000 ALTER TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8` DISABLE KEYS */;
INSERT INTO `chat_b548521f5c2763bb46c98923ce8cb7c8` VALUES (1,'TestMessage1',1,'2021-06-05 17:47:03'),(2,'TestMessage1',1,'2021-06-05 17:47:44');
/*!40000 ALTER TABLE `chat_b548521f5c2763bb46c98923ce8cb7c8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_d3aaa443a89bd4841aa021a44583a56b`
--

DROP TABLE IF EXISTS `chat_d3aaa443a89bd4841aa021a44583a56b`;
CREATE TABLE `chat_d3aaa443a89bd4841aa021a44583a56b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_d3aaa443a89bd4841aa021a44583a56b`
--

LOCK TABLES `chat_d3aaa443a89bd4841aa021a44583a56b` WRITE;
/*!40000 ALTER TABLE `chat_d3aaa443a89bd4841aa021a44583a56b` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_d3aaa443a89bd4841aa021a44583a56b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--

DROP TABLE IF EXISTS `chat_ec18e4b5b552fe56d3b88fcc746ceea1`;
CREATE TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chat_ec18e4b5b552fe56d3b88fcc746ceea1`
--

LOCK TABLES `chat_ec18e4b5b552fe56d3b88fcc746ceea1` WRITE;
/*!40000 ALTER TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1` DISABLE KEYS */;
INSERT INTO `chat_ec18e4b5b552fe56d3b88fcc746ceea1` VALUES (1,'Новоесообщение3',12,'2021-06-05 17:47:03'),(2,'Новоесообщение3',12,'2021-06-05 17:47:45');
/*!40000 ALTER TABLE `chat_ec18e4b5b552fe56d3b88fcc746ceea1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats_list`
--

DROP TABLE IF EXISTS `chats_list`;
CREATE TABLE `chats_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat` varchar(256) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `chats_list`
--

LOCK TABLES `chats_list` WRITE;
/*!40000 ALTER TABLE `chats_list` DISABLE KEYS */;
INSERT INTO `chats_list` VALUES (1,'chat_55544',555,44),(2,'chat_4243',42,43),(3,'chat_49_38',49,38),(5,'chat_6a969987d95675e2caf4e00d8453c1ef',49,2),(6,'chat_7b097ef194d72cb9b3264c4ff252d78a',49,1),(7,'chat_5cd6a063c51df65aa0d61bbfd9882874',1,10),(8,'chat_821588896b793f28e7b607f4f43ee80b',1,17),(9,'chat_7177ff6aafad58b0656fca6e31b41601',1,15),(10,'chat_18fadeb3abce5f4e7e0900dae55b7a05',5,28),(11,'chat_53200e57c4ccd64378017b367b5d3b4e',1,20),(12,'chat_d3aaa443a89bd4841aa021a44583a56b',4,38),(13,'chat_613d3d5df83eba8845a8211a48fdd3dd',8,11),(14,'chat_ec18e4b5b552fe56d3b88fcc746ceea1',7,12),(15,'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd',9,13),(16,'chat_b548521f5c2763bb46c98923ce8cb7c8',10,14),(17,'chat_613d3d5df83eba8845a8211a48fdd3dd',8,11),(18,'chat_ec18e4b5b552fe56d3b88fcc746ceea1',7,12),(19,'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd',9,13),(20,'chat_b548521f5c2763bb46c98923ce8cb7c8',10,14),(21,'chat_613d3d5df83eba8845a8211a48fdd3dd',8,11),(22,'chat_ec18e4b5b552fe56d3b88fcc746ceea1',7,12),(23,'chat_8d9ed36bfaa70b8e8fb691b326e1a0dd',9,13),(24,'chat_b548521f5c2763bb46c98923ce8cb7c8',10,14),(25,'chat_266bd346b627ef35a01ae7e79056b892',1,80),(26,'chat_03c11c6ef820ce52050506d9f9c0cac9',80,80),(27,'chat_228345f6ae2939a931d88d74fd48889c',80,78);
/*!40000 ALTER TABLE `chats_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Санкт-Петербург'),(2,'Москва'),(3,'Новосибирск'),(4,'Казань'),(5,'Сочи'),(6,'Уфа'),(7,'Екатеринбург'),(8,'Киев'),(9,'Одесса'),(10,'Минск'),(11,'Витебск'),(12,'Астана'),(13,'Алматы'),(14,'Таллин'),(15,'Вильнюс '),(16,'Рига'),(17,'Кишенёв'),(18,'Душанбе'),(19,'Ташкент'),(20,'Бишкек'),(21,'Ашхабад'),(22,'Бордо');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lot_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `display` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (13,1,2,'','2021-05-16 12:06:57','2021-05-16 12:06:57',1),(14,1,8,'bbngndn','2021-05-16 12:07:24','2021-05-16 12:07:24',1),(15,1,30,'sdffbf','2021-05-16 12:07:42','2021-05-16 12:07:42',1),(16,1,30,'cdvdfbfdb<br> bdfsdf<br>','2021-05-16 12:07:58','2021-05-16 12:07:58',0),(17,1,30,'dfdfdf','2021-05-16 12:11:42','2021-05-16 12:11:42',1),(18,1,30,'dfsfsdfsd','2021-05-16 12:12:37','2021-05-16 12:12:37',1),(29,1,30,'testdesc3','2021-09-21 21:43:10','2021-09-21 21:43:10',1),(30,1,30,'testdesc4','2021-09-21 21:43:10','2021-09-21 21:43:10',1),(31,1,30,'testdesc1','2021-09-21 21:44:09','2021-09-21 21:44:09',1),(32,1,30,'testdesc2','2021-09-21 21:44:09','2021-09-21 21:44:09',1),(33,1,30,'testdesc3','2021-09-21 21:44:09','2021-09-21 21:44:09',1),(34,1,30,'testdesc4','2021-09-21 21:44:09','2021-09-21 21:44:09',1),(35,1,30,'testdesc1','2021-09-21 21:44:30','2021-09-21 21:44:30',1),(36,1,30,'testdesc2','2021-09-21 21:44:30','2021-09-21 21:44:30',1),(37,1,30,'testdesc3','2021-09-21 21:44:30','2021-09-21 21:44:30',1),(38,1,30,'testdesc4','2021-09-21 21:44:30','2021-09-21 21:44:30',1),(50,80,97,'мими','2021-10-06 16:47:36','2021-10-06 16:47:36',1),(51,80,82,'ыв','2021-10-06 16:49:04','2021-10-06 16:49:04',1),(52,80,82,'','2021-10-06 16:49:05','2021-10-06 16:49:05',1),(53,80,82,'','2021-10-06 16:49:08','2021-10-06 16:49:08',1),(54,80,82,'\r\n\r\n\r\n\r\n','2021-10-06 16:49:45','2021-10-06 16:49:45',1),(55,80,82,'','2021-10-06 16:51:29','2021-10-06 16:51:29',1),(56,80,82,'d','2021-10-06 16:51:33','2021-10-06 16:51:33',1),(57,80,82,'','2021-10-06 16:52:15','2021-10-06 16:52:15',1),(58,1,97,'ntnt','2021-10-06 16:56:50','2021-10-06 16:56:50',1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_changes`
--

DROP TABLE IF EXISTS `emails_changes`;
CREATE TABLE `emails_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_email` varchar(64) NOT NULL,
  `current_email` varchar(64) NOT NULL,
  `link` varchar(64) NOT NULL,
  `request_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `emails_changes`
--

LOCK TABLES `emails_changes` WRITE;
/*!40000 ALTER TABLE `emails_changes` DISABLE KEYS */;
INSERT INTO `emails_changes` VALUES (1,'newchange1@email.verify','vdsvc@fef.ru','sessionlink1','2021-09-23 15:51:03'),(2,'newchange2@email.verify','cbfdbdf@efe.ru','sessionlink2','2021-09-23 15:51:03'),(3,'newchange3@email.verify','bibaboba@ffd.ru','sessionlink3','2021-09-23 15:51:03'),(4,'newchange4@email.verify','newemail@test.ru','sessionlink4','2021-09-23 15:51:03');
/*!40000 ALTER TABLE `emails_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lots`
--

DROP TABLE IF EXISTS `lots`;
CREATE TABLE `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `display` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `lots`
--

LOCK TABLES `lots` WRITE;
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
INSERT INTO `lots` VALUES (32,NULL,2,'newAdd6',757858,'fddfdffdfd','2021-04-29 19:33:38',NULL,1),(33,NULL,2,'newAdd7',5355,'newAdd88','2021-04-29 19:33:38',NULL,1),(34,NULL,2,'newAdd8',757858,'fddfdffdfd','2021-04-29 19:34:37',NULL,1),(35,NULL,2,'newAdd9',5355,'newAdd88','2021-04-29 19:34:37',NULL,1),(36,NULL,2,'newAdd10',5355,'newAdd88','2021-04-29 19:34:37',NULL,1),(37,NULL,2,'newAdd11',5355,'newAdd88','2021-04-29 19:34:37',NULL,1),(38,NULL,2,'fdfdfd',5355,'fdfsdfdfd','2021-04-29 19:34:37','2021-05-14 16:00:10',1),(40,49,1,'fdsf',312312,'wds','2021-06-04 18:59:01','2021-06-04 18:59:01',1),(41,1,1,'fgdfgdfg',432,'fdfdsf','2021-06-04 19:01:39','2021-06-04 19:01:39',1),(48,69,5,'TestChangeTitle4',300,'TestDescription4','2021-09-24 13:10:59','2021-09-24 13:19:01',0),(49,1,3,'TestTitle3',101,'Description3','2021-09-24 13:10:59','2021-09-24 13:10:59',1),(50,65,4,'TestTitle4',200,'Description4','2021-09-24 13:10:59','2021-09-24 13:10:59',1),(51,49,2,'TestChangeTitle1',200,'TestDescription1','2021-09-24 13:13:39','2021-09-24 13:19:55',0),(52,69,3,'TestChangeTitle2',2000,'TestDescription2','2021-09-24 13:13:39','2021-09-24 13:19:55',0),(53,1,4,'TestChangeTitle3',202,'TestDescription3','2021-09-24 13:13:39','2021-09-24 13:19:55',0),(54,65,5,'TestChangeTitle4',300,'TestDescription4','2021-09-24 13:13:39','2021-09-24 13:19:55',0),(59,49,1,'TestTitle1',100,'Description1','2021-09-24 13:30:52','2021-09-24 13:30:52',1),(60,69,2,'TestTitle2',1000,'Description2','2021-09-24 13:30:52','2021-09-24 13:30:52',1),(61,1,3,'TestTitle3',101,'Description3','2021-09-24 13:30:52','2021-09-24 13:30:52',1),(62,65,4,'TestTitle4',200,'Description4','2021-09-24 13:30:52','2021-09-24 13:30:52',1),(63,49,1,'TestTitle1',100,'Description1','2021-09-24 13:31:26','2021-09-24 13:31:26',1),(64,69,2,'TestTitle2',1000,'Description2','2021-09-24 13:31:26','2021-09-24 13:31:26',1),(65,1,3,'TestTitle3',101,'Description3','2021-09-24 13:31:26','2021-09-24 13:31:26',1),(66,65,4,'TestTitle4',200,'Description4','2021-09-24 13:31:26','2021-09-24 13:31:26',1),(67,49,1,'TestTitle1',100,'Description1','2021-09-24 13:34:05','2021-09-24 13:34:05',1),(68,69,2,'TestTitle2',1000,'Description2','2021-09-24 13:34:05','2021-09-24 13:34:05',1),(69,1,3,'TestTitle3',101,'Description3','2021-09-24 13:34:05','2021-09-24 13:34:05',1),(70,65,4,'TestTitle4',200,'Description4','2021-09-24 13:34:05','2021-09-24 13:34:05',1),(71,49,1,'TestTitle1',100,'Description1','2021-09-24 15:45:11','2021-09-24 15:45:11',1),(72,69,2,'TestTitle2',1000,'Description2','2021-09-24 15:45:11','2021-09-24 15:45:11',1),(75,1,6,'aboba1',12345,'dvdbrfbdfbdb','2021-09-30 22:35:05','2021-09-30 22:35:05',1),(76,1,5,'aboba2',12232,'brtnnbgffgfv','2021-09-30 22:56:17','2021-09-30 22:56:17',1),(77,77,1,'NewLot1',50,'newdesc1','2021-10-02 10:50:34','2021-10-02 10:50:34',1),(78,78,5,'NewLot2',100,'newdesc2','2021-10-02 10:50:34','2021-10-02 10:50:34',1),(79,79,4,'NewLot3',30,'newdesc3','2021-10-02 10:50:34','2021-10-02 10:50:34',1),(81,77,1,'NewLot1',50,'newdesc1','2021-10-02 10:52:23','2021-10-02 10:52:23',1),(82,78,5,'NewLot2',100,'newdesc2','2021-10-02 10:52:23','2021-10-02 10:52:23',1),(97,80,1,'лооооооот',432,'rere','2021-10-04 21:32:27','2021-10-04 21:34:31',1),(98,84,1,'Для 3 страницы',312,'dfdfmfme','2021-10-06 17:56:50','2021-10-06 17:56:50',1),(99,1,1,'Тест для города',32,'авва','2021-10-06 18:53:08','2021-10-06 18:53:08',1);
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lots_category`
--

DROP TABLE IF EXISTS `lots_category`;
CREATE TABLE `lots_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `lots_category`
--

LOCK TABLES `lots_category` WRITE;
/*!40000 ALTER TABLE `lots_category` DISABLE KEYS */;
INSERT INTO `lots_category` VALUES (1,'Фототехника'),(2,'Одежда'),(3,'Хобби'),(4,'Различная электроника'),(5,'Шоколадные орешки'),(6,'Товары для рисования'),(7,'Другое'),(8,'Услуги');
/*!40000 ALTER TABLE `lots_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lots_pictures`
--

DROP TABLE IF EXISTS `lots_pictures`;
CREATE TABLE `lots_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_id` int(11) NOT NULL,
  `picture` text NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `lots_pictures`
--

LOCK TABLES `lots_pictures` WRITE;
/*!40000 ALTER TABLE `lots_pictures` DISABLE KEYS */;
INSERT INTO `lots_pictures` VALUES (26,72,'075bba0bb9e2903daf8fadde0381b048.JPG'),(27,72,'d2d1e55b40749c9290af4008706958ab.JPG'),(28,72,'1f45e9f3795e5a75b52285947b747417.JPG'),(29,72,'7620b8c321a6b6c018fa3535a42a2cef.JPG'),(30,76,'98b408518b3dd750dd500098af060c09.png'),(31,76,'e9889e21ca8158e26d7f860499987650.png'),(32,76,'b59610bc07ddf1fb086d5686b8d5f401.png'),(52,97,'1866e844b1711cae935d8eb6c7247601.png'),(53,97,'dbcecbcf51d354beb77d694f3691b02f.png'),(54,97,'e8d9f375c8e682848128aceeb2607b5f.png'),(55,97,'a5c2e8455ebc53b1b708b004eb8d8a90.png'),(56,97,'213591fe7616292f19892acd5754e7e0.png');
/*!40000 ALTER TABLE `lots_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `names`
--

DROP TABLE IF EXISTS `names`;
CREATE TABLE `names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `names`
--

LOCK TABLES `names` WRITE;
/*!40000 ALTER TABLE `names` DISABLE KEYS */;
INSERT INTO `names` VALUES (52,48,'newname1'),(53,49,'erferefwer'),(54,1,'rejc'),(56,58,'имяпятн'),(57,59,'fdfsdsdf'),(58,60,'ewwewesf'),(59,61,'fggfgr'),(60,62,'grgrgjwnri'),(61,63,'bvbfgb'),(62,64,'dfsfsdf'),(64,67,'Имяодин'),(65,68,'ererw'),(66,69,'holynewname'),(67,50,'testname50'),(72,74,'RegName1'),(73,75,'RegName2'),(74,76,'RegName3'),(75,77,'RegName4'),(76,78,'Да'),(77,79,'dvsvdsv'),(78,80,'fdsfdsf'),(79,81,'ijuyhgtb'),(80,82,'новоеимя'),(81,83,'vvcxxcv'),(82,84,'rersfe');
/*!40000 ALTER TABLE `names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` char(64) NOT NULL,
  `token` char(64) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `password_reset`
--

LOCK TABLES `password_reset` WRITE;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
INSERT INTO `password_reset` VALUES (11,'test@mail.ru','3698adc43147669189f145846afa856e'),(12,'newemail@iss.ru','c12a055be7b262511ba9724d64307ea6'),(13,'fern@yande.ru','a18791e03c44cd7ea363a79032d7e1bf'),(14,'Emewail@wadw.ru','bde94bc129a30e64f6199fd3e458a727'),(15,'test@mail.ru','22b4b631db5140ad47fe92ad5888cd76'),(16,'newemail@iss.ru','48fca347e85c32f43be1060729535325'),(17,'fern@yande.ru','860a2a9f7adea58cc9cdb00b72073491'),(18,'Emewail@wadw.ru','39704320582f088288fe12994e40a2f9'),(19,'test@mail.ru','51496174e516cfd79755f4047bc1df1d'),(20,'newemail@iss.ru','484830a0e6d45ea0a83c2c3bbefd62ee'),(21,'fern@yande.ru','758ebee4c9934df30a21318c2dc6b6a6'),(22,'Emewail@wadw.ru','21cf2b39466f37bd1999663b1538154c'),(23,'test@mail.ru','515a23f68d198657dec267c98ef29fb4'),(24,'newemail@iss.ru','4558c2e2783c0673392c59499c9caf1d'),(25,'fern@yande.ru','93adb1ac2e6ed77ec27bfabc36dc5e07'),(26,'Emewail@wadw.ru','6136d586195aa259a33cc997777a1bab'),(27,'test@mail.ru','fa9a247876ad39038c371a5dd0087d24'),(28,'newemail@iss.ru','f9d337fc3f7fc210fddd29ce16147bc3'),(29,'fern@yande.ru','55d2f54299161629de9e2f60d05c0356'),(30,'Emewail@wadw.ru','42836b0e98fd9db2891bf2ca7e0875e5'),(31,'test@mail.ru','c31f2a849f35702dec29d24e64259d6b'),(32,'newemail@iss.ru','12e26cfc467e7911f5abb1c3026278da'),(33,'fern@yande.ru','fbf976a45cd04ef23142516e3b480363'),(34,'Emewail@wadw.ru','c7e3294f7a7c1a5cb9cdce32ac7ba507'),(35,'test@mail.ru','a4019dfa0bb712df209cc0fe9ae77d1b'),(36,'newemail@iss.ru','9f4c42f119279eb5333700c2de4b94fb'),(37,'fern@yande.ru','455d7f6e48ce62f00edb81dd87bd0580'),(38,'Emewail@wadw.ru','78e3ceadaf7cea8fd30553f171bed7f6'),(39,'test@mail.ru','496b5e5458ba8d84f5a5ff1cb98a1f3c'),(40,'newemail@iss.ru','bec57ed16dc853066549a9d1b70c6c67'),(41,'fern@yande.ru','ef48d8f06cf33bc6ba619337110921c5'),(42,'Emewail@wadw.ru','59ed91885fde022604e2ae0a540cfdc5'),(43,'test@mail.ru','66a72c942da4b3f69ff83505a7e8b63b'),(44,'newemail@iss.ru','34bb9c877c896d434d074be3fe562a21'),(45,'fern@yande.ru','9317fcd50f34f4646606eaaf70248fb9'),(46,'Emewail@wadw.ru','8b47135ba9f4e1be0ab0118ae161a9d9'),(47,'test@mail.ru','aa4cabfe5ff349ba9f51dfda1aee012e'),(48,'newemail@iss.ru','3b96b5220d1127dc493003e00881da02'),(49,'fern@yande.ru','ec77c791a76640a100a51a2be38c696a'),(50,'Emewail@wadw.ru','d90decfa883c5e8a3230f007dbc2ffa7'),(51,'test@mail.ru','910c7b956abc8cbd80e446001e2368c2'),(52,'newemail@iss.ru','e366c16315324da2a3eaf82cd2577229'),(53,'fern@yande.ru','54b4bb8e0308ae4a93c51d1c55d57850'),(54,'Emewail@wadw.ru','1d77f413098e414575162025cd8a2d0e'),(55,'test@mail.ru','e335bf677c005161cd5156ada323ff97'),(56,'newemail@iss.ru','d2a15c3630e7418e0aea9c4d9401df79'),(57,'fern@yande.ru','fdd8451fb8b828407c90eb90961d023a'),(58,'Emewail@wadw.ru','a90939488841fa4262dfff6e887ce9ba'),(59,'test@mail.ru','5d075f2085497009c5078ae3271b7d22'),(60,'newemail@iss.ru','bea2892df5350239d87e226195f0f466'),(61,'fern@yande.ru','cc392160adcfa8659027ab3ee6fcc5bc'),(62,'Emewail@wadw.ru','d53bf595e4d6f9032cb08853c5b7cec2');
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passwords_changes`
--

DROP TABLE IF EXISTS `passwords_changes`;
CREATE TABLE `passwords_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `link` varchar(64) NOT NULL,
  `request_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `passwords_changes`
--

LOCK TABLES `passwords_changes` WRITE;
/*!40000 ALTER TABLE `passwords_changes` DISABLE KEYS */;
INSERT INTO `passwords_changes` VALUES (1,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-25 14:06:10'),(2,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-25 14:06:10'),(3,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-25 14:06:10'),(4,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-25 14:06:10'),(5,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-25 19:17:54'),(6,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-25 19:17:54'),(7,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-25 19:17:54'),(8,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-25 19:17:54'),(9,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-25 19:19:14'),(10,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-25 19:19:14'),(11,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-25 19:19:14'),(12,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-25 19:19:14'),(13,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-27 13:05:31'),(14,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-27 13:05:31'),(15,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-27 13:05:31'),(16,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-27 13:05:31'),(17,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-27 13:05:56'),(18,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-27 13:05:56'),(19,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-27 13:05:56'),(20,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-27 13:05:56'),(21,'newchange1@email.verify','$2y$10$THa8ortpIF15AyQQ1bInA.4eHK/7EjDRgLYrgSZa.hQXSrOJ3RsJ2','token123456789','2021-09-27 13:10:17'),(22,'newchange2@email.verify','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.','token1234567890','2021-09-27 13:10:17'),(23,'newchange3@email.verify','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K','token12345678901','2021-09-27 13:10:17'),(24,'newchange4@email.verify','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m','token123456789012','2021-09-27 13:10:17');
/*!40000 ALTER TABLE `passwords_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_tokens`
--

DROP TABLE IF EXISTS `registration_tokens`;
CREATE TABLE `registration_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `activated` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `registration_tokens`
--

LOCK TABLES `registration_tokens` WRITE;
/*!40000 ALTER TABLE `registration_tokens` DISABLE KEYS */;
INSERT INTO `registration_tokens` VALUES (1,66,'Token1',1),(2,67,'Token2',1),(3,68,'Token3',1),(4,69,'Token4',1),(5,74,'74/7a6cadfa1d1382e6069a0f968b52eda1',0),(6,75,'75/50a72bb2b746b8fd3fba13a1114a6186',0),(7,76,'76/c58b2f0e107ba9f8fde5a45a72cae319',0),(8,77,'77/c1eab4d3c2f929a33bf24d4f9bdcf189',0),(9,78,'78/e1776cc52bdde98456702d3b12469f27',0),(10,79,'76d639358a40d0b0a9dd77c5de7db2bf',1),(11,80,'dfbe74c4f1c80380e5c9cbbd57ff6c6f',1),(12,81,'87c7fb5a497194c13f8835ad21e12619',0),(13,82,'1148fca6222faa9427ef83e1e96c0b28',0),(14,83,'8a30f204dc11e23921a0273ae880f3f9',0),(15,84,'92b6137a83395ad50c4ad169a5e23b28',0);
/*!40000 ALTER TABLE `registration_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surnames`
--

DROP TABLE IF EXISTS `surnames`;
CREATE TABLE `surnames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `surname` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `surnames`
--

LOCK TABLES `surnames` WRITE;
/*!40000 ALTER TABLE `surnames` DISABLE KEYS */;
INSERT INTO `surnames` VALUES (2,2,'Surname'),(7,7,'sdfdsaf'),(9,9,'cvx'),(12,12,'gvccrrfg'),(13,13,'vbmpohlh'),(15,15,'yjuyjujye'),(16,16,'ssdfdfs'),(17,17,'Surname'),(18,18,'Surname'),(19,19,'Surname'),(20,20,'Surname'),(21,21,'newsurname1'),(22,22,'newsurname2'),(23,23,'newsurname3'),(24,24,'newsurname4'),(29,33,'12345678'),(30,34,'12345678'),(31,35,'12345678'),(32,36,'12345678'),(41,37,'Витальев'),(42,38,'ddsdsds'),(43,39,'c'),(44,40,'Акакьевич'),(45,41,'newsurname4'),(46,42,'newsurname3'),(47,43,'newsurname2'),(52,48,'newsurname1'),(53,49,'dsfdsafasf'),(55,1,'Фдвенецатьадин'),(56,58,'фампятн'),(57,59,'dfdsvdf'),(58,60,'dsgsdg'),(59,61,'cbcvfb'),(60,62,'jkjhyu'),(61,63,'bsbfb'),(62,64,'vxcvxcv'),(64,67,'Фамаодин'),(65,68,'xzvcvxc'),(66,69,'neeewsurname'),(67,50,'testsurname50'),(72,74,'RegSurname1'),(73,75,'RegSurname2'),(74,76,'RegSurname3'),(75,77,'RegSurname4'),(76,78,'Неа'),(77,79,'dsdg'),(78,80,'vcxv'),(79,81,'ngnmnbv'),(80,82,'новаяфамилия'),(81,83,'bbbc'),(82,84,'sdddfss');
/*!40000 ALTER TABLE `surnames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `avatar` text,
  `password` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `ban_status` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `registration_time` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `surname_id` int(11) DEFAULT NULL,
  `name_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test@mail.ru',NULL,'$2y$10$6jUi/DT3RJknkQommkt4sO7/NwHhNPoQQI4sCIvTs3XGz8KWgl7GC',16,2,0,1,'2021-03-26 20:30:30','2021-10-06 18:53:36','testlogin','3adf7e6e7724be6618685bca50f1be88',1,1),(7,'fefergergewg',NULL,'$2y$10$xfhJTtkANGFfL3EQvGgWS.DWYz7WXVCXeNv9IE80kOWQTz9R4sYZ2',2,1,0,0,'2021-03-28 18:50:59',NULL,'wrwrewrsfd',NULL,NULL,NULL),(9,'dgfger3r',NULL,'$2y$10$Bt0vy9Vc72tPHGmEdX125OR3P4Zfx832fMrA8P6LOlWOl6.RAyvAC',2,1,0,0,'2021-03-28 20:36:11',NULL,'guerngwrjg8',NULL,NULL,NULL),(12,'newemail@iss.ru',NULL,'$2y$10$IH/3pKZw8/msh9gn3S5X4OJjEMWnx22JiCAnQAXUDYK0Vy.AZ.sYW',2,1,0,0,'2021-04-06 19:06:47','2021-05-15 17:53:17','newlogin111',NULL,NULL,NULL),(13,'efefr@efe.ru',NULL,'$2y$10$0aEpNPWNGb6eYvYg4MdeuuG6IZQQxXORVwAdW5YakYfwn6kKh3bBm',2,1,0,0,'2021-04-06 19:08:48',NULL,'tuyiuionbv',NULL,13,13),(15,'fegreg@grgr.ts',NULL,'$2y$10$7DwGbU55.PUsGLKc2tcmzuHU9l5E.qPEV0ces6bwlxi7BVA4ZeZs.',2,1,0,0,'2021-04-06 19:12:20',NULL,'mjhgggtt',NULL,15,15),(16,'vbvngfndf@eff.ru',NULL,'$2y$10$GQhrKLGx9dhJkDuetGjbY.RvnawEaXqkKUMHbrS0B.yMHmIWxP0QK',2,1,0,0,'2021-04-06 19:15:19',NULL,'eregrrhfds',NULL,16,16),(17,'Email@wadw.ru',NULL,'$2y$10$QShyBQerGdD9FpuiRpCj0uTmuYB8VCfsu5FEPshvQFRY2McQjbTwm',2,1,0,0,'2021-04-12 19:34:42',NULL,'newlogin',NULL,17,17),(18,'Emewail@wadw.ru',NULL,'$2y$10$IVzvch5iSC80DtanEme.eeaTHn1wi4sE86kpl6.D.JApJtObn64JK',2,1,0,0,'2021-04-12 19:35:38','2021-05-15 17:53:18','nxewlogin',NULL,18,18),(19,'El@wadw.ru',NULL,'$2y$10$o3nfl755esDVtdAzbuXDzOkgYJjO0FqT0aNKlVXDpLOauPlDrNWaO',2,1,0,0,'2021-04-12 19:38:12',NULL,'nxewwwlogin',NULL,19,19),(20,'Elewaaaa@wadw.ru',NULL,'$2y$10$MlsOuoLnGakY.dU1f1DUneJ6f83iXZhxrNmIHW8Ya22wwVW.7ANlO',2,1,0,0,'2021-04-12 19:39:07',NULL,'nxtewwwlogin',NULL,20,20),(21,'email1@com.ru',NULL,'$2y$10$rlmvfTJkuIbld8vWnP1Un.xXJBhn3UorbsEVN9KHvUOI0idAO2RqO',1,1,0,0,'2021-04-15 18:56:47','2021-04-19 19:13:57','newlogin1',NULL,37,37),(22,'email2@com.ru',NULL,'$2y$10$7mhN3gg/xgetZ1./M2ApjOpwXJNJRIjYZcwKz2EtqL5EuTA9sHdbu',4,1,0,0,'2021-04-15 18:56:47','2021-04-19 19:13:57','newlogin2',NULL,38,38),(23,'email3@com.ru',NULL,'$2y$10$xJP3/iaIB0zjl113xxILQOxbtlDdLwX5zT3SE1ytJOCf9MJTDee8.',6,1,0,0,'2021-04-15 18:56:48','2021-04-19 19:13:58','newlogin3',NULL,39,39),(24,'email4@com.ru',NULL,'$2y$10$1LkNqeX2F9qLP/lTddNlceQyyN6FOGSH2EFVKcS6ctn/wPG/0hWDa',5,1,0,0,'2021-04-15 18:56:48','2021-04-19 19:13:58','newlogin4',NULL,40,40),(37,'email@nagfdn.ru',NULL,'$2y$10$QDySLNgsl4328Q79hP8hjOgDOqHVWvZNfEDf73HkMXE3lOdLNo87S',1,1,0,0,'2021-04-23 18:22:45',NULL,'newlogin111e',NULL,41,41),(38,'rgtrgw@eff.ru',NULL,'$2y$10$VhLY9t5Fk1egMJNKZwlcs.yNkV8OAkyIAEgsmOaf4Rp4K00N6Xohm',11,1,1,0,'2021-04-23 18:25:02',NULL,'bgnrynrh',NULL,42,42),(39,'emfddsdail@nan.ru',NULL,'$2y$10$BmI0KwOhDz.xUQ1HgeYrd.PzrT2Dmbris/kcZkykTCfybzfhZu.Ba',7,1,1,0,'2021-04-26 17:06:05','2021-04-28 16:58:51','testlogin58','b5a37fb7e8133ed722ca846a9c4bf3f6',43,43),(40,'fgergg@feje.cum',NULL,'$2y$10$8wxTWWb6S9rJHyM1WHPa2.ujvPg71yZsk1zFC5X3PMadiShWEG8t6',7,2,0,0,'2021-04-28 20:50:07',NULL,'gutrnueto','3058dceb0daeb6d7873f27d60ba17f4e',44,44),(41,'newadminmail4@mail.ru',NULL,'$2y$10$kASmQH0eHzz8flpN088Sxe5MYxMAoLwjQf1.QXVzjeQFRnTYYPHzC',5,1,0,0,'2021-05-07 15:50:45','2021-05-21 21:00:47','login00004',NULL,45,45),(42,'newadminmail3@mail.ru','5c244a97a4e972606e4e039be26a31a7.png','$2y$10$WZja.bhHF0kh3oeBuqeK9eBPfD2.CKTK/OAS0iPRYDVId5Ls1gX8S',4,1,1,1,'2021-05-07 16:08:38','2021-05-21 21:00:47','login00003',NULL,46,46),(43,'newadminmail2@mail.ru',NULL,'$2y$10$BYWZd.dqsbV/xtdN5T5tvOQekOUzobkPEO09WmyueOl0B4Qiulsfi',3,1,1,0,'2021-05-07 19:43:39','2021-05-21 21:00:47','login00002',NULL,47,47),(48,'newadminmail1@mail.ru','5c244a97a4e972606e4e039be26a31a7.png','$2y$10$6cM6H9C8cxmbmidyVN450eNt6Rtuo4bwGITGwVQ/hg8Fz1Wtuh4s6',2,1,1,0,'2021-05-07 20:44:07','2021-10-06 13:54:38','login00001',NULL,52,52),(49,'durakdurak85@mail.ru','156005c5baf40ff51a327f1c34f2975b.jpg','$2y$10$6jUi/DT3RJknkQommkt4sO7/NwHhNPoQQI4sCIvTs3XGz8KWgl7GC',4,1,0,1,'2021-05-29 15:28:52','2021-05-29 15:30:01','Durachok','237b2a9b63009a326c64c390d2abd1e4',53,53),(50,'wewfdsfsd@eer.ru',NULL,'$2y$10$q/m0ja.xWDIL9l/Iw6B58uFBXXcGK2NQNFwuTBnt5LzxB86OJIpoW',1,1,0,0,'2021-09-15 18:09:05',NULL,'testlogin232ew','dec5a2a081122c12c79671390d3179d3',NULL,NULL),(51,'fwesdfsd@wew.com',NULL,'$2y$10$jeOzE2JaujXdh7Qh54o7lOZPjZkyb2uWZ35mZ0tliHmWn.DsOiP3G',1,1,0,0,'2021-09-15 20:52:38',NULL,'dfefeerge',NULL,NULL,NULL),(52,'edfggf@dfdfd.ru',NULL,'$2y$10$d6ULzHQcaJwz3vzvkn8Wde7XElYrR1jn0PcPYiTl1XsOqCo9mEbQS',1,1,0,0,'2021-09-15 21:34:50',NULL,'gntygnfbd',NULL,NULL,NULL),(53,'gfdgdf@fdsfdf.ru',NULL,'$2y$10$J.2k9tiPGVJ1AsxkEjlS..z7cajZMtFw6i8pLDmRyE5LKG.dNg.m6',1,1,0,0,'2021-09-15 21:35:44',NULL,'frfgfdgbfgfgf',NULL,NULL,NULL),(54,'wefrgtyjui@mail.ru',NULL,'$2y$10$sUxeueygm7FsoAHmWeRVE.DuS4ZrninSfEBs0vr0tNBF7.KmOUZqi',1,1,0,0,'2021-09-15 21:37:57',NULL,'dfgrhj',NULL,NULL,NULL),(55,'fsdnfun@mail.ri',NULL,'$2y$10$SXpyx/vQ/pEON3G99USOx.B.mnGmB4L0W9fz0ZVmOVw7HngnID96y',1,1,0,0,'2021-09-16 11:45:22',NULL,'testlogin34',NULL,NULL,NULL),(56,'dsdvsdv@mail.ru',NULL,'$2y$10$8GdNuw0f3UJAOX4AVnEPye6LhYPIRfEm/qGF3j6SHxb0wOFOrsWLq',1,1,0,0,'2021-09-16 12:09:39',NULL,'testloginbvc',NULL,NULL,NULL),(57,'fbddfb@fefe.ru',NULL,'$2y$10$FEWK0smjZMITcNaKituo9OKsoLSv/EpK6aFgjETQj5Bdp6n40bxFS',1,1,0,0,'2021-09-16 12:11:48',NULL,'cndvfivd',NULL,NULL,NULL),(58,'fsdfsfd@efe.ru',NULL,'$2y$10$Udyhkr3.I0zoCa7KcYFWROFv3aB8mcKONlKi3oeD.eedNZKvp.OXK',1,1,0,0,'2021-09-16 12:15:56',NULL,'nanararsf',NULL,56,56),(59,'sdsvsd@ffe.ru',NULL,'$2y$10$5eMb.5lkzjVjVNMD.bQ7vO5BmgYPJ76Jo6eLBo.1QEok50nKuflC6',1,1,0,0,'2021-09-16 12:24:54',NULL,'hnyhnrngndg',NULL,57,57),(60,'csvdfvfdb@wfe.ru',NULL,'$2y$10$eDJo6su20s/0zwd8YyBx2ufOk6JEC7AMmb.Xcnqe9itARJck95.lu',1,1,0,0,'2021-09-16 12:30:30',NULL,'cndvfivdrggffg',NULL,58,58),(61,'vfbfdb@mail.ru',NULL,'$2y$10$bEhN6kqeCsyh2wSylwCgb.sc6Y65SNjw0kfFu8.TNCOldJ4qxaNc6',1,1,0,0,'2021-09-17 11:27:53',NULL,'cvfbdbfb',NULL,59,59),(62,'bhrthehe@gd.ru',NULL,'$2y$10$vaSPv.Kfp.H7VpcqXO0ep.vxdGxXpbyY62tdXE8j.jRGdPyB4/geS',1,1,0,0,'2021-09-17 15:52:46',NULL,'heyjshejyj',NULL,60,60),(63,'grhthr@fefe.ru',NULL,'$2y$10$Aim8ZVGsPNNym7y0pgBqc.kRo7fSJzssozXTJt4dNoMhszBkHiYAa',1,1,0,0,'2021-09-17 15:54:33',NULL,'hmjyjtjy',NULL,61,61),(65,'dfssfsfd@eer.ru',NULL,'$2y$10$ev6oCDMV7/qrIjPuD1XX1uiOHk4/rxu/EGnqlB2v5MPdEjmb5IAcu',1,1,0,0,'2021-09-17 17:35:29',NULL,'rejvrevner',NULL,NULL,NULL),(67,'newchange2@email.verify','f69fff8c944b962580b66f371e08babe.jpg','$2y$10$n0O5bPTJW3Xr7C4E4HADhOe.29XyvMYG/6HiUQzIguuuI6rBr/wk.',1,1,0,1,'2021-09-17 19:19:31','2021-09-27 13:10:17','dcmsdjcndscj','aa84ec2baf1176a5d3d08c395fc893a0',64,64),(68,'newchange3@email.verify','09cae2864f8df8dd54bdb751ab843139.png','$2y$10$pKZxrHu6Qz3RBie5l.cs3eHe5ZVe0sNoftwMYiHWIDwtoJkTBR.6K',1,1,0,1,'2021-09-18 21:36:01','2021-09-27 13:10:17','hihihahapopa',NULL,65,65),(69,'newchange4@email.verify','09cae2864f8df8dd54bdb751ab843139.png','$2y$10$b5jb3msKN9SW5slLzRxqrOAjHXVCqm956DVANAYzyjenORhuz4d5m',1,1,0,1,'2021-09-18 21:41:22','2021-09-27 13:10:17','rektjkngjnjkn',NULL,66,66),(74,'TestRegEmail@one.com',NULL,'TestRegPassword1',1,1,0,0,'2021-09-29 12:32:36',NULL,'TestRegUser1',NULL,72,72),(75,'TestRegEmail@two.com',NULL,'TestRegPassword2',2,1,0,0,'2021-09-29 12:32:36',NULL,'TestRegUser2',NULL,73,73),(76,'TestRegEmail@three.com',NULL,'TestRegPassword3',3,1,0,0,'2021-09-29 12:32:36',NULL,'TestRegUser3',NULL,74,74),(77,'TestRegEmail@four.com',NULL,'TestRegPassword4',4,1,0,0,'2021-09-29 12:32:37',NULL,'TestRegUser4',NULL,75,75),(78,'efw@fee.eu','fc74b79bb68233fedb86ff177ee340ea.png','$2y$10$q8QpaWHM12IGOCL3K0q.M.SFzzuEMAW7SrF.f031flxazvEGmOrUG',1,1,0,0,'2021-10-01 19:29:36',NULL,'bibaboba2324',NULL,76,76),(79,'bfvdc@eree.ru','d41d8cd98f00b204e9800998ecf8427e','$2y$10$cZi3kmGIO2LbgbeklUSRtO8HmQOkWYkatxfD/SJ23AYYO8kKL8c/i',1,1,0,1,'2021-10-01 19:37:35','2021-10-01 19:38:33','loikujhygt',NULL,77,77),(80,'fgrger@efe.ru','fe08a0295ebadd736935ccea600660f8.png','$2y$10$rnbDnCXGCbqjTyAu6R3v0OxDOuwrMLTbh5X/quwb6nvjt5Fq2fQMC',17,1,1,1,'2021-10-01 19:41:46','2021-10-06 16:42:47','ythgrfed','39573224574bedd33458a1b05f7d3592',78,78),(81,'fvgbhj@fbghj.ry','989ecd4cbdf09103d93b94c23353a9b3.png','$2y$10$V/V75miuSN3xPR.D//HP5.Q2l1VyjnwnKo/OizxukkVWnvN6QD9nK',1,1,0,0,'2021-10-03 15:10:52',NULL,'ij7uhytgr',NULL,79,79),(82,'fdgd@efr.ru','989ecd4cbdf09103d93b94c23353a9b3.png','$2y$10$JYPrZheD5oYGZ7AZFl/TqecDHfCetihdcHoHdObbnJq5WXs2GftmW',7,2,1,0,'2021-10-03 15:13:49','2021-10-05 11:59:07','tetalogina',NULL,80,80),(83,'reggreg@efr.ru','989ecd4cbdf09103d93b94c23353a9b3.png','$2y$10$dl.SL3ehwVc87nociaZM3eO0cLHpQu442MKta8rOjo55n95z6j8JW',1,1,0,0,'2021-10-03 15:15:11',NULL,'mjhfvd',NULL,81,81),(84,'bnhghg@fv.ru','989ecd4cbdf09103d93b94c23353a9b3.png','$2y$10$1sCFpyyMz1Afm.PLOuY6Du2snY.MVbDKm1s5nQnpgAquzqu9zXTGe',1,1,0,0,'2021-10-03 15:16:25',NULL,'hmfmmn',NULL,82,82);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;