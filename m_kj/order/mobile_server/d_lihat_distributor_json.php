<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id_order'])){
    
    $id_order=$_GET['id_order'];
   // $nm_bulan=$_GET['bulan'];
    
    
    $sql_order_dist = "SELECT CATATAN2,SBG FROM order_distributor WHERE ID_ORDER='".$id_order."'";
    
    $my_order2 = mysql_query($sql_order_dist);
 
 
$data_json2=array();

while ($order2 = mysql_fetch_assoc($my_order2)) {
                                                               
      $data_json2[0]=$order2['CATATAN2'];
      $data_json2[1]=$order2['SBG'];
              
   }
    
    
$sql_order = "SELECT tb1.*,tb2.NAMA_PRODUK
FROM (SELECT Id,ID_ORDER,ITEM_CODE,JML_KJ,JML_REAL,JML_SISA,JML_ORDER,KUBIKASI 
FROM order_detail WHERE ID_ORDER='".$id_order."') tb1
LEFT JOIN (SELECT ITEM_CODE,NAMA_PRODUK FROM m_produk)tb2
ON tb1.ITEM_CODE=tb2.ITEM_CODE";


 $my_order = mysql_query($sql_order);
 
 
$data_json=array();
$nx=0; 

$tot_kj=0;
$tot_real=0;
$tot_sisa=0;
$tot_kubik=0;
$tot_order=0;

while ($order = mysql_fetch_assoc($my_order)) {
       
        $tot_kj+=$order['JML_KJ'];
        $tot_real+=$order['JML_REAL'];
        $tot_sisa+=$order['JML_SISA'];
        $tot_kubik+=$order['KUBIKASI'];
        $tot_order+=$order['JML_ORDER'];
    
      $data_json[$nx][0]=$order['Id'];
      $data_json[$nx][1]=$order['ID_ORDER'];
      $data_json[$nx][2]=$order['ITEM_CODE'];
      $data_json[$nx][3]=$order['JML_KJ'];
      $data_json[$nx][4]=$order['JML_REAL'];
      $data_json[$nx][5]=$order['JML_SISA'];
      $data_json[$nx][6]=$order['JML_ORDER'];
      $data_json[$nx][7]=$order['KUBIKASI'];
      $data_json[$nx][8]=$order['NAMA_PRODUK'];
    
      
      $nx++;
              
   }
 
   //echo $view_isi.$view;

   $kirim = array('data' => $data_json,
                  'detail' =>$data_json2,
                  't_kj'=>$tot_kj,
                  't_real'=>$tot_real,
                  't_sisa'=>$tot_sisa,
                  't_order'=>$tot_order,
                  't_kubik'=>$tot_kubik
       
       
       );
        header('Content-type: application/json');
        echo json_encode($kirim);

   
            }
?>

