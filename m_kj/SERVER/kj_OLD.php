<?php
include "../koneksi.php";
error_reporting(0);
	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));




$ACC = $_GET['id'];

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
                                                
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%')";

$hasil = mysqli_query($mysqli, $sql);

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
	
	
	
	 $results[] = array(
	      'ITEM_NAME'=> $row['NAMA_PRODUK'],
		  'ITEM_CODE'=> $row['ITEM_CODE'],
		  'LAST_3MON'=> $total_last_month
	 );
}

$json = json_encode($results);

echo $json;												 												 																							

?>