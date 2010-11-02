<?php
auth_start();

//session start
function auth_start()
{
	if( !isset( $_SESSION ) )
	{
		set_time_limit(60);
		session_cache_limiter('private');
		session_start();
		set_time_limit(30);
	}
	if( isset( $_SESSION['REMOTE_ADDR'] ) && $_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] )
	{
		session_regenerate_id();
		$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
	}
	if( !isset( $_SESSION['REMOTE_ADDR'] ) )
	{
		$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
	}
	if( isset($_SESSION['site_key']) && $_SESSION['site_key'] != SITE_KEY )
	{
		user_logout();
	}
}

//取得登入者的所有權限
function auth_get_privileges($login_id, $site_id=0)
{
	//auth_start();
	$pri_ids = array();
	$pri_funcs = array();
	$db = init_db();

	//var_dump($_SESSION['privileges']);
	if( empty($_SESSION['site_id']) || $_SESSION['site_id'] != $site_id )
		$_SESSION['site_id'] = $site_id;
	else
		return $_SESSION['privileges'];

	
	// 取得使用者權限
	$sql = "SELECT user_pri FROM sys_user WHERE user_id = '$login_id'";
	$pri_id = $db->get_var($sql);
	if( empty($pri_id) )
		$pri_id = "general";//若身分為空白，則預設身分為一般
	return $pri_id;
	//$sql = "SELECT func_name FROM sys_pri_func WHERE pri_id = '$pri_id'";
	
	// 身份權限
	//$pri_ids[] = get_user_profile($login_id,$stype_id);

	/*$sql = "SELECT stype_id , adm_user_id FROM sys_sites WHERE site_id = '$site_id' ";
	$rows = $db->get_row($sql);
	if(	isset($rows) )
	{
		$stype_id = $rows->stype_id;
		$adm_user_id = $rows->adm_user_id;
		
 		// 身份權限
		$user_profiles = get_user_profile($login_id,$stype_id);
		if( !empty($user_profiles) )
		{
			$need_add = array_diff($user_profiles,$pri_ids);
			foreach($need_add as $pri_id)
				$pri_ids [] = $pri_id;
		}
		
		//群組權限
		//get user of groups
		$group_ids = get_user_groups($login_id,$stype_id);		
		foreach( $group_ids as $group_id )
		{
			//get group pri
			$sql = "SELECT pri_id FROM sys_group_pri WHERE group_id = '$group_id' " ;
			$results =  $db->get_results($sql);
			if( isset($results) )
			{
				foreach($results as $row)
				{
					//check pri 的 site_id
					$is_site_pri = is_site_privilege($row->pri_id,$site_id);
					if( $is_site_pri )
						$pri_ids[] = $row->pri_id;
				}
			}
		}
		
		if( $site_id > 0 )
		{
			// 子站長權限
			$site_admin_pri = get_stype_default_pri($stype_id);
			if( $adm_user_id == $login_id )
				$pri_ids[] = $site_admin_pri;
		}
		
	} // end if (isset $rows)

	$sql = "SELECT pri_id FROM sys_user_pri WHERE user_id = '$login_id' AND stype_id = '$site_id' ";
	$results = $db->get_results($sql);
	if( isset( $results ) )
		foreach( $results as $row)
		{
			$pri_ids[] = $row->pri_id;
		}
	
 	// 通用權限
 	$sql = "SELECT pri_id FROM sys_user_pri WHERE user_id = '$login_id' and stype_id = '-1'";
	$results = $db->get_results($sql);
	if( isset($results) )
		foreach($results as $row)
			$pri_ids[] = $row->pri_id;
	
	$_SESSION['privileges'] = $pri_ids; 
	return $pri_ids;*/
}

function auth_get_functions($login_id=null, $site_id=0)
{
	//auth_start();
	$func_name_array = array();
	$db = init_db();
	if(empty($login_id)) 
		$login_id = get_login_id();
	$pri_id = auth_get_privileges($login_id, $site_id);
	//$sql_values = "'". implode("','", $pri_ids). "'";
	//$sql = "SELECT func_id FROM sys_pri_func WHERE pri_id IN ($sql_values)";
		$sql = "SELECT func_name FROM sys_pri_func WHERE pri_id = '$pri_id'";
	$results = $db->get_results($sql);
	if( isset($results) )
		foreach($results as $row)
		{
			$func_name_array[] = $row->func_name;
		}
	
	$_SESSION['functions'] = $func_name_array;
	return $func_name_array;
}


