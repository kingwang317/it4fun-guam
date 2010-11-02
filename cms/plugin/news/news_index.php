<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/news/";
		$img_path = WEBROOT.$upload_path;
		$dataTotal = $db->get_var("SELECT COUNT(news_id) FROM plu_news WHERE cate_id = '1'");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,2);
		$sql = "SELECT news_id, caption, content, img_name, img_desc, ModiTime FROM plu_news WHERE cate_id = '1' ORDER BY img_desc LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
?>
<div id="newsevents">
	   <h3 class="news_events_h3">News / Events<span></span></h3>
		<p class="footnavi"><?php echo $pagejump ?></p>
<?php
		if(isset($result)){
			foreach($result as $rows){
				$path = $img_path.$rows->img_name;
				if(empty($rows->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
?>
		<div class="newsevents_txt">
			<img src="<?php echo $path ?>" class="newsevents_img" alt=""/>
			<h4 class="newsevents_title"><a href="<?php echo WEBROOT."/index.php?cmsid=12&news_id=$rows->news_id"?>"><?php echo $rows->caption ?></a></h4>
			<h4 class="newsevents_dat"><?php echo $rows->ModiTime ?></h4>
			<?php echo $rows->content ?>
		</div>
<?php
				}
			}
?>
		<p class="footnavi"><?php echo $pagejump ?></p>
</div>
