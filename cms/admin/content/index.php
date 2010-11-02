<?php
require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php");
$cmsid = isset($_REQUEST['cmsid'])?$_REQUEST['cmsid']:0;
global $cms;
$myNode = $cms->xpath->query("//page[@id=$cmsid]")->item(0);
?>
<link href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/content.css" rel="stylesheet" type="text/css" />

<!--共用javascript函數-->
<script type="text/javascript">
function popup(url,name,windowWidth,windowHeight){
    myleft=(screen.width)?(screen.width-windowWidth)/2:100;
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;
	properties = "width="+windowWidth+",height="+windowHeight+",scrollbars=yes, top="+mytop+",left="+myleft+',menubar=no,resizable=yes,toolbar=no,location=no,scrollbars=no,status=no,directories=no,personalbar=no,titlebar=no';
    window.open(url,name,properties);
}
//ex: onClick="popup('http://www.google.com.tw','xxx',400,400); return false;"
</script>

<!--cookie 函數-->
<script>
// Example:

// alert( readCookie("myCookie") );

function readCookie(name)

{

  var cookieValue = "";

  var search = name + "=";

  if(document.cookie.length > 0)

  { 

    offset = document.cookie.indexOf(search);

    if (offset != -1)

    { 

      offset += search.length;

      end = document.cookie.indexOf(";", offset);

      if (end == -1) end = document.cookie.length;

      cookieValue = unescape(document.cookie.substring(offset, end))

    }

  }

  return cookieValue;

}

// Example:

// writeCookie("myCookie", "my name", 24);

// Stores the string "my name" in the cookie "myCookie" which expires after 24 hours.

function writeCookie(name, value, hours)

{

  var expire = "";

  if(hours != null)

  {

    expire = new Date((new Date()).getTime() + hours * 3600000);

    expire = "; expires=" + expire.toGMTString();

  }

  document.cookie = name + "=" + escape(value) + expire;

}


</script>


<link href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/layout.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/*        html {margin: 0; padding: 0;}
        body {margin: 0; padding: 0; overflow: hidden; }*/
		body {overflow-x:hidden; }
</style>
<!--可移動視窗設定-->
<script src="<?php echo WEBROOT ?>/cms/lib/jquery/jquery-ui-personalized-1.6b.min.js"></script>
<script>
$(window).unload(function(){
	var leftpx = $("#rightDiv").css('left');
	writeCookie('slideDivLeft',leftpx, 2400);
});

$(function(){
	var cookie = readCookie('slideDivLeft');
	//更新左位置
	if(cookie){
		$("#rightDiv").css('left',cookie); 
	}
	//更新寬
	/*var l = $("#rightDiv").css('left');
	l=l.replace( /px/i, '');
	var iw = getInnerWidth()-l-35;
	$("#rightDiv").css('width',iw+'px');*/
	//執行resizable
	$("#rightDiv").resizable({ 
		handles: "w" 
	});
});

function getInnerWidth(){
	if(window.innerWidth){
		return window.innerWidth;
	}else{
		return document.body.offsetWidth;
	}

}
</script>
<style>
	#content{
	margin:0px; padding:0px;
	background-color:#f6f6f6;
	}
	#base {
		position:relative;
		height:600px;
	}
	#rightDiv {
	position:absolute;
	top:0px;
	right:0px;
	bottom:0px;
	padding-left:15px;
	z-index:2;
	padding-top:10px;
	border-left:#cccccc solid 1px; 
	left:260px;
	}
	#leftDiv {
	left:0;
	top:0;
	height:100%;
	padding-left:10px;
	z-index:1;
	padding-top:10px;
	}
	#leftDiv, #rightDiv{
	height:100%;
	background:#ffffff;
	}
	
.ui-resizable-w { 
	cursor: w-resize; 
	width: 16px; 
	left: -10px; 
	top: 0px; 
	height:100%;
	display:block;
}
html > body > #content #base #rightDiv, html > body > #content #base #leftDiv{
min-height:350px; height:auto;
}
.buttomgo{
background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/button-go.png); background-position:left; background-repeat:no-repeat; width:16px; height:16px;
position:absolute; top:20px; left:-8px;
}




</style>

<!--左側導覽部分-->
<script>
	$(function(){
	    $.ajaxSetup({
            cache: false
        });
		
		loadLeft();
	});

	function loadLeft(){
		$('#leftDiv').load('<?php echo $_SERVER['WEBROOT'].'/cms/admin/content/sitemap/sitemap.php' ?>',{
		base:'<?php echo $_SERVER['REQUEST_URI']; ?>',
		cmsid:'<?php echo $_REQUEST['cmsid']; ?>'
		});
	}
</script>

<!--右側內容管理部分-->
<script>	
	$(function(){
		loadContent(<?php echo $_REQUEST['cmsid']; ?>);
	
		$('#contentMenu a').click(function(){
			var index = $('#contentMenu a').index(this);
			writeCookie('contentView', index, 2400);
			
			
		loadContent(<?php echo $_REQUEST['cmsid']; ?>);
			return false;
		});
	});

	function loadContent(cmsid){ //根據cookie 載入
		var index = readCookie('contentView');
	
		var u = $('#contentMenu a').eq(index).attr('href');
		$('#contentArea').load(u,{
			cmsid:cmsid
		},sameHeight);
		
		$('#contentMenu a').removeClass('nowmenu');
		$('#contentMenu a:eq('+index+')').attr('class','nowmenu');
	}	
</script>

<!--(子頁面共用) msgbox-->
<script>
function showMsgbox(){
	$('#msgbox').animate( { opacity: 0.8}, 0 ).slideDown().animate( { opacity: 0.8}, 1500 ).fadeOut(3000);
}
</script>
<style>
#msgbox {
position: absolute;
top: 10px; right: 20px;
z-index: 10;
background: #FFFF33;
padding:5px 15px 3px;
border:1px solid #FF9900;
text-align:center;
font-size:12px;
display:none;
}
</style>
<!--sameHeight 設定同樣高度-->
<script>
	function sameHeight(){
		var arr=new Array();
		$('.sameHeight').each(function(){
			var h = $(this).height();
			//alert(h);
			//h = h.replace(/px/i, '');
			arr.push(h);
		});

		var mx =Math.max.apply( Math, arr);
		$('.sameHeight').height(mx);
	}
	
</script>
<div id="base">
	<div id="leftDiv" class="sameHeight">
	<img src="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/ajax-loader.gif" alt="loading..." />	
    <div class="clear"></div>
    </div>
	<div id="rightDiv" class="resizable sameHeight">
    <div class="buttomgo"></div>
		<span class="h2title">
        	<h2>【cmsid:<?php echo $cmsid; ?>】<?php echo $myNode->getAttribute('name'); ?></h2>
		</span>	
      <div id="menu">
            <ul id="contentMenu">
				<li><a href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/content/page1.php" class="nowmenu">導覽設定(Navigation)</a></li>
				<li><a href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/content/page2.php">內容設定(Content)</a></li>
				<li><a href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/content/page3.php">表頭設定(SEO)</a></li>
				<li><a href="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/content/page4.php">設計師(Design)</a></li>
			</ul>
        </div>
    <div class="clear"></div>
        <div id="contentArea">
			<img src="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/ajax-loader.gif" alt="loading..." /></div>
	</div>
</div>
<div class="clear"></div>