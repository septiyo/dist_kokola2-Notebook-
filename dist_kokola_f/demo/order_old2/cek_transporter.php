<?php
require_once("koneksi.php");

$jml_kubik = isset($_REQUEST['JML_KUBIK']) ? $_REQUEST['JML_KUBIK'] : ''; 
$transport = "";
$arr[] = array();
$loop = true;
$jml = 0;
$ke = -1;
$hasil = "";
$volume = "";
while ($loop == true) {
	$sqlTransport = "select * from kubikasi_transporter
		where JML_VOLUME < '".$jml_kubik."'
		order by JML_VOLUME desc limit 1";
	$myTranport = mysql_query($sqlTransport);
	if ($dataTransport = mysql_fetch_assoc($myTranport)) {
		if ($transport !=  $dataTransport["JENIS_KENDARAAN"]) {
			$jml = 1;
			$ke++;
		}
		$transport = $dataTransport["JENIS_KENDARAAN"];
		$volume = $dataTransport["JML_VOLUME"];
		//$jml_kubik = $jml_kubik - $volume;
		$arr[$ke] = array("jml"=>$jml, "mobil"=>$transport);
		//echo $jml." ".$transport."<br />";
		
		$jml++;
	}
	$jml_kubik = $jml_kubik - $volume;
	$sqlTransport = "select * from kubikasi_transporter
		where JML_VOLUME > '".$jml_kubik."'
		order by JML_VOLUME asc limit 1";
	$myTranport = mysql_query($sqlTransport);
	if ($dataTransport = mysql_fetch_assoc($myTranport)) {
		$ke++;
		$transport = $dataTransport["JENIS_KENDARAAN"];
		$volume = $dataTransport["JML_VOLUME"];
		$arr[$ke] = array("jml"=>1, "mobil"=>$transport);
		//$jml_kubik = $jml_kubik - $volume;
		/*if ($transport ==  $dataTransport["JENIS_KENDARAAN"]) {
			$arr[$ke] = array("jml"=>$jml, "mobil"=>$transport);
		}
		else {
			$arr[$ke] = array("jml"=>1, "mobil"=>$transport);
		}*/
		$loop = false;
	}
	$loop++;
}

//if ($jml_kubik == 0) {
	foreach ($arr as $k => $v) {
		$hasil = $hasil.$v["jml"]." ".$v["mobil"].", ";
	}
	echo substr($hasil,0,-2);
//}
//else {
	//echo "";
//}
?>