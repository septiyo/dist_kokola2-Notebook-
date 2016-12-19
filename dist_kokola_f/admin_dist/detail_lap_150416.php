
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
//$poku = $_GET['POKU'];



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

 $sqlshow = "select * from (select GG.*, HH.QTY_PO, HH.QTY_PO - GG.TARGET as SISA1, 
          GG.qty - HH.QTY_PO as SISA2, GG.qty - GG.TARGET as SISA3
          from  (select YY.TANGGAL, YY.ACCOUNT_ID, YY.ITEM_CODE, YY.ICOD,
          YY.qty, ZZ.TARGET, ZZ.NAMA_PRODUK 
          from 
          (select max(date(BB.periode2)) as TANGGAL, BB.ACCOUNT_ID, 
          AA.ITEM_CODE, BB.item_code as ICOD, BB.qty 
         from m_produk as AA, order_kirim as BB 
         where AA.ITEM_CODE = BB.item_code and 
         AA.KET = 'Festive' 
          group by AA.ITEM_CODE, BB.ACCOUNT_ID) as YY
          right join kj_f as ZZ on YY.ACCOUNT_ID = ZZ.ACCOUNT_ID and 
          YY.ITEM_CODE = ZZ.ITEM_CODE ) as GG          
          left join        
         ( select TGL_ORDER, ITEM_CODE as ICOD_ORDER, ACCOUNT_ID as ID_ORDER_ACCOUNT,
          SUM(JML_ORDER) as QTY_PO from
           order_confirm where FESTIVE = '1' group by ITEM_CODE, ACCOUNT_ID) as HH
           on GG.ACCOUNT_ID = HH.ID_ORDER_ACCOUNT and
           GG.ITEM_CODE = HH.ICOD_ORDER)as NM where NM.ACCOUNT_ID = '$bj' 
		   and NM.qty IS NOT NULL";
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
        $ixx = $datashow ['ITEM_CODE'];
		$iss = $datashow ['NAMA_PRODUK'];
		$kj = $datashow ['TARGET'];
		$po = $datashow ['QTY_PO'];
		$real = $datashow ['qty'];
		$sisa1 = $datashow ['SISA1'];
		$sisa2 = $datashow ['SISA2'];
		$sisa3 = $datashow ['SISA3'];
echo "<tr class='LJ'>
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