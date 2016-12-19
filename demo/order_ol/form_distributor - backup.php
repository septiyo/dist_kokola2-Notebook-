<?php
if(session_id() == '') {
    session_start();
}
if (!isset($_SESSION["USER"])){
	header('Location: index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;">
<title>Form Distributor</title>
<link rel="stylesheet" href="themes/pelangi.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />

<link rel="stylesheet" href="themes/blitzer/jquery-ui.min.css" />
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/dataTables.jqueryui.css" type="text/css"/>
<!--<link rel="stylesheet" href="css/responsive.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/responsive.jqueryui.css" type="text/css"/>-->
<link rel="stylesheet" href="css/alertify.css" type="text/css"/>
<link rel="stylesheet" href="css/default.css" type="text/css"/>
<style type="text/css">
#identitas {
	color: rgba(0,102,153,1);
}
#div_order {
	/*margin-top: 20px;*/
}

#cari {
	font-size:12px;
	padding:0 5px;
}

.dataTables_filter {
	display: none; 
}

#overlay {
	background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
	display: none; 
}
/*ini aneh, bener2 aneh, sama tp beda hasil */
/*#overlay { 
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
}​*/

#overlay span {
	text-shadow:none;
	text-align:center;
	color: rgba(255,51,51,1);
    margin: 0;
    background: rgba(204,204,153,1);
	padding:10px 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
	
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border: 0px solid #000000;
}
.ui-corner-all {
	-moz-border-radius:0 !important;
    -webkit-border-radius:0 !important;
    border-radius:0 !important;
}
#tb_data {
	color:rgba(0,102,153,1);
}
input.order:disabled {
	/*background-color:rgba(255,0,0,1);*/
	background-color:#F66;
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAIklEQVQIW2NkQAKrVq36zwjjgzhhYWGMYAEYB8RmROaABADeOQ8CXl/xfgAAAABJRU5ErkJggg==) repeat #F66;
}
.real {
	color:#090;
}
.sisa {
	color:#C30;
}
.expanded-group{
	background: url("images/down.png") no-repeat scroll left center transparent;
	padding-left: 25px !important;
	background-size:18px;
	background-color:inherit;
	background-color:#ddd;
	color:inherit;
	text-shadow:none;
	cursor:pointer;
}

.collapsed-group{
	background: url("images/up.png") no-repeat scroll left center transparent;
	padding-left: 25px !important;
	background-size:18px;
	background-color:#ccd;
	color:inherit;
	text-shadow:none;
	cursor:pointer;
}

