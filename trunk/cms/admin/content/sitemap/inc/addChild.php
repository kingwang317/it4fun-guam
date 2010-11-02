<form name="form1" method="post" action="<?php echo $_SERVER['WEBROOT']?>/cms/admin/content/sitemap/inc/addChild_action.php">
	<input name="name" type="text" id="name" size="28">
	<label></label>
		<label>
		<input name="hide" type="checkbox" id="hide" value="hide" />
		隱藏導覽<br />
新增為
<input name="addAt" type="radio" id="RadioGroup2_0" value="first">
第一個</label>
<label>
		<input name="addAt" type="radio" id="RadioGroup2_1" value="last" checked="checked">
最後</label>
		一個
	<br> 
		<input type="submit" name="button" id="button" value="新增">
		<input type="hidden" name="cmsid" id="cmsid" value="<?php echo $_REQUEST['cmsid'] ?>" />
</form>
