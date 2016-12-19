

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

</script>
<?php
//$miku = $_POST['q'];
//echo "data satu coi =".$miku;
include "koneksi.php";
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
		     if ($lanku == "01")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "02")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "03")
					{  $tri = 'Jan-Feb-Mar'; }
					elseif ($lanku == "04")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "05")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "06")
					{  $tri = 'Apr-May-Jun'; }
					elseif ($lanku == "07")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "08")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "09")
					{  $tri = 'Jul-Aug-Sep'; }
					elseif ($lanku == "10")
					{  $tri = 'Oct-Nov-Dec'; }
					elseif ($lanku == "11")
					{  $tri = 'Oct-Nov-Dec'; }
					elseif ($lanku == "12")
					{  $tri = 'Oct-Nov-Dec'; }
		
		
		$no = 1;
		//$sql_acc = " SELECT * from user where account_id = '$accid'";
              //  $hasil_cc = mysqli_query($mysqli, $sql_cc);
               // $data_cc = mysqli_fetch_assoc($hasil_cc);
				//$unm = $data_cc['USER'];
				 $sql_kj = "SELECT * from user where account_id = '$accid'";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

               $data_kj = mysqli_fetch_array($hasil_kj);
				$unm = $data_kj['USER'];	
		//$sql_cari_produk_id = "SELECT KK.KU, KK.ID_PRODUK, KK.BULAN1,  ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC 
//right join (select ID as KU, ID_PRODUK, BULAN1  from kj) as KK on CC.ID = KK.KU; ";

//$sql_cari_produk_id = " SELECT KK.KU, KK.ID_PRODUK, KK.BULAN_INPUT as BLI, KK.BULAN1,KK.BULAN2,KK.BULAN3, KK.NAMA_DIST,  //ID, NAMA_PRODUK, ITEM_CODE FROM m_produk as CC inner join (select ID as KU, BULAN_INPUT,ID_PRODUK, BULAN1,BULAN2,BULAN3, //NAMA_DIST  from kj) as KK on CC.ID = KK.KU and KK.NAMA_DIST = '$unm'";
$sql_cari_produk_id = " Select * from ( select * from (select item_name as NP, item_code as ICOD from push_item) as KK right join kj on KK.ICOD = kj.ITEM_CODE) 
    as MM where MM.ACCOUNT_ID = '$accid' and TRIWULAN = '$tri' and YEAR(TGL) = '$yearku' ; ";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                while ($data_id = mysqli_fetch_array($hasil_cari_produk_id)){
					$nmprod = $data_id['NP'];
					$bli = $data_id['BULAN_INPUT'];
					//////detect bulan
					if ($lanku == "01")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "02")
					{  $bulanku = $data_id['BULAN2']; }
					elseif ($lanku == "03")
					{  $bulanku = $data_id['BULAN3']; }
					elseif ($lanku == "04")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "05")
					{  $bulanku = $data_id['BULAN2']; }
					elseif ($lanku == "06")
					{  $bulanku = $data_id['BULAN3']; }
					elseif ($lanku == "07")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "08")
					{  $bulanku = $data_id['BULAN2']; }
					elseif ($lanku == "09")
					{  $bulanku = $data_id['BULAN3']; }
					elseif ($lanku == "10")
					{  $bulanku = $data_id['BULAN1']; }
					elseif ($lanku == "11")
					{  $bulanku = $data_id['BULAN2']; }
					elseif ($lanku == "12")
					{  $bulanku = $data_id['BULAN3']; }
					
					//$bulanku = $data_id['BULAN2'];
					$icod = $data_id['ICOD'];
					
			//echo "<input type='hidden' name='ACCID[]' value='$accid'>";		
			echo "<tr class='LUKAMA' ><td ><input type='hidden'  value=''>$nmprod</td>
			<td class='jml_barang2' align='center'>$bulanku</td>";
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
			   echo "<td align='center'><input type='hidden'  class='sipo' value='$icod'>
				     <input type='hidden' class='sopo' value='$icod'>
				     <input type='hidden' class='sipi' value='$yearku-$lanku-$mol'>
<input type='text' class='produk2'   style='width:70' data-role='none' value='0'></td>";
				}
		    echo "</tr>";
			$no++;
				}
				
				
      echo "          </tbody>
        </table>";
		 echo "<button class='ui-btn ui-btn-inline' id='woke' value='tes bos'>Simpan</button>";
?>