<?php
ini_set('display_errors', '0');

include "../../koneksi.php";

//$str  = array();

//$strx = parse_str($_POST, $str);

$data = $_POST['STR'];
$ACC = $_POST['ACC'];
$SBG = $_POST['SBG'];
$CATATAN2 = $_POST['CATATAN2'];
$ID_ORDER = $_POST['ID_ORDER'];
$tgl_order = $_POST['TGL_ORDER'];


 //echo json_encode($data);



//echo json_encode($data);

		
	//date_default_timezone_set("Asia/Jakarta");
	$today          = date('d')."-".date('m')."-".date('Y');
	$today_database = date('Y')."-".date('m')."-".date('d');
	$time = date('H:i:s');
	
	
	
	
	//print_r($str);
	//exit;
	
	
	$jos = $str['JOS']; 
	
	//echo "<h1>".$jos."</h1>";
	/*$qty_confirm  = $str['QTY_CONFIRM'];//jml_order
	$account_idne = $str['ACC'];
	$userid       = $str['USERID'];
	$item_code    = $str['ITEM_CODE'];
	$sbg          = $str['SBG'];
    $catatan2     = $str['CATATAN2'];	*/
	
	$qty_confirm  = $data['QTY_CONFIRM'];//jml_order
	$account_idne = $data['ACC'];
	//$userid       = $str['USERID'];
	$item_code    = $data['ITEM_CODE'];
	//$sbg          = $str['SBG'];
    //$catatan2     = $str['CATATAN2'];	
	
	//$jumlah_qty   = count($item_code);
	//echo "<h1>".$jumlah_qty."</h1>";
	//exit;

	$kubikasi             = $data['KUBIKASI'];
	$kubikasi_olahan      = $data['KUBIKASI_OLAHAN'];
	
	
	
	
	/*$id_order      = $str['ID_ORDER'];
	$tgl_order     = $str['TGL_ORDER'];
	$id_produk     = $str['ID_PRODUK'];*/
        
		
		//echo json_encode($id_produk);
		
	/*buat rid*/	
		
	   $number = array("1","2","3","4","5","6","7","8","9","0");

       $huruf = array("A","B","C","D","E");
       shuffle($number);
       shuffle($huruf);
       $rid =  $number[0].$number[1].$number[2];
	   
	   $RIDNYAR = "OC-".date('Y').date('m').date('d').$rid;

	/*foreach ($qty as $bacadata2){	
	}*/
	
	//if($jos == "1"){
		
	   $n=0;
	   $id_con = "";
   	//while($n < $jumlah_qty ){
	 foreach($data as $itemx){	
		if(($itemx['QTY_CONFIRM'] != "") && ($itemx['QTY_CONFIRM'] != "0")) {
			if($itemx['KUBIKASI_OLAHAN'] == ""){
				$kubikasi_fix =  $itemx['KUBIKASI'];
			}
			else {
				$kubikasi_fix =  $itemx['KUBIKASI_OLAHAN'];
			}
					
		$insert_confirm = "INSERT INTO order_confirm 
			    SET ID_ORDER = '".$ID_ORDER."',
				ID_CONFIRM = '".$RIDNYAR."',
				TGL_ORDER = '".$tgl_order."',
				ACCOUNT_ID = '".$ACC."',
				ID_PRODUK = 'xxxx',
				ITEM_CODE = '".$itemx['ITEM_CODE']."',
				JML_ORDER = '".$itemx['QTY_CONFIRM']."',
				KUBIKASI = '".$kubikasi_fix."',
				TGL_CONFIRM = '$today_database $time',
				FLAG2 = '3',
				SBG = '".$SBG."',
				CATATAN2 = '".$CATATAN2."'";
				
				//echo json_encode($insert_confirm);
				//exit;
						
				$hasil_confirm = mysqli_query($mysqli, $insert_confirm);
				
				
				
					
			/*Update flag order_kirim_wd flag yang sudah diorderkan*/

/*			$update_kirim_wd = "UPDATE order_kirim_wd SET flag = '3' WHERE item_code = '$item_code[$n]' AND qty = '$qty[$n]'";

			$hasil_update_wd = mysqli_query($mysqli, $update_kirim_wd);
			
	      
			$cari_sisa_kj = "SELECT qty,item_code
                            FROM order_kirim_wd
                            WHERE flag = '1'
                             AND ACCOUNT_ID= '$account_idne'
                            AND periode2 <= '$today_database'";
							
							
							   
            $hasil_sisa_kj = mysqli_query($mysqli, $cari_sisa_kj);	
              $data_sisa = mysqli_fetch_assoc($hasil_sisa_kj);
			  
			  $qty_sisa = $data_sisa['qty'];
              $item_sisa = $data_sisa['item_code'];
			  
		*/
			  

 	/*Update status jadi sisa order_kirim_wd*/		  
	
/*	 $update_flag_sisa = "UPDATE order_kirim_wd SET flag = '6' WHERE item_code = '$item_sisa'
	                       AND qty = '$qty_sisa'";
						   
		$hasil_update_sisa  = mysqli_query($mysqli, $update_flag_sisa);
		
	
		*/
      	}
		//$n++;
		
   }
   
   	  
   
   $sql_ubah_distributor = "UPDATE order_distributor SET  FLAG = '3' WHERE ID_ORDER = '$ID_ORDER'";
   
   //echo json_encode($sql_ubah_distributor);

   $hasil_ubah = mysqli_query($mysqli, $sql_ubah_distributor);
   
	//}

   
    if($hasil_ubah){

	    $response_array['status'] = 'sukses'; 
    }
    else{

		 $response_array['status'] = 'gagal'; 
    }

echo json_encode($response_array);






?>