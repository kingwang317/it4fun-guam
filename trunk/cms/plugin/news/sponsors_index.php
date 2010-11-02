<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/news/";
		$img_path = WEBROOT.$upload_path;
		$dataTotal = $db->get_var("SELECT COUNT(news_id) FROM plu_news WHERE cate_id = '2'");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal,2);
		$sql = "SELECT news_id, caption, content, img_name, ModiTime FROM plu_news WHERE cate_id = '2' ORDER BY img_desc LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
?>
<div id="sponsors">
	   <h3 class="sponsors_h3">distributors<span></span></h3>
		<p class="footnavi"><?php echo $pagejump ?></p>
<?php
		if(isset($result)){
			foreach($result as $rows){
				$path = $img_path.$rows->img_name;
				if(empty($rows->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
?>
		<div class="sponsors_txt_box">
			<div class="box">
			<a class="img" href="<?php echo WEBROOT."/index.php?cmsid=13&news_id=$rows->news_id"?>"><img src="<?php echo $path ?>"  alt=""/></a>
			</div>
			<h4 class="sponsors_title"><a href="<?php echo WEBROOT."/index.php?cmsid=13&news_id=$rows->news_id"?>"><?php echo $rows->caption ?></a></h4>
			<div class="sponsors_txt">
			<?php echo $rows->content ?>
			</div>			
		</div>
		<br clear="all"/>
<?php
				}
			}
?>
<p class="footnavi"><?php echo $pagejump ?></p>