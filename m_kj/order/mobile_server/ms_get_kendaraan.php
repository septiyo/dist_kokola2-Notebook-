<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){
    
$account_id=$_GET['id'];
 
$view="";                                      
                                            
    $sql_transport = "select * from kubikasi_transporter";
    $mysql_transport = mysql_query($sql_transport);
    
    $view.='<ul data-role="listview" data-inset="false">';
    while ($dataTransport = mysql_fetch_assoc($mysql_transport)) {     
    /*$view.='<div data-role="collapsible" data-filtertext="'.$dataTransport['JENIS_KENDARAAN']." ".$dataTransport['JML_VOLUME'].'" data-collapsed="true">';           
    $view.='<h3>'.$dataTransport['JENIS_KENDARAAN'].' <span style="color:#f33;">('.$dataTransport['JML_VOLUME'].')</span></h3>';  
    $view.='<ul data-role="listview" data-inset="false" class="d_kendaraan">
            <li>
                <div style="display:none;" class="jenis_kendaraan">'.$dataTransport['JENIS_KENDARAAN'].'</div>
                <div class="ui-checkbox widget uib_w_7 d-margins" data-uib="jquery_mobile/checkbox" data-ver="0">
                  <label>Pilih
                  <input class="ck_kendaraan" type="checkbox" value="cek">
                </label>
                </div>
            </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Volume :</div>
                          <div class="ui-block-b"><strong class="kd_volume">'.$dataTransport['JML_VOLUME'].'</strong>
                          </div>
                        </div>                            
                        </li>';
    $view.='<li>
                        <div class="ui-grid-a">
                          <div class="ui-block-a">Jumlah :</div>
                          <div class="ui-block-b">
                          <input type="text" class="jml_mobil" data-corners="false" maxlength="2" pattern="[0-9]*" min="0" max="10" inputmode="numeric" data-mini="true"/>
                          </div>
                        </div>                            
                        </li>';
    $view.='  <li>
                    <div class="ui-grid-a">
                          <div class="ui-block-a">Kubik :</div>
                          <div class="ui-block-b"><strong class="trs_kubik"></strong>
                          </div>
                        </div>                            
                        </li>
                    </ul>
              </div>';*/
  /*$view.='<li>
                <div style="display:none;" class="jenis_kendaraan">'.$dataTransport['JENIS_KENDARAAN'].'</div>
                <div data-mini="true" class="ui-checkbox widget uib_w_7 d-margins" data-uib="jquery_mobile/checkbox" data-ver="0">
<label><input class="ck_kendaraan" type="checkbox" value="cek" data-role="none" />
mnjnjn</label>
<p>
gttftftf
</p>
</div>
            </li>';*/
     $view.='<li style="padding:5px 0 15px 0;" class="d_kendaraan">
                   
        <span style="font-size:14px;color:#F00;text-transform:capitalize;">
        <label><span class="nama_kendaraan">'.$dataTransport['JENIS_KENDARAAN'].'</span> <span style="color:#f33;" class="li_volume">'.$dataTransport['JML_VOLUME'].'</span>
            <input type="checkbox" data-mini="true" value="Yes" class="ck_kendaraan">
             </label>
        <span style="color:#096;margin-left:25px;">
        <input type="text" data-role="none" style="width:80px;" class="txt_in" readonly/></span>
           <span style="color:#096;margin-left:25px;" class="jml_kbk">0
        </span>
        </span>
                 
                  
                    </li>
        ';
        
  }
   $view.="</ul>";

   echo $view;
}
?>

                       
                        
                        
                      
                        

