
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
<th >TGL</th>
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

 $sqlshow = " select *, SATU.JML_ORDER - DUA.TARGET as SISA1 ,
             DUA.QTK_OK - SATU.JML_ORDER as SISA2,
             DUA.QTK_OK - DUA.TARGET as SISA3
          from (select ACCOUNT_ID as ACCID, ITEM_CODE as ICD, SUM(JML_ORDER) as JML_ORDER,
           YEAR(TGL_CONFIRM) as TC  
            from order_confirm  group by  ACCOUNT_ID and YEAR(TGL_ORDER) and YEAR(TGL_ORDER) = '$poku') 
             as SATU,        
            (select * from (select * from 
            (select TGL,BULAN_INPUT, ACCOUNT_ID as AID, TARGET, 
            ITEM_CODE as ICOD, NAMA_PRODUK  from kj_f) as KJ
        left join      
        (select sum(KH.qty) as QTK_OK, KH.ACCOUNT_ID, KH.periode2,
          KH.item_code from
        (select OL.* from  (select * from order_kirim order by id asc) as OL 
        group by MONTH(OL.periode2),YEAR(OL.periode2))as KH 
        group by YEAR(KH.periode2), KH.ACCOUNT_ID, KH.item_code) as OK
        on KJ.AID = OK.ACCOUNT_ID and YEAR(KJ.TGL) = YEAR(OK.periode2)
           and KJ.ICOD = OK.item_code) as LL where  LL.AID = '$bj' and  YEAR(LL.TGL) = '$poku')
           as DUA
           where SATU.ACCID = DUA.AID and SATU.ICD = DUA.ICOD;";
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
	     $tgls = $datashow ['periode2'];
        $ixx = $datashow ['ICOD'];
		$iss = $datashow ['NAMA_PRODUK'];
		$kj = $datashow ['TARGET'];
		$po = $datashow ['JML_ORDER'];
		$real = $datashow ['QTK_OK'];
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