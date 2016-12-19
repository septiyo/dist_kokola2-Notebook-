<?php
require_once("../koneksi.php");
$distributor = isset($_REQUEST['NAMA']) ? $_REQUEST['NAMA'] : '';
$acc_id = isset($_REQUEST['ACC_ID']) ? $_REQUEST['ACC_ID'] : '';
$tgl = isset($_REQUEST['TGL']) ? $_REQUEST['TGL'] : ''; 

#echo $tgl."<br>".$acc_id;
?>
<table id='example2' class='display stripe row-border order-column' cellspacing='0' width='100%'>
	<thead>
    	<tr>
        	<th colspan="3"><?php echo $distributor;?></th>
        </tr>
        <tr>
        	<th>No</th>
        	<th>Produk</th>
            <th>QTY</th>
        </tr>
    </thead>
   
    <tbody>
	<?php
    $sqlDetail = "SELECT GG.account_id, GG.NAMA_PRODUK, GG.qty AS hasil, GG.KATEGORI
            FROM (
            SELECT * FROM
                (SELECT 
                    KK.ACCOUNT_ID AS account_id, 
                    KK.ITEM_CODE AS item_code ,
					
                    KK.JML_ORDER AS qty, 
					DATE(KK.TGL_CONFIRM) AS periode2,
                    LL.REGIONAL 
                FROM 
                    order_confirm KK, user LL
                WHERE 
                    KK.ACCOUNT_ID = LL.ACCOUNT_ID 
                ) AS CC 
                INNER JOIN 
                (
                    SELECT 
                        pt.item_code AS ii, 
                        pt.item_name AS NAMA_PRODUK, 
                        MP.KATEGORI													
                    FROM 
                    push_item pt 
                    LEFT JOIN m_produk MP ON pt.item_code = MP.ITEM_CODE
                ) AS XX
        ON XX.ii = CC.item_code
        ) AS GG 
        WHERE GG.account_id = '".$acc_id."'  AND GG.periode2 LIKE '".$tgl."%';";
		
		
    $myDetail = mysqli_query($mysqli, $sqlDetail);
	$nox = 1;
    while ($dataDetail = mysqli_fetch_array($myDetail)) {
    ?>
    	<tr>
        	<td><?php echo $nox;?></td>
        	<td><?php echo $dataDetail['NAMA_PRODUK'];?></td>
            <td align="right"><?php echo $dataDetail['hasil'];?></td>
        </tr>
    <?php
	$nox++;
    }
    ?>
    </tbody>
    
    
     <tfoot>
     <?php
    $sql_kj21 =" 									
					SELECT 
					a.ACCOUNT_ID, 
					SUM(a.JML_ORDER) AS TOTAL_ORDER,
					c.NAMA, c.KOTA
					
					FROM
					`user` c,
					order_confirm a 
					INNER JOIN 
						(
						SELECT 
						pt.item_code AS ii, 
						pt.item_name AS NAMA_PRODUK, 
						MP.KATEGORI
						
						FROM 
						push_item pt 
						LEFT JOIN m_produk MP ON pt.item_code = MP.ITEM_CODE
						)AS PTM ON PTM.ii = a.ITEM_CODE
					
					WHERE
					a.TGL_CONFIRM LIKE '".$tgl."%' AND
					
					a.ACCOUNT_ID = c.ACCOUNT_ID 
					AND  a.ACCOUNT_ID = '".$acc_id."'
					GROUP BY  a.ACCOUNT_ID;";
								
										
					$hasil_kj21 = mysqli_query($mysqli, $sql_kj21);
                	$data_kj21 = mysqli_fetch_array($hasil_kj21);
					#$totalku = $data_kj21['TOTAL_ORDER'];
					$totalku = $data_kj21['TOTAL_ORDER'];
					$toool =  number_format($totalku);
		#echo $sql_kj21;
	?>
    	<tr>
        	<th colspan="2">Total</th>
            <th align="right"><?php echo $toool; ?></th>
        </tr>
    </tfoot>
</table>
<?php
//echo $sqlDetail;
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $(document).ready(function () {
		$('#example2').DataTable({
			"scrollY": 300,
			"scrollX": true,
			/*fixedColumns:   {
				leftColumns: 1
			},*/
			"bInfo": false,
			"scrollCollapse": true,
			"ordering": false,
			"paging": false
		});
	});
});
</script>