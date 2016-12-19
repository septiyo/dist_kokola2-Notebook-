<?php
include "koneksi.php";
include "bantuan.class.php";
$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");
//print_r($_POST);
if(isset($_POST['SAVE'])) {
	
	//print_r($_POST);
	//$produk = $_POST[PRODUK];
   // $id_jos      = $_POST[ID_JOS];
	//$produk      = $_POST['PRODUK'];
	//$harga       = $_POST['HARGA'];
	$bulan_akhir = $_POST['bln_akhir'];
	$forecast    = $_POST['FORECAST'];
	$persen      = $_POST['PERSEN'];
	$bulan1      = $_POST['BULAN1'];
	$bulan2      = $_POST['BULAN2'];
	$bulan3      = $_POST['BULAN3'];
	$total_value = $_POST['TOTAL_VALUE'];
	$item_code = $_POST['ITEM_CODE'];
	
	/*DELETE yang ada di KJ*/
	
	$sql_delete_draft = "DELETE FROM kj_draft WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
    $hasil_delete_draft = mysqli_query($mysqli, $sql_delete_draft);
	
	/*input ke kj asli*/
	
	
	foreach($forecast as $isi=>$n){
	
		/*echo "forcastnya = ".$n."<br>";
		echo "item_code =".$item_code[$isi]."<br>";*/
		
		if($n != "") {
			date_default_timezone_set("Asia/Jakarta");
			$month = date('M');
			/*cari produk*/
			
			$sql_cari_produk_id = "SELECT ID,ITEM_CODE,NAMA_PRODUK,HARGA FROM m_produk WHERE ITEM_CODE = '$item_code[$isi]'";
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$id = $data_id['ID'];
			$nama_produk = $data_id['NAMA_PRODUK'];
			$harga = $data_id['HARGA'];
			
			
			$sql_kj = "INSERT INTO kj SET 
						TGL = '$tanggal',
				TRIWULAN = '$_SESSION[TRIWULAN]',
				BULAN_INPUT = '$month',
				NAMA_DIST = '$_SESSION[USER]',
				ID_PRODUK = '$id',
				NAMA_PRODUK = '$nama_produk',
				ITEM_CODE = '$item_code[$isi]',
				DAERAH     = '$_SESSION[KOTA]',
				HARGA = '$harga',
				BLN_AKHIR = '$bulan_akhir[$isi]',
				FORECAST = '$forecast[$isi]',
				PERSEN   = '$persen[$isi]',
				BULAN1   = '$bulan1[$isi]',
				BULAN2   = '$bulan2[$isi]',
				BULAN3   = '$bulan3[$isi]',
				TOTAL_VALUE    = '$total_value[$isi]',
				SET_BLN1 = 'ISI',
				ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
			
			//echo $sql_kj;
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
		}
	
	}
	
	//$id = $_POST['ID'];
//	$item_code = $_POST['ITEM_CODE'];
	
	//$jumlah_forcast = count($forecast);
	//echo "<h1>".$jumlah_forcast."</h1>";
	
	
	 if ($hasil_input_kj) {
		//echo "input Barhasil";
		echo "<script>alert('Input Barhasil');
					  window.location='dist.php';
			  </script>";
	   // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
	} else {
		//echo "input gagal";
		echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist.php';</script>";
	}
	
	
}





