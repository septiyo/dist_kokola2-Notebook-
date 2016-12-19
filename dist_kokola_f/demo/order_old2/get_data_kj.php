<?php
require_once("koneksi.php");

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
$arr = array();
if ($jml > 0) {
	while ($rowData = mysql_fetch_assoc($myData)) {
		$sisa1 = $rowData['BULAN1']-$rowData['REAL1'];
		$sisa2 = $rowData['BULAN2']-$rowData['REAL2'];
		$sisa3 = $rowData['BULAN3']-$rowData['REAL3'];
		
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
		);
	}
}
$data = '{"data": '.json_encode($arr).'}';
echo ($data);
?>