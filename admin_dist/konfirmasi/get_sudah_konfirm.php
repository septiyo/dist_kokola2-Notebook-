<?php
include "../../koneksi.php";
ini_set('display_errors', '0');
//date_default_timezone_set("Asia/Jakarta");

$today = date('d') . "-" . date('m') . "-" . date('Y');
$today_database = date('Y') . "-" . date('m') . "-" . date('d');
$time = date('H:i:s');
$mon = date('m');


/* $sql = "SELECT order_confirm.TGL_CONFIRM,
							 DATE(order_confirm.TGL_CONFIRM) AS TGL_D,
                             user.NAMA,
                             user.KOTA,
		                     order_confirm.ACCOUNT_ID,
		                     order_confirm.ID_ORDER,
							 order_confirm.CATATAN2,
                             order_confirm.SBG,
                             SUM(order_confirm.JML_ORDER) AS jml_confirm
                             FROM order_confirm,`user`
                             WHERE DATE(order_confirm.TGL_CONFIRM) <= '$today_database'
                             AND order_confirm.ACCOUNT_ID = user.ACCOUNT_ID
							 GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2
							 ORDER BY order_confirm.TGL_CONFIRM DESC"; */
							 
							 
	/* $sql = "SELECT  order_confirm.Id,
	         order_confirm.TGL_ORDER,
	         order_confirm.TGL_CONFIRM,
			 DATE(order_confirm.TGL_CONFIRM)as TGL_D,
	        order_confirm.ACCOUNT_ID,
			order_confirm.ID_ORDER,
	        `user`.NAMA,
	        `user`.KOTA,
	        order_confirm.SBG,
	       SUM(order_confirm.JML_ORDER)AS jml_confirm,
	       order_confirm.CATATAN2 
	       FROM order_confirm
                INNER JOIN `user` ON `user`.ACCOUNT_ID = order_confirm.ACCOUNT_ID
              
                AND DATE(order_confirm.TGL_CONFIRM) = '$today_database'	       
	        GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2 ORDER BY order_confirm.Id DESC LIMIT 1000;";*/



$sql = "SELECT  order_confirm.Id,
	         order_confirm.TGL_ORDER,
	         order_confirm.TGL_CONFIRM,
			 DATE(order_confirm.TGL_CONFIRM)AS TGL_D,
	        order_confirm.ACCOUNT_ID,
			order_confirm.ID_ORDER,
	        `user`.NAMA,
	        `user`.KOTA,
	        order_confirm.SBG,
	       SUM(order_confirm.JML_ORDER)AS jml_confirm,
	       order_confirm.CATATAN2 
	       FROM order_confirm
                INNER JOIN `user` ON `user`.ACCOUNT_ID = order_confirm.ACCOUNT_ID
              
                AND MONTH(order_confirm.TGL_CONFIRM) = '$mon'	       
	        GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2 ORDER BY order_confirm.Id DESC LIMIT 1000;";			



$hasil = mysqli_query($mysqli, $sql);
$jumlah_total = 0;
$jumlah_total2 = 0;


$results = array();

foreach($hasil as $row){

    $results[] = array(
        'TGL_CONFIRM'=> $row[TGL_CONFIRM],
        'NAMA' => $row[NAMA],
        'KOTA' => $row[KOTA],
        'SBG' => $row[SBG],
        'CATATAN2' => $row[CATATAN2],
        'ID_ORDER' => $row[ID_ORDER],
        'ACC_ID' => $row[ACCOUNT_ID],
        'TGL_ORDER' => $row[TGL_ORDER],
        'total' => $row[total],
        'USERID' => $row[USERID],
        'FLAG' => $row[FLAG],
        'jml_confirm' => $row[jml_confirm],
        'ID_ORDER' => $row[ID_ORDER],
		'TGL_D'=> $row[TGL_D],



    );
}

$json = json_encode($results);

echo $json;


/*


                     $sql3 = "SELECT order_confirm.TGL_CONFIRM,
                             DATE(order_confirm.TGL_CONFIRM) AS TGL_D,
                     user.NAMA,
                     user.KOTA,
                     order_confirm.ACCOUNT_ID,
                     order_confirm.CATATAN2,
                     order_confirm.SBG,
                     SUM(order_confirm.JML_ORDER) AS jml_confirm
                     FROM order_confirm,`user`
                     WHERE DATE(order_confirm.TGL_CONFIRM) <= '$today_database'
                     AND order_confirm.ACCOUNT_ID = user.ACCOUNT_ID
                     GROUP BY order_confirm.ACCOUNT_ID,order_confirm.CATATAN2
                     ORDER BY order_confirm.TGL_CONFIRM DESC";


            $hasil3 = mysqli_query($mysqli, $sql3);
            $jumlah_total2 = 0;
            $kunam = 0;
            $kunam2 = 0;
            while($data3 = mysqli_fetch_assoc($hasil3)){

                $total_groping = number_format($data3['jml_confirm']);



                echo "<tr>";
                echo "<td align='center'>$data3[TGL_CONFIRM]</td>";
                echo "<td align='center'>$data3[NAMA]</td>";
                echo "<td align='center'>$data3[KOTA]</td>";
                echo "<td align='center'>$data3[SBG]</td>";
                echo "<td align='center'>$data3[CATATAN2]</td>";



                    echo "<td align='right'><a
            href='detail_konfirmasi.php?ID=$data3[ACCOUNT_ID]&NAMA=$data3[NAMA]&KOTA=$data3[KOTA]&USERID=$data3[ID]&JOS=4&TGL_D=$data3[TGL_D]'
                    style='text-decoration:none;' data-ajax='false' target='_parent'>$total_groping</a></td>";

                echo "</tr>";
                $kunam = $kunam + $data3['jml_confirm'];
                $kunam2 = number_format($kunam);
            }*/




?>