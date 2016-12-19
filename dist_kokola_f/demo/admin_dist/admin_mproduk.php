<?php
session_start();
error_reporting(0);
include "../koneksi.php";
if(($_SESSION[USER])&& ($_SESSION[HAK] == "ADMIN")) {
	?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <script src="../jqm2/jquery-2.1.4.min.js"></script>
      <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
      <script src="../jqtable/jquery.dataTables.min.js"></script>
      <script src="../jqtable/dataTables.jqueryui.min.js"></script>


      <script src="../validation/jquery.validate.js"></script>
      <link rel="stylesheet" href="../themes/9septi_season.min.css" />
      <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
      <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
      <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
      <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
      <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="../jqtable/dataTables.jqueryui.min.css">
      <style>
.okl {
  font: bold 15px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
</style>
      <script>
          $(document).ready(function() {
               $('#example').DataTable( {
                    "scrollY": 300,
                    "scrollX": true,
					 aoColumnDefs: [
                                 {
                                   bSortable: false,
                                    aTargets: [ 0 ]
                                     }
                                 ],
			
                    /*"scrollY":        "400px",
                    "scrollCollapse": true,*/
					//"ordering": false,
                   // "paging":         false
                } );
          } );

      </script>
  </head>

<body>

<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        

        <h2>Kokola Distributor 2.0</h2>
    </div>

    <div data-role="content">

<div align="center"><strong>Master Produk</strong>&nbsp;&nbsp;&nbsp;<a href="home_admin.php" class="ui-btn ui-btn-inline ui-icon-back ui-btn-icon-notext ui-corner-all">No text</a></div>
<?php
error_reporting(0);
include "../koneksi.php";

if(isset($_POST['HAPUS']))  {
  $pilih = $_POST['PILIH'];
  $jumlah = count($pilih);
  if(empty($jumlah))               { 
                                   } 
  for($i=0;$i<=$jumlah;$i++) {  
	   $sql_del = "DELETE FROM m_produk WHERE ID = '$pilih[$i]'";
	   $hasil_del = mysqli_query($mysqli, $sql_del);
	   
	   if ($hasil_del){						 
  echo "<script>alert('Data Berhasil dihapus');
               location.reload(); </script>";	
	}
	                         }
	
	

}

?>
<form action="" method="post">
   <table  border="0" cellpadding="1" cellspacing="0" align="left">
      <tr>
         <td><?php //echo "<a href='Insert_produk.php' data-role='button' data-ajax='false' target='_parent'>Tambah Produk</a>";?></td><td></td>
         
         <!--<td><input type="submit" value="Hapus" name="HAPUS" onclick="return confirm('Are you sure you want to delete this item?');"/></td>-->
         
         
         <td></td><td><?php echo "<a href='../logout.php' data-role='button' data-ajax='false' target='_parent'>Log Out</a>";?></td>
      </tr>
       <!--tr>
           <td colspan="2" align="center"><h3>Apr-Mei-Jun</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=AMJ' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=AMJ' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr>
       <tr>
           <td colspan="2" align="center"><h3>Jul-Agu-Sep</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=JAS' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=JAS' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr>
       <tr>
           <td colspan="2" align="center"><h3>Okt-Nov-Des</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=OND' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=OND' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr-->
   </table>
   <table id="example" class="display" cellspacing="0" width="100%">
   <thead>
   <tr><th></th><th>NAMA PRODUK</th><th>KATEGORI</th><th>HARGA</th><th>KET.</th><th>ITEM CODE</th><th>ACTION</th></tr>
   </thead>
    <?php
$i = 1;
                    $sql_kj = "SELECT * FROM m_produk";
                    $hasil_kj = mysqli_query($mysqli, $sql_kj);

                    while ($data_kj = mysqli_fetch_array($hasil_kj)) {
						$nmproduk = $data_kj['NAMA_PRODUK'];
						$satuan = $data_kj['KATEGORI'];
						$harga = $data_kj['HARGA'];
						$itemcode = $data_kj['ITEM_CODE'];
						$kete = $data_kj['KET'];
						//<input type='checkbox' value='$data_kj[ID]' name='PILIH[]'>
				    echo "<tr><td align='center'>$i</td>
					<td>$nmproduk</td><td>$satuan</td><td>$harga</td><td>$kete</td><td>$itemcode</td>
					<td align='center'><a href='edit_produk.php?ID=$data_kj[ID]'   target='_parent' class='okl'  >EDIT</a></td></tr>";
					$i++;
					}
					?>
   
    
   </table>
   </form>
    </div><!--emnd role-content-->

    <div data-role="footer">
        <h2>Kokola Web Developer Department, 2016</h2>
    </div>


</div><!--end role page-->
</body>
</html>
 <?php
}
else{

    echo "Anda tidak Berhak";
}


?>