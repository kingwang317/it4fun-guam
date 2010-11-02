<?php require_once($_SERVER['SRVROOT'].'/cms/inc/config.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/auth.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/std.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/lang.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/database.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/default.inc.php'); ?>
<?php 

global $cms;
$cmsid = isset($_REQUEST['cmsid'])?$_REQUEST['cmsid']:0;
$current = ' class="current"';
$current_default = "";
$current_plugin = "";
$current_content = "";
$header = $_SERVER['SRVROOT']."/cms/admin/template/header.php";
$footer = $_SERVER['SRVROOT']."/cms/admin/template/footer.php";
$cmsroot = isset($_GET['cmsroot'])?$_GET['cmsroot']:"";
if($cmsroot != "login" || !isset($_GET['cmsroot']))auth_check();
switch($cmsroot){
	case "default":		
		if(!auth_valid_function("cms_content")){
			$inc = $_SERVER['SRVROOT']."/cms/admin/plugin/index.php";
			$current_plugin = $current;
		}else{
			$inc = $_SERVER['SRVROOT']."/cms/admin/default/index.php";
			$current_default = $current;
		}
		break;
	case "login":
		$inc = $_SERVER['SRVROOT']."/cms/admin/default/login.php";
		break;
	case "plugin":
		$inc = $_SERVER['SRVROOT']."/cms/admin/plugin/index.php";
		$current_plugin = $current;
		break;
	case "content":
		if(!auth_valid_function("cms_content")){
			$inc = $_SERVER['SRVROOT']."/cms/admin/plugin/index.php";
			$current_plugin = $current;
		}else{
			$inc = $_SERVER['SRVROOT']."/cms/admin/content/index.php";
			$current_content = $current;
		}
		break;
	default:
		$inc = $_SERVER['SRVROOT']."/cms/admin/plugin/index.php";
		$current_plugin = $current;
		break;
}
$func = isset($_GET['func'])?$_GET['func']:"";
switch($func){
	case "logout":
		user_logout();
		redirect(WEBROOT, 0, '您已登出');
		break;
	case "set_lang":
		$lang = isset($_GET['lang'])?$_GET['lang']:DEFAULTLANG;
		change_lang($lang);
		break;
	default:
		break;
}

ob_start();
if($cmsroot != "get_data"){
	include($header);?> 
<script>
	$(function(){
		$('#jsCheck').remove();
	});
</script>
<?php 
}
include($inc);
if($cmsroot != "get_data")
	include($footer);
ob_flush();
ob_clean();
?> 	