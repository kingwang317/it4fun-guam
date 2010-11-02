<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>精緻午茶</title>
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
<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>

<b class="redH">特香齋精緻午茶</b>
<div class="siteOption">
    <span>
        <a href="#"><img src="images/print.jpg" /></a>
        <a href="#"><img src="images/forward.jpg" /></a>
    </span>
    <a href="#"><img src="images/plurk.jpg" /></a>
    <a href="#"><img src="images/face.jpg" /></a>
    <a href="#"><img src="images/twiter.jpg" /></a>  
</div>

<div class="timeBox">
	<img src="images/156x129.jpg" width="274" height="203" />
    <b class="goldT">下午茶</b>
    <ul class="listWhite">
        <li>周一至周日</li>
        <li>14:00 - 16:30</li>
        <li>贈送精緻蛋糕、水果</li>
        <li>咖啡可續杯</li>
    </ul>
</div>

<div class="timeBox">
	<img src="images/156x129.jpg" width="274" height="203" />
    <b class="goldT">商業午餐</b>
    <ul class="listWhite">
        <li>周一至周日 (特殊節日不供應，請來電詢問)</li>
        <li>11:30 - 14:00</li>
    </ul>
</div>




</div><!--pageContent-->
        
        </div><!--pageBody-->
    
    </div><!--mainDiv-->

<?php include('footer.php'); ?><!-- footerDiv -->

</div><!--theBox-->
</div><!--shadowBox-->
</body>
</html>
