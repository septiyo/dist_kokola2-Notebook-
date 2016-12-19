<?php
if(isset($_POST)){

   $name = $_POST['name'];
    $email = $_POST['$email'];

    /*$jumlah = count($name);
    echo $jumlah;*/
    /*foreach( $_POST['name'] as $v ) {
        print $v;
    }*/

    foreach($name as $key => $n){

       print "name = ".$n." email = ".$email[$key];

    }



    $array = array("1st" => "My House", "2nd" => "My Car", "3rd" => "My Lab");
    foreach ($array as $key => $someVar) {
        echo $key . ": " . $someVar . "<br />\n";
    }


    /*foreach( $name as $key => $n ) {
        print "The name is ".$n." and email is ".$email[$key].", thank you\n";
    }*/


}

?>



<form method="post" action="tes.php">

    <?php

       $i = 0;
       while($i <= 5){

           echo "name $i<input type='text' name='name[]' />";
           echo "email $i<input type='text' name='email[]' /><br>";

        $i++;
       }
    ?>


   <input type="SUBMIT" value="SAVE" name="SAVE">

</form>
