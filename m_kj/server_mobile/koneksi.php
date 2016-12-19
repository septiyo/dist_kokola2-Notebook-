<?php

$hostname = "10.1.13.54:2272";
$username = "rambo";
$password = "rogerthat";
$database = "distributor_kokola";

$mysqli = mysql_connect($hostname, $username, $password) or die(mysql_error());
$db = mysql_select_db($database, $mysqli) or die(mysql_error());

//$ipserver = "10.2.15.106";
//$ipserver = "10.2.15.105";
//echo("Berhasil");
?>