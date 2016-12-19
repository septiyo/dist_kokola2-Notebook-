<?php
require_once("koneksi.php");

$usr  = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';
$pass = isset($_REQUEST['PASS']) ? $_REQUEST['PASS'] : '';

$usr = str_replace("'", "", $usr);
$usr = preg_replace('/[=&\/\\#,+()$~%":*?<>{}]/', '', $usr);

$sql = mysql_query("SELECT * FROM user WHERE USER = '" . $usr . "' and PASS = '" . $pass . "'");
if (mysql_num_rows($sql) > 0) {
    $status = true;
    $data   = mysql_fetch_assoc($sql);    
} else {
    $status = false;
    $data   = 0;
}

$json = array(
    'stat' => $status,
    'mydata' => $data
);
echo json_encode($json);

?>