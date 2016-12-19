<?php 
include "koneksi.php";
include "bantuan.class.php";
error_reporting(0);
ini_set('display_errors', 0);
ini_set('max_execution_time', 600);
//ini_set('memory_limit', '2000M');
$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

	/*DELETE yang ada di KJ*/
	
	$sql_delete_draft = "DELETE FROM kj_draft WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
    $hasil_delete_draft = mysqli_query($mysqli, $sql_delete_draft);

	 $data = $_POST['q']; 
	 
	 
	 /*if($_SESSION['TRIWULAN'] == ""){
		 
		 echo "input gagal";
	 
	 }*/
	 //create ID_KJ
	 $today_database = date('Y').date('m').date('d');
	 /* $Cari_id_terakhir = "SELECT RIGHT(ID_KJ , 4)as id_kj FROM kj ORDER BY ID_KJ DESC LIMIT 1";
	 $hasil_cari = mysqli_query($mysqli, $Cari_id_terakhir);
	 $data_cari = mysqli_fetch_assoc($hasil_cari);
	 $id_kj_last = $data_cari[id_kj];
	 
     if($id_kj_last == ""){
		 
		 $last_id = '0001';
	 }
	 else{
		 
		 $last_id = $last_id + 1;
		 
	 } */
	 
	 $number = array("1","2","3","4","5","6","7","8","9","0");
	 shuffle($number);
	 $ridd = $number[0].$number[1].$number[2];
	 
	 $id_kj = "KJ-".$today_database.$ridd;
	 
	      
	 $tahun_now = date('Y');
	 $triwulanx = $_POST['TRIX']; //ini triwulan hasil inputan
	 
	 /*cek triwulan ini tahun ini apa sudah ada di database*/
	 
/*  	 $sql_cek_jos = "SELECT TRIWULAN, MAX(ID), TGL FROM kj WHERE `ACCOUNT_ID` = '$_SESSION[ACCOUNT_ID]' 
                      AND YEAR(TGL) = '$tahun_now' AND `publish` = '1' AND TRIWULAN = '$triwulanx'";
						
			

	 $hasil_cek_jos = mysqli_query($mysqli, $sql_cek_jos);
	 
	 $row_jos = mysqli_num_rows($hasil_cek_jos);
	 
	 if($row_jos >= 1){
		 
		  /* echo "<script>alert('Anda sudah membuat KJ Triwulan tersebut,.. anda bisa Melakukan REvisi..!');
		                  window.location='dist.php';
		       </script>";  
			   
			//echo "<script>alert('KJ Triwulan ini sudah pernah dibuat');window.location='dist.php';</script>";   
		 
	 }  */
	 
	 
	 
	 
 foreach($data as $item){
	
	
	$month = date('M');
	$sql_cari_produk_id = "SELECT item_code,item_name FROM push_item WHERE item_code = '".$item['item_code']."'";
         
		 //echo $sql_cari_produk_id;
       	
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$nama_produk = $data_id['item_name'];
		
            if($item['FORECAST'] != ""){
				
				if($triwulanx != ""){

		
			$sql_kj = "INSERT INTO kj SET 
			            ID_KJ = '$id_kj',
						TGL = '$tanggal',
				TRIWULAN = '$triwulanx',
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
			}
	
}//end foreach 
 //gc_collect_cycles();
 
    if($hasil_input_kj){

	    $response_array['status'] = 'sukses'; 
    }
    else{

		 $response_array['status'] = 'gagal'; 
    }

echo json_encode($response_array);




?>