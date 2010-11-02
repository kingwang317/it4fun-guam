<?php
/*
模組參數
套件名稱：權限管理
parent：使用者管理
開發人：Mr.King
*/

/*
根據所需用到的套件作require
*/
//偷懶專用
require_once(SRVROOT.'/cms/inc/admin_breadcrumb.inc.php');
require_once(SRVROOT."/cms/inc/incpkg.inc.php");
class user_manager{
	private $tmpl_path = "/cms/plugin/user_manager/admin/tmpl/";
	private $plu_path = "?pluName=user_manager&pluAdmin=admin/sub.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $plu_Cname = "權限管理";
	
    function __construct() {
		//驗證權限
		auth_valid_function("user_manager");
		//呼叫基本套件
		include_db_pkg();
    }
	
/*
後臺功能切換
1. 顯示畫面模組以show_ 為開頭 ex: show_user_list
2. 會顯示畫面的功能要return ture,不用顯示return flase
*/
function get_content(&$content){
	$func = isset($_GET["func"])?$_GET["func"]:"";
	switch($func){
		case "do_add_pri":
			$this->do_add_pri();
			return false;
			break;
		case "do_edit_pri":
			$this->do_edit_pri();
			return false;
			break;
		case "do_del_pri":
			$this->do_del_pri();
			return false;
			break;
		case "do_edit_user_pri":
			$this->do_edit_user_pri();
			return false;
			break;
		case "show_add_pri":
			$content = $this->show_add_pri();
			return true;
			break;
		case "show_edit_pri":
			$content = $this->show_edit_pri();
			return true;
			break;
		case "show_user_pri":
			$content = $this->show_user_pri();
			return true;
			break;
		default:
			$content = $this->show_user_pri();
			return true;
			break;
	}
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function show_pri_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "身分列表";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);
		$site_data = array();
		$count = 1;
		$dataTotal = $db->get_var("SELECT COUNT(user_id) FROM sys_user WHERE user_id != 'awoo_maintainer'");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT pri_id,pri_name FROM sys_privileges LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
		if(isset($result)){
			foreach($result as $rows){
				$site_data[] = array(
					'count'					=>$count+1,
					'pri_id'				=>$rows->pri_id,
					'pri_name'				=>$rows->pri_name,
					"show_edit_pri_link"	=>$this->plu_path."&func=show_edit_user&user_id=$rows->user_id",
					"do_del_pri_link"		=>$this->plu_path."&func=do_del_user&user_id=$rows->user_id"
				) ;
				$count++;
			}
		}
		$tpl->assign("pager",$pagejump);
		$tpl->assign("count",$count);
		$tpl->assign("site_data",$site_data);
		$tpl->assign("func_Cname",$func_Cname);
		$tpl->assign("show_add_user_link",$this->plu_path."&func=show_add_pri");
		$tpl->assign("plu_header_path",$plu_header);
		return $tpl->fetch("show_pri_list.tpl");
}
function get_pri_list_count(){
	$db = init_db();
	$dataTotal = $db->get_var("SELECT COUNT(user_id) FROM sys_user WHERE user_id != 'awoo_maintainer' ");
	list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
	return $pagejump;
}
function show_add_pri(){
	$content = "<form name='add_form' method='post' action='?func=do_add_pri'><tr><th>身分帳號</th><td><input type='text' name='pri_id' /></td></tr>";
	$content .= "<tr><th>身分名稱</th><td><input type='text' name='pri_name' /></td></tr>";
	$func = get_all_func();
	$content .= "<tr><th colspan=2>CMS核心功能</th></tr>";
	$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='cms_content'></td><td>結構管理</td></tr>";
	$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='cms_config'></td><td>CMS 系統組態</td></tr>";
	$content .= "<tr><th colspan=2>CMS外掛功能</th></tr>";
	foreach ($func->plugin as $plugin){
		if($plugin->active=='on'){
			$func_name = $plugin['folder'];
			$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='$func_name'></td><td>$plugin->name($func_name)</td></tr>";
		}
	}
	$content .= "<tr><td colspan='2'><input type='submit' name='sub' value='增加身分'></td></tr></form>";
	
	return $content;
}
function show_edit_pri(){
	$db = init_db();
	$pri_id = isset($_GET['pri_id'])?$_GET['pri_id']:"";
	$sel_func = array();
	$sql = "SELECT a.func_name AS name
			FROM `sys_pri_func` AS a, `sys_privileges` AS b
			WHERE a.pri_id = '$pri_id'
			AND a.pri_id = b.pri_id
			LIMIT 0 , 30";
	$result = $db->get_results($sql);
	if(isset($result))
	foreach($result as $row){
		$sel_func[] = $row->name;
	}
	$sql = "SELECT pri_id,pri_name FROM sys_privileges WHERE pri_id = '$pri_id'";
	$result = $db->get_results($sql);
	
	foreach($result as $row){
		$content = "<form name='add_form' method='post' action='?func=do_edit_pri&pri_id=$row->pri_id'><tr><td>身分帳號</td><td><input type='text' name='pri_id' value='$row->pri_id' readonly=true/></td></tr>";
		$content .= "<tr><td>身分名稱</td><td><input type='text' name='pri_name' value='$row->pri_name' /></td></tr>";
		$content .= "<tr><th colspan=2>CMS核心功能</th></tr>";
		if(in_array("cms_content",$sel_func))
			$content .= "<tr><td><input type='checkbox' name='chk_func[]' checked=true value='cms_content' ></td><td>CMS 結構管理</td></tr>";
		else
			$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='cms_content'></td><td>結構管理</td></tr>";
		if(in_array("cms_config",$sel_func))
			$content .= "<tr><td><input type='checkbox' name='chk_func[]' checked=true value='cms_config' ></td><td>CMS 系統組態</td></tr>";
		else
			$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='cms_config'></td><td>CMS 系統組態</td></tr>";
		$content .= "<tr><th colspan=2>CMS外掛功能</th></tr>";
		$func = get_all_func();
		foreach ($func->plugin as $plugin){
			if($plugin->active=='on'){
				$func_name = $plugin['folder'];
				if(in_array($func_name,$sel_func))
					$content .= "<tr><td><input type='checkbox' name='chk_func[]' checked=true value='$func_name'></td><td>$plugin->name($func_name)</td></tr>";
				else
					$content .= "<tr><td><input type='checkbox' name='chk_func[]' value='$func_name'></td><td>$plugin->name($func_name)</td></tr>";					
			}
		}	
	}

	$content .= "<tr><td colspan='2'><input type='submit' name='sub' value='修改身分'></td></tr></form>";
	return $content;	
}
function do_add_pri(){
	$db = init_db();
	$func = isset($_POST['chk_func'])?$_POST['chk_func']:"";
	$pri_id = isset($_POST['pri_id'])?$_POST['pri_id']:"";
	$pri_name = isset($_POST['pri_name'])?$_POST['pri_name']:"";
	if(check_pri_id($pri_id)){
		redirect("?func=show_pri_list", 0, "此身分帳號已經被使用過了");
		return false;
	}else{
		$add_pri_sql = "INSERT INTO `sys_privileges` (`pri_id` ,`pri_name`)VALUES ('$pri_id', '$pri_name');";
		$db->query($add_pri_sql);
		do_set_func($pri_id,$func);
	}
	redirect("?func=show_pri_list", 0, "新增已完成");
	
}
function do_edit_pri(){
	$db = init_db();
	$func = isset($_POST['chk_func'])?$_POST['chk_func']:"";
	$pri_id = isset($_GET['pri_id'])?$_GET['pri_id']:"";
	$pri_name = isset($_POST['pri_name'])?$_POST['pri_name']:"";

	$update_pri_sql = "UPDATE `sys_privileges` SET `pri_name` = '$pri_name' WHERE `pri_id` = '$pri_id' LIMIT 1 ;";
	$db->query($update_pri_sql);
	do_set_func($pri_id,$func);
	redirect("?func=show_pri_list", 0, "修改已完成");
}
function show_user_pri(){
	$db = init_db();
	$tpl = init_tpl(SRVROOT.$this->tmpl_path);
	$plu_header = SRVROOT.$this->plu_header_path;
	//加入麵包屑
	$func_Cname = "使用者對應身分列表";
	$trail = new Breadcrumb();
	$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
	$sel_data  = array();
	$site_data = array();
	$count = 0;
	$sel_sql = "SELECT DISTINCT pri_name,pri_id FROM sys_privileges";
	$sel_result = $db->get_results($sel_sql);
	if(isset($sel_result)){
		foreach($sel_result as $rows){
			$sel_data[] = array(
				'pri_name'				=>$rows->pri_name,
				'pri_id'				=>$rows->pri_id,
			) ;
		}		
	}
	
	$sql = "SELECT user_id,user_pri,user_nickname FROM sys_user WHERE user_id != 'awoo_maintainer'";
	$result = $db->get_results($sql);
	if(isset($result)){
		foreach($result as $rows){
			$site_data[] = array(
				'count'					=>$count+1,
				'user_id'				=>$rows->user_id,
				'user_pri'				=>$rows->user_pri,
				'user_nickname'			=>$rows->user_nickname,
				'do_edit_user_pri_link'		=>$this->plu_path."&func=do_edit_user_pri"
			) ;
			$count++;
		}
	}
	$tpl->assign("count",$count);
	$tpl->assign("sel_data",$sel_data);
	$tpl->assign("site_data",$site_data);
	$tpl->assign("func_Cname",$func_Cname);
	$tpl->assign("do_edit_user_pri_url",$this->plu_path."&func=do_edit_user_pri");
	$tpl->assign("show_pri_list_url",$this->plu_path."&func=show_pri_list");
	$tpl->assign("show_add_pri_url",$this->plu_path."&func=show_add_pri");
	$tpl->assign("plu_header_path",$plu_header);
	return $tpl->fetch("show_user_pri.tpl");
	
}
function do_edit_user_pri(){
	$db = init_db();
	$user_id = isset($_GET['user_id'])?$_GET['user_id']:redirect("?func=show_pri_list", 0, "不合法的網址");
	$sel_value = isset($_POST["sel_$user_id"])?$_POST["sel_$user_id"]:"general";
	$update_sql = "UPDATE sys_user SET user_pri = '$sel_value' WHERE user_id = '$user_id'";
	$db->query($update_sql);
	redirect("?func=show_user_pri", 0, "修改已完成");
	
}
function do_del_pri(){
	$db = init_db();
	$pri_id = isset($_GET['pri_id'])?$_GET['pri_id']:0;
	$sql = "DELETE FROM `sys_privileges` WHERE `pri_id` = '$pri_id'";
	$db->query($sql);
	$sql = "DELETE FROM `sys_pri_func` WHERE `pri_id` = '$pri_id'";
	$db->query($sql);
	redirect("?func=show_pri_list", 0, "刪除已完成");
}
function get_all_func(){
	//require_once(SRVROOT."/cms/admin/config/ini.php");

	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$rootNode = $dom->createElement('plugins');
	$dom->appendChild($rootNode);

		$dir    = SRVROOT.'/cms/plugin';
		$dirAry = scandir($dir);
		
		foreach($dirAry as $key => $filename){
			if (is_dir("$dir/$filename") == true && $filename != '.' && $filename != '..'){
				$subDirAry = scandir("$dir/$filename");
				$hasConfig = array_search('config.xml', $subDirAry);
				if($hasConfig){
					$dom2 = new DOMDocument();
					$dom2->load("$dir/$filename/config.xml");
					$node2=$dom2->getElementsByTagName('plugin')->item(0);
					$node=$dom->importNode($node2, true);
					$node->setAttribute("folder",$filename);
					$rootNode->appendChild($node);
				}
			}
		}
		

	//echo $dom->saveXML();
	$content  = "";
	$sx = simplexml_import_dom($dom);
	return $sx;
}
function check_pri_id($pri_id){
	$db = init_db();
	$sql = "SELECT pri_id FROM sys_privileges WHERE pri_id = '$pri_id'";
	$result = $db->get_var($sql);
	if(isset($result))
		return true;
	else
		return false;
}
function do_set_func($pri_id,$func){
	$db = init_db();
	if(!empty($func)){
		$del_sql = "DELETE FROM `sys_pri_func` WHERE `pri_id` = '$pri_id'";
		$db->query($del_sql);	

		foreach($func as $row){
			$sql = "INSERT INTO `sys_pri_func` (`pri_id` ,`func_name`)VALUES ('$pri_id', '$row');";
			$db->query($sql);
		}
	}
}
}
?>