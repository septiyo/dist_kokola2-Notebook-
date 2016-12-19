<?php
include "../koneksi.php";
if  (isset($_POST['SAVEKU'])) {
$pk = $_POST['LANCAR']; 				
$jumlah_kutu = count($pk);
$n = 0;
        while ($n < $jumlah_kutu) {
           
               
               
				
                $sql_a = "INSERT INTO hari_kerja SET TGL = '$pk[$n]'";
                $hasil_a = mysqli_query($mysqli, $sql_a);
         
            $n++;
        }

}

if ($hasil_a) {
	//echo $sql_a;
	//echo "Berhasil";
	echo "<script>alert('Data time gone berhasil disimpan!');
     window.location='timegone.php';
     </script>";

}
else {//echo $sql_a ;
echo "Gagal";
 }
 ?>