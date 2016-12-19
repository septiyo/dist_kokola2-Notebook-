<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
$account_id=$_GET['id'];
//$nm_bulan=$_GET['bulan'];
$sql_produk = "select MM.ID, YO.ITEM_CODE, YO.item_name, MM.KATEGORI,
XX.PRICEGROUP_CODE, XX.UNIT_NAME, XX.PRICE,
OK.qty, SHIT.KUBIK from push_item YO
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
        left join kubikasi SHIT
                on YO.ITEM_CODE = SHIT.ITEM_CODE
        where YO.ITEM_CODE not in
        (select ITEM_CODE from kj
                where ACCOUNT_ID = '".$account_id."'
                and TRIWULAN like '%".$nm_bulan."%')
                and YY.ACCOUNT_ID = '".$account_id."'
                and (upper(MM.KET) not in ('Discontinue') or MM.KET = '' or MM.KET is null)
        order by MM.KATEGORI asc";



 
   //while($data = mysql_fetch_assoc($hasil)) {	 
 
$view='<ul id="dataPointList" data-role="listview" data-filter="true" style="overflow:auto; -webkit-overflow-scrolling:touch;">'
        . '<input type="hidden" id="cek_tproduk" value="1">';                                      
                                            
$my_produk = mysql_query($sql_produk);
$i=1;						
  while ($dataProduk = mysql_fetch_assoc($my_produk)) {
      $view.='<li style="padding:0; border:none;" class="d_produk">
              <input id="checkbox-'.$i.'" type="checkbox" class="ck_produk" value="cek" ad_kubik="'.$dataProduk['KUBIK'].'" ad_real="'.$dataProduk['qty'].'" code_produk="'.$dataProduk['ITEM_CODE'].'" id_produk="'.$dataProduk['ID'].'">
              <label for="checkbox-'.$i.'" class="d_namaproduk">'.$dataProduk['item_name'].' <span style="color:#f33;">('.$dataProduk['UNIT_NAME'].')</span></label>
            </li>';
   $i++;
  }
   
$view.='</ul>';
/*           
$view=' <ul data-role="listview" data-filter="true">
            <li style="padding:0; border:none;">
              <input type="checkbox" name="checkbox-4" id="checkbox-4" data-data-point-id="4">
              <label for="checkbox-4">blah4</label>
            </li>
            <li style="padding:0; border:none;">
              <input type="checkbox" id="checkbox-5">
              <label for="checkbox-5">blah5</label>
            </li>
            
          </ul>';
 
 */
   echo $view;
}
?>
<script>
    resetHeight();    
    function resetHeight(){

var tinggi=$(window).height()-220;

$("#dataPointList").css("max-height",tinggi+"px");

    };
    $(function(){
 

    $(window).resize(function(){
        resetHeight();
    });
});
</script>

                       
                        
                        
                      
                        