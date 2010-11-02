<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
		<script type="text/javascript" src="js/jquery.flash.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#menu').flash({ 
					src: '<?php echo $_SERVER['WEBROOT'].'/cms/template/cervival/'; ?>index.swf',
					width:970,
					height: 400
				});
			});
		</script>

</head>
	<body>
		<div id="wrap">
		    <div id="header">
                <div id="menu">
                
                </div>
            </div>
		    <div id="content">
				<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>  
		     </div>
				<?php include('footer.php'); ?><!-- footerDiv -->
		</div>
	</body>
</html>
