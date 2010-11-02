<?php require_once($_SERVER['SRVROOT'].'/cms/inc/auth.inc.php'); ?>
<link href="<?php echo $tmpl_path;?>css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo WEBROOT ?>/cms/lib/jquery/cssforms/cssforms.mini.js"></script>
<?php
if(isset($_POST['account']) && isset($_POST['password']))
	if(user_login($_POST['account'], $_POST['password'])){
		redirect(WEBROOT."/cms/admin/index.php?cmsroot=plugin", 0, '登入成功');
	}else{
		redirect(WEBROOT."/cms/admin/index.php?cmsroot=login", 0, '登入失敗');
	}
//$action_url =WEBROOT."/cms/admin/index.php?cmsroot=login";
?>
<div id="login">  
	<div id="login_warp">
	<form id="form1" name="form1" method="post" action="<?php echo WEBROOT."/cms/admin/index.php?cmsroot=login" ?> ">
		<p><label for="username">帳號: </label><input type="text" name="account" id="account" value="" /><a href="#">忘記帳號</a></p>
		<br/>
		<p><label for="password">密碼: </label><input type="password" name="password" id="password" value="" /><a href="#">忘記密碼</a></p>
		<p  class="buttonlogin">	<input type="submit" id="submit" value="Submit" /></p>
	</form>
	</div>
</div>