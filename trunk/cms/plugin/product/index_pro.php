<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/product/";
		$cate_id = isset($_GET['cate_id'])?$_GET['cate_id']:"";
		$where_query = isset($_GET['cate_id'])?" WHERE p.cate_id IN (SELECT cate_id FROM `plu_product_category` WHERE parent_id = '$cate_id') OR p.cate_id = '$cate_id'":"";
		/*if(preg_match("/^[0-9]*$/", $_GET['cate_id'])){
			redirect(WEBROOT, 0, "sorry!!您所要觀看的類別不合法");
			exit;
		}*/
		//SELECT c.cate_id FROM `plu_product` AS p ,`plu_product_category` AS c WHERE p.cate_id = c.parent_id
		$img_path = WEBROOT.$upload_path;
		$dataTotal = $db->get_var("SELECT  COUNT( DISTINCT p.prod_id) FROM `plu_product` AS p ,`plu_product_category` AS c ".$where_query);
		//echo "SELECT DISTINCT COUNT(p.prod_id) FROM `plu_product` AS p ,`plu_product_category` AS c ".$where_query;
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,8);
		$sql = "SELECT DISTINCT p.prod_id, p.name, p.img_name, p.img_desc FROM `plu_product` AS p ,`plu_product_category` AS c ".$where_query." LIMIT $dataStart, $dataLen";
		//echo $sql;
		$result = $db->get_results($sql);
?>
<script type="text/javascript">
function aHover(url){
	location.href = url;
}
</script>
<div id="product1">
<h3 class="product_h3">Product<span></span></h3>
<p class="footnavi"><?php echo $pagejump ?></p>
<div id="box_wrap">
<?php
		if(isset($result)){
			foreach($result as $rows){
				$index_img = explode('|',$rows->img_name);
				$path = $img_path.$index_img[0];
				if(empty($rows->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
?>
	<div class="box">
	<a class="img" href="<?php echo WEBROOT."/index.php?cmsid=11&prod_id=$rows->prod_id"?>"><img src="<?php echo $path ?>" alt="<?php echo $rows->img_desc ?>" /></a>
	<br/>
	<a class="box_link" href="<?php echo WEBROOT."/index.php?cmsid=11&prod_id=$rows->prod_id"?>"><?php echo $rows->name ?></a>
	</div>
<?php
				}
			}
			
?>
</div>  
<br clear="all"/>                  
<div id="product1_button">
<input type="button"name="button" class="button120" value="All" title="" onClick="aHover('<?php echo WEBROOT."/index.php?cmsid=2"?>')"/>
<?php 
$where_query = isset($_GET['cate_id'])?"parent_id = '$cate_id'":"parent_id = '-1'";
$get_scate_query = "SELECT cate_name,cate_content,cate_id FROM plu_product_category WHERE ".$where_query;
$cate_result = $db->get_results($get_scate_query);
if(isset($cate_result)){
	foreach($cate_result as $rows){
?>
<input type="button"name="button" class="button100" value="<?php echo $rows->cate_name ?>"title="<?php echo $rows->cate_content ?>" onClick="aHover('<?php echo WEBROOT."/index.php?cmsid=2&cate_id=$rows->cate_id"?>')"/>
<?php
	}
}
?>
</div>
</div>