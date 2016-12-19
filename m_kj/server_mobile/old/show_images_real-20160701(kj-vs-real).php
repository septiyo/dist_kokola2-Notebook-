<?php
require_once("koneksi.php");

$acid = isset($_REQUEST['USER']) ? $_REQUEST['USER'] : '';

$sql = mysql_query("SELECT aa.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, aa.NAMA_PRODUK FROM(
					SELECT k.ITEM_CODE,(
							CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
								THEN BULAN3 
							ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
						INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
							WHERE k.ACCOUNT_ID ='".$acid."' 
							AND k.TRIWULAN = (
								CASE WHEN MONTH(CURDATE()) = '1'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '2'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '3'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '4'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '5'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '6'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '7'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '8'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '9'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '10'
									THEN 'Oct-Nov-Dec'
									WHEN MONTH(CURDATE()) = '11'
									THEN 'Oct-Nov-Dec'
									WHEN MONTH(CURDATE()) = '12'
									THEN 'Oct-Nov-Dec'
									ELSE ''
									END)
							GROUP BY k.ITEM_CODE) aa
				 LEFT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
						INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
							WHERE ok.ACCOUNT_ID = '".$acid."' 
							AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
							AND ok.periode2 = CURDATE() 
							AND flag = 1
							GROUP BY ok.item_code) bb
				ON aa.ITEM_CODE = bb.item_code
				UNION
				SELECT bb.ITEM_CODE, aa.KJ_BULAN_INI, bb.KIRIM_BULAN_INI, bb.NAMA_PRODUK FROM(
					SELECT k.ITEM_CODE,(
							CASE WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '1'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '2'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Jan-Feb-Mar' && MONTH(CURDATE()) = '3'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '4'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '5'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Apr-May-Jun' && MONTH(CURDATE()) = '6'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '7'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '8'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Jul-Aug-Sep' && MONTH(CURDATE()) = '9'
								THEN BULAN3 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '10'
								THEN BULAN1 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '11'
								THEN BULAN2 
							WHEN TRIWULAN <= 'Oct-Nov-Dec' && MONTH(CURDATE()) = '12'
								THEN BULAN3 
							ELSE BULAN1 END) AS KJ_BULAN_INI,mp.NAMA_PRODUK FROM kj k
						INNER JOIN m_produk mp ON k.ITEM_CODE = mp.ITEM_CODE
							WHERE k.ACCOUNT_ID ='".$acid."' 
							AND k.TRIWULAN = (
								CASE WHEN MONTH(CURDATE()) = '1'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '2'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '3'
									THEN 'Jan-Feb-Mar'
									WHEN MONTH(CURDATE()) = '4'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '5'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '6'
									THEN 'Apr-May-Jun'
									WHEN MONTH(CURDATE()) = '7'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '8'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '9'
									THEN 'Jul-Aug-Sep'
									WHEN MONTH(CURDATE()) = '10'
									THEN 'Oct-Nov-Dec'
									WHEN MONTH(CURDATE()) = '11'
									THEN 'Oct-Nov-Dec'
									WHEN MONTH(CURDATE()) = '12'
									THEN 'Oct-Nov-Dec'
									ELSE ''
									END)
							GROUP BY k.ITEM_CODE) aa
				 RIGHT JOIN (SELECT ok.item_code,ok.qty AS KIRIM_BULAN_INI,mp.NAMA_PRODUK FROM order_kirim ok 
						INNER JOIN m_produk mp ON ok.item_code = mp.ITEM_CODE
							WHERE ok.ACCOUNT_ID = '".$acid."' 
							AND ok.periode1 = DATE_FORMAT(NOW() ,'%Y-%m-01')
							AND ok.periode2 = CURDATE() 
							AND flag = 1
							GROUP BY ok.item_code) bb
				ON aa.ITEM_CODE = bb.item_code;") or die("Note: ".mysql_error());

