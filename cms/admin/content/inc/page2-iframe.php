<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php include($_SERVER['SRVROOT'].'/cms/lib/ckfinder/forResource.php'); ?>

<link href="../../css/content-inc.css" rel="stylesheet" type="text/css" />

<?php
$cmsid = $_REQUEST['cmsid'];
echo "CMSID=$cmsid";
if(!isset($cmsid)){
	echo "cmsid required";
	return;
}
$iframeurl = "";
$divid = "";
$divclass = "";
$toAction = WEBROOT."/cms/admin/content/inc/page2-iframe-action.php";
if(isset($_GET['action'])){
	if($_GET['action']=='edit'){
		$action = 'edit';
		$method="修改";
		$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");
		$iframeurl = $contentNodes->item($_GET['order'])->getAttribute('iframeurl');
		$iframe_w = $contentNodes->item($_GET['order'])->getAttribute('iframe_w');
		$iframe_h = $contentNodes->item($_GET['order'])->getAttribute('iframe_h');
		$autoheight = $contentNodes->item($_GET['order'])->getAttribute('autoheight');
		$divid = $contentNodes->item($_GET['order'])->getAttribute('divid');
		$divclass = $contentNodes->item($_GET['order'])->getAttribute('divclass');
	}else {
		$method="新增";
		$action = 'add';
		$autoheight = 1;
		$iframe_w = '500';
		$iframe_h = '500';
	}
}else {
	$method="新增";
	$action = 'add';
	$autoheight = 1;
	$iframe_w = '500';
	$iframe_h = '500';
}
?>

<?php echo $method;?>
&nbsp; [ iframe 網頁 ]
<form name="form1" method="post" action="<?php echo$toAction ?>">
	<div class="con">
	<p>檔案路徑(url)：
		<input name="iframeurl" type="text" id="iframeurl" value="<?php echo $iframeurl ?>" size="50">
		<input type="button" value="瀏覽" onclick="browse('pick2');" />
		<br />
		<span class="help" style="margin-left:90px;">使用範例：/檔案夾位置/檔案名稱</span>	</p>
	<p>width：
		<input name="iframe_w" type="text" id="iframe_w" value="<?php echo $iframe_w ?>" size="4">
	(px)
	</p><p>
	height：
		<input name="iframe_h" type="text" id="iframe_h" value="<?php echo $iframe_h ?>" size="4">
		(px) 
		<input name="autoheight" type="checkbox" id="autoheight" value="1" <?php if ($autoheight){echo "checked";} ?> />
		隨內容調整高度	</p>
	<p>插入DIV標籤： id=
		<input name="divid" type="text" id="divid" value="<?php echo $divid ?>" size="8" />
class=
<input name="divclass" type="text" id="divclass" value="<?php echo $divclass ?>" size="8" />
<br />
<span class="help" style="margin-left:90px;">DIV 設定檔來源：iframe 網頁的css</span>
</p>
	</div>
<p>
		<input type="submit" name="Submit" value="編輯完成">
		<input name="cmsid" type="hidden" id="cmsid2" value="<?php echo $cmsid ?>" />
		<input name="order" type="hidden" id="cmsid" value="<?php echo $_GET['order']; ?>" />
		<input name="action" type="hidden" id="action" value="<?php echo $action ?>" />
	</p>
</form>
 