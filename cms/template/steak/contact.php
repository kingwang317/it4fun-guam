<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>聯絡特香齋</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/page-layout.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.pngFix.js"></script>
<script type="text/javascript" src="js/wbpageslide.js"></script>
<script type="text/javascript">
    $(document).ready(function(){ 
        $(document).pngFix();
    }); 
</script> 
</head>

<body>
<div class="shadowBox">
<div class="theBox">
    <div class="mainDiv">
<?php include('top.php'); ?><!-- topDiv -->



<b class="redH">聯絡特香齋</b>
<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
<ul class="listWhite">
    <li>電話: (02) 2959-0033 |  (02) 2959-0066</li>
    <li>營業時間: 上午 hh:mm - 下午 hh:mm</li>
    <li>地址: 台北縣板橋市中山路一段26號2樓</li>
</ul>

<form>
<div class="formDiv">
    <input type="text" class="title">
    <input type="text" class="name">
    <input type="text" class="phone">
    <input type="text" class="email">
    <textarea name="" class="question"></textarea>
</div>
<div class="sendBtn">
	<input type="image" src="images/sendbtn.gif" />
</div>
</form>

</div><!--pageContent-->
        
        </div><!--pageBody-->
    
    </div><!--mainDiv-->

<?php include('footer.php'); ?><!-- footerDiv -->

</div><!--theBox-->
</div><!--shadowBox-->
</body>
</html>
