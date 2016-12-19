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

   .my-error-class {
    color:#FF0000;  /* red */
	padding:5;
}
.my-valid-class {
    color:#00CC00; /* green */
	padding:5;
}
   
</style>
  <script>
     $(document).ready(function() {
		 
            $("#formku").validate({
	  errorClass: "my-error-class",
   validClass: "my-valid-class",
    rules: {
		USER: {
        required: true,             
                 },
        PASS: {
        required: true,
		number: true,       
                 },
		NAMA: {
        required: true,        
                 }
		
           },
messages: {
		 USER: "Nama Produk masih kosong!",
         //PASS: "Harga masih kosong!",       
         NAMA: "Item code masih kosong!"
	       }
});  
          } );

 </script>
  </head>

<body>

<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        

        <h2>Kokola Distributor 2.0</h2>
    </div>

    <div data-role="content">

<div align="center"><strong>Add Produk</strong></div>
<?php
session_start();
error_reporting(0);
include "../koneksi.php";
if(($_SESSION[USER])&& ($_SESSION[HAK] == "ADMIN")) { 

if(isset($_POST['EDIT']))  {
	
  $user = $_POST['USER'];
  $pass = $_POST['PASS'];
  $hak  = $_POST['HAK'];
  $nama = $_POST['NAMA'];
  $kota = $_POST['KOTA'];
  
  
	   $sql_del = "INSERT into m_produk SET NAMA_PRODUK = '$user',
                                        SATUAN = '$hak',
                                        HARGA = '$pass',                           
                                        ITEM_CODE  = '$nama',
                                        KET  = '$kota'
                                       ";
	   $hasil_del = mysqli_query($mysqli, $sql_del);
	                         
  if($hasil_del){

            echo "<script>alert('Berhasil'); window.location.href = 'admin_mproduk.php'</script>";
        }
        else{

            echo $sql_del;
        }

}

?>

   <form method="post" action="insert_produk.php" id="formku" >
   
 <ul data-role="listview" data-inset="true">
        <li class="ui-field-contain">
    
       <label for="USER">Nama Produk </label>
        <input type="text" name="USER" id="USER" placeholder=""  value="" maxlength="200" data-clear-btn="true"/>
    </li>
     <li class="ui-field-contain">
    
    <label for="HAK">Satuan</label>
    <select name="HAK" id="HAK" data-mini="true">
        <option value="Dus">Dus</option>
        <option value="Bal">Bal</option>
    </select>

   </li>
     <li class="ui-field-contain">
    
       <label for="PASS">Harga</label>
        <input type="text" name="PASS" id="PASS" placeholder="" value="" maxlength="200" data-clear-btn="true"/>
   </li>
  
   <li class="ui-field-contain">
    
       <label for="PASS">Item Code</label>
        <input type="text" name="NAMA" id="NAMA" value="" placeholder="" maxlength="200" data-clear-btn="true"/>
   </li>
   <li class="ui-field-contain">
    
       <label for="PASS">Keterangan</label>
        <input type="text" name="KOTA" id="KOTA" value="" placeholder="" maxlength="200" data-clear-btn="true"/>
   </li>
        
        
         <li class="ui-body ui-body-b" >
            <fieldset class="ui-grid-a">
           <!-- <div class="ui-block-b"><button type="submit" class="ui-btn ui-corner-all ui-btn-a">Submit</button>-->
            
         
          <div class="ui-block-a">
            <!--<button id="btnCancel" data-theme="a" 
              data-icon="delete">Back</button>-->
              <a href="admin_mproduk.php" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" target="_parent" >Back</a>
              
          </div>
          <div class="ui-block-b">
            <!--<button id="btnLogin" type="submit" 
              data-theme="a" data-icon="check">
                Edit
            </button> -->   
            <button class="ui-btn ui-icon-check ui-btn-icon-left ui-corner-all" name="EDIT" value="Edit" )>SAVE</button>  
          </div>
    
                 
       <!-- <td colspan="2" align="right"><input type="submit" name="SUBMIT" value="Sign In" maxlength="30" />-->
        </fieldset>
    </li>
</ul>
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