//使用者登入
function user_login($user_id, $user_pwd, $user_type="user",$force_login=false)
{
	//auth_start();
	$db = init_db();
	$user_pwd = md5($user_pwd);
	if($user_type == "user"){
		$sql = "SELECT COUNT(*) FROM sys_user WHERE user_id = '$user_id' AND user_passwd = '$user_pwd' ";
	}else if($user_type == "member"){
		$sql = "SELECT COUNT(*) FROM plu_member_en WHERE account = '$user_id' AND password = '$user_pwd' ";
	}else if($user_type == "partner"){
		$sql = "SELECT COUNT(*) FROM plu_partner_en WHERE account = '$user_id' AND password = '$user_pwd' AND status_partner = '2' ";
	}
	$count = $db->get_var($sql);
	if( $count > 0 || $force_login )
	{
		$_SESSION['site_key'] = SITE_KEY;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_type'] = $user_type;
		$_SESSION['lang'] = DEFAULTLANG;
		$_SESSION['login'] = true;
		
		/*if( time() > (get_config('verify_time')+86400) )
		{
			$key = get_config("verify_key");
			if( !send_license($key) )
			{
				set_config('verify_falied', time());
				set_config('verify_failed_count', get_config('verify_failed_count') + 1);
			}
			set_config('verify_time', time());
		}*/

		return true; 
	}
	return false;
}

//使用者登出
function user_logout()
{
	//auth_start();
	unset($_SESSION["site_key"]);
	unset($_SESSION["user_id"]);
	unset($_SESSION["login"]);
	unset($_SESSION["privileges"]);
	unset($_SESSION["functions"]);
	unset($_SESSION['lang']);
	session_destroy();
}

//取得登入者id
function get_login_id()
{
	//auth_start();
	return isset($_SESSION["user_id"]) ? $_SESSION["user_id"]: null;
}
//取得語系碼
function get_lang_code()
{
	return isset($_SESSION["lang"]) ? $_SESSION["lang"]: null;
}
//取得登入者身分
function get_login_type()
{
	//auth_start();
	return isset($_SESSION["user_type"]) ? $_SESSION["user_type"]: null;
}
function auth_valid_function($func_id, $site_id=0)
{
	$user_id = get_login_id();
	if(is_maintainer())
		return true;
	if( empty($user_id) )return redirect(WEBROOT."/cms/admin/index.php?cmsroot=login", 0, '您尚未登入');
	$available_funcs = auth_get_functions($user_id, $site_id);
	//print_r($available_funcs);
	if( empty($available_funcs) ){
		redirect(WEBROOT."/cms/admin/index.php?cmsroot=login", 0, '您無權使用此功能');
		return false;
	}
	$key = in_array($func_id, $available_funcs);
	if( $key == false ){ 
		redirect(WEBROOT."/cms/admin/index.php?cmsroot=login", 0, '您無權使用此功能');
		return false;
	}
	return true;
}
function is_maintainer()
{
	if(get_login_id() == "awoo_maintainer")
		return true;
	else
		return false;

}
//判斷此身分是否能使用此模組
function auth_valid_module($mod_id, $site_id=0)
{
	$user_id = get_login_id();
	if( empty($user_id) ) return false;
	$available_funcs = auth_get_functions($user_id, $site_id);
	if( empty($available_funcs) ) return false;
	$db = init_db();
	$sql_values = "'". implode("','", $available_funcs). "'";
	$sql = "SELECT COUNT(*) FROM sys_functions WHERE func_id IN ($sql_values) AND mod_id = '$mod_id'";	
	$count = $db->get_var($sql);
	if( $count > 0 ) return true;
	return false;
}

