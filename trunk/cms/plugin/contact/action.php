<?php
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$frist_name = isset($_POST['frist_name'])?$_POST['frist_name']:"";
		$last_name = isset($_POST['last_name'])?$_POST['last_name']:"";
		$phone = isset($_POST['phone'])?$_POST['phone']:"";
		$email = isset($_POST['email'])?$_POST['email']:"";
		$msg = isset($_POST['msg'])?$_POST['msg']:"";
		$sex = isset($_POST['sex'])?$_POST['sex']:"";
		$ip = isset($_POST['ip'])?$_POST['ip']:"";
		$name = $sex.$frist_name." ".$last_name;
		$sql = "INSERT INTO `plu_contact` (`con_id`, `Ccate_id`, `con_title`, `con_name`, `con_phone`, `con_email`, `con_ip`, `con_content`, `con_reply`, `con_time`, `con_reply_time`) VALUES (NULL, '1', '聯絡表單', '$name', '$phone', '$email', '$ip', '$msg', NULL, NOW(), NOW())";
		$db->query($sql);
		redirect(WEBROOT."/index.php?cmsid=8", 0, "You're message is send!");
?>