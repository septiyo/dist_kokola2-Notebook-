<?php

require_once("koneksi.php");

if (isset($_GET['id'])) {
    $accid = $_GET['id'];
    $view = "";
    // $accid = $_SESSION['ACCOUNT_ID'];	
    //date_default_timezone_set("Asia/Jakarta");
    $tgl = date('Y') . "-" . date('m') . "-" . date('d');
    $yearku = date('Y');
    $bulanku = date('m');
    $wkt = date('H:i:s');
    $thn_dpn = date('Y', strtotime('+1 years', strtotime($tgl)));
    $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulanku, 2016);
    if ($bulanku == '01' or $bulanku == '02' or $bulanku == '03') {
        $triwulan = 'Jan-Feb-Mar';
    } elseif ($bulanku == '04' or $bulanku == '05' or $bulanku == '06') {
        $triwulan = 'Apr-May-Jun';
    } elseif ($bulanku == '07' or $bulanku == '08' or $bulanku == '09') {
        $triwulan = 'Jul-Aug-Sep';
    } elseif ($bulanku == '10' or $bulanku == '11' or $bulanku == '12') {
        $triwulan = 'Oct-Nov-Dec';
    }


    $sql = "select * from ( select * from  (select ITEM_CODE as ICOD,ID as ID_PROD from m_produk)as ZZ right join 
		order_kirim_wd  on order_kirim_wd.item_code = ZZ.ICOD) as LL where LL.ACCOUNT_ID = '" . $accid . "' group by item_code;";

    $query = mysqli_query($mysqli, $sql);



    $no = 1;

    while ($data = mysqli_fetch_array($query)) {
        $nmb3 = $data['ICOD'];

        $sql2 = "Select * from (select AA.ITEM_CODE,AA.ID,AA.NAMA_PRODUK, BB.ID_PRODUK, BB.BULAN1, BB.BULAN2,BB.ACCOUNT_ID,
				BB.BULAN3,BB.NAMA_DIST, BB.TGL,BB.THN, BB.BULAN_INPUT as BLI, BB.KU, BB.TRIWULAN
				from (select ID, NAMA_PRODUK, ITEM_CODE from m_produk)as AA right 
				join (select ACCOUNT_ID, ID as KU, BULAN_INPUT,Month(TGL) as TGL,
				YEAR(TGL) as THN,ID_PRODUK, BULAN1,BULAN2,BULAN3, NAMA_DIST, TRIWULAN, ITEM_CODE  from kj WHERE STATUS_APR='1' AND publish='1') as BB on AA.ITEM_CODE = BB.ITEM_CODE) as MM 
				where MM.ACCOUNT_ID = '" . $accid . "' and MM.THN = '" . $yearku . "'  and MM.TRIWULAN ='" . $triwulan . "' and MM.ITEM_CODE = '" . $nmb3 . "'";
        //and MM.TGL = '$bulanku'= penggalan query
        $query2 = mysqli_query($mysqli, $sql2);

        while ($data2 = mysqli_fetch_array($query2)) {
            $bli = $data2['BLI'];
            //detect bulan
            if ($bulanku == "01") {
                $bulanku9 = $data2['BULAN1'];
            } elseif ($bulanku == "02") {
                $bulanku9 = $data2['BULAN2'];
            } elseif ($bulanku == "03") {
                $bulanku9 = $data2['BULAN3'];
            } elseif ($bulanku == "04") {
                $bulanku9 = $data2['BULAN1'];
            } elseif ($bulanku == "05") {
                $bulanku9 = $data2['BULAN2'];
            } elseif ($bulanku == "06") {
                $bulanku9 = $data2['BULAN3'];
            } elseif ($bulanku == "07") {
                $bulanku9 = $data2['BULAN1'];
            } elseif ($bulanku == "08") {
                $bulanku9 = $data2['BULAN2'];
            } elseif ($bulanku == "09") {
                $bulanku9 = $data2['BULAN3'];
            } elseif ($bulanku == "10") {
                $bulanku9 = $data2['BULAN1'];
            } elseif ($bulanku == "11") {
                $bulanku9 = $data2['BULAN2'];
            } elseif ($bulanku == "12") {
                $bulanku9 = $data2['BULAN3'];
            }

            $uu = $data2['ID'];
            $bulanj = '899';

            //ganti	
            $view.='<div data-role="collapsible" data-filtertext="' . $data2['NAMA_PRODUK'] . '" data-collapsed="true">';
            $view.='<h3>' . $data2['NAMA_PRODUK'] . '</h3>'
                    . '<ul data-role="listview" data-inset="false">';

            $view.='<li>
					<div class="ui-grid-a">
					<div class="ui-block-a">Jumlah KJ :</div>
					<div class="ui-block-b"><strong>' . $bulanku9 . '</strong>
					</div>
					</div>
					</li>';
            /*
              echo "<tr>

              <td>
              $data2[NAMA_PRODUK]
              </td>
              <td align='center' class='totkj'>$bulanku9</td>
              <td align='center' class='rowtot'></td>
              ";
             */
            $sql9 = "select ACCOUNT_ID, day(periode2) as tglx from order_kirim_wd where  ACCOUNT_ID = '" . $accid . "' 
					and month(periode2) ='" . $bulanku . "' and year(periode2) = '" . $yearku . "' group by tglx";
            $query9 = mysqli_query($mysqli, $sql9);
            $total_kirim = 0;
            while ($data9 = mysqli_fetch_array($query9)) {
                //tanggal kirim    
                $smk = $data9['tglx'];
                //for($i=0; $i<$jumHari; $i++)
                //{
                //$k = $i+1 ;

                $sql_absen = "select id, ACCOUNT_ID, item_code,qty, tgl_upload, DAY(periode2) as tglku from order_kirim_wd where  ACCOUNT_ID = '" . $accid . "' 
								and DAY(periode2) = '" . $smk . "' and month(periode2) ='" . $bulanku . "' and year(periode2) = '" . $yearku . "' and item_code = '" . $data['item_code'] . "'";
                $queryabsen = mysqli_query($mysqli, $sql_absen);
                $jml_absen = mysqli_num_rows($queryabsen);
                if ($dataabsen = mysqli_fetch_array($queryabsen)) {
                    $coba = $dataabsen['qty'];
                    $total_kirim+=$dataabsen['qty'];
                    $uup = number_format($coba);
                    $idku = $dataabsen['id'];
                    $tng = $dataabsen['tglku'];
                    $view.='<li>
							  <div class="ui-grid-a">
							  <div class="ui-block-a">Tgl ' . $tng . ' Kirim :</div>
							  <div class="ui-block-b"><strong>' . $coba . '</strong>
							  </div>
							  </div>
							  </li>';
                    /*
                      echo "<td  style='min-width:30px' align='center' >
                      <a href='#data-popup' class='update-data' style='text-decoration:none' id='b1' data-rel='popup' data-position-to='window' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a' data-transition='slideup' data-mini ='true'><input type='hidden'  id='sol' value='$coba'><input type='hidden'
                      id='tol' class='MINS' value='$idku'>
                      <input type='hidden'  id='accidku' value='$accid'><input type='hidden'  id='tng' value='$tng'>
                      <input type='hidden' class='rowDataSd' value='$uup'>$uup</a>
                      </td>";
                     */
                } else {
                    //echo "<td ><input type='hidden' class='rowDataSd' value='0'></td>";
                }
            } //end for
            //echo "</tr>";
            $view.='<li>';
            if ($total_kirim < $bulanku9) {
                $view.='<div class="ui-grid-a" style="color:red;">';
            } else {
                $view.='<div class="ui-grid-a" style="color:black;">';
            }
            $view.='<div class="ui-block-a">Jumlah Kirim :</div>
				  <div class="ui-block-b" style="font-size:20px;"><b>' . $total_kirim . '</b>
				  </div>
				  </div>
				  </li>';
            $view.='</ul>
				</div>';

            //red#FF4E4E hiju #A9FF53 kng orng #FFD220 hju toska #2AF4D5 biru#67DAFF
        }/////akhir queery nm barang
        $no++;
    }

    $jml = 0;
    $sql_cari_isi = "SELECT * FROM kj WHERE TRIWULAN = '" . $triwulan . "' AND NAMA_DIST= '" . $accid . "' "
            . "AND STR_TO_DATE(TGL, '%Y')=STR_TO_DATE(NOW(), '%Y') AND STATUS_APR='1'";
    $hasilxx = mysqli_query($mysqli, $sql_cari_isi);

    foreach ($hasilxx as $row) {
        $jml++;
    }


    $view.="<input type='hidden' id='status' value='" . $jml . "'>";
    echo $view;
}
?>

