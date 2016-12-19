<?php

include "../koneksi.php";

	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -3 month'));

$arr[] = array("nama_label"=>"Majestic Wafer",
        "nama_db"=>"majestic");
$arr[] = array("nama_label"=>"Kukis Series",
        "nama_db"=>"kukis");
$arr[] = array("nama_label"=>"Malkist",
        "nama_db"=>"malkist");
$arr[] = array("nama_label"=>"Cream Series",
        "nama_db"=>"cream");


$isi="";
if(isset($_GET['id'])){
$ACC = $_GET['id'];

foreach ($arr as $tes1){

$sql = "SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '$ACC' 
                                                 AND m_produk.NAMA_PRODUK LIKE '%".$tes1['nama_db']."%'
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%')";

$hasil = mysqli_query($mysqli, $sql);
$isi.='<div data-role="collapsible" data-filtertext="'.$tes1['nama_label'].'" class="colep_1">
            <h3>'.$tes1['nama_label'].'</h3>
            <ul data-role="listview" data-inset="false" style="padding-left:10px;padding-right:10px">                
        <form>
            <input data-type="search" id="searchForCollapsibleSet2">
        </form>
        <div data-role="collapsible-set" data-filter="true" data-inset="true" id="collapsiblesetForFilter" data-input="#searchForCollapsibleSet2" data-theme="b" data-content-theme="a">';

//$nomer++;
foreach($hasil as $row){
	
	/*untuk cari forecast----$_SESSION[ACCOUNT_ID]*/
	
	$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim 
				        WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                		AND FLAG = 1  AND item_code = '$row[ITEM_CODE]' 
                        AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND 
						ACCOUNT_ID = '$ACC'";			 									   
							
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];	
						if (is_null($total_last_month)) {
							$total_last_month = "";
						}
	$isi.='
        <div data-role="collapsible" data-filtertext="'.$row['NAMA_PRODUK'].'" class="colep_2">
            <h3>'.$row['NAMA_PRODUK'].'</h3>
            <ul data-role="listview" data-inset="false">
                <li>
                    <div class="ui-grid-a">
                    <div class="ui-block-a">Last 3 Month</div>
                    <div class="ui-block-b"> <span style="color:#00ceff;float:right;">'.$total_last_month.'</span> </div>
                    </div>
                </li>
                <li>   
                <div class="ui-grid-a">
                    <div class="ui-block-a"><input name="FORECAST[]" class="FORECAST value="" placeholder="KJ" type="number" style="background-color: #363232;color: #00ceff;">
                    <input type="hidden" name="ITEM_CODE[]" class="ITEM_CODE" value="'.$row['ITEM_CODE'].'" />   
                    <input type="hidden" name="ITEM_NAME[]" class="ITEM_NAME" value="'.$row['NAMA_PRODUK'].'" />
                    <input type="hidden" name="bln_akhir[]" class="bln_akhir" value="'.$total_last_month.'" />    
                    </div>
                    <div class="ui-block-b"><br/><span style="color:#00ceff;float:right;">%</span><span class="PERSEN" style="color:#00ceff;float:right;">0</span></div>
                </div>
                  <div class="ui-grid-b">
                    <div class="ui-block-a"><input name="BULAN1[]" class="BULAN1" value="" placeholder="Bulan 1" type="number" style="background-color: #363232;color: #00ceff;"></div>
                    <div class="ui-block-b"><input name="BULAN2[]" class="BULAN2" value="" placeholder="Bulan 2" type="number" style="background-color: #363232;color: #00ceff;"></div>
                    <div class="ui-block-c"><input name="BULAN3[]" class="BULAN3" value="" placeholder="Bulan 3" type="number" style="background-color: #363232;color: #00ceff;" readonly></div>
                </div>
                </li>
                              
            </ul>
        </div>        
    
           ';
	
}

$isi.='</div>
    </ul>
        </div>';
}

