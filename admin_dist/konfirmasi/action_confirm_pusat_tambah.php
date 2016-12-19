<?php
ini_set('display_errors', '0');

include "../../koneksi.php";


$data  = $_POST['STR'];
$data2 = $_POST['STR2'];

//echo json_encode($data);
//echo json_encode($data2);


$ACC = $_POST['ACC'];
$SBG = $_POST['SBG'];
$CATATAN2 = $_POST['CATATAN2'];
$ID_ORDER = $_POST['ID_ORDER'];
$tgl_order = $_POST['TGL_ORDER'];


//echo json_encode("okelah");
//exit;

//date_default_timezone_set("Asia/Jakarta");	
	
	//print_r($_POST);
	$today          = date('d')."-".date('m')."-".date('Y');
	//$today_database = date('Y')."-".date('m')."-".date('d');
	$today_database = date('Y-m-d H:i:s');
	$time = date('H:i:s');
	
	
	$number = array("1","2","3","4","5","6","7","8","9","0");

       $huruf = array("A","B","C","D","E");
       shuffle($number);
      //shuffle($huruf);
       //$rid =  $huruf[0].$number[0].$number[1].$number[2].$number[3].$number[4];
	   
	          $rid =  $number[0].$number[1].$number[2];
	   
	   $RIDNYAR = "OC-".date('Y').date('m').date('d').$rid;
	
	
	/*ini iset tambahan order*/
	
	
	//$account_idne = $_POST['ACC'];
	//$item_code_tambah_order  = $data2['ITEM_CODE_TAMBAH_ORDER'];
