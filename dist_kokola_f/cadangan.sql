CREATE TABLE `kj_draft_f` (
  `ID` INT(10) NOT NULL AUTO_INCREMENT,
  `TGL` DATETIME DEFAULT NULL,
  `TRIWULAN` VARCHAR(100) DEFAULT NULL,
  `BULAN_INPUT` VARCHAR(100) DEFAULT NULL,
  `NAMA_DIST` VARCHAR(100) DEFAULT NULL,
  `DAERAH` VARCHAR(100) DEFAULT NULL,
  `ID_PRODUK` VARCHAR(25) DEFAULT NULL,
  `NAMA_PRODUK` VARCHAR(200) DEFAULT NULL,
  `ITEM_CODE` VARCHAR(100) DEFAULT NULL,
  `HARGA` INT(11) DEFAULT NULL,
  `BLN_AKHIR` INT(11) DEFAULT NULL,
  `FORECAST` INT(11) DEFAULT NULL,
  `PERSEN` VARCHAR(20) DEFAULT NULL,
  `BULAN1` VARCHAR(100) DEFAULT NULL,
  `BULAN2` VARCHAR(100) DEFAULT NULL,
  `BULAN3` VARCHAR(100) DEFAULT NULL,
  `TOTAL_VALUE` DOUBLE DEFAULT NULL,
  `SET_BLN1` VARCHAR(100) DEFAULT NULL,
  `SET_BLN2` VARCHAR(100) DEFAULT NULL,
  `SET_BLN3` VARCHAR(100) DEFAULT NULL,
  `ACCOUNT_ID` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`,`ACCOUNT_ID`),
  KEY `ACCOUNT_ID` (`ACCOUNT_ID`),
  KEY `ITEM_CODE` (`ITEM_CODE`)
) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



CREATE TABLE `order_confirm_f` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_ORDER` VARCHAR(100) DEFAULT NULL,
  `ID_CONFIRM` VARCHAR(100) DEFAULT NULL,
  `TGL_ORDER` DATETIME DEFAULT NULL,
  `ACCOUNT_ID` INT(11) NOT NULL DEFAULT '0',
  `ID_PRODUK` VARCHAR(50) DEFAULT NULL,
  `ITEM_CODE` VARCHAR(255) NOT NULL DEFAULT '',
  `JML_ORDER` INT(10) DEFAULT NULL,
  `KUBIKASI` DOUBLE(4,3) DEFAULT NULL,
  `TGL_CONFIRM` DATETIME DEFAULT NULL,
  `FLAG` VARCHAR(1) DEFAULT '0',
  `FLAG2` VARCHAR(1) DEFAULT NULL,
  `CATATAN2` TEXT,
  `SBG` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`Id`,`ACCOUNT_ID`,`ITEM_CODE`),
  KEY `ID_ORDER` (`ID_ORDER`),
  KEY `ID_PRODUK` (`ID_PRODUK`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;


CREATE TABLE `order_distributor_f` (
  `ID_ORDER` VARCHAR(15) NOT NULL DEFAULT '',
  `TGL` DATETIME DEFAULT NULL,
  `USERID` VARCHAR(20) DEFAULT NULL,
  `CATATAN` VARCHAR(255) DEFAULT NULL,
  `ACCOUNT_ID` VARCHAR(25) DEFAULT NULL,
  `FLAG` VARCHAR(1) DEFAULT '1',
  `CATATAN2` TEXT,
  `SBG` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`ID_ORDER`),
  UNIQUE KEY `ID_ORDER_UNIQUE` (`ID_ORDER`),
  KEY `ID_ORDER` (`ID_ORDER`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;




SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor_f a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '123456' 
                                                
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%');





