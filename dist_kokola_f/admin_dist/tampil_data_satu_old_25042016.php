

<script>				
                $('#cv').DataTable({
					 "dom": '<"toolbar">frtip',
					 fixedColumns:   {
            leftColumns: 2,
            //rightColumns: 1
        },
		
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: false,
	ordering: false,
                  
					filter: false,
        paging:         false
               //"scrollY": 300,
                   // "scrollX": true,
                    /*"scrollY":        "400px",
                     "scrollCollapse": true,*/
                    //"ordering": false,
                   // "paging": false,
					//"filter": false
                });
				$("div.toolbar").html('<b><input type="text" id="cari" placeholder="Cari data"></b>');
				
				$("#cari").keyup(function(e) {
                    cari_table();
                });
          //  });
function cari_table() {
	var value = $("#cari").val();	
	$("table tbody .LUKAMA").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("td:eq(0)").text().toLowerCase();
			if (id.indexOf(value) < 0) {							
				$row.hide();
				//$('.kost').hide();									
			}
			else {			
				$row.show();
			}
		}
	});
}

$("td .inp").keyup(function(){

var trg = $(this).parent("td").find(".trg").val();
var kbk = $(this).parent("td").find(".kbk").val();

var hasile = $(this).val() * kbk;
//alert(hasile);
var new_number = hasile.toFixed(3);
$(this).parent("td").find(".hsl").val(new_number);

	
});
</script>
<?php
//$miku = $_POST['q'];
//echo "data satu coi =".$miku;
include "../koneksi.php";
    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				$lanku = date('m');
				$wkt = date('H:i:s');
echo "<table border='1' id='cv'  class='display'  cellspacing='0' width='100%'>
  		<thead>
        <tr>
    		<th style='min-width:250px' align='center'>Nama Produk</th>
    		<th style='min-width:70px'>Jumlah </th>";
            
	        $accid = $_POST['klm'];
			 $tanggalan   = $_POST['q'];
             $kun = explode(",",$tanggalan);
             //$jumlah_kun = count($kun)-1;
			 //////tambahan replace
			 $rep = str_replace(',', '', $tanggalan);
			 $lace = str_split($rep,2);
			 $ace = array_unique($lace);
			 
			 $jumlah_kun = count($ace);
			 //////////////akhir replace
			 
			//echo "<th style='min-width:70px'>Nama Produk</th>";
		
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
				$siomie = $ace[$i];
				echo "<th style='min-width:50px' >$siomie</th>";
				}
				?>
  		</tr>
        </thead>
        <tbody>
        <?php
		     
		
		$no = 1;
		//$sql_acc = " SELECT * from user where account_id = '$accid'";
              //  $hasil_cc = mysqli_query($mysqli, $sql_cc);
               // $data_cc = mysqli_fetch_assoc($hasil_cc);
				//$unm = $data_cc['USER'];
				
			
				
				 $sql_kj = "SELECT * from user where account_id = '$accid'";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

               $data_kj = mysqli_fetch_array($hasil_kj);
				$unm = $data_kj['USER'];	
		
		
		
//$sql_cari_produk_id = " Select * from ( select * from (select item_name as NP, item_code as ICOD from //push_item) as KK right join kj on KK.ICOD = kj.ITEM_CODE) 
   // as MM where MM.ACCOUNT_ID = '$accid' and TRIWULAN = '$tri' and YEAR(TGL) = '$yearku' ; ";
   $sql_cari_produk_id = "select YY.ID, YY.TGL, YEAR(YY.TGL) as THN,YY.BULAN_INPUT, YY.ACCOUNT_ID,
        YY.NAMA_PRODUK, YY.ITEM_CODE, YY.TARGET, 
        ZZ.ITEM_CODE as ICOD, ZZ.PANJANG, ZZ.LEBAR, ZZ.TINGGI, ZZ.PANJANG*ZZ.LEBAR*ZZ.TINGGI/1000000000 as KUBIKASI, ZZ.KUBIK as KUBIK_LAMA
  from kj_f as YY, 
            ( select AA.ITEM_CODE, AA.PANJANG, AA.LEBAR, AA.TINGGI, BB.item_code as ICOD, AA.KUBIK  
            from  kubikasi_produk as AA right join push_item as BB
            on AA.ITEM_CODE = BB.item_code where AA.ITEM_CODE is not null
            union
            select BB.item_code, BB.panjang, BB.lebar, BB.tinggi, AA.ITEM_CODE as ICOD, AA.KUBIK 
            from  kubikasi_produk as AA right join push_item as BB
            on AA.ITEM_CODE = BB.item_code where AA.ITEM_CODE is null) as ZZ
  where YY.ITEM_CODE = ZZ.ITEM_CODE and YY.ACCOUNT_ID = '$accid' and YEAR(YY.TGL) = '$yearku';";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                while ($data_id = mysqli_fetch_array($hasil_cari_produk_id)){
					$nmprod = $data_id['NAMA_PRODUK'];
					//$bli = $data_id['BULAN_INPUT'];
					//////detect bulan
					
					
					$target = $data_id['TARGET'];
					$icod = $data_id['ITEM_CODE'];
					$kubik = $data_id['KUBIKASI'];
					
			//echo "<input type='hidden' name='ACCID[]' value='$accid'>";		
			echo "<tr class='LUKAMA' ><td ><input type='hidden'  value=''>$nmprod</td>
			<td class='jml_barang2' align='center'>$target</td>";
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
			   echo "<td align='center'><input type='hidden'  class='sipo' value='$icod'>
				     <input type='hidden' class='sopo' value='$icod'>
					 <input type='text' class='inp' value=''>
					  <input type='hidden' class='hsl' value=''>
					 <input type='hidden' class='trg' value='$target'>
				     <input type='hidden' class='sipi' value='$yearku-$lanku-$mol $wkt'>
<input type='hidden' class='kbk'   style='width:70' data-role='none' value='$kubik'></td>";
				}
		    echo "</tr>";
			$no++;
				}
				
				
      echo "          </tbody>
        </table>";
		 echo "<button class='ui-btn ui-btn-inline' id='woke' value='tes bos'>Simpan</button>";
?>