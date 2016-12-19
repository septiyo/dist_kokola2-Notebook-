<?php


    print_r($_POST);
	//$produk = $_POST[PRODUK];
       // $id_jos      = $_POST[ID_JOS];
        $produk      = $_POST['PRODUK'];
        $harga       = $_POST['HARGA'];
        $bulan_akhir = $_POST['bln_akhir'];
        $forecast    = $_REQUEST['FORECAST'];
        $persen      = $_POST['PERSEN'];
        $bulan1      = $_POST['BULAN1'];
        $bulan2      = $_POST['BULAN2'];
        $bulan3      = $_POST['BULAN3'];
        $total_value = $_POST['TOTAL_VALUE'];
		
		$id = $_POST['ID'];
		$item_code = $_POST['ITEM_CODE'];
		
        $jumlah_forcast = count($forecast);
		echo $jumlah_forcast;
		exit;
		//echo $jumlah_forcast;
        $n = 0;
        while ($n < $jumlah_forcast) {
            if($forecast[$n] != "") {
                date_default_timezone_set("Asia/Jakarta");
                $month = date('M');
              	/*cari produk*/
                /*$sql_cari_produk_id = "SELECT ID,ITEM_CODE FROM m_produk WHERE NAMA_PRODUK LIKE '%$produk[$n]%'";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                $data_id = mysqli_fetch_assoc($hasil_cari_produk_id);
                $id = $data_id['ID'];
				$item_code = $data_id['ITEM_CODE'];*/
				
                $sql_kj = "INSERT INTO kj SET  TGL = '$tanggal',
					TRIWULAN = '$_SESSION[TRIWULAN]',
					BULAN_INPUT = '$month',
					NAMA_DIST = '$_SESSION[USER]',
					ID_PRODUK = '$id[$n]',
					NAMA_PRODUK = '$produk[$n]',
					ITEM_CODE = '$item_code[$n]',
					DAERAH     = '$_SESSION[KOTA]',
					HARGA = '$harga[$n]',
					BLN_AKHIR = '$bulan_akhir[$n]',
					FORECAST = '$forecast[$n]',
					PERSEN   = '$persen[$n]',
					BULAN1   = '$bulan1[$n]',
					BULAN2   = '$bulan2[$n]',
					BULAN3   = '$bulan3[$n]',
					TOTAL_VALUE    = '$total_value[$n]',
					SET_BLN1 = 'ISI',
					ACCOUNT_ID = '$_SESSION[ACCOUNT_ID]'";
                
				//echo $sql_kj;

                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);
            }
            $n++;
        }
		
        if ($hasil_input_kj) {
            //echo "input Barhasil";
            echo "<script>alert('Input Barhasil');
                          window.location='dist.php';
                  </script>";
           // header("Location: dist_forcest_next.php?TRI=$_SESSION[TRIWULAN]");
        } else {
            //echo "input gagal";
            echo "<script>alert('Input Gagal, Harap Coba lagi..!');window.location='dist_forcast.php';</script>";
        }
    }


?>