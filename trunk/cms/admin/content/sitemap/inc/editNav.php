<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<script src="<?php echo LIBWEBROOT; ?>/jquery/jquery.js"></script>
<script src="<?php echo LIBWEBROOT; ?>/js/radioCheckShow/checkShow.js"></script>
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

$action = WEBROOT."/cms/admin/sitemap/inc/editNav_action.php";

if (!$cms){
$cms = new cmstree('cmsid',CMSXML);
}

$pid = $cms->get_pid($cmsid);
if($pid!=''){
$p = $sx->xpath("//page[@id=$pid]");
$parent = $p[0][name];
}else {
$parent = "最上層";
}
?> 
<link href="<?php echo WEBROOT ?>/cms/admin/css/content.css" rel="stylesheet" type="text/css" />
<h3>導覽設定 :</h3>
<span class="site">此頁位於 【 <span style="color:#0066FF;"><?php echo $parent?></span> 】 之下</span>    
<form id="form1" name="form1" method="post" action="<?php echo $action; ?>">
<p>
<label class="level1">導覽顯示名稱：</label>

    	<input name="name" type="text" id="name" value="<?php echo $item[0][name] ?>" />
		
  </p>
    <p><label class="level1">導覽顯示狀況：</label>
    	
    	<input name="display" type="radio" value="show" <?php if ($item[0][display]=='show') echo "checked=\"checked\""; ?> />
顯示
<input name="display" type="radio" value="hide" <?php if ($item[0][display]=='hide') echo "checked=\"checked\""; ?> />
隱藏 </p>
    <p><label class="level1">導覽的作用：</label>
    </p>
    <p>
    	<input name="navfunc" type="radio" class="checkShow" value="template" <?php if ($item[0][navfunc]=='template') echo "checked=\"checked\""; ?> />
   	具有網頁內容<span class="t1"> (在"內容管理"去新增修改網頁內容)</span></p>
    <p>
    	<input name="navfunc" type="radio" class="checkShow" value="nextlevel" <?php if ($item[0][navfunc]=='nextlevel') echo "checked=\"checked\""; ?> />
   	自動連結到下一階層的第一頁</p>
    <p>
    	<input name="navfunc" type="radio" class="checkShow" value="link" <?php if ($item[0][navfunc]=='link') echo "checked=\"checked\""; ?> />
   	連結到自訂的URL <span class="t1"> (站內連結請copy 
   	<label>
   	<input name="textfield" type="text" value="/index.php?cmsid=" size="25" /> 
   	</label>
   	在"="之後打導覽編號)</span> </p>
    <div class="cshow">
    	檔案路徑(URL):
    		<input name="linkurl" type="text" id="linkurl" value="<?php echo $item[0][linkurl] ?>" />
    	<br/>
   	  Target:
    		<input name="target" type="radio" value="_self"  <?php if ($item[0][target]=='_self') echo "checked=\"checked\""; ?> />
    		_self(原視窗)
    		<input name="target" type="radio" value="_blank" <?php if ($item[0][target]=='_blank') echo "checked=\"checked\""; ?> />
    		_blank(另開視窗) or
    		<input name="target" type="radio" value="custom" <?php if ($item[0][target]=='custom') echo "checked=\"checked\""; ?> />
    		自訂
    	<input name="customtarget" type="text" id="customtarget" value="<?php echo $item[0][customtarget] ?>" />
   	</div>
    <p>
    	<input name="navfunc" type="radio" class="checkShow" value="text" <?php if ($item[0][navfunc]=='text') echo "checked=\"checked\""; ?> />
   	純文字</p>
    <p>
    	<label class="level1">li 標籤的 class：</label>
		<input name="li_class" type="text" id="li_class" value="<?php echo $item[0][li_class] ?>" />
    </p>
    <p>
		<label class="level1">a 標籤的 class：</label>
		<input name="a_class" type="text" id="a_class" value="<?php echo $item[0][a_class] ?>" />
    </p>
    <p>
		<label class="level1">a 標籤的 title：</label>
    	<input name="a_title" type="text" id="a_title" value="<?php echo $item[0][a_title] ?>" />
    </p>
    <p>
    	<input type="submit" name="Submit" value="儲存變更" />
    	<!-- $db3-2. 設定表尾 -->
    	<!-- $template-1 edit.logic.php 所需url參數 -->
    	<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $cmsid ?>" />
    	<input name="step" type="hidden" id="step" value="1" />
    </p>
</form>