$results = array();
while ($row = mysql_fetch_array($sql)) {
	
	$itc = $row['ITEM_CODE'];
	$kjbi = $row['KJ_BULAN_INI'];
	$kibi = $row['KIRIM_BULAN_INI'];
	$nama = $row['NAMA_PRODUK'];

	if($kjbi == null || $kjbi == ""){
		$kjbi = 0;
	}
	if($kibi == null || $kibi == ""){
		$kibi = 0;
	}
	
	$perr = round(($kibi/$kjbi)*100, 2);
	
    $results[] = array(
        'ITEM_CODE' => $itc,
        'KJ_BULAN_INI' => $kjbi,
        'KIRIM_BULAN_INI' => $kibi,
		'PERSENTASE' => $perr,
        'NAMA_PRODUK' => $nama
    );
}

/*--------------------------------------------------------------*/
/*function sortby($a, $b){
	
	//return $a['PERSENTASE'] - $b['PERSENTASE'];//asc
	/* if($a['KJ_BULAN_INI']==$b['KJ_BULAN_INI']) return 0;//desc
    return $a['KJ_BULAN_INI'] < $b['KJ_BULAN_INI']?1:-1; */

//}

//usort($results,'sortby');
/*--------------------------------------------------------------*/

class Utility {
    /*
    * @param array $ary the array we want to sort
    * @param string $clause a string specifying how to sort the array similar to SQL ORDER BY clause
    * @param bool $ascending that default sorts fall back to when no direction is specified
    * @return null
    */
    public static function orderBy(&$ary, $clause, $ascending = true) {
        $clause = str_ireplace('order by', '', $clause);
        $clause = preg_replace('/\s+/', ' ', $clause);
        $keys = explode(',', $clause);
        $dirMap = array('desc' => 1, 'asc' => -1);
        $def = $ascending ? -1 : 1;

        $keyAry = array();
        $dirAry = array();
        foreach($keys as $key) {
            $key = explode(' ', trim($key));
            $keyAry[] = trim($key[0]);
            if(isset($key[1])) {
                $dir = strtolower(trim($key[1]));
                $dirAry[] = $dirMap[$dir] ? $dirMap[$dir] : $def;
            } else {
                $dirAry[] = $def;
            }
        }

        $fnBody = '';
        for($i = count($keyAry) - 1; $i >= 0; $i--) {
            $k = $keyAry[$i];
            $t = $dirAry[$i];
            $f = -1 * $t;
            $aStr = '$a[\''.$k.'\']';
            $bStr = '$b[\''.$k.'\']';
            if(strpos($k, '(') !== false) {
                $aStr = '$a->'.$k;
                $bStr = '$b->'.$k;
            }

            if($fnBody == '') {
                $fnBody .= "if({$aStr} == {$bStr}) { return 0; }\n";
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n";               
            } else {
                $fnBody = "if({$aStr} == {$bStr}) {\n" . $fnBody;
                $fnBody .= "}\n";
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n";
            }
        }

        if($fnBody) {
            $sortFn = create_function('$a,$b', $fnBody);
            usort($ary, $sortFn);       
        }
    }
}

Utility::orderBy($results, 'PERSENTASE ASC, KJ_BULAN_INI DESC');

$icd = "";
for($i=0;$i<3;$i++){
	$icd .= "'".$results[$i]['ITEM_CODE']."',";
}
//print_r($icdpush);exit();
$icd = rtrim($icd, ",");
//echo $icd;exit();
$squrl = mysql_query("SELECT mp.ITEM_CODE, mp.NAMA_PRODUK, tp.URL FROM m_produk mp 
						INNER JOIN tb_produk tp
						ON mp.ITEM_CODE = tp.ITEM_CODE
						WHERE mp.ITEM_CODE IN (". $icd .")
						ORDER BY FIELD(mp.ITEM_CODE, ". $icd .");") or die("Note: ".mysql_error());

$resurl = array();

while ($row = mysql_fetch_array($squrl)) {
	
	$u = $row['URL'];
	if($u == null || $u == ""){
		$u = "http://119.252.168.10:388/m_kj/server_mobile/images/default.png";
	}
	
    $resurl[] = array(
		'ITEM_CODE' => $row['ITEM_CODE'],
        'nama_produk' => $row['NAMA_PRODUK'],
        'URL' => $u
    );
}

$json = json_encode($resurl);
echo $json;

?>