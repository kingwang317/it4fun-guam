<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/product/";
		$prod_id = isset($_GET['prod_id'])?$_GET['prod_id']:"";
		$img_path = WEBROOT.$upload_path;
		$sql = "SELECT name, content,cate_id FROM plu_product WHERE prod_id = '$prod_id'";
		//echo $sql;
		$result = $db->get_results($sql);
		$img_sql = "SELECT img_name FROM plu_product WHERE prod_id = '$prod_id'";
		//echo $sql;
		$img_result = $db->get_var($img_sql);
?>
<script type="text/javascript">
function aHover(url){
	location.href = url + location.href;
}
</script>
<div class="image_box">
<?php
$count = 1;
$index_img = explode('|',$img_result);
//$path = $img_path.$index_img[0];
foreach($index_img as $value ){
?>
<div class="simple" id="mies<?php echo $count ?>">
<img style="width:300px;height:300px" src="<?php echo $img_path.$value; ?>" />
</div>
<?php
if($count == 1){
?>
<img style="width:300px;height:300px" src="<?php echo $img_path.$value; ?>" rel="#mies<?php echo $count++ ?>"/>
<?php 
}else if($count%2 == 0){
?>
<img style="width:143px;height:143px" class="left_img" src="<?php echo $img_path.$value; ?>" rel="#mies<?php echo $count++ ?>"/>
<?php 
}else{
?>
<img style="width:143px;height:143px" class="right_img" src="<?php echo $img_path.$value; ?>" rel="#mies<?php echo $count++ ?>"/>
<?php
}
}
?> 
       	   
</div>
<div class="productname_container">
<?php
		if(isset($result)){
			foreach($result as $row){
?>
<h3><?php echo $row->name ?>; 
<span class="iconwrap">
   <img class="icon" onClick="aHover('http://www.facebook.com/share.php?u=')" src="images/fun.gif"/>
   <img class="icon" onClick="aHover('http://twitter.com/home/?status=')" src="images/twinter.gif"/>
   <img class="icon" onClick="aHover('http://www.plurk.com/?qualifier=shares&status=')" src="images/plurk.gif"/>
</span>
</h3>
<?php echo $row->content ?>

<a class="backurl" href="<?php echo WEBROOT."/index.php?cmsid=2&cate_id=$row->cate_id"?>" >Back to Category &gt;&gt;</a>	
<?php
				}
			}
			
?>


</div>