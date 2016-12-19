<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
//$nm_bulan=$_GET['bulan'];
$account_id=$_GET['id'];

$sqlData = "select AA.item_code, AA.item_name, BB.UNIT_NAME, BB.PRICE,
     COALESCE(FORECAST, 0) as FORECAST,
     COALESCE(PERSEN, 0) as PERSEN,
     COALESCE(BULAN1, 0) as BULAN1,
     COALESCE(BULAN2, 0) as BULAN2,
     COALESCE(BULAN3, 0) as BULAN3,
     COALESCE(REAL1.qty, 0) as REAL1,
     COALESCE(REAL2.qty, 0) as REAL2,
     COALESCE(REAL3.qty, 0) as REAL3
from push_item AA
inner join push_harga BB
on AA.item_code = BB.ITEM_CODE
inner join push_distributor CC
on BB.PRICEGROUP_CODE = CC.PRICEGROUP_CODE
left join
     (select ACCOUNT_ID, ID_PRODUK, ITEM_CODE, BLN_AKHIR, FORECAST, PERSEN, BULAN1, BULAN2, BULAN3, TRIWULAN
     from kj where TRIWULAN like '%".$nm_bulan."%'
     AND account_id = '".$account_id."') KJ
on AA.item_code = KJ.ITEM_CODE
left join
     (SELECT t1.ACCOUNT_ID, t1.item_code, t1.qty FROM order_kirim t1
			JOIN (SELECT account_id, item_code, MAX(periode2) periode2
			FROM order_kirim
      WHERE date_format(periode1, '%Y %m') = lapo('".$nm_bulan."',1)
      AND date_format(periode2, '%Y %m') = lapo('".$nm_bulan."',1)
      AND flag = 1 AND account_id = '".$account_id."'
			GROUP BY account_id, item_code
			ORDER BY tgl_upload desc) t2
			ON t1.account_id = t2.account_id
			AND t1.item_code = t2.item_code
      AND t1.periode2 = t2.periode2
      WHERE flag = 1
			group by account_id, item_code) REAL1
on AA.ITEM_CODE = REAL1.item_code
left join
     (SELECT t1.ACCOUNT_ID, t1.item_code, t1.qty FROM order_kirim t1
			JOIN (SELECT account_id, item_code, MAX(periode2) periode2
			FROM order_kirim
      WHERE date_format(periode1, '%Y %m') = lapo('".$nm_bulan."',2)
      AND date_format(periode2, '%Y %m') = lapo('".$nm_bulan."',2)
      AND flag = 1 AND account_id = '".$account_id."'
			GROUP BY account_id, item_code
			ORDER BY tgl_upload desc) t2
			ON t1.account_id = t2.account_id
			AND t1.item_code = t2.item_code
      AND t1.periode2 = t2.periode2
      WHERE flag = 1
			group by account_id, item_code) REAL2
on AA.ITEM_CODE = REAL2.item_code
left join
     (SELECT t1.ACCOUNT_ID, t1.item_code, t1.qty FROM order_kirim t1
			JOIN (SELECT account_id, item_code, MAX(periode2) periode2
			FROM order_kirim
      WHERE date_format(periode1, '%Y %m') = lapo('".$nm_bulan."',3)
      AND date_format(periode2, '%Y %m') = lapo('".$nm_bulan."',3)
      AND flag = 1 AND account_id = '".$account_id."'
			GROUP BY account_id, item_code
			ORDER BY tgl_upload desc) t2
			ON t1.account_id = t2.account_id
			AND t1.item_code = t2.item_code
      AND t1.periode2 = t2.periode2
      WHERE flag = 1
			group by account_id, item_code) REAL3
