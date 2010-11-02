<?php
/*
模組參數
套件名稱：ptt口碑套件
開發人：Mr.King
*/

class ptt{
	private $tmpl_path = "/cms/plugin/ptt/admin/tmpl/";
	private $plu_path = "?pluName=ptt&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/ptt/";
	private $css_path = "/cms/admin/template/css/";
	private $plu_Cname = "ptt文章管理";
	
    function __construct() {
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("ptt");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_ptt":
				$this->do_add_ptt();
				return false;
			case "do_edit_ptt":
				$this->do_edit_ptt();
				return false;
			/*case "do_add_category":
				$this->do_add_category();
				return false;*/
			case "do_del_ptt":
				$this->do_del_ptt();
				return false;
			case "show_edit_ptt":
				$content = $this->show_edit_ptt();
				return true;
			/*case "show_add_category":
				$content = $this->show_add_category();
				return true;*/
			case "show_add_ptt":
				$content = $this->show_add_ptt();
				return true;
			default:
				$content = $this->show_ptt_list();
				return true;
		}
		return false;
	}

	function show_ptt_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "ptt文章管理";
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
		$dataTotal = $db->get_var("SELECT COUNT(ptt_id) FROM plu_ptt" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,5);

		$sql = "SELECT ptt_id, ptt_title, ptt_post_time,ptt_track_time,ptt_pid,ptt_bid,ModiTime FROM plu_ptt ". $filter ." LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("kw_ids", $kw_ids);
		$tpl->assign("ptt_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$tpl->assign("show_add_ptt_link", $this->plu_path."&func=show_add_ptt");
		//$tpl->assign("show_add_news_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_ptt_list_link" , $this->plu_path."&func=show_ptt_list");
		$tpl->assign("show_edit_ptt_link" , $this->plu_path."&func=show_edit_ptt&ptt_id=");
		$tpl->assign("do_del_ptt_link" , $this->plu_path."&func=do_del_ptt&ptt_id=");
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		return $tpl->fetch("show_ptt_list.tpl");
	}

	
	function do_del_ptt(){
		$db = init_db();
		$ptt_id = isset($_GET['ptt_id'])?$_GET['ptt_id']:"";
		if(!(isset($_GET['ptt_id']) && preg_match("/^[0-9]*$/", $_GET['ptt_id']))){
			redirect($this->plu_path."&func=show_ptt_list", 0, "你所要刪除的文章不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_ptt WHERE ptt_id = $ptt_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_ptt_list", 0, "刪除已完成");
	}

	function show_add_ptt(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;


		//加入麵包屑
		$func_Cname = "新增口碑文章";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$broad_sql = "SELECT DISTINCT ptt_bid FROM plu_ptt";
		$broad_result = $db->get_results($broad_sql, ARRAY_A);
		$tpl->assign("broad_data", $broad_result);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_ptt_url" , $this->plu_path."&func=do_add_ptt");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_ptt_list");
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_add_ptt.tpl");
	}
	
	function do_add_ptt(){
		$db = init_db();
		if($_POST["broad_sel"] == 0){
			$ptt_bid = $_POST["ptt_bid"];
		}else{
			$ptt_bid = $_POST["broad_sel"];
		}
		
		$ptt_track_time = isset($_POST["ptt_track_time"])?$_POST["ptt_track_time"]:"";
		$ptt_pid = isset($_POST["ptt_pid"])?$_POST["ptt_pid"]:"";
		$ptt_title = isset($_POST["ptt_title"])?$_POST["ptt_title"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$ptt_cate = isset($_POST["ptt_cate"])?$_POST["ptt_cate"]:"未分類";
		$ptt_status = isset($_POST["ptt_status"])?$_POST["ptt_status"]:"未處理";
		$ptt_rank = isset($_POST["ptt_rank"])?$_POST["ptt_rank"]:"未分類";
		$ptt_post_time = isset($_POST["ptt_post_time"])?$_POST["ptt_post_time"]:"";
		$sql  = "INSERT INTO plu_ptt (ptt_id, kw_ids, ptt_bid, ptt_pid, ptt_title, ptt_track_time, ptt_post_time, ptt_status, ptt_cate, ptt_rank, modiTime) ";
		$sql .= "VALUES ('', '$kw_ids','$ptt_bid', '$ptt_pid', '$ptt_title','$ptt_track_time','$ptt_post_time','$ptt_status', '$ptt_cate','$ptt_rank',NOW())";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "新增已完成");
	}
	function show_edit_ptt(){
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
		$ptt_id = isset($_GET['ptt_id'])?$_GET['ptt_id']:"";
		
		$sql = "SELECT * FROM plu_ptt WHERE ptt_id='$ptt_id'";
		$result = $db->get_results($sql, ARRAY_A);
		
		$broad_sql = "SELECT DISTINCT ptt_bid FROM plu_ptt";
		$broad_result = $db->get_results($broad_sql, ARRAY_A);
		
		$tpl->assign("broad_data", $broad_result);
		$tpl->assign("ptt_data",$result);
		$broad_sql = "SELECT DISTINCT ptt_bid FROM plu_ptt";
		$broad_result = $db->get_results($broad_sql, ARRAY_A);
		$tpl->assign("broad_data", $broad_result);
		$tpl->assign("kw_ids", explode(",",str_replace(array("[","]"),"",$result[0]['kw_ids'])));
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("css_path", WEBROOT.$this->css_path);
		$tpl->assign("jq_multi_select_path" , WEBROOT."/cms/lib/jquery/multiSelect/");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_ptt_url" , $this->plu_path."&func=do_edit_ptt&ptt_id=".$ptt_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_ptt_list");
		return $tpl->fetch("show_edit_ptt.tpl");
	}
	function do_edit_ptt(){
		$db = init_db();
		$ptt_id = isset($_GET["ptt_id"])?$_GET["ptt_id"]:"";
		if(isset($_POST["broad_sel"]))
		if($_POST["broad_sel"] == 0){
			$ptt_bid = $_POST["ptt_bid"];
		}else{
			$ptt_bid = $_POST["broad_sel"];
		}
		$ptt_title = isset($_POST["ptt_title"])?$_POST["ptt_title"]:"";
		$ptt_pid = isset($_POST["ptt_pid"])?$_POST["ptt_pid"]:"";
		$kw_ids = isset($_POST["kw_ids"])?"[".implode("],[", $_POST["kw_ids"])."]":"";
		$ptt_cate = isset($_POST["ptt_cate"])?$_POST["ptt_cate"]:"未分類";
		$ptt_status = isset($_POST["ptt_status"])?$_POST["ptt_status"]:"未處理";
		$ptt_rank = isset($_POST["ptt_rank"])?$_POST["ptt_rank"]:"未分類";
		$ptt_post_time = isset($_POST["ptt_post_time"])?$_POST["ptt_post_time"]:"";
		$ptt_track_time = isset($_POST["ptt_track_time"])?$_POST["ptt_track_time"]:"";

		$sql  = "UPDATE plu_ptt SET ptt_id=$ptt_id, kw_ids='$kw_ids', ptt_bid='$ptt_bid',ptt_pid='$ptt_pid', ptt_title='$ptt_title',";
		$sql .= " ptt_track_time = '$ptt_track_time',ptt_post_time='$ptt_post_time', ptt_status='$ptt_status', ptt_cate='$ptt_cate', ptt_rank='$ptt_rank', modiTime=NOW() WHERE ptt_id = $ptt_id ";
		$db->query($sql);
		redirect($this->plu_path."&func=show_news_list", 0, "變更已完成");
	}
}
?>