//判斷身分
function auth_check($user_type="user",$mod_id=false, $site_id=false)
{
	$request_uri = urlencode($_SERVER['REQUEST_URI']);
	//echo $_SESSION['user_type'];
	$user_id = get_login_id();
	//if(isset($_SESSION['user_type']))
	if( empty($user_id) || !(isset($_SESSION['user_type']) && $_SESSION['user_type'] == $user_type))
	{
		if($user_type == "user"){
			redirect(WEBROOT."/cms/admin/index.php?cmsroot=login", 0, '您尚未登入');
			die("您尚未登入");
		}else if($user_type == "member"){
			redirect(WEBROOT."/login.php", 0, '您尚未登入');
			die("您尚未登入");
		}
	}

	/*$db = init_db();
	$user_pris = auth_get_privileges($user_id, $site_id);
	//maintainer 可進任何站
	if( !in_array("_maintainer",$user_pris) )
	{
		if( $site_id AND !is_site_user($user_id,$site_id) )
		{
			user_logout();
			redirect("./admin.php?site_id=$site_id&goto=$request_uri", 0, _('您無權進入此站，請確認您的身份'));
			die(_('您無權進入此站，請確認您的身份'));
		}
	}
	

	if( $mod_id != 'login' && $mod_id != 'main' && $mod_id != 'efile' &&  is_multi_func( $mod_id , $site_id ) == false )
	{
		redirect("./admin.php?site_id=$site_id&goto=$request_uri". $_SERVER['REQUEST_URI'], 0, _('你沒有權限進入此模姐'));
		die(_('您沒有權限進入此模姐'));
	}*/

}

function is_multi_func( $mod_id , $site_id=0 )
{
	$db = init_db();
	$sql = " SELECT count(*) FROM sys_functions WHERE mod_id = '$mod_id' AND func_call IS null ";
	$is_func_call = $db->get_var($sql);
	if( $is_func_call == 1 )  return auth_valid_module($mod_id, $site_id);
	if( !isset($_GET['func_call']) ) return false;
	$func_call = $_GET['func_call'];
	$sql = " SELECT func_id FROM sys_functions WHERE func_call = '$func_call' AND mod_id = '$mod_id' ";
	$func_id = $db->get_var($sql);
	return auth_valid_function($func_id,$site_id);
}


function auth_get_func_calls($site_id, $mod_id)
{
	$user_id = get_login_id();
	if( empty($user_id) ) return null;
	$available_funcs = auth_get_functions($user_id, $site_id);
	if( empty($available_funcs) ) return null;
	
	$sql_values = "'". implode("','", $available_funcs). "'";
	$sql  = "SELECT `func_call`,`func_name`, `func_order` FROM `sys_functions` ";
	$sql .= "WHERE `mod_id` = '$mod_id' AND func_id IN ($sql_values) AND `func_call` IS NOT null ORDER BY func_order ";
	
	$db = init_db();
	$results = $db->get_results($sql);
	$func_calls = array();
	if( isset($results) )
	{
		foreach($results as $row)
		{
			$func_calls[] = array(
				'func_call'		=>	$row->func_call,
				'func_name'		=>	$row->func_name,
				'func_order'	=>	$row->func_order,
			);
		}
	}
	usort($func_calls, "func_call_sort");
	return $func_calls;
}
function func_call_sort($funca, $funcb)
{
	$db = init_db();
	
	$ordera = $funca['func_order'];
	$orderb = $funcb['func_order'];
	if( $ordera == $orderb )
		return strcasecmp($funca['func_call'], $funcb['func_call']);
    return $ordera - $orderb;
}

function auth_get_modules($site_id=0, $is_front=null, $mod_type=null, $is_admin=null, $mcat_id=null)
{
	$user_id = get_login_id();
	if( empty($user_id) ) return null;
	$available_funcs = auth_get_functions($user_id, $site_id);
	if( empty($available_funcs) ) return null;
	
	$sql_values = "'". implode("','", $available_funcs). "'";
	
	$sql  = "SELECT DISTINCT m.mod_id, m.mod_name, m.mcat_id, m.mod_order FROM sys_functions AS f, sys_modules AS m ";
	$sql .= "WHERE mod_enable = 1 AND func_id IN ($sql_values) AND f.mod_id = m.mod_id ";
	
	if( isset($is_admin) )
		$sql .= "AND m.mod_admin = '". ($is_admin ? 1:0) ."' ";
	if( isset($is_front) )
		$sql .= "AND mod_frontname IS ". ($is_front ? "NOT":"") ." NULL ";
	if( isset($mod_type) )
	{
		$mod_type = addslashes($mod_type);
		$sql .= "AND m.mod_type = '$mod_type' ";
	}
	if( isset($mcat_id) )
	{
		$mcat_id = addslashes($mcat_id);
		$sql .= "AND m.mcat_id = '$mcat_id' ";	
	}
	//避免在子站出現不支援的功能
	if( $site_id > 0 )
	{
		$sql .= "AND m.mod_multi_site = '1' ";
	}
	$sql .= "ORDER BY m.mod_order, f.func_order";
	$db = init_db();
	$results = $db->get_results($sql);
	if( isset($results) )
		foreach($results as $row)
		{
			$sub_funcs = auth_get_func_calls($site_id, $row->mod_id);				
			$data[] = array(
				'mod_id'		=> $row->mod_id,
				'mcat_id'		=> $row->mcat_id,
				'mod_name'		=> $row->mod_name,
				'mod_order'		=> $row->mod_order,
				'func_call'		=> $sub_funcs,
			);
		}
	return $data;
}

