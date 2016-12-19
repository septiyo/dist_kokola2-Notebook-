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
	  
	  SIS();
	  persen2();
	//var mik = (-100) + (-15);
	//alert (mik);
	
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
	
	var per2=0;		
	$('.persen2').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();
       var tot1 = $(this).parents('tr').find('.sump').text();
       var tot2 = $(this).parents('tr').find('.realzx').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    per2 = parseFloat((tot2/tot1)*100).toFixed(2); 
		//if (per2 >= 0) {
		//$(this).parents('tr').find('.persen2').text(per2+' %');
		//}
		if (per2 == 'Infinity')
		{
			$(this).parents('tr').find('.persen2').text('0 %');
			}
			else if (per2 == 'NaN')
		{
			$(this).parents('tr').find('.persen2').text('0 %');
			}
			else {
			$(this).parents('tr').find('.persen2').text(per2+' %');
			}
		
    })
	
	var per3=0;		
	$('.persen3').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();
       var tot1 = $(this).parents('tr').find('.realzx').text();
       var tot2 = $(this).parents('tr').find('.kjd').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    per3 = parseFloat((tot1/tot2)*100).toFixed(2);
		if (per3 == 'Infinity') { 
		$(this).parents('tr').find('.persen3').text('0 %');	
		}
		else {
		$(this).parents('tr').find('.persen3').text(per3+' %');
		}
		    
    })
	
	
	
	/////////////////////////batas sisa
	var sis1=0;		
	$('.sisa1').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();
       var tot1 = $(this).parents('tr').find('.kjd').text();
       var tot2 = $(this).parents('tr').find('.sump').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    sis1 = parseFloat(tot2-tot1); 
		$(this).parents('tr').find('.sisa1').text(sis1);
		    
    })
	
	var sis2=0;		
	$('.sisa2').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();
       var tot1 = $(this).parents('tr').find('.sump').text();
       var tot2 = $(this).parents('tr').find('.realzx').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    sis2 = parseFloat(tot2-tot1); 
		$(this).parents('tr').find('.sisa2').text(sis2);
		    
    })
	
	var sis3=0;		
	$('.sisa3').each(function(){
		//var sil =  $(this).parents('td').find('#sol').val();

       var tot1 = $(this).parents('tr').find('.kjd').text();
       var tot2 = $(this).parents('tr').find('.realzx').text();
      // $(this).find('td:eq(1)').text((tot2/tot1)*100) parseFloat("123.456").toFixed(2);   
	    sis3 = parseFloat(tot2-tot1); 
		$(this).parents('tr').find('.sisa3').text(sis3);
		    
    })
	
}

function persen2() {
	var persis1=0;		
       var tot1 = $('#sumkj').text();
       var tot2 = $('#sumpo').text();
	    persis1 = parseFloat((tot2/tot1)*100).toFixed(2); 
		$('#persis1').text(persis1+' %');
		
		
		var persis2=0;		
       var tot1 = $('#sumpo').text();
       var tot2 = $('#realzx2').text();
	    persis2 = parseFloat((tot2/tot1)*100).toFixed(2); 
		if (persis2 == "NaN"){
		$('#persis2').text('0 %');
		}
		else
		{
		$('#persis2').text(persis2+' %');
		}
		
		var persis3=0;		
       var tot1 = $('#realzx2').text();
       var tot2 = $('#sumkj').text();
	    persis3 = parseFloat((tot1/tot2)*100).toFixed(2);
		if (persis3 == "NaN"){
		$('#persis3').text('0 %');
		}
		else
		{
			$('#persis3').text(persis3+' %');
			}
    
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

function SIS(){
	var sisa1=0;
	var sisa2=0;
	var sisa3=0;
	$('td.sisa1').each(function() { 	
            sisa1 += parseFloat($(this).text());			                     
    }); 
	$('td.sisa2').each(function() { 	
            sisa2 += parseInt($(this).text());			                     
    });
	$('td.sisa3').each(function() { 	
            sisa3 += parseInt($(this).text());			                     
    });
	
	
	 $('#sis1').html(sisa1);
	  $('#sis2').html(sisa2);
	   $('#sis3').html(sisa3);
	
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
          <th>% (PO/KJ)</th>
          <th>% (REAL/PO)</th>
          <th>% (REAL/KJ)</th>
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
	<td align='right' class='sisa1'>0</td>
	<td align='right' class='sisa2'>0</td>
	<td align='right' class='sisa3'>0</td>
	<td align='right' class='persen1'>0</td>
	<td align='right' class='persen2'>0</td>
	<td align='right' class='persen3'>0</td>
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
<td align="right" id="sis1"></td>
<td align="right" id="sis2"></td>
<td align="right" id="sis3"></td>
<td align="right" id="persis1"></td>
<td align="right" id="persis2"></td>
<td align="right" id="persis3"></td>
</tr>
</table>
</body>
</html>