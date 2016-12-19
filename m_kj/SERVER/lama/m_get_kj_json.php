<?php

include "../koneksi.php";

	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -3 month'));

        
$nama_group = array("Majestic Wafer", "Kukis Series", "Malkist","Cream Series","Lain-lain");

$arr[] = array("nama_label"=>"Majestic Wafer",
        "nama_db"=>"majestic");
$arr[] = array("nama_label"=>"Kukis Series",
        "nama_db"=>"kukis");
$arr[] = array("nama_label"=>"Malkist",
        "nama_db"=>"malkist");
$arr[] = array("nama_label"=>"Cream Series",
        "nama_db"=>"cream");



if(isset($_GET['id'])){
 
$ACC = $_GET['id'];

$index_baris=0;
$mw=array();
$ks=array();
$mt=array();
$cs=array();

foreach ($arr as $tes1){
$sql = "SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '$ACC' 
                                                 AND m_produk.NAMA_PRODUK LIKE '%".$tes1['nama_db']."%'
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%')";

$hasil = mysqli_query($mysqli, $sql);

//$nomer++;

$index_isi=0;
foreach($hasil as $row){
    
	/*untuk cari forecast----$_SESSION[ACCOUNT_ID]*/
	
	$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim 
				        WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                		AND FLAG = 1  AND item_code = '$row[ITEM_CODE]' 
                        AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND 
						ACCOUNT_ID = '$ACC'";			 									   
							
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];	
						if (is_null($total_last_month)) {
							$total_last_month = "";
						}
                    if($index_baris==0){                            
                     $mw[$index_isi][0]=$row['NAMA_PRODUK'];    
                     $mw[$index_isi][1]=$total_last_month; 
                     $mw[$index_isi][2]=$row['ITEM_CODE']; 
                    }if($index_baris==1){
                      $ks[$index_isi][0]=$row['NAMA_PRODUK'];    
                     $ks[$index_isi][1]=$total_last_month; 
                     $ks[$index_isi][2]=$row['ITEM_CODE']; 
                    }if($index_baris==2){
                      $mt[$index_isi][0]=$row['NAMA_PRODUK'];    
                     $mt[$index_isi][1]=$total_last_month; 
                     $mt[$index_isi][2]=$row['ITEM_CODE']; 
                    }if($index_baris==3){
                      $cs[$index_isi][0]=$row['NAMA_PRODUK'];    
                     $cs[$index_isi][1]=$total_last_month; 
                     $cs[$index_isi][2]=$row['ITEM_CODE']; 
                    }                           
                  $index_isi++;  
                                                
	

//echo $index_baris;
//end perulangan kolom        
}

$index_baris++;	
//end perulang baris
}

$sql = "SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '$ACC' 
                                                 AND m_produk.NAMA_PRODUK NOT LIKE '%CREAM%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%MAJESTIC%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%KUKIS%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%MALKIST%'
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%')";

$hasil = mysqli_query($mysqli, $sql);

$b_isilain=array();

$baris=0;
foreach($hasil as $row){
	
	/*untuk cari forecast----$_SESSION[ACCOUNT_ID]*/
	
	$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim 
				        WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                		AND FLAG = 1  AND item_code = '$row[ITEM_CODE]' 
                        AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND 
						ACCOUNT_ID = '$ACC'";			 									   
							
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];	
						if (is_null($total_last_month)) {
							$total_last_month = "";
						}
                                                
                     $b_isilain[$baris][0]=$row['NAMA_PRODUK'];    
                     $b_isilain[$baris][1]=$total_last_month; 
                     $b_isilain[$baris][2]=$row['ITEM_CODE']; 
                   
                    
                     
                     
	
        $baris++;
 //akhir       
}


$arr[] = array("nama_label"=>"Lain-lain",
        "nama_db"=>"Lain-lain");

$kirim = array('group' => $nama_group,
               'lain2'=> $b_isilain,
               'mw'=>$mw,
               'ks'=>$ks,
               'mt'=>$mt,
               'cs'=>$cs);
        header('Content-type: application/json');
        echo json_encode($kirim);

//echo $isi;												 												 



}

?>
