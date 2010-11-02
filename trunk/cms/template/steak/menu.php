<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>餐點介紹</title>
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


<b class="redH">特香齋西餐廳</b>

<div class="foodIntroLeft">
<script type="text/javascript">
	wbPageSlide('.wbPS1', 200);
	wbPageSlide('.wbPS2', 200);
</script>
<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
</div><!--foodIntroLeft-->

<div class="foodIntroRight">
	<div>
    	<img src="images/119x102.jpg" />
        <p>圖片說明</p>
    </div>

	<div>
    	<img src="images/119x102.jpg" />
        <p>圖片說明</p>
    </div>

</div>

</div><!--pageContent-->
        
        </div><!--pageBody-->
    
    </div><!--mainDiv-->

<?php include('footer.php'); ?><!-- footerDiv -->

</div><!--theBox-->
</div><!--shadowBox-->
</body>
</html>