function auth_get_admin_menu($site_id=0, $is_front=null, $mod_type=null, $is_admin=null, $mcat_id=null)
{
	$mods = auth_get_modules($site_id, $is_front, $mod_type, $is_admin, $mcat_id);
	//var_dump($mods);
	if( empty($mods) ) return null;

	foreach($mods as $mod)
	{
		$mcat_name = get_module_category_name($mod['mod_id']);
		if( !isset($data[$mcat_name]) )
			$data[$mcat_name] = array();
		$data[$mcat_name][] = $mod;
		usort($data[$mcat_name], "module_sort");
	}
	uksort($data, "module_category_sort");
	return $data;
}
function module_sort($moda, $modb)
{
	$db = init_db();
	
	$ordera = $moda['mod_order'];
	$orderb = $modb['mod_order'];
	if( $ordera == $orderb )
		return strcasecmp($moda['mod_id'], $modb['mod_id']);
    return $ordera - $orderb;
}
function module_category_sort($a, $b)
{
	$db = init_db();
	
	$ordera = $db->get_var("SELECT mcat_order FROM sys_mod_cat WHERE mcat_name='$a'");
	$orderb = $db->get_var("SELECT mcat_order FROM sys_mod_cat WHERE mcat_name='$b'");
	if( $ordera == $orderb )
		return strcasecmp($a, $b);
    return $ordera - $orderb;
}

//判斷使用者個別權限是否已建立
function is_user_pri($user_id, $pri_id ,$site_id=-1)
{
	$db = init_db();
	return $db->get_var("SELECT user_id FROM sys_user_pri WHERE user_id = '$user_id' AND pri_id = '$pri_id' AND stype_id = '$site_id' ");
}

//增加使用者個別權限
function add_user_pri($user_id, $pri_id, $site_id=-1)
{
	$db = init_db();
	$pri = is_user_pri($user_id, $pri_id,$site_id);
	if( !isset($pri) )
	{
		$pri_sql = "INSERT INTO sys_user_pri(user_id,pri_id,stype_id) VALUE('$user_id','$pri_id','$site_id')";
		$db->query($pri_sql);
	}
}

//刪除使用者個別權限
function delete_user_pri($user_id, $pri_id , $site_id=-1)
{
	$db = init_db();
	$pri_sql = "DELETE FROM sys_user_pri WHERE user_id = '$user_id' AND stype_id = '$site_id' AND pri_id = '$pri_id' ";
	$db->query($pri_sql);
}

//判斷使用者個別權限是否已建立
function is_group_pri($group_id, $pri_id )
{
	$db = init_db();
	return $db->get_var("SELECT pri_id FROM sys_group_pri WHERE group_id = '$group_id' AND pri_id = '$pri_id' ");
}
//增加群組權限
function add_group_pri($group_id, $pri_id)
{
	$db = init_db();
	$pri = is_group_pri($group_id, $pri_id);
	if( !isset($pri) )
	{
		$pri_sql = "INSERT INTO sys_group_pri(group_id,pri_id) VALUE('$group_id','$pri_id')";
		$db->query($pri_sql);
	}
}
//刪除群組個別權限
function delete_group_pri($group_id, $pri_id )
{
	$db = init_db();
	$sql = "DELETE FROM sys_group_pri WHERE group_id = '$group_id' AND pri_id = '$pri_id' ";
	$db->query($sql);
}

//取得使用者所有個別權限
function get_user_pri($user_id)
{
	$db = init_db();	
	$result_pri = $db->get_results("SELECT pri_id FROM sys_user_pri WHERE user_id = '$user_id'");
	if(isset($result_pri)) {
		$pris = array();
		foreach($result_pri as $pri) {
			$pris[] = $pri->pri_id;
		}
		return $pris;
	} else {
		return null;
	}
}

