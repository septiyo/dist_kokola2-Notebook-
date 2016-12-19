<?php
error_reporting (0);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');




// create new PDF document
include "koneksi.php";

$bulan=$_GET['TRI'];
$acc_id=$_GET['ACC'];
$tgl = $_GET['TGL'];
$tahun = $_GET['TAHUN'];

if($tahun == "2016")
{
 $sql = "SELECT
             `push_distributor`.`ACCOUNT_NAME` AS NAMA,
            m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  forecast.BULAN1 AS BULAN1,
                  forecast.BULAN2 AS BULAN2,
                  forecast.BULAN3 AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish,
                  forecast.TAHUN_INPUT
                   
                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE
                   LEFT JOIN `push_distributor`
                   ON `forecast`.`ACCOUNT_ID` = `push_distributor`.`ACCOUNT_ID`

                   WHERE TRIWULAN = '$bulan'
                   AND forecast.ACCOUNT_ID = '$acc_id'
                   AND forecast.TGL = '$tgl'
                   AND forecast.`publish` = '1'
                 
			
                   ORDER BY NAMA ASC;";
}
else{
	
	 $sql = "SELECT
             `push_distributor`.`ACCOUNT_NAME` AS NAMA,
            m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  forecast.BULAN1 AS BULAN1,
                  forecast.BULAN2 AS BULAN2,
                  forecast.BULAN3 AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish,
                  forecast.TAHUN_INPUT
                   
                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE
                   LEFT JOIN `push_distributor`
                   ON `forecast`.`ACCOUNT_ID` = `push_distributor`.`ACCOUNT_ID`

                   WHERE TRIWULAN = '$bulan'
                   AND forecast.ACCOUNT_ID = '$acc_id'
                   AND forecast.TGL = '$tgl'
                   AND forecast.`publish` = '1'
                   AND forecast.`TAHUN_INPUT` = '$tahun'
			
                   ORDER BY NAMA ASC;";
	
	}

	
	//if($tahun == ""){
		/*
	   $sql = "SELECT
             `push_distributor`.`ACCOUNT_NAME` AS NAMA,
            m_produk.NAMA_PRODUK,
                   m_produk.ITEM_CODE,
                   m_produk.KATEGORI,
                  forecast.BULAN1 AS BULAN1,
                  forecast.BULAN2 AS BULAN2,
                  forecast.BULAN3 AS BULAN3,
                   forecast.BULAN_INPUT,
                   forecast.TRIWULAN,
                   forecast.publish
                   FROM forecast
                   LEFT JOIN m_produk
                   ON m_produk.ITEM_CODE=forecast.ITEM_CODE
                   LEFT JOIN `push_distributor`
                   ON `forecast`.`ACCOUNT_ID` = `push_distributor`.`ACCOUNT_ID`

                   WHERE TRIWULAN = '$bulan'
                   AND forecast.ACCOUNT_ID = '$acc_id'
                   AND forecast.TGL = '$tgl'
                   AND forecast.`publish` = '1'
				    AND forecast.TAHUN_INPUT = '$tahun'
			
                   ORDER BY NAMA ASC;";*/

	
	

$hasil = mysqli_query($mysqli, $sql);



$sql_total = "SELECT
                  SUM(forecast.BULAN1) AS BULAN1,
                  SUM(forecast.BULAN2) AS BULAN2,
                  SUM(forecast.BULAN3) AS BULAN3
                   FROM `forecast`
                   WHERE TRIWULAN = '$bulan'
                    AND forecast.ACCOUNT_ID = '$acc_id'
                      AND forecast.TGL = '$tgl'
                     AND forecast.`publish` = '1';";
$hasil_total = mysqli_query($mysqli, $sql_total);
$data_total = mysqli_fetch_assoc($hasil_total);



$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
// $pdf->AddPage();


// landscape
$pdf->addPage();

//'.$data[no_suratfull].'

$html .='<h2>Forecast "'.$bulan.'&nbsp;'.$tahun.'"</h2> <br><br>';

$html .='<table border="1" cellspacing="0" cellpadding="4">
          <tr>
             <th align="center"><h4>Distributor</h4></th>
             <th align="center"><h4>Kategori</h4></th>
             <th align="center"><h4>Item</h4></th>
             <th align="center"><h4>Bulan 1<br>(KJ)</h4></th>
             <th align="center"><h4>Bulan 2</h4></th>
             <th align="center"><h4>Bulan 3</h4></th>
         </tr>';

        while($data=mysqli_fetch_assoc($hasil)){

            $html .='<tr>
             <td>'.$data[NAMA].'</td>
             <td>'.$data[KATEGORI].'</td>
             <td>'.$data[NAMA_PRODUK].'</td>
             <td align="right">'.$data[BULAN1].'</td>
             <td align="right">'.$data[BULAN2].'</td>
             <td align="right">'.$data[BULAN3].'</td>
             </tr>';

        }//end while

$html .='<tr>
             <th colspan="3" align="center"><b>Total</b></th>
             <th align="right"><h4>'.$data_total[BULAN1].'</h4></th>
             <th align="right"><h4>'.$data_total[BULAN2].'</h4></th>
             <th align="right"><h4>'.$data_total[BULAN3].'</h4></th>
         </tr>';


$html.='</table>';


$html.='<table border="1" cellspacing="0" cellpadding="0">
          <tr>
             <td align="center">
                 <br><br><br><br><br>
                    DBDL
             </td>
             <td align="center">
                    <br><br><br><br><br>
                   Owner / OM / Spv.Distributor

             </td>
          </tr>

        </table>';



$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Print_forecast', 'I');


//<table border="1" cellspacing="0" cellpadding="0">
//                   <tr valign="bottom">
//                     <td>
//
//                     </td>
//                   </tr>
//                </table>
?>