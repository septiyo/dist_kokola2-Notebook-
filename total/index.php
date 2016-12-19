<?php

error_reporting(0);
include "koneksi.php";

//date_default_timezone_set("Asia/Jakarta");
	   		    $tgl = date('Y')."-".date('m')."-".date('d');
				 $tgl_tampil = date('d')."-".date('M')."-".date('Y');
				///////hari
		$tgl2 = date('Y-m-d', strtotime('-1 days', strtotime( $tgl ))); 
		
		$kemarin = date('D', strtotime('-1 days', strtotime( $tgl ))); 
		$tanggal = '$tgl';
		$tgl_kemarin = '$kemarin';
		
		$hai = date('D');
		
	$day_k = date('D', strtotime($tgl_kemarin));	
    $day = date('D', strtotime($tanggal));
    $dayList = array(
    	'Sun' => 'Minggu',
    	'Mon' => 'Senin',
    	'Tue' => 'Selasa',
    	'Wed' => 'Rabu',
    	'Thu' => 'Kamis',
    	'Fri' => 'Jumat',
    	'Sat' => 'Sabtu'
    );
	$dayList2 = array(
    	'Sun' => 'MINGGU',
    	'Mon' => 'SENIN',
    	'Tue' => 'SELASA',
    	'Wed' => 'RABU',
    	'Thu' => 'KAMIS',
    	'Fri' => 'JUMAT',
    	'Sat' => 'SABTU'
    );
    //echo "Tanggal {$tanggal} adalah hari : " . $dayList[$day]; 
			$tgl_kes = $dayList[$hai]." Tgl ".date('d')." ".date('M')." ".date('Y');
			$tgl_var = $dayList2[$kemarin];
				
				$yearku = date('Y');
				$bulanku = date('m');
				$wkt = date('H:i:s');
				

    ?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
     <!-- <script src="../jqm2/jquery-2.1.4.min.js"></script>
      <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
      <script src="../jqtable/jquery.dataTables.min.js"></script>
      <script src="../jqtable/dataTables.jqueryui.min.js"></script>-->


      
      <style>

</style>
      
  </head>

<body>

               <h1>TOTAL PO HARI INI</h1>
                                 
            <?php 
 $sql_kj2ta = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' group by GG.REGIONAL;";

       // echo $sql_kj2ta;
				 $no = 1;
 $hasil_kj2ta = mysqli_query($mysqli, $sql_kj2ta);
                    while ($data_kj2ta = mysqli_fetch_array($hasil_kj2ta)) {
					$regional = $data_kj2ta['REGIONAL'];
					$forkx = $data_kj2ta['KATEGORI'];
				
					$sisa_target = $data_kj2ta['hasil'];
					$jumtotal = number_format($sisa_target);
				
echo "	                
				 <div>$regional &nbsp;&nbsp;  $jumtotal  &nbsp;&nbsp; terdiri &nbsp;";  
				 //////////////////batas kota

				 $sql_kj2tax = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' AND GG.REGIONAL ='$regional' group by GG.REGIONAL, GG.KOTA;";

          
				 
 $hasil_kj2tax = mysqli_query($mysqli, $sql_kj2tax);
                    while ($data_kj2tax = mysqli_fetch_array($hasil_kj2tax)) {
					$kota = $data_kj2tax['KOTA'];
					
					
				echo "$kota,";	
					
					}
				echo "</div>	" ; /////batas div record
				$no++;
}
			
							  
							  
 $sql_totalku = "select GG.account_id, GG.qty, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH, GG.REGIONAL, GG.KOTA from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL, LL.KOTA from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' ;";

          
			
 $hasil_totalku = mysqli_query($mysqli, $sql_totalku);
                    $data_totalku = mysqli_fetch_array($hasil_totalku);
					$totalkui = $data_totalku['hasil'];
				 echo "<div><span style='font-weight: bold;'>JADI TOTAL PO HARI INI = $totalkui</span></div>";
				 
				 ////////////////batas total
			
			/////////////////////batas report produk
			/* $sql_kj2t = "select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.KATEGORI, GG.TARGET,  GG.TARGET - SUM(GG.qty) as SH from
(select * from 
(select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
 LL.REGIONAL from order_confirm KK, user LL
 where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join (select MP.ITEM_CODE as ii, MP.NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR, KPF.KATEGORI as MN, KPF.TARGET
 from m_produk MP, kategori_produk_fix KPF
where MP.KATEGORI = KPF.KATEGORI) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' group by GG.KATEGORI;";*/
 
  $sql_kj2t = "select *, TARGET - hasil as SH from(
 select GG.account_id, GG.NAMA_PRODUK, SUM(GG.qty) as hasil, GG.item_code,
        GG.KATEGORI 
        from
      (select * from 
          (select KK.ACCOUNT_ID as account_id, KK.ITEM_CODE as item_code , KK.JML_ORDER as qty, DATE(KK.TGL_CONFIRM) as periode2,
            LL.REGIONAL
             from order_confirm KK, user LL
              where KK.ACCOUNT_ID = LL.ACCOUNT_ID ) as CC 
left join 
(select PT.item_code as ii, PT.item_name as NAMA_PRODUK, MP.KATEGORI, MP.GRAMATUR
 from push_item PT
 left join m_produk MP on PT.item_code = MP.ITEM_CODE) as XX
 on XX.ii = CC.item_code) as GG where GG.periode2 = '$tgl' and GG.qty <> 0 group by GG.KATEGORI) as PERTAMA
 left join kategori_produk_fix KEDUA on PERTAMA.KATEGORI = KEDUA.KATEGORI ;";

          echo " <table border='1' cellpadding='3' cellspacing='0'>
		  <tr>
		          <td ><strong>No</strong></td>
				  <td ><strong>Nama Produk</strong></td>
				 <td ><strong>Kategori</strong></td>
				 <td ><span style='font-weight: bold;'>Qty</span></td>
				 <td ><span style='font-weight: bold;'>Target</span></td>
				 <td><span style='font-weight: bold;'>Sisa</span></td>
                 </tr>";
				 $no = 1;
 $hasil_kj2t = mysqli_query($mysqli, $sql_kj2t);
                    while ($data_kj2t = mysqli_fetch_array($hasil_kj2t)) {
					$fork = $data_kj2t['NAMA_PRODUK'];
					$forkx = $data_kj2t['KATEGORI'];
					$qty45 = $data_kj2t['hasil'];
					$target = $data_kj2t['TARGET'];
					
					$sisa_target = $data_kj2t['SH'];
					
					$mui = number_format($qty45);
					///menampilkan dialog	
//echo "<div>$fork || $qty45</div>";
echo "	
                
				 <tr>
				  <td>$no</td>
				  <td>$fork</td>
				 <td>$forkx</td>
				 <td>$mui</td>
				 <td>$target</td>";
				 if ($sisa_target != NULL)
				 {
				echo " <td >-$sisa_target</td>";
				 } 
				
				 else 
				 { echo " <td ></td>";}
		echo "</tr>";
				$no++;
} 
echo "</table>";
?>
                    
                 
   
   
<script>
 $(document).ready(function () {
	
	
 });

	</script>		
</body>
</html>
 <?php

?>