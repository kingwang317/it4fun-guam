<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/starsighting.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery.tools.min.js"></script>
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

		<script type="text/javascript"> 
        $(document).ready(function() {		
         $("#main").scrollable({
            vertical: true,
            size: 1,
            clickable: false,
            keyboard: 'static',
            onSeek: function(event, i) {
            horizontal.scrollable(i).focus();
            }
        }).navigator("#main_navi");
			var horizontal = $(".scrollable")
				.scrollable({size: 1})
				.circular()
				.navigator(".navi");
				horizontal.eq(0)
				.scrollable().focus();
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
                <div class="content starsighting_bg">
                   <div class="breadcrumb"><?php include($_SERVER['SRVROOT'].'/cms/inc/breadcrumb.inc.php'); ?></div>
					<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
           	  </div>
             </div>
<?php include('footer.php'); ?><!-- footerDiv -->
		</div>
	</body>
</html>
