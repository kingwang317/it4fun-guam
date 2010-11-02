<?php 
function start_gzhandler()
{
	//if ( !preg_match("/MSIE/", $_SERVER["HTTP_USER_AGENT"]) )
		//ob_start( 'ob_gzhandler' );
}

function header_nocache()
{
	// Dynamic pages header
	header("ETag: PUB" . time());
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
	header("Pragma: no-cache");
	header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
	//session_cache_limiter("nocache");
}

function url_link_query($script, $mod_id, $func, $site_id, $args=null, $encode=true)
{
	$data = array();
	$data['mod_id'] = $mod_id;
	if( isset($func) ) $data['func'] = $func;
	if( isset($site_id) ) $data['site_id'] = $site_id;
	if( is_array($args) ) $data = array_merge($data, $args);
	
	$url = "$script?". http_build_query($data);
	if( $encode ) $url = htmlspecialchars($url); 
	return $url;
}
function check_confirm($msg,$url)
{
	$msg = addslashes($msg);
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	$str  = "<script type='text/javascript'>";
	$str.="if( confirm('$msg') )";
	$str.="window.location='$url'";
	$str.="\n";
	$str.="</script>\n";
	echo $str;
	echo "<noscript>$msg</noscript>\n";
	return;
}
function notify($msg)
{
	$msg = addslashes($msg);
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script type='text/javascript'>alert('$msg')</script>\n";
	echo "<noscript>$msg</noscript>\n";
	return;
}
function return_notify($msg)
{
	$msg = addslashes($msg);
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script type='text/javascript'>alert('$msg'); history.back();</script>\n";
	echo "<noscript>$msg</noscript>\n";
	return;
}

function redirect($url, $delay=0, $msg=null)
{
	if( isset($msg) ) notify($msg);
	echo "<meta http-equiv='Refresh' content='$delay; url=$url'>";
	if( $delay > 0 )
	{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "重新導向於 $delay 秒鐘後，或選<a href=\"$url\">此處</a>進入下一頁。<br />";
		echo "Redirecting in $delay seconds, or press <a href=\"$url\">here</a> to enter next page immediately.<br />";
	}
}
function close_this_page($msg=null)
{
	if( isset($msg) ) notify($msg);
	echo "<script type='text/javascript'>javascript:window.close();</script>";
}
function delete_site_config($site_id)
{
	$db = init_db();
	$sql = "DELETE FROM proj_config WHERE site_id='$site_id'";
	return $db->query($sql);
}
function delete_config($conf_name)
{
	$db = init_db();
	$sql = "DELETE FROM sys_config WHERE conf_name='$conf_name'";
	return $db->query($sql);
}
function set_config($conf_name, $conf_value)
{
	$db = init_db();
	if( isset($conf_value) )
	{
		$sql = "SELECT COUNT(*) FROM sys_config WHERE AND conf_name='$conf_name'";
		$count = $db->get_var($sql);
		if( $count > 0 ) // Update
		{
			$sql = "UPDATE sys_config SET conf_value='$conf_value' WHERE conf_name='$conf_name'";
			return $db->query($sql);
		} else { // Insert
			$sql = "INSERT sys_config (conf_name, conf_value) VALUES('$conf_name', '$conf_value')";
			return $db->query($sql);
		} 
	}
	else delete_config($conf_name, $site_id);
}
function get_config($conf_name)
{
	$db = init_db();
	$sql = "SELECT conf_value FROM sys_config WHERE conf_name='$conf_name'";
	return $db->get_var($sql);
}
function admin_log($log_action)
{
	$user_id = get_login_id();
	$site_id = empty($_GET['site_id']) ? '0':$_GET['site_id'];
	$mod_id = empty($_GET['mod']) ? '':$_GET['mod'];							//升、降冪
	$log_date=date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
	$user_ip=$_SERVER["REMOTE_ADDR"];
	$db =init_db();
	$login_action=htmlspecialchars(db_escape($log_action));
	$sql = "INSERT INTO proj_admin_log(user_id, mod_id, log_user_ip, log_date, log_action, site_id)VALUES('$user_id', '$mod_id', '$user_ip', '$log_date', '$login_action', '$site_id')";
	$db->query($sql);
}
//set_log 設置LOG到系統func_id為模組id,
//row_id為func內的欄位id,status有INSERT,UPDATE,DELETE三項,需大寫
function set_log($func_id,$row_id,$status){
	$db =init_db();
	$user_id = get_login_id();
	$status = strtoupper($status);
	if(!strpos("INSERT,UPDATE,DELETE",$status) ){
		echo "status type error";
		return true;
	}
	$sql = "INSERT INTO `sys_log` (`log_id` ,`func_id` ,`row_id` ,`log_status` ,`log_time` ,`user_id`)
	VALUES (NULL , '$func_id', '$row_id', '$status', 'NOW()', '$login_id') ";
	$db->query($sql);
}
function get_log($func_id,$row_id = null,$status = null){
	$filter = "";
	if(!empty($row_id)){
		$filter .= "AND row_id = '$row_id' ";
	}else if(!empty($status)){
		$filter .= "AND log_status = '$status' ";
	}
	$sql = "SELECT log_id,log_time,user_id FROM `sys_log` WHERE func_id = '$func_id' ". $filter;
	$result = $db->get_results($sql);
	return $result;
}
function gettext_setting($lang_package, $lang_path) {
	bindtextdomain($lang_package, $lang_path); // $your_path/locale, 語系檔路徑
	bind_textdomain_codeset($lang_package,'UTF-8');
	textdomain($lang_package);
	return true;
}
?>