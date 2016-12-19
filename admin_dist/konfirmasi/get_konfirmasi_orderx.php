<?php
include "../../koneksi.php";
ini_set('display_errors', '0');
//date_default_timezone_set("Asia/Jakarta");

$today = date('d') . "-" . date('m') . "-" . date('Y');
$today_database = date('Y') . "-" . date('m') . "-" . date('d');
$time = date('H:i:s');


$sql = "SELECT order_distributor.TGL,
			   order_distributor.TGL AS TGL_D ,
					order_distributor.FLAG,
					order_distributor.USERID,
                    order_distributor.ID_ORDER,
					user.KOTA,
					user.NAMA,
					order_distributor.CATATAN2,
                    order_distributor.SBG,
					order_distributor.STATUS_APR,

					order_distributor.ACCOUNT_ID,
					SUM(order_detail.JML_ORDER) AS total
					FROM user,order_distributor,order_detail
					WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
			        AND DATE(order_distributor.TGL) <= '$today_database'
					AND order_distributor.ID_ORDER = order_detail.ID_ORDER
					AND order_detail.FLAG = 1
					AND order_distributor.FLAG IN ('1','8')

					GROUP BY order_distributor.ACCOUNT_ID,order_distributor.FLAG,order_distributor.ID_ORDER
					ORDER BY order_distributor.TGL DESC";


/* $sql = "SELECT order_distributor.TGL,
                           DATE(order_distributor.TGL) AS TGL_D ,
		order_distributor.FLAG,
		order_distributor.USERID,
                    order_distributor.ID_ORDER,
		user.KOTA,
		user.NAMA,
		order_distributor.CATATAN2,
                    order_distributor.SBG,

		order_distributor.ACCOUNT_ID,
		SUM(order_detail.JML_ORDER) AS total
		FROM distributor_kokola.user,order_distributor,order_detail
		WHERE order_distributor.ACCOUNT_ID = user.ACCOUNT_ID
	AND DATE(order_distributor.TGL) <= '$today_database'
		AND order_distributor.ID_ORDER = order_detail.ID_ORDER
		AND order_detail.FLAG = '1'
		AND (order_distributor.FLAG = '1' OR (order_distributor.FLAG = '8' AND order_distributor.STATUS_APR='1'))
		
		GROUP BY order_distributor.ACCOUNT_ID,order_distributor.FLAG,order_distributor.ID_ORDER
		ORDER BY order_distributor.TGL DESC"; */					


$hasil = mysqli_query($mysqli, $sql);
$jumlah_total = 0;
$jumlah_total2 = 0;


$results = array();

foreach($hasil as $row){

    $results[] = array(
        'TGL'=> $row[TGL],
        'NAMA' => $row[NAMA],
        'KOTA' => $row[KOTA],
        'SBG' => $row[SBG],
        'CATATAN2' => $row[CATATAN2],
        'ID_ORDER' => $row[ID_ORDER],
        'ACC_ID' => $row[ACCOUNT_ID],
        'TGL_D' => $row[TGL_D],
        'total' => $row[total],
        'USERID' => $row[USERID],
        'FLAG' => $row[FLAG],
        'ID_ORDER' => $row[ID_ORDER],
        'STATUS_APR' => $row[STATUS_APR]



    );
}

$json = json_encode($results);

echo $json;



/*while($data = mysqli_fetch_assoc($hasil)){
    $total2 = number_format($data['total']);
    echo "<tr>";
    echo "<td align='center'>$data[TGL]</td>";
    echo "<td align='center'>$data[NAMA]</td>";
    echo "<td align='center'>$data[KOTA]</td>";
    echo "<td align='center'>$data[SBG]</td>";
    echo "<td align='center'>$data[CATATAN2]</td>";
    if($data['FLAG'] == '3'){
        echo "<td align='right'>$total2</td>";
    }
    else{
        echo "<td align='right'>
								<a href='detail_konfirmasi.php?IDORDER=$data[ID_ORDER]&ID=$data[ACCOUNT_ID]&NAMA=$data[NAMA]&KOTA=$data[KOTA]&USERID=$data[USERID]&JOS=1&TGL_D=$data[TGL_D]' style='text-decoration:none;' data-ajax='false' target='_parent'>$total2</a></td>";
    }
    echo "</tr>";

    $jumlah_total = $jumlah_total + $data['total'];
    $jumlah_total2 = number_format($jumlah_total);
}*/





?>