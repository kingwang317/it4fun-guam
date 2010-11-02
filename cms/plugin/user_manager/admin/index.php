<?php
/*
模組參數
套件名稱：使用者管理
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
	private $plu_path = "?pluName=user_manager&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $plu_Cname = "使用者管理";
	
    function __construct() {
		//session_start();
		//$trail = new Breadcrumb();
		//$trail->add('Home', $_SERVER['PHP_SELF'], 0);
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
		case "do_add_user":
			$this->do_add_user();
			return false;
			break;
		case "do_edit_user":
			$this->do_edit_user();
			return false;
			break;
		case "do_del_user":
			$this->do_del_user();
			return false;
			break;
		case "show_add_user":
			$content = $this->show_add_user();
			return true;
			break;
		case "show_edit_user":
			$content = $this->show_edit_user();
			return true;
			break;		
		default:
			$content = $this->show_user_list();
			return true;
			break;
	}
		return false;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function show_user_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "使用者列表";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);
		$site_data = array();
		$count = 0;
		$dataTotal = $db->get_var("SELECT COUNT(user_id) FROM sys_user WHERE user_id != 'awoo_maintainer'");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT user_id,user_nickname,user_email FROM sys_user WHERE user_id != 'awoo_maintainer' LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
		if(isset($result)){
			foreach($result as $rows){
				$site_data[] = array(
					'count'					=>$count+1,
					'user_id'				=>$rows->user_id,
					'user_nickname'			=>$rows->user_nickname,
					'user_email'			=>$rows->user_email,
					"show_edit_user_link"	=>$this->plu_path."&func=show_edit_user&user_id=$rows->user_id",
					"do_del_user_link"		=>$this->plu_path."&func=do_del_user&user_id=$rows->user_id"
				) ;
				$count++;
			}
		}
		$tpl->assign("pager",$pagejump);
		$tpl->assign("count",$count);
		$tpl->assign("site_data",$site_data);
		$tpl->assign("func_Cname",$func_Cname);
		$tpl->assign("show_add_user_link",$this->plu_path."&func=show_add_user");
		$tpl->assign("plu_header_path",$plu_header);
		return $tpl->fetch("show_user_list.tpl");
}
function show_add_user(){
	$func_Cname = "新增使用者";
	$trail = new Breadcrumb();
	$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
	$tpl = init_tpl(SRVROOT.$this->tmpl_path);
	$plu_header = SRVROOT.$this->plu_header_path;
	$tpl->assign("func_Cname",$func_Cname);
	$tpl->assign("plu_header_path",$plu_header);
	$tpl->assign("cancel_add_url",$this->plu_path."&func=show_user_list");
	$tpl->assign("do_add_user_url",$this->plu_path."&func=do_add_user");
	return $tpl->fetch("show_add_user.tpl");
}
function show_edit_user(){
	$db = init_db();
	$func_Cname = "修改使用者";
	$trail = new Breadcrumb();
	$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
	$site_data = array();
	$tpl = init_tpl(SRVROOT.$this->tmpl_path);
	$plu_header = SRVROOT.$this->plu_header_path;
	$tpl->assign("func_Cname",$func_Cname);
	$tpl->assign("plu_header_path",$plu_header);
	$user_id = isset($_GET['user_id'])?$_GET['user_id']:"";
	$sql = "SELECT user_nickname,user_email FROM sys_user WHERE user_id = '$user_id'";
	$result = $db->get_results($sql);
	if(isset($result)){
		foreach($result as $row){
			$site_data[] = array(
				'user_id'				=>$user_id,
				'user_nickname'			=>$row->user_nickname,
				'user_email'			=>$row->user_email,
			) ;
		}
	}
	$tpl->assign("site_data",$site_data);
	$tpl->assign("cancel_edit_url",$this->plu_path."&func=show_user_list");
	$tpl->assign("do_edit_user_url",$this->plu_path."&func=do_edit_user");
	return $tpl->fetch("show_edit_user.tpl");
}
function do_add_user(){
	$db = init_db();
	$user_id = isset($_POST['user_id'])?$_POST['user_id']:"";
	$user_name = isset($_POST['user_name'])?$_POST['user_name']:"";
	$user_passwd = isset($_POST['user_passwd'])?md5($_POST['user_passwd']):"";
	$user_email = isset($_POST['user_email'])?$_POST['user_email']:"";
	if($this->check_user_id($user_id)){
		redirect("?func=show_user_list", 0, "此帳號已經被使用過了");
		return false;
	}else{
		$sql  = "INSERT INTO sys_user (user_id, user_passwd,user_nickname, user_email) ";
		$sql .= "VALUES ('$user_id', '$user_passwd','$user_name', '$user_email')";
		$db->query($sql);
	}
	//echo $sql;
	redirect("?func=show_user_list", 0, "新增已完成");
	
}
function do_edit_user(){
	$db = init_db();
	$user_id = isset($_POST['user_id'])?$_POST['user_id']:"";
	$user_name = isset($_POST['user_name'])?$_POST['user_name']:"";
	$user_passwd = isset($_POST['user_passwd'])?md5($_POST['user_passwd']):"";
	$user_email = isset($_POST['user_email'])?$_POST['user_email']:"";

	$update_pri_sql = "UPDATE `sys_user` SET`user_passwd` = '$user_passwd',`user_nickname` = '$user_name',`user_email` = '$user_email' WHERE `user_id` = '$user_id' LIMIT 1 ;";
	$db->query($update_pri_sql);;
	redirect("?func=show_user_list", 0, "修改已完成");
}
function show_user_pri(){
	$db = init_db();
	//$content = "<tr><td colspan='3'><a href=?func=show_add_pri >新增身分</a></td></tr>";
	$content = "<form name='edit_form' method='post' action='?func=do_edit_user_pri'><tr><th>序號</th><th>帳號</th><th>身分</th><th>操作</th></tr>";
	$count = 1;
	$sel_sql = "SELECT DISTINCT pri_name,pri_id FROM sys_privileges";
	$sql_result = $db->get_results($sel_sql);
	$sql = "SELECT user_id,user_pri,user_nickname FROM sys_user";
	$result = $db->get_results($sql);
	if(isset($result)){
		foreach($result as $rows){
			$select = "<SELECT name='sel_$rows->user_id'>";
			foreach($sql_result as $sel_row){
				if($rows->user_pri == $sel_row->pri_id)
					$select .="<option value='$sel_row->pri_id' selected=true>$sel_row->pri_name</option>";
				else
					$select .="<option value='$sel_row->pri_id'>$sel_row->pri_name</option>";
			}
			$select .= "</SELECT>";
				
			$content .= "<tr><td>$count</td><td>$rows->user_nickname($rows->user_id)</td><td>$select</td><td><a  href='#' onclick=sunbit_form('$rows->user_id')>修改</a></td></tr>";
			$count++;
		}
	}
	return $content;
}
function do_edit_user_pri(){
	$db = init_db();
	$user_id = isset($_GET['user_id'])?$_GET['user_id']:redirect("?func=show_pri_list", 0, "不合法的網址");
	print_r($_POST);
	$sel_value = isset($_POST["sel_$user_id"])?$_POST["sel_$user_id"]:"general";
	echo $_POST["sel_$user_id"];
	$update_sql = "UPDATE sys_user SET user_pri = '$sel_value' WHERE user_id = '$user_id'";
	$db->query($update_sql);
	redirect("?func=show_user_pri", 0, "修改已完成");
	
}
function do_del_user(){
	$db = init_db();
	$user_id = isset($_GET['user_id'])?$_GET['user_id']:0;
	$sql = "DELETE FROM `sys_user` WHERE `user_id` = '$user_id'";
	$db->query($sql);
	redirect("?func=show_user_pri", 0, "刪除已完成");
}
function check_user_id($user_id){
	$db = init_db();
	$sql = "SELECT user_id FROM sys_user WHERE user_id = '$user_id'";
	$result = $db->get_var($sql);
	if(isset($result))
		return true;
	else
		return false;
}
}
?>