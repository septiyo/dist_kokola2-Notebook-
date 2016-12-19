
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
		
echo "<strong>NO. PO : ".$poku."</strong><br>";
echo "<strong>".$namaae."</strong>";

?>
<br>
<table border='0' cellspacing="0" cellpadding="3" width="100%" >
<tr>
	      <th>TGL. ORDER</th><th>NAMA ITEM</th> <th>QTY</th><th>KUBIKASI</th>
          </tr>
<?php


//echo "<br>".$bj;

 $sqlshow = "select AA.*, BB.item_name from order_confirm as AA, push_item as BB 
where AA.ITEM_CODE = BB.item_code and FESTIVE =  '1' and NO_PO = '$poku' and TUJUAN= '$bj';";
		$queryshow=mysqli_query($mysqli, $sqlshow);
while  	($datashow=mysqli_fetch_array($queryshow)){
        $tgod = $datashow ['TGL_ORDER'];
		$tgcf = $datashow ['TGL_CONFIRM'];
		$itn = $datashow ['item_name'];
		$jmo = $datashow ['JML_ORDER'];
		$kbk = $datashow ['KUBIKASI'];
echo "<tr class='LJ'>
	<td>$tgod</td>
	<td>$itn</td>
	<td align='right'>$jmo</td>
	<td align='right'>$kbk</td>
	</tr>
	      ";	
		
		
}
?>
</table>