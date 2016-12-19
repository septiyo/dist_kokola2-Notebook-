<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
$account_id=$_GET['id'];
//$nm_bulan=$_GET['bulan'];
$sql_produk = "select MM.ID, YO.ITEM_CODE, MM.NAMA_PRODUK AS item_name, MM.KATEGORI,
XX.PRICEGROUP_CODE, XX.UNIT_NAME, XX.PRICE,
OK.qty, (panjang*lebar*tinggi/1000000000) AS KUBIK from push_item YO
        left join m_produk MM on YO.item_code = MM.ITEM_CODE
        inner join push_harga XX on YO.ITEM_CODE = XX.ITEM_CODE
        inner join push_distributor YY on XX.PRICEGROUP_CODE = YY.PRICEGROUP_CODE
        left join
                (SELECT t1.* FROM order_kirim t1
                JOIN (SELECT account_id, item_code, MAX(periode2) periode2
                FROM order_kirim
                where date_format(periode1, '%Y %m') = date_format(now(), '%Y %m')
                AND date_format(periode2, '%Y %m') = date_format(now(), '%Y %m')
                AND account_id = '".$account_id."'
                GROUP BY account_id, item_code
                ORDER BY tgl_upload desc) t2
                ON t1.account_id = t2.account_id
                AND t1.item_code = t2.item_code
                AND t1.periode2 = t2.periode2
                WHERE flag = 1
                group by account_id, item_code) OK
                ON YO.ITEM_CODE = OK.item_code
        where YO.ITEM_CODE not in
        (select ITEM_CODE from kj
                where ACCOUNT_ID = '".$account_id."'
                and TRIWULAN like '%".$nm_bulan."%')
                and YY.ACCOUNT_ID = '".$account_id."'
                and (upper(MM.KET) not in ('Discontinue') or MM.KET = '' or MM.KET is null)
        order by MM.KATEGORI asc";

                                  
$my_produk = mysql_query($sql_produk);
$i=1;	
$nx=0;
$data_json=array();
  while ($dataProduk = mysql_fetch_assoc($my_produk)) {
      if($dataProduk['KUBIK']==null || $dataProduk['KUBIK']==""){  
       $data_kbk='0';
      }else{
       $data_kbk=$dataProduk['KUBIK'];   
      }
      
      if($dataProduk['qty']==null || $dataProduk['qty']==""){  
       $data_qty='0';
      }else{
       $data_qty=$dataProduk['qty'];   
      }
      
      
      $data_json[$nx][0]=$data_kbk;
      $data_json[$nx][1]=$data_qty;
      $data_json[$nx][2]=$dataProduk['ITEM_CODE'];
      $data_json[$nx][3]=$dataProduk['ID'];
      $data_json[$nx][4]=$dataProduk['item_name'];
      $data_json[$nx][5]=$dataProduk['UNIT_NAME'];
      $nx++;
      
   $i++;
  }
 

   //echo $view;

$kirim = array('data' => $data_json);
        header('Content-type: application/json');
        echo json_encode($kirim);
}
?>



                       
                        
                        
                      
                        

