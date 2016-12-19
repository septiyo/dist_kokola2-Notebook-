<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no; target-densityDpi=device-dpi" />
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<title>Kokola Group</title>
<link rel="apple-touch-icon-precomposed" href="images/user_password.png" />
<link rel="apple-touch-startup-image" href="images/application.png">
<link rel="stylesheet" href="themes_kokola/my-theme.css" />
<link rel="stylesheet" href="themes_kokola/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="themes_kokola/jquery.mobile.structure-1.4.5.min.css" />
<style type="text/css">
html,body{
	height:100%;
	padding:0;
	margin:0;
	overflow:hidden;
	/*background-color: #366;
	height : 100%;*/
}
#content-page {
	/*background-color: rgba(200,250,250,.7);*/
}
#utama-page {
	height : 100%;
}

#utama-page .ui-content {
	position : absolute;
	top      : 0;
	right    : 0;
	bottom   : 0;
	left     : 0;
}

.menu li:first-child {
	background:#f00;
	/*font-weight:bold;*/
	font-family:arial black;
	font-size: 200%;
	background: url(images/sphinn-icon.png) no-repeat;
	background-size: contain;
	border: 4px solid #fff;
	box-shadow: 0 0 7px 5px #aaa;
}

/*.menu li:not(:first-child) {
	width:20px;
	background-color: #069;
	border: 2px solid #fff;
	box-shadow: 0 0 6px 4px #3399CC;
}*/
.menu li:nth-child(2) {
	width:20px;
	background-color: #069;
	border: 2px solid #fff;
	box-shadow: 0 0 6px 4px #3399CC;
}

.menu li:nth-child(3) {
	width:20px;
	background-color: #096;
	border: 2px solid #fff;
	box-shadow: 0 0 6px 4px #339966;
}


.menu li {
	background: #000;
	color:#fff;
	font-size:12px;
}
.menu a{
	text-decoration: none;
	color:#fff;
}
#menu16 {
	-webkit-transform-origin: 48px 48px;
	-moz-transform-origin: 48px 48px;
	-o-transform-origin: 48px 48px;
	transform-origin: 48px 48px;

	-webkit-transition: all .5s ease;
	-moz-transition: all .5s ease;
	-o-transition: all .5s ease;
	transition: all .5s ease;

	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	transform: rotate(180deg);
	
}
#menu16.circleMenu-open {
	-webkit-transform: rotate(360deg);
	-moz-transform: rotate(360deg);
	-o-transform: rotate(360deg);
	transform: rotate(360deg);
}
#menu16.circleMenu-open > li:first-child {
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	transform: rotate(180deg);
}
/*#menu16.circleMenu-closed > li:not(:first-child){
	background-color: red;
}*/
.menu{
	position:absolute;
}
#menu16{
	/*left:45%;*/
	top:37%;
}
.rotate-logo {	
	-webkit-animation:spin-logo .8s linear 1;
	-moz-animation:spin-logo .8s linear 1;
	animation:spin-logo .8s linear 1;
}
.rotate {	
	-webkit-animation:spin .6s linear 1;
	-moz-animation:spin .6s linear 1;
	animation:spin .6s linear 1;
	
}
.rotate-back {	
	-webkit-animation:spin-back .5s linear 1;
	-moz-animation:spin-back .5s linear 1;
	animation:spin-back .5s linear 1;
}
.shadow {
	/*-webkit-box-shadow: 0 0 10px 3px #FFFFCC;
	-moz-box-shadow: 0 0 10px 3px #FFFFCC;
	box-shadow: 0 0 10px 3px #F00;*/
}
.node{
	/*border:1px solid #FF0;*/
}
#logo {
	border:1px solid #999;
	position:absolute;
	left:18px;
	top:18px;
	padding:10px;
	background-color:#F00;
	-webkit-transform: rotate(-180deg);
	-moz-transform: rotate(-180deg);
	-o-transform: rotate(-180deg);
	transform: rotate(-180deg);
	
	border-radius: 200px 200px 200px 200px;
	-moz-border-radius: 200px 200px 200px 200px;
	-webkit-border-radius: 200px 200px 200px 200px;
}

