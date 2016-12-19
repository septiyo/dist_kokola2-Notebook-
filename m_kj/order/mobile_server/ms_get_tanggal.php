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
                                            
    $sql_transport="SELECT ACCOUNT_ID, DATE_FORMAT(periode2,'%d') AS tglx FROM order_kirim_wd WHERE  ACCOUNT_ID = '".$account_id."' 
                    AND MONTH(periode2) ='".$bulanku."' AND YEAR(periode2) = '".$yearku."' GROUP BY tglx";
    $mysql_transport = mysql_query($sql_transport);
    
    $view.='<option value="">Pilih Tanggal</option>';
    while ($dataTgl = mysql_fetch_assoc($mysql_transport)) {   
    
        if($dataTgl['tglx']>=$tgl_sekarang){    
            $view.='<option value="'.$yearku.'-'.$bulanku.'-'.$dataTgl['tglx'].'">'.$dataTgl['tglx'].'</option>'; 
        }
    
    }
	
	$sqlsel = "SELECT * FROM distributor_kokola.kj k 
					WHERE k.TRIWULAN = (
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
					AND YEAR(k.TGL) = YEAR(CURDATE())
					AND k.BULAN1 IS NOT NULL
					AND k.BULAN2 IS NOT NULL
					AND k.BULAN3 IS NOT NULL
                                        AND k.STATUS_APR ='1'
					AND k.ACCOUNT_ID = '".$account_id."'";
					
	$ress = mysql_query($sqlsel) or die(mysql_error());
	
	if(mysql_num_rows($ress) > 0){
		$view.='<option value="tambah">Tambah Order</option>';
	}else{
		$view.='<option value="">Tidak Ada KJ</option>';
	}
	
 //$view.='<option value="semua" selected="selected">Semua</option>';
   echo $view;
}
?>