$sql = "SELECT * FROM(SELECT  c.item_code AS ITEM_CODE,
                       c.item_name AS NAMA_PRODUK,
                       m_produk.`KATEGORI` AS KATEGORI,
                       m_produk.KET  
                             
                                                 FROM push_distributor a,
                                                 push_harga b,
                                                 push_item c
                                              
                                                 LEFT JOIN m_produk ON m_produk.`ITEM_CODE` = c.item_code
                                                 
                                                 WHERE
                                                 a.PRICEGROUP_CODE = b.PRICEGROUP_CODE
                                                 AND b.ITEM_CODE = c.item_code
                                                 AND a.ACCOUNT_ID = '$ACC' 
                                                 AND m_produk.NAMA_PRODUK NOT LIKE '%CREAM%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%MAJESTIC%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%KUKIS%'
						 AND m_produk.NAMA_PRODUK NOT LIKE '%MALKIST%'
                                                
                                                 ORDER BY m_produk.`KATEGORI` DESC) AS asline
                                                 WHERE asline.ITEM_CODE NOT IN (SELECT ITEM_CODE FROM m_produk WHERE UPPER(KET) LIKE '%DISCONTINUE%')";

$hasil = mysqli_query($mysqli, $sql);
$isi.='<div data-role="collapsible" data-filtertext="Lain-lain" class="colep_1">
            <h3>Lain-lain</h3>
            <ul data-role="listview" data-inset="false" style="padding-left:10px;padding-right:10px">
                
        <form>
            <input data-type="search" id="searchForCollapsibleSet6">
        </form>
        <div data-role="collapsible-set" data-filter="true" data-inset="true" id="collapsiblesetForFilter" data-input="#searchForCollapsibleSet6" data-theme="b" data-content-theme="a">';
foreach($hasil as $row){
	
	/*untuk cari forecast----$_SESSION[ACCOUNT_ID]*/
	
	$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim 
				        WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                		AND FLAG = 1  AND item_code = '$row[ITEM_CODE]' 
                        AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND 
						ACCOUNT_ID = '$ACC'";			 									   
							
										   
						  $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
						  $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
						  $total_last_month = $data_forcastx['total_last_month'];	
						if (is_null($total_last_month)) {
							$total_last_month = "";
						}
	$isi.='
       <div data-role="collapsible" data-filtertext="'.$row['NAMA_PRODUK'].'" class="colep_2">
            <h3>'.$row['NAMA_PRODUK'].'</h3>
            <ul data-role="listview" data-inset="false">
                <li>
                    <div class="ui-grid-a">
                    <div class="ui-block-a">Last 3 Month</div>
                    <div class="ui-block-b"> <span style="color:#00ceff;float:right;">'.$total_last_month.'</span> </div>
                    </div>
                </li>
                <li>   
                <div class="ui-grid-a">
                    <div class="ui-block-a"><input name="FORECAST[]" class="FORECAST" value="" placeholder="KJ" type="number" style="background-color: #363232;color: #00ceff;">
                    <input type="hidden" name="ITEM_CODE[]" class="ITEM_CODE" value="'.$row['ITEM_CODE'].'" />   
                    <input type="hidden" name="ITEM_NAME[]" class="ITEM_NAME" value="'.$row['NAMA_PRODUK'].'" />
                    <input type="hidden" name="bln_akhir[]" class="bln_akhir" value="'.$total_last_month.'" />    
                    </div>
                    <div class="ui-block-b"><br/><span  class="PERSEN" style="color:#00ceff;float:right;">0%</span> </div>
                </div>
      
                <div class="ui-grid-b">
                    <div class="ui-block-a"><input name="BULAN1[]" class="BULAN1" value="" placeholder="Bulan 1" type="number" style="background-color: #363232;color: #00ceff;"></div>
                    <div class="ui-block-b"><input name="BULAN2[]" class="BULAN2" value="" placeholder="Bulan 2" type="number" style="background-color: #363232;color: #00ceff;"></div>
                    <div class="ui-block-c"><input name="BULAN3[]" class="BULAN3" value="" placeholder="Bulan 3" type="number" style="background-color: #363232;color: #00ceff;"></div>
                </div>
                </li>                
            </ul>
        </div>                    
           ';
}

$isi.='</div>
    </ul>
        </div>';

echo $isi;												 												 

}

?>
<style>
     .merah h3 a {
    border-width: 1px !important; 
    background: #1fbe0a !important;
    }
</style>