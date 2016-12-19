<?php
include "koneksi.php";
$view="";
    $tgl = date('Y')."-".date('m')."-".date('d');
				$yearku = date('Y');
				//$lanku = date('m');
                                $lanku=$_POST['bulan'];
				$wkt = date('H:i:s');

	        $accid = $_POST['klm'];
			 $tanggalan   = $_POST['q'];
             $kun = explode(",",$tanggalan);
          
			 $rep = str_replace(',', '', $tanggalan);
			 $lace = str_split($rep,2);
			 $ace = array_unique($lace);
			 
			 $jumlah_kun = count($ace);
		
?> 
                 
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
		
				 $sql_kj = "SELECT * from user where account_id = '$accid'";
                $hasil_kj = mysqli_query($mysqli, $sql_kj);

               $data_kj = mysqli_fetch_array($hasil_kj);
				$unm = $data_kj['USER'];	
		
$sql_cari_produk_id = " Select * from ( select * from (select item_name as NP, item_code as ICOD from push_item) as KK right join kj on KK.ICOD = kj.ITEM_CODE) 
    as MM where MM.ACCOUNT_ID = '$accid' and TRIWULAN = '$tri' and YEAR(TGL) = '$yearku' AND MM.STATUS_APR='1' and MM.publish='1'";
                $hasil_cari_produk_id = mysqli_query($mysqli, $sql_cari_produk_id);
                while ($data_id = mysqli_fetch_array($hasil_cari_produk_id)){
					//$nmprod = $data_id['NP'];
                                        $nmprod = $data_id['NAMA_PRODUK'];
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
					
			
                $view.='<div data-role="collapsible" data-filtertext="'.$nmprod.'" data-collapsed="true" class="c_kirim">';
                $view.='<h3 class="LUKAMA">'.$nmprod.'</h3>'
                       . '<ul data-role="listview" data-inset="false" class="d_kirim">';                
                $view.='<li>
                        <div class="ui-grid-a">
                        <div class="ui-block-a">Jumlah KJ: </div>
                        <div class="ui-block-b"><strong class="jml_barang2">'.$bulanku.'</strong>
                        </div>
                        </div>
                        </li>';
                 $view.='<li><div class="ui-grid-a">'; 
			for($i=0; $i<$jumlah_kun; $i++){
				$k = $i+1 ;
				$mol = $kun[$i];
                                $siomie = $ace[$i];
                               
                 if($i%2==0){
                     $view.='<div class="ui-block-a suger">'
                             . '<input type="number" urutan="'.$k.'" class="produk2" value="" sipo="'.$icod.'" sipi="'.$yearku.'-'.$lanku.'-'.$mol.'" placeholder="Tgl '.$siomie.'">'
                             . '</div>';     
                 }else{
                    $view.='    
                      <div class="ui-block-b suger">
                      <input type="number" urutan="'.$k.'" class="produk2" value="" sipo="'.$icod.'" sipi="'.$yearku.'-'.$lanku.'-'.$mol.'" placeholder="Tgl '.$siomie.'">
                      </div>
                      ';    
                 }   
                                
                 //$view.='<input size="67" type="number" urutan="'.$k.'" class="produk2" value="" sipo="'.$icod.'" sipi="'.$yearku.'-'.$lanku.'-'.$mol.'" placeholder="Tgl '.$siomie.'">';         
                        
				}
                 $view.='</div><li>';                 
                                  
		   // echo "</tr>";
                    $view.='</ul>
                            </div>
                             ';  
			$no++;
				}
				
                    
   echo $view;                              
?>

