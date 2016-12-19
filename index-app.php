<?php
session_start();
echo "<b>".date(Ymd)."</b>";
//exit;
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
if(isset($_POST['LOGIN'])) {
	$nama=$_POST['USER'];
	$pass=$_POST['PASS'];



    if(strtoupper($nama) == 'PPIC') {

        $query = "SELECT * FROM user WHERE PASS = '$pass' AND USER = 'PPIC'";

        $sql = mysqli_query($mysqli, $query);
        $data = mysqli_fetch_array($sql);

        if ($data[0]) {
            $_SESSION['NAMA'] = $data['NAMA'];
            $_SESSION['USER'] = $data['USER'];
            $_SESSION['HAK'] = $data['HAK'];
            $_SESSION['HAK'] = $data['HAK'];
            $_SESSION['KOTA'] = $data['KOTA'];
            $_SESSION['ACCOUNT_ID'] = $data['account_id_user'];
            $_SESSION['ACCOUNT_ID_PUSH'] = $data['push_account_ID'];

            if ($data['HAK'] == "PPIC") {


                echo "<script language='javascript'>";
                echo "window.location='admin_dist/list_total_kj_ppic.php';";
                echo "</script><br>";
            }

        }


    }










    else {

        $query = "SELECT user.ACCOUNT_ID AS account_id_user,
                     user.PASS,
                     user.HAK,
                     user.NAMA,
                     user.KOTA,
                     user.USER,
                      user.REGIONAL,
                      push_distributor.ACCOUNT_ID AS push_account_ID,
                      push_distributor.PRICEGROUP_CODE
          
              
                       FROM `user`
                               LEFT JOIN push_distributor  ON `user`.ACCOUNT_ID = push_distributor.ACCOUNT_ID
                               WHERE user.USER = '$nama'
                        AND user.PASS = '$pass'";
        /*echo $query;
        exit;*/

    }
			   
	$sql = mysqli_query($mysqli, $query);
	$data = mysqli_fetch_array($sql);
	
	if ($data[0]) {
	    $_SESSION['NAMA']=$data['NAMA'];
		$_SESSION['USER']=$data['USER'];
		$_SESSION['HAK'] =$data['HAK'];
		$_SESSION['HAK'] =$data['HAK'];
		$_SESSION['KOTA']=$data['KOTA'];
		$_SESSION['ACCOUNT_ID'] = $data['account_id_user'];	
        $_SESSION['ACCOUNT_ID_PUSH'] =  $data['push_account_ID'];	
		
		// $_SESSION[PRODUKX] = $produkx;
		
		date_default_timezone_set("Asia/Jakarta");
		$today = date('d')."/".date('m')."/".date('Y');
		$time = date('h:i A');		
		
		// untuk log file yang masuk		
		$fp = fopen("login.log", "a") or exit("Unable to open file!");
		$savestring = "=> Tgl:".$today.", Jam:".$time.", User:".$_SESSION['USER'].", Hak:".$_SESSION['HAK']."|\r\n";
		fwrite($fp, $savestring);
		fclose($fp);
		
		/*echo $data['HAK']."<br>";
		echo $data['push_account_ID'];
		exit;*/
		
		
		if ($data['HAK'] == "DISTRIBUTOR" ){

             if($data['push_account_ID'] != ""){
				 
			    //header("Location: temp_secure.php");
			echo "<script language='javascript'>";
			//echo "window.location='dist.php';";
			echo "window.location='home.php';";
			echo "</script><br>";		 
				 
			 }
             else{
				 
				 //header("Location: temp_secure.php");
			echo "<script language='javascript'>";
			echo "alert('Maaf user tidak terdaftar')";
			echo "window.location='index.php';";
			echo "</script><br>";
					 
			 }			 
			
		}
		if ($data['HAK'] == "ADMIN" ){
			
			
			echo "<script language='javascript'>";
			echo "window.location='admin_dist/home_admin.php';";
			echo "</script><br>";
		}

		if ($data['HAK'] == "" ){
			
			
			echo "<script language='javascript'>";
			echo "Maaf Anda tidak terdaftar";
			//echo "window.location='admin_dist/home_admin.php';";
			echo "</script><br>";
		}
		if ((($nama == "2121") AND ($pass == "septiyo23")) OR (($nama == "2122") AND ($pass == "kokola"))){
		
          $_SESSION['NAMA']=$nama;
		  $_SESSION['USER']=$pass;
		  $_SESSION['HAK'] ="DISTRIBUTOR";
		  $_SESSION['HAK'] ="DISTRIBUTOR";
		  $_SESSION['ACCOUNT_ID'] = $nama;	
		
			
			echo "<script language='javascript'>";
			echo "window.location='home.php';";
			echo "</script><br>";
		}
		
		
	}
}
?>
<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">        
		<h1>LOGIN FORM </h1>
        <h2>Kokola Distributor 2.5</h2>
	</div><!-- /header -->
    <div data-role="content">	
        <form action="index-app.php" method="post" data-ajax="false" id="FORMX" >
            <font face="Verdana, Arial, Helvetica, sans-serif" style="text-align:center"><b><h2>Username</h2></b></font>
            <input type="text" name="USER" id="USER" placeholder="Input User"/>
            <font face="Verdana, Arial, Helvetica, sans-serif" style="text-align:center"><b><h2>Password</h2></b></font>
            <input type="password" name="PASS" placeholder="Input Password" /><br><br>
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
$.validator.addMethod("NOSYMBOL",function(value,element) {
 return this.optional(element) || /^[a-zA-Z0-9]{3,100}$/i.test(value);
},"USER  3-15 karakter, no Symbol.(!@#$%^&*_.,';)");

$(function(){
 $("#FORMX").validate({
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
