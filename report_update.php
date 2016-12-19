<?php
//header('Content-Type: application/json');
include "koneksi.php";
ini_set('display_errors','0');


	   
	   
	   
	   /* $sql = "SELECT a.`ACCOUNT_ID`,
       a.`ACCOUNT_NAME`,
       a.`PRICEGROUP_CODE`,
       a.`CATEGORY_ID`,
       b.`SALES_ID`,
       b.`SALES_NAME`,
       b.`TGL_UPDATE`
 FROM `push_distributor`a 
Right JOIN `push_sales`b ON a.`SALES_ID` = b.`SALES_ID`
ORDER BY b.`SALES_ID` ASC;"; */

$sql = "SELECT * FROM push_sales;";
	   
	   
	   
	   echo "<table border='1' align=center>
	           <tr>
			      <th align=center>SALES_ID</th>
			      <th align=center>SALES_NAME</th>
			      <th align=center>TGL_UPDATE</th>
			      <th align=center>DISTRIBUTOR</th>
			      <th align=center>Name Dist</th>
			   </tr>";
	   
	   
	   
	   
	   $hasil = mysqli_query($mysqli, $sql);
	   
	   //$data = mysqli_fetch_assoc($hasil);
	   
	   
	   
	   //foreach($hasil as $row){
		while($row = mysqli_fetch_assoc($hasil)) {
			     
				 $sql2 = "SELECT * FROM `push_distributor` WHERE `SALES_ID` = '$row[SALES_ID]';";
				 $hasil2 = mysqli_query($mysqli, $sql2);
				

 			while($data_jos = mysqli_fetch_assoc($hasil2)){
				
				 $dist = $data_jos[ACCOUNT_ID];
				 $acc_name = $data_jos[ACCOUNT_NAME];
				 
				 
				 
				 echo "<tr>
				           <td align=center>$row[SALES_ID]</td>
				           <td align=center>$row[SALES_NAME]</td>
				           <td align=center>$row[TGL_UPDATE]</td>
				           <td align=center>$dist</td>
				           <td align=center>$acc_name </td>
				 
				      </tr>";
				 
					
				
			}//end while
 
	   };
	   
	   echo "</table>";
	   
	   //echo json_encode($jos);
	   //echo var_dump($jos);

	   
	   







?>