/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.20 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `forecast` (
	`ID` int ,
	`ID_KJ` varchar ,
	`TGL` datetime ,
	`TRIWULAN` varchar ,
	`BULAN_INPUT` varchar ,
	`NAMA_DIST` varchar ,
	`DAERAH` varchar ,
	`ID_PRODUK` varchar ,
	`NAMA_PRODUK` varchar ,
	`ITEM_CODE` varchar ,
	`HARGA` int ,
	`BLN_AKHIR` int ,
	`FORECAST` int ,
	`PERSEN` varchar ,
	`BULAN1` varchar ,
	`BULAN2` varchar ,
	`BULAN3` varchar ,
	`TOTAL_VALUE` double ,
	`SET_BLN1` varchar ,
	`SET_BLN2` varchar ,
	`SET_BLN3` varchar ,
	`ACCOUNT_ID` int ,
	`publish` varchar ,
	`STATUS_APR` char 
); 
