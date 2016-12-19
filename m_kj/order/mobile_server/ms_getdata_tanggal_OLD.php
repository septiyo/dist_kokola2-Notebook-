<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    $tgl_pilih=$_GET['tgl'];
    $account_id=$_GET['id'];
   // $nm_bulan=$_GET['bulan'];
$sql_order = "Select MM.ID, AA.ITEM_CODE, AA.item_name,
                    BB.PriceGroup_Code, BB.UNIT_NAME, BB.PRICE,
                    COALESCE(KJ.FORECAST,0) as FORECAST,
                    COALESCE(KJ.BULAN1,0) as BULAN1,
                    COALESCE(KJ.BULAN2,0) as BULAN2,
                    COALESCE(KJ.BULAN3,0) as BULAN3,
                    COALESCE(OK.qty,0) as QTY,
                    YES.qty as KJ_KIRIM,
                    COALESCE(KB.KUBIK,0) as KUBIK,
                    DR.JML_ORDER as RECENT_ORDER,
    DR.ACCOUNT_ID as RECENT_ACCOUNT 
                    from push_item AA
                    left join m_produk MM
    on AA.ITEM_CODE = MM.ITEM_CODE
                    inner join push_harga BB
                    on AA.ITEM_CODE = BB.ITEM_CODE
                    inner join push_distributor CC
                    on BB.PRICEGROUP_CODE = CC.PRICEGROUP_CODE
                    left join 
                    (select ID_PRODUK, COALESCE(FORECAST,0) as FORECAST, ITEM_CODE,
                            COALESCE(BULAN1,0) as BULAN1,
                            COALESCE(BULAN2,0) as BULAN2,
                            COALESCE(BULAN3,0) as BULAN3 from kj
                            where TRIWULAN like '%".$nm_bulan."%'
                            and ACCOUNT_ID = '".$account_id."') KJ
                    on AA.ITEM_CODE = KJ.ITEM_CODE
                    left join 
                            (SELECT t1.* FROM order_kirim t1
                            JOIN (SELECT account_id, item_code, MAX(periode2) periode2
                            FROM order_kirim where date_format(periode1, '%Y %m') = date_format(now(), '%Y %m')
                            AND date_format(periode2, '%Y %m') = date_format(now(), '%Y %m')
                            AND account_id = '".$account_id."'
                            GROUP BY account_id, item_code
                            ORDER BY tgl_upload desc) t2
                            ON t1.account_id = t2.account_id
                            AND t1.item_code = t2.item_code
                            AND t1.periode2 = t2.periode2
                            WHERE flag = 1
                            group by account_id, item_code) OK
                            on AA.ITEM_CODE = OK.ITEM_CODE
                    left join
                            (select account_id, item_code, periode1, periode2, qty, 'sun'
                            from order_kirim_wd
                            where date_format(periode1, '%Y %m 1') = date_format(now(), '%Y %m 1')
                            and date_format(periode2, '%Y %m %d') = date_format('".$tgl_pilih."', '%Y %m %d')
                            and account_id = '".$account_id."') YES
                            on AA.ITEM_CODE = YES.ITEM_CODE
                    left join
                            (select ITEM_CODE, PANJANG, TINGGI, LEBAR, KUBIK from kubikasi
                            where AKTIF_JUAL = '1') as KB
                            on AA.ITEM_CODE = KB.ITEM_CODE
                    left join order_draft DR
                            on DR.ACCOUNT_ID = CC.ACCOUNT_ID and DR.ITEM_CODE = AA.ITEM_CODE
                    where (KJ.FORECAST > 0 or DR.ACCOUNT_ID is not null)
                    and CC.ACCOUNT_ID = '".$account_id."'
                    order by MM.KATEGORI";




//$sql   = "SELECT id,nama FROM pegawai";

  // $hasil = mysql_query($sql);

 $view="";
 $t_kubik=0;
 $t_kj=0;
 $t_real=0;
 $t_sisa=0;
 $t_order=0;
 $tt_kubik=0;
   //while($data = mysql_fetch_assoc($hasil)) {	 
 $my_order = mysql_query($sql_order);
 
                                       
while ($order = mysql_fetch_assoc($my_order)) {
                                            
               
                
                $mod = date('m')%3;
                if ($mod == 1) {
                    $kj = $order['BULAN1'];

                }
                elseif ($mod == 2) {
                    $kj = $order['BULAN2'];

                }
                elseif ($mod == 0) {
                    $kj = $order['BULAN3'];

                }
                if (is_null($order['RECENT_ORDER'])) {
                    $jml_order = $order['KJ_KIRIM'];
                }
                else { 
                    $jml_order = $order['RECENT_ORDER'];
                }
	   	   
                $nama_produk=$order['item_name'].' <span style="color:#F33">('.$order['UNIT_NAME'].')</span>';
                $nama=$order['item_name'];
                $kubik=round($order['KUBIK'],4);
                $kj=$kj;
                $real=$order['QTY'];
                $sisa=$kj-$real;
                $order2=$jml_order;
                $t_kubik=$kubik*$order2;    
                
                    $tk_kubik+=$kubik;
                    $tk_kj+= $kj;
                    $tk_real+=$real;
                    $tk_sisa+=$sisa;
                    $tk_order+=$order2;
                    $tk_kubik2+=$t_kubik;
                                                
	  // $view.="<li><a href='javascript:void()' onclick=\"detail('".$data['id']."');\"> ".$data['nama']."</a></li>";
	 $view.='<div data-role="collapsible" data-filtertext="'.$nama.'" data-collapsed="true">
                <h3>'.$nama_produk.'</h3>
                <ul class="d_order" data-role="listview" data-inset="false">
                <li style="display:none;">M<sup>3</sup> = <span class="kubik">'.$kubik.'</span></li>
                <li>KJ = <span class="kj">'.$kj.'</span></li>
                <li>Real = <span class="real">'.$real.'</span></li>
                <li>Sisa = <span class="sisa">'.$sisa.'</span></li>';
//$view.= "<li> <a href='javascript:void()' onclick=\"detail('".$order2."');\">Order = ".$order2."</a></li>";
         $view.='<li><label for="textinput-f">Order = </label>'
                 . '<input class="inputorder" d-item="'.$order['ITEM_CODE'].'" data-produk="'.$order['ID'].'" type="number" value="'.$order2.'" placeholder="Jumlah Order"></li>';
         $view.='<li>Total Kubik = <span class="t_kubik">'.$t_kubik.'</span></li>    
                    </ul>
                    </div>';   
         
   }
   //total
   
   $view.='<div data-role="collapsible" data-filtertext="Total" data-collapsed="false" style="display:none;">
                <h3>Total</h3>
                <ul class="d_ordertotal" data-role="listview" data-inset="false">
                <li>Total KJ = <span class="tk_kj">'.$tk_kj.'</span></li>
                <li>Total Real = <span class="tk_real">'.$tk_real.'</span></li>
                <li>Total Sisa = <span class="tk_sisa">'.$tk_sisa.'</span></li>';
   $view.='<li>Total Order = <span class="tk-order">'.$tk_order.'<span></li>';
   $view.='<li>Total Kubik (M<sup>3</sup>) = <span class="tk-kubik">'.$tk_kubik2.'</span></li>    
                    </ul>
                    </div>';
   echo $view;
}
?>
