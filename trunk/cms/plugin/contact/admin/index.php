<?php
/*
模組參數
套件名稱：聯絡表單管理
開發人：Mr.King
*/

class contact{
	private $tmpl_path = "/cms/plugin/contact/admin/tmpl/";
	private $plu_path = "?pluName=contact&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/contact/";
	private $plu_Cname = "聯絡表單管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("contact");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_reply_contact":
				$this->do_reply_contact();
				return false;
			case "do_add_category":
				$this->do_add_category();
				return false;
			case "do_del_contact":
				$this->do_del_contact();
				return false;
			case "show_reply_contact":
				$content = $this->show_reply_contact();
				return true;
			case "show_add_category":
				$content = $this->show_add_category();
				return true;
			case "show_contact_datail":
				$content = $this->show_contact_datail();
				return true;
			default:
				$content = $this->show_contact_list();
				return true;
		}
		return false;
	}

	function show_contact_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "聯絡表單管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$cate_id = !empty($_POST["cid"]) && preg_match("/^[0-9]*$/",$_POST["cid"])?$_POST["cid"]:NULL;
		$filter = isset($cate_id)?" WHERE Ccate_id = $cate_id ":"";
		$sel_sql = "SELECT DISTINCT Ccate_id, Ccate_name FROM plu_contact_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		if(!empty($filter)){
			$_SESSION['filter'] = $filter;
		}else if(!empty($_GET['page']) && isset($_SESSION['filter']) && !empty($_SESSION['filter'])){
			$filter=$_SESSION['filter'];
		}
		$orderby = isset($_GET["orderby"])?$_GET["orderby"]:"";
		if($orderby == "ASC")
		{
			$tpl->assign("contact_orderby_cond", $orderby);
			$tpl->assign("contact_orderby_url", $this->plu_path."&func=show_contact_list&orderby=DESC");
			$filter .=" ORDER BY con_time ASC";
		}else{
			$tpl->assign("contact_orderby_url", $this->plu_path."&func=show_contact_list&orderby=ASC");
			$filter .=" ORDER BY con_time DESC";
		}
		$dataTotal = $db->get_var("SELECT COUNT(con_id) FROM plu_contact" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		
		$sql = "SELECT con_id, con_title,con_name,con_phone,con_time,con_reply FROM plu_contact". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("cate_id", $cate_id);
		$tpl->assign("contact_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("show_add_contact_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_reply_contact_link" , $this->plu_path."&func=show_reply_contact&con_id=");
		$tpl->assign("show_contact_detail_link" , $this->plu_path."&func=show_contact_datail&con_id=");
		$tpl->assign("do_del_contact_link" , $this->plu_path."&func=do_del_contact&con_id=");
		return $tpl->fetch("show_contact_list.tpl");
	}
	
	function show_add_category(){
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "新增分類";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);

		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_category_url" , $this->plu_path."&func=do_add_category");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_contact_list");
		return $tpl->fetch("show_add_category.tpl");
	}
	
	function do_add_category(){
		$db = init_db();
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_contact_category (Ccate_name, Ccate_content) ";
		$sql .= "VALUES ('$name', '$description')";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_contact_list", 0, "新增已完成");
	}
	
	function do_del_contact(){
		$db = init_db();
		$con_id = isset($_GET['con_id'])?$_GET['con_id']:"";
		if(!(isset($_GET['con_id']) && preg_match("/^[0-9]*$/", $_GET['con_id']))){
			redirect($this->plu_path."&func=show_contact_list", 0, "你所要刪除的表單不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_contact WHERE con_id = $con_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_contact_list", 0, "刪除已完成");
	}

	function show_contact_datail(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "表單內容";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$con_id = isset($_GET['con_id'])?$_GET['con_id']:"";
		if(!(isset($_GET['con_id']) && preg_match("/^[0-9]*$/", $_GET['con_id']))){
			redirect($this->plu_path."&func=show_contact_list", 0, "你所要刪除的表單不合法");
			exit;
		}
		$sql = "SELECT con.con_id, con.con_name, con.con_title, con.con_time, con.con_phone, con.con_email, con.con_ip, con.con_content,cate.Ccate_name AS cate_name,con.con_reply AS con_reply FROM plu_contact AS con,plu_contact_category AS cate WHERE con.Ccate_id = cate.Ccate_id AND con.con_id = '$con_id'";
		//echo $sql;
		$contact_data = $db->get_results($sql, ARRAY_A);
		//print_r($contact_data);cancel_edit_url
		$tpl->assign("contact_data", $contact_data);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_reply_contact_url" , $this->plu_path."&func=do_reply_contact&con_id=".$con_id);
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_contact_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_contact_detail.tpl");
	}
	
	function show_reply_contact(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "回覆表單";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$con_id = isset($_GET['con_id'])?$_GET['con_id']:"";
		if(!(isset($_GET['con_id']) && preg_match("/^[0-9]*$/", $_GET['con_id']))){
			redirect($this->plu_path."&func=show_contact_list", 0, "你所要刪除的表單不合法");
			exit;
		}
		$sql = "SELECT con.con_id, con.con_name, con.con_title, con.con_time, con.con_phone, con.con_email, con.con_ip, con.con_content,cate.Ccate_name AS cate_name  FROM plu_contact AS con,plu_contact_category AS cate WHERE con.Ccate_id = cate.Ccate_id AND con.con_id = '$con_id'";
		//echo $sql;
		$contact_data = $db->get_results($sql, ARRAY_A);
		//print_r($contact_data);
		$tpl->assign("contact_data", $contact_data);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_reply_contact_url" , $this->plu_path."&func=do_reply_contact&con_id=".$con_id);
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_contact_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_reply_contact.tpl");
	}
	function do_reply_contact(){
		$db = init_db();
		if(!(isset($_GET["con_id"]) && preg_match("/^[0-9]*$/", $_GET["con_id"]))){
			redirect($this->plu_path."&func=show_contact_list", 0, "你所要變更的消息不合法");
			exit;
		}
		$con_id = $_GET["con_id"];
		$con_content = isset($_POST['content'])?$_POST['content']:"";
		$sql  = "UPDATE plu_contact SET con_reply='$con_content',con_reply_time=NOW() WHERE con_id = '$con_id' ";
		$db->query($sql);
		
		//echo $sql;
		redirect($this->plu_path."&func=show_contact_list", 0, "變更已完成");
	}
}
?>