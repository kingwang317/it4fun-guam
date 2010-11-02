<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/product/";

		$img_path = WEBROOT.$upload_path;
		//$sql = "SELECT news_id, caption, content FROM plu_news WHERE cate_id = '1' LIMIT 0,2";
		$sql = "SELECT news_id, caption, content FROM plu_news LIMIT 0,2";
		//echo $sql;
		$result = $db->get_results($sql);
?>
 <h4 class="events_h4">New Events<span></span></h4>
<div id="events">
<?php
		if(isset($result)){
			foreach($result as $row){
?>
 <div class="left_box2">
	<h5><a href="<?php echo WEBROOT."/index.php?cmsid=12&news_id=$row->news_id"?>"><?php echo $row->caption ?></a></h5>
	<?php echo mb_substr( $row->content, 0, 30 )."..." ?>
 </div>	
<?php
				}
			}
			
?>
</div> 