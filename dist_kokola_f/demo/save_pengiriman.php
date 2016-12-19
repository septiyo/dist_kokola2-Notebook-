<?php
error_reporting (0);
include "koneksi.php";
	if (isset($_POST['SAVE'])) {
		//$produk = $_POST[PRODUK];
       // $id_jos      = $_POST[ID_JOS];
	   // date_default_timezone_set("Asia/Jakarta");
	   		    $tanggal = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s'); 
		
	    $accid          = $_POST['ACCID'];
	    $tgl            = $_POST['TANGGAL'];
		$periode1       = $yearku.'-'.$bulanku.'-01';
		
	    $bln            = 'January';
	    $kus            = $_POST['KUS'];
	    $nmbarang       = $_POST['BARANG'];
        $produk         = $_POST['PRODUK1'];
        $jumlah_forcast = count($produk);
		//$jumlah_qty = count($produk);
		//echo $jumlah_forcast;
        $n = 0;
        while ($n < $jumlah_forcast) {
            if($produk[$n] != "") {
               

				
                $sql_kj = "INSERT INTO order_kirim_wd SET  account_id  = '$accid[$n]',
				                                         item_code  = '$kus[$n]',
				                                         qty        = '$produk[$n]',
				                                         periode1   = '$periode1',
														 periode2   = '$tgl[$n]',
				                                         tgl_upload = '$tanggal $wkt'";
                $hasil_input_kj = mysqli_query($mysqli, $sql_kj);
            }
            $n++;
        }
		if ($hasil_input_kj) {
            //echo "input Barhasil";	
			echo "<script>alert('Input Barhasil');
                          window.location='report_kirim_now.php';
                  </script>"; }		
          //  echo $sql_kj; }
			else
			{  echo $sql_kj;}
	}
?>