<?php
if(session_id() == '') {
    session_start();
}

$host="10.1.13.54:2272";  
$userDB="rambo";  
$passwordDB="rogerthat";  
$database="distributor_kokola";
/*$host="localhost";  
$userDB="root";  
$passwordDB="";  
$database="distributor_kokola";*/

$conn = mysql_connect($host, $userDB, $passwordDB) or die("cannot connect server ");
$db = mysql_select_db($database)  or die('Gagal membuat koneksi database '.mysql_error);

?>