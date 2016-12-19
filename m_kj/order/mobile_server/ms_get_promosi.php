<?php
error_reporting(0);
require_once("../koneksi.php");

if(isset($_GET['id'])){

$view="";                                      
                                            
    $sql_transport = "select KALIMAT from kata_sakti";
    $mysql_transport = mysql_query($sql_transport);
    
  
    while ($dataTransport = mysql_fetch_assoc($mysql_transport)) {     
  
     $view.=$dataTransport['KALIMAT'];
        
  }


   echo $view;
}
?>

                       
                        
                        
                      
                        



