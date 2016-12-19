# Host: localhost  (Version: 5.5.16)
# Date: 2016-01-29 15:22:56
# Generator: MySQL-Front 5.3  (Build 4.198)

/*!40101 SET NAMES latin1 */;

#
# Function "lapo"
#

DROP FUNCTION IF EXISTS `lapo`;
CREATE FUNCTION `lapo`(Param varchar(3), ke int(11)) RETURNS varchar(25) CHARSET latin1
BEGIN
DECLARE X VARCHAR(25);
select concat(date_format(now(), '%Y'), ' ',BULAN_TAHUN) into X from group_bulan
where no_group = (select no_group from group_bulan where bulan = Param)
and bulanke = ke;
  RETURN X;
END;