if(isset($_POST['DRAFT'])){
	
	//print_r($_POST);
	
	$bulan_akhir = $_POST['bln_akhir'];
	$forecast    = $_POST['FORECAST'];
	$persen      = $_POST['PERSEN'];
	$bulan1      = $_POST['BULAN1'];
	$bulan2      = $_POST['BULAN2'];
	$bulan3      = $_POST['BULAN3'];
	$total_value = $_POST['TOTAL_VALUE'];
	$item_code = $_POST['ITEM_CODE'];
	

	
     
	 $sql_cek = "SELECT * FROM kj_draft WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
	 $hasil = mysqli_query($mysqli, $sql_cek);
	 $row = mysqli_num_rows($hasil);
	// echo "<h1>".$row."</h1>";
	 if($row >= 1){
		 
	  /*Delete data yang lama terlebih dahulu*/
	  
	  $delete = "DELETE FROM kj_draft WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
	  $hasil_delete = mysqli_query($mysqli, $delete);
	  
	  /*baru input lagi data yang baru*/	 
		 
    foreach($forecast as $isi=>$n){
	
		
		if($n != "") {
				
			date_default_timezone_set("Asia/Jakarta");
			$month = date('M');
			/*cari produk*/
			
			$sql_cari_produk_id = "SELECT ID,ITEM_CODE,NAMA_PRODUK,HARGA FROM m_produk WHERE ITEM_CODE = '$item_code[$isi]'";
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$id = $data_id['ID'];
			$nama_produk = $data_id['NAMA_PRODUK'];
			$harga = $data_id['HARGA'];
			
			
			$sql_kj = "INSERT  kj_draft SET 
			           	TGL = '$tanggal',
				TRIWULAN = '$_SESSION[TRIWULAN]',
				BULAN_INPUT = '$month',
				NAMA_DIST = '$_SESSION[USER]',
				ID_PRODUK = '$id',
				NAMA_PRODUK = '$nama_produk',
				ITEM_CODE = '$item_code[$isi]',
				DAERAH     = '$_SESSION[KOTA]',
				HARGA = '$harga',
				BLN_AKHIR = '$bulan_akhir[$isi]',
				FORECAST = '$forecast[$isi]',
				PERSEN   = '$persen[$isi]',
				BULAN1   = '$bulan1[$isi]',
				BULAN2   = '$bulan2[$isi]',
				BULAN3   = '$bulan3[$isi]',
				TOTAL_VALUE   = '$total_value[$isi]',
				SET_BLN1 = 'ISI',
				ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
			
			//echo $sql_kj;
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
			
			//exit;
			
			if ($hasil_input_kj) {
		//echo "<b>SAVE DRAFT Barhasil</b>";
		echo "<script>alert('SAVE DRAFT Barhasil');
					  window.location='dist_forcast.php';
			  </script>";
	   // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
	       } else {
		
		//echo "<b>SAVE DRAFT  Gagal..!</b>";
		
		echo "<script>alert('SAVE DRAFT  Gagal..!, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";
		
	    }
			
			
		}
	
	} 
		 
		 
		 
	 }
	 if($row == 0){
		 	
	   $number = array("1","2","3","4","5","6","7","8","9","0");

       $huruf = array("A","B","C","D","E");
       shuffle($number);
       shuffle($huruf);
       $rid =  $huruf[0].$number[0].$number[1].$number[2].$number[3].$number[4];

	foreach($forecast as $isi=>$n){
	
		/*echo "forcastnya = ".$n."<br>";
		echo "item_code =".$item_code[$isi]."<br>";*/
		
		if($n != "") {
			date_default_timezone_set("Asia/Jakarta");
			$month = date('M');
			/*cari produk*/
			
			$sql_cari_produk_id = "SELECT ID,ITEM_CODE,NAMA_PRODUK,HARGA FROM m_produk WHERE ITEM_CODE = '$item_code[$isi]'";
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$id = $data_id['ID'];
			$nama_produk = $data_id['NAMA_PRODUK'];
			$harga = $data_id['HARGA'];
			
			
			$sql_kj = "INSERT INTO kj_draft SET 
			             RID = '$rid',
						TGL = '$tanggal',
				TRIWULAN = '$_SESSION[TRIWULAN]',
				BULAN_INPUT = '$month',
				NAMA_DIST = '$_SESSION[USER]',
				ID_PRODUK = '$id',
				NAMA_PRODUK = '$nama_produk',
				ITEM_CODE = '$item_code[$isi]',
				DAERAH     = '$_SESSION[KOTA]',
				HARGA = '$harga',
				BLN_AKHIR = '$bulan_akhir[$isi]',
				FORECAST = '$forecast[$isi]',
				PERSEN   = '$persen[$isi]',
				BULAN1   = '$bulan1[$isi]',
				BULAN2   = '$bulan2[$isi]',
				BULAN3   = '$bulan3[$isi]',
				TOTAL_VALUE    = '$total_value[$isi]',
				SET_BLN1 = 'ISI',
				ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
			
			//echo $sql_kj;
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
		}
	
	}
	

	 if ($hasil_input_kj) {
		//echo "<b>SAVE DRAFT Barhasil</b>";
		echo "<script>alert('SAVE DRAFT Barhasil');
					  window.location='dist_forcast.php';
			  </script>";
	   // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
	   } else {
		
		//echo "<b>SAVE DRAFT  Gagal..!</b>";
		
		echo "<script>alert('SAVE DRAFT  Gagal..!, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";
		
	  }

		 
		 
	 }
	 
	 
	 	
	
	
}






?>