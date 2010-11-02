<?php
/*
模組參數
套件名稱：最新消息管理
開發人：Max Clapton
*/

class doc{
	private $tmpl_path = "/cms/plugin/doc/admin/tmpl/";
	private $plu_path = "?pluName=doc&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/docs/";
	private $plu_Cname = "文件下載管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("doc");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){	
			case "do_add_doc":
				$this->do_add_doc();
				return false;
			case "do_edit_doc":
				$this->do_edit_doc();
				return false;
			case "do_add_category":
				$this->do_add_category();
				return false;
			case "do_del_doc":
				$this->do_del_doc();
				return false;
			case "show_edit_doc":
				$content = $this->show_edit_doc();
				return true;
			case "show_add_category":
				$content = $this->show_add_category();
				return true;
			case "show_add_doc":
				$content = $this->show_add_doc();
				return true;
			default:
				$content = $this->show_doc_list();
				return true;
		}
		return false;
	}

	function show_doc_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "文件下載管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$filter = "";
		if(!empty($_POST["cate_id"]) && preg_match("/^[0-9]*$/",$_POST["cate_id"])){
			$cate_id = $_POST["cate_id"];
			$tpl->assign("cate_id", $cate_id);
			$filter = " WHERE cate_id = $cate_id ";
		}
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_document_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(doc_id) FROM plu_document" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT * FROM plu_document". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$newArray = array();
		$i = 0;
		if(count($result)>0){
			foreach($result as $row){
				$newArray[$i] = array();
				foreach($row as $key => $value){
					$newArray[$i][$key] = $value;
					if($key == "name"){
						$newArray[$i][$key] = substr($value, 0, strrpos($row[$key], "."));
					}
				}
				$i++;
			}
		}
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("doc_data", $newArray);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("show_doc_list_url", $this->plu_path."&func=show_doc_list");
		$tpl->assign("show_add_doc_link", $this->plu_path."&func=show_add_doc");
		$tpl->assign("show_add_cate_url", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_doc_link" , $this->plu_path."&func=show_edit_doc&doc_id=");
		$tpl->assign("do_del_doc_link" , $this->plu_path."&func=do_del_doc&doc_id=");
		return $tpl->fetch("show_doc_list.tpl");
	}
	
	function show_add_category(){
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "新增分類";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_category_url" , $this->plu_path."&func=do_add_category");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_doc_list");
		return $tpl->fetch("show_add_category.tpl");
	}
	
	function do_add_category(){
		$db = init_db();
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_document_category (cate_name, cate_desc) ";
		$sql .= "VALUES ('$name', '$description')";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_doc_list", 0, "新增已完成");
	}
	
	function do_del_doc(){
		$db = init_db();
		$doc_id = isset($_GET['doc_id'])?$_GET['doc_id']:"";
		if(!(isset($_GET['doc_id']) && preg_match("/^[0-9]*$/", $_GET['doc_id']))){
			redirect($this->plu_path."&func=show_doc_list", 0, "你所要刪除的消息不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_document WHERE doc_id = $doc_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_doc_list", 0, "刪除已完成");
	}

	function show_add_doc(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "上傳文件";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_document_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_doc_url" , $this->plu_path."&func=do_add_doc");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_doc_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_add_doc.tpl");
	}
	
	function do_add_doc(){
		$db = init_db();
		$publish_date = isset($_POST["PublishDate"])?$_POST["PublishDate"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $publish_date)<=0){
		    redirect("&func=show_doc_list", 0, "你所輸入的日期格式不合法.". $publish_date);
			exit;
		}

		$caption = isset($_POST['caption'])?$_POST['caption']:"";
		$desc = isset($_POST['desc'])?$_POST['desc']:"";
		$cate_id = isset($_POST['cid'])?$_POST['cid']:-1;
		
		if($_FILES["uploadDoc"]["size"] && $_FILES["uploadDoc"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["uploadDoc"]["tmp_name"];
			$filename = $_FILES["uploadDoc"]["name"];
			$sql  = "INSERT INTO plu_document (cate_id, caption, name, doc_desc, PublishDate, modiTime) ";
			$sql .= "VALUES ('$cate_id', '$caption', '$filename', '$desc','$publish_date', NOW())";
			$db->query($sql);

			$sql = "SELECT last_insert_id()";
			$id = $db->get_var($sql);
			$name = "docs_".$id.substr($_FILES["uploadDoc"]["name"], strrpos($_FILES["uploadDoc"]["name"], "."));
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
		}

		redirect($this->plu_path."&func=show_doc_list", 0, "新增已完成");
	}
	function show_edit_doc(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "更新文件";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_document_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$doc_id = isset($_GET['doc_id'])?$_GET['doc_id']:"";
		$sql = "SELECT * FROM plu_document WHERE doc_id=$doc_id";
		$result = $db->get_row($sql, ARRAY_A);
		if(isset($result)){
			foreach($result as $key => $value){
				if($key=='name'){
					$tpl->assign($key, substr($value, 0, strrpos($value, ".")));
					$tpl->assign('doc_type', substr($value, strrpos($value, ".")));
				}else{
					$tpl->assign($key, $value);
				}
			}
		}

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("uploadPath", WEBROOT.$this->upload_path);
		$tpl->assign("do_edit_doc_url" , $this->plu_path."&func=do_edit_doc&did=".$doc_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_doc_list");
		return $tpl->fetch("show_edit_doc.tpl");
	}
	function do_edit_doc(){
		$db = init_db();
		if(!(isset($_GET["did"]) && preg_match("/^[0-9]*$/", $_GET["did"]))){
			redirect($this->plu_path."&func=show_member_list", 0, "你所要變更的消息不合法");
			exit;
		}
		$doc_id = $_GET["did"];
		$publish_date = isset($_POST["PublishDate"])?$_POST["PublishDate"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $publish_date)<=0){
		    redirect("&func=show_doc_list", 0, "你所輸入的日期格式不合法.". $publish_date);
			exit;
		}
		
		$caption = isset($_POST['caption'])?$_POST['caption']:"";
		$desc = isset($_POST['desc'])?$_POST['desc']:"";
		$cate_id = isset($_POST['cid'])?$_POST['cid']:-1;
		
		if($_FILES["uploadDoc"]["size"] && $_FILES["uploadDoc"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["uploadDoc"]["tmp_name"];
			$filename = $_FILES["uploadDoc"]["name"];
			$name = "docs_".$doc_id.substr($_FILES["uploadDoc"]["name"], strrpos($_FILES["uploadDoc"]["name"], "."));
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql  = "UPDATE plu_document SET cate_id='$cate_id', caption='$caption', name='$filename', doc_desc='$desc' ";
			$sql .= ", PublishDate='$publish_date', modiTime=NOW() WHERE doc_id=$doc_id";
			$db->query($sql);
		}
		
		//echo $sql;
		redirect($this->plu_path."&func=show_doc_list", 0, "變更已完成");
	}
}
?>