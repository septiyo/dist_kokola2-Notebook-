<?php
require_once("koneksi.php");

$usr    = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';
$pass   = isset($_REQUEST['PASS']) ? $_REQUEST['PASS'] : '';
$apikey = isset($_REQUEST['APIKEY']) ? $_REQUEST['APIKEY'] : '';

$sql    = mysql_query("UPDATE user SET ID_APKEY = '" . $apikey . "' WHERE USER = '" . $usr . "' and PASS = '" . $pass . "'");
$status = false;
if (!$sql) {
    die('Invalid query: ' . mysql_error());
} else {
    $status = true;
}

$json = array(
    'stat' => $status
);
echo json_encode($json);
?>