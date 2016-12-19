# Host: localhost  (Version: 5.5.16)
# Date: 2016-01-29 15:23:44
# Generator: MySQL-Front 5.3  (Build 4.198)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "group_bulan"
#

DROP TABLE IF EXISTS `group_bulan`;
CREATE TABLE `group_bulan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BULAN` varchar(3) DEFAULT NULL,
  `BULAN_TAHUN` varchar(7) DEFAULT NULL,
  `NO_GROUP` int(1) DEFAULT NULL,
  `BULANKE` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "group_bulan"
#

INSERT INTO `group_bulan` VALUES (1,'Jan','01',1,1),(2,'Feb','02',1,2),(3,'Mar','03',1,3),(4,'Mei','04',2,1),(5,'Apr','05',2,2),(6,'Jun','06',2,3),(7,'Jul','07',3,1),(8,'Ags','08',3,2),(9,'Sep','09',3,3),(10,'Okt','10',4,1),(11,'Nov','11',4,2),(12,'Des','12',4,3);
