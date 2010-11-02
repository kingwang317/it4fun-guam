<?php
/*
模組參數
套件名稱：商品/服務管理
開發人：Max Clapton
*/

class product{
	private $tmpl_path = "/cms/plugin/product/admin/tmpl/";
	private $plu_path = "?pluName=product&pluAdmin=admin/index.php";
	private $plu_subpath = "?pluName=product&pluAdmin=admin/sub.php";
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
			case "do_add_product":
				$this->do_add_product();
				return false;
			case "do_edit_product":
				$this->do_edit_product();
				return false;
			case "do_del_product":
				$this->do_del_product();
				return false;
			case "show_edit_product":
				$content = $this->show_edit_product();
				return true;
			case "show_add_product":
				$content = $this->show_add_product();
				return true;
			default:
				$content = $this->show_product_list();
				return true;
		}
		return false;
	}
	function uh($str)
	{
		$farr = array(
		"/\s /", //過濾多余的空白
		"/<(\/?)(script|i?frame|style|html|body|title|link|meta|table|tbody|tr|td|\?|\%)([^>]*?)>/isU", //過濾 <script 等可能引入惡意內容或惡意改變顯示布局的代碼,如果不需要插入flash等,還可以加入<object的過濾
		"/(<[^>]*)on[a-zA-Z] \s*=([^>]*>)/isU", //過濾javascript的on事件

		);
		$tarr = array(
		" ",
		"", //如果要直接清除不安全的標簽，這里可以留空
		"\\1\\2",
		);

		$str = preg_replace( $farr,$tarr,$str);
		return $str;
	}

	function get_subcategory_script(){
		$db = init_db();
		$sel_sql = "SELECT DISTINCT parent_id, cate_id, cate_name FROM plu_product_category WHERE parent_id<>-1 ORDER BY parent_id, cate_id";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$result = "a=new Array();";
		$lastID = -1;
		$counter = 0;
		for($i = 0 ; $i < count($sel_result) ; $i++){
			if($lastID != $sel_result[$i]["parent_id"]){
				$counter = 0;
				$lastID = $sel_result[$i]["parent_id"];
				if($i!=0){
					$result.="}";
				}
				$result.= " if(".$sel_result[$i]["parent_id"]."==id){";
			}
			
			$result.="a[$counter]=new Option(\"".$sel_result[$i]["cate_name"]."\",".$sel_result[$i]["cate_id"].");";
			$counter++;
		}
		$result.="}";
		return $result;
	}
	function show_product_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "商品/服務管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_product_category WHERE parent_id=-1";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("second_cate", $this->get_subcategory_script());

		$filter = "";
		if(isset($_GET['opt']))
		{
			if($_GET['opt'] == 1 && !empty($_POST['search_txt'])){
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
			}else if($_GET['opt'] == 2){
				$cate_id = isset($_POST['cate_id']) && preg_match("/^[0-9]*$/",$_POST['cate_id'])?$_POST['cate_id']:"";
				$second_cate_id = isset($_POST['second_cate_id']) && preg_match("/^[0-9]*$/",$_POST['second_cate_id'])?$_POST['second_cate_id']:"";
				$selectedCategory = 0;
				if($second_cate_id != ""){
					$selectedCategory = $second_cate_id;
					$tpl->assign("sec_cate_id", $second_cate_id);
				}else if($cate_id != ""){
					$selectedCategory = $cate_id;
				}
				if($selectedCategory != 0){
					$tpl->assign("cate_id", $cate_id);
					$sel_sql = "SELECT DISTINCT cate_id, cate_name, parent_id FROM plu_product_category WHERE parent_id='$cate_id'";
					$sel_result = $db->get_results($sel_sql, ARRAY_A);
					$tpl->assign("sec_sel_data", $sel_result);
					$filter = isset($cate_id)?" WHERE cate_id = $selectedCategory ":"";
				}
			}
		}else if(isset($_GET['cate_id'])){
			$cate_id = isset($_GET['cate_id']) && preg_match("/^[0-9]*$/",$_GET['cate_id'])?$_GET['cate_id']:"";
			$filter = $cate_id!=""?" WHERE cate_id = '$cate_id' ":"";
		}
		if(!empty($filter)){
			$_SESSION['filter'] = $filter;
		}else if(!empty($_GET['page']) && isset($_SESSION['filter']) && !empty($_SESSION['filter'])){
			$filter=$_SESSION['filter'];
		}else{
		//echo "1234";
		$_SESSION['filter'] = "";
		}		
		$dataTotal = $db->get_var("SELECT COUNT(prod_id) FROM plu_product" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT prod_id, prod_number, name, img_name, content FROM plu_product". $filter . " ORDER BY ModiTime DESC LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("search_item_url", $this->plu_path."&func=show_product_list&opt=1");
		$tpl->assign("img_path", WEBROOT.$this->upload_path);
		$newArray = array();
		$i = 0;
		if(isset($result) && count($result)>0){
			foreach($result as $row){
				$newArray[$i] = array();
				foreach($row as $key => $value){
					if($key == "img_name"){
						$idx = strpos($row[$key], "|");
						if($idx>0){
							$newArray[$i][$key] = substr($value, 0, $idx);
						}else{
							$newArray[$i][$key] = $row[$key];
						}
					}else if($key == "content"){
						$newArray[$i][$key] = strip_tags($value);
					}else{
						$newArray[$i][$key] = $value;
					}
				}
				$i++;
			}
		}
		$tpl->assign("show_product_list_url", $this->plu_path."&func=show_product_list&opt=2");
		$tpl->assign("product_data", $newArray);//$result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("show_add_product_link", $this->plu_path."&func=show_add_product");
		$tpl->assign("show_add_product_category", $this->plu_subpath."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_product_link" , $this->plu_path."&func=show_edit_product&prod_id=");
		$tpl->assign("do_del_product_link" , $this->plu_path."&func=do_del_product&prod_id=");
		return $tpl->fetch("show_product_list.tpl");
	}
	
	function do_del_product(){
		$db = init_db();
		$prod_id = isset($_GET['prod_id'])?$_GET['prod_id']:"";
		if(!(isset($_GET['prod_id']) && preg_match("/^[0-9]*$/", $_GET['prod_id']))){
			redirect($this->plu_path."&func=show_product_list", 0, "你所要刪除的產品不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_product WHERE prod_id = $prod_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_product_list", 0, "刪除已完成");
	}

	function show_add_product(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "新增商品";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_product_category WHERE parent_id=-1";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$tpl->assign("second_cate", $this->get_subcategory_script());

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("multiFile_url", WEBROOT.'/cms/lib/jquery/ui/jquery.multifile.js');
		$tpl->assign("do_add_product_url" , $this->plu_path."&func=do_add_product");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_product_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		$tpl->assign("meta_field", is_maintainer());
		return $tpl->fetch("show_add_product.tpl");
	}
	
	function do_add_product(){
		$db = init_db();
		$publish_date = isset($_POST["publish_date"])?$_POST["publish_date"]:"";
		$publish_date.= isset($_POST["publish_hour"])?" ".$_POST["publish_hour"]:"";
		$publish_date.= isset($_POST["publish_minutes"])?":".$_POST["publish_minutes"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2} [0-9]{1,2}:[0-9]{1,2})$/", $publish_date)<=0){
		    redirect($this->plu_path."&func=show_user_list", 0, "請輸入日期時間.");
			exit;
		}
		$cate_id = isset($_POST['cate_id']) && preg_match("/^[0-9]*$/",$_POST['cate_id'])?$_POST['cate_id']:"";
		$second_cate_id = isset($_POST['second_cate_id']) && preg_match("/^[0-9]*$/",$_POST['second_cate_id'])?$_POST['second_cate_id']:"";
		$selectedCategory = 0;
		if($second_cate_id != ""){
			$selectedCategory = $second_cate_id;
		}else if($cate_id != ""){
			$selectedCategory = $cate_id;
		}else{
		    redirect($this->plu_path."&func=show_user_list", 0, "請選擇商品種類.");
			exit;
		}

		$name = isset($_POST['name'])?$_POST['name']:"";
		$prod_number = isset($_POST['prod_number'])?$_POST['prod_number']:"";
		$content = isset($_POST['content'])?$_POST['content']:"";
		$display =  isset($_POST['display']) && ($_POST['display']) == 1?true:false;
		$promotion =  isset($_POST['promotion']) && ($_POST['promotion'])==1?true:false;
		$price =  isset($_POST['price']) && floatval($_POST['price']) ?floatval($_POST['price']):0;
		$prom_price =  isset($_POST['prom_price']) && floatval($_POST['prom_price'])?floatval($_POST['prom_price']):0;
		
		$meta_title = isset($_POST['meta_title'])?$_POST['meta_title']:"";
		$meta_keyword = isset($_POST['meta_keyword'])?$_POST['meta_keyword']:"";
		$meta_desc = isset($_POST['meta_desc'])?$_POST['meta_desc']:"";

		$sql  = "INSERT INTO plu_product (cate_id, name, prod_number, content, display, promotion, price, prom_price, meta_title, meta_keyword, meta_desc, publishDate, modiTime) ";
		$sql .= "VALUES ('$selectedCategory', '$name', '$prod_number', '$content', '$display', '$promotion', '$price', '$prom_price', '$meta_title','$meta_keyword','$meta_desc', '$publish_date', NOW())";
		$db->query($sql);
		$sql = "SELECT last_insert_id()";
		$id = $db->get_var($sql);
		$imgData = "";
		$i = 0;
		foreach ($_FILES["pic"]["error"] as $key => $error) {
		   if ($error == UPLOAD_ERR_OK) {
			   $name = "product_".$id."_".$i.substr($_FILES["pic"]["name"][$key], strpos($_FILES["pic"]["name"][$key], "."));
			   $imgData.=$name."|";
			   move_uploaded_file(
				 $_FILES["pic"]["tmp_name"][$key],
				 SRVROOT.$this->upload_path.$name
			   ) or redirect($this->plu_path."&func=show_product_list", 0, "檔案上傳有誤, 圖片請重新上傳!");
			   $i++;
		   }
		}
		if(strlen($imgData)>0){
			$imgData=substr($imgData,0,strlen($imgData)-1);
			$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";
			$sql = "UPDATE plu_product SET img_name='$imgData',img_desc='$img_desc' WHERE prod_id=$id";
			$db->query($sql);
		}

		//echo $sql;
		redirect($this->plu_path."&func=show_product_list", 0, "新增已完成");
	}
	function show_edit_product(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('content');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		//加入麵包屑
		$func_Cname = "變更商品";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$sel_sql = "SELECT DISTINCT cate_id, cate_name FROM plu_product_category WHERE parent_id=-1";
		$sel_result = $db->get_results($sel_sql, ARRAY_A);
		$tpl->assign("sel_data", $sel_result);
		$prod_id = isset($_GET['prod_id'])?$_GET['prod_id']:"";
		$sql = "SELECT UNIX_TIMESTAMP(PublishDate) as t,plu_product.* FROM plu_product WHERE prod_id=$prod_id";
		$result = $db->get_row($sql, ARRAY_A);
		if(isset($result)){
			$sel_sql = "SELECT DISTINCT cate_id, cate_name, parent_id FROM plu_product_category WHERE parent_id<>-1 AND parent_id=(SELECT parent_id FROM plu_product_category WHERE cate_id=".$result['cate_id'].")";
			$sel_result = $db->get_results($sel_sql, ARRAY_A);
			$tpl->assign("sec_sel_data", $sel_result);
			$row = $sel_result[0];
			if($sel_result!= NULL && $row['parent_id'] != $result['cate_id']){
				$tpl->assign('cate_id', $row['parent_id']);
				$tpl->assign('sec_cate_id', $result['cate_id']);
			}else{
				$tpl->assign('cate_id', $result['cate_id']);
			}
			$fckeditor->Value = $result['content'];
			$tpl->assign('publish_date', substr($result['PublishDate'], 0, 10));
			$tpl->assign('publish_hour', substr($result['PublishDate'], 11, 2));
			$tpl->assign('publish_minutes', substr($result['PublishDate'], 14, 2));
			foreach($result as $key => $value){
				if($key == "img_name" || $key == "movie_name"){
					$tpl->assign("img_path", WEBROOT.$this->upload_path);
					$tpl->assign($key, explode('|',$value));
				}else if($key !="cate_id")
					$tpl->assign($key, $value);
			}
		}

		$tpl->assign("multiFile_url", WEBROOT.'/cms/lib/jquery/ui/jquery.multifile.js');
		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("meta_field", is_maintainer());
		$tpl->assign("second_cate", $this->get_subcategory_script());
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_product_url" , $this->plu_path."&func=do_edit_product&prod_id=".$prod_id);
		$tpl->assign("cancel_edit_url", $this->plu_path."&func=show_product_list");
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		return $tpl->fetch("show_edit_product.tpl");
	}
	function do_edit_product(){
		$db = init_db();
		if(!(isset($_GET["prod_id"]) && preg_match("/^[0-9]*$/", $_GET["prod_id"]))){
			redirect($this->plu_path."&func=show_product_list", 0, "你所要變更的商品/服務不合法");
			exit;
		}
		$prod_id = $_GET["prod_id"];
		$cate_id = isset($_POST['cate_id']) && preg_match("/^[0-9]*$/",$_POST['cate_id'])?$_POST['cate_id']:"";
		$second_cate_id = isset($_POST['second_cate_id']) && preg_match("/^[0-9]*$/",$_POST['second_cate_id'])?$_POST['second_cate_id']:"";
		$selectedCategory = 0;
		if($second_cate_id != ""){
			$selectedCategory = $second_cate_id;
		}else if($cate_id != ""){
			$selectedCategory = $cate_id;
		}else{
		    redirect($this->plu_path."&func=do_edit_product&prod_id".$prod_id, 0, "請選擇商品種類.");
			exit;
		}

		$publish_date = isset($_POST["publish_date"])?$_POST["publish_date"]:"";
		$publish_date.= isset($_POST["publish_hour"])?" ".$_POST["publish_hour"]:"";
		$publish_date.= isset($_POST["publish_minutes"])?":".$_POST["publish_minutes"]:"";
		if(preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2} [0-9]{1,2}:[0-9]{1,2})$/", $publish_date)<=0){
		    redirect($this->plu_path."&func=show_user_list", 0, "請輸入日期時間.");
			exit;
		}

		$name = isset($_POST['name'])?$_POST['name']:"";
		$prod_number = isset($_POST['prod_number'])?$_POST['prod_number']:"";
		$content = isset($_POST['content'])?$_POST['content']:"";
		$display =  isset($_POST['display']) && ($_POST['display']) == 1?true:false;
		$promotion =  isset($_POST['promotion']) && ($_POST['promotion'])==1?true:false;
		$price =  isset($_POST['price']) && floatval($_POST['price']) ?floatval($_POST['price']):0;
		$prom_price =  isset($_POST['prom_price']) && floatval($_POST['prom_price'])?floatval($_POST['prom_price']):0;
		
		$meta_title = isset($_POST['meta_title'])?$_POST['meta_title']:"";
		$meta_keyword = isset($_POST['meta_keyword'])?$_POST['meta_keyword']:"";
		$meta_desc = isset($_POST['meta_desc'])?$_POST['meta_desc']:"";
		$img_desc = isset($_POST['pic_desc'])?$_POST['pic_desc']:"";

		$sql  = "UPDATE plu_product SET cate_id=$selectedCategory, prod_number='$prod_number', name='$name', content='$content', display='$display', ";
		$sql .= "promotion='$promotion', price='$price', prom_price='$prom_price', meta_title='$meta_title',";
		$sql .= " meta_keyword='$meta_keyword', meta_desc='$meta_desc', publishDate='$publish_date', modiTime=NOW(), img_desc='$img_desc' WHERE prod_id = $prod_id ";
		$db->query($sql);

		$imgData = "";
		$i = 0;
		foreach ($_FILES["pic"]["error"] as $key => $error) {
		   if ($error == UPLOAD_ERR_OK) {
			   $name = "product_".$prod_id."_".$i.substr($_FILES["pic"]["name"][$key], strpos($_FILES["pic"]["name"][$key], "."));
			   $imgData.=$name."|";
			   move_uploaded_file(
				 $_FILES["pic"]["tmp_name"][$key],
				 SRVROOT.$this->upload_path.$name
			   ) or die("Problems with upload");
			   $i++;
		   }
		}
		if(strlen($imgData)>0){
			$imgData=substr($imgData,0,strlen($imgData)-1);
			$sql = "UPDATE plu_product SET img_name='$imgData' WHERE prod_id=$prod_id";
			$db->query($sql);
		}

		//echo $sql;
		redirect($this->plu_path."&func=show_product_list", 0, "變更已完成");
	}
}
?>