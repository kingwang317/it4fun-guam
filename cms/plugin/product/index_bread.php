<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$cate_id = isset($_GET['cate_id'])?$_GET['cate_id']:"-1";
		if($cate_id != -1)
			echo get_breadcrumb($cate_id);
?>
<?php
function get_breadcrumb($cate_id,$breadcrumb_str = ""){
	$db = init_db();
	$breadcrumb_result = $db->get_results("SELECT cate_id,cate_name,parent_id FROM `plu_product_category` WHERE cate_id = '$cate_id' ");
	//print_r($breadcrumb_result);
	if(isset($breadcrumb_result)){
		foreach($breadcrumb_result as $row){
			//echo $row->cate_name;
			if($breadcrumb_str == "")
				$breadcrumb_str =  " > ".$row->cate_name;
			else
				$breadcrumb_str =  " > "."<a href='".WEBROOT."/index.php?cmsid=2&cate_id=$row->cate_id'>$row->cate_name</a>".$breadcrumb_str;
			if($row->parent_id != -1){
				$breadcrumb_str = get_breadcrumb($row->parent_id,$breadcrumb_str);
			}
		}
	}
	return $breadcrumb_str;
}
?>