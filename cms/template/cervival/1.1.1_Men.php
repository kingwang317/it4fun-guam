<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/product1.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
		<script type="text/javascript" src="js/jquery.flash.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.menu').flash({ 
					src: '<?php echo $_SERVER['WEBROOT'].'/cms/template/cervival/'; ?>cervial_header.swf',
					width:970,
					height:127
				});
			});
		</script>
</head>
	<body>
		<div id="wrap">
		    <div id="header">
                <div class="menu">
                </div>
		    </div>
			<?php include('navi.php'); ?><!-- navi_wrap -->
		    <div id="content_wrap">
                <div class="content product1_bg">
                   <div class="breadcrumb"><?php include($_SERVER['SRVROOT'].'/cms/inc/breadcrumb.inc.php'); ?></div>
                  <?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
				  <div id="product1">
                  <h3 class="sufboardrormen_h3">Sufboard for Men<span></span></h3>

              <p class="footnavi"> <a href="#"> &lt;&lt; Previous </a><a href="#">|</a> <span class="disabled"> Next &gt; &gt; </span><a href="#">1</a>
                            <a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a> 
                            </p>
                            <div id="box_wrap">
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                                <div class="box">
                                <a class="img" href="#"><img src="images/photo01.gif" alt="" /></a>
                                <br/>
                                <a class="box_link" href="">Bodyboard 42.5 <code>&quot;</code>w/coiled leash</a>
                                </div>
                            </div> 
                            <br clear="all"/> 
                    		<a class="backurl" href="#" >Back to Surfboard for Men &gt;&gt;</a>
             	</div>
             </div>
				<?php include('footer.php'); ?><!-- footerDiv -->
		</div>
		</div>
	</body>
</html>
