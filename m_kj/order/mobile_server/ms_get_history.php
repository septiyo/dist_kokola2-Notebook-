<?php 
error_reporting(0);
require_once("../koneksi.php");
if(isset($_GET["id"])){
$userLog=$_GET["id"];

$sqlData = "select AA.TGL, AA.ID_ORDER, AA.TGL, AA.USERID, BB.ID_PRODUK,
	BB.ITEM_CODE,	CC.item_name as NAMA_PRODUK,
	COALESCE(BB.JML_KJ, 0) AS JML_KJ,
	COALESCE(BB.JML_REAL, 0) AS JML_REAL,
	COALESCE(BB.JML_SISA, 0) AS JML_SISA,
	COALESCE(BB.JML_ORDER, 0) AS JML_ORDER
	from order_distributor AA, order_detail BB, push_item CC
	where AA.ID_ORDER = BB.ID_ORDER
	and BB.ITEM_CODE = CC.item_code
	and date_format(AA.TGL, '%Y %m') =  date_format(now(), '%Y %m')
	and USERID = '".$userLog."'
	order by AA.TGL desc;";
$myData = mysql_query($sqlData);
$jml = mysql_num_rows($myData);
//$arr = array();
$t_kj=0;
$t_real=0;
$t_sisa=0;
$t_order=0;
if ($jml > 0) {
	while ($rowData = mysql_fetch_assoc($myData)) {
		$d = date("d", strtotime($rowData['TGL']));
		$m = date("m", strtotime($rowData['TGL']));
		$Y = date("Y", strtotime($rowData['TGL']));
		/*$arr[] = array($d." ".konversi($m)." ".$Y,
			$rowData['NAMA_PRODUK'],
			$rowData['JML_KJ'],
			$rowData['JML_REAL'],
			$rowData['JML_SISA'],
			$rowData['JML_ORDER']
		);
*/

$t_kj+=$rowData['JML_KJ'];
$t_real+=$rowData['JML_REAL'];
$t_sisa+=$rowData['JML_SISA'];
$t_order+=$rowData['JML_ORDER'];
echo'<li class="lslide">
    <div style="background:#b41f04; border:1px solid #ccc; padding:5px 10px; color:white"><strong><big>';
echo $rowData['NAMA_PRODUK'];     
echo    '</big></strong>
    </div>
    <ul>
            <li style="background:#ebeaea;height:40px;padding-top:12px;border:none;"><strong>';
echo $d." ".konversi($m)." ".$Y;            
echo '</strong>
            </li>
            
            <li style="background:#f9fcf9;height:40px;padding-top:12px;border:none;"><strong>KJ : ';
echo $rowData['JML_KJ'];            
echo '</strong>
            </li>
          
            <li style="background:#ebeaea;height:40px;padding-top:12px;border:none;"><strong>Real : ';
echo $rowData['JML_REAL'];
echo '</strong>
            </li>
           
            <li style="background:#f9fcf9;height:40px;padding-top:12px;border:none;"><strong>Sisa : ';
echo $rowData['JML_SISA'];
echo '</strong>
            </li>
           
            <li style="background:#ebeaea;height:40px;padding-top:12px; border:none;"><strong>Order : ';
echo $rowData['JML_ORDER'];
echo '</strong>
            </li>
            
    </ul>
</li>';
	}
echo'<li class="lslide">
    <div style="background:#b41f04; border:1px solid #ccc; padding:5px 10px; color:white"><strong><big>';     
echo    'TOTAL ORDER</big></strong>
    </div>
    
    <ul>
            <li style="background:#ebeaea;height:40px;padding-top:12px;border:none;"><strong>Total KJ : ';
echo $t_kj;            
echo '</strong>
            </li>
            
            <li style="background:#f9fcf9;height:40px;padding-top:12px; border:none;"><strong>Total Real : ';
echo $t_real;
echo '</strong>
            </li>
            
            <li style="background:#ebeaea;height:40px;padding-top:12px;border:none;"><strong>Total Sisa : ';
echo $t_sisa;
echo '</strong>
            </li>
            
            <li style="background:#f9fcf9;height:40px;padding-top:12px; border:none;"><strong>Total Order : ';
echo $t_order;
echo '</strong>
            </li>
           
    </ul>
</li>';        
        
	
}
}
?>