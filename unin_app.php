<?php
include "koneksi.php";


$sql = "SELECT * FROM log_notif
INNER JOIN `user` ON `log_notif`.`ACCOUNT_ID` = `user`.`ACCOUNT_ID` 
WHERE `FAILURE` = 1
AND `log_notif`.`ACCOUNT_ID` NOT IN('2121','3131')
 GROUP BY user.`ACCOUNT_ID` ORDER BY log_notif.`DATE_TIME` DESC;";
 
 $hasil = mysqli_query($mysqli, $sql);
 
 

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<style>
   *{
   font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
   
   }
   </style>

<body>
<table align="center"  border="1" cellpadding="0" cellspacing="1">
  <tr>
     <th colspan="5">Daftar Unistall apps</th>
  </tr>
  <tr>
     <th>TGL</th>
     <th>ACC ID</th>
     <th>HAK</th>
     <th>NAMA</th>
     <th>KOTA</th>
     
  </tr>
  <?php
  
     while($data = mysqli_fetch_assoc($hasil)){
		 
		 echo "<tr>
				 <td>".$data[DATE_TIME]."</td>
				 <td>".$data[ACCOUNT_ID]."</td>
				 <td>".$data[HAK]."</td>
				 <td>".$data[NAMA]."</td>
				 <td>".$data[KOTA]."</td>
				 
        		</tr>";
		 
	 
	 }
  
  
  ?>
  
  
  
</table>
</body>
</html>