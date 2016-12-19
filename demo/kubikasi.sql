# Host: localhost  (Version: 5.5.16)
# Date: 2016-01-29 15:17:11
# Generator: MySQL-Front 5.3  (Build 4.198)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "kubikasi"
#

DROP TABLE IF EXISTS `kubikasi`;
CREATE TABLE `kubikasi` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ITEM_CODE` varchar(255) DEFAULT NULL,
  `ITEM_NAME` varchar(255) DEFAULT NULL,
  `KATEGORI` varchar(255) DEFAULT NULL,
  `AKTIF_JUAL` double DEFAULT NULL,
  `PANJANG` varchar(255) DEFAULT NULL,
  `TINGGI` varchar(255) DEFAULT NULL,
  `LEBAR` varchar(255) DEFAULT NULL,
  `KUBIK` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ITEM_CODE` (`ITEM_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

#
# Data for table "kubikasi"
#

INSERT INTO `kubikasi` VALUES (1,'01040301020104','4004076 Chips Ahoy 38x12 6CA','FG',1,NULL,NULL,NULL,0.018),(2,'01040301090001','4016685 Chips Ahoy! Choc Delight 24x 84 g','FG',1,NULL,NULL,NULL,0.0173),(3,'01040301090003','4016687 Chips Ahoy! Original 24x84 gr ','FG',1,NULL,NULL,NULL,0.0173),(4,'01040301090002','4020111 Chips Ahoy! Cho Delight 12x(10x28) g','FG',1,NULL,NULL,NULL,0.0228),(5,'01040301020100','783421 Chips Ahoy 6x(12x38 G) REG','FG',1,NULL,NULL,NULL,NULL),(6,'01040301020101','783424 Chips Ahoy 24x 85,5 g REG','FG',1,NULL,NULL,NULL,0.017),(7,'010401010241','783428 Chips Ahoy 24x142,5 g REG','FG',1,NULL,NULL,NULL,0.025),(8,'01040301020103','783432 Chips Ahoy 12x266 g REG','FG',1,NULL,NULL,NULL,0.025),(9,'01040301020102','784159 Chips Ahoy 84x95 g TW','FG',1,NULL,NULL,NULL,NULL),(10,'01040101020125','BBK/Kukis White Coffee 13.9 gr/20pcsx6ball/120pcs/00','FG',1,NULL,NULL,NULL,0),(11,'02040501010027','Biscuit Kokola Raspbery n Butternut coklat cream 450g 6 Dus','FG',1,'383','201','331',0.025481373),(12,'010401010109','Biskuit kokola 2 Rasa Butter n Coconut Cookies Hypermart 400 gr','FG',1,NULL,NULL,NULL,0),(13,'01040101020042','Biskuit kokola delicious cookies butter 350 gr','FG',1,'463','303','167',0.023428263),(14,'01040101020041','Biskuit kokola delicious cookies kelapa 350 gr','FG',1,'463','303','167',0.023428263),(15,'02040101020012','Biskuit Kokola Delicius 2 rasa butter kelapa 300gr 6 dus','FG',1,'463','303','167',0.023428263),(16,'01040101020110','BK/Apple Puff 250 gr/18pack/00','FG',1,'458','218','235',0.02346334),(17,'01040101020040','BK/Apple Puff 32 gr/12packx6showbox/00','FG',1,NULL,NULL,NULL,0),(18,'01040101010111','BK/Apple Puff 85 gr/10packx3ball/00','FG',1,'358','178','235',0.01497514),(19,'01040101010107','BK/Blueberry Puff 250 gr/18pack/00','FG',1,'458','218','235',0.02346334),(20,'01040101020039','BK/Blueberry Puff 32 gr/12packx6showbox/00','FG',1,NULL,NULL,NULL,0),(21,'01040101010108','BK/Blueberry Puff 85 gr/10packx3ball/00','FG',1,'358','178','235',0.01497514),(22,'02040501010003','BK/Butter Cookies 400 gr/6 bucket/BCF/00','FG',1,'445','360','160',0.025632),(23,'01040101030003','BK/Butter Cookies 400 gr/6 bucket/BGN/00','FG',1,'445','360','160',0.025632),(24,'02040501010010','BK/Butter Cookies 400 gr/6 bucket/BGN/00','FG',1,'445','360','160',0.025632),(25,'02040501010019','BK/Butter Cookies 400 gr/6 bucket/BHY/00','FG',1,'445','360','160',0.025632),(26,'01040101010053','BK/Choco Sandwich 150 gr/24pack/00','FG',1,'373','193','155',0.011158295),(27,'01040101010051','BK/Chocolate Delight 250 gr/18pack/00','FG',1,'313','263','155',0.012759445),(28,'01040101020106','BK/Chocolate Puff 250 gr/18pack/00','FG',1,'458','218','235',0.02346334),(29,'01040101020036','BK/Chocolate puff 32 gr/12packx6showbox/00','FG',1,NULL,NULL,NULL,0),(30,'01040101020105','BK/Chocolate Puff 85 gr/10packx3ball/00','FG',1,'358','178','235',0.01497514),(31,'01040501010015','BK/Coconut and Butter Cookies 400 gr/ 6 Bucket/BHY/00','FG',1,'523','343','175',0.031393075),(32,'02040501010004','BK/Coconut Cookies 400 gr/6 bucket/BCF/00','FG',1,'523','343','175',0.031393075),(33,'01040501010007','BK/Coconut Cookies 400 gr/6 Bucket/BGN/00','FG',1,'523','343','175',0.031393075),(34,'02040501010020','BK/Coconut Cookies 400 gr/6 bucket/BHY/00','FG',1,'523','343','175',0.031393075),(35,'01040101010055','BK/Creamy Cocopandan 200 gr/18pack/00','FG',1,'339','251','137',0.011657193),(36,'01040101010054','BK/Creamy Pineapple 200 gr/18pack/00','FG',1,'339','251','137',0.011657193),(37,'01040101020016','BK/Delicious Durian 110 gr/10packx3ball/00 (lama)','FG',1,NULL,NULL,NULL,0),(38,'01040101020015','BK/Delicious Durian 110 gr/10packx3ball/01 (new)','FG',1,NULL,NULL,NULL,0),(39,'01040101020018','BK/Delicious Kelapa 110 gr/10packx3ball/00 (lama)','FG',1,NULL,NULL,NULL,0),(40,'01040101020017','BK/Delicious Kelapa 110 gr/10packx3ball/01 (new)','FG',1,'393','239','203',0.019067181),(41,'01040101010081','BK/Hai Berry Rasa Chocolate 12 gr/20pcsx9ball/00','FG',1,'473','223','178',0.018775262),(42,'01040101010506','BK/Hai Crackers Cheese 10 gr/180 pcs','FG',1,'329','180','227',0.01344294),(43,'01040101010505','BK/Hai Crackers Seaweed 10 gr/180 pcs','FG',1,'329','180','227',0.01344294),(44,'01040101010507','BK/Hai Crackers Sweet Corn 10 gr/180 pcs','FG',1,'329','180','227',0.01344294),(45,'01040101010500','BK/Kukis Butter 100 gr/10pcsx3ball/00','FG',1,'273','233','227',0.014439243),(46,'01040101020122','BK/Kukis Butter 13.9 gr/20pcsx6ball/120pcs/00','FG',1,'415','173','208',0.01493336),(47,'01040101030011','BK/Kukis Butter 13.9 gr/20pcsx9ball/180pcs/00','FG',1,'415','173','208',0.01493336),(48,'01040101020070','BK/Kukis Butter 300 gr/18pack/00','FG',1,'408','279','180',0.02048976),(49,'01040101030001','BK/Kukis Butter 70 gr/10pcsx6ball/00','FG',1,'317','273','219',0.018952479),(50,'01040101010501','BK/Kukis Coconut 100 gr/10pcsx3ball/00','FG',1,'273','233','227',0.014439243),(51,'01040101020121','BK/Kukis Coconut 13.9 gr/20pcsx6ball/120pcs/00','FG',1,'415','173','208',0.01493336),(52,'01040101030010','BK/Kukis Coconut 13.9 gr/20pcsx9ball/180pcs/00','FG',1,'415','173','208',0.01493336),(53,'02040101020069','BK/Kukis Coconut 300 gr/18pack/00','FG',1,'408','279','180',0.02048976),(54,'01040101030006','BK/Kukis Coconut 70 gr/10pcs x6ball/00','FG',1,'317','273','219',0.018952479),(55,'01040501010001','BK/Kukis Mamah 400 gr/6 Bucket /00','FG',1,'523','343','175',0.031393075),(56,'01040101010504','BK/Kukis Mochachino 100 gr/10pcsx3ball/00','FG',1,'273','233','227',0.014439243),(57,'01040101020123','BK/Kukis Mochachino 13.9 gr/20pcsx6ball/120pcs/00','FG',1,'415','173','208',0.01493336),(58,'01040101030012','BK/Kukis Mochachino 13.9 gr/20pcsx9ball/180pcs/00','FG',1,'415','173','208',0.01493336),(59,'01040101020072','BK/Kukis Mochachino 300 gr/18pack/00','FG',1,'408','279','180',0.02048976),(60,'01040101030002','BK/Kukis Mochachino 70 gr/10pcsx6ball/00','FG',1,'317','273','219',0.018952479),(61,'02040501010012','BK/Kukis n Krim Chocolate 400 gr/6 bucket/00','FG',1,'523','343','175',0.031393075),(62,'02040101010008','BK/Kukis N Krim Strawberry 138 gr/10pcsx3ball/00','FG',1,'275','215','220',0.0130075),(63,'02040101010007','BK/Kukis N Krim Strawberry 30 gr/12pcsx6showbox/72pcs/00','FG',1,NULL,NULL,NULL,0),(64,'02040501010013','BK/Kukis n Krim Strawberry 400 gr/6 bucket/00','FG',1,'523','343','175',0.031393075),(65,'02040501010014','BK/Kukis n Krim Vanilla 400 gr/6 bucket/00','FG',1,'523','343','175',0.031393075),(66,'01040101010502','BK/Kukis Susu Vanilla 100 gr/10pcsx3ball/00','FG',1,'273','233','227',0.014439243),(67,'01040101020124','BK/Kukis Susu Vanilla 13.9 gr/20pcsx6ball/120pcs/00','FG',1,NULL,NULL,NULL,0),(68,'01040101030013','BK/Kukis Susu Vanilla 13.9 gr/20pcsx9ball/180pcs/00','FG',1,'415','173','208',0.01493336),(69,'02040101020073','BK/Kukis Susu Vanilla 300 gr/18pack/00','FG',1,'408','279','180',0.02048976),(70,'01040101030007','BK/Kukis Susu Vanilla 70 gr/10pcs x6ball/00','FG',1,'317','273','219',0.018952479),(71,'01040101010503','BK/Kukis White Coffee 100 gr/10pcsx3ball/00','FG',1,'273','233','227',0.014439243),(72,'01040101030014','BK/Kukis White Coffee 13.9 gr/20pcsx9ball/180pcs/00','FG',1,'415','173','208',0.01493336),(73,'01040101020119','BK/Kukis White Coffee 300 gr/18pack/00','FG',1,'408','279','180',0.02048976),(74,'01040101030008','BK/Kukis White Coffee 70 gr/10pcs x6ball/00','FG',1,'317','273','219',0.018952479),(75,'01040101020115','BK/Litelmaxx chesee 45gr/24 cup/00','FG',1,'353','278','228',0.022374552),(76,'01040101020116','BK/Litelmaxx Chocochips 45gr/24 cup/00','FG',1,'353','278','228',0.022374552),(77,'01040101020118','BK/Litelmaxx seaweed 45gr/24 cup/00','FG',1,'353','278','228',0.022374552),(78,'01040101070001','BK/Malkist Susu 17gr/9ballx20pcs/180pcs','FG',1,'413','278','190',0.02181466),(79,'01040101020019','BK/Marie Susu Madu 100g/6packx6ball/00','FG',1,'468','253','190',0.02249676),(80,'01040101020128','BK/Marie Susu Madu 12g/20pcsx6ball/00','FG',1,'381','263','155',0.015531465),(81,'01040101020032','BK/Marie Susu Madu 180g/24pack/00','FG',1,'445','201','287',0.025670715),(82,'01040101020023','BK/Marieta 100 gr/5packx6ball/00','FG',1,'353','191','292',0.019687516),(83,'01040502000011','BK/Minibit Assorted Crackers 135 gr/12 bucket/00','FG',1,NULL,NULL,NULL,0),(84,'01040501010002','BK/Minibit Choco Banana 150 gr/12 bucket/00','FG',1,'376','253','325',0.0309166),(85,'02040501010006','BK/Minibit Chocochip 150 gr/12 bucket/00','FG',1,'376','253','325',0.0309166),(86,'01040101020133','BK/Minis Kukis Butter 26 gr/5packx12 renceng/60pack/00','FG',1,'259','278','268',0.019296536),(87,'01040101020134','BK/Minis Kukis Coconut 26 gr/5packx12 renceng/60pack/00','FG',1,'259','278','268',0.019296536),(88,'01040101020135','BK/Minis Kukis Susu Vanilla 26 gr/5packx12 renceng/60pack/00','FG',1,'259','278','268',0.019296536),(89,'02040501010007','BK/Mochachino Cookies 400 gr/6 bucket/BCF/00','FG',1,NULL,NULL,NULL,0),(90,'02040501010015','BK/Mochachino Cookies 400 gr/6 bucket/BGN/00','FG',1,NULL,NULL,NULL,0),(91,'02040101020007','BK/Montego Butternut 200 gr/12 showbox/00','FG',1,NULL,NULL,NULL,0),(92,'02040101020009','BK/Montego Chocochip 17 gr/20 pcsx6showbox/00','FG',1,'358','238','165',0.01405866),(93,'02040101010082','BK/Montego Chocochip 50 gr/30pack/00','FG',1,NULL,NULL,NULL,0),(94,'02040101010005','BK/Montego Chocochip Orange 17 gr/20 pcsx6showbox/00','FG',1,'353','238','165',0.01386231),(95,'02040101020008','BK/Montego Chocochip Orange 50 gr/30 pack/00','FG',1,NULL,NULL,NULL,0),(96,'02040101020075','BK/Montego Danish Butter 17 gr/20pcsx6showbox/00','FG',1,'353','238','165',0.01386231),(97,'02040501010023','BK/Montego Danish Butter 454 gr/6 kaleng/00','FG',1,NULL,NULL,NULL,0),(98,'02040101020074','BK/Montego Danish Butter 50 gr/30 pack/00','FG',1,'350','217','193',0.01465835),(99,'02040101020013','BK/Montego Danish Butter 908gr/6 kaleng/00','FG',1,'546','276','282',0.042496272),(100,'01040101090004','BK/Montego Fun Double Choco 17gr/12 pcsx10 showbox/00','FG',1,'329','188','205',0.01267966),(101,'01040101090006','BK/Montego GIA Choco Banana 20 gr x(6SBx20pcs)/00','FG',1,NULL,NULL,NULL,0),(102,'01040101090005','BK/Montego GIA Double Choco 20 gr x(6SBx20pcs)/00','FG',1,NULL,NULL,NULL,0),(103,'01040501010012','BK/Montego Gold Choco Banana 225 gr/12 bucket/00','FG',1,'508','338','195',0.03348228),(104,'01040101090001','BK/Montego Gold Choco Banana 90 gr/24 pack/00','FG',1,NULL,NULL,NULL,0),(105,'01040101090003','BK/Montego Gold Double Choco 90 gr/24 pack/00','FG',1,NULL,NULL,NULL,0),(106,'01040501010014','BK/Montego Gold Double Chocolate 225 gr/12 bucket/00','FG',1,NULL,NULL,NULL,0),(107,'01040501010013','BK/Montego Gold Matcha 225 gr/12 bucket/00','FG',1,'508','338','195',0.03348228),(108,'01040101090002','BK/Montego Gold Matcha 90 gr/ 24pack/00','FG',1,NULL,NULL,NULL,0),(109,'02040101010003','BK/Montego Raspberry 250 gr/12 showbox/00','FG',1,'293','233','223',0.015223987),(110,'01040101020034','BK/Narita Marie Susu 150 gr roll/24pack/00','FG',1,'358','238','237',0.020193348),(111,'01040101020033','BK/Narita Marie Susu 150 gr/24pack/00','FG',1,'363','239','233',0.020214381),(112,'01040101010037','BK/Narita Rose Cream Cappucinno 200 gr/7packx3ball/00','FG',1,NULL,NULL,NULL,0),(113,'01040101010039','BK/Narita Rose Cream Chocolate 120 gr/10packx3ball/00','FG',1,'418','203','187',0.015867698),(114,'01040101010036','BK/Narita Rose Cream Chocolate 200 gr/7packx3ball/00','FG',1,'348','203','250',0.017661),(115,'01040101010038','BK/Narita Rose Cream Lemon 120g/10packx3ball/00','FG',1,'418','203','187',0.015867698),(116,'01040101010035','BK/Narita Rose Cream Lemon 200 gr/7packx3ball/00','FG',1,'348','203','250',0.017661),(117,'01040101010050','BK/Orange Delight 250 gr/18pack/00','FG',1,'313','263','155',0.012759445),(118,'01040101020103','BK/Orange Puff 250 gr/18pack/00','FG',1,'458','218','235',0.02346334),(119,'01040101020038','BK/Orange Puff 32 gr/12packx6showbox/00','FG',1,NULL,NULL,NULL,0),(120,'01040101020102','BK/Orange Puff 85 gr/10packx3ball/00','FG',1,'358','178','235',0.01497514),(121,'01040101030009','BK/PCP Tray/Kukis Butter 13.9gr x 12pack x12tray/00','FG',1,NULL,NULL,NULL,0),(122,'01040101010305','BK/Regi Banana 28.8 gr/10packx6ball/00','FG',1,'293','218','290',0.01852346),(123,'01040101010015','BK/Rose Cream Chocolate 260 gr/10ball/00','FG',1,'338','165','205',0.01143285),(124,'01040101010017','BK/Rose Cream Durian 260 gr/10Ball/00','FG',1,'338','165','205',0.01143285),(125,'01040101010016','BK/Rose Cream Lemon 260 gr/10Ball/00','FG',1,'338','165','205',0.01143285),(126,'01040101010014','BK/Rose Cream Pineapple 260 gr/10 Ball/00','FG',1,'338','165','205',0.01143285),(127,'01040101010052','BK/Shortbread Delight 250 gr/18pack/00','FG',1,'441','283','110',0.01372833),(128,'01040101020099','BK/Strawberry Puff 250 gr/18pack/00','FG',1,'458','218','235',0.02346334),(129,'01040101020003','BK/Strawberry Puff 32 gr/12packx6showbox/00','FG',1,NULL,NULL,NULL,0),(130,'01040101020098','BK/Strawberry Puff 85 gr/10packx3ball/00','FG',1,'358','178','235',0.01497514),(131,'01040101020113','BK/Super Cream Bon Bon 210 gr/7packx3ball/00','FG',1,'348','203','250',0.017661),(132,'01040101010069','BK/Super Cream Orange 210g/7packx3ball/00','FG',1,'348','203','250',0.017661),(133,'01040101010071','BK/Super Cream Pineapple 210 gr/7packx3ball/00','FG',1,'348','203','250',0.017661),(134,'01040101010073','BK/Super Cream Strawberry 210 gr/7packx3ball/00','FG',1,'348','203','250',0.017661),(135,'01040101010082','BK/Unigold Kelapa 30 gr/6ballx10pack/dus/00','FG',1,'408','199','155',0.01258476),(136,'01040501010003','BK/Vanilla Milky Cookies 400 gr/6 Bucket/BGN/00','FG',1,NULL,NULL,NULL,0),(137,'01040501010006','BK/Wafel Cookies Butter 150 gr /12 Showbox','FG',1,NULL,NULL,NULL,0),(138,'01040501010004','BK/Wafel Cookies Cheese 150 gr /12 Showbox','FG',1,NULL,NULL,NULL,0),(139,'01040501010005','BK/Wafel cookies Chocolate 150 gr /12 Showbox','FG',1,NULL,NULL,NULL,0),(140,'01040201030005','BKE/Mochachino Cookies 400gr/6 bucket/Walmart/China/00','FG',1,NULL,NULL,NULL,0),(141,'01040201030004','BKE/Vanilla Milky Cookies 400gr/6 bucket/Walmart/China/00','FG',1,NULL,NULL,NULL,0),(142,'02040501010002','BPL/Cookies Assorted 4 rasa 400 gr/6 bucket/GPL/00','FG',1,NULL,NULL,NULL,0),(143,'01040201020004','BPL/No Brand Butter Cookies 400 gr/6 bucket/00','FG',1,NULL,NULL,NULL,0),(144,'02040201010002','BPL/Select Butternut 200gr/16 pack/00','FG',1,NULL,NULL,NULL,0),(145,'02040201010001','BPL/Select Raspberry 250 gr/18 pack/00','FG',1,NULL,NULL,NULL,0),(146,'010401010110','BPL/Tom n Ben Butternut 200 gr/00','FG',1,NULL,NULL,NULL,0),(147,'01040201010113','BPL/Tom n Ben Raspberry 250 gr/18 pack/00','FG',1,NULL,NULL,NULL,0),(148,'010401010051','BPL/Value Plus Danish Butter 454gr/6 kaleng/00','FG',1,'398','200','290',0.023084),(149,'01040101010012','Gift Pack isi 30 Dus','FG',1,NULL,NULL,NULL,0),(150,'01040502000013','WLK/Majestic Mix Berry 90 gr/30pack/00','FG',1,'373','187','169',0.011787919),(151,'01040102010006','WLK/Majestic Pop Corn Caramel 90 gr/30pack/00','FG',1,'373','187','169',0.011787919),(152,'01040502000012','WLK/Majestic White Coffee 90gr/30pack/00','FG',1,'373','187','169',0.011787919),(153,'01040102020015','WSK/Chiko Mini CocoPandan 11,25 gr/9ball x20 pcs/180/dus/00','FG',1,'423','208','205',0.01803672),(154,'01040102020014','WSK/Chiko Mini Cokelat 11,25 gr/9ball x20 pcs/180/dus/00','FG',1,'423','208','205',0.01803672),(155,'01040102020013','WSK/Long n Long 11 gr/20packx6showbox/00','FG',1,NULL,NULL,NULL,0),(156,'01040102020016','WSK/Majorico Choco Banana 43 gr/10 packx6 showbox/00','FG',1,'439','273','197',0.023609859),(157,'01040102020021','WSK/Majorico Chocolate 90gr/2packx24showbox/00','FG',1,'373','187','169',0.011787919),(158,'01040102020022','WSK/Majorico Vanilla 90gr/2packx24showbox/00','FG',1,'373','187','169',0.011787919);
