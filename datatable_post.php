<?php
if(session_id() == '') { //PHP < 5.4.0
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="order/themes/blitzer/jquery-ui.min.css" />
<link rel="stylesheet" href="order/css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="order/css/dataTables.jqueryui.css" type="text/css"/>

<script type="text/javascript" src="order/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="order/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="order/js/dataTables.jqueryui.min.js"></script>
<!--<script type="text/javascript" src="js/dataTables.responsive.js"></script>
<script type="text/javascript" src="js/responsive.jqueryui.js"></script>-->
<script type="text/javascript" src="order/js/jquery.dataTables.rowGrouping.js"></script>
<script type="text/javascript" src="order/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    var oTable = $('#example').DataTable( {
		"dom": '<"toolbar">frtip',
		"scrollY": 300,
		"scrollX": true,
		"paging": false,
		"filter": false,
		"processing": true,
		"bJQueryUI": true,
		//fixedColumns: true
	});
});
</script>
</head>

<body>
<?php
	$bulan = $_GET['BULAN'];
	$pecah = explode("-", $bulan);
	echo $pecah[0] . "" . $pecah[1] . "" . $pecah[2];
	echo $_SESSION['TRIWULAN'];
	
	
	date_default_timezone_set("Asia/Jakarta");
	
	//$today          = date('d')."-".date('m')."-".date('Y');
	$today_database = date('Y')."-".date('m')."-1";
	//$time = date('H:i:s');
	
	/** cari 3 bulan yang lalu setelah hari ini **/
		   
	$bulan_lalu  = date( 'Y-m-d', strtotime( $today_database . ' -1 month'));
	$bulan_lalu2 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));
	$bulan_lalu3 = date( 'Y-m-d', strtotime( $today_database . ' -2 month'));

?>
<form id="formx" method="post" action="simpan_kj.php" data-ajax="false">
    <table>
        <tr>
            <td align="center" colspan="9">
                <h3>Forecast : <?php echo $_SESSION['TRIWULAN']; ?></h3>
                <input type="hidden" value="<?php echo $_SESSION['TRIWULAN']; ?>" name="TRIWULAN">
            </td>
        </tr>
        <tr>
            <th colspan="9" align="center">Nama Distributor : <?php echo $_SESSION['NAMA']; ?></th>
        </tr>
    </table>
    
    <!--table border="1" cellpadding="1" cellspacing="0" align="center"-->
    <table id="example"  class="display order-column display stripe" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#7fffd4">
                <th width="100">Nama Produk</th>
                <th width="30">Harga</th>
                <th width="50">Last 3 Month</th>
                <th width="50">Forecast 3 Month</th>
                <th width="50"> % </th>
                <th width="100"><?php echo $pecah[0];?></th>
                <th width="100"><?php echo $pecah[1];?></th>
                <th width="100"><?php echo $pecah[2];?></th>
                <th width="100" class="TOTAL_VALUE">Total Value</th>
                <!--th-- width="100">ID PRODUK</th-->
                <!--th>Growth</th-->
            </tr>
        </thead>
        <tfoot>
            <tr bgcolor="#7fffd4">
                <th width="100">&nbsp;</th>
                <th width="30">&nbsp;</th>
                <th width="50">&nbsp;</th>
                <th width="50">&nbsp;</th>
                <th width="50">&nbsp;</th>
                <th width="100" class="header-bulan1"><div id="total1"></div></th>
                <th width="100" class="header-bulan2"><div id="total2"></div></th>
                <th width="100" class="header-bulan3"><div id="total3"></div></th>
                <th width="100"><div id="total"></div></th>
                <!--th-- width="100">ID PRODUK</th-->
                <!--th>Growth</th-->
            </tr>
        </tfoot>
        
        <tbody>
        <?php
		require_once("order/koneksi.php");
        $total_last_month = "";
        $sql_produk = "SELECT * FROM m_produk WHERE HARGA <> 0 ORDER BY NAMA_PRODUK ASC";
        $hasil_produk = mysql_query($sql_produk);
    
        while ($data_produk = mysql_fetch_assoc($hasil_produk)) {
        
             $item_code = $data_produk['ITEM_CODE'];
             /*Cari Forecast 3 bulan yang lalu*/
             
             
             /*$sql_forcastx = "SELECT SUM(qty) AS total_last_month FROM order_kirim WHERE periode1 IN ('$bulan_lalu','$bulan_lalu2','$bulan_lalu3')
                             AND FLAG = 1  AND item_code = '$item_code' 
                             AND periode2 IN (LAST_DAY('$bulan_lalu'),LAST_DAY('$bulan_lalu2'),LAST_DAY('$bulan_lalu3')) AND  account_id = '$_SESSION[ACCOUNT_ID]'";
                               
              $hasil_forcastx = mysqli_query($mysqli, $sql_forcastx);
              $data_forcastx = mysqli_fetch_assoc($hasil_forcastx);
              $total_last_month = $data_forcastx['total_last_month'];*/
                                
        
            echo "<tr>";
            echo "<td align='left'>$data_produk[NAMA_PRODUK] <input type='hidden' value='$data_produk[ITEM_CODE]' name='ITEM_CODE[]'></td>";
            echo "<td><div class='HARGA' align='center'>$data_produk[HARGA]</div></td>";
            echo "<td align='center'><input type='text' name='bln_akhir[]' class='bln_akhir' value='$total_last_month'></td>";
            echo "<td align='center'><input type='text' name='FORECAST[]' class='FORECAST' placeholder='...'></td>";
            echo "<td align='center'><input type='text' name='PERSEN[]' style='min-width: 30px' class='PERSEN' readonly placeholder='...' ></td>";
            echo "<td align='center'><input type='text' name='BULAN1[]' style='min-width: 100px' class='BULAN1' placeholder='...'  ></td>";
            echo "<td align='center'><input type='text' name='BULAN2[]' style='min-width: 100px' class='BULAN2' placeholder='...'  ></td>";
            echo "<td align='center'><input type='text' name='BULAN3[]' style='min-width: 100px' class='BULAN3' placeholder='...'>
            </td>";
            echo "<td align='center'><input type='text' name='TOTAL_VALUE[]' style='min-width: 100px' class='TOTAL_VALUE' placeholder='...' ></td>";
                
            
    
            echo "</tr>";
            
            
        }
        ?>
        </tbody>
    </table>
    
    <table align="center" width="300">
        <tr>
            <td colspan="5" align="center">
            <input type="submit" value="SAVE" name="SAVE" id="SAVE">
            <a href="order/dist.php" data-ajax="false" data-role="button">Back</a>
            </td>            
        </tr>
    </table>
    </form>
</body>
</html>