</style>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.jqueryui.min.js"></script>
<!--<script type="text/javascript" src="js/dataTables.responsive.js"></script>
<script type="text/javascript" src="js/responsive.jqueryui.js"></script>-->
<script type="text/javascript" src="js/jquery.dataTables.rowGrouping.js"></script>
<script type="text/javascript" src="js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="js/alertify.js"></script>
<script type="text/javascript">
var oTable;
/*var calcDataTableHeight = function() {
	return ($(window).height()*57/100);
};*/
$(document).ready(function(e) {
	resize();
	var jml_sisa = 0;
	var t_minus = $("div[data-role=header]").height() + $("div[data-role=footer]").height();
	var tinggi = $(window).height()-t_minus-t_minus-t_minus-28;
	oTable = $("#tb_order").dataTable({
		"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Data yang dicari tidak ada, maaf bro",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"emptyTable": "Belum ada data KJ bro",
			"sLoadingRecords": "Please wait - loading...",
        },
		//"fixedColumns": true,
		"bSort" : false,
		"bPaginate": false,
		"scrollX": true,
		//"scrollY": "100vh",
		"scrollY": tinggi,
		"scrollCollapse": true,
		"bJQueryUI": true,
		"bInfo": false,
		//"bFilter": false,		
		"dom": '<"top"i>rt<"bottom"flp><"clear">',
		//"orderCellsTop": true ,
		"rowCallback": function( row, data, index ) {
			$('td:eq(2)', row).html( format_digit(data[2]) );
			$('td:eq(3)', row).html( format_digit(data[3]) );
			$('td:eq(4)', row).html( format_digit(data[2]-data[3]) );
			jml_sisa = jml_sisa + (data[2]-data[3]);
			
		},
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;
			var total1 = api.column( 2 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var total2 = api.column( 3 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			var total3 = api.column( 4 ).data().reduce( function (a, b) {
				return Number(a) + Number(b);
			}, 0 );
			
			$("#total_kj").html(format_digit(total1));
			$("#total_real").html(format_digit(total2));
			//$("#total_sisa").html(format_digit(total3));
			$("#total_sisa").html(format_digit(jml_sisa));
			
		}
	});
	
	$("#cari").on("keyup", function() {
		//oTable.columns(0).search($(this).val()).draw() ; // search column 1
		//oTable.search($(this).val()).draw() ;
		cari_table();
	});
	
	setInterval( function () {
		//oTable.ajax.reload(); // user paging is not reset on reload
		//$('#tb_order').dataTable()._fnAjaxUpdate();
	}, 10000 );
	
	$(".order").each(function(index, element) {
		if ($(element).parents("tr").find(".kj").text() == 0 ) {
        	$(element).attr("disabled", "disabled");
		}
		else {
			$(element).removeAttr("disabled");
		}
    });
	
	/*$(".order").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });*/	
	
	$(".order").keypress(function (e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			//display error message
			//$("#errmsg").html("Digits Only").show().fadeOut("slow");
			return false;
		}
	}).keyup(function(e) {
		if ($(this).val() > $(this).parents('tr').find('.sisa').text()) {
			//$(this).val($(this).parents('tr').find('.sisa').text())
		}
        if (this.value.length > this.getAttribute("maxlength")) {
			this.value = this.value.slice(0,this.getAttribute("maxlength")); 
		}
		else {
			var jml_kubik = $(this).val() * $(this).parents('tr').find('.kubik').text();
			$(this).parents('tr').find('.jml_kubik').text(jml_kubik.toString().slice(0,8));
		}
		var total_kubik = 0;
		$(".jml_kubik").each(function(index, element) {
            total_kubik = total_kubik + Number($(this).text())
        });
		$("#grand_kubik").text(total_kubik);
    });
	
	$("#BTN_SIMPAN").on("click", function() {
		var arr = [];
		var i = 0;		
		
		//alert($("#tb_order tbody tr:hidden").length);
		$(".order").each(function(index, element) {
            if ($(element).val()!=="") {				
				arr.push({
					produk:$(element).parents("tr").find(".produkid").text(),
					kj: Number($(element).parents("tr").find(".kj").text().replace(".","")),
					real: Number($(element).parents("tr").find(".real").text().replace(".","")),
					sisa: Number($(element).parents("tr").find(".sisa").text().replace(".","")),
					order:$(element).val(),
					item_code:$(element).parents("tr").find(".item_code").text(),
				});
				i++;
			}
        });		
		
		if (arr.length == 0) {
			alertify.dialog('alert').set({transition:'zoom',
					message: "Minimal isi 1 data order produk",
					title: "Pesan Keliru"
				}).show();
			return false;
		}
		var form_data = {
			USERID:$("#session").text(),
			CATATAN:$("#catatan").val(),
			ACCID:$("#acc_id").text(),
			PRODUK:$("#catatan").val(),
			ARR: arr,
			//REAL: real,
			//SISA: sisa,
		};
		
		//alertify.confirm('a callback will be invoked on ok.').set('onok', function(closeEvent){ alertify.success('Ok');} );
		alertify.confirm().setting({
			title:'Simpan Order',
			message: 'Data order yang telah disimpan tidak bisa dirubah lagi. <br />' +
				'Pastikan data order anda sudah benar?',
			transition:'zoom',
            cancel: 'Batal',
			onok: function(){
				$("#overlay").fadeIn();
				$.ajax({
					url:'simpan_order.php',
					data:form_data,
					type:'POST',
					dataType:"html",
					timeout: 7000,
					beforeSend: function(xhr) {
						
					},
					success: function(hasil) {
						alertify.dialog('alert').set({transition:'zoom',
							message: hasil,
							title: "Pesan Simpan"
						}).show();
					},
					complete: function() {
						$("#overlay").fadeOut();
						reset_form();
						cari_table();
					},
					error: function (jqXHR, textStatus, errorThrown) {
						
						alertify.dialog('alert').set({transition:'zoom',
							message: textStatus,
							title: "Pesan Keliru"
						}).show();
						$("#overlay").fadeOut();
					}
				}).done(function(hasil){
								
				});	
			}
		}).show();
		return false;
		
			 
	});
});

