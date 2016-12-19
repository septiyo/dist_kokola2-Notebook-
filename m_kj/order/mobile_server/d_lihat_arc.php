<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
    $id_order=$_GET['id'];
    $acid=$id_order;
   
   $sqlsel = "SELECT aa.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, aa.NAMA_PRODUK FROM(
			SELECT k.ITEM_CODE,(
					CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
						THEN BULAN3 
					ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
				INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
					WHERE k.ACCOUNT_ID ='". $acid ."' 
					AND k.TRIWULAN = (
						CASE WHEN MONTH(CURDATE()) = '1'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '2'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '3'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '4'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '5'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '6'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '7'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '8'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '9'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '10'
							THEN 'Oct-Nov-Dec'
							WHEN MONTH(CURDATE()) = '11'
							THEN 'Oct-Nov-Dec'
							WHEN MONTH(CURDATE()) = '12'
							THEN 'Oct-Nov-Dec'
							ELSE ''
							END)
					GROUP BY k.ITEM_CODE) aa
		 LEFT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
				INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
					WHERE ok.ACCOUNT_ID = '". $acid ."' 
					AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
					AND ok.periode2 = CURDATE() 
					AND flag = 1
					GROUP BY ok.item_code) bb
		ON aa.ITEM_CODE = bb.item_code
		UNION
		SELECT bb.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, bb.NAMA_PRODUK FROM(
			SELECT k.ITEM_CODE,(
					CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
						THEN BULAN3 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
						THEN BULAN1 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
						THEN BULAN2 
					WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
						THEN BULAN3 
					ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
				INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
					WHERE k.ACCOUNT_ID ='". $acid ."' 
					AND k.TRIWULAN = (
						CASE WHEN MONTH(CURDATE()) = '1'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '2'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '3'
							THEN 'Jan-Feb-Mar'
							WHEN MONTH(CURDATE()) = '4'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '5'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '6'
							THEN 'Apr-May-Jun'
							WHEN MONTH(CURDATE()) = '7'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '8'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '9'
							THEN 'Jul-Aug-Sep'
							WHEN MONTH(CURDATE()) = '10'
							THEN 'Oct-Nov-Dec'
							WHEN MONTH(CURDATE()) = '11'
							THEN 'Oct-Nov-Dec'
							WHEN MONTH(CURDATE()) = '12'
							THEN 'Oct-Nov-Dec'
							ELSE ''
							END)
					GROUP BY k.ITEM_CODE) aa
		 RIGHT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
				INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
					WHERE ok.ACCOUNT_ID = '". $acid ."' 
					AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
					AND ok.periode2 = CURDATE() 
					AND flag = 1
					GROUP BY ok.item_code) bb
		ON aa.ITEM_CODE = bb.item_code;";
		
$ressel = mysql_query($sqlsel) or die("Note: " . mysql_error());

$data = array();
$nmm=0;
$tot_kj=0;
$tot_real=0;
while($row = mysql_fetch_array($ressel)){
	
	$icod = $row['ITEM_CODE'];
	$kjbi = $row['KJ_BULAN_INI'];
	$kibi = $row['KIRIM_BULAN_INI'];
	$nama = $row['NAMA_PRODUK'];
	
	$data[$nmm][0]=$row['NAMA_PRODUK'];
	
	
	
	if($kjbi == null || $kjbi == ""){
		$kjbi = 0;
	}
	if($kibi == null || $kibi == ""){
		$kibi = 0;
	}
	
	
	$data[$nmm][1]=$kjbi;
	$data[$nmm][2]=$kibi;
	$tot_kj+=$kjbi;
	$tot_real+=$kibi;
	
	$sisa=$kjbi-$kibi;
	if($sisa<0){
		$sisa=0;
	}
	
	$data[$nmm][3]=$sisa;
	
	
	/*
	$data[] = array(
		'ITEM_CODE' => $icod,
        'KJ_BULAN_INI' => $kjbi,
        'KIRIM_BULAN_INI' => $kibi,
        'NAMA_PRODUK' => $nama
    );
	*/
	
	
	
$nmm++;
	}
   
   
   
 
   //echo $view_isi.$view;

   $kirim = array('data' => $data,
                  't_kj'=>$tot_kj,
                  't_real'=>$tot_real
             
       );
        header('Content-type: application/json');
        echo json_encode($kirim);

   
            }
?>



