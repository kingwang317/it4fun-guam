<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/config.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/auth.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/std.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/database.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/default.inc.php'); ?>

<?php
$xfile = CMSXML;
$sx = simplexml_load_file($xfile);
$default = $sx->default;

$path = WEBROOT."/cms/admin/template/";
if(isset($_POST['account']) && isset($_POST['password']))
	if(user_login($_POST['account'], $_POST['password'],"member")){
		redirect(WEBROOT."/index.php", 0, '登入成功');
	}else{
		redirect(WEBROOT."/index.php", 0, '登入失敗');
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS後台管理系統-前端登入介面</title>
<link href="<?php echo $path ?>css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $path ?>js/cssforms.mini.js"></script>

</head>
<body>
<div id="wrap">
	<div id="header">
        <div id="logo"><a href="<?php echo $WEBROOT ?>" title="阿物"><img src="<?php echo $path ?>images/awoo_cms_logo.jpg" alt="阿物國際事業有限公司"/></a></div>

        <h1>【<?php echo $default->cus_name?>】Blah Blah System
        <br clear="all"/>
        <a  class="headerurl" href="<?php echo $default->cus_url?>" title="網址">網址:<?php echo $default->cus_url?></a>
		</h1>
        <address>
        awoo International Co., Ltd.Leading brand of SEO in Taiwan
        </address>
	</div>
<div id="login">  
	<div id="login_warp">
	<form id="form1" name="form1" method="post" action="">
		<p><label for="username">帳號: </label><input type="text" name="account" id="account" value="" /><a href="#">忘記帳號</a></p>

		<br/>
		<p><label for="password">密碼: </label><input type="password" name="password" id="password" value="" /><a href="#">忘記密碼</a></p>
		<p  class="buttonlogin">	<input type="submit" id="submit" class="type_submit" value="Submit" /></p>
	</form>
	</div>
</div>    <div id="footer">
      <p>阿物國際事業有限公司 | 電話：(02)2351-1319 | 傳真：(02)2391-6426 | 服務信箱：service@awoo.com.tw | 地址：台北市中正區齊東街59號1樓</p>

      <p>版權所有.轉載必究.Copyright c 2010 awoo.com.tw.All Rights Reserved </p>
    </div>
</div>
</body>
</html> 

