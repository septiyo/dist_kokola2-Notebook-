<?php 
include "koneksi.php";
include "bantuan.class.php";
error_reporting(0);
$bantuan = new bantuan();
$tanggal = $bantuan->tgl_indo("datetime");

	/*DELETE yang ada di KJ*/
	
	$sql_delete_draft = "DELETE FROM kj_draft_f WHERE ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
    $hasil_delete_draft = mysqli_query($mysqli, $sql_delete_draft);

	 $data = $_POST['q']; 
	 
	 
	 if($_SESSION['TRIWULAN'] == ""){
		 
		 echo "input gagal";
	 
	 }
	 

foreach($data as $item){
	
	
	$month = date('M');
	$sql_cari_produk_id = "SELECT item_code,item_name FROM push_item WHERE item_code = '".$item['item_code']."'";
         
		 //echo $sql_cari_produk_id;
       	
			$hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
			$data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
			$nama_produk = $data_id['item_name'];
		
            if($item['FORECAST'] != ""){

		
			$sql_kj = "INSERT INTO kj_f SET 
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
	
	
}

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


?>