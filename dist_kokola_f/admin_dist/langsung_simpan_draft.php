<?php   
session_start();
error_reporting(0);
include "koneksi.php";
include "bantuan.class.php";
$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

	   $number = array("1","2","3","4","5","6","7","8","9","0");

       $huruf = array("A","B","C","D","E");
       shuffle($number);
       shuffle($huruf);
       $rid =  $huruf[0].$number[0].$number[1].$number[2].$number[3].$number[4];

$acon_id = $_POST[ACON_ID];

     
	 $sql_cek = "SELECT * FROM kj_draft_f WHERE ACCOUNT_ID = 'acon_id'";
	 $hasil = mysqli_query($mysqli, $sql_cek);
	 $row = mysqli_num_rows($hasil);
	 //echo "<h1>".$row."</h1>";
	 
	 
	 
	 	 
	 if($row == 0){
		 
	  /*Delete data yang lama terlebih dahulu*/
	  
	 // $delete = "DELETE FROM kj_draft WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
	 // $hasil_delete = mysqli_query($mysqli, $delete);

	 $data = $_POST['q']; 
	 
	 
	 /* if($_SESSION['TRIWULAN'] == ""){
		 
		 echo "input gagal";
	 
	 }*/
	 
	 foreach($data as $item){
		 
		 $month = date('M');
	     $sql_cari_produk_id = "SELECT item_code,item_name FROM push_item WHERE item_code = '".$item['item_code']."'";
         
		// echo $sql_cari_produk_id;
       	  //exit;
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$nama_produk = $data_id['item_name'];
		 
		 if($item['FORECAST'] != ""){
		 
		 //TRIWULAN = '$_SESSION[TRIWULAN]',
		 
		 $sql_kj = "INSERT INTO kj_draft_f SET 
		              RID = '$rid',
						TGL = '$tanggal',
						TARGET = '".$item['TARGET']."',
						TRIWULAN = '$_SESSION[TRIWULAN]',
				BULAN_INPUT = '$month',
				NAMA_DIST = '$_SESSION[USER]',
				ID_PRODUK = '$id',
				NAMA_PRODUK = '$nama_produk',
				ITEM_CODE = '".$item['item_code']."',
		     	ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
				
				echo $sql_kj;
				
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
		 		 
		 }
		 
		 
	 }//end foreach
	 
	 
	 if ($hasil_input_kj) {
		//echo "sukses";
		/*echo "<script>alert('Input Barhasil');
					  window.location='dist.php';
			  </script>";*/
	   //header("Location: dist.php");
	} else {
		//echo "input gagal";
		//echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist.php';</script>";
	}
	 
	 
	 }//end if
	 
	 
	 
	 
	 
	  if($row >= 1){
		 
		 
	  /*Delete data yang lama terlebih dahulu*/
	  
	 $delete = "DELETE FROM kj_draft_f WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
	 $hasil_delete = mysqli_query($mysqli, $delete);

	 $data = $_POST['q']; 
	 
	 foreach($data as $item){
		 
		 $month = date('M');
	     $sql_cari_produk_id = "SELECT item_code,item_name FROM push_item WHERE item_code = '".$item['item_code']."'";
         
		// echo $sql_cari_produk_id;
       	  //exit;
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$nama_produk = $data_id['item_name'];
		 
		 if($item['FORECAST'] != ""){
		 
		 $sql_kj = "INSERT INTO kj_draft_f SET 
		            RID = '$rid',
						TGL = '$tanggal',
				TRIWULAN = '$_SESSION[TRIWULAN]',
				BULAN_INPUT = '$month',
				NAMA_DIST = '$_SESSION[USER]',
				ID_PRODUK = '$id',
				NAMA_PRODUK = '$nama_produk',
				ITEM_CODE = '".$item['item_code']."',
				DAERAH     = '$_SESSION[KOTA]',
				HARGA = '$harga',
				BLN_AKHIR = '".$item['bln_akhir']."',
				FORECAST = '".$item['FORECAST']."',
				PERSEN   = '".$item['PERSEN']."',
				BULAN1   = '".$item['BULAN1']."',
				BULAN2   = '".$item['BULAN2']."',
				BULAN3   = '".$item['BULAN3']."',
				TOTAL_VALUE    = '$total_value[$isi]',
				SET_BLN1 = 'ISI',
				ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
				//echo $sql_kj;
			$hasil_input_kj = mysqli_query($mysqli, $sql_kj);
		 		 
		 }
		 
		 
	 }//end foreach
	 
	 
	 if ($hasil_input_kj) {
		echo "sukses";
		/*echo "<script>alert('Input Barhasil');
					  window.location='dist.php';
			  </script>";*/
	   //header("Location: dist.php");
	} else {
		echo "input gagal";
		//echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist.php';</script>";
	}
	 
	 
	 }//end if
	 
	 
	 

?>