<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/product/";

		$img_path = WEBROOT.$upload_path;
		$sql = "SELECT name, content, img_name, prod_id FROM plu_product WHERE prod_number = '1' LIMIT 0,4";
		//echo $sql;
		$result = $db->get_results($sql);
?>
<h4 class="newproducts_h4">New Products<span></span></h4>
<div id="products">
<?php
		if(isset($result)){
			foreach($result as $row){
				$index_img = explode('|',$row->img_name);
				$path = $img_path.$index_img[0];
				if(empty($row->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
?>
 <div class="left_box1">
	<img src="<?php echo $path ?>" class="left-img" alt=""/>
	<h5><a href="<?php echo WEBROOT."/index.php?cmsid=11&prod_id=$row->prod_id"?>"><?php echo $row->name ?></a></h5>
	<?php echo mb_substr( $row->content, 0, 30 )."..." ?>
 </div>	
<?php
				}
			}
			
?>
</div> 