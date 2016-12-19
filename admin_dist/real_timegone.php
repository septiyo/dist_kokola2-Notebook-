<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
//error_reporting(0);
//session_start();


	include "../koneksi.php";
	
	$tanggalan   = $_POST['JADWAL'];
			 $bulanan   = $_POST['BULANAN'];
			 $tahunan   = $_POST['TAHUNAN'];
			 $bulanan = substr($bulanan, -2);
			 $tahunan = substr($tahunan, -4);

date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$lanku = date('m');
				$wkt = date('H:i:s'); 
$jumhari = cal_days_in_month(CAL_GREGORIAN, $bulanan, $tahunan);


	
			 
             $kun = explode(",",$tanggalan);
             //$jumlah_kun = count($kun)-1;
			 //////tambahan replace
			 $rep = str_replace(',', '', $tanggalan);
			 $lace = str_split($rep,2);
			 $ace = array_unique($lace);
			 
			 $jumlah_kun = count($ace);
			 //////////////akhir replace
			 
			//echo "<th style='min-width:70px'>Nama Produk</th>";
		$aa1 = array();
		$bb1 = array();
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
				$siomie = (int)$ace[$i];
				//echo "<th style='min-width:50px' >$siomie |</th>";
				        //echo "<br>";
				//echo "$iomie"";
				$arr1 = array($siomie);
				array_push($aa1, $siomie);
				
				
				//print_r($arr1);
				}
//echo	json_encode($aa1);
$aa =	json_encode($aa1);
	$lun1 = str_replace('[', '', $aa);
	$lun2 = str_replace(']', '', $lun1);
	//echo $lun2;	

	
			//print_r($aa);
			//$ggg = array_map('strval', $aa);
			// $ggg = array_shift($aa);	
			// echo $ggg;
			//print_r($ggg);
				
  		//echo "<br>$jumhari<br>";
		
	
		for($i=1; $i<=$jumhari; $i++){
			//echo "$i| ";
			$arr2 = array($i);
			array_push($bb1, $i);
			//print_r($arr2);
		}
		//print_r($bb);
	$bb =	json_encode($bb1);
	$lan1 = str_replace('[', '', $bb);
	$lan2 = str_replace(']', '', $lan1);
	//echo $lan2;	
		//echo "<br>";
$array1 = array($lun2);
$array2 = array(4,5,6);
$result = array_diff($bb1, $aa1); 

//print_r($result);
//echo json_encode($result);


$columns = implode(", ",array_keys($result));
$escaped_values = implode(", ",array_values($result));
//$escaped_values = array_map('mysql_real_escape_string', array_values($result));
//$values  = implode(", ", $escaped_values);
$values  = implode(", ",array_values($result));
//$sql = "INSERT INTO hari_kerja ($columns) VALUES ($values)";
//$sql = "INSERT INTO hari_kerja (JUMLAH_HARI) VALUES ($values)";
//$hasil_del = mysql_query($sql);
//print_r($escaped_values);
//echo $sql;
//echo "ini :$escaped_values<br>";


//echo "br<>jumlahnya  :".$jumlah_kutu;
?>
<form method='post' action='lihat_timrgone.php' id="SAMA" data-ajax="false">
<?php
             $values = str_replace(' ', '', $values);
             $jum_tgl = explode(",",$values);
			 $jumlah_tgl = count($jum_tgl);
			 //////////////akhir replac
	echo "<br><br><a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a><div style='padding:10px 30px;' data-theme='a' class='ui-corner-all'>";		 
	echo "<div>Hari kerja bulan $bulanan tahun  $tahunan</div>";
			for($i=0; $i<$jumlah_tgl; $i++){
				$katara = $jum_tgl[$i];
	echo "<input type='hidden' name='LANCAR[]'  value='$tahunan-$bulanan-$katara'  class='LANCAR'>";
	
	echo  "$katara, ";
				}
				echo "<div>Jumlah hari kerja : $jumlah_tgl hari</div>";
				echo "<br><br>
				Apakah yakin anda ingin menyimpan data ?
				<div><input type='submit' value='Ok' name='SAVEKU' id='SAVEKU' > &nbsp; 
				<button id='kem' type='button'>Kembali</button><div></div>";
				
				

			//for($i=0; $i<$jumlah_kun; $i++){
//				$k = $i+1 ;
//				$mol = $kun[$i];
//			  
		?>
        </form>
		</body>
        </html>