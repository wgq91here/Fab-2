-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: f2
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.12.04.1

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

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'admin','fe01ce2a7fbac8fafaed7c982a04e229','webmaster@example.com',NULL),(2,'test','fe01ce2a7fbac8fafaed7c982a04e229','wgq91here@gmail.com',NULL);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users` (`from_user_id`),
  KEY `fk_messages_users1` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `mid` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT 'no named',
  `created` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `items` smallint(5) unsigned NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL,
  `lastmessage` varchar(255) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `items` (`items`),
  KEY `created` (`created`),
  KEY `locked` (`locked`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` varchar(20) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL,
  `pdata` text NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `mid` (`mid`),
  KEY `created` (`created`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=549 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `profile_fields`
--

DROP TABLE IF EXISTS `profile_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL,
  `range` varchar(255) NOT NULL,
  `error_message` varchar(255) NOT NULL,
  `other_validator` varchar(255) NOT NULL,
  `default` varchar(255) NOT NULL,
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_fields`
--

LOCK TABLES `profile_fields` WRITE;
/*!40000 ALTER TABLE `profile_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `about` text NOT NULL,
  `street` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`profile_id`),
  KEY `fk_profiles_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,1,'admin','admin','',''),(2,2,'demo','demo','','');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_acl_user_groups`
--

DROP TABLE IF EXISTS `sys_acl_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_acl_user_groups` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `group_name` varchar(60) NOT NULL DEFAULT '',
  `left_value` int(11) NOT NULL,
  `right_value` int(11) NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '',
  `has_users` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_group_id`),
  UNIQUE KEY `group_name` (`group_name`),
  KEY `left_value` (`left_value`,`right_value`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_acl_user_groups`
--

LOCK TABLES `sys_acl_user_groups` WRITE;
/*!40000 ALTER TABLE `sys_acl_user_groups` DISABLE KEYS */;
INSERT INTO `sys_acl_user_groups` VALUES (0,-1,'_#_ROOT_GROUP_#_',1,22,'',0),(1,0,'管理员组',2,3,'管理员',0),(2,0,'开发组',4,15,'开发组开发组',5),(3,2,'QeeYuan Team',5,8,'',16),(4,3,'QeePHP Team',6,7,'',1),(5,2,'FleaPHP Team',9,14,'',1),(6,5,'FleaCMS Team',10,13,'',1),(7,0,'PHPChina Team',16,21,'',3),(9,7,'代码组',17,18,'小组',3),(10,6,'测试组',11,12,'aa',0),(11,7,'PHPChina Programmer',19,20,'程序员',0);
/*!40000 ALTER TABLE `sys_acl_user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_acl_user_groups_have_permissions`
--

DROP TABLE IF EXISTS `sys_acl_user_groups_have_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_acl_user_groups_have_permissions` (
  `user_group_id` int(11) NOT NULL DEFAULT '0',
  `permission_id` int(11) NOT NULL DEFAULT '0',
  `is_allow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_group_id`,`permission_id`,`is_allow`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_acl_user_groups_have_permissions`
--

LOCK TABLES `sys_acl_user_groups_have_permissions` WRITE;
/*!40000 ALTER TABLE `sys_acl_user_groups_have_permissions` DISABLE KEYS */;
INSERT INTO `sys_acl_user_groups_have_permissions` VALUES (2,89,1),(5,89,0),(5,90,1),(6,89,1);
/*!40000 ALTER TABLE `sys_acl_user_groups_have_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_acl_user_groups_have_roles`
--

DROP TABLE IF EXISTS `sys_acl_user_groups_have_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_acl_user_groups_have_roles` (
  `user_group_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `is_include` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_group_id`,`role_id`,`is_include`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_acl_user_groups_have_roles`
--

LOCK TABLES `sys_acl_user_groups_have_roles` WRITE;
/*!40000 ALTER TABLE `sys_acl_user_groups_have_roles` DISABLE KEYS */;
INSERT INTO `sys_acl_user_groups_have_roles` VALUES (1,1,1),(2,3,1),(4,2,1),(4,7,0),(4,8,1),(5,3,0),(5,7,1),(6,8,1),(13,1,1),(13,7,1),(13,8,1),(14,1,1);
/*!40000 ALTER TABLE `sys_acl_user_groups_have_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_menu`
--

DROP TABLE IF EXISTS `sys_user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  `controller` varchar(32) DEFAULT NULL,
  `action` varchar(32) DEFAULT NULL,
  `args` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `target` varchar(32) DEFAULT NULL,
  `split` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order_pos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `parent_id` (`parent_id`,`order_pos`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_menu`
--

LOCK TABLES `sys_user_menu` WRITE;
/*!40000 ALTER TABLE `sys_user_menu` DISABLE KEYS */;
INSERT INTO `sys_user_menu` VALUES (1,'Default','User_Default','Logout','','',NULL,NULL,0,0,1),(2,'ChangeLang','Base','ChangeLang','','',NULL,NULL,0,0,0);
/*!40000 ALTER TABLE `sys_user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_role`
--

DROP TABLE IF EXISTS `user_has_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_has_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_role`
--

LOCK TABLES `user_has_role` WRITE;
/*!40000 ALTER TABLE `user_has_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_has_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','',0,1379897042,1,1),(2,'测试者','21232f297a57a5a743894a0e4a801fc3','demo@example.com','',0,1268121797,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-04 13:11:18
