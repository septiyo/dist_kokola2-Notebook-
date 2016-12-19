<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <script src="jqm2/jquery-2.1.4.min.js"></script>
      <script src="jqm2/jquery.mobile-1.4.5.min.js"></script>

      <script src="validation/jquery.validate.js"></script>
      <link rel="stylesheet" href="themes/9septi_season.min.css" />
      <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
      <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" /-->
      <link rel="stylesheet" href="jqm2/jqmobile.structure-1.4.5.min.css"/>
  </head>

<body>

<div data-role="page" class="type-interior" data-theme="f">
    <div data-role="header">
        <h1>Forcast FORM </h1>

        <h2>Kokola Distributor 2.0</h2>
    </div>

    <div data-role="content">

<h2 align="center">DistriButor KJ / FORECAST</h2>
<?php
include "koneksi.php";
?>

   <table  border="1" cellpadding="1" cellspacing="0" align="center">
      <tr>
         <td><?php echo "<a href='dist_forcast.php?BULAN=JFM' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
         <td><?php echo "<a href='edit_forcast.php?BULAN=JFM' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

      </tr>
       <!--tr>
           <td colspan="2" align="center"><h3>Apr-Mei-Jun</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=AMJ' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=AMJ' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr>
       <tr>
           <td colspan="2" align="center"><h3>Jul-Agu-Sep</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=JAS' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=JAS' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr>
       <tr>
           <td colspan="2" align="center"><h3>Okt-Nov-Des</h3></td>
       </tr>
       <tr>
           <td><?php echo "<a href='dist_forcast.php?BULAN=OND' data-role='button' data-ajax='false' target='_parent'>Add Forecast</a>";?></td>
           <td><?php echo "<a href='edit_forcast.php?BULAN=OND' data-role='button' data-ajax='false' target='_parent'>Edit Forecast</a>";?></td>

       </tr-->
   </table>
    </div><!--emnd role-content-->

    <div data-role="footer">
        <h2>Kokola Web Developer Department, 2016</h2>
    </div>


</div><!--end role page-->
</body>
</html>