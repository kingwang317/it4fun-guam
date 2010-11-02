<?php
/*
模組參數
套件名稱：最新消息管理
開發人：Max Clapton
*/

class news{
	private $tmpl_path = "/cms/plugin/news/admin/tmpl/";
	private $plu_path = "?pluName=news&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/news/";
	private $plu_Cname = "最新消息";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		$this->plu_path = $this->plu_path."&time=".time();
		//驗證權限
		auth_valid_function("news");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_news":
				$this->do_add_news();
				return false;
			case "do_edit_news":
				$this->do_edit_news();
				return false;
			case "do_add_category":
				$this->do_add_category();
				return false;
			case "do_del_news":
				$this->do_del_news();
				return false;
			case "show_edit_news":
				$content = $this->show_edit_news();
				return true;
			case "show_add_category":
				$content = $this->show_add_category();
				return true;
			case "show_add_news":
				$content = $this->show_add_news();
				return true;
			default:
				$content = $this->show_news_list();
				return true;
		}
		return false;
	}

	function show_news_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "最新消息管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$cate_id = !empty($_POST["cid"]) && preg_match("/^[0-9]*$/",$_POST["cid"])?$_POST["cid"]:NULL;
		$filter = isset($cate_id)?" WHERE cate_id = $cate_id ":"";
		if(!empty($filter)){
			$_SESSION['news_filter'] = $filter;
		}else if(!empty($_GET['page']) && isset($_SESSION['filter']) && !empty($_SESSION['filter'])){
			$filter=$_SESSION['news_filter'];
		}
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_news_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(news_id) FROM plu_news" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$orderby = isset($_GET["orderby"])?$_GET["orderby"]:"";
		if($orderby == "ASC")
		{
			$tpl->assign("news_orderby_cond", $orderby);
			$tpl->assign("news_orderby_url", $this->plu_path."&func=show_news_list&orderby=DESC");
			$filter .=" ORDER BY ModiTime ASC";
		}else{
			$tpl->assign("news_orderby_url", $this->plu_path."&func=show_news_list&orderby=ASC");
			$filter .=" ORDER BY ModiTime DESC";
		}
		$sql = "SELECT news_id, caption, img_name, ModiTime FROM plu_news". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("cate_id", $cate_id);
		$tpl->assign("news_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$tpl->assign("show_add_news_link", $this->plu_path."&func=show_add_news");
		$tpl->assign("show_add_news_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_news_link" , $this->plu_path."&func=show_edit_news&news_id=");
		$tpl->assign("do_del_news_link" , $this->plu_path."&func=do_del_news&news_id=");
		return $tpl->fetch("show_news_list.tpl");
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
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_news_list");
		return $tpl->fetch("show_add_category.tpl");
	}
	
	function do_add_category(){
		$db = init_db();
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_news_category (cate_name, cate_content) ";
		$sql .= "VALUES ('$name', '$description')";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_news_list", 0, "新增已完成");
	}
	
	function do_del_news(){
		$db = init_db();
		$news_id = isset($_GET['news_id'])?$_GET['news_id']:"";
		if(!(isset($_GET['news_id']) && preg_match("/^[0-9]*$/", $_GET['news_id']))){
			redirect($this->plu_path."&func=show_news_list", 0, "你所要刪除的消息不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_news WHERE news_id = $news_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_news_list", 0, "刪除已完成");
	}

	function show_add_news(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "新增最新消息";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_news_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_news_url" , $this->plu_path."&func=do_add_news");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_news_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_add_news.tpl");
	}
	
	function do_add_news(){
		$db = init_db();
		$publish_date = isset($_POST["publish_date"])?$_POST["publish_date"]:"";
		$publish_date.= isset($_POST["publish_hour"])?" ".$_POST["publish_hour"]:"";
		$publish_date.= isset($_POST["publish_minutes"])?":".$_POST["publish_minutes"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2} [0-9]{1,2}:[0-9]{1,2})$/", $publish_date)<=0){
		    redirect("?func=show_user_list", 0, "你所輸入的日期格式不合法.". $publish_date);
			exit;
		}

		$caption = isset($_POST['caption'])?$_POST['caption']:"";
		$content = isset($_POST['content'])?$_POST['content']:"";
		$cate_id = isset($_POST['cate_id'])?$_POST['cate_id']:"";
		$meta_title = isset($_POST['meta_title'])?$_POST['meta_title']:"";
		$meta_keyword = isset($_POST['meta_keyword'])?$_POST['meta_keyword']:"";
		$meta_desc = isset($_POST['meta_desc'])?$_POST['meta_desc']:"";

		$sql  = "INSERT INTO plu_news (cate_id, caption, content, meta_title, meta_keyword, meta_desc, publishDate, modiTime) ";
		$sql .= "VALUES ('$cate_id', '$caption','$content', '$meta_title','$meta_keyword','$meta_desc', '$publish_date', NOW())";
		$db->query($sql);
		$sql = "SELECT last_insert_id()";
		$id = $db->get_var($sql);
		
		if($_FILES["pic"]["size"] && $_FILES["pic"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["pic"]["tmp_name"];
			$name = "news_".$id.substr($_FILES["pic"]["name"], strrpos($_FILES["pic"]["name"], "."));
			$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_news SET img_name='$name',img_desc='$img_desc' WHERE news_id=$id";
			$db->query($sql);
		}

		if($_FILES["movie"]["size"] && $_FILES["movie"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["movie"]["tmp_name"];
			$name = "news_".$id.substr($_FILES["movie"]["name"], strrpos($_FILES["movie"]["name"], "."));
			$movie_desc = isset($_POST['movie_desc'])?$_POST['movie_desc']:"";
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_news SET movie_name='$name',movie_desc='$movie_desc' WHERE news_id=$id";
			$db->query($sql);
		}

		//echo $sql;
		redirect($this->plu_path."&func=show_news_list", 0, "新增已完成");
	}
	function show_edit_news(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "變更最新消息";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_news_category";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$news_id = isset($_GET['news_id'])?$_GET['news_id']:"";
		$sql = "SELECT UNIX_TIMESTAMP(PublishDate) as t,plu_news.* FROM plu_news WHERE news_id=$news_id";
		$result = $db->get_row($sql, ARRAY_A);
		if(isset($result)){
			$fckeditor->Value = $result['content'];
			$tpl->assign('publish_date', substr($result['PublishDate'], 0, 10));
			$tpl->assign('publish_hour', substr($result['PublishDate'], 11, 2));
			$tpl->assign('publish_minutes', substr($result['PublishDate'], 14, 2));
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
		$tpl->assign("do_edit_news_url" , $this->plu_path."&func=do_edit_news&nid=".$news_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_news_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_edit_news.tpl");
	}
	function do_edit_news(){
		$db = init_db();
		if(!(isset($_GET["nid"]) && preg_match("/^[0-9]*$/", $_GET["nid"]))){
			redirect($this->plu_path."&func=show_news_list", 0, "你所要變更的消息不合法");
			exit;
		}
		$news_id = $_GET["nid"];
		if(!(isset($_POST['cate_id']) && preg_match("/^[0-9]*$/", $_POST['cate_id']))){
			redirect($this->plu_path."&func=show_news_list", 0, "請填選消息分類");
			exit;
		}
		$cate_id = $_POST['cate_id'];

		$publish_date = isset($_POST["publish_date"])?$_POST["publish_date"]:"";
		$publish_date.= isset($_POST["publish_hour"])?" ".$_POST["publish_hour"]:"";
		$publish_date.= isset($_POST["publish_minutes"])?":".$_POST["publish_minutes"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2} [0-9]{1,2}:[0-9]{1,2})$/", $publish_date)<=0){
		    redirect($this->plu_path."?func=show_user_list", 0, "你所輸入的日期格式不合法.". $publish_date);
			exit;
		}
		$caption = isset($_POST['caption'])?$_POST['caption']:"";
		$content = isset($_POST['content'])?$_POST['content']:"";
		
		$meta_title = isset($_POST['meta_title'])?$_POST['meta_title']:"";
		$meta_keyword = isset($_POST['meta_keyword'])?$_POST['meta_keyword']:"";
		$meta_desc = isset($_POST['meta_desc'])?$_POST['meta_desc']:"";

		$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";
		$movie_desc = isset($_POST['movie_desc'])?$_POST['movie_desc']:"";

		$sql  = "UPDATE plu_news SET cate_id=$cate_id, caption='$caption', content='$content', meta_title='$meta_title',";
		$sql .= " meta_keyword='$meta_keyword', meta_desc='$meta_desc', publishDate='$publish_date', modiTime=NOW(),img_desc='$img_desc',movie_desc='$movie_desc' WHERE news_id = $news_id ";
		$db->query($sql);
		
		if($_FILES["pic"]["size"] && $_FILES["pic"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["pic"]["tmp_name"];
			$name = "news_".$news_id.substr($_FILES["pic"]["name"], strrpos($_FILES["pic"]["name"], "."));
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_news SET img_name='$name' WHERE news_id=$news_id";
			$db->query($sql);
		}

		if($_FILES["movie"]["size"] && $_FILES["movie"]["error"] == UPLOAD_ERR_OK){
			$tmp_name = $_FILES["movie"]["tmp_name"];
			$name = "news_".$news_id.substr($_FILES["movie"]["name"], strrpos($_FILES["movie"]["name"], "."));
			move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
			$sql = "UPDATE plu_news SET movie_name='$name' WHERE news_id=$news_id";
			$db->query($sql);
		}

		//echo $sql;
		redirect($this->plu_path."&func=show_news_list", 0, "變更已完成");
	}
}
?>