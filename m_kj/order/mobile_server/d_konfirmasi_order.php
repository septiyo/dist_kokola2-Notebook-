<?php

error_reporting(0);
require_once("../koneksi.php");

if (isset($_POST['id_order'])) {
    $catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';
    $ck_ps = isset($_POST['sts']) ? $_POST['sts'] : '';
    $id_order = $_POST['id_order'];
    $sqlOrder = "UPDATE order_distributor SET STATUS_APR='1', CATATAN2='".$catatan."', SBG='".$ck_ps."' WHERE ID_ORDER='" . $id_order . "'";

    $mysqOrder = mysql_query($sqlOrder);

    if ($mysqOrder) {
        $kirim = array('status' => "sukses");
        header('Content-type: application/json');
        echo json_encode($kirim);
    } else {
        $kirim = array('status' => "gagal konfirmasi");
        header('Content-type: application/json');
        echo json_encode($kirim);
    }
}
?>
