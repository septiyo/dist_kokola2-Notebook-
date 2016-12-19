<?php
require_once("koneksi.php");

$sqlData = "select AA.ID, AA.NAMA_PRODUK, AA.SATUAN, AA.HARGA, AA.ITEM_CODE,
  COALESCE(FORECAST,0) as FORECAST,
  COALESCE(BULAN1,0) as BULAN1,
  COALESCE(BULAN2,0) as BULAN2,
  COALESCE(BULAN3,0) as BULAN3,
  COALESCE(OK.qty,0) as QTY1,
  COALESCE(OK2.qty,0) as QTY2,
  COALESCE(OK3.qty,0) as QTY3,
  COALESCE(PESAN1.JML_ORDER,0) as JML_ORDER1,
  COALESCE(PESAN2.JML_ORDER,0) as JML_ORDER2,
  COALESCE(PESAN3.JML_ORDER,0) as JML_ORDER3
  from m_produk AA
  left join 
  (select ID_PRODUK, COALESCE(FORECAST,0) as FORECAST,
      COALESCE(BULAN1,0) as BULAN1,
      COALESCE(BULAN2,0) as BULAN2,
      COALESCE(BULAN3,0) as BULAN3 from kj
      where TRIWULAN like '%".$nm_bulan."%'
      and ACCOUNT_ID = '".$account_id."') KJ
      on AA.ID = KJ.ID_PRODUK
  left join
  (select date_format(OD.TGL, '%Y %m') as TGL, OD.USERID,
    OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE, sum(DET.JML_ORDER) as JML_ORDER
    from order_distributor OD, order_detail DET
    where OD.ID_ORDER = DET.ID_ORDER
    and OD.FLAG = '1'
    and OD.ACCOUNT_ID = '".$account_id."'
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 1)
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 1)
    group by date_format(OD.TGL, '%Y %m'), OD.USERID, OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE) PESAN1
    on AA.ITEM_CODE = PESAN1.ITEM_CODE
  left join
  (select date_format(OD.TGL, '%Y %m') as TGL, OD.USERID,
    OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE, sum(DET.JML_ORDER) as JML_ORDER
    from order_distributor OD, order_detail DET
    where OD.ID_ORDER = DET.ID_ORDER
    and OD.FLAG = '1'
    and OD.ACCOUNT_ID = '".$account_id."'
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 2)
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 2)
    group by date_format(OD.TGL, '%Y %m'), OD.USERID, OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE) PESAN2
    on AA.ITEM_CODE = PESAN2.ITEM_CODE
  left join
  (select date_format(OD.TGL, '%Y %m') as TGL, OD.USERID,
    OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE, sum(DET.JML_ORDER) as JML_ORDER
    from order_distributor OD, order_detail DET
    where OD.ID_ORDER = DET.ID_ORDER
    and OD.FLAG = '1'
    and OD.ACCOUNT_ID = '".$account_id."'
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 3)
    and date_format(OD.TGL, '%Y %m') = lapo('".$nm_bulan."', 3)
    group by date_format(OD.TGL, '%Y %m'), OD.USERID, OD.ACCOUNT_ID, DET.ID_PRODUK, DET.ITEM_CODE) PESAN3
    on AA.ITEM_CODE = PESAN3.ITEM_CODE
  left join 
  (select account_id, item_code, date_format(periode1, '%Y %m') as periode1,
    date_format(periode2, '%Y %m') as periode2, sum(qty) as qty
    from order_kirim
    where flag = 1
    and account_id = '".$account_id."'
    and date_format(periode1, '%Y %m') = lapo('".$nm_bulan."', 1)
    and date_format(periode2, '%Y %m') = lapo('".$nm_bulan."', 1)
    group by account_id, item_code, date_format(periode1, '%Y %m'),
    date_format(periode2, '%Y %m')
    order by account_id asc) OK
    on AA.ITEM_CODE = OK.ITEM_CODE
  left join 
  (select account_id, item_code, date_format(periode1, '%Y %m') as periode1,
    date_format(periode2, '%Y %m') as periode2, sum(qty) as qty
    from order_kirim
    where flag = 1
    and account_id = '".$account_id."'
    and date_format(periode1, '%Y %m') = lapo('".$nm_bulan."', 2)
    and date_format(periode2, '%Y %m') = lapo('".$nm_bulan."', 2)
    group by account_id, item_code, date_format(periode1, '%Y %m'),
    date_format(periode2, '%Y %m')
    order by account_id asc) OK2
    on AA.ITEM_CODE = OK2.ITEM_CODE
  left join 
  (select account_id, item_code, date_format(periode1, '%Y %m') as periode1,
    date_format(periode2, '%Y %m') as periode2, sum(qty) as qty
    from order_kirim
    where flag = 1
    and account_id = '".$account_id."'
    and date_format(periode1, '%Y %m') = lapo('".$nm_bulan."', 3)
    and date_format(periode2, '%Y %m') = lapo('".$nm_bulan."', 3)
    group by account_id, item_code, date_format(periode1, '%Y %m'),
    date_format(periode2, '%Y %m')
    order by account_id asc) OK3
    on AA.ITEM_CODE = OK3.ITEM_CODE
   where KJ.FORECAST > 0";
$myData = mysql_query($sqlData);
$jml = mysql_num_rows($myData);
$arr = array();
if ($jml > 0) {
	while ($rowData = mysql_fetch_assoc($myData)) {
		$arr[] = array("produk"=>$rowData['NAMA_PRODUK']." <span style='color:#f00'>(".$rowData['SATUAN'].")</span>",
			"harga"=>$rowData['HARGA'],
			"forecast"=>$rowData['FORECAST'],
			"KJ1"=>$rowData['BULAN1'],
			"KJ2"=>$rowData['BULAN2'],
			"KJ3"=>$rowData['BULAN3'],
			"order1"=>$rowData['JML_ORDER1'],
			"order2"=>$rowData['JML_ORDER2'],
			"order3"=>$rowData['JML_ORDER3'],
			"real1"=>$rowData['QTY1'],
			"real2"=>$rowData['QTY2'],
			"real3"=>$rowData['QTY3'],
		);
	}
}
$data = '{"data": '.json_encode($arr).'}';
echo ($data);
?>