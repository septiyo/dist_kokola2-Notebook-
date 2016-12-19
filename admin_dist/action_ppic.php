<?php
header('Content-Type: application/json');
include "../koneksi.php";
ini_set('display_errors','0');


//echo json_encode('dari sana');


$bulan = $_GET['BULAN'];
$tahun = $_GET['TAHUN'];

//$bulan = $sono['bulan'];



if($tahun == "2016"){



$sql = "SELECT
             `push_distributor`.`ACCOUNT_NAME` AS NAMA,
            m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  SUM(forecast.BULAN1) AS BULAN1,
                  SUM(forecast.BULAN2) AS BULAN2,
                  SUM(forecast.BULAN3) AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish
                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE
                   LEFT JOIN `push_distributor`
                   ON `forecast`.`ACCOUNT_ID` = `push_distributor`.`ACCOUNT_ID`

                   WHERE TRIWULAN = '$bulan'
            AND forecast.`publish` = '1'

                   GROUP BY   m_produk.NAMA_PRODUK

                   ORDER BY NAMA ASC;";
}
else{
	
	$sql = "SELECT
             `push_distributor`.`ACCOUNT_NAME` AS NAMA,
            m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  SUM(forecast.BULAN1) AS BULAN1,
                  SUM(forecast.BULAN2) AS BULAN2,
                  SUM(forecast.BULAN3) AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish
                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE
                   LEFT JOIN `push_distributor`
                   ON `forecast`.`ACCOUNT_ID` = `push_distributor`.`ACCOUNT_ID`

                   WHERE TRIWULAN = '$bulan'
            AND forecast.`publish` = '1'
			AND forecast.TAHUN_INPUT = '$tahun'

                   GROUP BY   m_produk.NAMA_PRODUK

                   ORDER BY NAMA ASC;";
	
	
	}

//echo json_encode($sql);AND m_produk.KATEGORI = '$kategori'

//WHERE MONTH(forecast.TGL) = '".$bulan."'

//exit();






$hasil = mysqli_query($mysqli, $sql);

//$data = mysqli_fetch_assoc($hasil);

foreach($hasil as $row){

    $jos[] = array(
        'NAMA' => $row[NAMA],
        'BULAN_INPUT' => $row[BULAN_INPUT],
        'TRIWULAN' => $row[TRIWULAN],
        'KATEGORI' => $row[KATEGORI],
        'BULAN_INPUT' => $row[BULAN_INPUT],
        'NAMA_PRODUK' => $row[NAMA_PRODUK],
        'BULAN1' => $row[BULAN1],
        'BULAN2' => $row[BULAN2],
        'BULAN3' => $row[BULAN3]

    );

};

echo json_encode($jos);










?>