function resize() {
	var lebar = $(window).width();
	//$("#lebar").html(lebar);
	
	if (lebar <= 624) {
		$("#div_order").css("font-size","12px");
		$("div[data-role=content]").css("padding","5px");
		var t_minus = $("div[data-role=header]").height() + $("div[data-role=footer]").height();
		var tinggi = $(window).height()-t_minus-t_minus-t_minus-10;
		$('.dataTables_scrollBody').css('height', tinggi);
	}
	else {
		$("#div_order").css("font-size","16px");
		$("div[data-role=content]").css("padding","10px");
		var t_minus = $("div[data-role=header]").height() + $("div[data-role=footer]").height();
		var tinggi = $(window).height()-t_minus-t_minus-t_minus-28;
		$('.dataTables_scrollBody').css('height', tinggi);
	}
	
	//$("#lebar").html(tinggi);
}

function reset_form() {
	$(".order").each(function(index, element) {
        $(element).val("");
    });
	$("#catatan").val("");
	$("#cari").val("");
}

function format_digit( toFormat ) {
	return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

function cari_table() {
	var value = $("#cari").val();	
	$("table tbody tr").each(function(index, element) {
		if (index >= 0) {	
			$row = $(this);	
			var id = $row.find("td:first").text().toLowerCase();
			if (id.indexOf(value) < 0) {							
				$row.hide();					
			}
			else {	
				$row.show();
				
			}
		}
	});
	if ($("table tbody tr:visible").size() == 0) {
		$("table tbody").append("<tr id='kosong'>"+
			"<td colspan='5' align='center' style='color:#f00;'>Data yang dicari tidak ada, maaf bro</td></tr>");
	}
	else {
		$("#kosong").remove();
	}
}

$(document).on('click', '.ui-input-clear', function () {
	cari_table();
});

$(document).on("pageinit", function() {	
	var xTable = $("#tb_data").dataTable({		
		"bSort" : false,
		"bPaginate": false,
		"scrollX": true,
		"scrollY": "65vh",
		"scrollCollapse": true,
		"bJQueryUI": true,
		"bInfo": false,
		"ajax": {
            "url": "get_order.php",
            "dataSrc": "data"
        },
		"language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Data yang dicari tidak ada, maaf bro",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
			"emptyTable": "Belum ada data bro"
        },
		"columnDefs": [
			{ targets: [ 2, 3, 4 ], sClass: "center", },
			{ visible: false, "targets": 0 }
		],
		/*"drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }*/
	}).rowGrouping({
		iGroupingColumnIndex:0,
		bExpandableGrouping: true,
		bExpandSingleGroup: false,
		iExpandGroupOffset: -1,
		asExpandedGroups: [""]
	});
});

</script>
</head>