//新增權限
function add_privilege($pri_id, $pri_name, $pri_enable=1 ,$pri_modifiable=0 , $pri_assignable=0 , $pri_order=10 ,$mod_id = null ,$stype_id=-1) 
{
	$db = init_db();
	if( empty($mod_id) ) $mod_id = 'NULL';
	else $mod_id = "'$mod_id'";
	$sql = "INSERT INTO `sys_privileges` (`pri_id`, `pri_name`, `pri_enable`, `pri_modifiable`, `pri_assignable`, `pri_order` , `mod_id` , `stype_id`) 
			VALUES 	('$pri_id', '$pri_name', '$pri_enable', '$pri_modifiable' , '$pri_assignable' , '$pri_order' ,$mod_id  ,'$stype_id')";
	$db->query($sql);
}

//增加此權限擁有的功能
function add_pri_func($pri_id, $func_id) 
{
	$db = init_db();
	$sql = "INSERT INTO `sys_pri_func` (`pri_id`, `func_id`) VALUES ('$pri_id', '$func_id')";
	$db->query($sql);
}

//刪除權限
function delete_privilege($pri_id)
{
	$db = init_db();
	$sql =" DELETE FROM sys_privileges WHERE pri_id='$pri_id' ";
	$db->query($sql);
	$sql =" DELETE FROM sys_pri_func WHERE pri_id='$pri_id' ";
	$db->query($sql);
	$sql =" DELETE FROM sys_site_pri WHERE pri_id='$pri_id' ";
	$db->query($sql);
	$sql =" DELETE FROM sys_user_pri WHERE pri_id='$pri_id' ";
	$db->query($sql);
	$sql =" DELETE FROM sys_group_pri WHERE pri_id='$pri_id' ";
	$db->query($sql);
}

function is_site_privilege($pri_id,$site_id)
{
	$db = init_db();
	$sql = "SELECT COUNT(*) FROM sys_privileges WHERE pri_id = '$pri_id' AND ( stype_id = '$site_id' OR stype_id = '-1') " ;
	$is_site_pri =  $db->get_var($sql);
	if( $is_site_pri > 0 )
		return true;
	return false;
}

function is_profile_module_pri( $mod_id,$pri_id )
{
	$db = init_db();
	$sql = "SELECT mod_is_profile FROM sys_modules WHERE mod_id = '$mod_id' ";
	$mod_is_profile = $db->get_var($sql);
	if( !$mod_is_profile)	return false;
	$sql = "SELECT COUNT(*) FROM sys_privileges WHERE pri_id = '$pri_id' AND mod_id = '$mod_id' ";
	$count = $db->get_var($sql);
	if( $count )  return true;
	return false;
}

function get_site_available_pri($site_id)
{
	$db = init_db();
	$stype_id = get_site_type($site_id);
	$sql = "SELECT pri_id FROM sys_site_pri WHERE stype_id ='$stype_id' OR stype_id='$site_id' ";
	$res = $db->get_col($sql);
	if( !empty($res) )
		return $res;
	else
		return null;
}

function get_site_available_funcs($site_id)
{
	$db = init_db();
	$res = get_site_available_pri($site_id);
	//var_dump($res);
	if( isset($res) )
	{
		$func_ids = array();
		foreach( $res as $pri_id )
		{
			$sql = "SELECT func_id FROM sys_pri_func WHERE pri_id = '$pri_id' ";
			$res2 = $db->get_results($sql);
			if( isset($res2) )
			{
				foreach( $res2 as $row2 )
				{
					$func_id = $row2->func_id;
					if( !in_array($func_id,$func_ids) )
						$func_ids  [] = $func_id;
				}
			}
		}
		return $func_ids;
	}
	return null;
}
function get_profile_privileges()
{
	$db = init_db();
	$pris = array();
	$mod_ids = get_profile_modules();
	foreach( $mod_ids as $mod_id )
	{
		$sql = "SELECT pri_id,pri_name,mod_id,stype_id FROM sys_privileges WHERE mod_id = '$mod_id'";
		$results = $db->get_results($sql);
		if( isset($results) )
		{
			foreach( $results as $row )
			{
				$pris [] = array(
					'pri_id'		=>	$row->pri_id,
					'pri_name'		=>	$row->pri_name,
					'mod_id'		=>	$row->mod_id,
					'stype_id'		=>	$row->stype_id,
				);
			}
		}
	}
	return $pris;
}
?>