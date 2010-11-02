<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<link href="../../css/content-inc.css" rel="stylesheet" type="text/css" />
<?php include($_SERVER['SRVROOT'].'/cms/lib/ckfinder/forResource.php'); ?>
<?php
$cmsid = $_REQUEST['cmsid'];
echo "CMSID=$cmsid";
if(!isset($cmsid)){
	echo "cmsid required";
	return;
}

$toAction = WEBROOT."/cms/admin/content/inc/page2-include-action.php";

$method="新增";
$action = 'add';
$divclass = "";
$includeurl = "";
$divid = "";


if(isset($_GET['action']))
	if($_GET['action']=='edit'){
		$action = 'edit';
		$method="修改";
		$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");
		$includeurl = $contentNodes->item($_GET['order'])->getAttribute('includeurl');
		$divid = $contentNodes->item($_GET['order'])->getAttribute('divid');
		$divclass = $contentNodes->item($_GET['order'])->getAttribute('divclass');	
	}
?>

<?php echo $method;?>
&nbsp; [ include 網頁 ]
<form name="form1" method="post" action="<?php echo $toAction; ?>">

	<div class="con">
	<p>檔案路徑(url)：
		<input name="includeurl" type="text" id="includeurl" value="<?php echo $includeurl ?>" size="50">
		<input type="button" value="瀏覽" onclick="browse('pick1');" />
		<br />
		<span class="help" style="margin-left:90px;">使用範例：/檔案夾位置/檔案名稱</span></p>
	<p>插入DIV標籤：id=
		<input name="divid" type="text" id="divid" value="<?php echo $divid ?>" size="8" />
		&nbsp; class=
		<input name="divclass" type="text" id="divclass" value="<?php echo $divclass ?>" size="8" />
		<br />
<span class="help" style="margin-left:90px;">DIV設定檔來源：依據網頁套版裡的css檔案,或是使用include檔案內的css</span>
</p>
</div>
<p>
		<input type="submit" name="Submit" value="編輯完成">
		<input name="cmsid" type="hidden" id="cmsid2" value="<?php echo $cmsid ?>" />
		<input name="order" type="hidden" id="cmsid" value="<?php echo $_GET['order']; ?>" />
		<input name="action" type="hidden" id="action" value="<?php echo $action ?>" />
	</p>
</form>