<body onresize="resize()">
<?php
require_once("koneksi.php");
$url = "http://localhost/dist_kokola/";
?>
<div data-role="page" data-theme="o">
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
        <div class="ui-btn-left" data-role="controlgroup" data-type="horizontal">
        	<a id="btn_order" href="<?php echo $url.'dist.php';?>" data-role="button" data-icon="home" data-ajax="false" data-iconpos="notext">Home</a>
            <a id="btn_order" href="data_kj.php" data-role="button" data-icon="grid" data-ajax="false" data-mini="true">KJ</a>
        </div>
		<h1 style="width:170px;margin:auto;">
            Form Distributor
        </h1>
        <a id="btn_order" href="data_order.php" data-transition="slide" class="ui-btn-right" data-icon="grid">Order</a>
	</div>

	<div data-role="content">
		<div id="identitas">
        	<div id="lebar"></div>
            <div id="overlay">
                <span>
                	<b>Menyimpan....</b><br />
                    <img src="images/ajax-loader-bar.gif" />
                </span>
            </div>
            <div id="div_order">
            	<!--<input type="number" pattern="[0-9]*">-->
                <table id="tb_order" class="display cell-border compact" cellspacing="0" width="100%">
                    <thead>
                    	<tr>
                        	<th colspan="7" align="left" valign="middle" style="border-top:1px solid;">
                            <span style="margin-right:15px;display:inline-block;">
                                Nama : <?php echo ucwords($nama);?>
                                <span id="session" style="display:none"><?php echo $_SESSION["USER"];?></span>
                            	<span id="acc_id" style="display:none"><?php echo $account_id;?></span>
                            </span>
                            <span style="display:inline-block;float:right;margin-right:-5px;">
                                <input id="cari" type="search" style="width:70px;padding-left:20px;" placeholder="Cari" onsearch="cari_table(this)" />
                            </span>
                            <span style="display:block;margin-top:5px;">
                            	Tgl : <?php echo date('d')." ".$nm_bulan." ".date('Y'); ?>
                            </span>
                            </th>
                       	</tr>
                        <tr>
                        	<th align="center"><center>Nama Produk</center></th>
                            <th align="center"><center>Kubik</center></th>
                        	<th align="center"><center>KJ</center></th>
                            <th align="center"><center>Real</center></th>
                            <th align="center"><center>Sisa</center></th>
                        	<th align="center"><center>Order</center></th>
                            <th align="center"><center>Kubik</center></th>
                        </tr>
                    </thead>
                    <tfoot>
                    	<tr>
                        	<th align="center"><center>&nbsp;</center></th>
                            <th align="center"><center><div id="total_kubik"></div></center></th>
                        	<th align="center"><center><div id="total_kj"></div></center></th>
                            <th align="center"><center><div id="total_real"></div></center></th>
                            <th align="center"><center><div id="total_sisa"></div></center></th>
                        	<th align="center"><center><div id="total_order"></div></center></th>
                            <th align="center"><center><div id="grand_kubik"></div></center></th>
                        </tr>
                        <tr>
                        	<th colspan="2" align="left" valign="top">
                                <input id="catatan" name="catatan" data-mini="true" type="text" placeholder="Catatan" />
                            </th>
                            <th colspan="5" valign="top">
                            	<button id="BTN_SIMPAN" type="button" data-mini="true">Simpan</button>
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php					
					$sql_order = "select AA.ID, AA.NAMA_PRODUK, AA.SATUAN, AA.HARGA, AA.ITEM_CODE,
						COALESCE(KJ.FORECAST,0) as FORECAST,
						COALESCE(KJ.BULAN1,0) as BULAN1,
						COALESCE(KJ.BULAN2,0) as BULAN2,
						COALESCE(KJ.BULAN3,0) as BULAN3,
						COALESCE(OK.qty,0) as QTY,
						YES.qty as KJ_KIRIM,
						COALESCE(KB.KUBIK,0) as KUBIK
						from m_produk AA
						left join 
						(select ID_PRODUK, COALESCE(FORECAST,0) as FORECAST,
							COALESCE(BULAN1,0) as BULAN1,
							COALESCE(BULAN2,0) as BULAN2,
							COALESCE(BULAN3,0) as BULAN3 from kj
							where KJ.TRIWULAN like '%".$nm_bulan."%'
							and ACCOUNT_ID = '".$account_id."') KJ
						on AA.ID = KJ.ID_PRODUK
						left join 
							(select account_id, item_code, date_format(periode1, '%Y %m') as periode1,
							date_format(periode2, '%Y %m') as periode2, sum(qty) as qty, 'sun'
							from order_kirim
							where flag = 1
							and date_format(periode1, '%Y %m') = date_format(now(), '%Y %m')
							and date_format(periode2, '%Y %m') = date_format(now(), '%Y %m')
							and account_id = '".$account_id."'
							group by account_id, item_code, date_format(periode1, '%Y %m'),
							date_format(periode2, '%Y %m')) OK
							on AA.ITEM_CODE = OK.ITEM_CODE
						left join
							(select account_id, item_code, date_format(periode1, '%Y %m') as periode1,
							date_format(periode2, '%Y %m') as periode2, sum(qty) as qty, 'sun'
							from order_kirim_wd
							where flag = 1
							and date_format(periode1, '%Y %m') = date_format(now(), '%Y %m')
							and date_format(periode2, '%Y %m') = date_format(now(), '%Y %m')
							and account_id = '".$account_id."'
							group by account_id, item_code, date_format(periode1, '%Y %m'),
							date_format(periode2, '%Y %m')) YES
							on AA.ITEM_CODE = YES.ITEM_CODE
						left join
							(select ITEM_CODE, PANJANG, TINGGI, LEBAR, KUBIK from kubikasi
							where AKTIF_JUAL = '1') as KB
							on AA.ITEM_CODE = KB.ITEM_CODE
						where KJ.FORECAST > 0";
						
					$my_order = mysql_query($sql_order);
					
					while ($order = mysql_fetch_assoc($my_order)) {
						$mod = date('m')%3;
						if ($mod == 1) {
							$kj = $order['BULAN1'];
							//$qty = $order['QTY1'];
							//$sisa = 0;
						}
						elseif ($mod == 2) {
							$kj = $order['BULAN2'];
							//$qty = $order['QTY2'];
							//$sisa = $order['BULAN1'] - $order['QTY1'];
						}
						elseif ($mod == 0) {
							$kj = $order['BULAN3'];
							//$qty = $order['QTY3'];
							//$sisa = ($order['BULAN1'] - $order['QTY1']) + ($order['BULAN2'] - $order['BULAN2']);
						}
					?>
                    	<tr nama='baris'>
                        	<td class="nama_produk" style="min-width:100px;"><?php echo $order['NAMA_PRODUK'];?>
                            	<span style="color:#F33">(<?php echo $order['SATUAN'];?>)</span>
                                <span class="produkid" style="display:none;"><?php echo $order['ID'];?></span>
                                <span class="item_code" style="display:none;"><?php echo $order['ITEM_CODE'];?></span>
                            </td>    
                            <td align="center" class="kubik"><?php echo $order['KUBIK'];?></td>                        
                            <td align="center" class="kj"><?php echo $kj;?></td>
                            <td align="center" class="real"><?php echo $order['QTY'];?></td>
                            <td align="center" class="sisa">&nbsp;</td>                        
                            <td>
                            	<input type="number" class="order" maxlength="5" pattern="[0-9]*" min="0" max="10000" inputmode="numeric" data-mini="true" value="<?php echo $order['KJ_KIRIM'];?>" style="min-width:50px;" /></td>
                            <td align="center" class="jml_kubik">&nbsp;</td>     
                        </tr>
                    <?php
					}
					?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
	
	<div data-role="footer" data-position="fixed" data-tap-toggle="false">
    <!--<div data-role="footer" data-position="fixed">-->
		<h4>Copyright<!-- © --> &#169; 2016 Kokola Group</h4>
	</div>
</div>

</body>
</html>