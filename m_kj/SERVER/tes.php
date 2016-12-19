<?php

$array = array(
    0 => array(
        'item' => 'kukis',
        'forcast' => '2000'
    ),
    1 => array(
        'item' => 'montego',
        'forcast' => '4000'
    ),
	2 => array(
        'item' => 'danish',
        'forcast' => '5000'
    ),
);  

foreach ($array as $key => $value) {

    $thisArray = $array[$key];
	
	//$tes = $value;
	echo $value['item']."<br>";
	echo $value['forcast'];
	
	//echo $thisArray;

    print_r('<ul>');
			 foreach ($thisArray as $key2 => $value){
	     		  print_r('<li>'.$thisArray[$key2].'</li>');
			}
    print_r('</ul>');
}
?>