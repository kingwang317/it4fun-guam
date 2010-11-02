<form name="form1" method="post" action="deleteNode_action.php">
	<div align="center">確定刪除 
		<br />
		<input type="submit" name="Submit" value="確定">
		<input name="cmsid" type="hidden" id="cmsid" value="<?php echo $_GET['cmsid'] ?>" />
		<input name="comefrom" type="hidden" id="comefrom" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
	</div>
</form>

