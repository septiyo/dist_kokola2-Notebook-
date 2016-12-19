<?php
header('Content-Type: application/json');
include "../koneksi.php";
ini_set('display_errors','0');


//echo json_encode('dari sana');


  //$sono = $_GET['DATA'];
  
  $bulan = $_GET['bulan'];
  $acc   = $_GET['acc'];
  
 /*  echo json_encode($sono);
  exit; */


   $sql = "SELECT m_produk.NAMA_PRODUK,
       m_produk.ITEM_CODE,
       m_produk.KATEGORI,
       
       SUM(kj.BULAN1)AS BULAN1,
       SUM(kj.BULAN2)AS BULAN2,
       SUM(kj.BULAN3)AS BULAN3
       
       FROM kj
       INNER JOIN m_produk
       ON m_produk.ITEM_CODE=kj.ITEM_CODE
       
       
       WHERE MONTH(kj.TGL) = '".$bulan."' 
       AND kj.ACCOUNT_ID = '".$acc."'
       GROUP BY m_produk.KATEGORI;";
	   
	   
	   $hasil = mysqli_query($mysqli, $sql);
	   
	   
	
	   
	   
	   
	   
	   //$data = mysqli_fetch_assoc($hasil);
	   
	   foreach($hasil as $row){
		   
		   $jos[] = array(
		          
		              'KATEGORI' => $row[KATEGORI],
		              'BULAN1' => $row[BULAN1],
		              'BULAN2' => $row[BULAN2],
		              'BULAN3' => $row[BULAN3]
		   
					);
		   
	   };
	   
	   echo json_encode($jos);

	   
	   







?>