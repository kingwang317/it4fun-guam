<?php
/*
模組參數
套件名稱：最新消息管理
開發人：Max Clapton
*/

class member{
	private $tmpl_path = "/cms/plugin/member/admin/tmpl/";
	private $plu_path = "?pluName=member&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $plu_Cname = "會員管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("member");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_member":
				$this->do_add_member();
				return false;
			case "do_edit_member":
				$this->do_edit_member();
				return false;
			case "do_add_group":
				$this->do_add_group();
				return false;
			case "do_del_member":
				$this->do_del_member();
				return false;
			case "show_edit_member":
				$content = $this->show_edit_member();
				return true;
			case "show_add_group":
				$content = $this->show_add_group();
				return true;
			case "show_add_member":
				$content = $this->show_add_member();
				return true;
			default:
				$content = $this->show_member_list();
				return true;
		}
		return false;
	}

	function show_member_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "會員管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$filter = "";
		if(isset($_POST["search_item"])){
			$search_item = $_POST["search_item"];
			$filter = " WHERE account LIKE '%$search_item%' OR name LIKE '%$search_item%'";
		}else if(!empty($_POST["gid"]) && preg_match("/^[0-9]*$/",$_POST["gid"])){
			$cate_id = $_POST["gid"];
			$tpl->assign("cate_id", $cate_id);
			$filter = " WHERE group_id = $cate_id ";
		}
		$sel_sql = "SELECT DISTINCT group_id, group_name FROM plu_member_group";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(member_id) FROM plu_member" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT * FROM plu_member". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("member_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("search_member_url", $this->plu_path."&func=show_member_list");
		$tpl->assign("show_add_member_link", $this->plu_path."&func=show_add_member");
		$tpl->assign("show_add_group_url", $this->plu_path."&func=show_add_group");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_member_link" , $this->plu_path."&func=show_edit_member&member_id=");
		$tpl->assign("do_del_member_link" , $this->plu_path."&func=do_del_member&member_id=");
		return $tpl->fetch("show_member_list.tpl");
	}
	
	function show_add_group(){
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "新增分類";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_group_url" , $this->plu_path."&func=do_add_group");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_member_list");
		return $tpl->fetch("show_add_group.tpl");
	}
	
	function do_add_group(){
		$db = init_db();
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_member_group (group_name, group_desc) ";
		$sql .= "VALUES ('$name', '$description')";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_member_list", 0, "新增已完成");
	}
	
	function do_del_member(){
		$db = init_db();
		$member_id = isset($_GET['member_id'])?$_GET['member_id']:"";
		if(!(isset($_GET['member_id']) && preg_match("/^[0-9]*$/", $_GET['member_id']))){
			redirect($this->plu_path."&func=show_member_list", 0, "你所要刪除的消息不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_member WHERE member_id = $member_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_member_list", 0, "刪除已完成");
	}

	function show_add_member(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "新增會員";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT group_id, group_name FROM plu_member_group";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_member_url" , $this->plu_path."&func=do_add_member");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_member_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_add_member.tpl");
	}
	
	function do_add_member(){
		$db = init_db();
		if(!isset($_POST['account']) || preg_match("/^[a-zA-Z0-9._-]+$/", $_POST['account'])<=0){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的帳號不合法.");
			exit;
		}
		$account = $_POST['account'];
		$sql = "SELECT COUNT(*) FROM plu_member WHERE account='$account'";
		if($db->get_var($sql)>0){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的帳號已有人使用.");
			exit;
		}
		
		if(!isset($_POST['name']) || empty($_POST['name'])){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的名稱不合法.");
			exit;
		}
		$name = $_POST['name'];

		if(!empty($_POST["birth"]) && preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $_POST["birth"])<=0){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的日期格式不合法.");
			exit;
		}
		$birth = $_POST["birth"];

		if(!isset($_POST['email']) || empty($_POST['email'])){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的電子郵件不合法.");
			exit;
		}
		$email = $_POST['email'];
		
		if(!isset($_POST['password']) || empty($_POST['password'])){
		    redirect($this->plu_path."&func=show_member_list", 0, "請輸入密碼.");
			exit;
		}
		if($_POST['password'] != $_POST['confirmPwd']){
		    redirect($this->plu_path."&func=show_member_list", 0, "密碼不符, 請重新輸入.");
			exit;
		}
		$pwd = $_POST['password'];
		
		$sex = isset($_POST['sex'])?$_POST['sex']:"女";
		$tel = isset($_POST['tel'])?$_POST['tel']:"";
		$cellphone = isset($_POST['cellphone'])?$_POST['cellphone']:"";
		$addr = isset($_POST['addr'])?$_POST['addr']:"";
		$group_id = isset($_POST['gid'])?$_POST['gid']:-1;

		$sql  = "INSERT INTO plu_member (account, name, password, sex, birth, tel, cellphone, email, addr, group_id, modiTime) ";
		$sql .= "VALUES ('$account', '$name', MD5('$pwd'), '$sex', '$birth','$tel','$cellphone', '$email', '$addr', $group_id, NOW())";
		$db->query($sql);

		redirect($this->plu_path."&func=show_member_list", 0, "新增已完成");
	}
	function show_edit_member(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "更新會員資料";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT group_id, group_name FROM plu_member_group";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$member_id = isset($_GET['member_id'])?$_GET['member_id']:"";
		$sql = "SELECT plu_member.* FROM plu_member WHERE member_id=$member_id";
		$result = $db->get_row($sql, ARRAY_A);
		if(isset($result)){
			foreach($result as $key => $value){
				$tpl->assign($key, $value);
			}
		}

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_member_url" , $this->plu_path."&func=do_edit_member&uid=".$member_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_member_list");
		return $tpl->fetch("show_edit_member.tpl");
	}
	function do_edit_member(){
		$db = init_db();
		if(!(isset($_GET["uid"]) && preg_match("/^[0-9]*$/", $_GET["uid"]))){
			redirect($this->plu_path."&func=show_member_list", 0, "你所要變更的消息不合法");
			exit;
		}
		$member_id = $_GET["uid"];
		$group_id = isset($_POST['gid'])?$_POST['gid']:-1;

		if(!isset($_POST['name']) || empty($_POST['name'])){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的名稱不合法.");
			exit;
		}
		$name = $_POST['name'];

		if(!empty($_POST["birth"]) && preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $_POST["birth"])<=0){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的日期格式不合法.");
			exit;
		}
		$birth = $_POST["birth"];

		if(!isset($_POST['email']) || empty($_POST['email'])){
		    redirect($this->plu_path."&func=show_member_list", 0, "你所輸入的電子郵件不合法.");
			exit;
		}
		$email = $_POST['email'];
		
		$sex = isset($_POST['sex'])?$_POST['sex']:"女";
		$tel = isset($_POST['tel'])?$_POST['tel']:"";
		$cellphone = isset($_POST['cellphone'])?$_POST['cellphone']:"";
		$addr = isset($_POST['addr'])?$_POST['addr']:"";

		$sql  = "UPDATE plu_member SET name='$name', sex='$sex', birth='$birth', tel='$tel',";
		$sql .= " cellphone='$cellphone', email='$email', addr='$addr', group_id='$group_id', modiTime=NOW() WHERE member_id = $member_id ";
		$db->query($sql);
		
		//echo $sql;
		redirect($this->plu_path."&func=show_member_list", 0, "變更已完成");
	}
}
?>