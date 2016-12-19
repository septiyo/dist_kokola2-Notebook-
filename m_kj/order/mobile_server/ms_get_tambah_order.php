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
 
$view="";                                      
                                            
$my_produk = mysql_query($sql_produk);
						
  while ($dataProduk = mysql_fetch_assoc($my_produk)) {               
    $view.='<div data-role="collapsible" data-filtertext="'.$dataProduk['item_name'].'" data-collapsed="true">';           
    $view.='<h3 class="d_namaproduk">'.$dataProduk['item_name'].' <span style="color:#f33;">('.$dataProduk['UNIT_NAME'].')</span></h3>';  
    $view.='<ul data-role="listview" data-inset="false" class="d_produk">
            <li>
                <div style="display:none;" class="d_namaproduk">'.$dataProduk['item_name'].' <span style="color:#f33;">('.$dataProduk['UNIT_NAME'].')</span></div>
                <div class="ui-checkbox widget uib_w_7 d-margins" data-uib="jquery_mobile/checkbox" data-ver="0">
                    <label>Order
                    <input class="ck_produk" type="checkbox" value="cek">
                </label>
                </div>
            </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Kategori :</div>
                          <div class="ui-block-b"><strong>'.$dataProduk['KATEGORI'].'</strong>
                          </div>
                        </div>                            
                        </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Kode :</div>
                          <div class="ui-block-b"><strong class="code_produk">'.$dataProduk['ITEM_CODE'].'</strong>
                            <span class="id_produk" style="display:none;">'.$dataProduk['ID'].'</span>  
                          </div>
                        </div>                            
                        </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Kubik Produk :</div>
                          <div class="ui-block-b"><strong class="ad_kubik">'.$dataProduk['KUBIK'].'</strong>
                          </div>
                        </div>                            
                        </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Real :</div>
                          <div class="ui-block-b"><strong class="ad_real">'.$dataProduk['qty'].'</strong>
                          </div>
                        </div>                            
                        </li>                               
                        </ul>
                    </div>';
  }
   

   echo $view;
}
?>

                       
                        
                        
                      
                        