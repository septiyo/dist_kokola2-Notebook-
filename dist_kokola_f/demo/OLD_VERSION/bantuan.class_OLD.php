<?php

class bantuan {

    /*function __construct(){
    }*/


   function rid(){

       $number = array("1","2","3","4","5","6","7","8","9","0");

       $huruf = array("A","B","C","D","E");



       shuffle($number);

       shuffle($huruf);



       $rid =  $huruf[0].$number[0].$number[1].$number[2].$number[3].$number[4];

       return $rid;

   }

   function hari_indo(){

       date_default_timezone_set("Asia/Jakarta");

       switch (date('N')) {
           case '1':
               $hari = 'Senin';
               return $hari;
               break;
           case '2':
               echo 'Selasa';
               return $hari;
               break;
           case '3':
               $hari = 'Rabu';
               return $hari;
               break;
           case '4':
               $hari = 'Kamis';
               return $hari;
               break;
           case '5':
               $hari = 'Jumat';
               return $hari;
               break;
           case '6':
               $hari = 'Sabtu';
               return $hari;
               break;
           case '7':
               $hari = 'Minggu';
               return $hari;
               break;


       }//end swirch


   }//end fucntion hari_ind

    function tgl_indo($type){

        $today          = date(d)."-".date(m)."-".date(Y);
        $today_database = date(Y)."-".date(m)."-".date(d);
        $time = date('H:i:s');

        $shift = "3";
        $day_before = date( 'Y-m-d', strtotime( $today_database . ' -1 day' ) );


        /*if($time < "09:00:00"){

            $shift = "3";
            $day_before = date( 'Y-m-d', strtotime( $today_database . ' -1 day' ) );

        }*/


        switch($type){

            case "tgl_indo" :
                 $tgl = $today;
                 return $tgl;
                 break;

            case "tgl_data" :
                $tgl = $today_database;
                return $tgl;
                break;

            case "waktu" :
                $tgl = $time;
                return $tgl;
                break;

            case "tgl_min_1" :
                $tgl = $day_before;
                return $tgl;
                break;


        }//end swithc


    }//end function


    /*function __destruct(){
    }*/


}


?>