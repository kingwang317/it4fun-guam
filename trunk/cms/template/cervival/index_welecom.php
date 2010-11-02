<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
		<meta name="content-type" content="text/html; charset=utf-8" />
        <style type="text/css">
		body{
			background:#20262c;
			}
		#flash {
			margin:0 auto;
			padding:120px 0 0 0; 
			width:791px;
			height:420px;
		}
		</style>
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
		<script type="text/javascript" src="js/jquery.flash.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#flash').flash({ 
					src: '<?php echo $_SERVER['WEBROOT'].'/cms/template/cervival/'; ?>cervival_welecom.swf',
					width: 788,
					height: 417
				},
				{
					version: 8
				});
			});
		</script>
	</head>
	<body>
		<div id="flash"></div>
		
	</body>
</html>