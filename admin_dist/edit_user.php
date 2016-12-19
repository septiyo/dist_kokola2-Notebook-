<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <script src="../jqm2/jquery-2.1.4.min.js"></script>
      <script src="../jqm2/jquery.mobile-1.4.5.min.js"></script>
      <script src="../jqtable/jquery.dataTables.min.js"></script>
      <script src="../jqtable/dataTables.jqueryui.min.js"></script>
       <script type="text/javascript" src="../themeku/jquery-ui.js"></script>


      <script src="../validation/jquery.validate.js"></script>
      <link rel="stylesheet" href="../themes/9septi_season.min.css" />
      <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
      <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
      <link rel="stylesheet" href="../jqm2/jqmobile.structure-1.4.5.min.css"/>
      <!--<link rel="stylesheet" href="jqtable/jquery.dataTables.min.css">-->
      <link rel="stylesheet" href="../jqtable/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="../jqtable/dataTables.jqueryui.min.css">
      <script>
	  $(function() {
	      var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
			 $("#REGIONAL").autocomplete({
				// source:  availableTags
		source:  "sourceuser.php",
	});	 
  
		  });

         
	  </script>
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
.AUTOC {
    color:#F0191C; /* green */
	
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
                 },
		NAMA: {
        required: true,        
                 },
				KOTA: {
        required: true,        
                 }
		
           },
messages: {
		 USER: "Username masih kosong!",
         PASS: "Password masih kosong!",       
         NAMA: "Nama masih kosong!",
		  KOTA: "Kota masih kosong!"
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

<div align="center"><strong>Edit User</strong></div>
<?php
session_start();
error_reporting(0);
include "../koneksi.php";
if(($_SESSION[USER])&& ($_SESSION[HAK] == "ADMIN")) { 
$unm = $_GET['ID'];

if(isset($_POST['EDIT']))  {
	 $idd = $_POST['IDD'];
  $user = $_POST['USER'];
  $pass = $_POST['PASS'];
  $hak  = $_POST['HAK'];
  $nama = $_POST['NAMA'];
  $kota = $_POST['KOTA'];
  $regional = $_POST['REGIONAL'];
  
  
	   $sql_del = "UPDATE user SET PASS = '$pass',
                                                                 
                                       
                                        REGIONAL  = '$regional'
                                        WHERE ID = '$idd'";
										/*$sql_del = "UPDATE user SET USER = '$user',
                                        PASS = '$pass',
                                        HAK = '$hak',                           
                                        NAMA  = '$nama',
                                        KOTA  = '$kota'
                                        WHERE ID = '$idd'";*/
	   $hasil_del = mysqli_query($mysqli, $sql_del);
	                         
  if($hasil_del){

            echo "<script>alert('Berhasil'); window.location.href = 'admin_user.php'</script>";
        }
        else{

            echo $sql_del;
        }

}

$sql_kj = "SELECT * FROM user where ID= '$unm' ";
                    $hasil_kj = mysqli_query($mysqli, $sql_kj);
                    $data_kj = mysqli_fetch_array($hasil_kj);
?>

   <form method="post" action="edit_user.php" id="formku" >
   
 <ul data-role="listview" data-inset="true">
        <li class="ui-field-contain">
    
       <label for="USER">Username </label>
        <input type="text" name="USER" id="USER" placeholder=""  value="<?php echo $data_kj['USER']?>"maxlength="30" data-clear-btn="false" readonly/><input type="hidden" name="IDD" value="<?php echo $unm ?>" >
    </li>
     <li class="ui-field-contain">
    
       <label for="PASS">Password</label>
        <input type="text" name="PASS" id="PASS" placeholder="" value="<?php echo $data_kj['PASS']?>" maxlength="200" data-clear-btn="true"/>
   </li>
   
   
   
   <!--<li class="ui-field-contain">-->
    
      <!-- <label for="PASS">Hak</label>
        <input type="text" name="HAK" id="HAK" placeholder="" maxlength="30" value="<?php //echo $data_kj['HAK']?>" data-clear-btn="true"/>-->
        <!-- <label for="HAK">Hak</label>
    <select name="HAK" id="HAK" data-mini="true">-->
    <?php //$hakku = $data_kj['HAK'];
	//if ($hakku == 'DISTRIBUTOR') { echo "<option value='DISTRIBUTOR' selected>DISTRIBUTOR</option> 
	//<option value='ADMIN'>ADMIN</option>";}
	//else
	//{ echo "<option value='DISTRIBUTOR' >DISTRIBUTOR</option> 
	//<option value='ADMIN' selected>ADMIN</option>";}
	?>
      <!--  <option value="DISTRIBUTOR">DISTRIBUTOR</option>
        <option value="ADMIN" selected>ADMIN</option>-->
    <!--</select>-->
   <!--</li>-->
   
   
   
   <li class="ui-field-contain">
    
       <label for="PASS">Nama</label>
        <input type="text" name="NAMA" id="NAMA" value="<?php echo $data_kj['NAMA']?>" placeholder="" maxlength="200" data-clear-btn="false" readonly/>
   </li>
   <!--<li class="ui-field-contain">
    
       <label for="PASS">Kota</label>
        <input type="text" name="KOTA" id="KOTA" value="<?php //echo $data_kj['KOTA']?>" placeholder="" maxlength="200" data-clear-btn="true"/>
   </li>-->
   
   
  <li class="ui-field-contain">
    
       <label for="PASS">Regional <k class="AUTOC">(*Autocomplete)</k></label>
       <div class="ui-widget">
        <input type="text" name="REGIONAL" id="REGIONAL" value="<?php echo $data_kj['REGIONAL']?>" placeholder="" maxlength="200" data-clear-btn="true"/>
        </div>
   </li>
        
        
         <li class="ui-body ui-body-b" >
            <fieldset class="ui-grid-a">
           <!-- <div class="ui-block-b"><button type="submit" class="ui-btn ui-corner-all ui-btn-a">Submit</button>-->
            
         
          <div class="ui-block-a">
            <!--<button id="btnCancel" data-theme="a" 
              data-icon="delete">Back</button>-->
              <a href="admin_user.php" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" target="_parent" >Back</a>
              
          </div>
          <div class="ui-block-b">
            <!--<button id="btnLogin" type="submit" 
              data-theme="a" data-icon="check">
                Edit
            </button> -->   
            <button class="ui-btn ui-icon-check ui-btn-icon-left ui-corner-all" name="EDIT" value="Edit" onclick="return confirm('Apakah ingin edit data ini?');")>Edit</button>  
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