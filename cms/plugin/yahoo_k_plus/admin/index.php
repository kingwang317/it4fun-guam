<?php
/*
模組參數
套件名稱：Yahoo知識+
開發人：Mr.King
*/

class yahoo_k_plus{
	private $tmpl_path = "/cms/plugin/yahoo_k_plus/admin/tmpl/";
	private $plu_path = "?pluName=yahoo_k_plus&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/yahoo_k_plus/";
	private $css_path = "/cms/admin/template/css/";
	private $plu_Cname = "知識+文章管理";
	
    function __construct() {
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("yahoo_k_plus");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_kp":
				$this->do_add_kp();
				return false;
			case "do_edit_kp":
				$this->do_edit_kp();
				return false;
			/*case "do_add_category":
				$this->do_add_category();
				return false;*/
			case "do_del_kp":
				$this->do_del_kp();
				return false;
			case "show_edit_kp":
				$content = $this->show_edit_kp();
				return true;
			case "get_kp_data":
				$content = $this->get_kp_data();
				return false;
			case "show_add_kp":
				$content = $this->show_add_kp();
				return true;
			default:
				$content = $this->show_kp_list();
				return true;
		}
		return false;
	}

	function show_kp_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "知識+文章管理";
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

		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);

		$dataTotal = $db->get_var("SELECT COUNT(kp_id) FROM plu_yahoo_kplus" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,5);

		$sql = "SELECT kp_id, kp_title, kp_post_time, ModiTime FROM plu_yahoo_kplus ". $filter ." LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("kw_ids", $kw_ids);
		$tpl->assign("kp_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$tpl->assign("show_add_kp_link", $this->plu_path."&func=show_add_kp");
		//$tpl->assign("show_add_news_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_kp_list_link" , $this->plu_path."&func=show_kp_list");
		$tpl->assign("show_edit_kp_link" , $this->plu_path."&func=show_edit_kp&kp_id=");
		$tpl->assign("do_del_kp_link" , $this->plu_path."&func=do_del_kp&kp_id=");
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		return $tpl->fetch("show_kp_list.tpl");
	}
	function get_kp_data(){
		require_once("yahoo_crawler.php");
		$qid = isset($_GET["qid"])?$_GET["qid"]:"";
		//echo $qid;
		$crawl = new ykpCrawler($qid,"question");
		$title = $crawl->get('title');
		$post_time = $crawl->get('post_time');
		$kp_data = array(
			"title"			=> $title,
			"reply_time"	=>  $post_time
		);
		echo json_encode($kp_data);
	}
	
	function do_del_kp(){
		$db = init_db();
		$kp_id = isset($_GET['kp_id'])?$_GET['kp_id']:"";
		if(!(isset($_GET['kp_id']) && preg_match("/^[0-9]*$/", $_GET['kp_id']))){
			redirect($this->plu_path."&func=show_kp_list", 0, "你所要刪除的文章不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_yahoo_kplus WHERE kp_id = $kp_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_kp_list", 0, "刪除已完成");
	}

	function show_add_kp(){
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
		$tpl->assign("do_add_kp_url" , $this->plu_path."&func=do_add_kp");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_kp_list");
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_add_kp.tpl");
	}
	
	function do_add_kp(){
		$db = init_db();
		$kp_qid = isset($_POST["kp_qid"])?$_POST["kp_qid"]:"";
		$kp_title = isset($_POST["kp_title"])?$_POST["kp_title"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$kp_cate = isset($_POST["kp_cate"])?$_POST["kp_cate"]:"未分類";
		$kp_status = isset($_POST["kp_status"])?$_POST["kp_status"]:"未處理";
		$kp_rank = isset($_POST["kp_rank"])?$_POST["kp_rank"]:"未分類";
		$post_time = isset($_POST["post_time"])?$_POST["post_time"]:"";
		$sql  = "INSERT INTO plu_yahoo_kplus (kp_id, kw_ids, q_id, kp_title, kp_post_time, kp_status, kp_cate, kp_rank, modiTime,kp_track_time) ";
		$sql .= "VALUES ('', '$kw_ids','$kp_qid', '$kp_title','$post_time','$kp_status', '$kp_cate','$kp_rank',NOW(),NOW())";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "新增已完成");
	}
	function show_edit_kp(){
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
		$kp_id = isset($_GET['kp_id'])?$_GET['kp_id']:"";
		$sql = "SELECT * FROM plu_yahoo_kplus WHERE kp_id='$kp_id'";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("kp_data",$result);
		$tpl->assign("kw_ids", explode(",",str_replace(array("[","]"),"",$result[0]['kw_ids'])));
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_kp_url" , $this->plu_path."&func=do_edit_kp&kp_id=".$kp_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_kp_list");
		return $tpl->fetch("show_edit_kp.tpl");
	}
	function do_edit_kp(){
		$db = init_db();
		$kp_id = isset($_GET["kp_id"])?$_GET["kp_id"]:"";
		$kp_qid = isset($_POST["kp_qid"])?$_POST["kp_qid"]:"";
		$kp_title = isset($_POST["kp_title"])?$_POST["kp_title"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$kp_cate = isset($_POST["kp_cate"])?$_POST["kp_cate"]:"未分類";
		$kp_status = isset($_POST["kp_status"])?$_POST["kp_status"]:"未處理";
		$kp_rank = isset($_POST["kp_rank"])?$_POST["kp_rank"]:"未分類";
		$post_time = isset($_POST["post_time"])?$_POST["post_time"]:"";

		$sql  = "UPDATE plu_yahoo_kplus SET kp_id=$kp_id, kw_ids='$kw_ids', q_id='$kp_qid', kp_title='$kp_title',";
		$sql .= " kp_post_time='$post_time', kp_status='$kp_status', kp_cate='$kp_cate', kp_rank='$kp_rank', modiTime=NOW() WHERE kp_id = $kp_id ";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "變更已完成");
	}
}
?>