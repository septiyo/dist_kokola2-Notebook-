<?php
//connect to your database
  //mysql_connect("localhost","root","");
  //mysql_select_db("maintenance");
  include "../koneksi.php";
//harus selalu gunakan variabel term saat memakai autocomplete,
//jika variable term tidak bisa, gunakan variabel q
$term = trim(strip_tags($_GET['term']));
//$term = 'cho';
 
//$qstring = "SELECT nama_mesin FROM master_mesin WHERE nama_mesin LIKE '".$term."%'";
$qstring =" select ACCOUNT_NAME, ACCOUNT_ID from push_distributor  where   CATEGORY_ID = '49' 
         and ACCOUNT_NAME LIKE '%".$term."%'";
				
		/*select BB.ACCOUNT_ID, BB.ACCOUNT_NAME, BB.ACCOUNT_ADDRESS1, BB.ACCOUNT_CITY_ID1, AA.REGIONAL
				from user AA, push_distributor BB
				where AA.ACCOUNT_ID = BB.ACCOUNT_ID
				AND BB.CATEGORY_ID = '49' and BB.ACCOUNT_NAME LIKE '".$term."%'
				order by AA.REGIONAL desc, BB.ACCOUNT_CITY_ID1, BB.ACCOUNT_NAME	*/	
				
//$qstring = " select KATEGOPRI from m_produk where KATEGORI is not null group by KATEGORI LIKE '".$term."%' ;";
//query database untuk mengecek tabel Country 
$result = mysqli_query($mysqli, $qstring);
 
while ($row = mysqli_fetch_array($result))
{
    $row['value']=htmlentities(stripslashes($row['ACCOUNT_NAME']));
    //$row['id']=(int)$row['Code'];
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>