/*	$item_code_tambah_order  = $data2['ITEM_CODE2'];
    $kubikasi_tambah_order   = $data2['KUBIKASI_TAMBAH_ORDER'];
	$qty_tambah_order        = $data2['QTY_TAMBAH_ORDER'];*/
	//$jumlah_qty_tambah_order   = count($qty_tambah_order);
	//$id_orderx  =   $_POST['ID_ORDERX'];
	//$sbg       = $_POST['SBG'];
    //$catatan2  = $_POST['CATATAN2'];	
	
	$i=0;
	/*while($i < $jumlah_qty_tambah_order){*/
	foreach($data2 as $item2){
		
		if(($item2['QTY_TAMBAH_ORDER'] != "") && ($item2['QTY_TAMBAH_ORDER'] != "0")){
		
			/*input data tambahan ke order_confirm*/			
		$insert_confirm_tambah = "INSERT INTO order_confirm 
			    SET ID_ORDER = '".$ID_ORDER."',
				ID_CONFIRM = '".$RIDNYAR."',
				TGL_ORDER = '".$tgl_order."',
				ACCOUNT_ID = '".$ACC."',
				ID_PRODUK = '".$item2['ITEM_CODE2']."',
				ITEM_CODE = '".$item2['ITEM_CODE2']."',
				JML_ORDER = '".$item2['QTY_TAMBAH_ORDER']."',
				KUBIKASI =  '".$item2['KUBIKASI_TAMBAH_ORDER']."',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '3',
				CATATAN2 = '".$CATATAN2."',
				SBG = '".$SBG."';";
				
				$hasil_confirm_tambah = mysqli_query($mysqli, $insert_confirm_tambah);
				
				
				
			/*input data tambahan ke order_detail*/
			
			$insert_detail_tambah = "INSERT INTO order_detail
			     SET ID_ORDER = '".$ID_ORDER."',
		            ID_PRODUK = '".$item2['ITEM_CODE2']."',
		    	     JML_ORDER = '".$item2['QTY_TAMBAH_ORDER']."',
			         ITEM_CODE = '".$item2['ITEM_CODE2']."',					 
					 KUBIKASI = '".$item2['KUBIKASI_TAMBAH_ORDER']."',
					     FLAG = '3',
					      STS = 'NOKJ'";
						  
			  $hasil_detail_tambah = mysqli_query($mysqli, $insert_detail_tambah);
			  
			  //echo $insert_detail_tambah;
		}//end if
			//$i++;				  
				
					//echo json_encode($insert_confirm_tambah);
				
	} //end foreach
	

				 
				 
		     /****ojo dihapus penting*****/		 
				 $id_akhir = $id_orderx;
	    	  /****ojo dihapus penting*****/		 
				 
				 /*$sql_order = "INSERT INTO order_distributor SET  ID_ORDER = '$id_akhir',
				 TGL = '$today_database',
				 USERID = '$userid',
				 ACCOUNT_ID = '$account_idne',
				 FLAG = '3'";
	
	             $hasil_order = mysqli_query($mysqli, $sql_order);	*/
	
	
	/*udpate flag order_distributor yang lama*/
		
    
	//$id_order_akhirx = $id_akhir - 1;
	

    $sql_update_dist = "UPDATE order_distributor SET FLAG = '3' WHERE ID_ORDER = '$ID_ORDER'";//echo 
	  
	  //echo json_encode($sql_update_dist);
	
	$hasil_update_dist = mysqli_query($mysqli, $sql_update_dist);
	
	$sql_update_detail = "UPDATE order_detail SET FLAG = '3' WHERE ID_ORDER = '$ID_ORDER'";
	
	$hasil_update_detail = mysqli_query($mysqli, $sql_update_detail);
	
	
	
	/*ini isset dari atas yang sudah order*/
	
	$qty_confirm  = $_POST['QTY_CONFIRM'];//jml_order
	$account_idne = $_POST['ACC'];
	$userid       = $_POST['USERID'];
	$item_code    = $_POST['ITEM_CODE'];
	
	//$jumlah_qty_confirm   = count($qty_confirm);
	
	
	$kubikasi_olahan      = $_POST['KUBIKASI_OLAHAN'];
	$kubikasi_database    = $_POST['KUBIKASI_DATABASE'];
	$id_order      = $_POST['ID_ORDER'];
	$tgl_order     = $_POST['TGL_ORDER'];
	$id_produk     = $_POST['ID_PRODUK'];
	
	
       $n=0;
	   $id_con = "";
   	//while($n < $jumlah_qty_confirm){
	foreach($data as $item){	
		if(($item['QTY_CONFIRM'] != "") && ($item['QTY_CONFIRM'] != "0")) {
			
			if($item['KUBIKASI_OLAHAN'] == ""){
				$kubikasi_fix =  $item['KUBIKASI'];
			}
			else {
				$kubikasi_fix =  $item['KUBIKASI_OLAHAN'];
			}
			//echo $kubikasi_fix[$n]."<br>";
			//exit;
						
					$insert_confirm = "INSERT INTO order_confirm 
			    SET ID_ORDER = '".$ID_ORDER."',
				ID_CONFIRM = '".$RIDNYAR."',
				TGL_ORDER = '".$tgl_order."',
				ACCOUNT_ID = '".$ACC."',
				ID_PRODUK = '".$item['ITEM_CODE']."',
				ITEM_CODE = '".$item['ITEM_CODE']."',
				JML_ORDER = '".$item['QTY_CONFIRM']."',
				KUBIKASI = '".$kubikasi_fix."',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '3',
				CATATAN2 = '".$CATATAN2."',
				SBG = '".$SBG."'";
				
				//echo $insert_confirm;
				
				$hasil_confirm = mysqli_query($mysqli, $insert_confirm);
				
		
					
			/*Update flag order_kirim_wd flag yang sudah diorderkan*/

	/*		$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '3' WHERE item_code = '$item_code[$n]' AND qty = '$qty[$n]'";

			$hasil_update_wd = mysqli_query($mysqli, $update_kirim_wd);
			
	
			$cari_sisa_kj = "SELECT qty,item_code
                            FROM order_kirim_wd
                            WHERE flag = '1'
                             AND ACCOUNT_ID= '$account_idne'
                            AND periode2 <= '$today_database'";
							
							
							   
            $hasil_sisa_kj = mysqli_query($mysqli, $cari_sisa_kj);	
              $data_sisa = mysqli_fetch_assoc($hasil_sisa_kj);
			  
			  $qty_sisa = $data_sisa[qty];
              $item_sisa = $data_sisa[item_code];*/
			  
			//  echo $cari_sisa_kj;
			  
			  

 	/*Update status jadi sisa order_kirim_wd*/		  
	
	/* $update_flag_sisa = "UPDATE order_kirim_wd SET flag = '6' WHERE item_code = '$item_sisa'
	                       AND qty = '$qty_sisa'";
						   
		$hasil_update_sisa  = mysqli_query($mysqli, $update_flag_sisa);*/
		
		//echo $update_flag_sisa;
		
		//exit;

		}
		//$n++;
    }
	
	
	
	
	    if($hasil_confirm){
	
			$response_array['status'] = 'sukses'; 
		}
		else{
	
			 $response_array['status'] = 'gagal'; 
		}
	
	echo json_encode($response_array);

	
	
	
/*	if($hasil_confirm){
		echo $accoun."<br />";
		echo $namaa."<br />";
		echo $userid."<br />";
		echo "<script>alert('Tambah Order Berhasil + Konfirmasi berhasil..!');
					  //window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
					  window.location='konfirmasi_order.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
					  </script>";	
	}
	else{
		
		echo "<script>alert('Tambah Order Gagal..!');
		  //window.location='detail_konfirmasi.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
		  window.location='konfirmasi_order.php?ID=$account_idne&NAMA=$namaa&KOTA=$kota&USERID=$userid';
		  </script>";	
	}*/




?>