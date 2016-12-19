<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Push Notif Form</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	
	<style>
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}

		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
				  box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="email"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
	</style>
	
	<!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.12.4.js"></script>
	<script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			//alert("Hello");
			//$("#datepicker").datepicker();
			
			$("#num").hide();
			$("#sen").hide();
			$("#datepicker").hide();
			
			$("#notif").change(function() {
				var sel = $('#notif :selected').val();
				//alert(sel);
				if(sel == 'ach_notif'){
					$("#num").hide();
					$("#sen").hide();
					$("#datepicker").hide();
				}else if(sel == 'prom_notif'){
					$("#num").show();
					$("#sen").hide();
					$("#datepicker").hide();
				}else if(sel == 'sj_notif'){
					$("#num").hide();
					$("#sen").show();
					$("#datepicker").show();
				}else{
					
				}
				
			});
			
		});
		
		$(function() {
			$("#datepicker").datepicker(
				{dateFormat: 'yy-mm-dd'}
			);
			//$("#datepicker").datepicker("option", "dateFormat", $( this ).val() );
		});
	</script>
	
  </head>

  <body role="document">
	
	<div class="container">

      <form class="form-signin" method="POST" action="index.php">
        <h2 class="form-signin-heading">Send Notification</h2>
        <input type="text" class="form-control" placeholder="User Account ID" name="account_id" id="account_id" required autofocus>
        <input type="text" class="form-control" placeholder="Item Code" name="num" id="num">
		<input type="text" class="form-control" placeholder="SN-Number" name="sen" id="sen">
		<input type="text" class="form-control" placeholder="Tanggal Kirim" name="datepicker" id="datepicker">
        <select class="form-control" name="notif" id="notif">
		  <option value="ach_notif">Achievement Notification</option>
		  <option value="prom_notif">Produk Notification</option>
		  <option value="sj_notif">Surat Jalan Notification</option>
		</select>
		<br/>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="send" id="send">Send</button>
      </form>

    </div> <!-- /container -->
    
  </body>
  
  <?php
	require_once("koneksi.php");
	
	if(isset($_POST['send'])) {
		
		$ida = $_REQUEST['account_id'];
		$num = $_REQUEST['num'];
		$sen = $_REQUEST['sen'];
		$datepicker = $_REQUEST['datepicker'];
		/* echo $ida."-".$num."-".$sen."-".$datepicker;
		exit(1); */
		
		if($ida != null && $sen != null && $datepicker != null && $num ==""){
			
			$url = 'http://10.1.13.54:80/m_kj/server_mobile/push_notif_jalan.php';
			$data = array('ACCOUNT_ID' => $ida, 'SN_NUMBER' => $sen, 'TGL_KIRIM' => $datepicker);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);

			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			
			$note = "";
			if ($result === FALSE || $result == null || $result == "") {
				$note .= "Notifikasi gagal dikirimkan";
				echo "<script>alert('Notifikasi gagal dikirimkan');</script>";
			}else{
				$note .= "Notifikasi berhasil dikirimkan";
				echo "<script>alert('Notifikasi berhasil dikirimkan');</script>";
			}
			
		}else if($ida != null && $num != null){
			
			$url = 'http://10.1.13.54:80/m_kj/server_mobile/push_notif_promo.php';
			$data = array('ACCOUNT_ID' => $ida);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);

			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			
			$note = "";
			if ($result === FALSE || $result == null || $result == "") {
				$note .= "Notifikasi gagal dikirimkan";
				echo "<script>alert('Notifikasi gagal dikirimkan');</script>";
			}else{
				$note .= "Notifikasi berhasil dikirimkan";
				echo "<script>alert('Notifikasi berhasil dikirimkan');</script>";
			}
			
		}else{
			
			$url = 'http://10.1.13.54:80/m_kj/server_mobile/push_notif_achiev.php';
			$data = array('ACCOUNT_ID' => $ida);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);

			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			
			$note = "";
			if ($result === FALSE || $result == null || $result == "") {
				$note .= "Notifikasi gagal dikirimkan";
				echo "<script>alert('Notifikasi gagal dikirimkan');</script>";
			}else{
				$note .= "Notifikasi berhasil dikirimkan";
				echo "<script>alert('Notifikasi berhasil dikirimkan');</script>";
			}
			
		}
		
	}
	
  ?>
  
</html>
