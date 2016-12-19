<?php
session_start();
/*ob_start("ob_gzhandler");
ob_flush();*/
?>
<html>
   <head>
   <title>Login Form</title> 
	<!--meta name="viewport" content="width=device-width, initial-scale=1"-->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

       <link rel="stylesheet" href="themes/9septi_season.min.css" />
       <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
       <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
       <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>

	
	<script>
		if(navigator.userAgent.match(/Android/i)){
          window.scrollTo(0,1);
        }
		
	</script>
	

   </head>
 <body>

<?php


   include "koneksi.php";
   
   if(isset($_POST[LOGIN]))
   {
      $nama=$_POST['USER'];
      $pass=$_POST['PASS'];
      $produkx = $_POST['PRODUKX'];
	  

    //print_r($_POST);
	
	$query = "SELECT * FROM user WHERE USER = '$nama' and PASS = '$pass' ";

       //echo $query;
 
    $sql = mysqli_query($mysqli, $query);
	$data = mysqli_fetch_array($sql);
	//echo $data[user];
	if ($data[0]) 
	{
   $_SESSION[USER]=$data['USER'];
   $_SESSION[HAK]=$data['HAK'];
  // $_SESSION[PRODUKX] = $produkx;

 date_default_timezone_set("Asia/Jakarta");
   $today = date(d)."/".date(m)."/".date(Y);
   $time = date('h:i A');

        /*
         * untuk log file yang masuk
         * */
  
     $fp = fopen("login.log", "a") or exit("Unable to open file!");
     $savestring = "=> Tgl:".$today.", Jam:".$time.", User:".$_SESSION[USER].", Hak:".$_SESSION[HAK]."|\r\n";
     fwrite($fp, $savestring);
     fclose($fp);



      if ($data['HAK'] == "DISTRIBUTOR" )
	    {
	    	
		  //header("Location: temp_secure.php");
	      echo "<script language='javascript'>";
          echo "window.location='dist.php';";
          echo "</script><br>";
	
	    }
	  elseif ($data['HAK'] == "ADMIN" )
		{
	      echo "<script language='javascript'>";
          echo "window.location='temp_oven.php';";
          echo "</script><br>";
        }
	  /*elseif ($data['HAK'] == "QA" )
		{
	      echo "<script language='javascript'>";
          echo "window.location='temp-qa.php';";
          echo "</script><br>";
        }	*/

	}  
  // }
   }


/*
 * yang ini digunakan untuk mencheck status yang ada di overn sebelum create RID baru
 *
 * */

 /*$sql_cari_STATUS = "SELECT ID, RID, PRODUK, STATUS FROM oven ORDER BY ID DESC LIMIT 1";
 $hasil_cari_STATUS = mysqli_query($mysqli, $sql_cari_STATUS);
 $data_hasil= mysqli_fetch_assoc($hasil_cari_STATUS);

 if($data_hasil[STATUS] == "SAVE_CONTINUE"){

     $_SESSION['RID']   =  $data_hasil[RID];
     //$_SESSION['PRODUK'] = $data_hasil[PRODUK];

 }elseif($data_hasil[STATUS] == "SAVE_END_SHIFT"){

     $_SESSION['RID']   = "";
     $ridle = $data_hasil[RID];
 }*/


?>
<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        
		<h1>LOGIN FORM </h1>
        <h2>Kokola Distributor 1.0</h2>
	</div><!-- /header -->
    <div data-role="content">	
    <form action="index.php" method="post" data-ajax="false" id="FORMX" >
        <font face="Verdana, Arial, Helvetica, sans-serif" style="text-align:center"><b><h2>Username</h2></b></font>
        <input type="text" name="USER" id="USER" placeholder="Input User"/>
        <font face="Verdana, Arial, Helvetica, sans-serif" style="text-align:center"><b><h2>Password</h2></b></font>
        <input type="password" name="PASS" placeholder="Input Password" /><br>

        <!--input type="hidden" name="PRODUKX" value="<?php echo $data_hasil[PRODUK]; ?>" /><br>
        <input type="hidden" name="RIDLE" value="<?php echo $ridle; ?>" /--><br>


        <input type="submit" name="LOGIN" value="SIGN IN"/>
    </form>
    </div><!-- /content  -->
    <div data-role="footer">
	   <h4>Copyrigt, Kokola Web Dev Department </h4>
	</div>
    
    </div><!-- /page   -->
	
	
	
<!--link type="text/css" href="jqm2/jquery.mobile-1.4.5.min.css" rel="stylesheet"-->
<script src="jqm2/jquery-2.1.4.min.js"></script>
<script src="jqm2/jquery.mobile-1.4.5.min.js"></script>

 <script src="validation/jquery.validate.js"></script>
 <script>
     /*$.validator.addMethod("valueNotEquals", function(value, element, arg){
         return arg != value;
     }, "Value must not equal arg.");*/


     $.validator.addMethod("NOSYMBOL",function(value,element)
     {
         return this.optional(element) || /^[a-zA-Z0-9]{3,16}$/i.test(value);
     },"USER  3-15 karakter, no Symbol.(!@#$%^&*_.,';)");

     $(function(){

         $("#FORMX").validate({

             //errorClass:'myClass',

             rules: {
                 USER:{
                     required: true,
                     NOSYMBOL: true

                 },
                 PASS:{
                     required: true,
                     minlength: 6,
                     NOSYMBOL: true

                 }
             },
             messages: {
                 USER:{
                     required: "User belum terisi"

                 },
                 PASS:{
                     required: "Password Belum diisi",
                     minlength: "Minimal 6 karakter"
                 }
             }
         })

     });



 </script>
	
</body>
</html>
<?php
ob_end_flush();
?>