@-moz-keyframes spin-logo { 100% { -moz-transform: rotate(180deg); } }
@-webkit-keyframes spin-logo { 100% { -webkit-transform: rotate(180deg); } }
@keyframes spin-logo { 100% { -webkit-transform: rotate(180deg); transform:rotate(180deg); } }

@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

@-moz-keyframes spin-back { 100% { -moz-transform: rotate(-360deg); } }
@-webkit-keyframes spin-back { 100% { -webkit-transform: rotate(-360deg); } }
@keyframes spin-back { 100% { -webkit-transform: rotate(-360deg); transform:rotate(-360deg); } }

</style>
<link rel="stylesheet" href="min-height.css" />
<link rel="stylesheet" href="desktop.css" />
<script src="themes_kokola/jquery-1.11.1.min.js"></script>
<script src="themes_kokola/jquery.mobile-1.4.5.min.js"></script>
<script src="js/jQuery.circleMenu.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	/*$('#menu16').hide();
	$('#menu16').delay(1000).fadeIn( 400 );*/
	resize();
	//$('#menu16 li a').addClass("rotate");
	$('#menu16').circleMenu({
		item_diameter: 88,
		circle_radius: 140,
		direction: 'full',
		speed: 400,
		step_in: 0,
		step_out: 0,
		trigger:'click',
		transition_function: 'ease-out',
		//transition_function: 'cubic-bezier(1.000, -0.600, 0.000, -0.600)',
		//transition_function: 'cubic-bezier(1.000, -0.600, 0.300, -0.600)',
		open:function(e){
			$('#menu16 li a').find(".node").addClass("rotate");
			$('#menu16 li a').find(".node").removeClass("rotate-back");
		},
		close:function(e){
			$('#menu16 li a').find(".node").removeClass("rotate");
			$('#menu16 li a').find(".node").addClass("rotate-back");
		},
		select: function (evt,item) {
			var loc = item.find("a").attr("href");
			window.location = loc;
			//$(".menu li").addClass("shadow");
		}
	});
});
function resize() {
	var lebar = $(window).width();
	var tinggi = $(window).height();
	
	//$("#tinggi").html(tinggi);
	/*if (lebar < 480) {
		$("#menu16").css("transform","scale(.8)");
	}
	else {
		$("#menu16").css("transform","scale(1)");
	}*/
	
	var left = lebar / 2 - 45;
	$("#menu16").css("left", left);	
	
}
</script>
</head>

<body onresize="resize()">
<!--<div class="rotate" style="position:absolute; left:100px; top:100px;">putar</div>-->
<div data-role="page" data-theme="g" id="utama-page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false" id="header">
        <h1 style="width:95%;margin:0 auto;padding:5px;">
        	<!--<span id="tinggi"></span>-->
            <img id="logo-header" src="logo.png" width="120px" />
            <!--<div>Welcome To Kokola Group</div>-->
        </h1>
    </div>
    <div data-role="content" id="content-page">
        <ul class="menu" id="menu16">	
            <li><center><a href="#" style="color:#06A;">
            	<div id="logo" class="rotate-logo">
                <img src="favicon.jpg" width="30px;" height="30px" /></div></a></center></li>
            <li><center><a href="http://119.252.168.10:388/index-app.php" style="color:#FFF;font-family: Tahoma, Geneva, sans-serif;font-weight:100;" data-ajax="false">
            	<div class="node">Reguler</div></a></center></li>
            <li><center><a href="http://119.252.168.10:388/dist_kokola_f" style="color:#FFF;font-family: Tahoma, Geneva, sans-serif;font-weight:100;" data-ajax="false">
            	<div class="node">Festive</div></a></center></li>
        </ul>
    </div>
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" id="footer">
        <h1 style="padding:5px;"><span style="font-size:18px;">&copy;</span> Kokola Group</h1>        
    </div>
</div>
<script>
/*$(document).on('vmousedown', '#menu16', function(){
	$(".menu li").addClass('shadow');
	alert("oke");
}).on('vmouseup', function(){
	$(".menu li").removeClass('shadow');
}).on("vmousecancel", function() {
	$(".menu li").removeClass('shadow');
});*/
$('#menu16').on('circleMenu-close',function(){

});

$('#menu16').on('circleMenu-select',function(evt,item){
	//alert(item.attr('id'));
});
</script>
</body>
</html>