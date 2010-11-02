<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<link href="../../css/content-inc.css" rel="stylesheet" type="text/css" />
<?php
$cmsid = $_REQUEST['cmsid'];
$pluginUrl = isset($_POST['pluginUrl'])?$_POST['pluginUrl']:"";
$folder = isset($_POST['folder'])?$_POST['folder']:"";
$pluginName = isset($_POST['pluginName'])?$_POST['pluginName']:"";
$pluginTitle = isset($_POST['pluginTitle'])?$_POST['pluginTitle']:"";
$toAction = WEBROOT."/cms/admin/content/inc/page2-plugin-action.php";
$editNote = '';
$addWay = '';
$method="";
$iframe_h = "";
$iframe_w = "";
$autoheight = "";//$contentNodes->item($_GET['order'])->getAttribute('autoheight');
$divid = "";//$contentNodes->item($_GET['order'])->getAttribute('divid');
$divclass = "";//$contentNodes->item($_GET['order'])->getAttribute('divclass');
$action = 'add';
if(isset($_GET['action']))
if($_GET['action']=='edit'){
	$action = 'edit';
	$editNote = '   (如欲修改外掛位置，請刪除後重建)';
	$method="修改";
	$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");

		$addWay = $contentNodes->item($_GET['order'])->getAttribute('addWay');
		$folder = $contentNodes->item($_GET['order'])->getAttribute('folder');
		$pluginUrl = $contentNodes->item($_GET['order'])->getAttribute('pluginUrl');
		$pluginTitle = $contentNodes->item($_GET['order'])->getAttribute('pluginTitle');
		
		$pluginXML = $_SERVER['SRVROOT'].'/cms/plugin/'.$folder.'/config.xml';
		$sx = simplexml_load_file($pluginXML);
		$pluginName = $sx->name;
		$pluginAdmin = $sx->admin;
		$pluginAdmin = $_SERVER['WEBROOT'].'/cms/plugin/'.$folder.'/'.$pluginAdmin;

	$iframe_w = $contentNodes->item($_GET['order'])->getAttribute('iframe_w');
	$iframe_h = $contentNodes->item($_GET['order'])->getAttribute('iframe_h');
	$autoheight = $contentNodes->item($_GET['order'])->getAttribute('autoheight');
	$divid = $contentNodes->item($_GET['order'])->getAttribute('divid');
	$divclass = $contentNodes->item($_GET['order'])->getAttribute('divclass');
} else {
	$method="新增";
	$action = 'add';
	$autoheight = 1;
	$iframe_w = '500';
	$iframe_h = '500';
	//if($fileurl.first='\')
}
?>

<?php echo $method;?>
&nbsp; [外掛 ]
<?php echo $pluginName ?> (<?php echo $pluginTitle; ?>)
<form name="form1" method="post" action="<?php echo$toAction ?>">
	<div class="con">
	<p>檔案路徑(url)：<?php echo $pluginUrl; ?><?php echo $editNote; ?></p>
	<p>插入方式： 
	  <input name="addWay" type="radio" value="include" <?php if ($addWay!='iframe'){echo 'checked="checked"';} ?> />
	include 
	<input name="addWay" type="radio" value="iframe" <?php if ($addWay=='iframe'){echo 'checked="checked"';} ?> />
	iframe
	<p>插入DIV標籤： id=
		<input name="divid" type="text" id="divid" value="<?php echo $divid ?>" size="8" />
class=
<input name="divclass" type="text" id="divclass" value="<?php echo $divclass ?>" size="8" />
<br />
<span class="help" style="margin-left:90px;">DIV 設定檔來源：iframe 網頁的css</span>
</p>	
<hr />
<p>iframe 相關參數：</p>
<p>width：
		<input name="iframe_w" type="text" id="iframe_w" value="<?php echo $iframe_w ?>" size="4">
	(px)
	</p>
<p>
	height：
		<input name="iframe_h" type="text" id="iframe_h" value="<?php echo $iframe_h ?>" size="4">
		(px) 
		<input name="autoheight" type="checkbox" id="autoheight" value="1" <?php if ($autoheight){echo "checked";} ?> />
		隨內容調整高度	</p>
	</div>
<p>
		<input type="submit" name="Submit" value="確定送出">
		<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $cmsid ?>" />
		<input name="order" type="hidden" value="<?php echo $_GET['order']; ?>" />
		<input name="action" type="hidden" id="action" value="<?php echo $action ?>" />
		<input name="pluginUrl" type="hidden" id="pluginUrl" value="<?php echo $pluginUrl ?>" />
		<input name="pluginTitle" type="hidden" id="pluginTitle" value="<?php echo $pluginTitle ?>" />
		<input name="folder" type="hidden" id="folder" value="<?php echo $folder ?>" />
</p>
</form>
 