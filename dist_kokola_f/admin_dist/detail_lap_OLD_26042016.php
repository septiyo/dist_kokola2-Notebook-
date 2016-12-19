
  <script src="themeku/jquery.js"></script>
  
  <style>
  * {
      font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
    }
  table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}
  
  th {
    background-color: #4CAF50;
    color: white;
}
  
  tr:nth-child(even) {background-color: #D8F3D8}
  tr.LJ:hover {background-color: #F9CDCE}
  </style>
<script>
$(document).ready(function () {
	
	$("#KL").click(function() {
	var win = window.open('', '_self');
	win.close();
	return false;
     
	});//window.open ( "detail_cf.php?INK="+DIST, "MyWindow", 'width=800, height=500, top=80, left=200')	
	
        });
</script>
<div align="center"><input type="submit" id="KL" value="CLOSE"></div>
<!--<a href="#" onclick="javascript:var win = window.open('', '_self');win.close();return false;">Close</a>-->

<?php
include "../koneksi.php";
$bj = $_GET['INK'];
$poku = $_GET['POKU'];



 $sqlshow9 = "select * from push_distributor where ACCOUNT_ID = '$bj';";
		$queryshow9=mysqli_query($mysqli, $sqlshow9);
$datashow9=mysqli_fetch_array($queryshow9);
        $namaae = $datashow9 ['ACCOUNT_NAME'];
		
//echo "<strong>NO. PO : ".$poku."</strong><br>";
echo "<strong>NAMA DISTRIBUTOR : ".$namaae."</strong>";

?>
<br>
<table border='0' cellspacing="0" cellpadding="3" width="100%" >
<tr>
<th >TGL(REAL)</th>
	      <th>CODE</th>
          <th>NAMA ITEM</th> 
          <th>KJ</th>
          <th>PO</th>
          <th>REAL</th>
          <th>SISA 1 (PO-KJ)</th>
          <th>SISA 2 (REAL-PO)</th>
          <th>SISA 3 (REAL-KJ)</th>
          </tr>
<?php


//echo "<br>".$bj;

 $sqlshow = "select *, KM.PO - KM.KJ as SISA1,
            KM.REALX - KM.PO as SISA2,
            KM.REALX - KM.KJ as SISA3 from
        (select * from
         (select * from (       
          select ID as IDNEX, TGL as TGLKU, BULAN_INPUT as BLIN, NAMA_PRODUK as NMPROD,
            ITEM_CODE as ICDS, ACCOUNT_ID as IACIDZ, TARGET as KJ from kj_f where YEAR(TGL) = '$poku' 
            and ACCOUNT_ID = '$bj' ) as SATU 
         left join
           (select FF.id as IDNE, FF.ACCOUNT_ID as ACCID, FF.item_code as ICDX, SUM(FF.qty) as REALX,
             FF.periode2, FF.tgl_upload, FF.maxid from        
            (select * from order_kirim as AA, 
           (select  max(id) as maxid from order_kirim group by ACCOUNT_ID,ITEM_CODE, MONTH(periode2),
             YEAR(periode2) ) as BB 
            where  BB.maxid = AA.id and ACCOUNT_ID = '$bj' and YEAR(periode2) = '$poku') as FF
            group by FF.ACCOUNT_ID, FF.ITEM_CODE,
            YEAR(FF.periode2)) as DUA
            on SATU.IACIDZ = DUA.ACCID and SATU.ICDS = DUA.ICDX) as AWAL
         left join
               (select TGL_ORDER, TGL_CONFIRM, SUM(JML_ORDER) as PO, ACCOUNT_ID , 
               ITEM_CODE , NO_PO from order_confirm
               group by ACCOUNT_ID, YEAR(TGL_CONFIRM), ITEM_CODE) as AKHIR
               on YEAR(AWAL.TGLKU) = YEAR(AKHIR.TGL_CONFIRM)
               and AWAL.ICDS = AKHIR.ITEM_CODE
               and AWAL.IACIDZ = AKHIR.ACCOUNT_ID) as KM";
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
	     $tgls = $datashow ['periode2'];
        $ixx = $datashow ['ICDS'];
		$iss = $datashow ['NMPROD'];
		$kj = $datashow ['KJ'];
		$po = $datashow ['PO'];
		$real = $datashow ['REALX'];
		$sisa1 = $datashow ['SISA1'];
		$sisa2 = $datashow ['SISA2'];
		$sisa3 = $datashow ['SISA3'];
echo "<tr class='LJ'>
     <td>$tgls</td>
	<td>$ixx</td>
	<td>$iss</td>
	<td align='right'>$kj</td>
	<td align='right'>$po</td>
	<td align='right'>$real</td>
	<td align='right'>$sisa1</td>
	<td align='right'>$sisa2</td>
	<td align='right'>$sisa3</td>
	</tr>
	      ";	
		
		
}
?>
</table>