<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php 
$cmsid = $_GET['cmsid'];
?>
<h4>變更階層
</h4>
<form id="form1" name="form1" method="post" action="<?php echo WEBROOT."/cms/admin/content/sitemap/inc/newParent_action.php" ?>">
	移到id
	<label>
	<input name="toPid" type="text" id="toPid" size="4" />
	</label>
	之下
	<label>
	<input type="submit" name="Submit" value="送出" />
	</label>
	<input name="comefrom" type="hidden" id="comefrom" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
	<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $cmsid ?>" />
</form>
