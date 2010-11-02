<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php include($_SERVER['SRVROOT'].'/cms/lib/ckfinder/forTemplate.php'); ?>
<!-- 離開前確認， 如果表單改過 -->
<script src="<?php echo LIBWEBROOT; ?>/js/notYetSave/notYetSave.js"></script>

<?php
$cmsid = $_REQUEST['cmsid'];
if(!isset($cmsid)){
	echo "請選擇頁面";
	return;
}

?>
<?php
$xfile = CMSXML;
$sx = simplexml_load_file($xfile);
$item = $sx->xpath("//page[@id=$cmsid]");

$action = WEBROOT."/cms/admin/content/action.php";

if (!$cms){
$cms = new cmstree('cmsid',CMSXML);
}

$pid = $cms->get_pid($cmsid);
if($pid!=''){
$p = $sx->xpath("//page[@id=$pid]");
$parent = $p[0]['name'];
}else {
$parent = "最上層";
}

$cms->get_fck();

?>
<!--ajax送出post表單-->
<script>
	$('form').submit(function(){
		var v = $('form').serialize();
		
		$.ajax({
			type: "POST",
			url: "<?php echo $action; ?>",
			data: v,
			success: function(msg){
				$("#msgbox").html(msg);
				showMsgbox();
			}
		});

		return false;
	});
</script>

<!--msgbox css 設定在母頁 index.php-->

<link href="../css/content.css" rel="stylesheet" type="text/css" />
 
<div id="msgbox"></div>

<div class="note">另設本頁套版<br />
 1.&quot;網頁套版&quot;的檔案放在/cms/template/的</span>資料夾裡(系統預設)<br />
2.本頁導覽以下之階層，皆延續套用本頁套版樣式‧</div>
<div class="h3title"><h3>設計師</h3></div>
<form id="form1" name="form1" method="post" action="<?php echo $action; ?>">
    <p>
<label class="level1">變更網頁套版：</label>
<input name="template" type="text" id="template" value="<?php echo $item[0]['template'] ?>" size="60" />
<br />
    <span class="help">預設套版位置：/cms/template/資料夾名稱/套版名稱.php</span>	</p>
	
  <h4>進階設定</h4>
	<p>
	<label class="level1"><strong>線上編輯器 設定值 (FCKeditor)</strong></label>
&nbsp;	</p>

	<p>
	編輯區 CSS：
		<input name="fck_css" type="text" id="fck_css" value="<?php echo $cms->thisNode->getAttribute('fck_css'); ?>" size="50" />		
		<br />
		<span class="help">目前: <a href="<?php echo WEBROOT.$cms->fck_css; ?>" target="_blank"><?php echo $cms->fck_css; ?></a>
		<br />
		(編輯器所見即所得之CSS，前端套版需同步套用此CSS)</span>	</p>
  <p>
	樣式(下拉選單)設定檔：
		<input name="fck_style" type="text" id="fck_style" value="<?php echo $cms->thisNode->getAttribute('fck_style'); ?>" size="50" />
		<br />
		<span class="help">目前: <a href="<?php echo WEBROOT.$cms->fck_style; ?>" target="_blank"><?php echo $cms->fck_style; ?></a></span>	</p>
  <p>
	<img src="<?php echo WEBROOT ?>/cms/admin/css/images/small-icon/icon-template.gif" alt="樣板小圖示"/> 樣板設定檔：
		<input name="fck_template" type="text" id="fck_template" value="<?php echo $cms->thisNode->getAttribute('fck_template'); ?>" size="50" />
		<br />
		<span class="help">目前:<a href="<?php echo WEBROOT.$cms->fck_template; ?>" target="_blank"><?php echo $cms->fck_template; ?></a></span>	</p>
	
<p>
    	<input type="submit" name="Submit" value="儲存變更" />
    	<!-- $db3-2. 設定表尾 -->
    	<!-- $template-1 edit.logic.php 所需url參數 -->
		<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $cmsid ?>" />
    	<input name="step" type="hidden" id="step" value="4" />
    </p>
</form>
