<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
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
<div id="msgbox"></div>

<div class="h3title"><h3>SEO 設定</h3></div>

<form id="form1" name="form1" method="post" action="<?php echo $action; ?>">
    <p>
<label class="level1">Title: </label>
		<input name="title" type="text" id="title" value="<?php echo $item[0]['title'] ?>" size="60" /></p>
    <p>	
<label class="level1">Description:</label>
    	<textarea name="description" cols="50" rows="6" id="description"><?php echo $item[0]['description'] ?></textarea>
    </p>
	<p>
<label class="level1">Keywords:</label>
    	<textarea name="keywords" cols="50" rows="4" id="keywords"><?php echo $item[0]['keywords'] ?></textarea>
   	</p>
    <p>
<label class="level1">網址上的關鍵字:</label>

    	<input name="urlqstring" type="text" id="urlqstring" value="<?php echo $item[0]['urlqstring'] ?>" />
		<span class="t1">(限一組)</span>
   	</p>

    <p>
    	<input type="submit" name="Submit" value="儲存變更" />
    	<!-- $db3-2. 設定表尾 -->
    	<!-- $template-1 edit.logic.php 所需url參數 -->
		<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $cmsid ?>" />
    	<input name="step" type="hidden" id="step" value="3" />
    </p>
</form>
