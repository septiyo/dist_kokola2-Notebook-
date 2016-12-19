<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
$account_id=$_GET['id'];

$tgl = date('Y')."-".date('m')."-".date('d');
                                $tgl_sekarang=date('d');
				$yearku = date('Y');
				$bulanku = date('m'); 
                                
$view="";                                      
                                            
    $sql_transport="SELECT ACCOUNT_ID, DAY(periode2) AS tglx FROM order_kirim_wd WHERE  ACCOUNT_ID = '".$account_id."' 
                    AND MONTH(periode2) ='".$bulanku."' AND YEAR(periode2) = '".$yearku."' GROUP BY tglx";
    $mysql_transport = mysql_query($sql_transport);
    
    $view.='<option value="">Pilih Tanggal</option>';
    while ($dataTgl = mysql_fetch_assoc($mysql_transport)) {   
    
        if($dataTgl['tglx']>=$tgl_sekarang){    
            $view.='<option value="'.$yearku.'-'.$bulanku.'-'.$dataTgl['tglx'].'">'.$dataTgl['tglx'].'</option>'; 
        }
    
    }
	
	
    $view.='<option value="tambah">Tambah Order</option>';
   
 //$view.='<option value="semua" selected="selected">Semua</option>';
   echo $view;
}

?>

                       
                        
                        
                      
                        