on AA.ITEM_CODE = REAL3.item_code
where (FORECAST > 0 or REAL1.qty > 0 or REAL2.qty > 0 or REAL3.qty > 0)
and CC.ACCOUNT_ID = '".$account_id."'";
$myData = mysql_query($sqlData);
$jml = mysql_num_rows($myData);
$kj1=0;
$kj2=0;
$kj3=0;
$real1=0;
$real2=0;
$real3=0;
$sis1=0;
$sis2=0;
$sis3=0;
$forcest=0;
//$arr = array();
if ($jml > 0) {
	while ($rowData = mysql_fetch_assoc($myData)) {
		$sisa1 = $rowData['BULAN1']-$rowData['REAL1'];
		$sisa2 = $rowData['BULAN2']-$rowData['REAL2'];
		$sisa3 = $rowData['BULAN3']-$rowData['REAL3'];
$kj1+=$rowData['BULAN1'];
$kj2+=$rowData['BULAN2'];
$kj3+=$rowData['BULAN3'];
$real1+=$rowData['REAL1'];
$real2+=$rowData['REAL2'];
$real3+=$rowData['REAL3'];
$sis1+=$sisa1;
$sis2+=$sisa2;
$sis3+=$sisa3;
$forcest+=$rowData['FORECAST'];
		/*
		$arr[] = array("produk"=>$rowData['item_name']." <span style='color:#f00'>(".$rowData['UNIT_NAME'].")</span>",
			"harga"=>$rowData['PRICE'],
			"forecast"=>$rowData['FORECAST'],
			"KJ1"=>$rowData['BULAN1'],
			"KJ2"=>$rowData['BULAN2'],
			"KJ3"=>$rowData['BULAN3'],
			"real1"=>$rowData['REAL1'],
			"real2"=>$rowData['REAL2'],
			"real3"=>$rowData['REAL3'],
			"sisa1"=>$sisa1,
			"sisa2"=>$sisa2,
			"sisa3"=>$sisa3,
		);*/

echo '<li>
         <div style="background:#b41f04; border:1px solid #ccc; padding:5px 10px; color:white;">'.$rowData['item_name'].' <span style="color:#fad9d9">('.$rowData['UNIT_NAME'].')</span></div>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 1</div>              
            <ul>
                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">KJ : ';
echo number_format($rowData['BULAN1']).
        '</li>

                    <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">REAL : ';
echo number_format($rowData['REAL1']).'</li>

                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">SISA : ';
echo number_format($sisa1).'</li>
                              
            </ul>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 2</div>
							
            <ul>
                <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">KJ : ';
echo number_format($rowData['BULAN2']).'</li>

                <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">REAL : ';
echo number_format($rowData['REAL2']).'</li>

                <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">SISA : ';
echo number_format($sisa2).'</li>
            
            </ul>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 3</div>
                                    
	<ul>
            <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">KJ : ';
echo number_format($rowData['BULAN3']).'</li>

            <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">REAL : ';
echo number_format($rowData['REAL3']).'</li>

            <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">SISA : ';
echo number_format($sisa3).'</li>
           
	</ul>
            <div style="background:#fad9d9; border:none solid #ccc; padding:5px 10px">FORECAST</div>

            <ul>
                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">';
echo number_format($rowData['FORECAST']).'</li>
            </ul>        
            <br/>
            <br/>   
        
</li>';
	}



echo '<li>
        <div style="background:#b41f04; border:1px solid #ccc; padding:5px 10px; color:white">TOTAL</div>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 1</div>              
            <ul>
                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total KJ : ';
echo number_format($kj1).'</li>

                    <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">Total Real : ';
echo number_format($real1).'</li>

                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total Sisa : ';
echo number_format($sis1).'</li>
                              
            </ul>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 2</div>
							
            <ul>
                <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total KJ : ';
echo number_format($kj2).'</li>

                <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">Total Real : ';
echo number_format($real2).'</li>

                <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total Sisa : ';
echo number_format($sis2).'</li>
            
            </ul>
        <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">BULAN 3</div>
                                    
	<ul>
            <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total KJ : ';
echo number_format($kj3).'</li>

            <li style="background:#ebeaea;height:30px;padding-top:7px;border:none;">Total Real : ';
echo number_format($real3).'</li>

            <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">Total Sisa : ';
echo number_format($sis3).'</li>
            
	</ul>
            <div style="background:#fad9d9; border:none solid #ccc; padding:7px;height:30px;">TOTAL FORECAST</div>

            <ul>
                    <li style="background:#f9fcf9;height:30px;padding-top:7px;border:none;">';
echo number_format($forcest).'</li>
            </ul>        
            
        
</li>';

}


}
?>

