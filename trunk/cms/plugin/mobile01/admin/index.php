<?php
/*
模組參數
套件名稱：mobile01口碑套件
開發人：Mr.King
*/

class mobile01{
	private $tmpl_path = "/cms/plugin/mobile01/admin/tmpl/";
	private $plu_path = "?pluName=mobile01&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/mobile01/";
	private $css_path = "/cms/admin/template/css/";
	private $plu_Cname = "mobile01文章管理";
	
    function __construct() {
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("mobile01");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_m01":
				$this->do_add_m01();
				return false;
			case "do_edit_m01":
				$this->do_edit_m01();
				return false;
			case "do_del_m01":
				$this->do_del_m01();
				return false;
			case "show_edit_m01":
				$content = $this->show_edit_m01();
				return true;
			case "show_add_m01":
				$content = $this->show_add_m01();
				return true;
			case "get_m01_data":
				$this->get_m01_data();
				return false;
				break;
			default:
				$content = $this->show_m01_list();
				return true;
		}
		return false;
	}

	function show_m01_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "mobile01文章管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);
		///print_r($_POST);
		$kw_ids = isset($_POST["kw_ids"])?$_POST["kw_ids"]:NULL;
		$filter = "";
		if(isset($kw_ids)){
			foreach($kw_ids as $ids){
				if(empty($filter))
					$filter = " WHERE kw_ids LIKE '%[$ids]%' ";
				else
					$filter .= " OR kw_ids LIKE '%[$ids]%' ";
			}
		}
		if(!empty($filter)){
			$_SESSION['m01_filter'] = $filter;
		}else if(!empty($_GET['page']) && isset($_SESSION['filter']) && !empty($_SESSION['filter'])){
			$filter=$_SESSION['m01_filter'];
		}
		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(m01_id) FROM plu_mobile01" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,5);

		$sql = "SELECT m01_id, m01_title, m01_post_time, ModiTime FROM plu_mobile01 ". $filter ." LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("kw_ids", $kw_ids);
		$tpl->assign("m01_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$tpl->assign("show_add_m01_link", $this->plu_path."&func=show_add_m01");
		//$tpl->assign("show_add_news_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_m01_list_link" , $this->plu_path."&func=show_m01_list");
		$tpl->assign("show_edit_m01_link" , $this->plu_path."&func=show_edit_m01&m01_id=");
		$tpl->assign("do_del_m01_link" , $this->plu_path."&func=do_del_m01&m01_id=");
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		return $tpl->fetch("show_m01_list.tpl");
	}
	function get_m01_data(){
		require_once("m01_crawler.php");
		$tid = isset($_GET["t"])?$_GET["t"]:"";
		$url = isset($_GET["url"])?$_GET["url"]:"";
		$url = $url."&t=".$tid;
		$crawl = new m01Crawler($url);
		$m01_data = array(
			"title"			=> $crawl->get('title'),
			"reply_time"	=>  strip_tags($crawl->get('post_time'))
		);
		echo json_encode($m01_data);
	}
	
	function do_del_m01(){
		$db = init_db();
		$m01_id = isset($_GET['m01_id'])?$_GET['m01_id']:"";
		if(!(isset($_GET['m01_id']) && preg_match("/^[0-9]*$/", $_GET['m01_id']))){
			redirect($this->plu_path."&func=show_m01_list", 0, "你所要刪除的文章不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_mobile01 WHERE m01_id = $m01_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_m01_list", 0, "刪除已完成");
	}

	function show_add_m01(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;


		//加入麵包屑
		$func_Cname = "新增口碑文章";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_m01_url" , $this->plu_path."&func=do_add_m01");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_m01_list");
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_add_m01.tpl");
	}
	
	function do_add_m01(){
		$db = init_db();
		$m01_url = isset($_POST["m01_url"])?$_POST["m01_url"]:"";
		$m01_title = isset($_POST["m01_title"])?$_POST["m01_title"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$m01_cate = isset($_POST["m01_cate"])?$_POST["m01_cate"]:"未分類";
		$m01_status = isset($_POST["m01_status"])?$_POST["m01_status"]:"未處理";
		$m01_rank = isset($_POST["m01_rank"])?$_POST["m01_rank"]:"未分類";
		$post_time = isset($_POST["post_time"])?$_POST["post_time"]:"";
		$sql  = "INSERT INTO plu_mobile01 (m01_id, kw_ids, m01_url, m01_title, m01_post_time,m01_track_time, m01_status, m01_cate, m01_rank, modiTime) ";
		$sql .= "VALUES ('', '$kw_ids','$m01_url', '$m01_title','$post_time',NOW(),'$m01_status', '$m01_cate','$m01_rank',NOW())";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "新增已完成");
	}
	function show_edit_m01(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "變更口碑文章";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$m01_id = isset($_GET['m01_id'])?$_GET['m01_id']:"";
		$sql = "SELECT * FROM plu_mobile01 WHERE m01_id='$m01_id'";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("m01_data",$result);
		$tpl->assign("kw_ids", explode(",",str_replace(array("[","]"),"",$result[0]['kw_ids'])));
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_m01_url" , $this->plu_path."&func=do_edit_m01&m01_id=".$m01_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_m01_list");
		return $tpl->fetch("show_edit_m01.tpl");
	}
	function do_edit_m01(){
		$db = init_db();
		$m01_id = isset($_GET["m01_id"])?$_GET["m01_id"]:"";
		$m01_url = isset($_POST["m01_url"])?$_POST["m01_url"]:"";
		$m01_title = isset($_POST["m01_title"])?$_POST["m01_title"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$m01_cate = isset($_POST["m01_cate"])?$_POST["m01_cate"]:"未分類";
		$m01_status = isset($_POST["m01_status"])?$_POST["m01_status"]:"未處理";
		$m01_rank = isset($_POST["m01_rank"])?$_POST["m01_rank"]:"未分類";
		$post_time = isset($_POST["post_time"])?$_POST["post_time"]:"";

		$sql  = "UPDATE plu_mobile01 SET m01_id=$m01_id, kw_ids='$kw_ids', m01_url='$m01_url', m01_title='$m01_title',";
		$sql .= " m01_post_time='$post_time', m01_status='$m01_status', m01_cate='$m01_cate', m01_rank='$m01_rank', modiTime=NOW() WHERE m01_id = $m01_id ";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "變更已完成");
	}
}
?>