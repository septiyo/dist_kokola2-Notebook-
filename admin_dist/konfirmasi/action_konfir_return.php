<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'order_confirm';

// Table's primary key
$primaryKey = 'Id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`a`.`ID_ORDER`', 			'dt' => 0, 'field' => 'ID_ORDER' ),
	array( 'db' => '`a`.`TGL_ORDER`', 	        'dt' => 1, 'field' => 'TGL_ORDER' ),
	array( 'db' => '`a`.`TGL_CONFIRM`',   	    'dt' => 2, 'field' => 'TGL_CONFIRM' ),
	array( 'db' => '`a`.`ACCOUNT_ID`',       	'dt' => 3, 'field' => 'ACCOUNT_ID' ),
	array( 'db' => '`b`.`ACCOUNT_NAME`',     	'dt' => 4, 'field' => 'ACCOUNT_NAME' ),
	array( 'db' => '`a`.`ID_ORDER`', 			'dt' => 5, 'field' => 'ID_ORDER' ),
	
/*	array( 'db' => '`ts`.`ACCOUNT_ID`',     	'dt' => 3, 'field' => 'nopol', 'formatter' => function($d,$row){
																	return strtoupper($d);
																}),*/

);

// SQL server connection information
//require('config.php');
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'distributor_kokola',
	'host' => 'localhost'

);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('jqtable/ssp.customized.class.php' );

//$joinQuery = "FROM `tb_secure` AS `ts` JOIN `tb_qc_baku` AS `tb` ON (`tb`.`rid_secure` = `ts`.`rid_secure`)";
/*$joinQuery = "SELECT a.`ID_ORDER`,a.`TGL_ORDER`,a.`TGL_CONFIRM`,a.`ACCOUNT_ID`,b.`ACCOUNT_NAME`  
              FROM `order_confirm` a 
              INNER JOIN `push_distributor` b ON a.`ACCOUNT_ID` = b.`ACCOUNT_ID`
              WHERE `a.FLAG` = '1' GROUP BY `ID_ORDER` ORDER BY Id DESC;";*/
//$extraWhere = "`u`.`salary` >= 90000";       
$joinQuery = "FROM order_confirm AS a JOIN push_distributor AS b ON (a.ACCOUNT_ID = b.ACCOUNT_ID)";
$extraWhere = "a.FLAG IN ('1','2') AND a.ID_ORDER <> ''";
$groupBy = "a.ID_ORDER";
$order = "a.Id DESC";


echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $order)
);