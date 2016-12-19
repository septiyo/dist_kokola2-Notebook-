<?php
require_once("koneksi.php");
if(isset($_GET['idku'])){

 
$accid=$_GET['idku'];    
$yearku = date('Y');
$lanku = date('m');
$data_cek=array();

//triwulan 1
$sql9x1 = "select SUM(BULAN1) as  BLN,SUM(BULAN2) as  BLN2, SUM(BULAN3) as  BLN3 from kj "
        . "where NAMA_DIST = '$accid' and TRIWULAN = 'Jan-Feb-Mar' and YEAR(TGL) = '$yearku' and publish='1'";
		$query9x1=mysqli_query($mysqli, $sql9x1);
  		$data9x1=mysqli_fetch_array($query9x1);//) {
        $data_cek[0][0] = $data9x1 ['BLN'];
        $data_cek[0][1] ='Jan';
        $data_cek[0][2] ='01';
        $data_cek[1][0] = $data9x1 ['BLN2'];
        $data_cek[1][1] ='Feb';
        $data_cek[1][2] ='02';
        $data_cek[2][0] = $data9x1 ['BLN3'];
        $data_cek[2][1] ='Mar';
        $data_cek[2][2] ='03';
//        $mi2 = $data9x1 ['BLN2'];
//        $mi3 = $data9x1 ['BLN3'];
        
                
//triwulan 2        
$sql9x4 = "select SUM(BULAN1) as  BLN,SUM(BULAN2) as  BLN2, SUM(BULAN3) as  BLN3 from kj "
        . "where NAMA_DIST = '$accid' and TRIWULAN = 'Apr-May-Jun' and YEAR(TGL) = '$yearku' and publish='1'";
		$query9x4=mysqli_query($mysqli, $sql9x4);
  		$data9x4=mysqli_fetch_array($query9x4);//) {
        $data_cek[3][0] = $data9x4 ['BLN'];
        $data_cek[3][1] ='Apr';
        $data_cek[3][2] ='04';
        $data_cek[4][0] = $data9x4 ['BLN2'];
        $data_cek[4][1] ='May';
        $data_cek[4][2] ='05';
        $data_cek[5][0] = $data9x4 ['BLN3'];
        $data_cek[5][1] ='Jun';
        $data_cek[5][2] ='06';
        
//        $mi4 = $data9x4 ['BLN'];
//        $mi5 = $data9x4 ['BLN2'];
//        $mi6 = $data9x4 ['BLN3'];	

//triwulan 3        
$sql9x7 = "select SUM(BULAN1) as  BLN,SUM(BULAN2) as  BLN2, SUM(BULAN3) as  BLN3 from kj where NAMA_DIST = '$accid' and TRIWULAN = 'Jul-Aug-Sep' and YEAR(TGL) = '$yearku' and publish='1'";
		$query9x7=mysqli_query($mysqli, $sql9x7);
  		$data9x7=mysqli_fetch_array($query9x7);//) {
               
                $data_cek[6][0] = $data9x7 ['BLN'];
                $data_cek[6][1] ='Jul';
                $data_cek[6][2] ='07';
                $data_cek[7][0] = $data9x7 ['BLN2'];
                $data_cek[7][1] ='Aug';
                $data_cek[7][2] ='08';
                $data_cek[8][0] = $data9x7 ['BLN3'];
                $data_cek[8][1] ='Sep';
                $data_cek[8][2] ='09';
//        $mi7 = $data9x7 ['BLN'];
//        $mi8 = $data9x7 ['BLN2'];
//        $mi9 = $data9x7 ['BLN3'];
		
		
//triwulan 4
$sql9x10 = "select SUM(BULAN1) as  BLN,SUM(BULAN2) as  BLN2, SUM(BULAN3) as  BLN3 from kj "
        . "where NAMA_DIST = '$accid' and TRIWULAN = 'Oct-Nov-Dec' and YEAR(TGL) = '$yearku' and publish='1'";
		$query9x10=mysqli_query($mysqli, $sql9x10);
  		$data9x10=mysqli_fetch_array($query9x10);//) {
                
            $data_cek[9][0] = $data9x10 ['BLN'];
            $data_cek[9][1] ='Oct';
            $data_cek[9][2] ='10';
            $data_cek[10][0] = $data9x10 ['BLN2'];
            $data_cek[10][1] ='Nov';
            $data_cek[10][2] ='11';
            $data_cek[11][0] = $data9x10 ['BLN3'];
            $data_cek[11][1] ='Dec';
            $data_cek[11][2] ='12';
            
//        $mi10 = $data9x10 ['BLN'];
//        $mi11 = $data9x10 ['BLN2'];
//        $mi12 = $data9x10 ['BLN3'];
	
        

 
$data=array();              
 
$nom=0;
for($i=0;$i<12;$i++){
   // echo $data_cek[$i][0].'<br/>';
      //echo $lanku."=".$data_cek[$i][2].'<br/>';
    if($lanku<=$data_cek[$i][2] && $data_cek[$i][0]!=''){
        $data[$nom][0]=$data_cek[$i][1];
        $data[$nom][1]=$data_cek[$i][2];
        $nom++;
    }
}
   $kirim = array('data' => $data);
        header('Content-type: application/json');
        echo json_encode($kirim);      
        
        
}
?>

