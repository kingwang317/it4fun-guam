<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<link href="../../css/content-inc.css" rel="stylesheet" type="text/css" />

線上編輯內容區塊：

<?php
$cmsid = $_REQUEST['cmsid'];
echo "CMSID=$cmsid";
if(!isset($cmsid)){
	echo "cmsid required";
	return;
}
$toAction = WEBROOT."/cms/admin/content/inc/page2-online-action.php";
$divclass = "";
if(isset($_GET['action']) && $_GET['action']=='edit'){
	$pageNode = $cms->xpath->query("//page[@id=$cmsid]")->item(0);
	
	$fck_css = $pageNode->getAttribute('fck_css');
	$fck_template= $pageNode->getAttribute('fck_template');
	$fck_style= $pageNode->getAttribute('fck_style');
		
	$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");
	$filename = $contentNodes->item($_GET['order'])->getAttribute('filename');
	$divid = $contentNodes->item($_GET['order'])->getAttribute('divid');
	$divclass = $contentNodes->item($_GET['order'])->getAttribute('divclass');
	
	$content = file_get_contents(CONTENTFOLDER.$filename);
 	$method="修改";
	$action="edit";
	
} else {

	$pageNode = $cms->xpath->query("//page[@id=$cmsid]")->item(0);
	
	$fck_css = $pageNode->getAttribute('fck_css');
	$fck_template= $pageNode->getAttribute('fck_template');
	$fck_style= $pageNode->getAttribute('fck_style');
	$method="新增";
	$action='add';
	$divid = $cms->xpath->query("/cms/default/fck_id")->item(0)->nodeValue;
/*	$action = WEBROOT."/cms/admin/content/inc/page2-online-add-action.php";
*/}
echo $method;
?>
<br />
<form action="<?php echo $toAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
<!--	<p>儲存檔名：
		<input name="filename" type="text" id="filename" value="<?php //echo $filename ?>" /> 
		.htm</p>
	<p>-->
<?php include(SRVROOT.'/cms/lib/editor/goEditor.php'); ?>
<!--		<textarea name="content" cols="100" rows="10" id="content"><?php echo $content ?></textarea>
	</p>-->
	<p>
		DIV id=
			<input name="divid" type="text" id="divid" value="<?php echo $divid ?>" size="8" />
		class=
		<input name="divclass" type="text" id="divclass" value="<?php echo $divclass; ?>" size="8" />
 &nbsp; 
		<input type="submit" name="Submit" value="儲存檔案">
		<input name="cmsid" type="hidden" id="cmsid2" value="<?php echo $cmsid ?>" />
		<input name="order" type="hidden" id="cmsid" value="<?php echo $_GET['order']; ?>" />
		<input name="action" type="hidden" id="action" value="<?php echo $action ?>" />
	</p>
</form>


</body>