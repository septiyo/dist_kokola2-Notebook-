<?php
require_once("koneksi.php");

$usr = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';

$sql = mysql_query("SELECT oc.ITEM_CODE, COUNT(1) AS 'jumlah_order', mp.nama_produk, tp.URL FROM order_confirm oc
					INNER JOIN m_produk mp ON oc.ITEM_CODE = mp.ITEM_CODE
					INNER JOIN tb_produk tp ON oc.ITEM_CODE = tp.ITEM_CODE
					WHERE oc.ACCOUNT_ID = '". $usr ."' GROUP BY oc.ITEM_CODE ORDER BY 2, oc.ITEM_CODE ASC");

$results = array();
while ($row = mysql_fetch_array($sql)) {
	
	$u = $row['URL'];
	if($u == null || $u == ""){
		$u = "http://119.252.168.10:388/m_kj/server_mobile/images/default.png";
	}
	
    $results[] = array(
        'ITEM_CODE' => $row['ITEM_CODE'],
        'jumlah_order' => $row['jumlah_order'],
        'nama_produk' => $row['nama_produk'],
        'URL' => $u
    );
}

$json = json_encode($results);
echo $json;
?>