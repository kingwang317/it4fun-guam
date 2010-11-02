<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
<script src="/cms/template/xxxx/css/2c/same_height.js"></script>
<script src="<?php echo $_SERVER['WEBROOT']; ?>/cms/template/xxxx/css/2c/same_height.js"></script>
<script src="<?php echo WEBROOT; ?>/cms/template/xxxx/css/2c/same_height.js"></script>

<?php
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
$nowWebPath = substr_replace($nowSrvPath, '', 0, strpos($nowSrvPath, $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
?>

<script src="<?php echo $nowWebPath ?>/css/2c/same_height.js"></script>

<style>
/*@import url("css/2c/layout.css");
*/</style>

<link href="css/2c/layout.css" rel="stylesheet" type="text/css" />
<div id="wrapper">
	<div id="top">
		<div class="headiing">CMS LOGO</div>
		<div class="info">2009/07/21 by Mr.King</div>
	</div>
	
	<div id="outter">
		<div id="left" class="same_height">
			<div class="side_nav">
			<?php $startLevel=1; $deep=2; include($_SERVER['SRVROOT'].'/cms/inc/navigation.inc.php'); ?>
			</div>
		</div>
	  <div id="right" class="same_height">
	  		<div id="breadcrumb" style="padding-left:10px">
			<!--<?php include($_SERVER['SRVROOT'].'/cms/inc/breadcrumb.inc.php'); ?>-->
			</div>
			<div id="pagetitle" style="padding-left:10px">
			<h3>			</h3>
			</div>
			<div class="content">
			  <?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
			</div>
	  </div>
	</div>
	
	<div id="bottom">
	</div>
</div>

<p>&nbsp;</p>
