<?php
/*
模組參數
套件名稱：商品/服務管理
開發人：Max Clapton
*/

class product{
	private $tmpl_path = "/cms/plugin/product/admin/tmpl/";
	private $plu_path = "?pluName=product&pluAdmin=admin/sub.php";
	private $parent_path = "?pluName=product&pluAdmin=admin/index.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/product/";
	private $plu_Cname = "商品/服務管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("product");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_category":
				$this->do_add_category();
				return false;
			case "do_edit_category":
				$this->do_edit_category();
				return false;
			case "do_del_category":
				$this->do_del_category();
				return false;
			case "do_change_cate_order":
				$this->do_change_cate_order();
				return false;
			case "show_add_category":
				$content = $this->show_add_category();
				return true;
			case "show_edit_category":
				$content = $this->show_edit_category();
				return true;
			default:
				$content = $this->show_category_list();
				return true;
		}
		return false;
	}
	
	function show_category_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "商品類別管理";
		$trail = new Breadcrumb();

		$filter = "";
		if(isset($_GET['cate_id'])){
			$filter = " WHERE parent_id = ".$_GET['cate_id'];
			$trail->add("第2層分類", $_SERVER['REQUEST_URI'], 2);
		}else{
			$filter = " WHERE parent_id = -1";
			$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);
		}
		if(isset($_GET['opt']))
		{
			if($_GET['opt'] == 1){
				$txt = htmlspecialchars($_POST['search_txt']);
				switch($_POST['search_item']){
					case 0:  //分類名稱
						$filter = " a JOIN plu_product_category b ON a.cate_id=b.cate_id WHERE b.cate_name LIKE '%".$txt."%'";
						break;
					case 1:  //編號
						$filter = " WHERE prod_number LIKE '%".$txt."%'";
						break;
					default: //商品/服務名稱
						$filter = " WHERE name LIKE '%".$txt."%'";
						break;
				}
			}
		}
		$sql = "SELECT * FROM plu_product_category". $filter . " ORDER BY cate_order";
		$result = $db->get_results($sql, ARRAY_A);

		$tpl->assign("search_item_url", $this->plu_path."&func=show_category_list&opt=1");
		$tpl->assign("category_data", $result);
		$tpl->assign("func_Cname", $func_Cname);
		
		$tpl->assign("do_change_category_order_url", $this->plu_path."&func=do_change_cate_order");
		$tpl->assign("show_add_category_link", $this->plu_path."&func=show_add_product");
		$tpl->assign("show_add_product_category", $this->plu_path."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_category_link" , $this->plu_path."&func=show_edit_category&cate_id=");
		$tpl->assign("do_del_category_link" , $this->plu_path."&func=do_del_category&cate_id=");
		if(isset($_GET['cate_id'])){
			$tpl->assign("show_subcate_link", $this->parent_path."&func=show_product_list&cate_id=");	
			$tpl->assign("show_product", true);
		}else{
			$tpl->assign("show_subcate_link", $this->plu_path."&func=show_category_list&cate_id=");	
			$tpl->assign("show_product", false);
		}
		$tpl->assign("jquery_dnd_url", WEBROOT.'/cms/lib/jquery/jquery.tablednd_0_5.js');
		return $tpl->fetch("show_category_list.tpl");
	}
	
	function show_add_category(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "新增分類";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_product_category WHERE parent_id=-1";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_category_url" , $this->plu_path."&func=do_add_category");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_category_list");
		return $tpl->fetch("show_add_category.tpl");
	}
	
	function show_edit_category(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "變更分類";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		if(!(isset($_GET['cate_id']) && preg_match("/^[0-9]*$/",$_GET['cate_id']))){
			redirect($this->plu_path."&func=show_category_list", 0, "你所要變更的分類不存在");
			exit;
		}
		$cate_id = $_GET['cate_id'];
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_product_category WHERE parent_id=-1";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$sel_sql = "SELECT * FROM plu_product_category WHERE cate_id=".$cate_id;
		$result = $db->get_row($sel_sql, ARRAY_A);
		foreach($result as $key => $value){
			$tpl->assign($key, $value);
		}
			
		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_category_url" , $this->plu_path."&func=do_edit_category&cid=".$cate_id);
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_category_list");
		return $tpl->fetch("show_add_category.tpl");
	}
	
	function do_add_category(){
		$db = init_db();
		$cate_id = isset($_POST['cate_id']) && preg_match("/^[0-9]*$/", $_POST['cate_id'])?$_POST['cate_id']:-1;
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "INSERT INTO plu_product_category (cate_name, cate_content, parent_id) ";
		$sql .= "VALUES ('$name', '$description', $cate_id)";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_category_list", 0, "新增已完成");
	}

	function do_edit_category(){
		$db = init_db();
		if(!(isset($_GET['cid']) && preg_match("/^[0-9]*$/",$_GET['cid']))){
			redirect($this->plu_path."&func=show_category_list", 0, "你所要變更的分類不存在");
			exit;
		}
		$cate_id = $_GET['cid'];
		$parent_id = isset($_POST['cate_id']) && preg_match("/^[0-9]*$/", $_POST['cate_id'])?$_POST['cate_id']:-1;
		$name = isset($_POST['name'])?$_POST['name']:"";
		$description = isset($_POST['description'])?$_POST['description']:"";

		$sql  = "UPDATE plu_product_category SET cate_name='$name', cate_content='$description', parent_id=$parent_id WHERE cate_id= $cate_id";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_category_list", 0, "變更已完成");
	}

	function do_change_cate_order(){
		$db = init_db();
		$row_order = isset($_POST['admin_table'])?$_POST['admin_table']:null;
		if(!empty($row_order)){
			$order = 1;
			foreach($row_order as $cate_id){
				if(!empty($cate_id)){
					$update_sql = "UPDATE `plu_product_category` SET`cate_order` = '$order' WHERE `cate_id` = '$cate_id';";
					$db->query($update_sql);
					$order++;
				}
			}
		}
//		print_r($_POST['admin_table']);
		echo "排序變更完畢";
	}
	
	function do_del_category(){
		$db = init_db();
		if(!(isset($_GET['cate_id']) && preg_match("/^[0-9]*$/", $_GET['cate_id']))){
			redirect($this->plu_path."&func=show_product_list", 0, "你所要刪除的產品不合法");
			exit;
		}
		$cate_id = $_GET['cate_id'];
		$sql = "SELECT COUNT(*) FROM plu_product WHERE cate_id=$cate_id";
		$count = $db->get_var($sql);
		if($count > 0){
			redirect($this->plu_path."&func=show_category_list", 0, "你所要刪除的分類尚有商品, 若要刪除請先將其它商品移至其它分類");
			exit;
		}
		$sql = "SELECT COUNT(*) FROM plu_product_category WHERE parent_id=$cate_id";
		$count = $db->get_var($sql);
		if($count > 0){
			redirect($this->plu_path."&func=show_category_list", 0, "你所要刪除的分類尚有子分類, 若要刪除請先將其子分類移至其它分類下");
			exit;
		}
		
		$sql  = "DELETE FROM plu_product_category WHERE cate_id = $cate_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_category_list", 0, "刪除已完成");
	}	
}
?>