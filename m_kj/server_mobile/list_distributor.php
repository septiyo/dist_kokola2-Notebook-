<?php
require_once("koneksi.php");

$usr  = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';

$sql = "SELECT * FROM push_distributor pd WHERE pd.SALES_ID = '". $usr ."'";
$result = mysql_query($sql) or die("Note: " . mysql_error());

$data = array();
while ($row = mysql_fetch_array($result)){
	
	$data[] = array(
        'ACCOUNT_ID' => $row['ACCOUNT_ID'],
        'ACCOUNT_NAME' => $row['ACCOUNT_NAME'],
		'ACCOUNT_ADDRESS1' => $row['ACCOUNT_ADDRESS1'],
		'ACCOUNT_CITY_ID1' => $row['ACCOUNT_CITY_ID1'],
		'ACCOUNT_COUNTRY_ID1' => $row['ACCOUNT_COUNTRY_ID1'],
		'ACCOUNT_PHONE1' => $row['ACCOUNT_PHONE1'],
		'ACCOUNT_FAX1' => $row['ACCOUNT_FAX1'],
		'ACCOUNT_EMAILADDRESS' => $row['ACCOUNT_EMAILADDRESS'],
		'PRICEGROUP_CODE' => $row['PRICEGROUP_CODE'],
		'CATEGORY_ID' => $row['CATEGORY_ID'],
		'CATEGORYNAME_ID' => $row['CATEGORYNAME_ID'],
        'SALES_ID' => $row['SALES_ID'],
        'TGL_UPDATE' => $row['TGL_UPDATE']
    );	
	
}

$json = json_encode($data);
echo $json;

?>