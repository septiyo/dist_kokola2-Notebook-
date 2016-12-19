# Host: localhost  (Version: 5.5.16)
# Date: 2016-01-29 15:18:46
# Generator: MySQL-Front 5.3  (Build 4.198)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "order_distributor"
#

DROP TABLE IF EXISTS `order_distributor`;
CREATE TABLE `order_distributor` (
  `ID_ORDER` varchar(15) NOT NULL DEFAULT '',
  `TGL` datetime DEFAULT NULL,
  `USERID` varchar(20) DEFAULT NULL,
  `CATATAN` varchar(255) DEFAULT NULL,
  `ACCOUNT_ID` varchar(25) DEFAULT NULL,
  `FLAG` varchar(1) DEFAULT '1',
  PRIMARY KEY (`ID_ORDER`),
  KEY `ID_ORDER` (`ID_ORDER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "order_distributor"
#

INSERT INTO `order_distributor` VALUES ('20160121001','2016-01-21 00:00:00','user3','','15014','1'),('20160122002','2016-01-22 00:00:00','user3','','15014','1'),('20160123003','2016-01-23 00:00:00','user3','','15014','1'),('20160127004','2016-01-26 00:00:00','user3','','15014','1'),('20160127005','2016-01-29 10:00:00','cmsferitangerang',NULL,'47975','1'),('20160128006','2016-01-29 10:00:00','cmsferitangerang',NULL,'47975','2'),('20160128007','2016-01-29 10:00:00','cmsferitangerang',NULL,'47975','2'),('20160128008','2016-01-29 10:00:00','cmsferitangerang',NULL,'47975','2'),('20160128009','2016-01-29 10:00:00','trihaviansejahtera',NULL,'22313','2'),('20160128010','2016-01-29 10:00:00','user3','','15014','1');
