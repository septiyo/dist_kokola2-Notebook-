<?php

include "../koneksi.php";


if(isset($_GET['id'])){
    $id=$_GET['id'];
    $tri=$_GET['tri'];
   
     //$sql_cari_isi = "SELECT * FROM kj WHERE TRIWULAN = '".$tri."' AND NAMA_DIST= '".$id."' AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y')";
     $sql_cari_isi = "SELECT a.*,b.NAMA_PRODUK AS NMA_PRODUK2 
						FROM kj a 
						LEFT JOIN m_produk b ON a.ITEM_CODE = b.ITEM_CODE 
						WHERE a.TRIWULAN = '".$tri."' AND a.NAMA_DIST= '".$id."' AND STR_TO_DATE(a.TGL, '%Y')=STR_TO_DATE(NOW(), '%Y') and a.publish='1'";
     $hasil = mysqli_query($mysqli, $sql_cari_isi);
$data=array();
$brs=0;
foreach($hasil as $row){
    $data[$brs][0]=$row['ID'];
    //$data[$brs][1]=$row['NAMA_PRODUK'];
	$data[$brs][1]=$row['NMA_PRODUK2'];
    $data[$brs][2]=$row['BLN_AKHIR'];
    $data[$brs][3]=$row['PERSEN'];
    $data[$brs][4]=$row['BULAN1'];
    $data[$brs][5]=$row['BULAN2'];
    $data[$brs][6]=$row['BULAN3'];
     $data[$brs][7]=$row['FORECAST'];
    $brs++;
}

$aturan=array();
$hari_ini=date('d');
$bulan_ini=date('m');

if((($bulan_ini%3)==1) && ($hari_ini<=25)){
        $aturan[0]=0;
        $aturan[1]=0;             
}else if((($bulan_ini%3)==1) && ($hari_ini>25)){
    $aturan[0]=1;
    $aturan[1]=0;  
}else if((($bulan_ini%3)==2) && ($hari_ini<=25)){
    $aturan[0]=1;
    $aturan[1]=0;  
}else{
     $aturan[0]=1;
    $aturan[1]=1;  
}


$kirim = array('data' => $data,
               'aturan'=>$aturan );
        header('Content-type: application/json');
        echo json_encode($kirim); 
    
}


?>
