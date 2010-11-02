<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
$cmsid = $_REQUEST['cmsid'];
echo "CMSID=$cmsid";
if(!$cmsid){
	echo "cmsid required";
	return;
}
$toAction = WEBROOT."/cms/admin/content/inc/page2-iframe-action.php";

?>
<form id="form1" name="form1" method="post" action="<?php echo$toAction ?>">
	確定刪除
	<input type="submit" name="Submit" value="刪除" />
		<input name="cmsid" type="hidden" id="cmsid2" value="<?php echo $cmsid ?>" />
		<input name="order" type="hidden" id="cmsid" value="<?php echo $_GET['order']; ?>" />
		<input name="action" type="hidden" id="action" value="delete" />
</form>

