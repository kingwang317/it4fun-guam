<?php
/*
模組參數
套件名稱：服務據點
開發人：Mr.King
*/

class distributor{
	private $tmpl_path = "/cms/plugin/distributor/admin/tmpl/";
	private $plu_path = "?pluName=distributor&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/distributor/";
	private $plu_Cname = "服務據點管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("distributor");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_dist":
				$this->do_add_dist();
				return false;
			case "do_edit_dist":
				$this->do_edit_dist();
				return false;
			case "do_add_place":
				$this->do_add_place();
				return false;
			case "do_del_dist":
				$this->do_del_dist();
				return false;
			case "show_edit_dist":
				$content = $this->show_edit_dist();
				return true;
			case "show_add_place":
				$content = $this->show_add_place();
				return true;
			case "show_add_dist":
				$content = $this->show_add_dist();
				return true;
			default:
				$content = $this->show_dist_list();
				return true;
		}
		return false;
	}

	function show_dist_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "服務據點管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$place_id = !empty($_POST["place_id"]) && preg_match("/^[0-9]*$/",$_POST["place_id"])?$_POST["place_id"]:NULL;
		$filter = isset($place_id)?" WHERE place_id = '$place_id' ":"";
		$sel_sql = "SELECT DISTINCT place_id, place_name FROM plu_dist_place";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(dist_id) FROM plu_distributor" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$orderby = isset($_GET["orderby"])?$_GET["orderby"]:"";
		if($orderby == "ASC")
		{
			$tpl->assign("dist_orderby_cond", $orderby);
			$tpl->assign("dist_orderby_url", $this->plu_path."&func=show_dist_list&orderby=DESC");
			$filter .=" ORDER BY ModiTime ASC";
		}else{
			$tpl->assign("dist_orderby_url", $this->plu_path."&func=show_dist_list&orderby=ASC");
			$filter .=" ORDER BY ModiTime DESC";
		}
		$sql = "SELECT dist_id, dist_name, dist_phone,dist_address, img_name, ModiTime FROM plu_distributor". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("place_id", $place_id);
		$tpl->assign("dist_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$tpl->assign("show_add_dist_link", $this->plu_path."&func=show_add_dist");
		$tpl->assign("show_add_dist_place", $this->plu_path."&func=show_add_place");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_dist_link" , $this->plu_path."&func=show_edit_dist&dist_id=");
		$tpl->assign("do_del_dist_link" , $this->plu_path."&func=do_del_dist&dist_id=");
		return $tpl->fetch("show_dist_list.tpl");
	}
	
	function show_add_place(){
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "新增地區";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_place_url" , $this->plu_path."&func=do_add_place");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_dist_list");
		return $tpl->fetch("show_add_place.tpl");
	}
	
	function do_add_place(){
		$db = init_db();
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_dist_place (place_name, place_content) ";
		$sql .= "VALUES ('$name', '$description')";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_dist_list", 0, "新增已完成");
	}
	
	function do_del_dist(){
		$db = init_db();
		$dist_id = isset($_GET['dist_id'])?$_GET['dist_id']:"";
		if(!(isset($_GET['dist_id']) && preg_match("/^[0-9]*$/", $_GET['dist_id']))){
			redirect($this->plu_path."&func=show_dist_list", 0, "你所要刪除的消息不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_distributor WHERE dist_id = $dist_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_dist_list", 0, "刪除已完成");
	}

	function show_add_dist(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "新增據點";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT place_id, place_name FROM plu_dist_place";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_dist_url" , $this->plu_path."&func=do_add_dist");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_dist_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_add_dist.tpl");
	}
	
	function do_add_dist(){
		$db = init_db();

		$dist_name = isset($_POST['dist_name'])?$_POST['dist_name']:"";
		$dist_url = isset($_POST['dist_url'])?$_POST['dist_url']:"";
		$dist_phone = isset($_POST['dist_phone'])?$_POST['dist_phone']:"";
		$dist_address = isset($_POST['dist_address'])?$_POST['dist_address']:"";
		$place_id = isset($_POST['place_id'])?$_POST['place_id']:"";

		$sql  = "INSERT INTO plu_distributor (place_id, dist_name, dist_url, dist_phone, dist_address, publishDate, modiTime) ";
		$sql .= "VALUES ('$place_id', '$dist_name','$dist_url', '$dist_phone','$dist_address', NOW(), NOW())";
		$db->query($sql);
		$sql = "SELECT last_insert_id()";
		$id = $db->get_var($sql);
		
		if($_FILES["pic"]["size"] && $_FILES["pic"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["pic"]["tmp_name"];
			$name = "dist_".$id.substr($_FILES["pic"]["name"], strrpos($_FILES["pic"]["name"], "."));
			$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_distributor SET img_name='$name',img_desc='$img_desc' WHERE dist_id=$id";
			$db->query($sql);
		}
		//echo $sql;
		redirect($this->plu_path."&func=show_dist_list", 0, "新增已完成");
	}
	function show_edit_dist(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		/*require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置*/

		//加入麵包屑
		$func_Cname = "變更據點";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT place_id, place_name FROM plu_dist_place";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$dist_id = isset($_GET['dist_id'])?$_GET['dist_id']:"";
		$sql = "SELECT UNIX_TIMESTAMP(PublishDate) as t,plu_distributor.* FROM plu_distributor WHERE dist_id=$dist_id";
		$result = $db->get_row($sql, ARRAY_A);
		if(isset($result)){
			foreach($result as $key => $value){
				if($key == "img_name" || $key == "movie_name")
					$tpl->assign($key, WEBROOT.$this->upload_path.$value);
				else
					$tpl->assign($key, $value);
			}
		}

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_dist_url" , $this->plu_path."&func=do_edit_dist&dist_id=".$dist_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_dist_list");
		//$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_edit_dist.tpl");
	}
	function do_edit_dist(){
		$db = init_db();
		$dist_id = $_GET["dist_id"];
		if(!(isset($_POST['place_id']) && preg_match("/^[0-9]*$/", $_POST['place_id']))){
			redirect($this->plu_path."&func=show_dist_list", 0, "請填選消息分類");
			exit;
		}
		$dist_name = isset($_POST['dist_name'])?$_POST['dist_name']:"";
		$dist_url = isset($_POST['dist_url'])?$_POST['dist_url']:"";
		$dist_phone = isset($_POST['dist_phone'])?$_POST['dist_phone']:"";
		$dist_address = isset($_POST['dist_address'])?$_POST['dist_address']:"";
		$place_id = isset($_POST['place_id'])?$_POST['place_id']:"";
		
		$sql  = "UPDATE plu_distributor SET place_id=$place_id, dist_name='$dist_name', dist_url='$dist_url', dist_phone='$dist_phone',";
		$sql .= " dist_address='$dist_address', publishDate=NOW(), modiTime=NOW() WHERE dist_id = $dist_id ";
		$db->query($sql);
		
		if($_FILES["pic"]["size"] && $_FILES["pic"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["pic"]["tmp_name"];
			$name = "dist_".$dist_id.substr($_FILES["pic"]["name"], strrpos($_FILES["pic"]["name"], "."));
			$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_distributor SET img_name='$name',img_desc='$img_desc' WHERE dist_id=$dist_id";
			$db->query($sql);
		}
		//echo $sql;
		redirect($this->plu_path."&func=show_dist_list", 0, "變更已完成");
	}
}
?>