<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<title>FESTIVE REAL</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="language" content="en-us" />
<head>
  <script src="themeku/jquery.js"></script>
  
  <style>
  * {
      font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	  font-size:14px;
    }
  table, td, th {    
    border: 1px solid #ddd;
    /*text-align: left;*/
}

table {
    border-collapse: collapse;
    width: 100%;
}
  
  th {
    background-color: #4CAF50;
    color: white;
}
#MONOKA {background-color: #C7C6FF }
  
  tr:nth-child(even) {background-color: #D8F3D8}
  tr.LJ:hover {background-color: #F9CDCE}
  </style>
<script>
$(document).ready(function () {
	
	  colSum();
	  persen1();
	
	$("#KL").click(function() {
	var win = window.open('', '_self');
	win.close();
	return false;
     
	});//window.open ( "detail_cf.php?INK="+DIST, "MyWindow", 'width=800, height=500, top=80, left=200')	
	
	
	
        });



function persen1() {
	var per=0;		
	$('.persen1').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();
       var tot1 = $(this).parents('tr').find('.kjd').text();
       var tot2 = $(this).parents('tr').find('.sump').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    per = parseFloat((tot2/tot1)*100).toFixed(2); 
		$(this).parents('tr').find('.persen1').text(per+' %');
		    
    })
}



function colSum() {
    var sum=0;
	var sumpo=0;
	var sumpoku=0;
    //iterate through each input and add to sum
    $('td.kjd').each(function() {     
            sum += parseInt($(this).text());                     
    }); 
	$('td.sump').each(function() { 	
            sumpo += parseInt($(this).text());			                     
    }); 
	$('td.realzx').each(function() { 	
            sumpoku += parseInt($(this).text());			                     
    }); 
    //change value of total
    $('#sumkj').html(sum);
	$('#sumpo').html(sumpo);
	$('#realzx2').html(sumpoku);
}
</script>
</head>
<body>
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
echo "<strong>NAMA ACCOUNT : ".$namaae."</strong>";

?>
<br>
<table border='0' cellspacing="0" cellpadding="3" width="100%" >
<tr>
<!--<th >TGL(REAL)</th>-->
	      <th>CODE</th>
          <th>NAMA ITEM</th> 
          <th>KJ</th>
          <th>PO</th>
          <th>REAL</th>
          <th>SISA 1 (PO-KJ)</th>
          <th>SISA 2 (REAL-PO)</th>
          <th>SISA 3 (REAL-KJ)</th>
          <th>% (PO - KJ)</th>
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
		if ($po == "") 
		{ $po = "0";  }
		else { $po = $datashow ['PO']; }
		$real = $datashow ['REALX'];
		if ($real == "") 
		{ $real = "0";  }
		else { $real = $datashow ['REALX']; }
		$sisa1 = $datashow ['SISA1'];
		$sisa2 = $datashow ['SISA2'];
		$sisa3 = $datashow ['SISA3'];
echo "<tr class='LJ'>
     
	<td>$ixx</td>
	<td>$iss</td>
	<td align='right' class='kjd'>$kj</td>
	<td align='right' class='sump'>$po</td>
	<td align='right' class='realzx'>$real</td>
	<td align='right'>$sisa1</td>
	<td align='right'>$sisa2</td>
	<td align='right'>$sisa3</td>
	<td align='right' class='persen1'>0</td>
	</tr>
	      ";	
		
		
}
?>
<tr id="MONOKA">
<td></td>
<td  align="right"> Jumlah :</td>
<td align="right" id="sumkj"></td>
<td align="right" id="sumpo"></td>
<td align="right" id="realzx2"></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</body>
</html>